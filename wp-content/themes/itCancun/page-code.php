<?php
function printArticle()
{
# $imagenDePost   imagen miniatura del post
# $textoBoton	  texto del boton si es video o articulo
# $tipoDePost	  clase css del post
# $imagenBigDePost   imagen grande del post
# $videoBigUrl   imagen grande del post
 
 global $imagenDePost, $textoBoton , $tipoDePost, $imagenBigDePost, $videoBigPost;

 if($tipoDePost === 'video-thumb')
 {
?>

	<div class="row media-archive posts-grid bg1">
			<div>
				
				<div class="featured-media no-border">
					<div class="big-video">
						<a href="http://www.youtube.com/embed/<?php echo $videoBigPost;?>" rel="youtube-big" class="lightbox video-thumb">
						
							<img width="974" height="548" src="<?php echo $imagenBigDePost;?>" class="attachment-media-cover" alt="Screen Shot 2014-11-27 at 1.03.47 PM" />
							
						</a>
					</div>
					
					<h1>
						<a href="#">
							<?php the_title();?>
						</a>
					</h1>
					<time datetime="2014-11-27T13:08:23-06:00"><?php the_time('j'); ?> de <?php the_time('F'); ?></time>
				</div>
						
			</div>
		</div>

<?php
 }else{
 ?>
		<article class="blog-post" id="post-00000">
			<h1 class="post-title"><a href="#"><?php the_title();?></a></h1>
			<div class="post-author clearfix rs_skip">
				<time datetime="2014-11-05T04:00:55-06:00" class="post-time"><?php the_time('j'); ?> de <?php the_time('F'); ?> de <?php the_time('Y'); ?></time>
			</div>
			<div class="post-content">
				<div class="mobile-image-viewer">
					<ul>
						<em>Sin imagenes para mostrar</em>
					</ul>
				</div>
				<?php the_content();?>
			</div>
		</article>
 <?php
 }
}
?>