<?php // (C) Copyright Bobbing Wide 2017

class tests_functions extends BW_UnitTestCase {

	/**
	 * How to PHPUnit test a theme function that defines constants
	 * and calls add_action() etc?
	 */
	function test_genesis_image_functions_loaded() {
		$this->assertEquals( CHILD_THEME_NAME, 'Genesis image' );
	}
	
	/**
	 * If oik is active then we'll test that the text contains the shortcodes
	 * otherwise it'll just be the Copyright statement
	 */
	function test_genesis_image_footer_creds_text() {
		$text = genesis_image_footer_creds_text( "ignores this" );
		if ( function_exists( "bw_oik_add_shortcodes" ) ) {
			$this->assertStringStartsWith( "[bw_wpadmin]", $text );
		} else {
			$expected = "(C) Copyright Bobbing Wide 2015-2017";
			$this->assertEquals( $expected, $text );
		}
	}
	
	/** 
	 * Check the theme's been defined as expected
	 * Note: We're not testing the whole thing!
	 */ 
	function test_genesis_image_after_setup_theme() {
		global $_wp_theme_features;
		$this->assertTrue( $_wp_theme_features['woocommerce'] );
		$this->assertTrue( $_wp_theme_features['genesis-responsive-viewport'] );
	}

	/**
	 * This should work even when oik is not activated
	 * since it loads our own library files
	 */
	function test_genesis_image_theme_update() {
		$oik_update = genesis_image_theme_update();
		$this->assertInstanceOf( OIK_Theme_Update::class, $oik_update );
	}

	/**
	 * We're not implementing these tests yet.
	 */
	function test_genesis_image_admin_menu() {
		//do_action( "admin_init" );
		//do_action( "admin_menu" );
		//genesis_image_admin_menu();
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * We can't test this if the oik_update class is not loaded
	 */
	function test_genesis_image_register_theme_server() {
		//genesis_image_register_theme_server();
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * We can't test this if the oik_update class is not loaded
	 */
	function test_genesis_image_oik_admin_menu() {
		//genesis_image_oik_admin_menu();
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

}
