jQuery(document).ready(function($){  
    $("#cff").jPaginate({
    	items: 5, 
    	cookies: false,
    	position: "both",
    	next: " > ",
    	previous: " < "
    });                         

    /*$('#meet_the_team').click(function(){
    	for (i=2;i<10;i++){
    		$('.people_shortcode .row:nth-child('+i+')').slideToggle( "slow", function() {

    		});
    	}
	});*/

    $( ".pull_down" ).click(function() {
      $( ".pull_down" ).not(this).find('ul').slideUp();
      $( this ).find('ul').slideToggle();
    });
}); 


jQuery( window ).on('resize',fixBannerPositioning);
jQuery( document ).ready(function(){
	fixBannerPositioning();
	jQuery('select.category_chooser').addClass('wpcf7-select');
	jQuery('select.wpcf7-select').chosen({
		disable_search_threshold:999,
		inherit_select_classes:true,
		display_disabled_options:false
	});
});

function fixBannerPositioning(){
	jQuery('.admin-bar #header-banner').css('margin-top',(jQuery('#wpadminbar').css('position')=="fixed"?jQuery('#wpadminbar').outerHeight(true):'0'));
	jQuery('body').css('padding-top',jQuery('#header-banner').outerHeight(true));
}