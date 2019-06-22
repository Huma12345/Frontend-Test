jQuery( document ).ready( function( $ ) {

	/* show or hide box if session set */
	if ( sessionStorage.getItem( options.session_name ) !== 'true' ) {
	$( '.psag' ).css( 'display', 'table' );
	$( '.overlay-verify' ).css( 'display', 'block' );
	} else {
		$( options.blur_container ).css('filter', 'blur(0px)');
	}

	/* exit button */
	$( '#reset-session' ).on( 'click',function() {
		if ( 'off' == options.test_mode ) {
			window.location.href = options.exit_url;
		}
	} );

	/*
	age verification modes 
	*/

	/* yes or no */
	if ( 'age-submit' == options.display_mode ) {

		$( '#refresh-page' ).on( 'click',function() {
			if ( 'off' == options.test_mode ) {
				$( '.psag' ).hide();
				$( '.overlay-verify' ).hide();
				sessionStorage.setItem( options.session_name, 'true' );
				$( options.blur_container ).css('filter', 'blur(0px)');
			}
		} );
	}

	/* date selection */
	if ( 'age-select' == options.display_mode ) {

		$( '#age-check' ).on( 'click', ( function() {

			var day    = $( '#psag-day' ).val();
			var month  = $( '#psag-month' ).val();
			var year   = $( '#psag-year' ).val();
			var age    = options.age;
			var mydate = new Date();

			mydate.setFullYear( year, month - 1, day);

			var currdate = new Date();

			currdate.setFullYear( currdate.getFullYear() - age );

			if ( ( currdate - mydate ) < 0 ) {
				$( '.age-message' ).html( '<p>' + options.error_message + '</p>' );
				return false;
			}
			if ( 'off' == options.test_mode ) {
				$( '.psag' ).hide();
				$( '.overlay-verify' ).hide();
				sessionStorage.setItem( options.session_name, 'true' );
				$( options.blur_container ).css('filter', 'blur(0px)');
			}
			
		} ) );
	}

	/* range slider */
	if ( 'age-slider' == options.display_mode ) {
		
		var rangeSlider = function(){
			var slider = $('.range-slider'),
				range = $('.range-slider__range'),
				value = $('.range-slider__value');
				
			slider.each(function(){

				value.each(function(){
				var value = $(this).prev().attr('value');
				$(this).html(value);
				});

				range.on('input', function(){
				$(this).next(value).html(this.value);
				});
			});
		};

		rangeSlider();

		$( '#age-check' ).on( 'click', ( function() {
				var age = $('#rangeslider').val();

				if(age >= options.age ) {
					if ( 'off' == options.test_mode ) {
						$( '.psag' ).hide();
						$( '.overlay-verify' ).hide();
						sessionStorage.setItem( options.session_name, 'true' );
						$( options.blur_container ).css('filter', 'blur(0px)');
					}
				} else {
					$( '.age-message' ).html( '<p>' + options.error_message + '</p>' );
				}
			})
		);
	}

	/* check if IE */

	if( navigator.userAgent.indexOf('MSIE')!==-1 || navigator.appVersion.indexOf('Trident/') > 0 ) {
		$('.psag .box').css('width','100%');
		$('.psag .box').css('height','55%');
		$('.psag .box').css('display','block');
	}
} );
