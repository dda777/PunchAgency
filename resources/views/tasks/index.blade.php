<header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
    <nav class="-mx-3 flex flex-1 justify-center">
        <h1 class="text-2xl font-bold">@lang('Task Dashboard')</h1>
    </nav>
    <nav class="-mx-3 flex flex-1 justify-center">
        <div id="task-summary" class="mt-2">@lang('Task done count'): 0/0</div>
    </nav>
    <nav class="-mx-3 flex flex-1 justify-end pr-5">
        <button type="submit" id="logout" class="bg-red-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-red-600">
            @lang('Logout')
        </button>
    </nav>

</header>
<main class="container" id="container">
    <section id="task-list" class="mb-6">
        <h2 class="text-xl font-semibold mb-4">@lang('Task list')</h2>
        <ul id="tasks" class="list-disc pl-5"></ul>
    </section>
    <button id="create-task-form-modal"
            class="bg-blue-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-600">@lang('Create task')
    </button>
    @include('tasks.modal.form')
</main>
@push('scripts')
    @vite('resources/js/tasks.js')
@endpush
