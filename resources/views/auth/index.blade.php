<div class="body">
    @include('auth.modal.reset-password')
    @include('auth.modal.forgot-your-password')
    <div class="fixed inset-0 w-full h-full bg-black/50"></div>
    <div class="container z-0" id="container">
        <div class="form-container sign-up-container">
            @include('auth.register')
        </div>
        <div class="form-container sign-in-container">
            @include('auth.login')
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>@lang('Welcome Back!')</h1>
                    <p>
                        @lang('To keep connected with us please login with your personal info')
                    </p>
                    <button class="ghost" id="signIn">@lang('Sign In')</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>@lang('Hello, Friend!')</h1>
                    <p>@lang('Enter your personal details and start journey with us')</p>
                    <button class="ghost" id="signUp">@lang('Sign Up')</button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        @vite('resources/js/auth.js')
    @endpush

</div>


