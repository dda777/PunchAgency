<header class="flex items-center flex-wrap justify-between">
    <nav class="mx-3 justify-start">
        <h1 class="text-2xl font-bold">@lang('Task Dashboard')</h1>
    </nav>
    <nav class="mx-3 justify-center">
        <div id="task-summary" class="mt-2">@lang('Task done count'): 0/0</div>
    </nav>
    <nav class="mx-3 justify-end">
        <button type="submit" id="logout" class="bg-red-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-red-600">
            @lang('Logout')
        </button>
    </nav>

</header>
<div id="container">
    <h2 class="text-2xl font-semibold mb-4 text-center pt-6">@lang('Task list')</h2>
    <div class="flex justify-center">
        <button id="create-task-form-modal"
                class="text-center bg-blue-800 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-900">@lang('Create task')
        </button>
    </div>


    <div id="task-list" class="mb-6 flex justify-center items-center flex-col">
        <h2 class="text-2xl font-semibold mb-4 text-left pt-6 text-green-700 ">Виконані таски</h2>
        <ul id="done_tasks" class="list-disc p-5" style="width: 90%"></ul>
    </div>


    <div id="task-list" class="mb-6 flex justify-center items-center flex-col">
        <h2 class="text-2xl font-semibold mb-4 text-left pt-6 text-yellow-600 ">Не виконані таски</h2>
        <ul id="incomplete_tasks" class="list-disc p-5" style="width: 90%"></ul>
    </div>

    <div id="task-list" class="mb-6 flex justify-center items-center flex-col">
        <h2 class="text-2xl font-semibold mb-4 text-left pt-6 text-red-700 ">Протерміновані таски</h2>
        <ul id="overdue_task" class="list-disc p-5" style="width: 90%"></ul>
    </div>

    @include('tasks.modal.form')
    @include('tasks.modal.view')
</div>
@push('scripts')
    @vite('resources/js/tasks.js')
@endpush
