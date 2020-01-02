		</div>
		<!-- #site-footer -->
			<!-- #site-content-footer -->
			<?php if(defined('USE_FOOTER')): get_template_part('sociales'); endif;?>
			
		<footer id="site-footer">
			<nav id="nav-footer">
				<!-- #site-footer-cols -->
	        	<?php get_template_part( 'nav', '2' ); ?>
	        	<!-- #site-footer-palabrasClave -->
	        	<?php get_template_part( 'nav', '3' ); ?>
	        </nav>
	        <!-- #site-footer-redesSociales -->
			<div class="middle">
				<div class="clearfix2">
					<ul class="social-bts">
						<li>
							<a href="#" target="_blank" class="facebook">Facebook</a>
						</li>
						<li>
							<a href="#" target="_blank" class="twitter">Twitter</a>
						</li>
						<li>
							<a href="#" target="_blank" class="instagram">Instagram</a>
						</li>
						<li>
							<a href="#" target="_blank" class="youtube">YouTube</a>
						</li>
						<li>
							<a href="#" target="_blank" class="flickr">Flickr</a>
						</li>
						<li>
							<a href="#" target="_blank" class="rss">RSS</a>
						</li>
					</ul>
    
				</div>
				<!-- #site-footer-LogoSecretaria -->
		        <a href="http://www.itcancun.edu.mx" id="logo-footer"> 
		        	Instituto Tecnológico de Cancún
		        </a>
	   		</div>
	   		<!-- #site-footer-DatosFooter -->
		    <p class="bottom">
		       Instituto Tecnológico de Cancún - Algunos derechos reservados &copy; 2014
			    <span>
			       <br/>Av. Kabah, Km. 3 Cancún Quintana Roo México C.P. 77515, Col. Centro 
			       <br /> Teléfono: 01 (998) 8-80-74-32, &nbsp; (998) 8-72-34-66, &nbsp; (998) 8-48-09-60 &nbsp;fax: 01 (998) 880-74-33<br/>    
			        <a href="#">Política de privacidad y manejo de datos personales</a>
			    </span>
		    </p>
		</footer> 
	</div>     
	<script type="text/javascript" src="<?php echo MOBJS; ?>/verge.min.js"></script>
	<script type="text/javascript" src="<?php echo MOBJS; ?>/mobile.js"></script>
	<script type="text/javascript" src="<?php echo JS; ?>/appTec.js"></script>  
	<?php wp_footer(); ?>
</body>
</html>