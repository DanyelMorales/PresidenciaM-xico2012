<?php
/*************************************************************************
 * FACEBOOK PLUGIN
 * -----------------------------------------------------------------------
 * Creado por: Helynai Elizabeth Chuc Maldonado.
 *************************************************************************/
// Create Slider
	
	function wptuts_Facebook_template() {

		// Query Arguments
		$args = array(
					'post_type' => 'Facebook',
					'posts_per_page'	=> 1
				);	
		
		// The Query
		$the_query = new WP_Query( $args );
		
		// Check if the Query returns any posts
		if ( $the_query->have_posts() ) {
	
		// Start the Slider ?>
			<?php $the_query->the_post();?>
				<?php if ( get_post_meta( get_the_id(), 'Hely_FacebookAPPID', true) != '' ) { ?>
				<div id="fb-root"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&appId=<?php echo  get_post_meta( get_the_id(), 'Hely_FacebookAPPID', true ) ; ?>&version=v2.0";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>
				<div style="background-color:<?php echo  get_post_meta( get_the_id(), 'Hely_FacebookBGC', true ) ; ?>;" class="fb-activity" data-site="<?php echo  get_post_meta( get_the_id(), 'Hely_Facebookurl', true ) ; ?>" data-action="likes, recommends" data-width="<?php echo  get_post_meta( get_the_id(), 'Hely_FacebookWidth', true ) ; ?>" data-height="<?php echo  get_post_meta( get_the_id(), 'Hely_FacebookHeight', true ) ; ?>" data-colorscheme="light" data-header="true"></div>						
				<?php } ?>

		<?php }
		
		// Reset Post Data
		wp_reset_postdata();
	}

// Slider Shortcode

	function wptuts_Facebook_shortcode() {
		ob_start();
		wptuts_Facebook_template();
		$Facebook = ob_get_clean();
		return $Facebook;
	}
	add_shortcode( 'Facebook', 'wptuts_Facebook_shortcode' );