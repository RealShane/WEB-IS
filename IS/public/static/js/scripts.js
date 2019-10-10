(function($) {
	$(document).ready(function() {
		"use strict";
		
	// HOVER TOGGLE
		$('.side-navigation .menu ul li a').click(function () {
	  	$(this).parent().children('.side-navigation .menu ul li ul').slideToggle(300);
        return true;
	  	});
		
		
		
	// CONTACT FORM INPUT LABEL
		function checkForInput(element) {
			  const $label = $(element).siblings('span');
			  if ($(element).val().length > 0) {
				$label.addClass('label-up');
			  } else {
				$label.removeClass('label-up');
			  }
		}

		$('input, textarea').each(function() {
			  checkForInput(this);
		});

		$('input, textarea').on('change keyup', function() {
			  checkForInput(this);  
		});
		
		
		
	// TOOLTIP
		$('[data-toggle="tooltip"]').tooltip()
		
		
		
	// PARALLAX
			$.stellar({
				horizontalScrolling: false,
				verticalOffset: 0,
				responsive:true
			});
		
		
		
	// DROPDOWN
		$('.dropdown-toggle').dropdown()
	
	
	// HAMBURGER
		$('.hamburger').on('click', function(e) {
			$(this).toggleClass('open');
			$('body').toggleClass('overflow');
			$('.side-navigation').toggleClass('active');
		});
	
	
	
	// DATA BACKGROUND IMAGE
			var pageSection = $("*");
			pageSection.each(function(indx){
				if ($(this).attr("data-background")){
					$(this).css("background-image", "url(" + $(this).data("background") + ")");
				}
			});
		
		
		
	// PAGE TRANSITION
		$('body a').on('click', function(e) {
			
			if (typeof $( this ).data('fancybox', 'filter') == 'undefined') {
			e.preventDefault(); 	
			var url = this.getAttribute("href"); 
			if( url.indexOf('#') != -1 ) {
			var hash = url.substring(url.indexOf('#'));
				
		
			if( $('body ' + hash ).length != 0 ){
			$('.transition-overlay').removeClass("active");
			$(".hamburger").toggleClass("open");
			$(".navigation-menu").removeClass("active");


			$('html, body').animate({
			scrollTop: $(hash).offset().top
			}, 1300);

			}
			}
			else {
			$('.transition-overlay').toggleClass("active");
			setTimeout(function(){
			window.location = url;
			},1300); 

			}
			}
			});
		
			
		
		
	
		
	});	
		
	
	
	// COUNTER
			 $(document).scroll(function(){
				$('.odometer').each( function () {
					var parent_section_postion = $(this).closest('section').position();
					var parent_section_top = parent_section_postion.top;
					if ($(document).scrollTop() > parent_section_top - 300) {
						if ($(this).data('status') == 'yes') {
							$(this).html( $(this).data('count') );
							$(this).data('status', 'no')
						}
					}
				});
			});
	
	
	
	
	/* GALLERY SLIDER */
	var swiper = new Swiper('.gallery-container', {
		slidesPerView: 'auto',
      	spaceBetween: 0,
		loop: true,
		autoplay: {
			delay: 4500,
			disableOnInteraction: false,
      	},
      	pagination: {
			el: '.gallery-pagination',
			clickable: true,
      },
    });
	
	
	
	
	// SLIDER
	var swiper = new Swiper('.slider-container', {
		touchRatio: 0,
		loop: true,
		speed: 600,
		autoplay: {
			delay: 4500,
			disableOnInteraction: false,
      	},
      	pagination: {
			el: '.pagination',
			type: 'fraction',
      	},
      	navigation: {
			nextEl: '.button-next',
			prevEl: '.button-prev',
      	},
    });
	
	
	
	// MASONRY
			$(window).load(function(){
				$('.gallery').isotope({
				  itemSelector: '.gallery li',
				  percentPosition: true
				});
			});
		
		
	
		// ISOTOPE FILTER
			var $container = $('.gallery');
			$container.isotope({
			filter: '*',
			animationOptions: {
			duration: 750,
			easing: 'linear',
			queue: false
			}
			});

			$('.gallery-filter li a').click(function(){
			$('.gallery-filter li a.current').removeClass('current');
			$(this).addClass('current');

			var selector = $(this).attr('data-filter');
			$container.isotope({
				filter: selector,
				animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false
				}
			});
			return false;
			}); 
	
	
	
		// WOW ANIMATION 
			wow = new WOW(
				{
					boxClass:     'wow',      // default
					animateClass: 'animated', // default
					offset:       100,          // default
					mobile:       true,       // default
					live:         true        // default
				}
			)
			wow.init();
			
	
	
	// PRELOADER
			$(window).load(function(){
				$("body").addClass("page-loaded");	
			});
	
		
		
})(jQuery);