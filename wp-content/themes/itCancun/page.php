<?php get_header(); ?>
		<!-- #site-content -->
		<div id="content" class="clearfix">
			<!-- #site-content-content -->
			<div class="row clearfix">
				<!-- #site-publicaciones -->
				<div class="col11 post-page">
					<!-- #site-articulo -->
					<?php get_template_part('page','code');?>
					<?php get_template_part('loop','index');?>
				</div>
				
				<!-- #site-MOBILE-Target -->
				<div class="col1 sidebar" style="display:none;">
					<aside id="sidebar" class="clearfix">
						<?php echo wptuts_banner_template(); ?>
					</aside>	
				</div>
				<!-- #End-site-MOBILE-Target -->
				
			</div>
<?php get_footer(); ?>