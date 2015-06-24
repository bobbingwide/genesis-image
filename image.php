<?php
/**
 * Template file for the image mime type
 *
 * We do want:
 * - Title
 * - full sized image	- before the content
 * - the description ( content ) not the caption ( excerpt )
 * - the description may contain shortcodes
 *
 * We don't want:
 * - Post info from meta data
 * - Published by
 * - Breadcrumbs
 * - Filed Under:
 *
 * Found out how to do this by using {@link genesis.wp-a2z.org}
 * and oik-bwtrace and good old grep.
 */
add_theme_support( 'html5' );

// Remove post info
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

// Remove breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

// Remove the entry meta in the entry footer. i.e. Remove the Filed Under:
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

// Put the image before the rest of the content.
add_action( 'genesis_entry_content', 'genesis_image_do_entry_content', 9 );

/**
 * Display the image
 * 
 * We know it's an image since the file is image.php
 */
function genesis_image_do_entry_content() {

	$img = genesis_get_image( array(
					'format'  => 'html',
					'size'    => genesis_get_option( 'image_size' ),
					'context' => 'archive',
					'attr'    => genesis_parse_attr( 'entry-image' ),
					) );

	if ( !empty( $img ) ) {
		echo $img;
	}   else  {
		//echo "Not got it yet";
	}
}


//* Run the Genesis loop
genesis();
