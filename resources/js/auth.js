import './bootstrap.js'

$(document).ready(function () {

    const urlParams = new URLSearchParams(window.location.search);
    const token = urlParams.get('token');
    if (token) {
        $('#reset-password-modal').removeClass('hidden');
        $('#reset-password-form #res_token').val(token);
        $('#container').addClass('hidden');
        urlParams.delete('token');
        window.history.replaceState({}, document.title, window.location.pathname);
    }

    $('#reset-password-form').on('submit', function (event) {
        event.preventDefault();
        const resetData = {
            token: $('#reset-password-form #res_token').val(),
            name: $('#reset-password-form #res_name').val(),
            email: $('#reset-password-form #res_email').val(),
            password: $('#reset-password-form #res_password').val(),
            password_confirmation: $('#reset-password-form #res_password_confirmation').val()
        };
        $.ajax({
            url: '/api/auth/password/reset',
            method: 'POST',
            data: resetData,
            success: function (response) {
                $('#message-block').text(response.message).removeClass('hidden').fadeIn().delay(500).fadeOut();
                $('#reset-password-modal').addClass('hidden');
            },
            error: function (error) {
                $('#message-block').text('Ошибка сброса пароля').removeClass('hidden').fadeIn().delay(500).fadeOut();
            }
        });
    });

    $('#login-form').on('submit', function (event) {
        event.preventDefault();
        const loginData = {
            login: $('#login-form #login').val(),
            password: $('#login-form #password').val()
        };
        $.ajax({
            url: '/api/auth/login',
            method: 'POST',
            data: loginData,
            success: function (response) {

                location.reload();
            }
        });
    });

    $('#forgot-password-btn').on('click', function (event) {
        $('#forgot-password-modal').removeClass('hidden');
    });

    $('#close-modal').on('click', function (event) {
        $('#forgot-password-modal').addClass('hidden');
    });

    $('#register-form').on('submit', function (event) {
        event.preventDefault();
        const registerData = {
            name: $('#register-form #reg_name').val(),
            email: $('#register-form #reg_email').val(),
            password: $('#register-form #reg_password').val(),
            password_confirmation: $('#register-form #reg_password_confirmation').val()
        };
        $.ajax({
            url: '/api/auth/register',
            method: 'POST',
            data: registerData,
            success: function () {
                location.reload();
            }
        });
    });

    $('#forgot-password-form').on('submit', function (event) {
        event.preventDefault();
        const registerData = {
            email: $('#forgot-password-form #forgot_email').val()
        };
        $.ajax({
            url: '/api/auth/password/email',
            method: 'POST',
            data: registerData,
            success: function () {
                showMessage('success', 'Лист з відновленням паролю відправлено на вашу пошту');
                $('#forgot-password-modal').addClass('hidden');
            },
            error: function () {
                showMessage('error', 'Помилка відправлення листа');
            }
        });
    });

    const container = $('#container');

    $('#signUp').on('click', function () {
        container.addClass('right-panel-active');
    });

    $('#signIn').on('click', function () {
        container.removeClass('right-panel-active');
    });

});
