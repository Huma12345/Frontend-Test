<?php

namespace psag;

/**
 * Admin Options Class
 */
class PSAG_Admin
{
    /**
     * Setting up admin fields
     *
     * @return void
     */
    public static function init()
    {
        add_action( 'admin_enqueue_scripts', array( __CLASS__, 'add_admin_scripts' ) );
        
        if ( get_option( 'psag_admin_notice_shown' ) != 'on' ) {
            add_action( 'admin_notices', array( __CLASS__, 'psag_admin_notice' ) );
            add_action( 'admin_enqueue_scripts', array( __CLASS__, 'backend_script_notices' ) );
            add_action( 'wp_ajax_dismiss_notice', array( __CLASS__, 'backend_script_dismiss_notices' ) );
        }
        
        $settings = new PSAG_Settings();
        $settings->add_section( array(
            'id'    => 'psag_restrictions',
            'title' => __( 'Restrictions', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_restrictions', array(
            'id'      => 'psag_display_mode',
            'type'    => 'select',
            'name'    => __( 'Display Mode', 'content-warning-v2' ),
            'options' => array(
            'age-submit' => 'Yes or No',
        ),
        ) );
        $settings->add_field( 'psag_restrictions', array(
            'id'      => 'psag_restrict_default_age',
            'type'    => 'number',
            'name'    => __( 'Minimum Age', 'content-warning-v2' ),
            'default' => 18,
        ) );
        $settings->add_field( 'psag_restrictions', array(
            'id'      => 'psag_whitelist',
            'type'    => 'toggle',
            'default' => 'off',
            'name'    => __( 'Whitelist or Blacklist', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_restrictions', array(
            'id'   => 'psag_whitelist_documentation',
            'type' => 'documentation',
            'desc' => __( '<b>Whitelist:</b> select where the age gate should show.<br><b>Blacklist:</b> select where the age gate should <b>not</b> show.<br><br><b>No selection:</b> If you keep the following fields empty, the age gate show everywhere (whitelist) or never (blacklist).', 'content-warning-v2' ),
            'name' => __( 'How it works', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_restrictions', array(
            'id'    => 'psag_select_pages',
            'type'  => 'text',
            'class' => 'select-pages',
            'name'  => __( 'Select Pages', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_restrictions', array(
            'id'    => 'psag_select_posts',
            'type'  => 'text',
            'class' => 'select-posts',
            'name'  => __( 'Select Posts', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_restrictions', array(
            'id'    => 'psag_select_categories',
            'type'  => 'text',
            'class' => 'select-categories',
            'desc'  => __( 'This include / exclude all posts from the selected category', 'content-warning-v2' ),
            'name'  => __( 'Select Categories', 'content-warning-v2' ),
        ) );
        $settings->add_section( array(
            'id'    => 'psag_addons',
            'title' => __( 'Addons', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_addons', array(
            'id'   => 'psag_addons_information',
            'type' => 'documentation',
            'desc' => __( 'All Addons are included in the <b>pro version of Passster Age Gate</b>. Activate and use the advanced features to get the maximum of out of age verification', 'content-warning-v2' ),
            'name' => __( 'Explanation', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_addons', array(
            'id'   => 'psag_addons_woocommerce',
            'type' => 'title',
            'name' => '<h3>' . __( 'WooCommerce', 'content-warning-v2' ) . '</h3>',
        ) );
        $settings->add_field( 'psag_addons', array(
            'id'   => 'psag_addons_woocommerce_documentation',
            'type' => 'documentation',
            'desc' => __( 'The WooCommerce Addon allows you to whitelist/blacklist products from the age gate, exclude products from your store if the age does not match, add age verification to registration and checkout and save the age of your customers.', 'content-warning-v2' ),
            'name' => __( 'Description', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_addons', array(
            'id'      => 'psag_addons_woocommerce_toggle',
            'type'    => 'toggle',
            'default' => 'off',
            'name'    => __( 'Activate WooCommerce Addon', 'content-warning-v2' ),
            'premium' => 'premium',
        ) );
        $settings->add_field( 'psag_addons', array(
            'id'   => 'psag_addons_styles_title',
            'type' => 'title',
            'name' => '<h3>' . __( 'Additional Verification Modes', 'content-warning-v2' ) . '</h3>',
        ) );
        $settings->add_field( 'psag_addons', array(
            'id'   => 'psag_addons_styles_documentation',
            'type' => 'documentation',
            'desc' => __( 'The Additional Verification Modes Addon enhance Passster Age Gate with multiple new design options for your age verification. Add a date picker or use a simple age slider to let users verify their age.', 'content-warning-v2' ),
            'name' => __( 'Description', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_addons', array(
            'id'      => 'psag_addons_styles_toggle',
            'type'    => 'toggle',
            'default' => 'off',
            'name'    => __( 'Activate Additional Verification Modes Addon', 'content-warning-v2' ),
            'premium' => 'premium',
        ) );
        $settings->add_section( array(
            'id'    => 'psag_options',
            'title' => __( 'Options', 'content-warning-v2' ),
        ) );
        $cww_exit_url = get_option( 'cwv3_exit_link' );
        
        if ( isset( $cww_exit_url ) && !empty($cww_exit_url) ) {
            $exit_url = $cww_exit_url;
        } else {
            $exit_url = get_bloginfo( 'url' );
        }
        
        $settings->add_field( 'psag_options', array(
            'id'      => 'psag_options_redirect_url',
            'type'    => 'url',
            'desc'    => __( 'The redirect URL if the exit button was clicked', 'content-warning-v2' ),
            'name'    => __( 'Exit URL', 'content-warning-v2' ),
            'default' => $exit_url,
        ) );
        $settings->add_field( 'psag_options', array(
            'id'   => 'psag_options_testmode_title',
            'type' => 'title',
            'name' => '<h3>' . __( 'Testmode', 'content-warning-v2' ) . '</h3>',
        ) );
        $settings->add_field( 'psag_options', array(
            'id'   => 'psag_options_testmode_documentation',
            'type' => 'documentation',
            'desc' => __( 'When you activate the testmode, the age gate box will never close, so you can test every button and setting without reset the session.', 'content-protector' ),
            'name' => __( 'How to test', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_options', array(
            'id'   => 'psag_options_toggle_testmode',
            'type' => 'toggle',
            'name' => __( 'Activate the Testmode', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_options', array(
            'id'   => 'psag_options_session_title',
            'type' => 'title',
            'name' => '<h3>' . __( 'Session', 'content-warning-v2' ) . '</h3>',
        ) );
        $settings->add_field( 'psag_options', array(
            'id'   => 'psag_session_name',
            'type' => 'text',
            'desc' => __( 'Name of the age gate session key', 'content-warning-v2' ),
            'name' => __( 'Session name', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_options', array(
            'id'   => 'psag_options_users_title',
            'type' => 'title',
            'name' => '<h3>' . __( 'Users', 'content-warning-v2' ) . '</h3>',
        ) );
        $settings->add_field( 'psag_options', array(
            'id'   => 'psag_options_users_bypass_registered',
            'type' => 'toggle',
            'name' => __( 'Show for unregistered users only', 'content-warning-v2' ),
        ) );
    }
    
    /**
     * Enqueue admin scripts
     *
     * @return void
     */
    public static function add_admin_scripts()
    {
        $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min' );
        wp_enqueue_style(
            'psag-select-woo',
            PASSSTER_AGEGATE_URL . '/assets/admin/selectWoo.min.css',
            array(),
            1,
            'all'
        );
        wp_enqueue_script(
            'psag-select-woo',
            PASSSTER_AGEGATE_URL . '/assets/admin/selectWoo.full.min.js',
            array( 'jquery' ),
            1,
            true
        );
        wp_enqueue_style(
            'psag-admin',
            PASSSTER_AGEGATE_URL . '/assets/admin/psag-admin.css',
            array(),
            1,
            'all'
        );
        wp_enqueue_script(
            'psag-admin',
            PASSSTER_AGEGATE_URL . '/assets/admin/psag-admin' . $suffix . '.js',
            array( 'jquery' ),
            1,
            true
        );
        $autocomplete = array();
        $autocomplete['pages'] = PSAG_Helper::get_available_pages();
        $autocomplete['posts'] = PSAG_Helper::get_available_posts();
        $autocomplete['categories'] = PSAG_Helper::get_available_categories();
        wp_localize_script( 'psag-admin', 'autocomplete', $autocomplete );
    }
    
    /**
     * Add admin notice
     *
     * @return void
     */
    public static function psag_admin_notice()
    {
        $query['autofocus[panel]'] = 'passster_age_gate';
        $panel_link = add_query_arg( $query, admin_url( 'customize.php' ) );
        $text = sprintf( __( 'Thanks for using <b>Passster Age Gate</b>! Begin to setup your gate in your <a href="%s">customizer</a>.', 'content-warning-v2' ), $panel_link );
        
        if ( !empty($text) ) {
            ?>
			<div class="notice notice-warning is-dismissible psag-notice">
				<p><?php 
            echo  $text ;
            ?></p>
			</div>
			<?php 
        }
    
    }
    
    /**
     * Add admin notice script
     *
     * @return void
     */
    public static function backend_script_notices()
    {
        $min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : 'min.' );
        wp_enqueue_script(
            'psag-admin-notices',
            PASSSTER_AGEGATE_URL . '/assets/admin/psag-admin-notice.' . $min . 'js',
            array( 'jquery' ),
            wp_get_theme()->get( 'Version' )
        );
        wp_localize_script( 'psag-admin-notices', 'admin_notice_ajax_object', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
        ) );
    }
    
    /**
     * Remove admin notice and save option for deactivation
     *
     * @return void
     */
    public static function backend_script_dismiss_notices()
    {
        update_option( 'psag_admin_notice_shown', 'on' );
        exit;
    }

}