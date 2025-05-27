<?php
/*
Template Name: Shop Page
*/
get_header();
?>

<?php

$meta_query = array('relation' => 'AND');
$tax_query  = array('relation' => 'AND');

// Price filter
if (isset($_GET['price'])) {
    $price_ranges = $_GET['price'];
    $price_meta = ['relation' => 'OR'];

    foreach ($price_ranges as $range) {
        if (preg_match('/^below-(\d+)$/', $range, $match)) {
            $price_meta[] = [
                'key' => '_price',
                'value' => (int)$match[1],
                'compare' => '<',
                'type' => 'NUMERIC'
            ];
        } elseif (preg_match('/^above-(\d+)$/', $range, $match)) {
            $price_meta[] = [
                'key' => '_price',
                'value' => (int)$match[1],
                'compare' => '>',
                'type' => 'NUMERIC'
            ];
        } elseif (preg_match('/^(\d+)-(\d+)$/', $range, $match)) {
            $price_meta[] = [
                'key' => '_price',
                'value' => [ (int)$match[1], (int)$match[2] ],
                'compare' => 'BETWEEN',
                'type' => 'NUMERIC'
            ];
        }
    }

    if (count($price_meta) > 1) {
        $meta_query[] = $price_meta;
    }
}

// Popularity
if (isset($_GET['popular'])) {
    $meta_query[] = array(
        'key' => 'popularity',
        'value' => '1',
        'compare' => '='
    );
}


if (isset($_GET['brand']) && is_array($_GET['brand'])) {
    $brand_values = array_map('sanitize_text_field', $_GET['brand']);
    $tax_query[] = array(
        'taxonomy' => 'product_brand',
        'field'    => 'slug',
        'terms'    => $brand_values,
        'operator' => 'IN',
    );
}


// Screen Size
if (isset($_GET['screen_size']) && is_array($_GET['screen_size'])) {
    $lcd_size_values = array_map('sanitize_text_field', $_GET['screen_size']);
    $tax_query[] = array(
        'taxonomy' => 'pa_screen-size',
        'field'    => 'slug',
        'terms'    => $lcd_size_values,
        'operator' => 'IN',
    );
}

// Category
if (!empty($_GET['category'])) {
    $tax_query[] = array(
        'taxonomy' => 'product_cat',
        'field'    => 'slug',
        'terms'    => $_GET['category'],
    );
}
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
// Final query
$args = array(
    'post_type'      => 'product',
     'posts_per_page' => 12,
    'paged' => $paged,
    'meta_query'     => $meta_query,

);

// Only add tax_query if there are filters
if (!empty($tax_query) && count($tax_query) > 1) {
    $args['tax_query'] = $tax_query;
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

<?php
$products = get_posts(array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'fields' => 'ids',
));


?>


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
      <?php
$price_ranges = get_field('price_range', 'option'); 

 ?>
 <!-- price filter -->
<div class="filteroption">
    <div class="filter_tag flex justify-between down_arrow cursor-pointer">
        <h1 class="text-[14px] text-[#404040] font-semibold uppercase">Set Your Price Range</h1>
        <img class="shop_dropdown" src="https://static.priceoye.pk/images/caret.svg">
    </div>
    <div id="openfilter" class="filter_option hidden mt-3 pb-[2.5rem] border-b border-[#dbdbdb]">
        <?php foreach ($price_ranges as  $range):
        $add_price = $range['add_price']; 
            $range_label = esc_html($add_price['price']);
            $range_value = esc_attr($add_price['value']);
            $input_id = 'price_range_' . $index;
            $is_checked = (isset($_GET['price']) && in_array($range_value, $_GET['price'])) ? 'checked' : '';
        ?>
        <div class="flex items-center gap-[5px]">
            <input type="checkbox" name="price[]" value="<?php echo $range_value; ?>" id="<?php echo $range_label; ?>" <?php echo $is_checked; ?>>
            <label for="<?php echo $range_label; ?>"><?php echo $range_label; ?></label>
        </div>
        <?php endforeach; ?>
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

<?php
$screen_sizes = get_terms(array(
    'taxonomy'   => 'pa_screen-size',
    'hide_empty' => false, 
));

if (!empty($screen_sizes) && !is_wp_error($screen_sizes)) : ?>
    <div class="filteroption">
        <div class="filter_tag flex justify-between down_arrow cursor-pointer pt-[20px]">
            <h1 class="text-[14px] text-[#404040] font-semibold uppercase">Screen Size</h1>
            <img class="shop_dropdown" src="https://static.priceoye.pk/images/caret.svg">
        </div>
        <div class="filter_option mt-3 pb-[2.5rem] border-b border-[#dbdbdb] hidden">
            <?php foreach ($screen_sizes as $size) : ?>
                <div class="screen_filter">
                    <input 
                        type="checkbox" 
                        name="screen_size[]" 
                        value="<?php echo esc_attr($size->slug); ?>" 
                        id="<?php echo esc_attr($size->slug); ?>"
                        <?php if (isset($_GET['screen_size']) && in_array($size->slug, $_GET['screen_size'])) echo 'checked'; ?>
                    >
                    <label for="<?php echo esc_attr($size->slug); ?>"><?php echo esc_html($size->name); ?></label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<!-- Brand filter -->

<?php 

// $brands = array();

// foreach ($products as $product_id) {
//     $brand = get_field('brand', $product_id);
//     if ($brand && !in_array($brand, $brands)) {
//         $brands[] = $brand;
//     }
// }
$allbrands = get_terms(array(
    'taxonomy'   => 'product_brand',
    'hide_empty' => false, 
));
?>
<div class="filteroption">
   <div class="filter_tag flex justify-between down_arrow cursor-pointer pt-[20px]">
      <h1 class="text-[14px] text-[#404040] font-semibold uppercase">Brand</h1>
      <img class="shop_dropdown" src="https://static.priceoye.pk/images/caret.svg">
   </div>
   <div class="filter_option mt-3 pb-[2.5rem] border-b border-[#dbdbdb] hidden">
      <?php if (!empty($allbrands) && !is_wp_error($allbrands)): ?>
         <?php foreach ($allbrands as $brandeach): ?>
            <div class="brand_filter">
               <input 
                 type="checkbox" 
                 name="brand[]" 
                 value="<?php echo esc_attr($brandeach->slug); ?>" 
                 id="brand_<?php echo esc_attr($brandeach->slug); ?>"
                 <?php if (isset($_GET['brand']) && in_array($brandeach->slug, $_GET['brand'])) echo 'checked'; ?>
               >
               <label class="capitalize" for="brand_<?php echo esc_attr($brandeach->slug); ?>">
                 <?php echo esc_html($brandeach->name); ?>
               </label>
               <br>
            </div>
         <?php endforeach; ?>
      <?php else: ?>
         <p>No brands found.</p>
      <?php endif; ?>
   </div>
</div>



<!-- category -->
   <?php
$parent = get_term_by('slug', 'topcategory', 'product_cat');
$children = get_terms('product_cat', array(
    
    'parent' => $parent->term_id,
    'hide_empty' => false,
));
?>


<div class="filteroption">
   <div   class="filter_tag flex justify-between down_arrow cursor-pointer pt-[20px]">
          <h1 class="text-[14px] text-[#404040] font-semibold uppercase" >Category</h1>
          <img class="shop_dropdown" src="https://static.priceoye.pk/images/caret.svg">
        </div>
    <div class="filter_option mt-3 pb-[2.5rem] hidden">
       <?php
 foreach($children as $child):
 $thumbnail_id = get_term_meta($child->term_id, 'thumbnail_id', true);
 
?>
   <div class="categoryfilter">
        
  <input type="checkbox" name="category[]" value="<?php echo esc_html($child->slug); ?>" id="<?php echo esc_html($child->slug); ?>" <?php if (isset($_GET['category']) && in_array($child->slug, $_GET['category'])) echo 'checked'; ?>>
  <label for="<?php echo esc_html($child->slug); ?>"><?php echo esc_html($child->name); ?></label><br>
  </div>
  
<?php endforeach?>
   
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
     <!-- Pagination here -->
  <div class="pagination items-center mt-8 flex justify-end col-span-4">
    <?php
    echo paginate_links(array(
        'total'   => $query->max_num_pages,
        'current' => $paged,
        'prev_text' => __('« Prev'),
        'next_text' => __('Next »'),
    ));
    ?>
  </div>
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
