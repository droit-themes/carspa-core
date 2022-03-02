;
jQuery(function(){
    "use strict"
    $(document).on('click', '.display-booking-form-button', function(e){
        e.preventDefault();
        console.log('click');
        $(this).parents('.elementor-button-wrapper').siblings('.display-booking-form').fadeIn();
       
    });

    $(document).on('click', '.close-booking-form', function(e){
        e.preventDefault();
        $(this).parents('.display-booking-form').fadeOut();
    });

});