jQuery(function($) {
    $('.form-label').on('click', function(){
        $(this).find('.check').toggleClass('active');
    });
});