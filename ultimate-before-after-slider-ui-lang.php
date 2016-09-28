<?php
/***************************************************************
 * SECURITY : Exit if accessed directly
***************************************************************/
if ( !defined( 'ABSPATH' ) ) {
	die( 'Direct acces not allowed!' );
}

/***************************************************************
 * Translation for TinyMCE
 ***************************************************************/ 

if ( ! class_exists( '_WP_Editors' ) )
    require( ABSPATH . WPINC . '/class-wp-editor.php' );

function ubas_tinymce_translation() {
    $strings = array(
		'title'				=> __( 'Insert Ultimate Before After Slider Shortcode', 'ubas-translate' ),
		'slide_no' 			=> __( 'Total no. of slides', 'ubas-translate' ),
		'softs_used' 		=> __( 'The software used (comma seperated)', 'ubas-translate' ),
		'scheme' 			=> __( 'Color scheme', 'ubas-translate' ),
		'slide_1_org' 		=> __( 'Slide 1 - Original Image URL', 'ubas-translate' ),
		'slide_1_new' 		=> __( 'Slide 1 - New/Compressed Image URL', 'ubas-translate' ),
		'slide_2_org' 		=> __( 'Slide 2 - Original Image URL', 'ubas-translate' ),
		'slide_2_new' 		=> __( 'Slide 2 - New/Compressed Image URL', 'ubas-translate' ),
		'slide_3_org' 		=> __( 'Slide 3 - Original Image URL', 'ubas-translate' ),
		'slide_3_new' 		=> __( 'Slide 3 - New/Compressed Image URL', 'ubas-translate' ),
		'slide_4_org' 		=> __( 'Slide 4 - Original Image URL', 'ubas-translate' ),
		'slide_4_new' 		=> __( 'Slide 4 - New/Compressed Image URL', 'ubas-translate' ),
		'slide_5_org' 		=> __( 'Slide 5 - Original Image URL', 'ubas-translate' ),
		'slide_5_new' 		=> __( 'Slide 5 - New/Compressed Image URL', 'ubas-translate' ),
		'slide_6_org' 		=> __( 'Slide 6 - Original Image URL', 'ubas-translate' ),
		'slide_6_new' 		=> __( 'Slide 6 - New/Compressed Image URL', 'ubas-translate' ),
		'slide_7_org' 		=> __( 'Slide 7 - Original Image URL', 'ubas-translate' ),
		'slide_7_new' 		=> __( 'Slide 7 - New/Compressed Image URL', 'ubas-translate' ),
		'download_show' 	=> __( 'Want to provide sample download button?', 'ubas-translate' ),
		'download_url' 		=> __( 'Downloadable File URL (ZIP Prefered)', 'ubas-translate' ),
		'download_btn_text' => __( 'Download Button Text', 'ubas-translate' ),
    );
    $locale = _WP_Editors::$mce_locale;
    $translated = 'tinyMCE.addI18n("' . $locale . '.ubas_tinymce_plugin", ' . json_encode( $strings ) . ");\n";

    return $translated;
}

$strings = ubas_tinymce_translation();