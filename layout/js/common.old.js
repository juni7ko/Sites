(function( $ ) {
    "use strict";
     
    $(function() {

            /*------------------------------------------
               portfolio image hover       
            ------------------------------------------*/

            $(".gallery-area a").hover( function () {
                var mt = $(this).find('.gallery_box').outerHeight();
                
                $(this).find('.image').stop().animate({'opacity': 0.25}, 100);
                $(this).find('.gallery_box').stop().animate({'opacity': 1, 'top': '50%', 'margin-top': '-' + mt/2 + 'px'}, 300);
                $(this).find('.gallery_info').stop().animate({'opacity': 1, 'top': '280px'}, 1, function() {
                    $(this).removeAttr('style');
                });
                $(this).find('.gallery_info ul').stop().animate({'opacity': 0.25}, 100);
            }, function () {
                $(this).find('.image').stop().animate({'opacity': 1});
                $(this).find('.gallery_box').stop().animate({'opacity': 0, 'top': '90%'}, 300, function() {
                    $(this).removeAttr('style');
                });
                $(this).find('.gallery_info').stop().animate({'opacity': 0, 'top': '280px','z-index': '1'}, 1);
                $(this).find('.gallery_info ul').stop().animate({'opacity': 1});
            }); //gallery-area




            /*------------------------------------------
               portfolio image hover       
            ------------------------------------------*/

            $(".gallery-area").hover( function () {
            }, function () {
            }); //gallery-area
            
            
    }); //function
 
}(jQuery));