<?php
/*************************************************************************
 * Youtube PLUGIN
 * -----------------------------------------------------------------------
 * Creado por: Helynai Elizabeth Chuc Maldonado.
 *************************************************************************/
// Create Slider
	
	function wptuts_Youtube_template() {

		// Query Arguments
		$args = array(
					'post_type' => 'Youtube',
					'posts_per_page'	=> 1
				);	
		
		// The Query
		$the_query = new WP_Query( $args );
		
		// Check if the Query returns any posts
		if ( $the_query->have_posts() ) {
	
		// Start the Slider ?>
			<?php $the_query->the_post();?>
				<?php if ( get_post_meta( get_the_id(), 'Hely_YoutubeID', true) != '' ) { ?>
				<iframe width="<?php echo  get_post_meta( get_the_id(), 'Hely_YoutubeWidth', true ) ; ?>" height="<?php echo  get_post_meta( get_the_id(), 'Hely_YoutubeHeight', true ) ; ?>" src="//www.youtube.com/embed/<?php echo  get_post_meta( get_the_id(), 'Hely_YoutubeID', true ) ; ?>" frameborder="0" allowfullscreen></iframe>   					
				<?php } ?>

		<?php }
		
		// Reset Post Data
		wp_reset_postdata();
	}

// Slider Shortcode

	function wptuts_Youtube_shortcode() {
		ob_start();
		wptuts_Youtube_template();
		$Youtube = ob_get_clean();
		return $Youtube;
	}
	add_shortcode( 'Youtube', 'wptuts_Youtube_shortcode' );