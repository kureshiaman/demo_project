jQuery(window).on('load', function() {
	jQuery("#loader").delay(2000).fadeOut("slow");
})

var headerwrap = jQuery('.header-wrap' );
jQuery(window).on('load scroll', function () {
	if ( jQuery(this).scrollTop() > 0 ) {
		headerwrap.addClass( "sticky" );
	} else {
		headerwrap.removeClass( "sticky" );
	}
});

jQuery( document ).ready( function () {
	jQuery('.menu-bar > button').on('click', function(){
		jQuery('.sidemenu').toggleClass('active');
	})

	// SVG Create
	jQuery(function(){
		jQuery('img.svg').each(function(){
			var $img = jQuery(this);
			var imgID = $img.attr('id');
			var imgClass = $img.attr('class');
			var imgURL = $img.attr('src');
			jQuery.get(imgURL, function(data) {
				var $svg = jQuery(data).find('svg');
				if(typeof imgID !== 'undefined') {
					$svg = $svg.attr('id', imgID);
				}
				if(typeof imgClass !== 'undefined') {
					$svg = $svg.attr('class', imgClass+' replaced-svg');
				}
				$svg = $svg.removeAttr('xmlns:a');
				if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
					$svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'));
				}
				$img.replaceWith($svg);
			}, 'xml');
		});
	});

	var playBtn = jQuery('.audio-btn button, .audio-btn a');
	jQuery(playBtn).on('click', function () {
		var parentLi = jQuery(this).parents('li');
		var audio = parentLi.find('audio')[0];
		if (audio) {
				jQuery(this).toggleClass('active');
				if (jQuery(this).hasClass('active')) {
					jQuery(playBtn).not(this).removeClass('active');
					jQuery('audio').not(audio).each(function () {
							this.pause();
					});
					audio.currentTime = 0;
					audio.play();
				} else {
					audio.pause();
				}
		} else {
			jQuery(playBtn).removeClass('active');
			jQuery('audio').each(function () {
				this.pause();
				this.currentTime = 0;
			});
		}
	});

});

var testimonialSlider = new Swiper(".testimonial-slider", {
	slidesPerView: 1,
	spaceBetween: 20,
	loop: true,
	speed: 1800,
	centeredSlides: true,
	autoplay: {
		delay: 3000,
		disableOnInteraction: false,
	},
	pagination: {
		el: ".testimonial-slider-pagination",
		clickable: true
	},
	breakpoints: {
		768: {
			spaceBetween: 50,
		},
		992: {
			spaceBetween: 71,
		},
	},
});