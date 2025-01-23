<div id="task-view-modal" class="modal hidden fixed inset-0 flex items-center justify-center z-10">
    <div class="fixed inset-0 w-full h-full bg-black/50 z-5"></div>
    <div class="flex items-center justify-center min-h-screen z-10 container">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
            <div class="flex justify-between items-center pb-5 bg-gray-200 rounded-ss-lg rounded-se-lg px-10 pt-5">
                <h2 class="text-xl font-semibold">@lang('Task detail')</h2>
                <button id="close-view-modal" class="text-black" type="button">&times;</button>
            </div>
            <div class="container p-8">
                <p class="font-bold pb-2">
                    @lang('Title'): <span class="font-normal text-wrap break-all" id="view_title"></span>
                </p>
                <p class="font-bold pb-2">
                    @lang('Description'): <span class="font-normal text-wrap break-all" id="view_description"></span>
                </p>
                <p class="font-bold pb-2">
                    @lang('Status'): <span class="font-normal text-wrap break-all" id="view_is_done"></span>
                </p>
                <p class="font-bold pb-2">
                    @lang('Done at'): <span class="font-normal text-wrap break-all" id="view_done_at"></span>
                </p>

            </div>

        </div>
    </div>
</div>



