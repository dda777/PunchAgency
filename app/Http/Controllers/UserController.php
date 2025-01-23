<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SendResetLinkEmailRequest;
use App\Http\Requests\UpdateSettingsRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'data' => Arr::only(Auth::user()->toArray(), ['google_auth_data', 'telegram_auth_data'])
            ]);
        } catch (Exception $exception) {
            Log::log('error', $exception->getMessage());
            return response()->json(['success' => false, 'message' => env_error($exception->getMessage())], 500);
        }
    }

    public function updateSettings(UpdateSettingsRequest $request): JsonResponse
    {
        try {
            User::find(Auth::id())->update([
                'google_auth_data' => json_decode($request->google_auth_data, true),
                'telegram_auth_data' => json_decode($request->telegram_auth_data, true)
            ]);
            return response()->json(['success' => true, 'message' => __('Settings updated successfully')]);
        } catch (Exception $exception) {
            Log::log('error', $exception->getMessage());
            return response()->json(['success' => false, 'message' => env_error($exception->getMessage())], 500);
        }
    }


}
