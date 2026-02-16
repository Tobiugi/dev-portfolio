<?php
/**
 * Plugin Name: Night Discount
 * Description: Obniża ceny o 10% w godzinach nocnych (22:00 - 06:00).
 * Version: 1.0
 * Author: Jakub Babuśka
 */

// Zabezpieczenie przed bezpośrednim dostępem
if (!defined('ABSPATH')) exit;

add_filter('woocommerce_product_get_price', 'apply_night_discount', 10, 2);
add_action( 'woocommerce_product_options_general_product_data', 'add_night_discount_field' );

function add_night_discount_field() {
    woocommerce_wp_checkbox( array(
        'id'            => '_enable_night_discount',
        'label'         => 'Włącz zniżkę nocną dla tego produktu',
        'description'   => 'Zniżka 10% będzie naliczana tylko w nocy.',
        'desc_tip'      => true,
    ));
}
add_action( 'woocommerce_process_product_meta', 'save_night_discount_field' );

function save_night_discount_field( $post_id ) {
    $checkbox = isset( $_POST['_enable_night_discount'] ) ? 'yes' : 'no';
    update_post_meta( $post_id, '_enable_night_discount', $checkbox );
}

function apply_night_discount($price, $product) {
    $is_enabled = get_post_meta( $product->get_id(), '_enable_night_discount', true );
    
    if ( $is_enabled === 'yes' ) {
        $current_hour = (int) date('G');
        if ($current_hour >= 22 || $current_hour < 6) {
            $price = $price * 0.9;
        }
    }
    return $price;
}

