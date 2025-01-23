<div id="task-form-modal" class="modal hidden fixed inset-0 flex items-center justify-center z-10">
    <div class="fixed inset-0 w-full h-full bg-black/50 z-5"></div>
    <div class="flex items-center justify-center min-h-screen z-10 container">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center pb-3">
                <h2 class="text-xl font-semibold">@lang('Create task')</h2>
                <button id="close-task-form-modal" class="text-black">&times;</button>
            </div>
            <form id="new-task-form" >
                <div class="py-3">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 ">@lang('Name')</label>
                    <input type="text" id="title" name="title" required class="p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="py-3">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">@lang('Description')</label>
                    <textarea id="description" name="description" required class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div class="py-3">
                    <label for="done_at" class="block mb-2 text-sm font-medium text-gray-900 ">@lang('Done at')</label>
                    <input type="date" id="done_at" name="done_at" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="py-3">
                    <label for="is_done" class="block mb-2 text-sm font-medium text-gray-900">@lang('Status')</label>
                    <select id="is_done" name="is_done" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                        <option value="0">@lang('Not done')</option>
                        <option value="1">@lang('Done')</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-600 mt-6">@lang('Create')</button>
            </form>
        </div>
    </div>

</div>

<div id="task-form-moda1l" class="modal hidden fixed inset-0 flex items-center justify-center z-10" tabindex="-1" aria-hidden="true">
    <div class="solo-container">
        <div class="solo-form-container">
            <div class="flex bg-white rounded-lg flex-col items-end">
                <h2 class="text-xl font-semibold">@lang('Create task')</h2>
                <button id="close-modal" class="close-modal text-black text-2xl font-bold bg-transparent border-none pt-2 pb-2 pr-4">&times;</button>
                <form id="new-task-form">
                    <input type="text" id="title" name="title" required  placeholder="@lang('Name')">
                    <textarea id="description" name="description" required placeholder="@lang('Name')"></textarea>
                    <input type="date" id="done_at" name="done_at" placeholder="@lang('Done at')">
                    <label for="is_done" class="block text-sm font-medium text-gray-700">@lang('Status')</label>
                    <select id="is_done" name="is_done" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="0">@lang('Not done')</option>
                        <option value="1">@lang('Done')</option>
                    </select>
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-600">@lang('Create')</button>
                </form>
            </div>
        </div>
    </div>
</div>


