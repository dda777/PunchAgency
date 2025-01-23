<?php
if (!function_exists('env_error')) {
    function env_error(string $error, string $default = 'Server error'): string
    {
        if (env('APP_DEBUG') && env('APP_ENV') === 'development') {
            return $error;
        }

        return $default;
    }
}
