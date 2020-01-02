jQuery(document).ready(function($) {

	// MOBILE EXTENSION
	jQuery.extend(verge);		

	var isShown = {
			"#main-menu": false, 
			"#secondary-menu": false
		};

	detectarCambioDeViewport();

	$("#site-nav-mobile .icon-dehaze").click(function(){
		displayMenu("#main-menu","#secondary-menu");
	});
		
	$("#site-nav-mobile .icon-keyboard-arrow-right").click(function(){
		displayMenu("#secondary-menu", "#main-menu");
	});	

/*
	MOBILE FUNCTIONS
*/

/* AJUSTE DE ELEMENTOS CUANDO CAMBIA DE TAMAÑO LA VENTANA*/
function detectarCambioDeViewport()
{
	// ejecutamos la primera vez que se ejecuta
	ajustarMenu(verge.viewportW());

	// se suscribe el cambio de tamaño
	$(window).resize(function(){
    	ajustarMenu(verge.viewportW());
    	//prevenirTouchRefresh();
    	ordenarImagenesDePagina();
	});
}

function ajustarMenu(deviceWith)
{	
	// original mobile 640
	if (deviceWith <= 799) 
	{
		ajustarMenuPrincipal();
		ajustarMenuSecundario();
	}
	else
	{
		resetearMenus();
	}
}

function resetearMenus(){
	$('#main-menu .panel-menu').html('');
	$('#secondary-menu .panel-menu').html('');
}

function ajustarMenuPrincipal()
{
	$('#main-menu .panel-menu').html($('#nav-bar').html());

		// OBJETO DE MENU
		var menuObj = $('#site-header #site-nav-mobile #main-menu .panel-menu ul > li');
		
		menuObj.click(function(e){
			e.stopPropagation();
			$(this).children('.submenu').show();
		});

		$('#site-header #site-nav-mobile #main-menu').click(function(e){
			e.stopPropagation();
			menuObj.children('.submenu').hide();
		});

		$('header#site-header #site-nav-mobile section#main-menu div.panel-menu > ul > li').click(function(e){
			e.preventDefault();
		});
}

function ajustarMenuSecundario()
{
	// Enlaces externos
	var enlacesExternos = $('#sidebar .banner a'),
		redesSociales = $('#site-footer .social-bts').html(), 
		buffer = "<ul class='social-bts'>" +  redesSociales + "</ul><ul>";

	//console.log(redesSociales);

	for(var i = 0; enlacesExternos.length > i; i++)
	{
		buffer += "<li><a href=\'" + enlacesExternos[i].href  + "\''>" + enlacesExternos[i].children[0].alt + "</a></li>";
	}

	buffer += "</ul>";

	// Iconos sociales

	$('#secondary-menu .panel-menu').html(buffer);
}

/* Funciones de ayuda*/
var displayMenu = function(nombreDePanel, hidePanel){
		if (isShown[nombreDePanel]) {
			$("body").removeClass('noscroll');
			$("#site-nav-mobile section" + nombreDePanel).hide();
			 $('#site-header #site-nav-mobile #main-menu .panel-menu ul > li').children('.submenu').hide();
			isShown[nombreDePanel] = false;
		}else {
			$("body").addClass('noscroll');
			$("#site-nav-mobile section" + nombreDePanel).show();
			isShown[nombreDePanel] = true;
			if (hidePanel !== '') {
					$("#site-nav-mobile section" + hidePanel).hide();
					isShown[hidePanel] = false;
			}	
		}
}

});


var ordenarImagenesDePagina = function()
{
	// se limpia el contenedor debido a que hubo un cambio
	$('.post-page .blog-post .mobile-image-viewer ul').html('');
	if (existeElemento('.post-page img')) {
		var arr = $('.post-page img'),
			buffer = '';
		for (var i = 0; i < arr.length; i++) {
			buffer += '<li><a href=\'' + arr[i].src + '\'><figure><img src=\'' + arr[i].src + '\' alt="some text"/></figure></a></li>';
		};

		$('.post-page .blog-post .mobile-image-viewer ul').html(buffer);
	}
};


var existeElemento = function(el){
	return ($(el).length === 0)?false:true;
};