<?php

/**
 * Plugin Name: Bach Elementor Widgets
 * Description: Custom Elementor Widgets including Product Gallery
 * Version: 1.0
 * Author: Bach
 */

if (! defined('ABSPATH')) exit;

// constants for easy paths/urls
if (! defined('MEW_PLUGIN_DIR')) {
  define('MEW_PLUGIN_DIR', plugin_dir_path(__FILE__));
}
if (! defined('MEW_PLUGIN_URL')) {
  define('MEW_PLUGIN_URL', plugin_dir_url(__FILE__));
}

/* ---------------------------
Register Elementor widget
--------------------------- */
function mew_register_widgets($widgets_manager)
{
  require_once(__DIR__ . '/includes/product-gallery-widget.php');

  // Register the widget class
  $widgets_manager->register(new \Product_Gallery_Widget());
}
add_action('elementor/widgets/register', 'mew_register_widgets');


/* ---------------------------
Register & enqueue assets
--------------------------- */
function mew_register_assets()
{
  // Register styles
  wp_register_style('product-gallery', MEW_PLUGIN_URL . 'assets/css/product-gallery.css', [], '1.0');
  // Register single-product.css but do not enqueue globally (we'll enqueue when template is used)
  wp_register_style('single-product', MEW_PLUGIN_URL . 'assets/css/single-product.css', [], '1.0');

  // Register scripts
  wp_register_script('product-gallery', MEW_PLUGIN_URL . 'assets/js/product-gallery.js', array('jquery'), '1.0', true);

  // Enqueue global widget assets (gallery script + gallery css)
  // If you prefer to load gallery assets only on pages containing the widget, add more checks here.
  wp_enqueue_style('product-gallery');
  wp_enqueue_script('product-gallery');

  // Localize AJAX URL for the gallery script
  wp_localize_script('product-gallery', 'mew_ajax_obj', array(
    'ajax_url' => admin_url('admin-ajax.php'),
  ));
}
add_action('wp_enqueue_scripts', 'mew_register_assets');


/* ---------------------------
AJAX Handler - read local JSON
--------------------------- */
function mew_fetch_products()
{
  $sort = isset($_POST['sort']) ? sanitize_text_field($_POST['sort']) : 'asc';

  $json_file = MEW_PLUGIN_DIR . 'data/products.json';
  if (! file_exists($json_file)) {
    wp_send_json_error('Products file not found.');
  }

  $json_data = file_get_contents($json_file);
  $data = json_decode($json_data);
  $products = $data->products ?? array();

  // Sort by price (numeric)
  usort($products, function ($a, $b) use ($sort) {
    $pa = floatval($a->price);
    $pb = floatval($b->price);
    if ($pa == $pb) {
      return 0;
    }
    return ($sort === 'asc') ? ($pa <=> $pb) : ($pb <=> $pa);
  });

  wp_send_json_success($products);
}
add_action('wp_ajax_mew_fetch_products', 'mew_fetch_products');
add_action('wp_ajax_nopriv_mew_fetch_products', 'mew_fetch_products');


/* ---------------------------
Rewrite & Query var for /product/{id}
--------------------------- */
function mew_add_rewrite_rules()
{
  add_rewrite_rule('^product/([0-9]+)/?$', 'index.php?detail_product_id=$matches[1]', 'top');
}
add_action('init', 'mew_add_rewrite_rules');

function mew_add_query_vars($vars)
{
  $vars[] = 'mew_product_id';
  return $vars;
}
add_filter('query_vars', 'mew_add_query_vars');


/* ---------------------------
Load single product template AND ensure CSS is enqueued
--------------------------- */
// Load single-product.css only on product detail pages
add_action('template_redirect', function () {
  if (get_query_var('mew_product_id')) {
    $css_file = MEW_PLUGIN_DIR . 'assets/css/single-product.css';
    $css_url  = MEW_PLUGIN_URL . 'assets/css/single-product.css';
    $version  = file_exists($css_file) ? filemtime($css_file) : '1.0';

    wp_enqueue_style(
      'bach-single-product',
      $css_url,
      [],
      $version
    );
  }
});

// Template loader (only returns the template now, no enqueueing here)
add_filter('template_include', function ($template) {
    if ( get_query_var('mew_product_id') ) {
        return MEW_PLUGIN_DIR . 'templates/single-product.php';
    }
    return $template;
});