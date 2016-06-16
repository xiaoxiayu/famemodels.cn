/*
jQuery( function( $ )
{
	$( 'body' ).on( 'click', '.rwmb-thickbox-upload', function()
	{
		var $this = $( this ),
			$holder = $this.siblings( '.rwmb-images' ),
			post_id = $( '#post_ID' ).val(),
			field_id = $this.data( 'field_id' ),
			backup = window.send_to_editor;

		window.send_to_editor = function( html )
		{
			var $img = $( '<div />' ).append( html ).find( 'img' ),
				url = $img.attr( 'src' ),
				img_class = $img.attr( 'class' ),
				id = parseInt( img_class.replace( /\D/g, '' ), 10 );

			html = '<li id="item_' + id + '">';
			html += '<img src="' + url + '">';
			html += '<div class="rwmb-image-bar">';
			html += '<a class="rwmb-delete-file" href="#" data-attachment_id="' + id + '">×</a>';
			html += '</div>';
			html += '<input type="hidden" name="' + field_id + '[]" value="' + id + '">';
			html += '</li>';

			$holder.append( $( html ) ).removeClass( 'hidden' );

			tb_remove();
			window.send_to_editor = backup;
		}
		tb_show( '', 'media-upload.php?post_id=' + post_id + '&TB_iframe=true' );

		return false;
	} );
} );

*/

jQuery( function( $ ) {

// Uploading files
var file_frame;
 
  jQuery('.rwmb-thickbox-upload').live('click', function( event ){
	
	/* get elements */
	var $this = $( this ),
	$holder = $this.siblings( '.rwmb-images' ),
	post_id = $( '#post_ID' ).val(),
	field_id = $this.data( 'field_id' );														 
														 
 
    event.preventDefault();
 
    // If the media frame already exists, reopen it.
    if ( file_frame ) {
      file_frame.open();
      return;
    }
 
    // Create the media frame.
    file_frame = wp.media.frames.file_frame = wp.media({
      title: jQuery( this ).data( 'uploader_title' ),
      button: {
        text: jQuery( this ).data( 'uploader_button_text' ),
      },
      multiple: true  // Set to true to allow multiple files to be selected
    });
 
    // When an image is selected, run a callback.
    file_frame.on( 'select', function() {
      // We set multiple to false so only get one image from the uploader
	  
	  
		  var selection = file_frame.state().get('selection');
	 
				selection.map( function( attachment ) {
	 
					attachment = attachment.toJSON();
					html = '<li id="item_' + attachment.id + '">';
					html += '<img src="' + attachment.url + '" />';
					html += '<div class="rwmb-image-bar">';
					html += '<a class="rwmb-delete-file" href="#" data-attachment_id="' + attachment.id + '">×</a>';
					html += '</div>';
					html += '<input type="hidden" name="' + field_id + '[]" value="' + attachment.id + '">';
					html += '</li>';
					
					$holder.append( $( html ) ).removeClass( 'hidden' );
	 
		  // Do something with attachment.id and/or attachment.url here
		});
	  }); // on select
  
    // Finally, open the modal
    file_frame.open();
  });
  
}); // jQuery 