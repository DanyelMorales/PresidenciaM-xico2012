<?php
/*************************************************************************
 * BANNER PLUGIN
 * -----------------------------------------------------------------------
 * Creado por: Helynai Elizabeth Chuc Maldonado.
 *************************************************************************/
// Create Slider
	
	function wptuts_banner_template() {
		
		// Query Arguments
		$args = array(
					'post_type' => 'banners',
					'posts_per_page'	=> 10
				);	
		
		// The Query
		$the_query = new WP_Query( $args );
		
		// Check if the Query returns any posts
		if ( $the_query->have_posts() ) {
		
		// Start the Slider ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<?php if ( get_post_meta( get_the_id(), 'Hely_bannerurl', true) != '' ) { ?>
							<div class="sidebar-module banner" title="titulo">
								<a href="<?php echo esc_url( get_post_meta( get_the_id(), 'Hely_bannerUrlPost', true ) ); ?>" >
									<img width="284" height="128" src="<?php echo esc_url( get_post_meta( get_the_id(), 'Hely_bannerurl', true ) ); ?>" alt="<?php echo ( get_post_meta( get_the_id(), 'Hely_bannerAlternative', true ) ); ?>" />
								</a>
							</div>							
							<?php } ?>
					<?php endwhile; ?>
		<?php }
		
		// Reset Post Data
		wp_reset_postdata();
	}

// banner Shortcode

	function wptuts_banner_shortcode() {
		ob_start();
		wptuts_banner_template();
		$banner = ob_get_clean();
		return $banner;
	}
	add_shortcode( 'banner', 'wptuts_banner_shortcode' );