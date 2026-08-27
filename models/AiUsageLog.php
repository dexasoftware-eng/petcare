<?php

namespace Models;

use Core\Model;

class AiUsageLog extends Model
{
    protected static string $table = 'ai_usage_logs';

    public static function logUsage(array $data): int|string
    {
        return self::create([
            'user_id' => $data['user_id'] ?? null,
            'query_type' => $data['query_type'] ?? 'general_assistant',
            'model' => $data['model'] ?? 'meta-llama/llama-3.2-3b-instruct:free',
            'prompt_preview' => substr($data['prompt'] ?? '', 0, 250),
            'tokens_used' => $data['tokens_used'] ?? 0,
            'latency_ms' => $data['latency_ms'] ?? 0,
            'safety_status' => $data['safety_status'] ?? 'safe',
            'status' => $data['status'] ?? 'success',
            'error_message' => isset($data['error']) ? substr($data['error'], 0, 250) : null
        ]);
    }
}
