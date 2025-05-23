<?php
/*
Template Name: Shop Page
*/
get_header();
?>

<?php


$meta_query = [];


$meta_query = array('relation' => 'AND');


if (isset($_GET['price'])) {
    $price_ranges = $_GET['price'];

    $price_meta = array('relation' => 'OR');
    foreach ($price_ranges as $range) {
        switch ($range) {
            case 'below-15000':
                $price_meta[] = array(
                    'key' => '_price',
                    'value' => 15000,
                    'compare' => '<',
                    'type' => 'NUMERIC'
                );
                break;
            case '15000-25000':
                $price_meta[] = array(
                    'key' => '_price',
                    'value' => array(15000, 25000),
                    'compare' => 'BETWEEN',
                    'type' => 'NUMERIC'
                );
                break;
            case '25000-40000':
                $price_meta[] = array(
                    'key' => '_price',
                    'value' => array(25000, 40000),
                    'compare' => 'BETWEEN',
                    'type' => 'NUMERIC'
                );
                break;
                case '40000-60000':
                $price_meta[] = array(
                    'key' => '_price',
                    'value' => array(40000, 60000),
                    'compare' => 'BETWEEN',
                    'type' => 'NUMERIC'
                );
                break;
                case '60000-80000':
                $price_meta[] = array(
                    'key' => '_price',
                    'value' => array(60000, 80000),
                    'compare' => 'BETWEEN',
                    'type' => 'NUMERIC'
                );
                break;
                case '80000-100000':
                $price_meta[] = array(
                    'key' => '_price',
                    'value' => array(80000, 100000),
                    'compare' => 'BETWEEN',
                    'type' => 'NUMERIC'
                );
                break;
                case '100000-150000':
                $price_meta[] = array(
                    'key' => '_price',
                    'value' => array(100000, 150000),
                    'compare' => 'BETWEEN',
                    'type' => 'NUMERIC'
                );
                break;
                case 'above-150000':
                $price_meta[] = array(
                    'key' => '_price',
                    'value' => 150000,
                    'compare' => '>',
                    'type' => 'NUMERIC'
                );
                break;
        }
    }
    $meta_query[] = $price_meta;
}


if (isset($_GET['popular'])) {
    $meta_query[] = array(
        'key' => 'popularity', 
        'value' => '1',     
        'compare' => '='
    );
}


if (isset($_GET['lcd_size']) && is_array($_GET['lcd_size'])) {
    $lcd_size_values = $_GET['lcd_size'];
    $lcd_meta = array('relation' => 'OR');
    foreach ($lcd_size_values as $size) {
        $lcd_meta[] = array(
            'key' => 'screen_size_filter', 
            'value' => $size,
            'compare' => '='
        );
    }
    $meta_query[] = $lcd_meta;
}
if (isset($_GET['brand']) && is_array($_GET['brand'])) {
    $brand_value = $_GET['brand'];
    $brand_meta = array('relation' => 'OR');
    foreach ($brand_value as $brand) {
        $brand_meta[] = array(
            'key' => 'brand', 
            'value' => $brand,
            'compare' => '='
        );
    }
    $meta_query[] = $brand_meta;
}

$args = array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'meta_query' => $meta_query
);

if (!empty($_GET['category'])) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => $_GET['category'],
        ),
    );
}


$query = new WP_Query($args);








?>

      <?php 
$first_category_slug = '';


if (!empty($_GET['category']) && is_array($_GET['category'])): 
    $first_category_slug = sanitize_text_field($_GET['category'][0]);
        $term = get_term_by('slug', $first_category_slug, 'product_cat');
        $Cat_banner = get_field('Cat_banner', 'product_cat_' . $term->term_id);
        $brand_image = get_field('brand_images', 'product_cat_' . $term->term_id);
        $brands = $brand_image['images'];
       
?>
  <?php endif?>

<div class="bg-white">
<div class="container flex items-center justify-center branddiv">
<form method="GET" class="brand_filter flex  gap-4">
  <?php 
  $brand_images = get_field('brand_images', 'product_cat_' . $term->term_id);
  
  if (!empty($brand_images)) :
      foreach ($brand_images as $row): 
          $image = $row['images'];
          $name = $row['name']; 
          $is_active = (isset($_GET['brand[]']) && $_GET['brand[]'] === $name);
  ?>
    <button type="submit" name="brand[]" value="<?php echo esc_attr($name); ?>" 
      class="hoverbrand border p-2 rounded <?php echo $is_active ? 'border-black' : 'border-transparent'; ?>">
      <img src="<?php echo esc_url($image['url']); ?>" width="50" height="38" alt="<?php echo esc_attr($name); ?>" />
    </button>
  <?php 
      endforeach;
  endif;
  ?>
</form>

 </div>
</div>
  <?php if (!empty($Cat_banner)): ?>
<img class="w-full" src="<?php echo esc_url( $Cat_banner['url'] ) ?>" >
<?php endif?>
<div class="mobilefilter ml-[25px] mt-[25px] block md:hidden ">
  <div class="mobfilter bg-white px-[15px] py-[10px] w-fit cursor-pointer rounded-[4px] flex items-center gap-1" >
    <span class="text-[12px] text-[#202020] font-semibold" >Filter By</span>
    <img src="	https://static.priceoye.pk/images/b_filter_icon.svg" width="20" >
  </div>
</div>
  <div class="categoryname p-[20px] mt-[10px] mx-[25px] mb-[0px] bg-white ">
<?php if (!empty($_GET['category']) && is_array($_GET['category'])): ?>
  <h1 class="text-[16px] text-[black] font-semibold" ><span class="capitalize" ><?php echo $first_category_slug?></span> Price In Pakistan</h1>
<?php else:?>
 <h1 class="text-[16px] text-[black] font-semibold" >Shop All Products</h1>
 <?php endif?>
</div>
<div class="shopallmain p-[25px] flex gap-[18px] items-start">
  <div class="filters">
    <div class=" bg-white p-[30px] " >
    <form method="GET" class="filter_form">
      <div   class="filter_tag block md:hidden flex justify-between  cursor-pointer mb-[10px]">
          <h1 class="text-[18px] text-[#202020] font-semibold" >Filters</h1>
          <img class="closebtn" src="	https://static.priceoye.pk/images/not-available.svg" width="10">
        </div>
      <div class="filteroption">
        <div   class="filter_tag flex justify-between down_arrow cursor-pointer">
          <h1 class="text-[14px] text-[#404040] font-semibold uppercase" >Set Your Price Range</h1>
          <img class="shop_dropdown" src="https://static.priceoye.pk/images/caret.svg">
        </div>
        <div id="openfilter" class="filter_option hidden mt-3 pb-[2.5rem] border-b border-[#dbdbdb]    border-b border-[#dbdbdb] ">
          <div class="flex items-center gap-[5px]">
          <input type="checkbox" name="price[]" value="below-15000" id="check1" <?php if (isset($_GET['price']) && in_array('below-15000', $_GET['price'])) echo 'checked'; ?>>
          <label for="check1">Below Rs. 15,000</label><br>
             </div>
          <input type="checkbox" name="price[]" value="15000-25000" id="check2" <?php if (isset($_GET['price']) && in_array('15000-25000', $_GET['price'])) echo 'checked'; ?>>
          <label for="check2">Rs. 15,000 - Rs. 25,000</label><br>

          <input type="checkbox" name="price[]" value="25000-40000" id="check3" <?php if (isset($_GET['price']) && in_array('25000-40000', $_GET['price'])) echo 'checked'; ?>>
          <label for="check3">Rs. 25,000 - Rs. 40,000</label><br>
        </div>
      </div>
      <!-- POPULAR Filter -->
<div class="filteroption ">
  <div   class="filter_tag flex justify-between down_arrow cursor-pointer pt-[20px]">
          <h1 class="text-[14px] text-[#404040] font-semibold uppercase" >Popularity</h1>
          <img class="shop_dropdown" src="https://static.priceoye.pk/images/caret.svg">
        </div>
  <div class="filter_option mt-3 pb-[2.5rem] border-b border-[#dbdbdb]  hidden  border-b border-[#dbdbdb]  ">
  <input type="checkbox" name="popular" value="1" id="popular" <?php if (isset($_GET['popular'])) echo 'checked'; ?>>
  <label for="popular">Most Popular</label>
  </div>
</div>

<!-- LCD Size Filter -->
<div class="filteroption">
   <div   class="filter_tag flex justify-between down_arrow cursor-pointer pt-[20px]">
          <h1 class="text-[14px] text-[#404040] font-semibold uppercase" >LCD Size</h1>
          <img class="shop_dropdown" src="https://static.priceoye.pk/images/caret.svg">
        </div>
    <div class="filter_option mt-3 pb-[2.5rem] border-b border-[#dbdbdb]  hidden">
  <input type="checkbox" name="lcd_size[]" value="5_inches" id="lcd1" <?php if (isset($_GET['lcd_size']) && in_array('5_inches', $_GET['lcd_size'])) echo 'checked'; ?>>
  <label for="lcd1">5 inch</label><br>

  <input type="checkbox" name="lcd_size[]" value="6_inches" id="lcd2" <?php if (isset($_GET['lcd_size']) && in_array('6_inches', $_GET['lcd_size'])) echo 'checked'; ?>>
  <label for="lcd2">6 inch</label><br>
  </div>
</div>

<!-- Brand filter -->
<div class="filteroption">
   <div   class="filter_tag flex justify-between down_arrow cursor-pointer pt-[20px]">
          <h1 class="text-[14px] text-[#404040] font-semibold uppercase" >Brand</h1>
          <img class="shop_dropdown" src="https://static.priceoye.pk/images/caret.svg">
        </div>
    <div class="filter_option mt-3 pb-[2.5rem] border-b border-[#dbdbdb] hidden ">
  <input type="checkbox" name="brand[]" value="Samsung" id="brand1" <?php if (isset($_GET['brand']) && in_array('Samsung', $_GET['brand'])) echo 'checked'; ?>>
  <label for="brand1">Samsung</label><br>
<input type="checkbox" name="brand[]" value="Iphone" id="brand2" <?php if (isset($_GET['brand']) && in_array('Iphone', $_GET['brand'])) echo 'checked'; ?>>
  <label for="brand2">Iphone</label><br>
  <input type="checkbox" name="brand[]" value="Lenovo" id="brand3" <?php if (isset($_GET['brand']) && in_array('Lenovo', $_GET['brand'])) echo 'checked'; ?>>
  <label for="brand3">Lenovo</label><br>
   <input type="checkbox" name="brand[]" value="Redmi" id="brand4" <?php if (isset($_GET['brand']) && in_array('Redmi', $_GET['brand'])) echo 'checked'; ?>>
  <label for="brand4">Redmi</label><br>
   <input type="checkbox" name="brand[]" value="Xiaomi" id="brand5" <?php if (isset($_GET['brand']) && in_array('Xiaomi', $_GET['brand'])) echo 'checked'; ?>>
  <label for="brand5">Xiaomi</label><br>
   <input type="checkbox" name="brand[]" value="Dell" id="brand6" <?php if (isset($_GET['brand']) && in_array('Dell', $_GET['brand'])) echo 'checked'; ?>>
  <label for="brand6">Dell</label><br>
    <input type="checkbox" name="brand[]" value="Joyroom" id="brand7" <?php if (isset($_GET['brand']) && in_array('Joyroom', $_GET['brand'])) echo 'checked'; ?>>
  <label for="brand7">Joyroom</label><br>
    <input type="checkbox" name="brand[]" value="Faster" id="brand8" <?php if (isset($_GET['brand']) && in_array('Faster', $_GET['brand'])) echo 'checked'; ?>>
  <label for="brand8">Faster</label><br>
    <input type="checkbox" name="brand[]" value="Baseus" id="brand9" <?php if (isset($_GET['brand']) && in_array('Baseus', $_GET['brand'])) echo 'checked'; ?>>
  <label for="brand9">Baseus</label><br>
    <input type="checkbox" name="brand[]" value="Sveston" id="Sveston" <?php if (isset($_GET['brand']) && in_array('Sveston', $_GET['brand'])) echo 'checked'; ?>>
  <label for="Sveston">Sveston</label><br>
    <input type="checkbox" name="brand[]" value="Zero" id="Zero" <?php if (isset($_GET['brand']) && in_array('Zero', $_GET['brand'])) echo 'checked'; ?>>
  <label for="Zero">Zero</label><br>
    <input type="checkbox" name="brand[]" value="Ssorted" id="Ssorted" <?php if (isset($_GET['brand']) && in_array('Ssorted', $_GET['brand'])) echo 'checked'; ?>>
  <label for="Ssorted">Ssorted</label><br>
    <input type="checkbox" name="brand[]" value="Dany" id="Dany" <?php if (isset($_GET['brand']) && in_array('Dany', $_GET['brand'])) echo 'checked'; ?>>
  <label for="Dany">Dany</label><br>
  </div>
</div>

<!-- category -->
<div class="filteroption">
   <div   class="filter_tag flex justify-between down_arrow cursor-pointer pt-[20px]">
          <h1 class="text-[14px] text-[#404040] font-semibold uppercase" >Category</h1>
          <img class="shop_dropdown" src="https://static.priceoye.pk/images/caret.svg">
        </div>
    <div class="filter_option mt-3 pb-[2.5rem] hidden">
  <input type="checkbox" name="category[]" value="mobiles" id="category1" <?php if (isset($_GET['category']) && in_array('mobiles', $_GET['category'])) echo 'checked'; ?>>
  <label for="category1">Mobile</label><br>
  <input type="checkbox" name="category[]" value="tablets" id="category2" <?php if (isset($_GET['category']) && in_array('tablets', $_GET['category'])) echo 'checked'; ?>>
  <label for="category2">Tablet</label><br>
  <input type="checkbox" name="category[]" value="laptops" id="category3" <?php if (isset($_GET['category']) && in_array('laptops', $_GET['category'])) echo 'checked'; ?>>
  <label for="category3">Laptop</label><br>
  <input type="checkbox" name="category[]" value="wireless-airbuds" id="category4" <?php if (isset($_GET['category']) && in_array('wireless-airbuds', $_GET['category'])) echo 'checked'; ?>>
  <label for="category4">AirBuds</label><br>
  <input type="checkbox" name="category[]" value="smart-watches" id="category5" <?php if (isset($_GET['category']) && in_array('smart-watches', $_GET['category'])) echo 'checked'; ?>>
  <label for="category5">Watches</label><br>
  <input type="checkbox" name="category[]" value="bluetooth-speaker" id="category6" <?php if (isset($_GET['category']) && in_array('bluetooth-speaker', $_GET['category'])) echo 'checked'; ?>>
  <label for="category6">Speaker</label><br>
    <input type="checkbox" name="category[]" value="power-banks" id="category7" <?php if (isset($_GET['category']) && in_array('power-banks', $_GET['category'])) echo 'checked'; ?>>
  <label for="category7">Power Banks</label><br>
  </div>
</div>
    </form>
</div>

  </div>
 <?php  if(($query->have_posts())): ?>
  <div class="grid grid-cols-2 md:grid-cols-4 gap-[9px] w-full">
    <?php while ($query->have_posts()) : $query->the_post(); global $product; ?>
      <?php $image_url = wp_get_attachment_image_url($product->get_image_id(), 'full'); ?>
      <div class="p-4 rounded-[4px]  bg-white shopproducts relative">
        <a class="flex flex-col items-center gap-[7px]" href="<?php the_permalink(); ?>">
          <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>" class="w-[120px] h-[120px] object-cover" />
          <h3 class="text-[13px] font-semibold mr-auto mt-[15px] mb-[10px] h-[32px]"><?php the_title(); ?></h3>
               <div class="user-rating-content"> 
                <img src="https://static.priceoye.pk/images/stars.svg" alt="Rating Star" width="10" height="10">  
                <span class="h6 bold font-bold text-[13px] text-black">
                     <?php  echo esc_html( $product->get_average_rating() )?>
                </span> 
                <span class="rating-h7 font-semibold text-[11px] text-black">
                <?php   echo esc_html( $product->get_review_count() ) ?>
                </span> 
                <span class="rating-h7 font-semibold text-[11px] text-black">Reviews</span>  
            </div>
          <p class="flex flex-col mr-auto"><?php echo $product->get_price_html(); ?></p>
           <div class="regularprice self-end flex justify-end w-full">
          
          <?php 
          if ( $product->is_type('variable') ) {
    $variations = $product->get_available_variations();
    $variation_id = $variations[0]['variation_id'];
    $variation = new WC_Product_Variation($variation_id);
    $regular_price = (float) $variation->get_regular_price();
    $sale_price = (float) $variation->get_sale_price();
}

          
if ( $regular_price > 0 && $sale_price > 0 && $sale_price < $regular_price ) {
    $percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
}
          ?>
              <?php if ($percentage > 0): ?>
    <p class="text-[#0bb07e] bg-[#f0faf7] rounded-[8px] p-[5px] font-[600] text-[10px]">
        <?php echo esc_html($percentage); ?>% OFF
    </p>
<?php endif; ?>
           
        </div>
        </a>
      </div>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>
   <?php else : ?>
  <div class="container"> <h1 class="text-[32px] mt-[50px] text-center" >No products available</h1></div>
 <?php endif?>
  </div>




<script>
  
  document.querySelectorAll('.down_arrow').forEach(arrow => {
    arrow.addEventListener('click', () => {
      const filteroption = arrow.closest('.filteroption').querySelector('.filter_option');
      filteroption.classList.toggle('hidden');
      arrow.classList.toggle('downoption');
    });
  });

 
  document.querySelectorAll('.filter_form input[type=checkbox]').forEach(cb => {
    cb.addEventListener('change', () => {
      cb.closest('form')?.submit();
    });
  });

 
  function showVisibleFilterOptions() {
    document.querySelectorAll('.filteroption').forEach(filter => {
      const checkboxes = filter.querySelectorAll('input[type=checkbox]');
      const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
      if (anyChecked) {
        filter.querySelector('.filter_option')?.classList.remove('hidden');
      }
    });
  }


  showVisibleFilterOptions();
  var mobilefilter = document.querySelector('.mobilefilter');
  var filters = document.querySelector('.filters');
  var closebtnfilter = document.querySelector('.closebtn');
  var filtersinner = document.querySelector('.filters .bg-white');
  var body = document.querySelector('body');
mobilefilter.addEventListener('click', () => {

    var filtersinner = document.querySelector('.filters .bg-white');
filters.style.visibility = "visible";

  filtersinner.style.transform = 'translateX(0px)';


setTimeout(() => {

  body.style.overflow = 'hidden';
}, 1000);

});


closebtnfilter.addEventListener('click', () => {
 
filters.style.visibility = "hidden";
  body.style.overflow = 'scroll';
  filtersinner.style.transform = 'translateX(303px)';
});


</script>


<?php get_footer(); ?>
