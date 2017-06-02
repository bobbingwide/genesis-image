<?php // (C) Copyright Bobbing Wide 2016,2017

genesis_image_functions_loaded();

/**
 * Function to invoke when genesis-image is loaded
 * 
 * Register the hooks for this theme
 */
function genesis_image_functions_loaded() {

	//* Child theme (do not remove) - is this really necessary? 
	define( 'CHILD_THEME_NAME', 'Genesis image' );
	define( 'CHILD_THEME_URL', 'https://www.bobbingwide.com/blog/oik-themes/genesis-image' );
	define( 'CHILD_THEME_VERSION', '1.1.0' );

	// Start the engine	- this is necessary if we invoke any genesis_ functions before 'init'
	//include_once( get_template_directory() . '/lib/init.php' );
	
	//* Add HTML5 markup structure
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	//* Add viewport meta tag for mobile browsers
	add_theme_support( 'genesis-responsive-viewport' );

	// Most other add_theme_support calls are unnecessary, as they are defaulted

	// Add support for structural wraps
	// add_theme_support( 'genesis-structural-wraps', array(
	// 	'header',
	// 	'nav',
	// 	'subnav',
	// 	'site-inner'
	// 	) );

	//* Add support for custom background
	//add_theme_support( 'custom-background' );

	//* Add support for 5-column footer widgets - requires extra CSS
	//add_theme_support( 'genesis-footer-widgets', 5 );

	add_filter( 'genesis_footer_creds_text', "genesis_image_footer_creds_text" );
	
	//remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
	
	// Remove post info
	//remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
	//add_action( 'genesis_entry_footer', 'genesis_oik_post_info' );
	//add_filter( "genesis_edit_post_link", "__return_false" );
	add_theme_support( 'woocommerce' );
	add_action( "after_setup_theme", "genesis_image_after_setup_theme" );
	
	// Implement update from oik servers
	add_action( "admin_menu", "genesis_image_admin_menu", 13  );
	add_action( "oik_register_theme_server", "genesis_image_register_theme_server" );
	add_action( "oik_admin_menu", "genesis_image_oik_admin_menu" );
}

/**
 * Display footer credits for the genesis-image theme
 * 
 * Only use shortcodes if oik is registered
 */
function genesis_image_footer_creds_text( $text ) {
	/**
	 * Cause shortcodes to be registered.
	 */
	do_action( "oik_add_shortcodes" );
	if ( function_exists( "bw_oik_add_shortcodes" ) ) {
		$text = "[bw_wpadmin]";
		$text .= '<br />';
		$text .= "[bw_copyright]"; 
		$text .= '<hr />';
		
		
		$text .= 'Genesis-image theme designed and developed by [bw_link text="Herb Miller" herbmiller.me] of';
		$text .= ' <a href="//www.bobbingwide.com" title="Bobbing Wide - web design, web development">[bw]</a>';
		$text .= '<br />';
		$text .= '[bw_power] and oik-plugins';
		
	} else {
		$text = "(C) Copyright Bobbing Wide 2015-2017";
	}
	return( $text );
}
 
/** 
 * Implement 'after_setup_theme' to see how the theme is defined
 */ 
function genesis_image_after_setup_theme() {
	genesis_image_trace_functions();
	global $_wp_theme_features;
	//bw_trace2( $_wp_theme_features );
}

/**
 * Return the oik theme update instance
 * 
 * Fetch the class and get the single instance
 */
function genesis_image_theme_update() {
	require_once( dirname( __FILE__ ) . "/libs/class-oik-theme-update.php" );
	$oik_update = OIK_Theme_Update::instance();
	return( $oik_update );
}

/**
 * Implement "admin_menu" 
 */
function genesis_image_admin_menu() {
	$oik_update = genesis_image_theme_update();
	$oik_update->admin_menu();
}

/**
 * Implement "oik_register_theme_server" 
 * 
 * We assume that oik_update::oik_register_theme_server() has been loaded, otherwise the action should not have been invoked.
 *
 */
function genesis_image_register_theme_server() {
	oik_update::oik_register_theme_server( __FILE__ );
}

/**
 * Implement "oik_admin_menu" 
 * 
 * We assume that oik_register_theme_server() has been loaded, otherwise the action should not have been invoked.
 *
 */
function genesis_image_oik_admin_menu() {
	oik_register_theme_server( __FILE__ );
}

/**
 * Register dummy trace functions if required
 *
 * These functions are expected to be defined by plugins.
 * We defer registering the functions as long as we can.
 */
function genesis_image_trace_functions() {
	if ( !function_exists( "bw_trace2" ) ) {
		function bw_trace2( $p=null ) { return $p; }
		function bw_backtrace() {}
	}
}
