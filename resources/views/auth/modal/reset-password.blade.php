<div id="reset-password-modal" class="modal hidden fixed inset-0 flex items-center justify-center z-10">
    <div class="solo-container">
        <div class="solo-form-container">
            <form id="reset-password-form">
                <h1>@lang('Reset password')</h1>
                <input type="hidden" name="token" id="res_token">
                <input type="text" name="name" id="res_name" placeholder="@lang('Name(Login)')" required>
                <input type="email" name="email" id="res_email" placeholder="@lang('Email')" required>
                <input type="password" name="password" id="res_password" required autocomplete="on" placeholder="@lang('Password')">
                <input type="password" name="password_confirmation" id="res_password_confirmation" required autocomplete="on" placeholder="@lang('Password')">
                <button type="submit">@lang('Reset') </button>
            </form>
        </div>
    </div>
</div>
