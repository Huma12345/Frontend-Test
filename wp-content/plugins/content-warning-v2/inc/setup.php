<?php

/**
 * Helper function for freemius
 *
 * @return array
 */
function psag_fs()
{
    global  $psag_fs ;
    
    if ( !isset( $psag_fs ) ) {
        // Include Freemius SDK.
        require_once PASSSTER_AGEGATE_ABSPATH . 'inc' . DIRECTORY_SEPARATOR . 'freemius' . DIRECTORY_SEPARATOR . 'start.php';
        $psag_fs = fs_dynamic_init( array(
            'id'             => '2792',
            'slug'           => 'content-warning-v2',
            'type'           => 'plugin',
            'public_key'     => 'pk_e83b5b3147ec6b780093b99d8fbd4',
            'is_premium'     => false,
            'has_addons'     => false,
            'has_paid_plans' => true,
            'menu'           => array(
            'slug'           => 'passster_agegate_settings',
            'override_exact' => true,
            'contact'        => false,
            'support'        => false,
            'parent'         => array(
            'slug' => 'options-general.php',
        ),
        ),
            'is_live'        => true,
        ) );
    }
    
    return $psag_fs;
}

// Init Freemius.
psag_fs();
// Signal that SDK was initiated.
do_action( 'psag_fs_loaded' );
/**
 * Setup admin url for freemius
 *
 * @return string
 */
function psag_fs_settings_url()
{
    return admin_url( 'options-general.php?page=passster_agegate_settings' );
}

psag_fs()->add_filter( 'connect_url', 'psag_fs_settings_url' );
psag_fs()->add_filter( 'after_skip_url', 'psag_fs_settings_url' );
psag_fs()->add_filter( 'after_connect_url', 'psag_fs_settings_url' );
psag_fs()->add_filter( 'after_pending_connect_url', 'psag_fs_settings_url' );
/**
 * Clean up after uninstallation
 *
 * @return void
 */
function passster_age_gate_cleanup()
{
    $advanced_options = get_option( 'passster_advanced_settings' );
    
    if ( isset( $advanced_options ) ) {
        $options = array(
            'psag_restrictions',
            'psag_woocommerce',
            'psag_addons',
            'psag_options'
        );
        
        if ( is_multisite() ) {
            foreach ( $options as $option ) {
                delete_site_option( $option );
            }
        } else {
            foreach ( $options as $option ) {
                delete_option( $option );
            }
        }
    
    }

}

psag_fs()->add_action( 'after_uninstall', 'passster_age_gate_cleanup' );