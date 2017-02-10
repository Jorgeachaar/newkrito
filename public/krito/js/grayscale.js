/*!
 * Start Bootstrap - Grayscale Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

// jQuery to collapse the navbar on scroll
$(window).scroll(function() {
    if (location.pathname === '/')
    {  
        if ($(".navbar").offset().top > 50) {
            $(".navbar-fixed-top").addClass("top-nav-collapse");
            $(".navbar-brand>img").show();
        } else {
            $(".navbar-fixed-top").removeClass("top-nav-collapse");
            $(".navbar-brand>img").removeClass("top-nav-img");
            $(".navbar-brand>img").hide();
        }
    }

    var y = $(this).scrollTop();
    var ventana_alto = $(window).height() / 2;
    var posAbout = $('#about').offset().top - ventana_alto ;

    if (y >= posAbout) {
        $('#imgabout').removeClass('imgabouta');    
        $('#imgabout').addClass('imgabout');

        $('#abouttext').removeClass('abouttexta');    
        $('#abouttext').addClass('abouttext');
    }
    else {
        $('#imgabout').removeClass('imgabout');    
        $('#imgabout').addClass('imgabouta');

        $('#abouttext').removeClass('abouttext');    
        $('#abouttext').addClass('abouttexta');
    };

});

// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    if (location.pathname === '/')
    {        
        $('a.page-scroll').bind('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top
            }, 2500, 'easeInOutExpo');
            event.preventDefault();
        });
    }else
    {
        $(".navbar-fixed-top").addClass("top-nav-collapse");

        $("a.page-scroll").each(function (index) {
            var $anchor = $(this);
            var newHref = "/" + $anchor.attr('href');
            $anchor.attr('href', newHref);   
        });
    }
});

//Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function() {
    var ttogle = $(this).data("toggle");
    if (ttogle !== "dropdown") {
        $('.navbar-toggle:visible').click();        
    };
});


