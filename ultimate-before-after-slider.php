<?php
/*
Plugin Name: Ultimate Before After Slider
Plugin URI:  https://www.isaumya.com/
Description: Show before and after images with multiple slides
Version:     1.1
Author:      Saumya Majumder
Author URI:  https://www.isaumya.com/
Text Domain: ubas
*/
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

//Declaring the class for Ultimate Before After Slider
class UltimateBeforeAfterSlider {
	//declaring the static variable to check how many times 
	//the shortcode has been called on the same page
	protected static $shortcode_called = 0;

	//declaring other protected variables
	protected $shortcode_data, $plugin_dir;

	//creating the constructor
	public function __construct() {
		$this->plugin_dir = plugin_dir_url( __FILE__ );

		add_shortcode( 'before_after', array( $this, 'before_after_slider' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_button_script' ) );
		add_filter( 'mce_external_plugins', array( $this, 'mce_external_button' ) );
		add_filter( 'mce_buttons', array( $this, 'mce_buttons' ) );
		add_filter( 'mce_external_languages', array( $this, 'add_tinymce_lang' ) );
	}

	//The actual before after slider function
	public function before_after_slider( $atts ) {
		//increase the shortcode called counter
		$this->shortcode_called++;

		//extracting the shortcode attributes
	    $this->shortcode_data = shortcode_atts( array(
	        'slide' => 5, // max 7
	        'software_used' => '', //seperated by comma
	        'src1_org' => null,
	        'src1_new' => null,
	        'src2_org' => null,
	        'src2_new' => null,
	        'src3_org' => null,
	        'src3_new' => null,
	        'src4_org' => null,
	        'src4_new' => null,
	        'src5_org' => null,
	        'src5_new' => null,
	        'src6_org' => null,
	        'src6_new' => null,
	        'src7_org' => null,
	        'src7_new' => null,
	        'download' => "false", //whether or not the user wanna add the download button. Accept true/false
	        'download_url' => null,
	        'download_text' => 'Download All Results'
	    ), $atts );

	    //now extract the shortcode data to independent variables
	    extract( $this->shortcode_data );

	    //Create an array of compression software used
	    //Seperated by comma
	    $this->softUsedArray = explode( ',', trim( $software_used ) );

	    // First let's create the span buttons for changing slides
	    $span_button = '';
	    for ( $i=$slide; $i>0; $i-- ) {
	    	if ( $i > 1 ) {
	    		$span_button .= '<span id="slide-btn-' . $this->shortcode_called . '">' . $i . '</span>';
	    	} else {
	    		$span_button .= '<span id="slide-btn-' . $this->shortcode_called . '" class="active">' . $i . '</span>';
	    	} //end if
	    } // end of for loop

	    // checking if wants to provide download zip
	    $download_output = '';
	    $no_download_btn_class = '';
	    if ( $download == "true" ) {
	    	$download_output = '<a rel="download nofollow" id="download-url-' . $this->shortcode_called . '" class="kranked-download-url" target="_blank" href="' . $download_url . '">' . $download_text . '</a>';
	    } else {
	    	$no_download_btn_class = " no_download_btn";
	    } // end if

	    // creating an array of new-old file size, compression percentage
	    $reduction = false; //setting up file size redeuction flag to false
	    for( $c=1; $c <= $slide; $c++ ) {
	        //Lets first get the byte value of the org img of slide $c
	        $byte_org = $this->curl_get_file_size( ${"src" . $c . "_org"} );
	        $byte_new = $this->curl_get_file_size( ${"src" . $c . "_new"} );

	        //making sure that the new file size is < or = than the org file
	        //otherwise have to reverse the percentage calculation
	        if( $byte_org > $byte_new ) {
	            $reduction = true;
	            $percent = round( ( ( $byte_org - $byte_new ) / $byte_org ) * 100 );
	        } else {
	            $percent = round( ( ( $byte_new - $byte_org ) / $byte_org ) * 100 );
	        } // end if

	        //Calculated actual human readable size Like KB, GB etc.
	        $human_size_org = size_format( $byte_org );
	        $human_size_new = size_format( $byte_new );

	        //Setting up the reduction Text based on the reduction flag
	        if( $reduction === true ) {
	            $reduction_text = __("reduction", "ubas-translate");
	        } else {
	            $reduction_text = __("increase", "ubas-translate");
	        } // end if 

	        //Now pushing all these new values to the $this->shortcode_data array
	        $this->shortcode_data["src" . $c . "_org_size"] = $human_size_org;
	        $this->shortcode_data["src" . $c . "_new_size"] = $human_size_new;
	        $this->shortcode_data["slide_" . $c . "_compress_percent"] = $percent;
	        $this->shortcode_data["slide_" . $c . "_reduction_text"] = $reduction_text;
	    } // end of for loop

	    // The actual HTML for the before after slider
	    $final_html_output = '<div id="' . $this->shortcode_called . '-kraken-results" class="' . $this->shortcode_called . '-kraken-results borders kraken cf">
	        <div id="comparison-area">
	            <div id="comparison-content" class="comparison-content-' . $this->shortcode_called . ' comparison-content disabled">
	                <div id="horizon-original-' . $this->shortcode_called . '" class="horizon-original-' . $this->shortcode_called . ' horizon-original">
	                    <div id="label-original">' . __("Original Image", "ubas-translate") . '</div>
	                    <img id="slide_1_org" src="'. $src1_org .'" " />
	                </div>
	                <div id="horizon-kraked-' . $this->shortcode_called . '" class="horizon-kraked-' . $this->shortcode_called . ' horizon-kraked">
	                    <div id="label-kraked"><span id="SoftUsed-' . $this->shortcode_called . '">' . trim($this->softUsedArray[0]) . '</span> ' . __("Image", "ubas-translate") . '</div>
	                    <img id="slide_1_new" src="'. $src1_new .'" " />
	                </div>
	                <div id="separator" class="separator-' . $this->shortcode_called . '"><span class="left-arr"></span><span class="right-arr"></span></div>
	            </div>
	            <div class="loaderz"></div>
	        </div>
	        <div class="legend cf">
	            <ul>
	                <li>' . __("Original Size", "ubas-translate") . ': <strong><span id="original-size-' . $this->shortcode_called . '">' . $this->shortcode_data["src1_org_size"] . '</span></strong></li>
	                <li><span id="SoftUsed-' . $this->shortcode_called . '">' . trim($this->softUsedArray[0]) . '</span> ' . __("Size", "ubas-translate") . ': <strong><span id="kraked-size-' . $this->shortcode_called . '">' . $this->shortcode_data["src1_new_size"] . '</span> (<span id="kraked-percent-' . $this->shortcode_called . '">' . $this->shortcode_data["slide_1_compress_percent"] . '</span>% <span id="reduction-text-' . $this->shortcode_called . '">' . $this->shortcode_data["slide_1_reduction_text"] . '</span>)</strong></li>
	            </ul>
	            <div id="legend-buttons" class="legend-buttons-' . $this->shortcode_called . '">' . $download_output
	                . '<div id="legend-pagination" class="legend-pagination-' . $this->shortcode_called . $no_download_btn_class . '">' . $span_button . '</div>
	            </div>
	        </div>
	    </div>';

	    /*CSS*/
	    wp_register_style( 'ultimate-before-after-slider', $this->plugin_dir . 'assets/css/ubas.min.css', null, null );
	    wp_enqueue_style( 'ultimate-before-after-slider' );

	    /*JS*/
	    wp_register_script ('ultimate-before-after-slider-script', $this->plugin_dir . 'assets/js/jquery.ubas.min.js', array( 'jquery' ), true );
	    wp_localize_script( 'ultimate-before-after-slider-script', 'ubaSliderData' . $this->shortcode_called , $this->shortcode_data );
	    wp_enqueue_script( 'ultimate-before-after-slider-script' );
	    wp_register_script( 'jquery-event-move', $this->plugin_dir . 'assets/js/jquery.event.move.min.js', array( 'jquery' ), true );
	    wp_enqueue_script( 'jquery-event-move' );

	    return $final_html_output;
	}

	/**
	* Returns the size of a file without downloading it, or -1 if the file
	* size could not be determined.
	*
	* @param $url - The location of the remote file to download. Cannot
	* be null or empty.
	*
	* @return The size of the file referenced by $url, or -1 if the size
	* could not be determined.
	*/
	protected function curl_get_file_size( $url ) {
		// Assume failure.
  		$result = -1;

  		$curl = curl_init( $url );

  		// Issue a HEAD request and follow any redirects.
		curl_setopt( $curl, CURLOPT_NOBODY, true );
		curl_setopt( $curl, CURLOPT_HEADER, true );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, true );
		//curl_setopt( $curl, CURLOPT_USERAGENT, get_user_agent_string() );

		$data = curl_exec( $curl );
		curl_close( $curl );

		if( $data ) {
			$content_length = "unknown";
			$status = "unknown";

			if( preg_match( "/^HTTP\/1\.[01] (\d\d\d)/", $data, $matches ) ) {
				$status = (int)$matches[1];
			}

			if( preg_match( "/Content-Length: (\d+)/", $data, $matches ) ) {
				$content_length = (int)$matches[1];
			}

			// http://en.wikipedia.org/wiki/List_of_HTTP_status_codes
			if( $status == 200 || ($status > 300 && $status <= 308) ) {
				$result = $content_length;
			}
		}

		return $result;
	}

	/***************************************************************
	* Translation for TinyMCE
	***************************************************************/ 
	function add_tinymce_lang( $arr ){
	    $arr[] = plugin_dir_path( __FILE__ ) . 'ultimate-before-after-slider-ui-lang.php';
	    return $arr;
	}

	public function load_button_script() {
		if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
			if ( 'true' == get_user_option( 'rich_editing' ) ) {
				wp_enqueue_style( 'ubas-admin-css', $this->plugin_dir . 'assets/css/ubas-admin-style.min.css', array(), null );
				wp_enqueue_script( 'ubas-ui-scripts', $this->plugin_dir . 'assets/js/ubas-ui-scripts.min.js', array( 'jquery' ), '1.0', true );
			}
		}
	}

	public function mce_external_button( $plugin_array ) {
		$plugin_array[ 'ubas_mce_button' ] = $this->plugin_dir . 'assets/js/ubas-ui-mce.js';
		return $plugin_array;
	}

	public function mce_buttons( $buttons ) {
		array_push( $buttons, 'ubas_mce_button' );
		return $buttons;
	}
}



//Let's execute the class and let the show begin
$letsExecute = new UltimateBeforeAfterSlider();