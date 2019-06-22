<?php

namespace psag;

/**
 * Helper Functions
 */
class PSAG_Helper
{
    /**
     * Check for bot visits
     *
     * @return bool
     */
    public static function bot_detected()
    {
        return isset( $_SERVER['HTTP_USER_AGENT'] ) && preg_match( '/bot|crawl|slurp|spider|mediapartners|Google Page Speed Insights/i', $_SERVER['HTTP_USER_AGENT'] );
    }
    
    /**
     * Return available pages in admin page
     *
     * @return array
     */
    public static function get_available_pages()
    {
        $args = array(
            'posts_per_page' => -1,
            'post_type'      => 'page',
            'post_status'    => 'publish',
        );
        $pages = array();
        $posts = get_posts( $args );
        foreach ( $posts as $page ) {
            $_page = get_post( $page->ID );
            array_push( $pages, array( $page->post_title, $page->ID ) );
        }
        return $pages;
    }
    
    /**
     * Return available posts in admin page
     *
     * @return array
     */
    public static function get_available_posts()
    {
        $args = array(
            'posts_per_page' => -1,
            'post_type'      => 'post',
            'post_status'    => 'publish',
        );
        $posts = array();
        $post_objects = get_posts( $args );
        foreach ( $post_objects as $post ) {
            $_post = get_post( $post->ID );
            array_push( $posts, array( $post->post_title, $post->ID ) );
        }
        return $posts;
    }
    
    /**
     * Return available products in admin page
     *
     * @return array
     */
    public static function get_available_products()
    {
    }
    
    /**
     * Return available categories in admin page
     *
     * @return array
     */
    public static function get_available_categories()
    {
        $cats = get_terms( 'category', array(
            'hide_empty' => false,
        ) );
        $available_categories = array();
        if ( isset( $cats ) && is_array( $cats ) ) {
            foreach ( $cats as $cat ) {
                array_push( $available_categories, array( $cat->name, $cat->term_id ) );
            }
        }
        return $available_categories;
    }
    
    /**
     * Return available product categories in admin page
     *
     * @return array
     */
    public static function get_available_product_categories()
    {
    }
    
    /**
     * Get selected post ids
     *
     * @return array
     */
    public static function get_post_ids()
    {
        $ids = array();
        $restriction_options = get_option( 'psag_restrictions' );
        $restriction_woocommerce_options = get_option( 'psag_woocommerce' );
        
        if ( isset( $restriction_options['psag_select_pages'] ) && !empty($restriction_options['psag_select_pages']) ) {
            $page_ids = explode( ',', $restriction_options['psag_select_pages'] );
            foreach ( $page_ids as $id ) {
                if ( '' !== $id ) {
                    $ids[] = intval( $id );
                }
            }
        }
        
        
        if ( isset( $restriction_options['psag_select_posts'] ) && !empty($restriction_options['psag_select_posts']) ) {
            $post_ids = explode( ',', $restriction_options['psag_select_posts'] );
            foreach ( $post_ids as $id ) {
                if ( '' !== $id ) {
                    $ids[] = intval( $id );
                }
            }
        }
        
        return $ids;
    }
    
    /**
     * Get selected post ids from category
     *
     * @return array
     */
    public static function get_post_ids_from_category()
    {
        $restriction_options = get_option( 'psag_restrictions' );
        $ids = array();
        
        if ( isset( $restriction_options['psag_select_categories'] ) && !empty($restriction_options['psag_select_categories']) ) {
            $categories = explode( ',', $restriction_options['psag_select_categories'] );
            foreach ( $categories as $category_id ) {
                
                if ( '' !== $category_id ) {
                    $category = get_term_by( 'id', $category_id, 'category' );
                    $args = array(
                        'category'  => $category->term_id,
                        'post_type' => 'post',
                    );
                    $posts = get_posts( $args );
                    foreach ( $posts as $post ) {
                        $ids[] = intval( $post->ID );
                    }
                }
            
            }
        }
        
        return $ids;
    }
    
    /**
     * Get selected post ids from product category
     *
     * @return array
     */
    public static function get_post_ids_from_product_category()
    {
    }
    
    /**
     * Get selected post ids for exclusion
     *
     * @return array
     */
    public static function get_exclude_product_ids()
    {
    }
    
    /**
     * Get selected post ids for exclusion from product category
     *
     * @return array
     */
    public static function get_exclude_product_ids_from_product_category()
    {
    }
    
    /**
     * check for active addons
     *
     * @param string $addon
     * @return boolean
     */
    public static function is_addon_active( $addon )
    {
        $addons = get_option( 'psag_addons' );
        
        if ( isset( $addons ) && !empty($addons) ) {
            switch ( $addon ) {
                case 'woocommerce':
                    
                    if ( 'on' === $addons['psag_addons_woocommerce_toggle'] && isset( $addons['psag_addons_woocommerce_toggle'] ) ) {
                        return true;
                    } else {
                        return false;
                    }
                    
                    break;
                case 'design':
                    
                    if ( 'on' === $addons['psag_addons_styles_toggle'] && isset( $addons['psag_addons_styles_toggle'] ) ) {
                        return true;
                    } else {
                        return false;
                    }
                    
                    break;
            }
        } else {
            update_option( 'psag_addons', array(
                'psag_addons_woocommerce_toggle' => 'off',
                'psag_addons_styles_toggle'      => 'off',
            ) );
        }
    
    }

}