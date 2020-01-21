window.jQuery = window.$ = require('jquery');
window.inView = require('in-view');

(function( root, $, undefined ) {
	"use strict";

	$(function () {

		// be magical

		$('#theme-header-hamburger').on('click',function(e) {
			$(this).toggleClass('active');

			if($(this).hasClass('active')) {
				$('#theme-header').addClass('light-mode');
				$('#theme-mobile-nav').addClass('active');
				$('body').addClass('no-scroll');
			}else{
				$('#theme-header').removeClass('light-mode');
				$('#theme-mobile-nav').removeClass('active');
				$('body').removeClass('no-scroll');
			}
		});

		$(window).on('scroll',function() {
			var scrollTop = $(window).scrollTop();

			if(!$('#theme-header').hasClass('fixed')) {
				if(scrollTop > 100) {
					$('#theme-header').addClass('fixed');
				}
			}else{
				if(scrollTop < 100) {
					$('#theme-header').removeClass('fixed');
				}
			}
		});

		inView.offset({
		    top: 0,
		    bottom: -400,
		});
		inView('.fx-when-in-view')
		    .on('enter', function(el) {
		    	console.log('in');
		    	$(el).addClass('animated fadeIn');
		    })
		    .on('exit', function(el) {
		    	console.log('out');
		    	$(el).removeClass('animated fadeIn');
		    });

	});

} ( this, jQuery ));
