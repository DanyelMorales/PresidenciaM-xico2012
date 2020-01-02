<?php
/*************************************************************************
 * SLIDER PLUGIN
 * -----------------------------------------------------------------------
 * Creado por: Helynai Elizabeth Chuc Maldonado.
 *************************************************************************/
// Create Slider
	
	function wptuts_slider_template() {
		
		// Query Arguments
		$args = array(
					'post_type' => 'slides',
					'posts_per_page'	=> 4
				);	
		
		// The Query
		$the_query = new WP_Query( $args );
		
		// Check if the Query returns any posts
		if ( $the_query->have_posts() ) {
		
		// Start the Slider ?>
		<div id="main-slider" class="slider">
			<div class="slider-window">
				<div class="slider-slider">
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<article class="slide whole-click">	
							<div class="title">
								<div>
									<div class="center-from-parent">
										<h1>
											<a href="<?php echo esc_url( get_post_meta( get_the_id(), 'Hely_slideUrlPost', true ) ); ?>">
												<?php echo get_post_meta( get_the_id(), 'Hely_slideDescript', true ); ?>
											</a>
										</h1>
										<a href="<?php echo esc_url( get_post_meta( get_the_id(), 'Hely_slideUrlPost', true ) ); ?>" class="more-link">Más</a>
									</div>									
								</div>
							</div>
							<?php if ( get_post_meta( get_the_id(), 'Hely_slideurl', true) != '' ) { ?>
							<img width="978" height="340" src="<?php echo esc_url( get_post_meta( get_the_id(), 'Hely_slideurl', true ) ); ?>" class="attachment-slider wp-post-image" alt="<?php echo esc_url( get_post_meta( get_the_id(), 'Hely_slideAlternative', true ) ); ?> slider" />	
							<?php } ?>
						</article>
					<?php endwhile; ?>
				</div>
			</div>
			<div class="slider-nav">
				<a href="#" class="arrow-left">_</a>
				<a href="#" class="arrow-right">_</a>
			</div>
			<div class="slider-dots">
			<!-- se genera con js en el cliente -->
			</div>
		</div><!-- endSlider -->
		
		<?php }
		
		// Reset Post Data
		wp_reset_postdata();
	}

// Slider Shortcode

	function wptuts_slider_shortcode() {
		ob_start();
		wptuts_slider_template();
		$slider = ob_get_clean();
		return $slider;
	}
	add_shortcode( 'slider', 'wptuts_slider_shortcode' );