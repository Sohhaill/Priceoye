<?php
get_header();

$product_id = get_the_ID();
$product = wc_get_product( $product_id );
?>

<div class="product bg-white py-[10px]">
    <div class="container  flex justify-between items-center " >
    <div>
        <?php woocommerce_breadcrumb(); ?>
        <span class="text-[#202020] text-[13px] font-[600]">Buy</span>
        <?php the_title('<h1 class="product_title entry-title inline text-[#202020] text-[13px] font-[600]">', '</h1>'); ?>
        <span class="text-[#202020] text-[13px] font-[600]"> Price in Pakistan</span>
    
    </div>

</div>
   
</div>

<div class="singleproductmain bg-white">
    <div class="container !py-[30px] !my-[15px] relative">
        <div class="singleproductinner flex gap-[40px]">
 

            <div class="product_gallery w-[40%]">
        <div class="swiper product_galleryslider">
            <div class="swiper-wrapper">
            <?php 
                $galleryimages = $product->get_gallery_image_ids();
                $featured_image = $product->get_image_id();
                
                if (!in_array($featured_image, $galleryimages)) {
                    array_unshift($galleryimages, $featured_image);
                }
                
                $featured_imageurl = wp_get_attachment_image_url( $featured_image , 'full');
              
     foreach($galleryimages as $galleryimage):

$galleryimageurl = wp_get_attachment_image_url($galleryimage , 'full');
              ?>

                <div class="swiper-slide p-[15px] border border-[2.29px] border-[#d7d9db] rounded-[18px] relative">
                <img class="object-cover product_images" src="<?php echo esc_url( $galleryimageurl ); ?>" alt="" width="500" height="500" >
                <div class="po-badge brand-badge-container absolute top-[1px] left-[10px] p-[5px] mt-[9px]"><img class="brand-badge" src="https://static.priceoye.pk/images/product-detail/retailer-po-badge.svg" alt="samsung-badge"></div>

                </div>
                
<?php endforeach?>
            </div>
          <div class="swiper-pagination gallerypagination"></div>
        </div>
        <div class="crousalpereview flex justify-center items-center mt-[10px]">
        <?php foreach($galleryimages as $view) :
    $viewall = wp_get_attachment_image_url($view , 'full');
    ?>
    <div class="crousal mr-[10px] border border-[#dbdbdb] rounded-[3px] p-[5px]">
    <img class="object-cover" src="<?php echo esc_url( $viewall ); ?>" alt="" width="54" height="54">
   </div>
    <?php endforeach?>

        </div>
            </div>

            <div class="productright">
                <div class="flex items-center justify-between" >
                <h1 class="text-[20px] text-black font-[600]"><?php echo get_the_title(); ?></h1>
                <img src="https://static.priceoye.pk/images/product-detail/po-retailer-label.svg" alt="samsung-label" class="brand-label ml-auto">
                </div>
                <div class="product-price mt-[15px]">
                   
                    <div class="availanility flex justify-between w-[456px]">
                    <p class="text-[#909090] text-[14px]">Priceoye Price</p>
                        <div class="flex flex-col" >
                    <span class="summary-price-label text-[14px] text-[#909090]"> Availability </span>
                    <span class="summary-price text-[20px] font-semibold text-black bold" id="stock-status" ></span>
                    </div>
                    </div>
                    <?php 
                 
                if ( $product->is_type( 'variable' ) ) :
    $variations = $product->get_available_variations();
    
    
    $grouped_variations = [];
    foreach ( $variations as $variant ) {
        $color = $variant['attributes']['attribute_color'];
        
        $storage = $variant['attributes']['attribute_storage'] ?? null;

        
       
        $color_image = $variant['image']['url'];

       
        $grouped_variations[$color]['image'] = $color_image; 
        $grouped_variations[$color]['storage'][$storage] = $variant; 
       
    }

?> 

<?php endif; ?>



<?php if (empty($storage)) : ?>
    <div class="vareintprices flex flex-col">
                        
                        <div class="flex items-start" >
                  <span class="text-[22px] text-[#404040] font-semibold mr-[5px]" >Rs</span> <span class="text-[30px]  text-[#404040] font-semibold" id="singleselectedsaleprice" ></span>
                  </div>
            
                  <div class="flex items-start" >
                  <span class="text-[12px] text-[#07121b66] line-through  mr-[5px]" >Rs</span> <span class="text-[23px] line-through  text-[#07121b66] font-regular " id="singleselectedregularprice" ></span>
                    
                    </div>
                    </div>
    <h1 class="mt-[15px] text-[14px] font-semibold" >Colors</h1>
    <div class="flex gap-[10px] items-start" >

<?php
foreach($variations as $single):

    $singlevareinttitle = $single['attributes']['attribute_color'];
    $singlevareintimage = $single['image']['url'];
    $singlevareintsale = $single['display_price'];
    $singlevareintregular = $single['display_regular_price'];
    $singlevariationid= $single['variation_id'];
    $stockstatus= $single['availability_html'];
   
   
    ?>

<div class="singlevariant_color flex justify-center items-center flex-col border !border-[2px] border-[#d9d9d9] rounded-[8px] p-[5px] w-[80px] h-[93px] cursor-pointer select-color" 
                 
                        single-sale_price="<?php echo  $singlevareintsale ?>"
                        single-regular_price="<?php echo $singlevareintregular ?>"
                         single-varientid="<?php echo $singlevariationid ?>"
                         stock-status="<?php echo esc_attr($stockstatus); ?>"
                         data-image="<?php echo  $singlevareintimage ?>" 


>
                <img src="<?php echo $singlevareintimage ?>" width="45"> 
                <h1  class=" textcolorchange !text-[12px] leading-[13px] !text-[#07121b66] !text-center !font-semibold mt-[5px]"><?php echo $singlevareinttitle ?></h1>
            </div>
          
<?php endforeach ?>
</div>
<form method="post" action="<?php echo esc_url( add_query_arg( 'add-to-cart', $product->get_id(), wc_get_cart_url() ) ); ?>" id="single-add-to-cart-form" class="mt-[15px]">
    <input type="hidden" name="variation_id" id="selected-variation-id" value="">
    <input type="hidden" name="product_id" value="<?php echo esc_attr( $product->get_id() ); ?>">
    <div id="attributes-container"></div>

    <button type="button" class="bg-[#f88b2a] w-[195px] text-white text-[12px] cursor-pointer px-[20px] py-[10px] rounded hidden" id="add-to-cart-button">Add to Cart</button>
</form>

<div id="cart_messagewrap" class="opacity-0 transition-opacity duration-500 flex w-fit px-[20px] py-[10px] gap-[20px] border border-[#0000002b] rounded items-center mt-[15px]">
<h1 id="cart-message" class="opacity-0 transition-opacity duration-500 text-green-600 text-lg font-semibold">
    Item added to cart Successfully!
</h1>
<a id="viewcartajax"  class="opacity-0 transition-opacity duration-500 underline" href="/cart" >View Cart</a>
</div>
<script>
    function numberWithCommas(x) {
    x = x.toString();
    var pattern = /(-?\d+)(\d{3})/;
    while (pattern.test(x))
        x = x.replace(pattern, "$1,$2");
    return x;
}






    window.addEventListener('DOMContentLoaded', function() {
    var firstColorElement = document.querySelector('.select-color');
    if (firstColorElement) {
        firstColorElement.click();
    }
});

    document.querySelectorAll('.singlevariant_color').forEach(function(element) {
    element.addEventListener('click', function() {
        var variantId = this.getAttribute('single-varientid');
        // var storage = this.getAttribute('data-storage');
        var salePrice = this.getAttribute('single-sale_price');
        var regularPrice = this.getAttribute('single-regular_price');
        var getstockstatus = this.getAttribute('stock-status');
        var stock_status= document.getElementById('stock-status');
        document.getElementById('selected-variation-id').value = variantId;
        
        if (getstockstatus && getstockstatus.trim() !== "") {
    stock_status.innerText = 'Out of stock'; 
    stock_status.style.color = 'red'; 
} else {
    stock_status.innerText = 'In stock'; 
    stock_status.style.color = 'green';
}

        document.getElementById('singleselectedsaleprice').innerHTML = (numberWithCommas(salePrice));
        document.getElementById('singleselectedregularprice').innerHTML = (numberWithCommas(regularPrice));
        var attrContainer = document.getElementById('attributes-container');
        attrContainer.innerHTML = '';

      

        document.getElementById('add-to-cart-button').classList.remove('hidden');

        document.querySelectorAll('.singlevariant_color').forEach(function(el) {
            el.classList.remove('!border-[#48afff]', 'border-[2px]');
            el.classList.add('border-[#d9d9d9]');
        });
        this.classList.add('!border-[#48afff]', 'border-[2px]');
       

    });
    window.addEventListener('DOMContentLoaded', function() {
    var firstColorElements = document.querySelector('.singlevariant_color');
    if (firstColorElements) {
        firstColorElements.click();
    }
});
});
document.getElementById('add-to-cart-button').addEventListener('click', function() {
    var productId = document.querySelector('input[name="product_id"]').value;
    var variationId = document.getElementById('selected-variation-id').value;
    var quantity = 1;

    var formData = new FormData();
    formData.append('action', 'woocommerce_ajax_add_to_cart');
    formData.append('product_id', productId);
    formData.append('variation_id', variationId);
    formData.append('quantity', quantity);

    fetch(wc_add_to_cart_params.ajax_url, {
        method: 'POST',
        credentials: 'same-origin',
        body: formData
    })
    .then(response => response.json())
    .then(response => {
        if (response && response.error) {
            alert(response.error || 'Something went wrong!');
        } else {
            document.dispatchEvent(new CustomEvent('added_to_cart', { detail: response }));
            alert('Item added to cart!');
        }
    })
    .catch(error => {
        console.error('Add to Cart Error:', error);
        alert('Error adding item to cart.');
    });
});
</script>
    <?php endif; ?>



 <?php if (!empty($storage)) : ?>
  <div class="vareintprices flex flex-col">
                        
                        <div class="flex items-start" >
                  <span class="text-[22px] text-[#404040] font-semibold mr-[5px]" >Rs</span> <span class="text-[30px]  text-[#404040] font-semibold" id="selectedsaleprice" ></span>
                  </div>
            
                  <div class="flex items-start" >
                  <span class="text-[12px] text-[#07121b66] line-through  mr-[5px]" >Rs</span> <span class="text-[16px] line-through  text-[#07121b66] font-regular " id="selectedregularprice" ></span>
                 
                   
                    </div>
                    </div>
 
<div class="variant_main flex flex-col items-start gap-[8px] mt-[15px]">
   
    <h1 class="mt-[15px] text-[14px] font-semibold" >Colors</h1>
    <div class="color_main flex gap-[5px]">
    <?php foreach ( $grouped_variations as $color => $data ) : ?>
        <div class="color_container">
            <div class="variant_color flex justify-center items-center flex-col border !border-[2px] border-[#d9d9d9] rounded-[8px] p-[5px] w-[80px] h-[103px] cursor-pointer select-color" 
                 data-color="<?php echo esc_attr( $color ); ?>"
                 data-image="<?php echo esc_url( $data['image'] ); ?>"> 
                <img src="<?php echo esc_url( $data['image'] ); ?>" width="45" alt="<?php echo esc_attr( $color ); ?>"> 
                <h1  class=" textcolorchange !text-[12px] leading-[13px] !text-[#07121b66] !text-center !font-semibold mt-[5px]"><?php echo esc_html( $color ); ?></h1>
            </div>
            </div>
            <?php endforeach; ?>
            </div>
         
            <h1 class="mt-[15px] text-[14px] font-semibold hidden hiddenstorage" >Storage</h1>
            <div class="varient_main">
            <?php foreach ( $grouped_variations as $color => $data ) : ?>
            <div class="storage_options hidden   flex gap-[12px]" data-color="<?php echo esc_attr( $color ); ?>">
                <?php foreach ( $data['storage'] as $storage => $variant ) : 
       
                    $variant_title = $storage;
                    $variant_image = $variant['image']['url'];
                    $variant_id = $variant['variation_id'];
                    $product_id = $product->get_id();                
                 $productstock = wc_get_product($variant_id); 
                 $selectsaleprice = $variant['display_price'];
                 $stockstatus= $single['availability_html'];
                 $selectregularprice = $variant['display_regular_price'];


                ?>
                    <div class="storage_variant flex justify-center items-center flex-col border border-[2px] border-[#d9d9d9] rounded-[8px] p-[8px]   cursor-pointer select-storage" 
                         data-variant_id="<?php echo esc_attr( $variant_id ); ?>" 
                         data-product_id="<?php echo esc_attr( $product_id ); ?>"
                         data-storage="<?php echo esc_attr( $storage ); ?>"
                         check-stock = "<?php echo esc_attr( $stockcheck ); ?>"
                         data-sale_price="<?php echo esc_attr( $selectsaleprice ); ?>"
                        data-regular_price="<?php echo esc_attr( $selectregularprice ); ?>"
                        stock-status="<?php echo esc_attr($stockstatus); ?>"
                         data-attributes='<?php echo json_encode( $variant['attributes'] ); ?>'>
                        <h1 class="text-[12px] text-[#07121b66] text-center font-semibold"><?php echo esc_html( $variant_title ); ?></h1>
                    </div>
                <?php endforeach; 
                ?>

            </div>
            <?php endforeach; ?>
            </div>
          
</div>

<form method="post" action="<?php echo esc_url( add_query_arg( 'add-to-cart', $product->get_id(), wc_get_cart_url() ) ); ?>" id="single-add-to-cart-form" class="mt-[15px]">
    <input type="hidden" name="variation_id" id="selected-variation-id" value="">
    <input type="hidden" name="product_id" value="<?php echo esc_attr( $product->get_id() ); ?>">
    <div id="attributes-container"></div>

    <button type="button" class="bg-[#f88b2a] w-[195px] text-white text-[12px] px-[20px] py-[10px] cursor-pointer rounded hidden" id="add-to-cart-button">Add to Cart</button>
</form>

<div id="cart_messagewrap" class="opacity-0 transition-opacity duration-500 flex w-fit px-[20px] py-[10px] gap-[20px] border border-[#0000002b] rounded items-center mt-[15px]">
<h1 id="cart-message" class="opacity-0 transition-opacity duration-500 text-green-600 text-lg font-semibold">
    Item added to cart Successfully!
</h1>
<a id="viewcartajax"  class="opacity-0 transition-opacity duration-500 underline" href="/cart" >View Cart</a>
</div>

   

<?php endif; ?>
                         
                </div>






            
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
