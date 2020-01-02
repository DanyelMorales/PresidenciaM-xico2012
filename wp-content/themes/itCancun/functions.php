<?php
/*************************************************************************
 * 				FUNCIONES INICIALES DE LA PLANTILLA
 * -----------------------------------------------------------------------
 * No nativo de wordpress.
 * -----------------------------------------------------------------------
 * 	Creado por: 
 *		Daniel Noe Vera Morales: danyelmorales1991@gmail.com
 *************************************************************************/
 
# archivos externos
include 'class/HMenu/MenuGen.class.php';
include 'class/HMenu/MenuFunctor.class.php';

# Constantes
define( 'DIR'	,	get_bloginfo('stylesheet_directory'));
define( 'TITLE'	,	get_bloginfo('name'));
define( 'IMG'	,	DIR . '/img');
define( 'CSS'	,	DIR . '/css');
define( 'MOB' ,	DIR . '/mobile');
define( 'MOBCSS' ,	MOB . '/css');
define( 'MOBJS' ,	MOB . '/js');
define( 'MOBIMG' ,	MOB . '/img');
define( 'JS'	,	DIR . '/js');

# Create Slider Post Type
require( get_template_directory() . '/inc/slider/slider_post_type.php' );
require( get_template_directory() . '/inc/slider/slider.php' );

# Create Banner Post Type
require( get_template_directory() . '/inc/banner/banner_post_type.php' );
require( get_template_directory() . '/inc/banner/banner.php' );

# Create twitter Post Type
require( get_template_directory() . '/inc/twitterPlug/twitter_post_type.php' );
require( get_template_directory() . '/inc/twitterPlug/twitter.php' );

# Create facebook Post Type
require( get_template_directory() . '/inc/facebook/facebook_post_type.php' );
require( get_template_directory() . '/inc/facebook/facebook.php' );

# Create facebook Post Type
require( get_template_directory() . '/inc/youtube/youtube_post_type.php' );
require( get_template_directory() . '/inc/youtube/youtube.php' );


# excerpt filter
function custom_excerpt_length( $length ) {
	return 24;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return '.';
}
add_filter('excerpt_more', 'new_excerpt_more');

# registramos en tiempo de ejecución un nuevo menu
function menu_nav_header()
{
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'menu_nav_header' );

function menu_nav_footer()
{
  register_nav_menu('footer-menu',__( 'Footer Menu' ));
}
add_action( 'init', 'menu_nav_footer' );

function menu_nav_footerTags()
{
  register_nav_menu('footerTags-menu',__( 'Footer Tags' ));
}
add_action( 'init', 'menu_nav_footerTags' );


	/*************************************************************************
	* @descrip Función	Depura objetos o Arrays, obtiene los datos internos.
	* @param   	$obj 	objeto o array
	* @return	void
	*************************************************************************/
	function depurarObjeto($obj)
	{
		echo "<em>";
		var_dump($obj);
		echo "</em>";
		exit();
	}
	
/*************************************************************************
 *	<<<<<<<<<<<<<<<<<<<<<<<CREADOR DE MENU>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
 * -----------------------------------------------------------------------
 * No nativo de wordpress.
 * -----------------------------------------------------------------------
 * 	Creado por: 
 *		Helynai Elizabeth Chuc Maldonado.
 *		Daniel Noe Vera Morales: danyelmorales1991@gmail.com
 *************************************************************************/

	/*************************************************************************
	* @descrip 	Función		Crea el menu de un arbol de WP a partir del functor
	*						especificado.
	* @param   	$menu_name 	String
	* @return	String
	*************************************************************************/
	function construirMenu($menu_name)
	{
		$menu_list = '';
		
		if ( !( $locations = get_nav_menu_locations() ) && !isset( $locations[ $menu_name ] ) ) 
		{
			return '<li>Menu "' . $menu_name . '" not defined.</li>';
		}

		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
		$menu_items = (array)wp_get_nav_menu_items($menu->term_id);
		
		$walk = new MenuGen($menu_items);
		
		$lambda = obtenerFunctor($menu_name);
		
		$menu_list = $walk->createChocolateTree($lambda);
		
		return $menu_list;
	}
	
	/*************************************************************************
	 * @descrip Función		obtiene el objeto de un functor de menu
	 * @param 	$menu_name	nombre del menu sobre el que se decidira
	 * @return 	object		objeto/dirección de memoria del functor
	 *************************************************************************/
	function obtenerFunctor($menu_name)
	{
		$objMenuFunctor = new MenuFunctor();
		switch($menu_name)
		{
			case 'header-menu':
				# define a new menu unctor or merge an option in an existent menufunctor
			break;
			case 'footer-menu':
				$objMenuFunctor->actualizarFooterAccion();
			break;			
			case 'footerTags-menu':
			break;
		}
		return $objMenuFunctor;
	}	
?>