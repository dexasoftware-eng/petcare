<?php

namespace Helpers;

use Core\Database;

class Validator
{
    private array $data;
    private array $rules;
    private array $errors = [];
    private array $validated = [];

    public function __construct(array $data, array $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
        $this->validate();
    }

    private function validate(): void
    {
        foreach ($this->rules as $field => $ruleString) {
            $rules = is_array($ruleString) ? $ruleString : explode('|', $ruleString);
            $value = $this->data[$field] ?? null;
            $fieldLabel = ucfirst(str_replace(['_', '-'], ' ', $field));

            foreach ($rules as $rule) {
                $params = [];
                if (str_contains($rule, ':')) {
                    [$ruleName, $paramStr] = explode(':', $rule, 2);
                    $params = explode(',', $paramStr);
                } else {
                    $ruleName = $rule;
                }

                $ruleName = trim($ruleName);

                // Required
                if ($ruleName === 'required' && (empty($value) && $value !== '0' && $value !== 0)) {
                    $this->addError($field, "{$fieldLabel} is required.");
                    break; // stop evaluating other rules on empty
                }

                // If optional and not set, skip other checks
                if (empty($value) && $ruleName !== 'required') {
                    continue;
                }

                // Email
                if ($ruleName === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($field, "Please enter a valid email address.");
                }

                // Min length / value
                if ($ruleName === 'min') {
                    $min = (int)$params[0];
                    if (is_numeric($value)) {
                        if ($value < $min) $this->addError($field, "{$fieldLabel} must be at least {$min}.");
                    } else {
                        if (mb_strlen((string)$value) < $min) $this->addError($field, "{$fieldLabel} must be at least {$min} characters.");
                    }
                }

                // Max length / value
                if ($ruleName === 'max') {
                    $max = (int)$params[0];
                    if (is_numeric($value)) {
                        if ($value > $max) $this->addError($field, "{$fieldLabel} may not be greater than {$max}.");
                    } else {
                        if (mb_strlen((string)$value) > $max) $this->addError($field, "{$fieldLabel} may not exceed {$max} characters.");
                    }
                }

                // Matches / Confirmation
                if ($ruleName === 'matches') {
                    $matchField = $params[0];
                    if ($value !== ($this->data[$matchField] ?? null)) {
                        $matchLabel = ucfirst(str_replace(['_', '-'], ' ', $matchField));
                        $this->addError($field, "{$fieldLabel} does not match {$matchLabel}.");
                    }
                }

                // In enum values
                if ($ruleName === 'in') {
                    if (!in_array($value, $params)) {
                        $this->addError($field, "{$fieldLabel} has an invalid selection.");
                    }
                }

                // Numeric
                if ($ruleName === 'numeric' && !is_numeric($value)) {
                    $this->addError($field, "{$fieldLabel} must be a valid number.");
                }

                // Unique in DB table
                if ($ruleName === 'unique') {
                    $table = $params[0];
                    $column = $params[1] ?? $field;
                    $ignoreId = $params[2] ?? null;

                    $sql = "SELECT COUNT(*) FROM `{$table}` WHERE `{$column}` = :val";
                    $queryParams = ['val' => $value];

                    if (!empty($ignoreId)) {
                        $sql .= " AND `id` != :ignore_id";
                        $queryParams['ignore_id'] = $ignoreId;
                    }

                    $stmt = Database::getInstance()->prepare($sql);
                    $stmt->execute($queryParams);
                    if ($stmt->fetchColumn() > 0) {
                        $this->addError($field, "This {$fieldLabel} is already registered.");
                    }
                }
            }

            if (!isset($this->errors[$field])) {
                $this->validated[$field] = is_string($value) ? trim($value) : $value;
            }
        }
    }

    private function addError(string $field, string $message): void
    {
        if (!isset($this->errors[$field])) {
            $this->errors[$field] = [];
        }
        $this->errors[$field][] = $message;
    }

    public function passes(): bool
    {
        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function firstError(?string $field = null): ?string
    {
        if ($field !== null) {
            return $this->errors[$field][0] ?? null;
        }
        foreach ($this->errors as $fieldErrors) {
            if (!empty($fieldErrors)) {
                return $fieldErrors[0];
            }
        }
        return null;
    }

    public function validated(): array
    {
        return $this->validated;
    }
}
