<?php
/* MIT License

Copyright (c) 2016 Saumya Majumder www.isaumya.com

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/
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