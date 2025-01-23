<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css'])
</head>
<body>

    @auth
        @include('tasks.index')
    @else
        @include('auth.index')
    @endauth
    <div id="message-block" class="fixed bottom-0 left-0 mb-4 ml-4 bg-white border-2 rounded-xl p-6 hidden"></div>
    @stack('scripts')
</body>
</html>
