<?php get_header()?>
<div class="cart_main bg-white">
<div class="container">
    <h1 class="text-center uppercase font-bold text-[27px] md:text-[40px] mt-[20px] mb-[30px]" >Shopping Cart </h1>
    <div class="cartall flex flex-col lg:flex-row items-start justify-between ">
    <!-- -<span id="all_classes" ></span> -->
    <div class="cartproducts_main">
<?php  
$totalshipping = WC()->cart-> get_shipping_total();

?>

<?php
foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
    $product = $cart_item['data'];
    $product_id = $cart_item['product_id'];
    $thumbnail = $product->get_image(); 
    $variation_id = $cart_item['variation_id'];
    $product_quantity =$cart_item['quantity'];
    $varient_price = $cart_item['line_subtotal'];
   $imageid= $product->get_image_id();
   $imageurl = wp_get_attachment_url( $imageid );

    ?>    

<div class="cartproduct flex flex-col md:flex-row gap-[10px] md:gap-[100px] w-fit p[20px]  border-t-[2px] border-black p-[20px]" price-attribute="<?php echo $varient_price?>" >
<a href="<?php echo esc_url( wc_get_cart_remove_url( $cart_item_key ) ); ?>" 
   class="remove_cart_item  text-black font-bold mt-[10px] inline-block  bg-[#48AFFF] w-fit h-fit rounded-[20px] px-[10px] py-[1px]"
   onclick="return confirm('Are you sure you want to remove this item?')">
   Remove
</a>
    <div class="cartright flex flex-col">
    <h1 class=" w-[unset] lg:w-[335px] text-[17px] font-bold" > <?php echo $product->get_name();?> </h1>
    <p class="mt-[8px] mb-[15px]" > <sup>Rs</sup> <?php echo number_format($varient_price) ?></p>
  
<?php 


if ( !empty( $cart_item['variation'] ) ) {
    foreach ( $cart_item['variation'] as $attribute => $value ) {
        $attr_name = wc_attribute_label( str_replace( 'attribute_', '', $attribute ) );

        echo '<div class="mb-[5px]" >';
        echo '<span class="uppercase font-bold text-[12px] " >' . esc_html( $attr_name) . '</span>' ;
        echo '<span>' . '|' . '</span>' ;
        echo '<span class="uppercase text-[12px]">' . esc_html( $value ) . '</span>' ;
        echo '</div>';
    }
}

?>
  <div class="quantitymain flex gap-[10px] items-center mt-auto mb-[10px] w-fit px-[16px] py-[3px] border border-black rounded-[29px] ">
  <span class="minus_icon cursor-pointer" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="10" height="10" viewBox="0 0 256 256" xml:space="preserve">
<g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
	<path d="M 86.5 48.5 h -83 C 1.567 48.5 0 46.933 0 45 s 1.567 -3.5 3.5 -3.5 h 83 c 1.933 0 3.5 1.567 3.5 3.5 S 88.433 48.5 86.5 48.5 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(29,29,27); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
	<path d="M 86.5 48.5 h -83 C 1.567 48.5 0 46.933 0 45 s 1.567 -3.5 3.5 -3.5 h 83 c 1.933 0 3.5 1.567 3.5 3.5 S 88.433 48.5 86.5 48.5 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(29,29,27); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
</g>
</svg>
</span>
<span class="font-bold quantity_count"><?php echo $product_quantity ?></span>
<span class="plus_icon cursor-pointer" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
    <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 width="10px" height="10px" viewBox="0 0 45.402 45.402"
	 xml:space="preserve">
<g>
	<path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141
		c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27
		c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435
		c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"/>
</g>
</svg>
</span>
  </div>

    </div>
    <img  src="<?php echo esc_url($imageurl); ?>" width="200" height="200" >
   
</div>


<?php endforeach ?>
</div>

<div class="order_summery border border-black pt-[10px] w-[290px]">
<h1 class="text-center pb-[10px] uppercase text-[24px] font-bold border-b border-black" >Order Summery</h1>
<div class="summery border-b border-black px-[10px]">
    <div class="flex justify-between items-center" >
    <h1 class="mt-[5px] mb-[15px] uppercase font-bold" >Subtotal</h1>
    <p id="total_price" >Rs ...</p>
    </div>
    <div class="flex justify-between items-center" >
    <h1 class="mb-[15px] uppercase font-bold" >Shipping</h1>
    <p><?php echo number_format($totalshipping) ?></p>
    </div>
    <div class="flex justify-between items-center" >
    <h1 class="mb-[15px] uppercase font-bold" >Postage</h1>
    <p id="Postage_price" >Rs ...</p>
    </div>
</div>
<div class="total border-b border-black px-[10px]">
<div class="flex justify-between items-center" >
    <h1 class="mt-[15px] mb-[15px] uppercase font-bold" >Total</h1>
    <p id="grandtotal_price" >Rs ...</p>
    </div>
</div>

<a class="pt-[15px] pb-[15px] text-center  btn-checkout block" href="<?php echo wc_get_checkout_url(); ?>" >Checkout</a>
</div>
</div>
</div>
</div>


<script>




document.addEventListener('DOMContentLoaded', function () {
    
let elments = document.querySelectorAll('.cartproduct ').length;

let totalclasses = document.getElementById('all_classes');

totalclasses.innerText= elments;

    let total = 0;

    document.querySelectorAll('[price-attribute]').forEach(item => {
        const price = parseFloat(item.getAttribute('price-attribute')) || 0;
        total += price;
    });

   
    document.getElementById('total_price').textContent = 'Rs ' + total.toLocaleString();
    document.getElementById('Postage_price').textContent = 'Rs ' + total.toLocaleString();
    document.getElementById('grandtotal_price').textContent = 'Rs ' + total.toLocaleString();
});
</script>
<?php get_footer()?>
