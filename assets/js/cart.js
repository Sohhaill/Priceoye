
    jQuery(document).ready(function($) {
  $('.plus_icon, .minus_icon').on('click', function () {
      let $this = $(this);
      let cart_item_key = $this.data('cart-item-key');
      let $qtyDisplay = $this.siblings('.quantity_count');
      let currentQty = parseInt($qtyDisplay.text());

      let newQty = $this.hasClass('plus_icon') ? currentQty + 1 : currentQty - 1;
      if (newQty < 1) return;

      $.ajax({
          type: 'POST',
          url: cart_ajax_obj.ajaxurl,
          data: {
              action: 'update_cart_quantity',
              cart_item_key: cart_item_key,
              quantity: newQty
          },
          success: function(response) {
              location.reload(); 
          }
      });
  });
});

document.addEventListener('DOMContentLoaded', function () {
    let total = 0;

    document.querySelectorAll('[price-attribute]').forEach(item => {
        const price = parseFloat(item.getAttribute('price-attribute')) || 0;
        total += price;
    });

   
    document.getElementById('total_price').textContent = 'Rs ' + total.toLocaleString();
    document.getElementById('Postage_price').textContent = 'Rs ' + total.toLocaleString();
    document.getElementById('grandtotal_price').textContent = 'Rs ' + total.toLocaleString();
});







