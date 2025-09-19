<?php
if (! defined('ABSPATH')) exit;

class Product_Gallery_Widget extends \Elementor\Widget_Base
{
  public function get_name()
  {
    return 'product_gallery';
  }

  public function get_title()
  {
    return __('Product Gallery', 'mew');
  }

  public function get_icon()
  {
    return 'eicon-gallery-grid';
  }

  public function get_categories()
  {
    return ['general']; // ✅ ensures it shows under "General" in Elementor
  }

  protected function render()
  {
?>
    <div class="product-gallery-wrapper">
      <div class="sorting">
        <select id="sort-products">
          <option value="asc">Sort by Price: Low → High</option>
          <option value="desc">Sort by Price: High → Low</option>
        </select>
      </div>
      <div id="product-gallery" class="product-grid"></div>
      <div id="loader" class="loader">Loading...</div>
    </div>
<?php
  }
}
