<?php

namespace psag;

/**
 * Age Gate Templates Class
 */
class PSAG_Templates
{
    /**
     * Getter for forms
     *
     * @return string
     */
    public static function get_accept_form()
    {
        $restriction_options = get_option( 'psag_restrictions' );
        ob_start();
        include apply_filters( 'passster_agegate_accept_template', PASSSTER_AGEGATE_PATH . '/src/templates/accept-age.php' );
        $accept_template = ob_get_contents();
        ob_end_clean();
        $age = 18;
        if ( isset( $restriction_options['psag_restrict_default_age'] ) && !empty($restriction_options['psag_restrict_default_age']) ) {
            $age = $restriction_options['psag_restrict_default_age'];
        }
        /* migrate old options */
        $cww_headline = get_option( 'cwv3_d_title' );
        $cww_message = get_option( 'cwv3_d_msg' );
        $cww_enter_button = get_option( 'cwv3_enter_txt' );
        $cww_exit_button = get_option( 'cwv3_exit_txt' );
        $placeholders = array(
            '[PSAG_LOGO_IMAGE]'      => '<img src="' . get_theme_mod( 'passster_age_gate_general_logo', PASSSTER_AGEGATE_URL . '/assets/admin/sample-logo.png' ) . '" />',
            '[PSAG_LOGO_SLOGAN]'     => get_theme_mod( 'passster_age_gate_content_logo_slogan' ),
            '[PSAG_HEADLINE]'        => get_theme_mod( 'passster_age_gate_content_headline', __( 'Age Verification', 'content-warning-v2' ), $cww_headline ),
            '[PSAG_INSTRUCTION]'     => str_replace( '[age]', $age, get_theme_mod( 'passster_age_gate_content_instruction', sprintf( __( 'By clicking enter, I certify that I am over the age of <b>%s</b> and will comply with the above statement.', 'content-warning-v2' ), $age ), $cww_message ) ),
            '[PSAG_ENTER]'           => get_theme_mod( 'passster_age_gate_content_enter_button_label', __( 'Enter', 'content-warning-v2' ) ),
            '[PSAG_SEPARATOR_LABEL]' => get_theme_mod( 'passster_age_gate_content_separator_label', __( 'Or', 'content-warning-v2' ), $cww_enter_button ),
            '[PSAG_EXIT]'            => get_theme_mod( 'passster_age_gate_content_exit_button_label', __( 'Exit', 'content-warning-v2' ), $cww_exit_button ),
            '[PSAG_SUBTITLE]'        => get_theme_mod( 'passster_age_gate_content_subtitle_text', __( 'Always enjoy responsibily.', 'content-warning-v2' ) ),
        );
        $background_image = get_theme_mod( 'passster_age_gate_overlay_background' );
        
        if ( isset( $background_image ) && !empty($background_image) ) {
            $placeholders['[PSAG_OVERLAY_BACKGROUND]'] = 'style="background-image:url(' . get_theme_mod( 'passster_age_gate_overlay_background' ) . ');"';
        } else {
            $placeholders['[PSAG_OVERLAY_BACKGROUND]'] = '';
        }
        
        $layout_mode = get_theme_mod( 'passster_age_gate_general_layout_mode' );
        
        if ( 'one-column' === $layout_mode ) {
            $placeholders['[PSAG_ONE_COLUMN_LOGO]'] = '<img src="' . get_theme_mod( 'passster_age_gate_general_logo' ) . '">';
        } else {
            $placeholders['[PSAG_ONE_COLUMN_LOGO]'] = '';
        }
        
        foreach ( $placeholders as $placeholder => $string ) {
            $accept_template = str_replace( $placeholder, $string, $accept_template );
        }
        return $accept_template;
    }

}