<?php

namespace Services;

use Models\AiUsageLog;
use Models\Pet;
use Exception;

class AiService
{
    private string $apiKey;
    private string $model;
    private string $baseUrl;

    public function __construct()
    {
        $config = require dirname(__DIR__) . '/config/config.php';
        $this->apiKey = $config['ai']['api_key'] ?? '';
        $this->model = $config['ai']['model'] ?? 'meta-llama/llama-3.2-3b-instruct:free';
        $this->baseUrl = rtrim($config['ai']['base_url'] ?? 'https://openrouter.ai/api/v1', '/');
    }

    /**
     * Ask Pet Care Assistant
     */
    public function askAssistant(string $prompt, ?array $petContext = null, ?int $userId = null): array
    {
        $startTime = microtime(true);
        $safety = $this->classifySafety($prompt);

        // Emergency fast-path guidance
        if ($safety['is_emergency']) {
            $emergencyResponse = $this->buildEmergencyGuidance($prompt, $safety['reason']);
            $latency = (int)((microtime(true) - $startTime) * 1000);

            AiUsageLog::logUsage([
                'user_id' => $userId,
                'query_type' => 'emergency_triage',
                'model' => $this->model,
                'prompt' => $prompt,
                'tokens_used' => 120,
                'latency_ms' => $latency,
                'safety_status' => 'emergency',
                'status' => 'success'
            ]);

            return [
                'success' => true,
                'is_emergency' => true,
                'safety_alert' => $safety['reason'],
                'response' => $emergencyResponse,
                'model' => $this->model,
                'latency_ms' => $latency
            ];
        }

        // Build system prompt and context
        $systemPrompt = "You are the PetGuard AI Health & Wellness Assistant. 
You provide cautious, compassionate, evidence-based pet care guidance and educational information.
CRITICAL MEDICAL RULES:
1. You MUST NEVER state a definitive veterinary diagnosis. Use phrasing like 'Potential factors to discuss with your vet include...' or 'Common causes can include...'.
2. Always emphasize that this guidance does NOT replace a licensed veterinary examination.
3. If symptoms suggest sudden deterioration, direct the owner to their nearest emergency veterinary clinic.
4. Keep advice clear, supportive, and practical for pet parents.";

        if (!empty($petContext)) {
            $systemPrompt .= "\n\nPET PATIENT PROFILE: " . json_encode([
                'name' => $petContext['name'] ?? 'Pet',
                'species' => $petContext['species'] ?? 'Unknown',
                'breed' => $petContext['breed'] ?? 'Mixed',
                'age' => $petContext['age'] ?? 'Adult',
                'weight' => $petContext['weight'] ?? 'Standard',
                'vaccination_status' => $petContext['vaccination_status'] ?? 'Scheduled'
            ]);
        }

        // Call OpenRouter API
        $messages = [
            ['role' => 'system', 'content' => $systemPrompt],
            ['role' => 'user', 'content' => $prompt]
        ];

        try {
            $apiResult = $this->callOpenRouter($messages);
            $latency = (int)((microtime(true) - $startTime) * 1000);

            AiUsageLog::logUsage([
                'user_id' => $userId,
                'query_type' => 'pet_assistant',
                'model' => $this->model,
                'prompt' => $prompt,
                'tokens_used' => $apiResult['tokens'] ?? 150,
                'latency_ms' => $latency,
                'safety_status' => 'safe',
                'status' => 'success'
            ]);

            return [
                'success' => true,
                'is_emergency' => false,
                'response' => $apiResult['content'],
                'model' => $this->model,
                'tokens' => $apiResult['tokens'] ?? 0,
                'latency_ms' => $latency
            ];

        } catch (Exception $e) {
            $latency = (int)((microtime(true) - $startTime) * 1000);
            
            AiUsageLog::logUsage([
                'user_id' => $userId,
                'query_type' => 'pet_assistant',
                'model' => $this->model,
                'prompt' => $prompt,
                'tokens_used' => 0,
                'latency_ms' => $latency,
                'safety_status' => 'safe',
                'status' => 'failed',
                'error' => $e->getMessage()
            ]);

            // Graceful fallback response
            return [
                'success' => true,
                'is_emergency' => false,
                'is_fallback' => true,
                'response' => $this->generateEducationalFallback($prompt, $petContext),
                'model' => $this->model . ' (Local Fallback Engine)',
                'latency_ms' => $latency
            ];
        }
    }

    /**
     * Compute Explainable Pet Care Score (0-100)
     */
    public function calculateCareScore(array $pet): array
    {
        $score = 100;
        $factors = [];

        // Factor 1: Vaccination Status (30 pts)
        $vacStatus = strtolower($pet['vaccination_status'] ?? '');
        if (str_contains($vacStatus, 'up to date')) {
            $factors[] = ['name' => 'Vaccinations', 'impact' => '+30', 'status' => 'Optimal', 'detail' => 'All core immunizations are active.'];
        } elseif (str_contains($vacStatus, 'scheduled')) {
            $score -= 10;
            $factors[] = ['name' => 'Vaccinations', 'impact' => '+20', 'status' => 'Attention', 'detail' => 'Booster appointment scheduled.'];
        } else {
            $score -= 25;
            $factors[] = ['name' => 'Vaccinations', 'impact' => '+5', 'status' => 'Critical', 'detail' => 'Immunizations overdue. Schedule clinical review.'];
        }

        // Factor 2: Microchip & Digital Passport (20 pts)
        if (!empty($pet['microchip_id'])) {
            $factors[] = ['name' => 'Microchip Registry', 'impact' => '+20', 'status' => 'Optimal', 'detail' => "Microchip #{$pet['microchip_id']} registered."];
        } else {
            $score -= 15;
            $factors[] = ['name' => 'Microchip Registry', 'impact' => '+5', 'status' => 'Recommended', 'detail' => 'No microchip on file. Increases recovery risk if lost.'];
        }

        // Factor 3: Profile Completeness (25 pts)
        $profileFields = ['name', 'species', 'breed', 'gender', 'age', 'weight', 'blood_group'];
        $filled = 0;
        foreach ($profileFields as $f) {
            if (!empty($pet[$f])) $filled++;
        }
        $completenessRatio = $filled / count($profileFields);
        if ($completenessRatio >= 0.8) {
            $factors[] = ['name' => 'Health Profile Completeness', 'impact' => '+25', 'status' => 'Optimal', 'detail' => 'Comprehensive medical attributes recorded.'];
        } else {
            $score -= 10;
            $factors[] = ['name' => 'Health Profile Completeness', 'impact' => '+15', 'status' => 'Incomplete', 'detail' => 'Add blood group and specific history for complete indexing.'];
        }

        // Factor 4: Passport Status (25 pts)
        $passportStatus = $pet['passport_status'] ?? 'active';
        if ($passportStatus === 'active') {
            $factors[] = ['name' => 'Digital Pet Passport', 'impact' => '+25', 'status' => 'Optimal', 'detail' => 'Verified QR cryptographic health credential active.'];
        } else {
            $score -= 20;
            $factors[] = ['name' => 'Digital Pet Passport', 'impact' => '+5', 'status' => 'Revoked', 'detail' => 'Passport is currently deactivated or revoked.'];
        }

        $score = max(20, min(100, $score));

        return [
            'score' => $score,
            'grade' => $score >= 90 ? 'A+ (Excellent)' : ($score >= 75 ? 'B (Good)' : ($score >= 60 ? 'C (Fair)' : 'D (Needs Attention)')),
            'factors' => $factors,
            'summary' => "Pet Care Score for {$pet['name']} is {$score}/100. Regular clinical checkups and up-to-date immunizations keep scores in the top tier."
        ];
    }

    /**
     * Compute Smart Adoption Match Compatibility
     */
    public function matchAdoption(array $applicantData, array $pet): array
    {
        $compatibility = 70;
        $reasons = [];

        $living = strtolower($applicantData['living_arrangement'] ?? '');
        $experience = strtolower($applicantData['experience_level'] ?? '');
        $hasPets = !empty($applicantData['has_other_pets']);
        $species = strtolower($pet['species'] ?? 'dog');

        // Living Space match
        if (str_contains($living, 'yard') || str_contains($living, 'house')) {
            $compatibility += 15;
            $reasons[] = 'Spacious housing arrangement is ideal for active exercise routines.';
        } else {
            if ($species === 'dog' && (int)($pet['weight'] ?? 10) > 20) {
                $compatibility -= 10;
                $reasons[] = 'Apartment living may require dedicated daily high-energy park excursions.';
            } else {
                $compatibility += 10;
                $reasons[] = 'Living space aligns comfortably with pet size and profile.';
            }
        }

        // Experience match
        if (str_contains($experience, 'experienced') || str_contains($experience, 'lifelong')) {
            $compatibility += 15;
            $reasons[] = 'Strong history of prior pet ownership provides stable care continuity.';
        } else {
            $reasons[] = 'First-time pet parent guidance kit recommended upon adoption.';
        }

        $compatibility = min(98, max(45, $compatibility));

        return [
            'compatibility_score' => $compatibility,
            'match_tier' => $compatibility >= 85 ? 'High Compatibility' : ($compatibility >= 70 ? 'Moderate Compatibility' : 'Review Required'),
            'reasons' => $reasons,
            'recommendation' => $compatibility >= 80 ? 'Recommended for interview & home visit.' : 'Conduct detailed phone screening on exercise plans.'
        ];
    }

    /**
     * Safety Triage Classifier
     */
    private function classifySafety(string $prompt): array
    {
        $promptLower = strtolower($prompt);
        $emergencyKeywords = [
            'difficulty breathing' => 'Respiratory Distress',
            'cannot breathe' => 'Severe Dyspnea',
            'choking' => 'Airway Obstruction',
            'seizure' => 'Neurological Emergency',
            'convulsing' => 'Active Seizure Event',
            'unconscious' => 'Loss of Consciousness',
            'collapsed' => 'Acute Cardiovascular/Systemic Collapse',
            'severe bleeding' => 'Hemorrhage',
            'blood pouring' => 'Active Severe Bleeding',
            'hit by car' => 'Trauma / Internal Injury',
            'ate chocolate' => 'Potential Theobromine Toxicity',
            'ate antifreeze' => 'Critical Ethylene Glycol Toxicity',
            'rat poison' => 'Anticoagulant Rodenticide Toxicity',
            'swallowed toy' => 'Gastrointestinal Foreign Body Obstruction',
            'swallowed bone' => 'Gastrointestinal Perforation Risk',
            'swollen face' => 'Severe Acute Anaphylaxis / Allergic Reaction',
            'pale gums' => 'Circulatory Shock / Severe Anemia'
        ];

        foreach ($emergencyKeywords as $kw => $reason) {
            if (str_contains($promptLower, $kw)) {
                return ['is_emergency' => true, 'reason' => $reason];
            }
        }

        return ['is_emergency' => false, 'reason' => null];
    }

    /**
     * Build Emergency Response Protocol
     */
    private function buildEmergencyGuidance(string $prompt, string $reason): string
    {
        return "🚨 **URGENT EMERGENCY CARE ADVISORY: {$reason}**\n\n" .
               "Based on the symptoms described, this situation requires **immediate in-person veterinary intervention**.\n\n" .
               "### Critical Immediate Action Steps:\n" .
               "1. **Proceed to the Nearest Emergency Clinic**: Do not delay for online advice. Contact your closest 24/7 Veterinary Emergency Hospital.\n" .
               "2. **PetGuard Emergency Hotline**: Call `+1 (800) 555-PET-911` for direct triage coordination.\n" .
               "3. **Safe Transport**: Keep your pet warm, minimize movement, and ensure their airway remains clear during vehicle transport.\n" .
               "4. **Toxicity Precautions**: If poisoning or ingestion is suspected, bring the packaging, plant, or substance container with you to the clinic.\n\n" .
               "*Disclaimer: AI systems cannot diagnose or treat life-threatening medical emergencies. Please seek immediate professional veterinary care.*";
    }

    /**
     * HTTP Call to OpenRouter API
     */
    private function callOpenRouter(array $messages): array
    {
        if (empty($this->apiKey)) {
            throw new Exception("OpenRouter API key not configured.");
        }

        $url = $this->baseUrl . '/chat/completions';
        $payload = json_encode([
            'model' => $this->model,
            'messages' => $messages,
            'temperature' => 0.4,
            'max_tokens' => 600
        ]);

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->apiKey,
                'HTTP-Referer: http://localhost/petcaretw',
                'X-Title: PetGuard Platform'
            ],
            CURLOPT_TIMEOUT => 15,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_SSL_VERIFYPEER => false // Local dev compatibility
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($response === false) {
            throw new Exception("OpenRouter connection failed: " . $curlError);
        }

        if ($httpCode >= 400) {
            throw new Exception("OpenRouter API returned HTTP {$httpCode}: " . substr($response, 0, 200));
        }

        $json = json_decode($response, true);
        $content = $json['choices'][0]['message']['content'] ?? null;

        if (empty($content)) {
            throw new Exception("Invalid response structure from OpenRouter.");
        }

        return [
            'content' => trim($content),
            'tokens' => $json['usage']['total_tokens'] ?? 150
        ];
    }

    /**
     * Educational Fallback Engine
     */
    private function generateEducationalFallback(string $prompt, ?array $pet): string
    {
        $petName = $pet['name'] ?? 'your pet';
        $species = $pet['species'] ?? 'pet';

        return "### 🐾 Educational Wellness Guidance for {$petName}\n\n" .
               "Regarding your query: *\"" . htmlspecialchars(substr($prompt, 0, 100)) . "...\"*\n\n" .
               "**General Preventive Recommendations:**\n" .
               "- **Observation**: Monitor appetite, water consumption, energy levels, and bowel habits closely over the next 24 hours.\n" .
               "- **Hydration & Diet**: Ensure continuous access to clean fresh water. Maintain their standard balanced diet without sudden table scraps.\n" .
               "- **Clinical Scheduling**: For persistent symptoms, behavioral shifts, or wellness questions, we recommend booking a routine consultation with a verified veterinarian on PetGuard.\n\n" .
               "*Note: This informational overview is provided for general guidance. Consult your licensed veterinary practitioner for personalized diagnostic care.*";
    }
}
