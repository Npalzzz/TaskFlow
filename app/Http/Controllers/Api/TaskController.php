<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    /**
     * Menampilkan daftar task.
     */
    public function index(): JsonResponse
    {
        $tasks = Task::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data task berhasil diambil.',
            'data' => TaskResource::collection($tasks),
        ]);
    }

    /**
     * Menampilkan detail task berdasarkan ID.
     */
    public function show(Task $task): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail task berhasil diambil.',
            'data' => new TaskResource($task),
        ]);
    }
}