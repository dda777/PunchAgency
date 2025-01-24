<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use App\Models\User;
use App\Services\GoogleSheetService;
use App\Services\TelegramApi;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            [
                'data' => Task::all(['id', 'name', 'is_done', 'done_at']),
                'message' => __('Tasks fetched successfully')
            ]);
    }

    public function store(CreateTaskRequest $request): JsonResponse
    {
        Task::create(array_merge(['user_id' => auth()->id()], $request->all()));

        try {
            /**
             * @var User $user
             **/
            $user = Auth::user();

            GoogleSheetService::appendRowToUserSpreadsheet($request->all(), $user);

            if ($tgAuthData = $user->telegram_auth_data) {
                $telegramAuthData = json_decode($tgAuthData, true);
                (new TelegramApi($telegramAuthData['bot_api_token']))->sendMessage(
                    $telegramAuthData['channel_id'],
                    __('Task created successfully') . "\n" . json_encode($request->all(), JSON_PRETTY_PRINT)
                );
            }
        } catch (Exception|GuzzleException $e) {
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
