<form id="login-form">
    <h1>@lang('Sign In')</h1>
    <input type="text" name="login" id="login" placeholder="@lang('Login')"/>
    <input type="password" name="password" id="password" autocomplete="on" placeholder="@lang('Password')"/>
    <button type="button" id="forgot-password-btn"
            class="font-normal text-black bg-transparent border-none text-xs normal-case"> @lang('Forgot your password?') </button>
    <button class="auth-btn" type="submit">@lang('Sign In')</button>
</form>
