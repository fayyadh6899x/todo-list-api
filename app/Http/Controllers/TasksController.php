<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="API To-Do List Social Media Management",
 *     description="Dokumentasi API untuk manajemen to-do list di media sosial."
 * )
 *
 * @OA\Server(
 *     url="http://127.0.0.1:8000/api",
 *     description="Localhost API Server"
 * )
 *
 * @OA\Schema(
 *     schema="Post",
 *     type="object",
 *     title="Post",
 *     description="Schema untuk tugas",
 *     required={"title", "brand", "platform", "due_date", "priority", "status"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Membuat API"),
 *     @OA\Property(property="brand", type="string", example="Laravel"),
 *     @OA\Property(property="platform", type="string", example="Web"),
 *     @OA\Property(property="due_date", type="string", format="date", example="2025-02-20"),
 *     @OA\Property(property="payment", type="number", example=100.50),
 *     @OA\Property(property="priority", type="string", enum={"low", "medium", "high"}, example="high"),
 *     @OA\Property(property="status", type="string", enum={"pending", "canceled", "scheduled", "posted"}, default="pending"),
 *     @OA\Property(property="category", type="string", example="Development"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-02-19T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-02-19T12:00:00Z"),
 * )
 */

class TasksController extends Controller
{
   /**
     * @OA\Get(
     *     path="/tasks",
     *     summary="Ambil daftar semua tugas",
     *     tags={"Tasks"},
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil daftar tugas",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Post")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * @OA\Post(
     *     path="/tasks",
     *     summary="Buat tugas baru",
     *     tags={"Tasks"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Tugas berhasil dibuat",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'platform' => 'required|string|max:255',
            'due_date' => 'required|date',
            'payment' => 'nullable|numeric',
            'priority' => 'required|in:low,medium,high',
            'category' => 'nullable|string|max:255',
            'status' => 'required|in:pending,scheduled,posted,cancel'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Task failed to load',
                'data' => $validator->errors()
            ], 422);
        }

        $task = Post::create($validator->validated());

        return response()->json([
            'message' => 'Task added successfully',
            'data' => $task
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/tasks/{id}",
     *     summary="Ambil tugas berdasarkan ID",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task ditemukan",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(response=404, description="Task tidak ditemukan")
     * )
     */
    public function show(string $id)
    {
        $task = Post::find($id);
        if ($task) {
            return response()->json([
                'message' => "Task with id $id were successfully found",
                'data' => $task
            ]);
        }
        return response()->json(['message' => "Task with id $id not found"], 404);
    }

    /**
     * @OA\Put(
     *     path="/tasks/{id}",
     *     summary="Perbarui tugas berdasarkan ID",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task berhasil diperbarui",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(response=404, description="Task tidak ditemukan")
     * )
     */
    public function update(Request $request, string $id)
    {
        $task = Post::find($id);
        if (empty($task)) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'platform' => 'required|string|max:255',
            'due_date' => 'required|date',
            'payment' => 'nullable|numeric',
            'priority' => 'required|in:low,medium,high',
            'category' => 'nullable|string|max:255',
            'status' => 'required|in:pending,scheduled,posted,canceled'
        ]);

        $task->update($validator->validated());

        return response()->json(['message' => 'Task updated successfully', 'data' => $task]);
    }

    /**
     * @OA\Delete(
     *     path="/tasks/{id}",
     *     summary="Hapus tugas berdasarkan ID",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Task berhasil dihapus"),
     *     @OA\Response(response=404, description="Task tidak ditemukan")
     * )
     */
    public function destroy(string $id)
    {
        $task = Post::find($id);
        if (empty($task)) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }
}
