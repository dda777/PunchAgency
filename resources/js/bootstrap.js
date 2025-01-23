import jquery from 'jquery';
window.$ = jquery;
$.ajaxSetup({
    headers:
        { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

function showMessage(type, message) {
    let messageBlock = $('#message-block');
    messageBlock.text(message);
    if (type === 'error') {
        messageBlock.addClass('border-red-600').removeClass('border-green-600');
    } else {
        messageBlock.addClass('border-green-600').removeClass('border-red-600');
    }

    messageBlock.removeClass('hidden')
        .fadeIn()
        .delay(3000)
        .fadeOut();

}

window.showMessage = showMessage;


