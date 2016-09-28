/**
 * Plugin Name: Ultimate Before After Slider
 * Plugin URI: https://www.isaumya.com/
 * Author: Saumya Majumder
 */
jQuery(function ($) {
	function ubasMediaLibrary(){
		$(document).on('click', 'i.mce-i-ubas-icon', function(){
			setTimeout(function() {
				//$('.mce-ubas-media').after( "<span class='mce-ubas-media-button'>+</span>" );
				$('.mce-ubas-media').after( "<span class='mce-ubas-media-button dashicons dashicons-plus'></span>" );
			}, 100);
		});
		
		$(document).on('click', '.mce-ubas-media-button', function(){
			var $this = $(this);
			 var wireframe;
			 if (wireframe) {
				 wireframe.open();
				 return;
			 }
	
			 wireframe = wp.media.frames.wireframe = wp.media({
				 /*title: 'Media Library Title',
				 button: {
					 text: 'Media Library Button Title'
				 },*/
				 multiple: false
			 });
	
			 wireframe.on('select', function() {
				attachment = wireframe.state().get('selection').first().toJSON();
				$this.parent().find('.mce-ubas-media').val(attachment.url);
			 });
	
			 wireframe.open();
		});
	};
	ubasMediaLibrary();
});