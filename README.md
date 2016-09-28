# Ultimate Before After Slider for WordPress
[![Powered by WordPress](https://i.imgur.com/TLxhYvJ.gif)](https://wordpress.org/)

This is a before after image slider based on the before after slider showcased in [Kraken.io](https://kraken.io/) website. I made it for my [Best WordPress Image Compression Plugin](https://www.isaumya.com/finding-out-the-best-wordpress-image-compression-plugin/) testing atricle.

[![Example Image](https://i.imgur.com/ABHvovw.jpg)](https://i.imgur.com/ABHvovw.jpg)

## Usage Instructions
* There are two ways this plugin can be added inside your post editor, mentioned as follows:

### Option 1
* Simply using the shortcode `[before_after]` inside your post editor.
* `[before_after]` takes a bunch of attributes within it as mentioned below:

```
	[before_after
		slide = 5 // an integer value, maximum no of slides can be added in one before_after alider is 7
		software_used = "EWWW, Imagify, Kraken, OptimusHQ" // the tested application name, comma seperated. If you want to add 5 slides that means you have used 5 application for them
		src1_org ="https://example.com/original_image.jpg" // This is the original image for slide 1
		src1_new ="https://example.com/compressed_image.jpg" // This is the compressed image URL for slide 1
		src2_org = "" // This is the original image for slide 2
		src2_new = "" // This is the compressed image URL for slide 2
		src3_org = "" // This is the original image for slide 3
		src3_new = "" // This is the compressed image URL for slide 3
		src4_org = "" // This is the original image for slide 4
		src4_new = "" // This is the compressed image URL for slide 4
		src5_org = "" // This is the original image for slide 5
		src5_new = "" // This is the compressed image URL for slide 5
		src6_org = "" // This is the original image for slide 6
		src6_new = "" // This is the compressed image URL for slide 6
		src7_org = "" // This is the original image for slide 7
		src7_new = "" // This is the compressed image URL for slide 7
		download = "false" // true => Want to show Download Sample Button, false => Don't want to show Download Sample Button
		download_url = "" // Sample file download URL
		download_text = "Download All Results" // Text for sample file download button
	]
```

### Option 2
* Simply go inside your WordPress visual editor and click on the Add Before After Slider button.

[![Click on Insert Before After Slider Button](https://i.imgur.com/vlNGtIB.jpg)](https://i.imgur.com/vlNGtIB.jpg)

* Now just fill up the fom and click OK. That's it! Your shortcode will be added inside your visual editor automatically.

[![Fill up the form and click OK](https://i.imgur.com/2sO0zeB.jpg)](https://i.imgur.com/2sO0zeB.jpg)

## Current Version
This is plugin has been tested upto `WP v4.6.1` and minimum requirement is `WP v4.0` (as I haven't tested before that)

~Current Version:1.1~

## Changelog
### v1.1
* Fixed the bug with unnecessary method call inside `ultimate-before-after-slider.php` file
* Added the Github auto updater for WordPress feature
* Updated the Github Readme file with all necessary details

### v1.0
* Initial push to Github after local development testing and production usage

## Special Thanks
* [Kraken.io](https://kraken.io/) for creating such an beautiful Before-After slider
* [Walter Lopez](https://twitter.com/lopwalj) for helping me out on some JS codes
* [Alain Schlesser](https://twitter.com/schlessera) for giving some thoughtful insights
* [Brice Capobianco](https://twitter.com/BriceCapobianco) for your awesome contribution in the WordPress community
* Stackoverflow and WordPress Stack Exchange

-Without you guys, this would never been possible.

## Licensing 
This application is licensed under MIT License.