<?php
	/**
	 * Plugin name: MeetFox
	 * Description: Allows to set MeetFox code to the desired pages with shortcode, 
	 * globally or to selected pages.
	 * Author: MeetFox
	 * Author URI: https://meetfox.com
	 * Plugin URI: https://meetfox.com
	 * Version: 1.0
	 * Requires PHP: 7.2
	 * Requires at least: 5.2
	 * Text Domain: dodel-meetfox
	 * License: GPL v2
	 */
	
	namespace Dodel;

	if ( !class_exists( 'Options' ) ) {
		require_once(__DIR__.'/options.php');
	}
	require_once(__DIR__.'/admin-option.php');
	require_once(__DIR__.'/shortcodes.php');
	

	final class MeetFox{

		protected $options;

		public function __construct(){
			$this->options = get_option( 'meetfox-page' );

			//create admin settings page
			new Admin;

			//add shortcodes
			new Shortcodes;

			add_action( 'activated_plugin', [$this, 'redirect_upon_activation'] );
			add_action( 'wp_footer', [$this, 'process_footer']);
		}

		/**
		 * Redirect user to settings page after plugin activation
		 * @param  String $plugin Name of activated plugin
		 * @return Redirect
		 */
		public function redirect_upon_activation($plugin){
			if( $plugin == plugin_basename( __FILE__ ) ) {
		        exit( wp_redirect( admin_url( 'admin.php?page=meetfox' ) ) );
		    }
		}

		/**
		 * Function is called in wp_footer hook. It checks Meetfox options, and if floating widget should
		 * be visible on every page, or on selected pages, it outputs widget code.
		 * @return html
		 */
		public function process_footer(){
			$options = $this->options;

			if($this->options['meetfox_whole'])
				include 'templates/floating.php';

			if($this->options['meetfox_selected']){
				$id = get_queried_object_id();
				if(in_array($id, $this->options['meetfox_selected_posts']) || in_array($id, $this->options['meetfox_selected_pages']))
					include 'templates/floating.php';
			}
		}

		
	}

	new MeetFox;