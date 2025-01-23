<form id="register-form">
    <h1>@lang('Create Account')</h1>
    <input type="text" id="reg_name" name="name" required placeholder="@lang('Name(login)')" />
    <input type="email" id="reg_email" name="email" required placeholder="@lang('Email')" />
    <input type="password" id="reg_password" name="password" autocomplete="on" required placeholder="@lang('Password')" />
    <input type="password" id="reg_password_confirmation" name="password_confirmation" autocomplete="on" required placeholder="@lang('Password')" />
    <button type="submit">@lang('Sign Up')</button>
</form>
