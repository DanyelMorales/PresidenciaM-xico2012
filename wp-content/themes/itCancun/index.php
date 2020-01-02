<?php define('USE_FOOTER', true); ?>
<?php get_header(); ?>
		<!-- #site-content -->
		<div id="content" class="clearfix">
			<!-- #site-content-Slider -->
			<?php echo wptuts_slider_template(); ?>
			
			<!-- #site-content-content -->
			<div class="row clearfix">
				<!-- #site-publicaciones -->
				<div class="col8">
					<!-- #site-articulo -->
					<?php get_template_part('article','list');?>
					<?php get_template_part('loop','index');?>
				
				</div>
				<!-- #site-navegacionDerecha -->
				<div id="externalLink" class="col4">
					<aside id="sidebar" class="clearfix">
						<!-- #site-sideBarRedSocial -->
						<!-- #site-sideBarBanner -->
						<?php echo wptuts_banner_template(); ?>
					</aside>	
				</div>
			</div>

<?php get_footer(); ?>