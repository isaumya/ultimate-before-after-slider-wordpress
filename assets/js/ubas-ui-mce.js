/**
 * Plugin Name: Ultimate Before After Slider
 * Plugin URI: https://www.isaumya.com/
 * Author: Saumya Majumder
 */
 
(function() {
	tinymce.PluginManager.add('ubas_mce_button', function( editor, url ) {
		editor.addButton( 'ubas_mce_button', {
			icon: 'ubas-icon',
			title: 'Add before after slider',
			onclick: function() {
				
				editor.windowManager.open( {
					title: editor.getLang('ubas_tinymce_plugin.title'),
					body: [
						{
							type: 'listbox',
							name: 'slide',
							required: true,
							label: editor.getLang('ubas_tinymce_plugin.slide_no'),
							'values': [
								{text: "1 Slide",  value: '1' },
								{text: "2 Slides", value: '2' },
								{text: "3 Slides", value: '3' },
								{text: "4 Slides", value: '4' },
								{text: "5 Slides", value: '5' },
								{text: "6 Slides", value: '6' },
								{text: "7 Slides", value: '7' }
							]
						},
						{
							type: 'textbox',
							name: 'software_used',
							required: true,
							label: editor.getLang('ubas_tinymce_plugin.softs_used'),
							value: ''
						},
						{
							type: 'textbox',
							name: 'src1_org',
							required: true,
							classes : 'ubas-media', //necessary to call the media library
							label: editor.getLang('ubas_tinymce_plugin.slide_1_org'),
							value: '',							
						},
						{
							type: 'textbox',
							name: 'src1_new',
							required: true,
							classes : 'ubas-media', //necessary to call the media library
							label: editor.getLang('ubas_tinymce_plugin.slide_1_new'),
							value: '',							
						},
						{
							type: 'textbox',
							name: 'src2_org',
							classes : 'ubas-media', //necessary to call the media library
							label: editor.getLang('ubas_tinymce_plugin.slide_2_org'),
							value: '',							
						},
						{
							type: 'textbox',
							name: 'src2_new',
							classes : 'ubas-media', //necessary to call the media library
							label: editor.getLang('ubas_tinymce_plugin.slide_2_new'),
							value: '',							
						},
						{
							type: 'textbox',
							name: 'src3_org',
							classes : 'ubas-media', //necessary to call the media library
							label: editor.getLang('ubas_tinymce_plugin.slide_3_org'),
							value: '',							
						},
						{
							type: 'textbox',
							name: 'src3_new',
							classes : 'ubas-media', //necessary to call the media library
							label: editor.getLang('ubas_tinymce_plugin.slide_3_new'),
							value: '',							
						},
						{
							type: 'textbox',
							name: 'src4_org',
							classes : 'ubas-media', //necessary to call the media library
							label: editor.getLang('ubas_tinymce_plugin.slide_4_org'),
							value: '',							
						},
						{
							type: 'textbox',
							name: 'src4_new',
							classes : 'ubas-media', //necessary to call the media library
							label: editor.getLang('ubas_tinymce_plugin.slide_4_new'),
							value: '',							
						},
						{
							type: 'textbox',
							name: 'src5_org',
							classes : 'ubas-media', //necessary to call the media library
							label: editor.getLang('ubas_tinymce_plugin.slide_5_org'),
							value: '',							
						},
						{
							type: 'textbox',
							name: 'src5_new',
							classes : 'ubas-media', //necessary to call the media library
							label: editor.getLang('ubas_tinymce_plugin.slide_5_new'),
							value: '',							
						},
						{
							type: 'textbox',
							name: 'src6_org',
							classes : 'ubas-media', //necessary to call the media library
							label: editor.getLang('ubas_tinymce_plugin.slide_6_org'),
							value: '',							
						},
						{
							type: 'textbox',
							name: 'src6_new',
							classes : 'ubas-media', //necessary to call the media library
							label: editor.getLang('ubas_tinymce_plugin.slide_6_new'),
							value: '',							
						},
						{
							type: 'textbox',
							name: 'src7_org',
							classes : 'ubas-media', //necessary to call the media library
							label: editor.getLang('ubas_tinymce_plugin.slide_7_org'),
							value: '',							
						},
						{
							type: 'textbox',
							name: 'src7_new',
							classes : 'ubas-media', //necessary to call the media library
							label: editor.getLang('ubas_tinymce_plugin.slide_7_new'),
							value: '',							
						},
						{
							type: 'listbox',
							name: 'download',
							required: true,
							label: editor.getLang('ubas_tinymce_plugin.download_show'),
							'values': [
								{text: "Yes",  value: 'true' },
								{text: "No", value: 'false' }
							]
						},
						{
							type: 'textbox',
							name: 'download_url',
							label: editor.getLang('ubas_tinymce_plugin.download_url'),
							value: ''
						},
						{
							type: 'textbox',
							name: 'download_text',
							label: editor.getLang('ubas_tinymce_plugin.download_btn_text'),
							value: 'Download All Results'
						},
					],
					onsubmit: function( e ) {
						if(e.data.slide != ''){
							e.data.slide = 'slide="' + e.data.slide + '" ';
						}
						if(e.data.software_used != ''){
							e.data.software_used = 'software_used="' + e.data.software_used + '" ';
						}
						if(e.data.src1_org != ''){
							e.data.src1_org = 'src1_org="' + e.data.src1_org + '" ';
						}
						if(e.data.src1_new != ''){
							e.data.src1_new = 'src1_new="' + e.data.src1_new + '" ';
						}
						if(e.data.src2_org != ''){
							e.data.src2_org = 'src2_org="' + e.data.src2_org + '" ';
						}
						if(e.data.src2_new != ''){
							e.data.src2_new = 'src2_new="' + e.data.src2_new + '" ';
						}
						if(e.data.src3_org != ''){
							e.data.src3_org = 'src3_org="' + e.data.src3_org + '" ';
						}
						if(e.data.src3_new != ''){
							e.data.src3_new = 'src3_new="' + e.data.src3_new + '" ';
						}
						if(e.data.src4_org != ''){
							e.data.src4_org = 'src4_org="' + e.data.src4_org + '" ';
						}
						if(e.data.src4_new != ''){
							e.data.src4_new = 'src4_new="' + e.data.src4_new + '" ';
						}
						if(e.data.src5_org != ''){
							e.data.src5_org = 'src5_org="' + e.data.src5_org + '" ';
						}
						if(e.data.src5_new != ''){
							e.data.src5_new = 'src5_new="' + e.data.src5_new + '" ';
						}
						if(e.data.src6_org != ''){
							e.data.src6_org = 'src6_org="' + e.data.src6_org + '" ';
						}
						if(e.data.src6_new != ''){
							e.data.src6_new = 'src6_new="' + e.data.src6_new + '" ';
						}
						if(e.data.src7_org != ''){
							e.data.src7_org = 'src7_org="' + e.data.src7_org + '" ';
						}
						if(e.data.src7_new != ''){
							e.data.src7_new = 'src7_new="' + e.data.src7_new + '" ';
						}
						if(e.data.download != ''){
							e.data.download = 'download="' + e.data.download + '" ';
						}
						if(e.data.download_url != ''){
							e.data.download_url = 'download_url="' + e.data.download_url + '" ';
						}
						if(e.data.download_text != '' && e.data.download != 'false'){
							e.data.download_text = 'download_text="' + e.data.download_text + '" ';
						}
						
						if(e.data.slug != ''){
							editor.insertContent( 
								'[before_after '
									+ e.data.slide
									+ e.data.software_used
									+ e.data.src1_org
									+ e.data.src1_new
									+ e.data.src2_org
									+ e.data.src2_new
									+ e.data.src3_org
									+ e.data.src3_new
									+ e.data.src4_org
									+ e.data.src4_new
									+ e.data.src5_org
									+ e.data.src5_new
									+ e.data.src6_org
									+ e.data.src6_new
									+ e.data.src7_org
									+ e.data.src7_new
									+ e.data.download
									+ e.data.download_url
									+ e.data.download_text
								+ ']'
							);
						};
					}
				});
			}
		});
	});
})();