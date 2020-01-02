jQuery(document).ready(function($) {

	// MOBILE EXTENSION
	jQuery.extend(verge);
	// MOBILE JS 
	alert("asas");
	$(window).resize(function(){
    	ajustarMenu(jQuery(window).width());
	});
	// javascript function
	var isShown = {
		"#main-menu": false, 
		"#secondary-menu": false
	};

		var displayMenu = function(nombreDePanel, hidePanel){
			//$("#site-nav-mobile section#main-menu").attr("style","display:block;");
			if (isShown[nombreDePanel]) {
				$("#site-nav-mobile section" + nombreDePanel).hide();
				isShown[nombreDePanel] = false;
			}else {
				$("#site-nav-mobile section" + nombreDePanel).show();
				isShown[nombreDePanel] = true;
				if (hidePanel !== '') {
					$("#site-nav-mobile section" + hidePanel).hide();
					isShown[hidePanel] = false;
				}	
			}
		}


	$("#site-nav-mobile .icon-dehaze").click(function(){
		displayMenu("#main-menu","#secondary-menu");
	});
	
	//$("#site-nav-mobile section#main-menu").click();
	
	/*Despliega el menu secundario*/
	$("#site-nav-mobile .icon-keyboard-arrow-right").click(function(){
		displayMenu("#secondary-menu", "#main-menu");
	});	

});



/*
	MOBILE FUNCTIONS
*/
function ajustarMenu(deviceWith)
{	
	if (deviceWith <= 640) 
	{
		console.log("asasas");
	}
}