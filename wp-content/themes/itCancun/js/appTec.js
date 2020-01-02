jQuery(document).ready(function($) {
	
	$(window).load(function() {
	
		$('.notsweet').next("a").attr('href', '#');
		
		$('#site-nav #nav-bar ul > li').hover(function() {
			$(this).children('.submenu').show();
		}, function() {
			$(this).children('.submenu').hide();
		});
	});
	
	$( '#main-slider' ).slider();

	$( '.whole-click' )
		.bind( 'click', function( e ) {
			e.preventDefault();
			e.stopPropagation();
			document.location = $( this ).find( 'a:first' ).attr( 'href' );
		} )
		.css( { cursor : 'pointer' } )
		.find( 'a' ).css( { textDecoration : 'none' } );
		
		$('a[rel=youtube-big]').bind('click', function(e) {
		e.preventDefault();
		$(this).replaceWith('<iframe width="100%" height="100%" src="' + $(this).attr('href') + '?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe>')
		});
});

// videobox
$('.featured-media .thumbs a').hover(function() {
	$(this).siblings().stop().animate({opacity: 0.5});
}, function() {
	$(this).siblings().stop().animate({opacity: 1});
});

// Turn links to .mp3 files into HTML5 <audio/> elements.
$('#content a[href$=mp3]').each(function() {
	var src = $(this).attr('href');
	var $audio = $('<audio/>', {src: src, width: 484, height: 32});
	$(this).replaceWith($audio);
});

// Initialize Media Element Player plugin.
$('video,audio').mediaelementplayer();


// jquerySlider
jQuery.fn.slider = function( args ) {
	if ( !args )
		args = {};
	
	var	$slider				=	$( this )
		,	$window				=	$slider.find( '.slider-slider' )
		,	$slides				=	$window.children( '.slide' )
		,	$nav					=	$slider.find( '.slider-nav a' )
		,	$navdots			=	$slider.find( '.slider-dots' )
		,	count					=	$slides.length
		,	current				=	1
		,	slide_width		=	$slides.outerWidth()
		,	total_width		= slide_width * count
		,	timer					=	false
		,	interval			=	args.interval || 4000;
		
	$window.css( { 'width' : total_width } );
	$slides.css( { 'float' : 'left' } );
	
	$slider.bind( 'mouseenter', function( e ) {
		stop_timer();
	} ).bind( 'mouseleave', function( e ) {
		start_timer();
	} );
	
	$( window ).load( function() {
		$slides.each( function() {
			var	$div	=	$( this ).find( '.title > div' )
				,	$a		=	$div.find( 'a' );
			if ( $a.width() > $div.width() ) {
				$div.css( { maxWidth : $a.width() } );
			}
		} );
	} );
	
	function slide( d, freeze ) {
		current += d;
		if ( current < 1 )
			current = count;
		if ( current > count )
			current = 1;
		
		var childrenwidth = $window.children().width() * $window.children().length;

        if(childrenwidth > $window.parent().width()) {
            $window.stop().animate({'marginLeft': (current - 1) * slide_width * -1});

            $navdots.children().removeClass('selected');
            $navdots.children().eq(current - 1).addClass('selected');
        }
		
		if ( !freeze )
			start_timer();
	}
	
	function stop_timer() {
		clearTimeout( timer );
		timer = false;
	}
	
	function start_timer() {
		if ( timer )
			stop_timer();
		timer = setTimeout( function() {
			slide( 1 );
		}, interval );
	}
	
	$nav.bind( 'click', function( e ) {
		e.preventDefault();
		if ( $( this ).hasClass( 'arrow-left' ) ) {
			current--;
			if ( current < 1 )
				current = count;
		} else {
			current++;
			if ( current > count )
				current = 1;
		}
		slide( 0 );
	} );
	
	if ( $navdots.length ) {
		for ( var i = 0 ; i < count ; i++ ) {
			$( '<a/>', { href : '#' } ).appendTo( $navdots );
		}
	}
	$navdots.delegate( 'a', 'click', function( e ) {
		e.preventDefault();
		current = $( this ).index() + 1;
		slide( 0 );
	} );
	
	slide( 0 );
};