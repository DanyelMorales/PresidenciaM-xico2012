<?php
function printArticle()
{
# $imagenDePost   imagen miniatura del post
# $textoBoton	  texto del boton si es video o articulo
# $tipoDePost	  clase css del post
# $imagenBigUrl   imagen grande del post
 
 global $imagenDePost, $textoBoton , $tipoDePost, $imagenBigUrl;
?>
			<article class="home-post" id="post-00000">
				<h4 class="post-title">
					<a href="<?php the_permalink();?>"><?php the_title();?></a>
				</h4>
				<time datetime="2014-10-15T23:29:48+00:00" class="post-time-ribbon">
					<?php the_time('j M');?>
				</time>
				<a href="<?php the_permalink();?>" class="thumb <?php echo $tipoDePost;?>">
					<img width="250" height="160" src="<?php echo $imagenDePost;?>" class="attachment-home-thumb wp-post-image" alt="publicacion_<?php the_ID(); ?>" />
				</a>
				<p>				
					<?php
						/* para cambiar el largo y el string del excerpt 
						   consultar functions.php linea 43 a 52
						*/
						the_excerpt();
					?>
				</p>
				<a href="<?php the_permalink();?>" class="more-link"><?php echo $textoBoton; ?></a>
			</article>
			
<?php
}
?>