<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenAIService;

class TaskController extends Controller
{
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function createTask(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:1000',
        ]);

        $aiResponse = $this->openAIService->generateTaskSuggestions($validated['description']);

        if (!$aiResponse) {
            return response()->json(['error' => 'AI could not generate suggestions'], 500);
        }

        $suggestions = json_decode($aiResponse, true);

        return response()->json([
            'message' => 'Task created successfully!',
            'suggestions' => $suggestions,
        ]);
    }
}
