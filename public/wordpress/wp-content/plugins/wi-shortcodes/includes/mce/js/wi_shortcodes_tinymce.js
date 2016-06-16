/* ----------------------------------------------------- */
/* button
/* ----------------------------------------------------- */
(function() {
	tinymce.create('tinymce.plugins.wi_shortcodes_button', {
		init : function(ed, url) {
			title = 'wi_shortcodes_button';
			tinymce.plugins.wi_shortcodes_button.theurl = url;
			ed.addButton('wi_shortcodes_button', {
				title	:	'Select Shortcode',
				icon	:	'wp_code',
				type	:	'menubutton',
				/* MENU STARTING */
				menu: [
				/* -----------	COLUMN	-----------	*/
                {
					text: 'Column',
					value: 'Column',
					onclick: function() {
						ed.windowManager.open( {
							title: 'Column',
							body: [{
								type	:	'listbox',
								name	:	'size',
								label	:	'Select column type',
								'values': [
									{text: '1/2', value: '1/2'},
									{text: '1/3', value: '1/3'},
									{text: '2/3', value: '2/3'},
									{text: '1/4', value: '1/4'},
									{text: '3/4', value: '3/4'},
									{text: '1/5', value: '1/5'},
									{text: '2/5', value: '2/5'},
									{text: '3/5', value: '3/5'},
									{text: '4/5', value: '4/5'},
									{text: '1/6', value: '1/6'},
									{text: '5/6', value: '5/6'},
								]
							},
							{
								type	:	'checkbox',
								name	:	'last',
								label	:	'Last column?',
								checked	:	false,								
							}],
							onsubmit: function( e ) {
								content = ed.selection.getContent();
								ed.insertContent( '[column size="'+ e.data.size + '" last="'+e.data.last+'"]' + content + '[/column]');
							}
						});
						}
					
                },
				
				/* -----------	HEADINGS	-----------	*/
                {
					text: 'Heading',
					value: 'Heading',
					onclick: function() {
						ed.windowManager.open( {
							title: 'Headings',
							body: [{
								type	:	'listbox',
								name	:	'h',
								label	:	'Select Heading',
								'values': [
									{text: 'H1', value: 'h1'},
									{text: 'H2', value: 'h2'},
									{text: 'H3', value: 'h3'},
									{text: 'H4', value: 'h4'},
									{text: 'H5', value: 'h5'},
									{text: 'H6', value: 'h6'}
								]
							},
							{
								type	:	'textbox',
								name	:	'font',
								label	:	'Google Font?',
							}],
							onsubmit: function( e ) {
								content = ed.selection.getContent();
								ed.insertContent( '[heading h="'+ e.data.h + '" font="'+e.data.font+'"]' + content + '[/heading]');
							}
						});
						}
					
                },
				
				/* -----------	CENTER HEADINGS	-----------	*/
                {
					text: 'Center Heading',
					value: 'Center Heading',
					onclick: function() {
						ed.windowManager.open( {
							title: 'Center Heading',
							body: [{
								type	:	'listbox',
								name	:	'h',
								label	:	'Select Heading',
								values: [
									{text: 'H1', value: 'h1'},
									{text: 'H2', value: 'h2'},
									{text: 'H3', value: 'h3'},
									{text: 'H4', value: 'h4'},
									{text: 'H5', value: 'h5'},
									{text: 'H6', value: 'h6'}
								]
							}],
							onsubmit: function( e ) {
								content = ed.selection.getContent();
								ed.insertContent( '[center_heading h="'+ e.data.h + '"]' + content + '[/center_heading]');
							}
						});
						}
					
                },				
				
				/* -----------	ELEMENTS	-----------	*/
                {
					text: 'Elements',
					value: 'Elements',
					menu: [
						/* --- Align --- */   
                        {	
                            text: 'Align',
                            value: 'Align',
                            onclick: function() {
								ed.windowManager.open( {
									title: 'Animations',
									body: [{
										type	:	'listbox',
										name	:	'align',
										label	:	'Alignment?',
										values	:	[
											{text: 'Left', value: 'left'},
											{text: 'Center', value: 'center'},
											{text: 'Right', value: 'right'},
										],
										std		:	'center',
									}],
									onsubmit: function( e ) {
										content = ed.selection.getContent();
										ed.insertContent( '[align align="'+ e.data.align + '"]<br>' + content + '<br>[/align]');
									}
								});
								}      
                        },
						
						/* --- List --- */   
                        {	
                            text: 'List',
                            value: 'List',
                            onclick: function() {
								ed.windowManager.open( {
									title: 'List',
									body: [{
										type	:	'listbox',
										name	:	'type',
										label	:	'Type',
										values	:	[
											{text: 'Star', value: 'star'},
											{text: 'Plus (+)', value: 'plus'},
											{text: 'Minus (-)', value: 'minus'},
											{text: 'Hash (#)', value: 'hash'},
										],
									}],
									onsubmit: function( e ) {
										content = ed.selection.getContent();
										ed.insertContent( '[list type="'+ e.data.type + '"]<br/>' + content + '<br/>[/list]');
									}
								});
								}      
                        },
						
						/* --- Iconbox --- */   
                        {	
                            text: 'Iconbox',
                            value: 'Iconbox',
                            onclick: function() {
								ed.windowManager.open( {
									title: 'Iconbox',
									body: [{
										type	:	'textbox',
										name	:	'icon',
										label	:	'Icon',
									},
									{
										type	:	'textbox',
										name	:	'name',
										label	:	'Name',
									}],
									onsubmit: function( e ) {
										content = ed.selection.getContent();
										ed.insertContent( '[iconbox icon="'+ e.data.icon + '" name="'+e.data.name+'"]' + content + '[/iconbox]');
									}
								});
								}      
                        },
						
						
						/* --- Small Iconbox --- */   
                        {	
                            text: 'Small Iconbox',
                            value: 'Small Iconbox',
                            onclick: function() {
								ed.windowManager.open( {
									title: 'Small Iconbox',
									body: [{
										type	:	'textbox',
										name	:	'icon',
										label	:	'Icon',
									},
									{
										type	:	'textbox',
										name	:	'name',
										label	:	'Name',
									}],
									onsubmit: function( e ) {
										content = ed.selection.getContent();
										ed.insertContent( '[small_iconbox icon="'+ e.data.icon + '" name="'+e.data.name+'"]' + content + '[/small_iconbox]');
									}
								});
								}      
                        },
						
						
						/* --- Imagebox --- */   
                        {	
                            text: 'Imagebox',
                            value: 'Imagebox',
                            onclick: function() {
								ed.windowManager.open( {
									title: 'Imagebox',
									body: [{
										type	:	'textbox',
										name	:	'image',
										label	:	'Image URL',
									},
									{
										type	:	'textbox',
										name	:	'name',
										label	:	'Name',
									}],
									onsubmit: function( e ) {
										content = ed.selection.getContent();
										ed.insertContent( '[imagebox image="'+ e.data.image + '" name="'+e.data.name+'"]' + content + '[/imagebox]');
									}
								});
								}      
                        },
						
						/* --- Gmap --- */   
                        {	
                            text: 'Google map',
                            value: 'Google map',
                            onclick: function() {
								ed.windowManager.open( {
									title: 'Google map',
									body: [{
										type	:	'textbox',
										name	:	'src',
										label	:	'Map SRC',
									},
									{
										type	:	'textbox',
										name	:	'height',
										label	:	'Height (px)',
									}],
									onsubmit: function( e ) {
										content = ed.selection.getContent();
										ed.insertContent( '[gmap src="'+ e.data.src + '" height="'+e.data.height+'" /]');
									}
								});
								}      
                        },
						
						
						/* --- Fullwidth --- */   
                        {	
                            text: 'Fullwidth',
                            value: 'Fullwidth',
                            onclick: function() {
								ed.windowManager.open( {
									title: 'Fullwidth',
									body: [{
										type	:	'textbox',
										name	:	'padding',
										label	:	'Padding (px)',
									},
									{
										type	:	'textbox',
										name	:	'padding_top',
										label	:	'Padding Top (px)',
									},
									{
										type	:	'textbox',
										name	:	'padding_bottom',
										label	:	'Padding Bottom (px)',
									},
									{
										type	:	'textbox',
										name	:	'background_image',
										label	:	'Background Image',
									},
									{
										type	:	'checkbox',
										name	:	'background',
										label	:	'Background',
										checked	:	true,
									},
									{
										type	:	'checkbox',
										name	:	'border',
										label	:	'Border',
										checked	:	true,
									},
									{
										type	:	'checkbox',
										name	:	'container',
										label	:	'Container',
										checked	:	true,
									},
									{
										type	:	'checkbox',
										name	:	'parallax',
										label	:	'Parallax',
										checked	:	false,
									},
									{
										type	:	'textbox',
										name	:	'overlay',
										label	:	'Overlay Opacity (0-100%)',
									}],
									onsubmit: function( e ) {
										content = ed.selection.getContent();
										ed.insertContent( '[fullwidth padding="'+ e.data.padding + '" padding_top="'+e.data.padding_top+'" padding_bottom="'+e.data.padding_bottom+'" padding_top="'+e.data.padding_top+'" border="'+e.data.border+'" background="'+e.data.background+'" background_image="'+e.data.background_image+'" container="'+e.data.container+'" parallax="'+e.data.parallax+'" overlay="'+e.data.overlay+'"]' + content + '[/fullwidth]');
									}
								});
								}      
                        },
						
						
						/* --- Progress group --- */   
                        {	
                            text: 'Progress group',
                            value: 'Progress group',
                            onclick: function() {
								ed.insertContent('[progress_group]<br />[progress percent="60" name="Skill 1" color="primary" /]<br />[progress percent="70" name="Skill 2" color="primary" /]<br />[progress percent="80" name="Skill 3" color="primary" /]<br />[progress percent="90" name="Skill 4" color="primary" /]<br />[/progress_group]');
							}
                        },
						
						
						/* --- Progress --- */   
                        {	
                            text: 'Progress',
                            value: 'Progress',
                            onclick: function() {
								ed.windowManager.open( {
									title: 'Progress',
									body: [{
										type	:	'textbox',
										name	:	'percent',
										label	:	'Percent (0 - 100%)',
									},
									{
										type	:	'textbox',
										name	:	'name',
										label	:	'Name',
									},
									{
										type	:	'textbox',
										name	:	'color',
										label	:	'Color',
									}],
									onsubmit: function( e ) {
										content = ed.selection.getContent();
										ed.insertContent( '[progress name="'+ e.data.name + '" color="'+e.data.color +'" percent="'+e.data.percent+'" /]');
									}
								});
								}      
                        },
						
						
						/* --- Member --- */   
                        {	
                            text: 'Member',
                            value: 'Member',
                            onclick: function() {
								ed.windowManager.open( {
									title: 'Member',
									body: [{
										type	:	'textbox',
										name	:	'name',
										label	:	'Name',
									},
									{
										type	:	'textbox',
										name	:	'role',
										label	:	'Role',
									},
									{
										type	:	'textbox',
										name	:	'image',
										label	:	'Image URL',
									},
									{
										type	:	'textbox',
										name	:	'facebook',
										label	:	'Facebook',
									},
									{
										type	:	'textbox',
										name	:	'twitter',
										label	:	'Twitter',
									},
									{
										type	:	'textbox',
										name	:	'googleplus',
										label	:	'Google+',
									}],
									onsubmit: function( e ) {
										content = ed.selection.getContent();
										ed.insertContent( '[member image="'+ e.data.image + '" name="'+e.data.name+'" role="'+e.data.role+'" facebook="'+e.data.facebook+'" twitter="'+e.data.twitter+'" googleplus="'+e.data.googleplus+'"]' + content + '[/member]');
									}
								});
								}      
                        }
                        
                    ], // Elements MENU
                },	// ELEMENTS
				
				
				/* -----------	ELEMENTS 2	-----------	*/
                {
					text: 'Elements 2',
					value: 'Elements 2',
					menu: [
						
						/* --- Pricing --- */   
                        {	
                            text: 'Pricing',
                            value: 'Pricing',
                            onclick: function() {
								ed.insertContent( '[pricing]<br />[pricing_column title="Column 1" price="19.5" unit="$" unit_position="left" per="month" button="Sign Up" link="http://" target="_self"]<br /><ul><li>Feature 1</li><li>Feature 2</li><li>Feature 3</li></ul>[/pricing_column]<br />[pricing_column title="Column 2" price="29.5" unit="$" unit_position="left" per="month" featured="true" color="primary" button="Sign Up" link="#" target="_self"]<br /><ul><li>Feature 1</li><li>Feature 2</li><li>Feature 3</li></ul>[/pricing_column]<br />[pricing_column title="Column 3" price="39.5" unit="$" unit_position="left" per="month" button="Sign Up" link="#" target="_self"]<br /><ul><li>Feature 1</li><li>Feature 2</li><li>Feature 3</li></ul>[/pricing_column]<br />[/pricing]');
								}
                        },
						
						
						/* --- Brands --- */   
                        {	
                            text: 'Brands',
                            value: 'Brands',
                            onclick: function() {
								ed.insertContent( '[brands]<br />[brand title="Brand 1" link="#" target="_self"]Image URL[/brand]<br />[brand title="Brand 2" link="#" target="_self"]Image URL[/brand]<br />[brand title="Brand 3" link="#" target="_self"]Image URL[/brand]<br />[/brands]');
								}      
                        },
						
						
						/* --- Dropcap --- */   
                        {	
                            text: 'Dropcap',
                            value: 'Dropcap',
                            onclick: function() {
								content = ed.selection.getContent();
								ed.insertContent( '[dropcap]' + content + '[/dropcap]' );
								}      
                        },
						
						/* --- Text Dropcap --- */   
                        {	
                            text: 'Text Dropcap',
                            value: 'Text Dropcap',
                            onclick: function() {
								content = ed.selection.getContent();
								ed.insertContent( '[text_dropcap]' + content + '[/text_dropcap]' );
								}      
                        },
						
						
						/* --- Video --- */   
                        {	
                            text: 'Video',
                            value: 'Video',
                            onclick: function() {
								content = ed.selection.getContent();
								ed.insertContent( '[wi_video]' + content + '[/wi_video]');
								}      
                        },
						
						/* --- Soundcloud --- */   
                        {	
                            text: 'Soundcloud',
                            value: 'Soundcloud',
                            onclick: function() {
								content = ed.selection.getContent();
								ed.insertContent( '[wi_soundcloud]' + content + '[/wi_soundcloud]');
							}      
                        },
						
						/* --- Highlight --- */   
                        {	
                            text: 'Highlight',
                            value: 'Highlight',
                            onclick: function() {
								ed.windowManager.open( {
									title: 'Highlight',
									body: [{
										type	:	'listbox',
										name	:	'style',
										label	:	'Style',
										values	:	[
											{text: '1', value: '1'},
											{text: '2', value: '2'},
										],
									}],
									onsubmit: function( e ) {
										content = ed.selection.getContent();
										ed.insertContent( '[highlight style="'+ e.data.style + '"]'+content+'[/highlight]');
									}
								});
								}      
                        },
						
                    ], // Elements 2 MENU
                },	// ELEMENTS 2
				
				
				/* -----------	ELEMENTS 3	-----------	*/
                {
					text: 'jQuery elements',
					value: 'jQuery elements',
					menu: [
						/* --- Accordion --- */   
                        {	
                            text: 'Accordion',
                            value: 'Accordion',
                            onclick: function() {
								ed.insertContent( '[accordion]<br />[toggle name="Section 1"]<br />Accordion Content<br />[/toggle]<br />[toggle name="Section 2"]<br />Accordion Content<br />[/toggle]<br />[toggle name="Section 3"]<br />Accordion Content<br />[/toggle]<br />[/accordion]' );
								}      
                        },
						
						/* --- Toggle --- */   
                        {	
                            text: 'Toggle',
                            value: 'Toggle',
                            onclick: function() {
								ed.windowManager.open( {
									title: 'Toggle',
									body: [{
										type	:	'textbox',
										name	:	'name',
										label	:	'Name'
									},
									{
										type	:	'checkbox',
										name	:	'open',
										label	:	'Open',
										checked	:	false																			
									}],
									onsubmit: function( e ) {
										content = ed.selection.getContent();
										ed.insertContent( '[toggle name="'+ e.data.name + '" open="'+e.data.open +'"]' + content + '[/toggle]');
									}
								});
								}      
                        },
						
						/* --- Tab --- */   
                        {	
                            text: 'Tab',
                            value: 'Tab',
                            onclick: function() {
								ed.insertContent( '[tab style="1"]<br />[tab_element name="Tab 1" icon=""]<br />Tab Content<br />[/tab_element]<br />[tab_element name="Tab 2" icon=""]<br />Tab Content<br />[/tab_element]<br />[tab_element name="Tab 3" icon=""]<br />Tab Content<br />[/tab_element]<br />[/tab]');
								}      
                        },
						
						
						/* --- Bigtext --- */   
                        {	
                            text: 'Bigtext',
                            value: 'Bigtext',
                            onclick: function() {
								ed.windowManager.open( {
									title: 'Bigtext',
									body: [{
										type	:	'textbox',
										name	:	'font',
										label	:	'Font',
									}],
									onsubmit: function( e ) {
										content = ed.selection.getContent();
										ed.insertContent( '[bigtext font="'+ e.data.font + '"]' + content + '[/bigtext]');
									}
								});
								}      
                        },
						
						
						/* --- Counter --- */   
                        {	
                            text: 'Counter',
                            value: 'Counter',
                            onclick: function() {
								ed.windowManager.open( {
									title: 'Counter',
									body: [{
										type	:	'textbox',
										name	:	'name',
										label	:	'Name',
									},
									{
										type	:	'textbox',
										name	:	'number',
										label	:	'Number',
									},
									{
										type	:	'textbox',
										name	:	'delay',
										label	:	'Delay',
									}],
									onsubmit: function( e ) {
										content = ed.selection.getContent();
										ed.insertContent( '[counter name="'+ e.data.name + '" number="'+e.data.number+'" delay="'+e.data.delay+'"]' + content + '[/counter]');
									}
								});
								}      
                        },
						
						/* --- Piechart --- */   
                        {	
                            text: 'Piechart',
                            value: 'Piechart',
                            onclick: function() {
								ed.windowManager.open( {
									title: 'Piechart',
									body: [
									{
										type	:	'textbox',
										name	:	'percent',
										label	:	'Percent (0 - 100%)',
									},
									{
										type	:	'textbox',
										name	:	'thickness',
										label	:	'Thickness',
									},
									{
										type	:	'textbox',
										name	:	'size',
										label	:	'Size',
									},
									{
										type	:	'textbox',
										name	:	'name',
										label	:	'Name',
									},
									{
										type	:	'textbox',
										name	:	'color',
										label	:	'Color',
									},
									{
										type	:	'textbox',
										name	:	'forecolor',
										label	:	'Forecolor',
									}],
									onsubmit: function( e ) {
										content = ed.selection.getContent();
										ed.insertContent( '[piechart percent="'+e.data.percent+'" thickness="'+e.data.thickness+'" size="'+e.data.size+'" name="'+e.data.name+'" color="'+e.data.color+'" forecolor="'+e.data.forecolor+'"]' + content + '[/piechart]');
									}
								});
								}      
                        },
						
						/* --- Flexslider --- */   
                        {	
                            text: 'Flexslider',
                            value: 'Flexslider',
                            onclick: function() {
								ed.insertContent( '[flexslider navi="true" auto="false" effect="slide"]<br />[slide link="" target="_self" title="" desc="" thumbnail=""]Image URL[/slide]<br />[slide link="" target="_self" title="" desc="" thumbnail=""]Image URL[/slide]<br />[slide link="" target="_self" title="" desc="" thumbnail=""]Image URL[/slide]<br />[/flexslider]');
									}
                        },
						
						/* --- Testimonials --- */   
                        {	
                            text: 'Testimonials',
                            value: 'Testimonials',
                            onclick: function() {
								ed.insertContent( '[testimonials auto="true" pager="false" effect="fade"]<br />[testimonial name="" from=""]CONTENT[/testimonial]<br />[testimonial name="" from=""]CONTENT[/testimonial]<br />[testimonial name="" from=""]CONTENT[/testimonial]<br />[/testimonials]');
									}
                        },
						
						/* --- Button --- */   
                        {	
                            text: 'Button',
                            value: 'Button',
                            onclick: function() {
								content = ed.selection.getContent();
								ed.insertContent( '[button color="primary" link="" target="_self" icon="" icon_position="right" size="normal" align="" fullwidth="false"]' + content + '[/button]');
									}
                        },
						
						/* --- Icon --- */   
                        {	
                            text: 'Icon',
                            value: 'Icon',
                            onclick: function() {
								content = ed.selection.getContent();
								ed.insertContent( '[icon icon="" link="" target="_self" title="Icon title" size="36" /]');
									}
                        },
						
						/* --- Spacer --- */   
                        {	
                            text: 'Spacer',
                            value: 'Spacer',
                            onclick: function() {
								ed.insertContent( '[spacer height="30" /]');
									}
                        },
						
                    ], // Elements 3 MENU
                },	// ELEMENTS 3
				
				/* -----------	Latest News	-----------	*/
				{	
					text: 'Latest News',
					value: 'Latest News',
					onclick: function() {
						ed.insertContent( '[latest_posts number="3" style="1" thumbnail="true" date="true" comments="true" author="false" excerpt="true" excerpt_length="14" readmore="false" category="" tag="" /]');
							}
				},
				
				/* -----------	Portfolio	-----------	*/
				{	
					text: 'Portfolio',
					value: 'Portfolio',
					onclick: function() {
						ed.insertContent( '[portfolio number="9" column="3" style="1" filter="true" pagination="true" crop="true" belowtitle="category" excerpt="true" excerpt_length="14" open="content" all="All" /]');
							}
				},
				
				],
			});

		},
		createControl : function(n, cm) {
			return null;
		}
	});

	tinymce.PluginManager.add('wi_shortcodes_button', tinymce.plugins.wi_shortcodes_button);

})();