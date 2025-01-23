<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\IndexTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    const FIRST_PAGE = 1;

    public function index(IndexTaskRequest $request): JsonResponse
    {
        dd($request->session());
        if ($request->page == self::FIRST_PAGE) {
            $offset = 0;
        } else {
            $offset = ($request->page - self::FIRST_PAGE) * $request->limit;
        }

        return response()->json(
            [
                'data' => Task::limit($request->limit)->offset($offset)->get(),
                'message' => __('Tasks fetched successfully')
            ]);
    }

    public function create(CreateTaskRequest $request): JsonResponse
    {
        Task::create($request->all());
        return response()->json(['message' => __('Task created successfully')]);
    }

    public function update(StoreTaskRequest $request): JsonResponse
    {
        Task::find($request->id)->update($request->all());
        return response()->json(['message' => __('Task updated successfully')]);
    }

    public function delete(int $id): JsonResponse
    {
        Task::find($id)->delete();
        return response()->json(['message' => __('Task deleted successfully')]);
    }

}
