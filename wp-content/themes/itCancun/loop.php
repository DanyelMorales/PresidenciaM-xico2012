<?php 	
	global $imagenDePost, $textoBoton, $tipoDePost, $imagenBigDePost, $videoBigPost;
	
	// determinamos si es un page
	$singlePageId = get_query_var('page_id');
	$isSinglePage = ($singlePageId !== 0 ) ? true : false; // es un single post 
	
	// determinamos si es un single post
	$singlePostId = get_query_var('p');
	$isSinglePost = ($singlePostId !== 0 ) ? true : false; // es un single post 
		
	// determinamos si existe paginación 
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // paginamos 
	query_posts('posts_per_page=6&ignore_sticky_posts=1&paged=' . $paged); // hacemos el query 
	$totalPages = (int) $wp_query->max_num_pages; // maximo numero de paginas paginadas
	
	//id de la solicitud
	$isSingle = ($isSinglePage || $isSinglePost)? 1 : 0;
	
	if($isSingle)
	{
		$singleId = ($singlePageId !== 0)? $singlePageId : $singlePostId;
		$typeDoc = ($singlePageId !== 0)? 'page' : 'post';
	}
	
	if(have_posts() || $isSinglePage) :
		// ejecutamos la función que contiene el loop 
		loopIt($isSingle, $singleId, $typeDoc);
		
		// si no es un post mostrar la barra de paginado
	    if(!$isSingle):
?>
			<!-- #site-navegacionPaginado -->
			<nav class="archive-nav">
				<?php echo get_previous_posts_link('<span class="prev"></span>');?>
				<?php echo get_next_posts_link('<span class="next"></span>');?>
				<span class="count">Página <?php echo $paged;?> de <?php echo $totalPages; ?></span>
			</nav>
<?php 
		endif;
	else: 
?>
		<p><?php _e('not found');?></p>
<?php 
	endif;
	
####################################################
# funciones que se utilizan internamente por el loop 
####################################################
	function loadPostDetail()
	{
		global $imagenDePost, $textoBoton , $tipoDePost, $imagenBigDePost, $videoBigPost;
		#tipo de pos y texto correspondiente del botón
		$tipoDePost = (get_post_meta( get_the_ID(), 'tipo', true) === 'video')? 'video-thumb' : 'thumb';  
		$textoBoton = ($tipoDePost === 'thumb')? 'Ver más': 'Ver video';
		
		#imagen normal post
		$imagenUrl = get_post_meta( get_the_ID(), 'imagenDePost', true);
		$imagenDePost = ( $imagenUrl !== '')? $imagenUrl : IMG . '/no_imgPublicacion.jpg'; 
		
		#imagen grande del post
		$imagenBigUrl = get_post_meta( get_the_ID(), 'imagenBigDePost', true);
		$imagenBigDePost = ( $imagenBigUrl !== '')? $imagenBigUrl : IMG . '/imagenPost.jpg'; 
		
		#video del post
		$videoBigUrl = get_post_meta( get_the_ID(), 'videoBigUrl', true);
		$videoBigPost = ( $videoBigUrl !== '')? $videoBigUrl : ''; 
	}
	
	function loopIt($isSingle, $singleId, $type)
	{
		$typeQ = ($type === 'post')?'p=': 'page_id=';
		$havePosts = 0; // si no cambia se detiene el ciclo
		do
		{
			if(!$isSingle)
			{
				the_post(); // hacemos el query global
				$havePosts = have_posts(); 	// actualizamos el contador flag
			}
			else
			{
				$my_query = new WP_Query($typeQ . $singleId );
				$my_query->the_post();
			}
			
			loadPostDetail(); // funcion que obtiene los detalles de cada articulo
			printArticle(); // función global que imprime elcontenido que utilizará el loop 
		}while($havePosts);
	}

?>