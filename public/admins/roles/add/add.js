$(function () {
    $('.checkbox_wrapper').on('click', function () {
        $(this).parents('.card').find('.checkbox_children').prop('checked', $(this).prop('checked'));
        $(this).parents('.card').find('.checkbox_wrapper').prop('checked', $(this).prop('checked'));
    });
    $('#checkall').on('click', function () {
        $(this).parents('.checkboxcard').find('.checkbox_children').prop('checked', $(this).prop('checked'));
        $(this).parents('.checkboxcard').find('.checkbox_wrapper').prop('checked', $(this).prop('checked'));
    });
});
