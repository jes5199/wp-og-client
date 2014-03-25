<?php
/*
 Plugin Name: WP OpenGraph Poster
 Plugin URI: http://jes5199.com
 Description: Consume OpenGraph urls into posts
 Version: 1.0.0-RC1
 Author: Jesse Wolfe
 Author URI: http://jes5199.com/
 */

if(!class_exists('WP_OG_Client')) {
	class WP_OG_Client {
		const VERSION = '1.0.0-RC1';

		const SETTINGS_NAME = '_wp_og_client_settings';

    const POST_PAGE_SLUG = 'wp-og-client-post';

		public static function init() {
			self::add_actions();
			self::add_filters();
		}

		private static function add_actions() {
			if(is_admin()) {
				add_action('admin_menu', array(__CLASS__, 'add_post_page'));
        add_action('admin_action_og_post', array(__CLASS__, 'make_post') );
      }
		}

		private static function add_filters() {
			if(is_admin()) {
      }
		}

		public static function add_post_page() {
			$settings_page_hook_suffix = add_posts_page(__('OpenGraph Post'), __('OpenGraph Post'), 'edit_posts', self::POST_PAGE_SLUG, array(__CLASS__, 'display_post_page'));
		}

		public static function display_post_page() {
			include('views/backend/post.php');
		}

    public static function make_post( $content ){
      require_once('lib/og-client.php');

      $url = $_POST['og_url'];
      $post_id = wp_insert_post( post_for_og_url($url) );

      if($post_id){
        wp_redirect( admin_url( "post.php?post=$post_id&action=edit" )) ;
      } else {
        wp_redirect( admin_url( "edit.php?page=wp-og-client-post" )) ;
      }
    }

		public static function get_template_tag() {
			return '';
		}
	}

	require_once('lib/template-tags.php');
	WP_OG_Client::init();
}
