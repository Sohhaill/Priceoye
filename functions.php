<?php

//get stylesheet and javascript files

function wotheme()
{
    wp_enqueue_style(
        'style',
        get_template_directory_uri() . '/assets/css/style.css',
        array(),
        filemtime(get_template_directory() . '/assets/css/style.css')
    );
    wp_enqueue_style('themestyle', get_template_directory_uri() . '/assets/css/theme.css',
    array(),
    filemtime(get_template_directory() . '/assets/css/theme.css')
);
    wp_enqueue_style('Responsive', get_template_directory_uri() . '/assets/css/responsive.css'
    ,
    array(),
    filemtime(get_template_directory() . '/assets/css/responsive.css')
);
    wp_enqueue_style('ThemeCss', get_stylesheet_uri());
    wp_enqueue_style('swipercss', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');

    wp_enqueue_script('tailwind_cdn', 'https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4');
    wp_enqueue_script('swipperjs', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');
    wp_enqueue_script('Sitejs', get_template_directory_uri() . '/assets/js/site.js', array(), time(), true);


}
add_action('wp_enqueue_scripts', 'wotheme');


// register menus

function register_menus()
{
    register_nav_menus(array(

        'header-menu' => __('Header Menu'),
        'footer-menu1' => __('Footer Menu1'),
        'footer-menu2' => __('Footer Menu2')

    ));
}
add_action('init', 'register_menus');

add_action('after_setup_theme', 'woocomerce_support');

function woocomerce_support()
{
    add_theme_support('woocommerce');
}




add_filter('show_admin_bar', '__return_false');

function mytheme_enqueue_woocommerce_scripts()
{
    if (is_product()) {
        wp_enqueue_script('wc-add-to-cart-variation');
    }
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_woocommerce_scripts');

add_filter('woocommerce_add_to_cart_redirect', function () {
    return wc_get_cart_url();
});

add_action('after_setup_theme', 'yourtheme_add_woocommerce_support');
function yourtheme_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart_handler');
add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart_handler');

function woocommerce_ajax_add_to_cart_handler()
{
    ob_start();

    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $variations = array(); // optional if you have variation attributes

    $added = WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variations);

    if ($added) {
        wc_setcookie('woocommerce_items_in_cart', '1');
        wc_setcookie('woocommerce_cart_hash', WC()->cart->get_cart_hash());

        do_action('woocommerce_ajax_added_to_cart', $product_id);

        WC_AJAX::get_refreshed_fragments();
    } else {
        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
        );
        echo wp_send_json($data);
    }

    wp_die();
}
add_action('wp_enqueue_scripts', 'enqueue_custom_woocommerce_scripts');
function enqueue_custom_woocommerce_scripts()
{

    if (function_exists('is_woocommerce')) {
        wp_enqueue_script('wc-add-to-cart');
        wp_enqueue_script('wc-cart-fragments');


    }
}



function custom_enqueue_cart_scripts() {
    if (is_cart()) {
        wp_enqueue_script('custom-cart-js', get_template_directory_uri() . '/assets/js/cart.js', array('jquery'), null, true);
        wp_localize_script('custom-cart-js', 'cart_ajax_obj', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'custom_enqueue_cart_scripts');



add_action('wp_ajax_update_cart_quantity', 'update_cart_quantity');
add_action('wp_ajax_nopriv_update_cart_quantity', 'update_cart_quantity');

function update_cart_quantity() {
    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    $quantity = intval($_POST['quantity']);

    if (isset(WC()->cart->get_cart()[$cart_item_key])) {
        WC()->cart->set_quantity($cart_item_key, $quantity, true);
        WC()->cart->calculate_totals();
    }

    wp_send_json_success();
}












// theme supports
add_theme_support('custom-logo');
?>