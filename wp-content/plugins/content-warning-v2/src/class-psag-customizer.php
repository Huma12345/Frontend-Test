<?php

namespace psag;

/**
 * Customizer Class
 */
class PSAG_Customizer
{
    /**
     * Constructor for Customizer
     */
    public function __construct()
    {
        add_action( 'customize_register', array( $this, 'customize_register' ) );
        add_action( 'wp_footer', array( $this, 'dynamic_styles' ) );
    }
    
    /**
     * Get instance of PSAG_Customizer
     *
     * @return void
     */
    public static function get_instance()
    {
        new PSAG_Customizer();
    }
    
    /**
     * Register settings in the Customizer
     *
     * @param object $wp_customize
     * @return void
     */
    public function customize_register( $wp_customize )
    {
        /* add separator setting */
        require_once PASSSTER_AGEGATE_PATH . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'customizer' . DIRECTORY_SEPARATOR . 'customizer-control-separator.php';
        $wp_customize->add_panel( 'passster_age_gate', array(
            'priority'       => 999,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'Passster Age Gate', 'content-warning-v2' ),
        ) );
        /* general section */
        $wp_customize->add_section( 'passster_age_gate_general', array(
            'title' => __( 'General', 'content-warning-v2' ),
            'panel' => 'passster_age_gate',
        ) );
        /* background color - form container */
        require_once PASSSTER_AGEGATE_PATH . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'customizer' . DIRECTORY_SEPARATOR . 'customizer-alpha-color-picker.php';
        $wp_customize->add_setting( 'passster_age_gate_background_color', array(
            'default'    => 'rgba(0,0,0,0.3)',
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport'  => 'refresh',
        ) );
        $wp_customize->add_control( new \Customize_Alpha_Color_Control( $wp_customize, 'alpha_color_control', array(
            'label'        => __( 'Background color', 'content-warning-v2' ),
            'section'      => 'passster_age_gate_general',
            'settings'     => 'passster_age_gate_background_color',
            'show_opacity' => true,
            'palette'      => array(),
        ) ) );
        /* background image overlay */
        $wp_customize->add_setting( 'passster_age_gate_overlay_background', array(
            'transport' => 'refresh',
        ) );
        $wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'passster_age_gate_overlay_background', array(
            'label'    => __( 'Upload your overlay background image', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_general',
            'settings' => 'passster_age_gate_overlay_background',
        ) ) );
        /* max-width */
        $wp_customize->add_setting( 'passster_age_gate_general_container_width', array(
            'default' => 650,
        ) );
        $wp_customize->add_control( 'passster_age_gate_general_container_width_control', array(
            'label'    => __( 'Container width (px)', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_general',
            'settings' => 'passster_age_gate_general_container_width',
            'type'     => 'number',
        ) );
        /* layout mode */
        $wp_customize->add_setting( 'passster_age_gate_general_layout_mode', array(
            'default' => 'one-column',
        ) );
        $wp_customize->add_control( 'passster_age_gate_general_layout_mode_control', array(
            'label'    => __( 'Layout Mode', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_general',
            'settings' => 'passster_age_gate_general_layout_mode',
            'type'     => 'select',
            'choices'  => array(
            'one-column'  => __( 'One Column', 'content-warning-v2' ),
            'two-columns' => __( 'Two Columns', 'content-warning-v2' ),
        ),
        ) );
        /* z-index age gate box */
        $wp_customize->add_setting( 'passster_age_gate_zindex_box', array(
            'default' => 9999999,
        ) );
        $wp_customize->add_control( 'passster_age_gate_zindex_box_control', array(
            'label'    => __( 'Z-Index Age Gate Box', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_general',
            'settings' => 'passster_age_gate_zindex_box',
            'type'     => 'number',
        ) );
        /* z-index age gate overlay */
        $wp_customize->add_setting( 'passster_age_gate_zindex_overlay', array(
            'default' => 99999,
        ) );
        $wp_customize->add_control( 'passster_age_gate_zindex_overlay_control', array(
            'label'    => __( 'Z-Index Age Gate Overlay', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_general',
            'settings' => 'passster_age_gate_zindex_overlay',
            'type'     => 'number',
        ) );
        /* separator */
        $wp_customize->add_setting( 'passster_age_gate_general_separator_1', array() );
        $wp_customize->add_control( new \PSAG_Separator_Control( $wp_customize, 'passster_age_gate_general_separator_1', array(
            'section' => 'passster_age_gate_general',
        ) ) );
        /* logo upload */
        $wp_customize->add_setting( 'passster_age_gate_general_logo', array(
            'transport' => 'refresh',
        ) );
        $wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'passster_age_gate_general_logo', array(
            'label'    => __( 'Upload your Logo', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_general',
            'settings' => 'passster_age_gate_general_logo',
        ) ) );
        /* background image upload */
        $wp_customize->add_setting( 'passster_age_gate_general_background_image_left', array(
            'transport' => 'refresh',
        ) );
        $wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'passster_age_gate_general_background_image_left', array(
            'label'    => __( 'Background image (left column)', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_general',
            'settings' => 'passster_age_gate_general_background_image_left',
        ) ) );
        /* separator */
        $wp_customize->add_setting( 'passster_age_gate_general_separator_2', array() );
        $wp_customize->add_control( new \PSAG_Separator_Control( $wp_customize, 'passster_age_gate_general_separator_2', array(
            'section' => 'passster_age_gate_general',
        ) ) );
        /* blur effect */
        $wp_customize->add_setting( 'passster_age_gate_general_blur_effect', array(
            'default' => false,
        ) );
        $wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'passster_age_gate_general_blur_effect', array(
            'label'    => __( 'Use blur effect', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_general',
            'settings' => 'passster_age_gate_general_blur_effect',
            'type'     => 'checkbox',
        ) ) );
        /* blur container */
        $wp_customize->add_setting( 'passster_age_gate_general_blur_effect_container', array(
            'default' => __( '#page', 'content-warning-v2' ),
        ) );
        $wp_customize->add_control( 'passster_age_gate_general_blur_effect_container_control', array(
            'label'    => __( 'Blur effect container', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_general',
            'settings' => 'passster_age_gate_general_blur_effect_container',
            'type'     => 'text',
        ) );
        /* blur strength */
        $wp_customize->add_setting( 'passster_age_gate_general_blur_effect_strength', array(
            'default' => __( '3', 'content-warning-v2' ),
        ) );
        $wp_customize->add_control( 'passster_age_gate_general_blur_effect_strength_control', array(
            'label'    => __( 'Blur effect strength', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_general',
            'settings' => 'passster_age_gate_general_blur_effect_strength',
            'type'     => 'text',
        ) );
        /* content section */
        $wp_customize->add_section( 'passster_age_gate_content', array(
            'title' => __( 'Texts', 'content-warning-v2' ),
            'panel' => 'passster_age_gate',
        ) );
        $cww_headline = get_option( 'cwv3_d_title' );
        
        if ( isset( $cww_headline ) && !empty($cww_headline) ) {
            $headline_default = $cww_headline;
        } else {
            $headline_default = __( 'Age Verification', 'content-warning-v2' );
        }
        
        /* instructions headline */
        $wp_customize->add_setting( 'passster_age_gate_content_headline', array(
            'default' => $headline_default,
        ) );
        $wp_customize->add_control( 'passster_age_gate_content_headline_control', array(
            'label'    => __( 'Headline', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_content',
            'settings' => 'passster_age_gate_content_headline',
            'type'     => 'text',
        ) );
        $cww_message = get_option( 'cwv3_d_msg' );
        
        if ( isset( $cww_message ) && !empty($cww_message) ) {
            $message_default = $cww_message;
        } else {
            $message_default = __( 'By clicking enter, I certify that I am over the age of [age] and will comply with the above statement.', 'content-warning-v2' );
        }
        
        /* instructions text */
        $wp_customize->add_setting( 'passster_age_gate_content_instruction', array(
            'default' => $message_default,
        ) );
        $wp_customize->add_control( 'passster_age_gate_content_instruction_control', array(
            'label'    => __( 'Instructions Text', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_content',
            'settings' => 'passster_age_gate_content_instruction',
            'type'     => 'textarea',
        ) );
        $cww_enter_button = get_option( 'cwv3_enter_txt' );
        
        if ( isset( $cww_enter_button ) && !empty($cww_enter_button) ) {
            $enter_button_default = $cww_enter_button;
        } else {
            $enter_button_default = __( 'Enter', 'content-warning-v2' );
        }
        
        /* enter button */
        $wp_customize->add_setting( 'passster_age_gate_content_enter_button_label', array(
            'default' => $enter_button_default,
        ) );
        $wp_customize->add_control( 'passster_age_gate_content_enter_button_label_control', array(
            'label'    => __( 'Enter Button Label', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_content',
            'settings' => 'passster_age_gate_content_enter_button_label',
            'type'     => 'text',
        ) );
        $cww_exit_button = get_option( 'cwv3_exit_txt' );
        
        if ( isset( $cww_exit_button ) && !empty($cww_exit_button) ) {
            $exit_button_default = $cww_exit_button;
        } else {
            $exit_button_default = __( 'Exit', 'content-warning-v2' );
        }
        
        /* exit button */
        $wp_customize->add_setting( 'passster_age_gate_content_exit_button_label', array(
            'default' => $exit_button_default,
        ) );
        $wp_customize->add_control( 'passster_age_gate_content_exit_button_label_control', array(
            'label'    => __( 'Exit Button Label', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_content',
            'settings' => 'passster_age_gate_content_exit_button_label',
            'type'     => 'text',
        ) );
        /* separator text */
        $wp_customize->add_setting( 'passster_age_gate_content_separator_label', array(
            'default' => __( 'Or', 'content-warning-v2' ),
        ) );
        $wp_customize->add_control( 'passster_age_gate_content_separator_label_control', array(
            'label'    => __( 'Separator Text', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_content',
            'settings' => 'passster_age_gate_content_separator_label',
            'type'     => 'text',
        ) );
        /* subtitle text */
        $wp_customize->add_setting( 'passster_age_gate_content_subtitle_text', array(
            'default' => __( 'Always enjoy responsibily.', 'content-warning-v2' ),
        ) );
        $wp_customize->add_control( 'passster_age_gate_content_subtitle_text_control', array(
            'label'    => __( 'Subtitle', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_content',
            'settings' => 'passster_age_gate_content_subtitle_text',
            'type'     => 'text',
        ) );
        /* logo slogan */
        $wp_customize->add_setting( 'passster_age_gate_content_logo_slogan', array(
            'default' => __( 'THINC Pure products are only for use in states where the sale and consumption of such products are legal. ', 'content-warning-v2' ),
        ) );
        $wp_customize->add_control( 'passster_age_gate_content_logo_slogan_control', array(
            'label'    => __( 'Logo Slogan', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_content',
            'settings' => 'passster_age_gate_content_logo_slogan',
            'type'     => 'textarea',
        ) );
        /* color section */
        $wp_customize->add_section( 'passster_age_gate_colors', array(
            'title' => __( 'Colors', 'content-warning-v2' ),
            'panel' => 'passster_age_gate',
        ) );
        /* headline color */
        $wp_customize->add_setting( 'passster_age_gate_content_headline_color', array(
            'default' => '#370059',
        ) );
        $wp_customize->add_control( 'passster_age_gate_content_headline_color_control', array(
            'label'    => __( 'Headline color', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_colors',
            'settings' => 'passster_age_gate_content_headline_color',
            'type'     => 'color',
        ) );
        /* instruction color */
        $wp_customize->add_setting( 'passster_age_gate_content_instruction_color', array(
            'default' => '#7c7c7c',
        ) );
        $wp_customize->add_control( 'passster_age_gate_content_instruction_color_control', array(
            'label'    => __( 'Instruction color', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_colors',
            'settings' => 'passster_age_gate_content_instruction_color',
            'type'     => 'color',
        ) );
        /* separator color */
        $wp_customize->add_setting( 'passster_age_gate_content_separator_color', array(
            'default' => '#7c7c7c',
        ) );
        $wp_customize->add_control( 'passster_age_gate_content_separator_color_control', array(
            'label'    => __( 'Separator color', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_colors',
            'settings' => 'passster_age_gate_content_separator_color',
            'type'     => 'color',
        ) );
        /* subtitle color */
        $wp_customize->add_setting( 'passster_age_gate_content_subtitle_color', array(
            'default' => '#7c7c7c',
        ) );
        $wp_customize->add_control( 'passster_age_gate_content_subtitle_color_control', array(
            'label'    => __( 'Subtitle color', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_colors',
            'settings' => 'passster_age_gate_content_subtitle_color',
            'type'     => 'color',
        ) );
        /* logo slogan color */
        $wp_customize->add_setting( 'passster_age_gate_content_logo_slogan_color', array(
            'default' => '#fff',
        ) );
        $wp_customize->add_control( 'passster_age_gate_content_logo_slogan_color_control', array(
            'label'    => __( 'Logo slogan color', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_colors',
            'settings' => 'passster_age_gate_content_logo_slogan_color',
            'type'     => 'color',
        ) );
        /* separator */
        $wp_customize->add_setting( 'passster_age_gate_content_separator', array() );
        $wp_customize->add_control( new \PSAG_Separator_Control( $wp_customize, 'passster_age_gate_content_separator', array(
            'section' => 'passster_age_gate_colors',
        ) ) );
        /* background color - enter button */
        $wp_customize->add_setting( 'passster_age_gate_content_enter_button_background', array(
            'default' => '#54a984',
        ) );
        $wp_customize->add_control( 'passster_age_gate_content_enter_button_background_control', array(
            'label'    => __( 'Enter Button - Background Color', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_colors',
            'settings' => 'passster_age_gate_content_enter_button_background',
            'type'     => 'color',
        ) );
        /* font color - enter button */
        $wp_customize->add_setting( 'passster_age_gate_content_enter_button_color', array(
            'default' => '#fff',
        ) );
        $wp_customize->add_control( 'passster_age_gate_content_enter_button_color_control', array(
            'label'    => __( 'Enter Button - Font Color', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_colors',
            'settings' => 'passster_age_gate_content_enter_button_color',
            'type'     => 'color',
        ) );
        /* background color - enter button */
        $wp_customize->add_setting( 'passster_age_gate_content_exit_button_background', array(
            'default' => '#370059',
        ) );
        $wp_customize->add_control( 'passster_age_gate_content_exit_button_background_control', array(
            'label'    => __( 'Exit Button - Background Color', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_colors',
            'settings' => 'passster_age_gate_content_exit_button_background',
            'type'     => 'color',
        ) );
        /* font color - enter button */
        $wp_customize->add_setting( 'passster_age_gate_content_exit_button_color', array(
            'default' => '#fff',
        ) );
        $wp_customize->add_control( 'passster_age_gate_content_exit_button_color_control', array(
            'label'    => __( 'Enter Button - Font Color', 'content-warning-v2' ),
            'section'  => 'passster_age_gate_colors',
            'settings' => 'passster_age_gate_content_exit_button_color',
            'type'     => 'color',
        ) );
    }
    
    /**
     * Output dynamic styles based on customizer options
     *
     * @return void
     */
    public function dynamic_styles()
    {
        ?>
		<style>
		.psag {
		display:none;
		}
		.psag a.btn {
		background-color: <?php 
        echo  esc_html( get_theme_mod( 'passster_age_gate_content_enter_button_background', '#a21fff' ) ) ;
        ?>;
		color: <?php 
        echo  esc_html( get_theme_mod( 'passster_age_gate_content_enter_button_color', '#fff' ) ) ;
        ?>;
		text-decoration: none;
		display: inline-block;
		letter-spacing: 0.1em;
		padding: 0.5em 0em;
		}
		.psag a.btn.btn-beta {
		background-color: <?php 
        echo  esc_html( get_theme_mod( 'passster_age_gate_content_exit_button_background', '#370059' ) ) ;
        ?>;
		color: <?php 
        echo  esc_html( get_theme_mod( 'passster_age_gate_content_exit_button_color', '#fff' ) ) ;
        ?>;
		}
		.psag .decor-line {
		position: relative;
		top: 0.7em;
		border-top: 1px solid #ccc;
		text-align: center;
		max-width: 40%;
		margin: 0.5em auto;
		display: block;
		padding: 0.1em 1em;
		color: #ccc;
		}
		.psag .decor-line span {
		background: #fff;
		color: <?php 
        echo  esc_html( get_theme_mod( 'passster_age_gate_content_separator_color', '#7c7c7c' ) ) ;
        ?>;
		position: relative;
		top: -0.7em;
		padding: 0.5em;
		text-transform: uppercase;
		letter-spacing: 0.1em;
		font-weight: 900;
		}
		.overlay-verify {
		background: <?php 
        echo  esc_html( get_theme_mod( 'passster_age_gate_background_color', 'rgba(0,0,0,0.3)' ) ) ;
        ?>;
		position: fixed;
		height: 100%;
		width: 100%;
		top: 0;
		left: 0;
		z-index: <?php 
        echo  esc_html( get_theme_mod( 'passster_age_gate_zindex_overlay', '99999' ) ) ;
        ?>;
		display:none;
		}
		.psag .box {
		background: #fff;
		position: absolute;
		left: 0;
		right: 0;
		top: 20%;
		bottom: 0;
		margin: 0 auto;
		width: 70%;
		max-width: <?php 
        echo  esc_attr( get_theme_mod( 'passster_age_gate_general_container_width', 550 ) ) ;
        ?>px;
		height: 40%;
		display: table;
		z-index: <?php 
        echo  esc_html( get_theme_mod( 'passster_age_gate_zindex_box', '99999999' ) ) ;
        ?>;
		}
		.psag .box .box-left, .psag .box .box-right {
		width: 100%;
		position: relative;
		text-align: center;
		padding: 10%;
		box-sizing: border-box;
		}
		@media (min-width: 54em) {
			.psag .box .box-left, .psag .box .box-right {
			display: table-cell;
			vertical-align: middle;
			width: 50%;
			}
		}
		.psag .box .box-left p, .psag .box .box-right p {
		position: relative;
		z-index: 3;
		}
		.psag .box .box-left {
		background: url(<?php 
        echo  esc_url( get_theme_mod( 'passster_age_gate_general_background_image_left', PASSSTER_AGEGATE_URL . '/assets/admin/sample-background.png' ) ) ;
        ?>) 50% 50%;
		background-size: cover;
		color: <?php 
        echo  esc_html( get_theme_mod( 'passster_age_gate_content_logo_slogan_color', '#fff' ) ) ;
        ?>;
		}
		.psag .box .box-left img {
		position: relative;
		z-index: 4;
		width: 18em;
		}
		.psag .box .box-left:after {
		content: '';
		position: absolute;
		z-index: 0;
		top: 0;
		left: 0;
		height: 100%;
		width: 100%;
		background-color: rgba(0, 0, 0, 0.4);
		}
		.psag .box .box-right {
		text-align: center;
		}
		.psag .box .box-right h3 {
		color: <?php 
        echo  esc_html( get_theme_mod( 'passster_age_gate_content_headline_color', '#7c7c7c' ) ) ;
        ?>;
		text-transform: uppercase;
		letter-spacing: 0.07em;
		border-bottom: 1px solid #eee;
		padding-bottom: 1em;
		margin: 0 auto;
		font-size: 1.2rem;
		}
		@media screen and ( max-width:380px ) {
			.psag .box .box-right h3 {
			font-size: 0.8rem;
			}
		}
		.psag .box .box-right p {
		color: <?php 
        echo  esc_html( get_theme_mod( 'passster_age_gate_content_instruction_color', '#7c7c7c' ) ) ;
        ?>;
		}
		.psag .box .box-right small {
		color: <?php 
        echo  esc_html( get_theme_mod( 'passster_age_gate_content_subtitle_color', '#7c7c7c' ) ) ;
        ?>;
		}
		.psag .box .box-right .btn {
		font-weight: 600;
		letter-spacing: 0.2em;
		padding: 0.9em 1em 0.7em;
		margin: 1em auto;
		display: block;
		}
		.psag .box-right img {
			max-width:100%;
		}
		<?php 
        $layout_mode = get_theme_mod( 'passster_age_gate_general_layout_mode', 'one-column' );
        if ( 'one-column' === $layout_mode ) {
            ?>
		.box-left {
			display: none !important;
		}
		<?php 
        }
        ?>
		<?php 
        $blur = get_theme_mod( 'passster_age_gate_general_blur_effect' );
        $blur_container = get_theme_mod( 'passster_age_gate_general_blur_effect_container' );
        $blur_strength = get_theme_mod( 'passster_age_gate_general_blur_effect_strength' );
        $current_id = get_the_id();
        $restriction_options = get_option( 'psag_restrictions' );
        $general_options = get_option( 'psag_options' );
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
                    
                    if ( 'whitelist' === $mode && false === PSAG_Helper::bot_detected() && true === $blur ) {
                        ?>
						<?php 
                        echo  esc_html( $blur_container ) ;
                        ?> {
							-webkit-filter: blur(<?php 
                        echo  esc_html( $blur_strength ) ;
                        ?>px);
							-moz-filter: blur(<?php 
                        echo  esc_html( $blur_strength ) ;
                        ?>px);
							-ms-filter: blur(<?php 
                        echo  esc_html( $blur_strength ) ;
                        ?>px);
							-o-filter: blur(<?php 
                        echo  esc_html( $blur_strength ) ;
                        ?>px);
							filter: blur(<?php 
                        echo  esc_html( $blur_strength ) ;
                        ?>px);
						}
						<?php 
                    }
                
                } else {
                    
                    if ( 'whitelist' === $mode && false === PSAG_Helper::bot_detected() ) {
                        
                        if ( in_array( $current_id, $ids ) ) {
                            ?>
						<?php 
                            echo  esc_html( $blur_container ) ;
                            ?> {
							-webkit-filter: blur(<?php 
                            echo  esc_html( $blur_strength ) ;
                            ?>px);
							-moz-filter: blur(<?php 
                            echo  esc_html( $blur_strength ) ;
                            ?>px);
							-ms-filter: blur(<?php 
                            echo  esc_html( $blur_strength ) ;
                            ?>px);
							-o-filter: blur(<?php 
                            echo  esc_html( $blur_strength ) ;
                            ?>px);
							filter: blur(<?php 
                            echo  esc_html( $blur_strength ) ;
                            ?>px);
						}
						<?php 
                        }
                    
                    } elseif ( 'blacklist' === $mode && false === PSAG_Helper::bot_detected() ) {
                        
                        if ( !in_array( $current_id, $ids ) ) {
                            ?>
						<?php 
                            echo  esc_html( $blur_container ) ;
                            ?> {
							-webkit-filter: blur(<?php 
                            echo  esc_html( $blur_strength ) ;
                            ?>px);
							-moz-filter: blur(<?php 
                            echo  esc_html( $blur_strength ) ;
                            ?>px);
							-ms-filter: blur(<?php 
                            echo  esc_html( $blur_strength ) ;
                            ?>px);
							-o-filter: blur(<?php 
                            echo  esc_html( $blur_strength ) ;
                            ?>px);
							filter: blur(<?php 
                            echo  esc_html( $blur_strength ) ;
                            ?>px);
						}
						<?php 
                        }
                    
                    }
                
                }
            
            }
        } else {
            
            if ( empty($ids) ) {
                
                if ( 'whitelist' === $mode && false === PSAG_Helper::bot_detected() ) {
                    ?>
						<?php 
                    echo  esc_html( $blur_container ) ;
                    ?> {
							-webkit-filter: blur(<?php 
                    echo  esc_html( $blur_strength ) ;
                    ?>px);
							-moz-filter: blur(<?php 
                    echo  esc_html( $blur_strength ) ;
                    ?>px);
							-ms-filter: blur(<?php 
                    echo  esc_html( $blur_strength ) ;
                    ?>px);
							-o-filter: blur(<?php 
                    echo  esc_html( $blur_strength ) ;
                    ?>px);
							filter: blur(<?php 
                    echo  esc_html( $blur_strength ) ;
                    ?>px);
						}
						<?php 
                }
            
            } else {
                
                if ( 'whitelist' === $mode && false === PSAG_Helper::bot_detected() ) {
                    
                    if ( in_array( $current_id, $ids ) ) {
                        ?>
						<?php 
                        echo  esc_html( $blur_container ) ;
                        ?> {
							-webkit-filter: blur(<?php 
                        echo  esc_html( $blur_strength ) ;
                        ?>px);
							-moz-filter: blur(<?php 
                        echo  esc_html( $blur_strength ) ;
                        ?>px);
							-ms-filter: blur(<?php 
                        echo  esc_html( $blur_strength ) ;
                        ?>px);
							-o-filter: blur(<?php 
                        echo  esc_html( $blur_strength ) ;
                        ?>px);
							filter: blur(<?php 
                        echo  esc_html( $blur_strength ) ;
                        ?>px);
						}
						<?php 
                    }
                
                } elseif ( 'blacklist' === $mode && false === PSAG_Helper::bot_detected() ) {
                    
                    if ( !in_array( $current_id, $ids ) ) {
                        ?>
						<?php 
                        echo  esc_html( $blur_container ) ;
                        ?> {
							-webkit-filter: blur(<?php 
                        echo  esc_html( $blur_strength ) ;
                        ?>px);
							-moz-filter: blur(<?php 
                        echo  esc_html( $blur_strength ) ;
                        ?>px);
							-ms-filter: blur(<?php 
                        echo  esc_html( $blur_strength ) ;
                        ?>px);
							-o-filter: blur(<?php 
                        echo  esc_html( $blur_strength ) ;
                        ?>px);
							filter: blur(<?php 
                        echo  esc_html( $blur_strength ) ;
                        ?>px);
						}
						<?php 
                    }
                
                }
            
            }
        
        }
        
        ?>
		</style>
		<?php 
    }

}