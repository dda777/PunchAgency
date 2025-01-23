<div id="settings-form-modal" class="modal hidden fixed inset-0 flex items-center justify-center z-10 overflow-y-auto">
    <div class="fixed inset-0 w-full h-full bg-black/50 z-5"></div>
    <div class="flex items-center justify-center min-h-screen z-10 container">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center pb-3">
                <h2 class="text-xl font-semibold">@lang('Setup settings')</h2>
                <button id="close-settings-form-modal" class="text-black">&times;</button>
            </div>
            <form id="settings-form" class="overflow-y-auto">
                <div class="py-3">
                    <label for="telegram_auth_data" class="block mb-2 text-sm font-medium text-gray-900 ">@lang('Telegram auth data')</label>
                    <textarea id="telegram_auth_data" name="telegram_auth_data" required class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div class="py-3">
                    <label for="google_auth_data" class="block mb-2 text-sm font-medium text-gray-900 ">@lang('Google auth data')</label>
                    <textarea id="google_auth_data" name="google_auth_data" required class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div class="flex">
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-600 m-6">@lang('Update')</button>
                    <button type="button" id="close-btn-settings-form-modal" class="w-full bg-red-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-red-600 m-6">@lang('Close')</button>
                </div>

            </form>
        </div>
    </div>
</div>



