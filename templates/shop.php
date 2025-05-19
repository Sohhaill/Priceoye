<?php
/*
Template Name: Shop Page
*/
get_header();
?>

<?php
$size = get_field('screen_size');

$meta_query = [];
$category_slug = sanitize_text_field($_GET['category'] ?? '');


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
 <?php  if(($query->have_posts())): ?>
<div class="shopallmain p-[25px] flex gap-[18px] items-start">


  <div class="filters bg-white p-[30px]">
    <form method="GET" class="filter_form">
      <div class="filteroption">
        <div   class="filter_tag flex justify-between down_arrow cursor-pointer">
          <h1 class="text-[14px] text-[#404040] font-semibold uppercase" >Set Your Price Range</h1>
          <img src="https://static.priceoye.pk/images/caret.svg">
        </div>
        <div id="openfilter" class="filter_option mt-3 pb-[2.5rem] border-b border-[#dbdbdb]    border-b border-[#dbdbdb] ">
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
          <img src="https://static.priceoye.pk/images/caret.svg">
        </div>
  <div class="filter_option mt-3 pb-[2.5rem] border-b border-[#dbdbdb]    border-b border-[#dbdbdb]  ">
  <input type="checkbox" name="popular" value="1" id="popular" <?php if (isset($_GET['popular'])) echo 'checked'; ?>>
  <label for="popular">Most Popular</label>
  </div>
</div>

<!-- LCD Size Filter -->
<div class="filteroption">
   <div   class="filter_tag flex justify-between down_arrow cursor-pointer pt-[20px]">
          <h1 class="text-[14px] text-[#404040] font-semibold uppercase" >LCD Size</h1>
          <img src="https://static.priceoye.pk/images/caret.svg">
        </div>
    <div class="filter_option mt-3 pb-[2.5rem] border-b border-[#dbdbdb]  ">
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
          <img src="https://static.priceoye.pk/images/caret.svg">
        </div>
    <div class="filter_option mt-3 pb-[2.5rem] border-b border-[#dbdbdb]  ">
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
  </div>
</div>

<!-- category -->
<div class="filteroption">
   <div   class="filter_tag flex justify-between down_arrow cursor-pointer pt-[20px]">
          <h1 class="text-[14px] text-[#404040] font-semibold uppercase" >Category</h1>
          <img src="https://static.priceoye.pk/images/caret.svg">
        </div>
    <div class="filter_option mt-3 pb-[2.5rem] ">
  <input type="checkbox" name="category[]" value="mobiles" id="category1" <?php if (isset($_GET['category']) && in_array('mobiles', $_GET['category'])) echo 'checked'; ?>>
  <label for="category1">Mobile</label><br>
  <input type="checkbox" name="category[]" value="tablets" id="category2" <?php if (isset($_GET['category']) && in_array('tablets', $_GET['category'])) echo 'checked'; ?>>
  <label for="category2">Tablet</label><br>
  <input type="checkbox" name="category[]" value="laptops" id="category3" <?php if (isset($_GET['category']) && in_array('laptops', $_GET['category'])) echo 'checked'; ?>>
  <label for="category3">Laptop</label><br>
  <input type="checkbox" name="category[]" value="wireless-airbuds" id="category4" <?php if (isset($_GET['category']) && in_array('wireless-airbuds', $_GET['category'])) echo 'checked'; ?>>
  <label for="category4">AirBuds</label><br>
  <input type="checkbox" name="category[]" value="smart-watches-2" id="category5" <?php if (isset($_GET['category']) && in_array('smart-watches-2', $_GET['category'])) echo 'checked'; ?>>
  <label for="category5">Watches</label><br>
  <input type="checkbox" name="category[]" value="bluetooth-speaker" id="category6" <?php if (isset($_GET['category']) && in_array('bluetooth-speaker', $_GET['category'])) echo 'checked'; ?>>
  <label for="category6">Speaker</label><br>
    <input type="checkbox" name="category[]" value="power-banks" id="category7" <?php if (isset($_GET['category']) && in_array('power-banks', $_GET['category'])) echo 'checked'; ?>>
  <label for="category7">Power Banks</label><br>
  </div>
</div>
    </form>


  </div>

  <div class="grid grid-cols-4 gap-[9px] w-full">
    <?php while ($query->have_posts()) : $query->the_post(); global $product; ?>
      <?php $image_url = wp_get_attachment_image_url($product->get_image_id(), 'full'); ?>
      <div class="p-4 rounded-[4px]  bg-white shopproducts">
        <a class="flex flex-col items-center gap-[7px]" href="<?php the_permalink(); ?>">
          <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>" class="w-[120px] h-[120px] object-cover" />
          <h3 class="text-[13px] font-semibold mr-auto mt-[15px] mb-[10px] h-[32px]"><?php the_title(); ?></h3>
          <p class="flex flex-col mr-auto"><?php echo $product->get_price_html(); ?></p>
        </a>
      </div>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>
  </div>
 <?php else : ?>
  <div class="container"> <h1 class="text-[32px] mt-[50px] text-center" >No products available</h1></div>
 <?php endif?>



<script>

let downarrow = document.querySelectorAll('.down_arrow');

downarrow.forEach(arrow => {
  arrow.addEventListener('click', () => {
    let filteroption = arrow.closest('.filteroption').querySelector('.filter_option');
    filteroption.classList.toggle('hidden');
    arrow.classList.toggle('downoption');
  });
});


  document.querySelectorAll('.filter_form input[type=checkbox]').forEach(cb => {
    cb.addEventListener('change', () => {
      cb.closest('form').submit();
    });
  });
</script>

<?php get_footer(); ?>
