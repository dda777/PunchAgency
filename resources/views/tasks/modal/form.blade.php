<div id="task-form-modal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center pb-3">
                <h2 class="text-xl font-semibold">Создать задачу</h2>
                <button id="close-task-form-modal" class="text-black">&times;</button>
            </div>
            <form id="new-task-form" class="space-y-4">
                @csrf
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Название:</label>
                    <input type="text" id="title" name="title" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Описание:</label>
                    <textarea id="description" name="description" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                </div>
                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-700">Дата выполнения:</label>
                    <input type="date" id="due_date" name="due_date" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Статус:</label>
                    <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="0">Не выполнена</option>
                        <option value="1">Выполнена</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-600">Создать</button>
            </form>
        </div>
    </div>
</div>

