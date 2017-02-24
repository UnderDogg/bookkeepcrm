// GENERAL LABEL HIGHLIGHTERS
$('.form-group input, .form-group textarea').focus(function () {
    $(this).closest('.form-group').find('.form-group__label').addClass('form-group__label--focus');
});

$('.form-group input, .form-group textarea').blur(function () {
    $(this).closest('.form-group').find('.form-group__label').removeClass('form-group__label--focus');
});

// PASSWORD FIELDS
$('.form-group--password').each(function () {
    new PasswordMeter($(this));
});

// DATE FIELDS
$.datetimepicker.setLocale(window.locale);
$('.form-group--datetime').each(function() {
    $(this).find('input[type="text"]').datetimepicker({
        format:'Y-m-d H:i:s',
    });
});