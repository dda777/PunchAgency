<div id="forgot-password-modal" class="modal hidden fixed inset-0 flex items-center justify-center z-10" tabindex="-1" aria-hidden="true">
    <div class="fixed inset-0 w-full h-full bg-black/50"></div>
    <div class="solo-container">
        <div class="solo-form-container">
            <div class="flex bg-white rounded-lg flex-col items-end">
                <button class="close-modal text-black text-2xl font-bold bg-transparent border-none pt-2 pb-2 pr-4
" aria-label="@lang('Close')" id="close-modal">&times;</button>
                <form id="forgot-password-form">

                    <h1>@lang('Forgot password?')</h1>
                    <input type="email" name="email" id="forgot_email" placeholder="@lang('Email')" required="">
                    <button type="submit">@lang('Reset') </button>
                </form>
            </div>
        </div>
    </div>
</div>


