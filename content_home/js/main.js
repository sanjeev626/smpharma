$(document).ready(function() {
	//scrollTo top function
	// hide #back-top first
	$(".scrollToTop").hide();

	// fade in #back-top
	$(function() {
		$(window).scroll(function() {
			if ($(this).scrollTop() > 100) {
				$('.scrollToTop').fadeIn();
			} else {
				$('.scrollToTop').fadeOut();
			}
		});

		// scroll body to 0px on click
		$('.scrollToTop').click(function() {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});




	$('.navbar .dropdown').hover(function() {
			$(this).find('.dropdown-menu').first().stop(true, true).delay(250).slideDown();

		}, function() {
			$(this).find('.dropdown-menu').first().stop(true, true).delay(250).slideUp();

		});

		$('.navbar .dropdown > a').click(function(){
			location.href = this.href;
		});



	//add class on image

	$("img").addClass("img-responsive");
    /*$(".table img").removeClass("img-responsive");*/

    //custom scroll

    $(window).load(function () {
        $(".demo").customScrollbar();
        $("#fixed-thumb-size-demo").customScrollbar();
        $("#vertical-horizontal-scrollbar-demo").customScrollbar();
        $("#horizontal-scrollbar-demo").customScrollbar();
    });
    
    
    // subscribe
    $("#hide").click(function(){
        $(".subscribe-body").hide();
    });
    $("#show").click(function(){
        $(".subscribe-body").show();
    });
    
    

 
 //bootstrap-carousel
    
        $('#myCarousel').carousel({
          interval: 4000
        })
    
    
    

});
