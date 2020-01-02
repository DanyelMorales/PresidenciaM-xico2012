<?php
/*************************************************************************
 * TWITTER PLUGIN
 * -----------------------------------------------------------------------
 * Creado por: Helynai Elizabeth Chuc Maldonado.
 *************************************************************************/
// Create Slider
	
	function wptuts_twitter_template() {

		// Query Arguments
		$args = array(
					'post_type' => 'twitterAccounts',
					'posts_per_page'	=> 1
				);	
		
		// The Query
		$the_query = new WP_Query( $args );
		
		// Check if the Query returns any posts
		if ( $the_query->have_posts() ) {
		
		// Start the Slider ?>
			<?php $the_query->the_post();?>
				<?php if ( get_post_meta( get_the_id(), 'Hely_AccountPost', true) != '' ) { ?>
						<a class="twitter-timeline"    width="<?php echo  get_post_meta( get_the_id(), 'Hely_AccountPostWidth', true ) ; ?>" height="<?php echo  get_post_meta( get_the_id(), 'Hely_AccountPostHeight', true ) ; ?>" href="https://twitter.com/<?php echo  get_post_meta( get_the_id(), 'Hely_AccountPost', true ) ; ?>" data-widget-id="<?php echo get_post_meta( get_the_id(), 'Hely_AccountidPost', true ) ; ?>">Tweets por @<?php echo  get_post_meta( get_the_id(), 'Hely_AccountPost', true ); ?></a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				<?php } ?>

		<?php }
		
		// Reset Post Data
		wp_reset_postdata();
	}

// Slider Shortcode

	function wptuts_twitter_shortcode() {
		ob_start();
		wptuts_twitter_template();
		$slider = ob_get_clean();
		return $slider;
	}
	add_shortcode( 'twitter', 'wptuts_twitter_shortcode' );