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

jQuery(function ($) {

	//Lets get the total width & height of the viewpoint
	//where the slider image is howing up
	var sliderViewPoint = $(".comparison-content").width();
	var middle = ( sliderViewPoint / 2 );
	var ViewPointHeight = $(".comparison-content").height();

	setTimeout(function(){
		// Removing disabled class from compression content
		$('.comparison-content').removeClass('disabled');
	},4000);

	//Setting up the default clippings on load unless users hover
	$("div[id^=horizon-kraked-]").each(function() {
		$(this).css( "clip", "rect( 0px, " + middle + "px, " + ViewPointHeight + "px, 0px)" );
	});

	$("div[class^=separator-]").each(function() {
		$(this).css( "left", middle );
	});


	//Fetch the $shortcode_called value from the mother div class of the before-after slider
	$("[class*=kraken-results]").hover(function() {
	    var shortcode_called = this.className.match(/(\d+)-kraken-results/)[1];
	    $.fn.isaumyaslider = function(options) {
		    var options = $.extend({default_offset_pct: 0.5, move_slider_on_hover: false}, options);
		    return this.each(function() {

		      var sliderPct = options.default_offset_pct;
		      var container = $(this);
		      var before = container.find(".horizon-kraked-" + shortcode_called );
		      var slider = container.find(".separator-" + shortcode_called );

		      var calcOffset = function(dimensionPct) {
		        var w = before.width();
		        var h = before.height();
		        return {
		          w: w+"px",
		          h: h+"px",
		          cw: (dimensionPct*w)+"px",
		          ch: (dimensionPct*h)+"px"
		        };
		      };

		      var adjustContainer = function(offset) {
		        before.css("clip", "rect(0,"+offset.cw+","+offset.h+",0)");
		        container.css("height", offset.h);
		      };

		      var adjustSlider = function(pct) {
		        var offset = calcOffset(pct);
		        slider.css("left", offset.cw);
		        adjustContainer(offset);
		      }

		      $(window).on("resize.isaumyaslider", function(e) {
		        adjustSlider(sliderPct);
		      });

		      var offsetX = 0;
		      var imgWidth = 0;

		      var events = {
		        start: "movestart",
		        move: "move",
		        end: "mouseend"
		      };

		      if (options.move_slider_on_hover === true) {
		        events.start += " mouseenter";
		        events.move += " mousemove";
		        events.end += " mouseleave";
		      }

		        container.on(events.start, function(e) {
		        	if ((e.distX > e.distY && e.distX < -e.distY) || (e.distX < e.distY && e.distX > -e.distY)) {
		            	e.preventDefault();
		         	}

		        container.addClass("active");
		        offsetX = container.offset().left;
		        offsetY = container.offset().top;
		        imgWidth = before.width(); 
		        imgHeight = before.height();          
		      });

		      container.on(events.end, function(e) {
		        container.removeClass("active");
		      });

		      container.on(events.move, function(e) {
		        if (container.hasClass("active")) {
		          sliderPct = (e.pageX-offsetX)/imgWidth;
		          if (sliderPct < 0) {
		            sliderPct = 0;
		          }
		          if (sliderPct > 1) {
		            sliderPct = 1;
		          }
		          adjustSlider(sliderPct);
		        }
		      });

		      container.find("img").on("mousedown", function(event) {
		        event.preventDefault();
		      });

		      $(window).trigger("resize.isaumyaslider");
		    });
		};

		/*ubaSliderData1*/
		//Let's create an array of compression software that has been used
		var softUsedArray = window["ubaSliderData" + shortcode_called ]["software_used"].split(',');

		$( "span#slide-btn-" + shortcode_called ).click(function() {

			// Add disabled class to compression content div while image loads
			$('.comparison-content-' + shortcode_called ).addClass('disabled');

			// fetching the slide number
		    var btn_number = $(this).text();

		    //based on the button value change the orginal, compressed image side
		    //percentage and reduction text
		    $('.kraken #original-size-' + shortcode_called ).text( window["ubaSliderData" + shortcode_called ]["src" + btn_number + "_org_size" ] );
		    $('.kraken #kraked-size-' + shortcode_called ).text( window["ubaSliderData" + shortcode_called ]["src" + btn_number + "_new_size" ] );
		    $('.kraken #kraked-percent-' + shortcode_called ).text( window["ubaSliderData" + shortcode_called ]["slide_" + btn_number + "_compress_percent" ] );
		    $('.kraken #reduction-text-' + shortcode_called ).text( window["ubaSliderData" + shortcode_called ]["slide_" + btn_number + "_reduction_text" ] );
		    $('.kraken #SoftUsed-' + shortcode_called ).text( $.trim( softUsedArray[ btn_number - 1 ] ) );

			setTimeout(function(){
			    //based on the slide number assigning appropiate src to image
			    $('.horizon-original-' + shortcode_called + ' img').attr({
			    		'src' : window["ubaSliderData" + shortcode_called ]["src" + btn_number + "_org"],
			    		'id'  : "slide_" + btn_number + "_org"
			    		});

			    $('.horizon-kraked-' + shortcode_called + ' img').attr({
			    		'src' : window["ubaSliderData" + shortcode_called ]["src" + btn_number + "_new"],
			    		'id'  : "slide_" + btn_number + "_new"
			        	});

				$(function(){
					$('.horizon-kraked-' + shortcode_called + ' img').bind('load', function(){
						$('.comparison-content-' + shortcode_called ).removeClass('disabled');
					});
				}); 
			},400);

		    //checking if the span button not has "active" class in it
		    if ( ! $(this).hasClass("active") ) {
		    	$('.legend-pagination-' + shortcode_called + ' span').each(function(){
			        if( $(this).hasClass("active") ) {
			        	$(this).removeClass("active");
			        }
			    });
		      	//removing active class from the existing slide button
		       	$("span#slide-btn-" + shortcode_called ).removeClass("active");
		       	//assigning active class to the one clicked
		       	$(this).addClass("active");
		    }
		});

	  $(".comparison-content-" + shortcode_called ).isaumyaslider();

	});

});