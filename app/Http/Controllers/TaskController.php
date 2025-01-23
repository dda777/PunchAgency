<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\IndexTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use App\Services\GoogleSheetService;
use App\Services\TelegramApi;
use Exception;
use Google\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Revolution\Google\Client\Facades\Google;
use Revolution\Google\Sheets\Facades\Sheets;
use Revolution\Google\Sheets\SheetsClient;

class TaskController extends Controller
{
    const FIRST_PAGE = 1;

    public function index(IndexTaskRequest $request): JsonResponse
    {
        return response()->json(
            [
                'data' => Task::orderBy('done_at' , 'ASC')->get(),
                'message' => __('Tasks fetched successfully')
            ]);
    }

    public function store(CreateTaskRequest $request): JsonResponse
    {
        Task::create(array_merge(['user_id' => auth()->id()], $request->all()));

        try {
            GoogleSheetService::appendRowToUserSpreadsheet($request->all());
            $telegramAuthData = json_decode(Auth::user()->telegram_auth_data, true);
            (new TelegramApi($telegramAuthData['bot_api_token']))->sendMessage(
                $telegramAuthData['channel_id'],
                __('Task created successfully') . "\n" . json_encode($request->all(), JSON_PRETTY_PRINT)
            );
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return response()->json(['message' => __('Task created successfully')]);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(Task::find($id));
    }

    public function update(StoreTaskRequest $request): JsonResponse
    {
        try {
            Task::find($request->id)->update($request->all());
            return response()->json(['message' => __('Task updated successfully')]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => __('Task update failed')], 500);
        }
    }

    public function delete(int $id): JsonResponse
    {
        Task::find($id)->delete();
        return response()->json(['message' => __('Task deleted successfully')]);
    }

}
