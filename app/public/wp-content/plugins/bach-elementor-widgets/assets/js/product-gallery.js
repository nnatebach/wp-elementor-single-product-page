jQuery(document).ready(function ($) {
  function fetchProducts(sort = "asc") {
    $("#loader").show();
    $("#product-gallery").empty();

    $.ajax({
      url: mew_ajax_obj.ajax_url,
      type: "POST",
      data: {
        action: "mew_fetch_products",
        sort: sort,
      },
      success: function (response) {
        $("#loader").hide();
        if (response.success) {
          response.data.forEach((product) => {
            $("#product-gallery").append(`
              <div class="product-card">
                  <img src="${product.thumbnail}" alt="${product.title
}" />
                  <h3>${product.title}</h3>
                  <p>${product.description.substring(
                    0,
                    50
                  )}...</p>
                  <p class="price">$${
                    product.price
                  } <span class="discount">${
product.discountPercentage
}% OFF</span></p>
                  <button onclick="window.location.href='/product/${
                    product.id
                  }'">View Product</button>
              </div>
          `);
          });
        }
      },
    });
  }

  // Initial load
  fetchProducts();

  // Sorting
  $("#sort-products").on("change", function () {
    fetchProducts($(this).val());
  });
});
