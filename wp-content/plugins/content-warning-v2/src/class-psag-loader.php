<?php

namespace psag;

/**
 * Loader Class
 */
class PSAG_Loader
{
    /**
     * Return instance of PSAG_Loader
     *
     * @return void
     */
    public static function get_instance()
    {
        new PSAG_Loader();
    }
    
    /**
     * Constructor for PSAG_Loader
     */
    public function __construct()
    {
        add_action( 'wp_footer', array( $this, 'load_template' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'add_template_assets' ) );
    }
    
    /**
     * Output the selected templates based on given options
     *
     * @return void
     */
    public function load_template()
    {
        $current_id = get_the_id();
        $general_options = get_option( 'psag_options' );
        $restriction_options = get_option( 'psag_restrictions' );
        $post_ids = PSAG_Helper::get_post_ids();
        $category_ids = PSAG_Helper::get_post_ids_from_category();
        $ids = array_unique( array_merge( $post_ids, $category_ids ) );
        $mode = 'whitelist';
        if ( isset( $restriction_options['psag_whitelist'] ) && 'on' === $restriction_options['psag_whitelist'] ) {
            $mode = 'blacklist';
        }
        
        if ( isset( $general_options['psag_options_users_bypass_registered'] ) && 'on' === $general_options['psag_options_users_bypass_registered'] ) {
            if ( false === is_user_logged_in() ) {
                
                if ( empty($ids) ) {
                    
                    if ( 'whitelist' === $mode ) {
                        $template = PSAG_Templates::get_accept_form();
                        echo  $template ;
                    }
                
                } else {
                    
                    if ( 'whitelist' === $mode ) {
                        
                        if ( in_array( $current_id, $ids ) ) {
                            $template = PSAG_Templates::get_accept_form();
                            echo  $template ;
                        }
                    
                    } elseif ( 'blacklist' === $mode ) {
                        
                        if ( !in_array( $current_id, $ids ) ) {
                            $template = PSAG_Templates::get_accept_form();
                            echo  $template ;
                        }
                    
                    }
                
                }
            
            }
        } else {
            
            if ( is_null( $ids ) || empty($ids) ) {
                
                if ( 'whitelist' === $mode ) {
                    $template = PSAG_Templates::get_accept_form();
                    echo  $template ;
                }
            
            } else {
                
                if ( 'whitelist' === $mode ) {
                    
                    if ( in_array( $current_id, $ids ) ) {
                        $template = PSAG_Templates::get_accept_form();
                        echo  $template ;
                    }
                
                } elseif ( 'blacklist' === $mode ) {
                    
                    if ( !in_array( $current_id, $ids ) ) {
                        $template = PSAG_Templates::get_accept_form();
                        echo  $template ;
                    }
                
                }
            
            }
        
        }
    
    }
    
    /**
     * Enqueue assets based on options
     *
     * @return void
     */
    public function add_template_assets()
    {
        $current_id = get_the_id();
        $restriction_options = get_option( 'psag_restrictions' );
        $general_options = get_option( 'psag_options' );
        $post_ids = PSAG_Helper::get_post_ids();
        $category_ids = PSAG_Helper::get_post_ids_from_category();
        $ids = array_unique( array_merge( $post_ids, $category_ids ) );
        $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min' );
        
        if ( !isset( $general_options['psag_session_name'] ) || empty($general_options['psag_session_name']) ) {
            $session_name = 'psag_session';
        } else {
            $session_name = $general_options['psag_session_name'];
        }
        
        
        if ( isset( $restriction_options['psag_restrict_default_age'] ) ) {
            $age = $restriction_options['psag_restrict_default_age'];
        } else {
            $age = 18;
        }
        
        
        if ( isset( $restriction_options['psag_display_mode'] ) ) {
            $display_mode = $restriction_options['psag_display_mode'];
        } else {
            $display_mode = 'age-submit';
        }
        
        
        if ( isset( $general_options['psag_options_toggle_testmode'] ) ) {
            $test_mode = $general_options['psag_options_toggle_testmode'];
        } else {
            $test_mode = 'off';
        }
        
        
        if ( isset( $general_options['psag_options_redirect_url'] ) ) {
            $exit_url = $general_options['psag_options_redirect_url'];
        } else {
            $exit_url = get_bloginfo( 'url' );
        }
        
        
        if ( isset( $general_options['psag_options_redirect_url'] ) ) {
            $exit_url = $general_options['psag_options_redirect_url'];
        } else {
            $exit_url = get_bloginfo( 'url' );
        }
        
        $options = array(
            'age'            => $age,
            'display_mode'   => $display_mode,
            'session_name'   => $session_name,
            'error_message'  => sprintf( __( 'Sorry, only persons over the age of %s may enter this site', 'content-warning-v2' ), esc_html( $age ) ),
            'test_mode'      => $test_mode,
            'exit_url'       => $exit_url,
            'blur_container' => get_theme_mod( 'passster_age_gate_general_blur_effect_container' ),
        );
        $mode = 'whitelist';
        if ( isset( $restriction_options['psag_whitelist'] ) && 'on' === $restriction_options['psag_whitelist'] ) {
            $mode = 'blacklist';
        }
        
        if ( isset( $general_options['psag_options_users_bypass_registered'] ) && 'on' === $general_options['psag_options_users_bypass_registered'] ) {
            if ( false === is_user_logged_in() ) {
                
                if ( empty($ids) ) {
                    
                    if ( 'whitelist' === $mode && false === PSAG_Helper::bot_detected() ) {
                        wp_enqueue_script( 'psag-public-js', PASSSTER_AGEGATE_URL . '/assets/public/psag-public' . $suffix . '.js', array( 'jquery' ) );
                        wp_localize_script( 'psag-public-js', 'options', $options );
                    }
                
                } else {
                    
                    if ( 'whitelist' === $mode && false === PSAG_Helper::bot_detected() ) {
                        
                        if ( in_array( $current_id, $ids ) ) {
                            wp_enqueue_script( 'psag-public-js', PASSSTER_AGEGATE_URL . '/assets/public/psag-public' . $suffix . '.js', array( 'jquery' ) );
                            wp_localize_script( 'psag-public-js', 'options', $options );
                        }
                    
                    } elseif ( 'blacklist' === $mode && false === PSAG_Helper::bot_detected() ) {
                        
                        if ( !in_array( $current_id, $ids ) ) {
                            wp_enqueue_script( 'psag-public-js', PASSSTER_AGEGATE_URL . '/assets/public/psag-public' . $suffix . '.js', array( 'jquery' ) );
                            wp_localize_script( 'psag-public-js', 'options', $options );
                        }
                    
                    }
                
                }
            
            }
        } else {
            
            if ( empty($ids) ) {
                
                if ( 'whitelist' === $mode && false === PSAG_Helper::bot_detected() ) {
                    wp_enqueue_script(
                        'psag-public-js',
                        PASSSTER_AGEGATE_URL . '/assets/public/psag-public' . $suffix . '.js',
                        array( 'jquery' ),
                        1,
                        true
                    );
                    wp_localize_script( 'psag-public-js', 'options', $options );
                }
            
            } else {
                
                if ( 'whitelist' === $mode && false === PSAG_Helper::bot_detected() ) {
                    
                    if ( in_array( $current_id, $ids ) ) {
                        wp_enqueue_script(
                            'psag-public-js',
                            PASSSTER_AGEGATE_URL . '/assets/public/psag-public' . $suffix . '.js',
                            array( 'jquery' ),
                            1,
                            true
                        );
                        wp_localize_script( 'psag-public-js', 'options', $options );
                    }
                
                } elseif ( 'blacklist' === $mode && false === PSAG_Helper::bot_detected() ) {
                    
                    if ( !in_array( $current_id, $ids ) ) {
                        wp_enqueue_script(
                            'psag-public-js',
                            PASSSTER_AGEGATE_URL . '/assets/public/psag-public' . $suffix . '.js',
                            array( 'jquery' ),
                            1,
                            true
                        );
                        wp_localize_script( 'psag-public-js', 'options', $options );
                    }
                
                }
            
            }
        
        }
    
    }

}