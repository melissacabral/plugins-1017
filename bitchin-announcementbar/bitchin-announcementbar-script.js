jQuery.noConflict();
jQuery(window).scroll(function(e){
    //if the scroll is beyond the bitchin bar make it sticky
    if( jQuery(window).scrollTop() > jQuery('#bitchin_announcement').outerHeight()){
        jQuery('#bitchin_announcement').addClass('is_sticky');
    }else{
        jQuery('#bitchin_announcement').removeClass('is_sticky');
    } 
})