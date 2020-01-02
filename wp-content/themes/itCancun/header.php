<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php bloginfo('name');?><?php wp_title(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimumscale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<link rel="shortcut icon" href="<?php echo IMG; ?>/favicon.ico" />
	<link rel="stylesheet" href="<?php echo CSS; ?>/style.css">
	<link rel="stylesheet" href="<?php echo CSS; ?>/style_nav.css">
	<link rel="stylesheet" href="<?php echo MOBCSS; ?>/responsive.css">
	<script type="text/javascript" src="<?php echo JS; ?>/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo JS; ?>/mediaelement.js"></script>
	<?php wp_head(); ?>
</head>
<body>
	<div id="wrapper" class="layout-978 clearfix">
		<!-- #site-header -->  
		<header id="site-header">
			<nav id="site-nav-mobile">
       			<ul>
       				<li><span class="icon-keyboard-arrow-right"></span></li>
       				<li><a href="?page_id=63"><span class="icon-call"></span></a></li>
       				<li><a href="?page_id=59"><span class="icon-place"></span></a></li>
       				<li><span class="icon-dehaze"></span></li>
       			</ul>
       			<section id="main-menu">
       				<div class="panel-menu">

       				</div>
       			</section>
       			<section id="secondary-menu">
       				<div class="panel-menu">
       					<!--Links externos-->
       					<ul>
       						<li><a href="index.php">Inicio</a></li>
       					</ul>
       				</div>
       			</section>
            </nav>
            <section>
				<!-- #site-buscador -->
				<div class="top top-extras">
					<!-- #site-lema -->
					<div id="lema_instituto" class="col3 m">
						<br><br>
						<h4>
							<center>
								<em>Conocimiento Científico y Tecnológico para un Desarrollo Sustentable</em>
							</center>
						</h4>
					</div>
					<!-- #End-site-lema -->
					<div id="site-sec-nav" class="col3 m">
						<ul>
							<li><a href="#">English</a></li>
							<li><a href="#">Directorio</a></li>
						</ul>
						<?php get_search_form(); ?>			
					</div>	
				</div>
				<!-- #site-top-logos -->
				<div class="top">
					<span id="site-logo">
						<a href="index.php">Conocimiento Científico y Tecnológico para un Desarrollo Sustentable</a>
					</span>
					<h1 id="site-sublogo"><a href="index.php">Instituto Tecnológico de Cancún</a></h1>
				</div>
				 <!-- #site-Header-NavBar-Menu -->
				 <nav id="site-nav">
	       			<div id="nav-bar">
	            		<ul>
	            			<!-- Tec Menu -->
							<!-- menu normal -->
							<?php echo construirMenu('header-menu'); ?>
							<!-- end menu normal -->
	            		</ul>
	            	</div>
	            </nav>
            </section>
		</header>