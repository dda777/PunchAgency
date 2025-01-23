<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SendResetLinkEmailRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $credentials = ['name' => $request->login, 'password' => $request->password];

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return response()->json(['success' => true, 'message' => __('You are logged in')]);
            }

            return response()->json(['success' => false, 'message' => __('Invalid credentials')], 401);
        } catch (Exception $exception) {
            Log::log('error', $exception->getMessage());
            return response()->json(['success' => false, 'message' => env_error($exception->getMessage())], 500);
        }
    }

    public function register(RegistrationRequest $request): JsonResponse
    {
        try {
            $user = User::create(
                ['name' => $request->name, 'email' => $request->email, 'password' => bcrypt($request->password)]
            );

            $user->createToken('auth_token', ['tasks']);

            Auth::loginUsingId($user->id);

            return response()->json(['success' => true, 'message' => __('Registration successful')]);
        } catch (Exception $exception) {
            Log::log('error', $exception->getMessage());
            return response()->json(['success' => false, 'message' => env_error($exception->getMessage())], 500);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        try {
            Auth::logout();
            $request->session()->invalidate();

            $request->session()->regenerateToken();
            return response()->json(['success' => true, 'message' => __('Successfully logged out')]);
        } catch (Exception $exception) {
            Log::log('error', $exception->getMessage());
            return response()->json(['success' => false, 'message' => env_error($exception->getMessage())], 500);
        }
    }

    public function sendResetLinkEmail(SendResetLinkEmailRequest $request): JsonResponse
    {
        try {
            $status = Password::sendResetLink($request->only('email'));
            return $status === Password::ResetLinkSent
                ? response()->json(['success' => true, 'message' => __($status)])
                : response()->json(['success' => false, 'message' => __($status)]);
        } catch (Exception $exception) {
            Log::log('error', $exception->getMessage());
            return response()->json(['success' => false, 'message' => env_error($exception->getMessage())], 500);
        }
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        try {
            $status = Password::reset(
                $request->only('name', 'password', 'password_confirmation', 'token'),
                function (User $user, string $password) {
                    $user->password = bcrypt($password);
                    $user->save();
                }
            );

            return $status === Password::PASSWORD_RESET
                ? response()->json(['success' => true, 'message' => __('Password reset successfully')])
                : response()->json(['success' => false, 'message' => __('Password reset failed')], 400);
        } catch (Exception $exception) {
            Log::log('error', $exception->getMessage());
            return response()->json(['success' => false, 'message' => env_error($exception->getMessage())], 500);
        }
    }
}
