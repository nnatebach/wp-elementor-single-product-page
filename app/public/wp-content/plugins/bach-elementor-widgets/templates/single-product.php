<?php
echo '<!-- single-product.php loaded -->';
?>

<?php
if (!defined('ABSPATH')) exit;

$product_id = get_query_var('mew_product_id');

// Load products from JSON
$json_file = plugin_dir_path(__DIR__) . 'data/products.json';
$products = json_decode(file_get_contents($json_file), true)['products'];

// Find current product
$current_product = null;
foreach ($products as $product) {
  if ($product['id'] == $product_id) {
    $current_product = $product;
    break;
  }
}

// Handle missing product
if (!$current_product) {
  echo "<h2>Product not found.</h2>";
  return;
}

// Find related products (same category)
$related = array_filter($products, function ($p) use ($current_product) {
  return $p['category'] === $current_product['category'] && $p['id'] !== $current_product['id'];
});
$related = array_slice($related, 0, 3); // limit to 3
?>

<div class="single-product">
  <div class="product-main">
    <!-- Left: Images -->
    <div class="product-images">
      <img src="<?php echo esc_url($current_product['images'][0]); ?>" 
           alt="<?php echo esc_attr($current_product['title']); ?>" 
           class="main-img" />
      <div class="thumbs">
        <?php foreach ($current_product['images'] as $img): ?>
          <img src="<?php echo esc_url($img); ?>" class="thumb" 
               onclick="document.querySelector('.main-img').src=this.src" />
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Right: Product Info -->
    <div class="product-info">
      <p class="category">Category: <?php echo esc_html($current_product['category']); ?></p>
      <h2><?php echo esc_html($current_product['title']); ?></h2>
      <p class="price">
        $<?php echo number_format($current_product['price'], 2); ?>
        <span class="discount"><?php echo $current_product['discountPercentage']; ?>% OFF</span>
      </p>
      <p class="description"><?php echo esc_html($current_product['description']); ?></p>
    </div>
  </div>

  <!-- Related Products -->
  <div class="related">
    <h3>Related Products</h3>
    <div class="related-grid">
      <?php foreach ($related as $r): ?>
        <div class="related-card">
          <img src="<?php echo esc_url($r['thumbnail']); ?>" alt="<?php echo esc_attr($r['title']); ?>" />
          <h4><?php echo esc_html($r['title']); ?></h4>
          <p class="price">
            $<?php echo number_format($r['price'], 2); ?>
            <span class="discount"><?php echo $r['discountPercentage']; ?>% OFF</span>
          </p>
          <a href="/product/<?php echo $r['id']; ?>" class="view-btn">View Product</a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
