<?php
/*
Plugin Name: SSL URL Quick Fix
Plugin URI: http://premium.wpmudev.org/project/pro-sites/
Description: Fixes issues in Pro Sites with broken urls that cause 404s and block Paypal redirects
Author: Jude (WPMU DEV)
Version: 1.0.1
Author URI: http://premium.wpmudev.org/
Text Domain: psts
Domain Path: /pro-sites-files/languages/
Network: true
*/

if(!class_exists('Pro_Sites_SSL_Fix')):
	class Pro_Sites_SSL_Fix {

		function __construct () { }

	// The starting point to this addon/class
		public static function serve () {
			$me = new self;
			$me->add_hooks();
		}
	// Hooks into psts_setting_checkout_url and fixes the url
		private function add_hooks () {
			add_filter('psts_setting_checkout_url', array($this,'ssl_url_fix'));
		}

		function ssl_url_fix( $setting, $default ) {
			// If permalink does not have http prepended then do it. 
			if (strpos($setting, "http://") !== 0)
					$setting = "http://". $setting ;

		return $setting ; 
		}

	}
endif;

// Check if the base plugin is installed before activating the addon 
add_action('plugins_loaded', 'init_ps_ssl_fix') ;

	function init_ps_ssl_fix () {
		if (class_exists('ProSites'))
			Pro_Sites_SSL_Fix::serve() ; 
	}
?>