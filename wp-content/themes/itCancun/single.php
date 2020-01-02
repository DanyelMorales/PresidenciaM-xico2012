<?php get_header(); ?>
		<!-- #site-content -->
		<div id="content" class="clearfix">
			<!-- #site-content-content -->
			<div class="row clearfix">
				<!-- #site-publicaciones -->
				<div class="col8">
					<!-- #site-articulo -->
					<?php get_template_part('article','single');?>
					<?php get_template_part('loop','index');?>
				</div>
				
				<!-- #site-navegacionDerecha -->
				<?php 
					//if (defined('USE_SIDEBAR')):
					$visible = (defined('USE_SIDEBAR'))?'block':'none';
				?>
				<div class="col4 sidebar" style="display:<?php echo $visible;?>;">
					<aside id="sidebar" class="clearfix">
						<!-- #site-sideBarRedSocial -->
						<!-- #site-sideBarBanner -->
						<?php echo wptuts_banner_template(); ?>
					</aside>	
				</div>
				<?php
					//endif;
				?>
				<!-- End #site-navegacionDerecha -->
				
			</div>

<?php get_footer(); ?>