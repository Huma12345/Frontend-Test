<?php

/*
Plugin Name:	Passster Age Gate
Plugin URI:		https://passster.io
Description: 	A modern and rock solid approach to age verification for your site.
Author: 		Patrick Posner
Version:		4.0.8
Text Domain:    content-warning-v2
Domain Path:    /languages
*/
define( 'PASSSTER_AGEGATE_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'PASSSTER_AGEGATE_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'PASSSTER_AGEGATE_ABSPATH', dirname( __FILE__ ) . DIRECTORY_SEPARATOR );
define( 'PASSSTER_AGEGATE_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
/* load setup */
require_once PASSSTER_AGEGATE_ABSPATH . 'inc' . DIRECTORY_SEPARATOR . 'setup.php';
/* localize */
$textdomain_dir = plugin_basename( dirname( __FILE__ ) ) . '/languages';
load_plugin_textdomain( 'content-warning-v2', false, $textdomain_dir );
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) && !class_exists( 'psag\\PSAG_Admin' ) ) {
    require __DIR__ . '/vendor/autoload.php';
}
/* migrate authorization meta from old plugin */

if ( !function_exists( 'migrate_page_authorization' ) ) {
    $plugin_data = get_plugin_data( PASSSTER_AGEGATE_PATH . DIRECTORY_SEPARATOR . 'content-warning-v2.php' );
    if ( '3.6' === $plugin_data['Version'] || '3.7' === $plugin_data['Version'] || '3.48' === $plugin_data['Version'] ) {
        add_action(
            'upgrader_process_complete',
            'migrate_page_authorization',
            10,
            2
        );
    }
    /**
     * Migrate authorization post meta
     *
     * @param object $upgrader_object
     * @param array  $options
     * @return void
     */
    function migrate_page_authorization( $upgrader_object, $options )
    {
        $posts_string = ',';
        $pages_string = ',';
        $page_restrictions = get_option( 'psag_restrictions' );
        if ( !isset( $page_restrictions ) || empty($page_restrictions) ) {
            $page_restrictions = array(
                'psag_display_mode'         => 'age-submit',
                'psag_restrict_default_age' => '21',
                'psag_select_categories'    => '',
                'psag_select_pages'         => '',
                'psag_select_posts'         => '',
                'psag_whitelist'            => 'off',
            );
        }
        $post_args = array(
            'posts_per_page' => -1,
            'meta_key'       => 'cwv3_auth',
            'meta_value'     => 'yes',
            'post_type'      => 'post',
        );
        $posts = get_posts( $post_args );
        
        if ( isset( $posts ) ) {
            foreach ( $posts as $post ) {
                $posts_string .= $post->ID . ',';
            }
            $page_restrictions['psag_select_posts'] = $posts_string;
            $page_restrictions['psag_whitelist'] = 'on';
        }
        
        $page_args = array(
            'posts_per_page' => -1,
            'meta_key'       => 'cwv3_auth',
            'meta_value'     => 'yes',
            'post_type'      => 'page',
        );
        $pages = get_posts( $page_args );
        
        if ( isset( $posts ) && !empty($posts) ) {
            foreach ( $pages as $page ) {
                $pages_string .= $page->ID . ',';
            }
            $page_restrictions['psag_select_pages'] = $pages_string;
            $page_restrictions['psag_whitelist'] = 'on';
        }
        
        update_option( 'psag_restrictions', $page_restrictions );
    }

}

psag\PSAG_Admin::init();
psag\PSAG_Loader::get_instance();
psag\PSAG_Customizer::get_instance();