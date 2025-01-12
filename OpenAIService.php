<?php

namespace App\Services;

use GuzzleHttp\Client;

class OpenAIService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.openai.com/v1/',
        ]);
    }

    public function generateTaskSuggestions($description)
    {
        $response = $this->client->post('completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type'  => 'application/json',
            ],
            'json' => [
                'model' => 'text-davinci-003',
                'prompt' => "Analyze this task description: '$description'. Suggest the task format, estimated time, and pricing in JSON format.",
                'max_tokens' => 150,
                'temperature' => 0.7,
            ],
        ]);

        $body = json_decode($response->getBody(), true);

        return $body['choices'][0]['text'] ?? null;
    }
}
