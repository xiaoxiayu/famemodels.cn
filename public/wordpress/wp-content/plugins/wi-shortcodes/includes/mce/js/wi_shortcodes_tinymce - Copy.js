(function() {	
	tinymce.create('tinymce.plugins.wiShortcodeMce', {
		init : function(ed, url){
			tinymce.plugins.wiShortcodeMce.theurl = url;
		},
		createControl : function(btn, e) {
			if ( btn == "wi_shortcodes_button" ) {
				var a = this;	
				var btn = e.createSplitButton('wi_button', {
	                title: 'Insert Shortcodes',
					image: tinymce.plugins.wiShortcodeMce.theurl +"/shortcodes.png",
					icons: false,
	            });
	            btn.onRenderMenu.add(function (c, b) {
					
					b.add({title : 'Wi:Shortcodes', 'class' : 'mceMenuItemTitle'}).setDisabled(1);
					
					
					// Columns
					c = b.addMenu({title:"Columns"});
					
						a.render( c, "1/2", "1-2" );
						a.render( c, "1/3", "1-3" );
						a.render( c, "1/4", "1-4" );
						a.render( c, "1/5", "1-5" );
						a.render( c, "1/6", "1-6" )
						
						c.addSeparator();		
								
						a.render( c, "2/3", "2-3" );
						a.render( c, "3/4", "3-4" );
						a.render( c, "2/5", "2-5" );
						a.render( c, "3/5", "3-5" );
						a.render( c, "4/5", "4-5" );
						a.render( c, "5/6", "5-6" );
					
					b.addSeparator();
					
					// Heading
					c = b.addMenu({title:"Headings"});
					
						a.render( c, "H1", "heading-h1" );
						a.render( c, "H2", "heading-h2" );
						a.render( c, "H3", "heading-h3" );
						a.render( c, "H4", "heading-h4" );
						a.render( c, "H5", "heading-h5" );
						a.render( c, "H6", "heading-h6" );
					
					b.addSeparator();
					
					// Heading
					c = b.addMenu({title:"Center Headings"});
					
						a.render( c, "Center H1", "center-heading-h1" );
						a.render( c, "Center H2", "center-heading-h2" );
						a.render( c, "Center H3", "center-heading-h3" );
						a.render( c, "Center H4", "center-heading-h4" );
						a.render( c, "Center H5", "center-heading-h5" );
						a.render( c, "Center H6", "center-heading-h6" );
					
					b.addSeparator();
					
					// Elements
					c = b.addMenu({title:"Elements"});
						
						a.render( c, "Align", "align" );
						a.render( c, "Iconbox", "iconbox" );
						a.render( c, "Small iconbox", "small-iconbox" );
						a.render( c, "Imagebox", "imagebox" );
						a.render( c, "Google Map", "gmap" );
						a.render( c, "Progress group", "progress-group" );
						a.render( c, "Progress bar", "progress" );						
						a.render( c, "Member", "member" );						
						a.render( c, "Pricing", "pricing" );
						a.render( c, "Brands", "brands" );
						a.render( c, "Dropcap", "dropcap" );
						a.render( c, "Text Dropcap", "text-dropcap" );
						a.render( c, "Video", "video" );
						a.render( c, "Soundcloud", "soundcloud" );
						a.render( c, "Highlight", "highlight" );
					
					b.addSeparator();
					
					// jQuery
					c = b.addMenu({title:"jQuery elements"});
											
						a.render( c, "Accordion", "accordion" );
						a.render( c, "Toggle", "toggle" );
						a.render( c, "Tab", "tab" );
						a.render( c, "Bigtext", "bigtext" );
						a.render( c, "Counter", "counter" );
						a.render( c, "Pie Chart", "piechart" );
						a.render( c, "Slider", "flexslider" );
						
					b.addSeparator();
					
					// Icons
					c = b.addMenu({title:"Icons"});
					
						a.render( c, "Facebook" , "icon-facebook" );
						a.render( c, "Twitter" , "icon-twitter" );
						a.render( c, "Google+" , "icon-google-plus" );
						a.render( c, "LinkedIn" , "icon-linkedin" );
						a.render( c, "Tumblr" , "icon-tumblr" );
						a.render( c, "Pinterest" , "icon-pinterest" );
						a.render( c, "YouTube" , "icon-youtube" );
						a.render( c, "Skype" , "icon-skype" );
						a.render( c, "Instagram" , "icon-instagram" );
						a.render( c, "StumbleUpon" , "icon-stumbleupon" );
						a.render( c, "Wordpress" , "icon-wordpress" );
						a.render( c, "Blogger" , "icon-blogger" );
						a.render( c, "Vimeo" , "icon-vimeo" );
						a.render( c, "Yahoo!" , "icon-yahoo" );
						a.render( c, "Flickr" , "icon-flickr" );
						a.render( c, "Picasa" , "icon-picasa" );
						a.render( c, "DeviantArt" , "icon-deviantart" );
						a.render( c, "GitHub" , "icon-github" );
						a.render( c, "Xing" , "icon-xing" );
						a.render( c, "Flattr" , "icon-flattr" );
						a.render( c, "SoundCloud" , "icon-soundcloud" );
						a.render( c, "Last.fm" , "icon-lastfm" );
						a.render( c, "Dribbble" , "icon-dribbble" );
						a.render( c, "Forrst" , "icon-forrst" );
						a.render( c, "Steam" , "icon-steam" );
						a.render( c, "Behance" , "icon-behance" );
						a.render( c, "Weibo" , "icon-weibo" );
						a.render( c, "Homepage" , "icon-home" );
						a.render( c, "Email" , "icon-envelope-alt" );
						
					b.addSeparator();
					
					// Buttons
					c = b.addMenu({title:"Buttons"});
					
						a.render( c, "Primary", "btn-primary" );
						a.render( c, "Blue", "btn-blue" );
						a.render( c, "Red", "btn-red" );
						a.render( c, "Green", "btn-green" );
						a.render( c, "Orange", "btn-orange" );
						a.render( c, "Yellow", "btn-yellow" );
						a.render( c, "Black", "btn-black" );
						a.render( c, "White", "btn-white" );
						a.render( c, "Gray", "btn-gray" );
					
					b.addSeparator();
					
					// List
					c = b.addMenu({title:"Lists"});
					
						a.render( c, "List star", "list-star" );
						a.render( c, "List plus", "list-plus" );
						a.render( c, "List minus", "list-minus" );
						a.render( c, "List hash", "list-hash" );
						
					b.addSeparator();
					
					// Helpers
					c = b.addMenu({title:"Helpers"});
					
						a.render( c, "Hr", "hr" );
						a.render( c, "Spacer", "spacer" );
						a.render( c, "Br", "br" );
						a.render( c, "Clear", "clear" );
						a.render( c, "Divider", "divider" );
						
					b.addSeparator();
				
				});
	            
	          return btn;
			}
			return null;               
		},
		render : function(ed, title, id) {
			ed.add({
				title: title,
				onclick: function () {
					
					// Selected content
					var mceSelected = tinyMCE.activeEditor.selection.getContent();
					
					// Add highlighted content inside the shortcode when possible - yay!
					if ( mceSelected ) {
						var wiDummyContent = mceSelected;
					} else {
						var wiDummyContent = 'Sample Content';
					}
					
					/* Columns
					---------------------------------------------------------------------- */
					if ( id == '1-2' || id == '1-3' || id == '1-4' || id == '1-5' || id == '1-6' || id == '2-3' || id == '3-4' || id == '2-5' || id == '3-5' || id == '4-5' || id == '5-6' ) {
						var column_size = id.replace('-','/');
						tinyMCE.activeEditor.selection.setContent('[column size="' + column_size + '" last="false"]<br />' + wiDummyContent + '<br />[/column]');
					}
						
					/* Headings
					---------------------------------------------------------------------- */
					if(id.substr(0,7) == "heading") {
						var heading = id.substr(8);
						tinyMCE.activeEditor.selection.setContent('[heading h="' + heading + '"]' + wiDummyContent + '[/heading]');
					}
					
					/* Center Headings
					---------------------------------------------------------------------- */
					if(id.substr(0,14) == "center-heading") {
						var heading = id.substr(15);
						tinyMCE.activeEditor.selection.setContent('[center_heading h="' + heading + '"]' + wiDummyContent + '[/center_heading]');
					}
					
					/* Elements
					---------------------------------------------------------------------- */
					
					/* Align */
					if ( id == 'align' ) {
						tinyMCE.activeEditor.selection.setContent('[align align="center"]<br />' + wiDummyContent + '<br />[/align]');
					}					
					
					/* Iconbox */
					if ( id == 'iconbox' ) {
						tinyMCE.activeEditor.selection.setContent('[iconbox icon="search" name="Iconbox name"]<br />' + wiDummyContent + '<br />[/iconbox]');
					}
					
					/* Small iconbox */
					if ( id == 'small-iconbox' ) {
						tinyMCE.activeEditor.selection.setContent('[small_iconbox icon="search" name="Small iconbox name"]<br />' + wiDummyContent + '<br />[/small_iconbox]');
					}
					
					/* Imagebox */
					if ( id == 'imagebox' ) {
						tinyMCE.activeEditor.selection.setContent('[imagebox image="IMAGE URL" name="Imagebox title"]<br />' + wiDummyContent + '<br />[/imagebox]');
					}
										
					/* Google Map */
					if ( id == 'gmap' ) {
						tinyMCE.activeEditor.selection.setContent('[gmap height="400" src="" /]');
					}
					
					/* Progress Group */
					if ( id == 'progress-group' ) {
						tinyMCE.activeEditor.selection.setContent('[progress_group]<br />[progress percent="60" name="Skill 1" color="primary" /]<br />[progress percent="70" name="Skill 2" color="primary" /]<br />[progress percent="80" name="Skill 3" color="primary" /]<br />[progress percent="90" name="Skill 4" color="primary" /]<br />[/progress_group]');
					}
					
					/* Progress bar */
					if ( id == 'progress' ) {
						tinyMCE.activeEditor.selection.setContent('[progress percent="90" name="Skill name" color="primary" /]');
					}
					
					/* Member */
					if ( id == 'member' ) {
						tinyMCE.activeEditor.selection.setContent('[member name="John Doe" role="Developer" image="http://" facebook="" twitter="" googleplus=""]<br />' + wiDummyContent + '<br />[/member]');
					}					
					
					/* Pricing */
					if(id == "pricing") {
						tinyMCE.activeEditor.selection.setContent('[pricing]<br />[pricing_column title="Column 1" price="19.5" unit="$" unit_position="left" per="month" button="Sign Up" link="http://" target="_self"]<br /><ul><li>Feature 1</li><li>Feature 2</li><li>Feature 3</li></ul>[/pricing_column]<br />[pricing_column title="Column 2" price="29.5" unit="$" unit_position="left" per="month" featured="true" color="primary" button="Sign Up" link="#" target="_self"]<br /><ul><li>Feature 1</li><li>Feature 2</li><li>Feature 3</li></ul>[/pricing_column]<br />[pricing_column title="Column 3" price="39.5" unit="$" unit_position="left" per="month" button="Sign Up" link="#" target="_self"]<br /><ul><li>Feature 1</li><li>Feature 2</li><li>Feature 3</li></ul>[/pricing_column]<br />[/pricing]');
					}
					
					/* Brands */
					if ( id == 'brands' ) {
						tinyMCE.activeEditor.selection.setContent('[brands]<br />[brand title="Brand 1" link="#" target="_self"]Image URL[/brand]<br />[brand title="Brand 2" link="#" target="_self"]Image URL[/brand]<br />[brand title="Brand 3" link="#" target="_self"]Image URL[/brand]<br />[/brands]');
					}
					
					/* Dropcap */
					if ( id == 'dropcap' ) {
						tinyMCE.activeEditor.selection.setContent('[dropcap]' + wiDummyContent + '[/dropcap]');
					}
					
					/* Text Dropcap */
					if ( id == 'text-dropcap' ) {
						tinyMCE.activeEditor.selection.setContent('[text_dropcap]' + wiDummyContent + '[/text_dropcap]');
					}
					
					/* Video */
					if ( id == 'video' ) {
						tinyMCE.activeEditor.selection.setContent('[wi_video]' + wiDummyContent + '[/wi_video]');
					}
					
					/* Soundcloud */
					if ( id == 'soundcloud' ) {
						tinyMCE.activeEditor.selection.setContent('[wi_soundcloud]' + wiDummyContent + '[/wi_soundcloud]');
					}
					
					/* Highlight */
					if ( id == 'highlight' ) {
						tinyMCE.activeEditor.selection.setContent('[highlight style="1"]' + wiDummyContent + '[/highlight]');
					}
					
					/* jQuery elements
					---------------------------------------------------------------------- */
					
					// Accordion
					if(id == "accordion") {
						tinyMCE.activeEditor.selection.setContent('[accordion]<br />[toggle name="Section 1"]<br />Accordion Content<br />[/toggle]<br />[toggle name="Section 2"]<br />Accordion Content<br />[/toggle]<br />[toggle name="Section 3"]<br />Accordion Content<br />[/toggle]<br />[/accordion]');
					}
					
					// Toggle
					if(id == "toggle") {
						tinyMCE.activeEditor.selection.setContent('[toggle name="Toggle title" open="false"]<br />' + wiDummyContent + '<br />[/toggle]');
					}
					
					// Tab
					if(id == "tab") {
						tinyMCE.activeEditor.selection.setContent('[tab]<br />[tab_element name="Tab 1" icon=""]<br />Tab Content<br />[/tab_element]<br />[tab_element name="Tab 2" icon=""]<br />Tab Content<br />[/tab_element]<br />[tab_element name="Tab 3" icon=""]<br />Tab Content<br />[/tab_element]<br />[/tab]');
					}
					
					// Bigtext
					if(id == "bigtext") {
						tinyMCE.activeEditor.selection.setContent('[bigtext font=""]' + wiDummyContent + '[/bigtext]');
					}
						
					// Count
					if(id == "counter") {
						tinyMCE.activeEditor.selection.setContent('[counter name="Counter name" number="123"]<br />' + wiDummyContent + '<br />[/counter]');
					}
					
					
					/* Piechart */
					if ( id == 'piechart' ) {
						tinyMCE.activeEditor.selection.setContent('[piechart percent="90" thickness="5" size="120" name="Piechart name" color="primary" forecolor="#ccc"]<br />' + wiDummyContent + '<br />[/piechart]');
					}
					
					/* Slider */
					if(id == "flexslider") {
						tinyMCE.activeEditor.selection.setContent('[flexslider navi="true" auto="false" effect="slide"]<br />[slide]Image URL[/slide]<br />[slide]Image URL[/slide]<br />[slide]Image URL[/slide]<br />[/flexslider]');
					}
						
					/* Icons
					---------------------------------------------------------------------- */
					if ( id.substr(0,5) == 'icon-') {
						var ic = id.substr(5);
						tinyMCE.activeEditor.selection.setContent('[icon icon="' + ic + '" link="" target="_self" title="Icon title" size="36" /]');
					}					
						
					/* Button
					---------------------------------------------------------------------- */					
					if(id.substr(0,4) == "btn-") {
						var btn_color = id.substr(4);
						tinyMCE.activeEditor.selection.setContent('[button color="'+btn_color+'" link="" target="_self" icon="" icon_position="right" scroll="false"]' + wiDummyContent + '[/button]');
					}
					
									
					/* List
					---------------------------------------------------------------------- */
					if(id.substr(0,5) == "list-") {
						var list_type = id.substr(5);
						tinyMCE.activeEditor.selection.setContent('[list type="'+list_type+'"]' + wiDummyContent + '[/list]');
					}
					
					/* Helper
					---------------------------------------------------------------------- */
					if(id == "hr") {
						tinyMCE.activeEditor.selection.setContent('[hr /]');
					}
					
					if(id == "spacer") {
						tinyMCE.activeEditor.selection.setContent('[spacer height="30" /]');
					}
					
					if(id == "br") {
						tinyMCE.activeEditor.selection.setContent('[br /]');
					}
					
					if(id == "clear") {
						tinyMCE.activeEditor.selection.setContent('[clear /]');
					}
					
					if(id == "divider") {
						tinyMCE.activeEditor.selection.setContent('[divider h="h3"]' + wiDummyContent + '[/divider]');
					}
					
					return false;
				}
			})
		}
	
	});
	tinymce.PluginManager.add("wi_shortcodes", tinymce.plugins.wiShortcodeMce);
})();