<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(  );?>/assets/img/favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
    rel="stylesheet">
  <title>PriceOye</title>
  <?php wp_head(); ?>
</head>

<body>

  <header class="themebgsh p-[10px] sticky top-[-1px] z-[10000]">
    
    <div class="header_inner flex justify-between !items-center gap-[8px] md:gap-[unset]">
      <div class="logo flex item-center justify-center w-fit gap-[10px]">
        <div id="ham" class="hamburger cursor-pointer">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/download.svg" width="28">
        </div>
        <?php
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
        if (has_custom_logo()) {
          echo '<a href="' . esc_url(home_url('/')) . '">';
          echo '<img class="!w-[120px]" src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '">';
          echo '</a>';

        } else {
          echo '<h1>' . get_bloginfo('name') . '</h1>';
        }
        ?>
      </div>

      <div class="searchform ">
        <?php get_search_form(); ?>
      </div>
      <?php
      $Header_login = get_field('header', 'option');
      $Header_signup = get_field('Register', 'option');

      ?>
      <div class="header_logins hidden lg:block">
    <?php if ( ! is_user_logged_in() ) : ?>
        <a href="<?php echo esc_url($Header_login['url']); ?>"
           class="py-[10px] text-[12px] px-[20px] text-[#48afff] bg-white text-center rounded-[4px] login tracking-widest mr-[10px]">
            <?php echo esc_html($Header_login['title']); ?>
        </a>

        <a href="<?php echo esc_url($Header_signup['url']); ?>"
           class="py-[10px] text-[12px] px-[20px] border border-[#fff] text-white bg-transparent text-center rounded-[4px] register tracking-widest">
            <?php echo esc_html($Header_signup['title']); ?>
        </a>
    <?php else : ?>
        <?php
        $current_user = wp_get_current_user();
        $avatar = get_avatar( $current_user->ID, 30 );
        $logout_url = wp_logout_url( home_url() );
        ?>
        <div class="user-avatar flex flex-col items-center relative">
            <a href="/" class="flex justify-center  items-center space-x-2">
                <?php echo $avatar; ?>
                <span class="text-white text-[18px] capitalize"><?php echo esc_html($current_user->display_name); ?></span>
            </a>
             <a href="<?php echo esc_url($logout_url); ?>" class="logout text-white text-[14px] hover:underline">
        Logout
    </a>
        </div>
    <?php endif; ?>
</div>

    </div>
    <div
      class="menuslider  top-[1px] bg-[#00000080] absolute z-[1000] h-screen   left-[0px] opacity-0 transition-all delay-150 duration-300 ease-in-out">
      <div class="hamburgers w-[0px] transition-all delay-150 duration-300 ease-in-out h-screen overflow-scroll">
        <div
          class="blue_bg  bg-[#48afff] flex justify-between w-full items-start   py-[0px] px-[0px] h-[284px] w-[343px] transition-all delay-150 duration-300 ease-in-out">
          <div class="logoandbutton">
            <?php
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
            if (has_custom_logo()) {
              echo '<a href="' . esc_url(home_url('/')) . '">';
              echo '<img class="!w-[120px]" src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '">';
              echo '</a>';

            } else {
              echo '<h1>' . get_bloginfo('name') . '</h1>';
            }
            ?>
              <?php if ( ! is_user_logged_in() ) : ?>
       <a href="<?php echo $Header_login['url'] ?>"
              class="py-[10px] font-bold text-[12px] px-[20px] text-[#48afff] bg-white text-center rounded-[4px] login tracking-widest mt-[10px] block w-[90%]">Logins</a>
    <?php else : ?>
        <?php
        $current_user = wp_get_current_user();
        $avatar = get_avatar( $current_user->ID, 30 );
        ?>
        <div class="user-avatar flex items-center my-[10px]">
            <a href="/" class="flex items-center space-x-2 gap-[5px]">
                <?php echo $avatar; ?>
                <span class="text-white text-[18px] capitalize"><?php echo esc_html($current_user->display_name); ?></span>
            </a>
        </div>
    <?php endif; ?>
           
              <a href="/orders-tracking" class="trackorder flex gap-[5px] items-center text-[15px] text-white font-normal my-[10px]" ><img src="https://static.priceoye.pk/images/user-dashboard/tracker.svg"> Track my Order</a>
          </div>
          <img src="https://static.priceoye.pk/icons/close-box.svg" class="close-icon cursor-pointer" alt="close-icon"
            width="20px" height="20px">

        </div>
        <div
          class="menu_below h-fit p-[0px] text-[#748a98] text-[12px] font-[600] bg-white transition-all delay-150 duration-300 ease-in-out">
          <h1 class="mb-[10px]">CATEGORIES</h1>
         <?php

$category = get_term_by('slug', 'mobiles', 'product_cat');

if ($category) :
    $term_id = 'product_cat_' . $category->term_id;
    $shop_page_url = get_permalink(get_page_by_path('shop-2'));
    
?>
<div class="header_category flex flex-col gap-3 py-[10px]">
  <div class="categies flex justify-between pl-[15px] pr-[20px]">
    <div class="category flex gap-[6px] items-center">
      <img src="https://static.priceoye.pk/images/mobiles-3.svg">
      <p class="text-[#404040] text-[13px] font-normal">Mobiles</p>
    </div>
    <img class="shop_dropdown" src="https://static.priceoye.pk/images/caret.svg">
  </div>

  <?php if (have_rows('brand_images', $term_id)) : ?>
    <div class="filter_option flex flex-col font-normal mt-3 pb-[2.5rem] border-t border-[#dbdbdb] hidden">
      <?php while (have_rows('brand_images', $term_id)) : the_row(); 
        $brand_name = get_sub_field('name');
        $brand_image = get_sub_field('image');
        ?>
        <a class="py-[5px] px-[17px] text-[13px] text-[#404040] cat_headerbrand capitalize flex items-center gap-2" 
           href="<?php echo esc_url(add_query_arg('brand[]', $brand_name, $shop_page_url)); ?>">
          <?php if ($brand_image) : ?>
            <img src="<?php echo esc_url($brand_image['url']); ?>" alt="<?php echo esc_attr($brand_name); ?>" class="w-5 h-5 object-contain">
          <?php endif; ?>
          <?php echo esc_html($brand_name); ?>
        </a>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>
</div>
<?php endif; ?>
         <?php

$category = get_term_by('slug', 'smart-watches', 'product_cat');

if ($category) :
    $term_id = 'product_cat_' . $category->term_id;
    $shop_page_url = get_permalink(get_page_by_path('shop-2'));
?>
<div class="header_category flex flex-col gap-3 py-[10px]">
  <div class="categies flex justify-between pl-[15px] pr-[20px]">
    <div class="category flex gap-[6px] items-center">
      <img src="https://static.priceoye.pk/images/smart_watches.svg">
      <p class="text-[#404040] text-[13px] font-normal">Watches</p>
    </div>
    <img class="shop_dropdown" src="https://static.priceoye.pk/images/caret.svg">
  </div>

  <?php if (have_rows('brand_images', $term_id)) : ?>
    <div class="filter_option flex flex-col font-normal mt-3 pb-[2.5rem] border-t border-[#dbdbdb] hidden">
      <?php while (have_rows('brand_images', $term_id)) : the_row(); 
        $brand_name = get_sub_field('name');
        $brand_image = get_sub_field('image');
        ?>
        <a class="py-[5px] px-[17px] text-[13px] text-[#404040] cat_headerbrand capitalize flex items-center gap-2" 
           href="<?php echo esc_url(add_query_arg('brand[]', $brand_name, $shop_page_url)); ?>">
          <?php if ($brand_image) : ?>
            <img src="<?php echo esc_url($brand_image['url']); ?>" alt="<?php echo esc_attr($brand_name); ?>" class="w-5 h-5 object-contain">
          <?php endif; ?>
          <?php echo esc_html($brand_name); ?>
        </a>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>
</div>
<?php endif; ?>
         <?php

$category = get_term_by('slug', 'wireless-airbuds', 'product_cat');

if ($category) :
    $term_id = 'product_cat_' . $category->term_id;
    $shop_page_url = get_permalink(get_page_by_path('shop-2'));
?>
<div class="header_category flex flex-col gap-3 py-[10px]">
  <div class="categies flex justify-between pl-[15px] pr-[20px]">
    <div class="category flex gap-[6px] items-center">
      <img src="https://static.priceoye.pk/images/wireless_earbuds-3.svg">
      <p class="text-[#404040] text-[13px] font-normal">Wireless Earbuds</p>
    </div>
    <img class="shop_dropdown" src="https://static.priceoye.pk/images/caret.svg">
  </div>

  <?php if (have_rows('brand_images', $term_id)) : ?>
    <div class="filter_option flex flex-col font-normal mt-3 pb-[2.5rem] border-t border-[#dbdbdb] hidden">
      <?php while (have_rows('brand_images', $term_id)) : the_row(); 
        $brand_name = get_sub_field('name');
        $brand_image = get_sub_field('image');
        ?>
        <a class="py-[5px] px-[17px] text-[13px] text-[#404040] cat_headerbrand capitalize flex items-center gap-2" 
           href="<?php echo esc_url(add_query_arg('brand[]', $brand_name, $shop_page_url)); ?>">
          <?php if ($brand_image) : ?>
            <img src="<?php echo esc_url($brand_image['url']); ?>" alt="<?php echo esc_attr($brand_name); ?>" class="w-5 h-5 object-contain">
          <?php endif; ?>
          <?php echo esc_html($brand_name); ?>
        </a>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>
</div>
<?php endif; ?>
         <?php

$category = get_term_by('slug', 'bluetooth-speaker', 'product_cat');

if ($category) :
    $term_id = 'product_cat_' . $category->term_id;
    $shop_page_url = get_permalink(get_page_by_path('shop-2'));
?>
<div class="header_category flex flex-col gap-3 py-[10px]">
  <div class="categies flex justify-between pl-[15px] pr-[20px]">
    <div class="category flex gap-[6px] items-center">
      <img src="	https://static.priceoye.pk/images/blutooth_speaker.svg">
      <p class="text-[#404040] text-[13px] font-normal">Bluetooth Speakers</p>
    </div>
    <img class="shop_dropdown" src="https://static.priceoye.pk/images/caret.svg">
  </div>

  <?php if (have_rows('brand_images', $term_id)) : ?>
    <div class="filter_option flex flex-col font-normal mt-3 pb-[2.5rem] border-t border-[#dbdbdb] hidden">
      <?php while (have_rows('brand_images', $term_id)) : the_row(); 
        $brand_name = get_sub_field('name');
        $brand_image = get_sub_field('image');
        ?>
        <a class="py-[5px] px-[17px] text-[13px] text-[#404040] cat_headerbrand capitalize flex items-center gap-2" 
           href="<?php echo esc_url(add_query_arg('brand[]', $brand_name, $shop_page_url)); ?>">
          <?php if ($brand_image) : ?>
            <img src="<?php echo esc_url($brand_image['url']); ?>" alt="<?php echo esc_attr($brand_name); ?>" class="w-5 h-5 object-contain">
          <?php endif; ?>
          <?php echo esc_html($brand_name); ?>
        </a>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>
</div>
<?php endif; ?>
         <?php

$category = get_term_by('slug', 'power-banks', 'product_cat');

if ($category) :
    $term_id = 'product_cat_' . $category->term_id;
    $shop_page_url = get_permalink(get_page_by_path('shop-2'));
?>
<div class="header_category flex flex-col gap-3 py-[10px]">
  <div class="categies flex justify-between pl-[15px] pr-[20px]">
    <div class="category flex gap-[6px] items-center">
      <img src="	https://static.priceoye.pk/images/power-bank.svg">
      <p class="text-[#404040] text-[13px] font-normal">Power Banks</p>
    </div>
    <img class="shop_dropdown" src="https://static.priceoye.pk/images/caret.svg">
  </div>

  <?php if (have_rows('brand_images', $term_id)) : ?>
    <div class="filter_option flex flex-col font-normal mt-3 pb-[2.5rem] border-t border-[#dbdbdb] hidden">
      <?php while (have_rows('brand_images', $term_id)) : the_row(); 
        $brand_name = get_sub_field('name');
        $brand_image = get_sub_field('image');
        ?>
        <a class="py-[5px] px-[17px] text-[13px] text-[#404040] cat_headerbrand capitalize flex items-center gap-2" 
           href="<?php echo esc_url(add_query_arg('brand[]', $brand_name, $shop_page_url)); ?>">
          <?php if ($brand_image) : ?>
            <img src="<?php echo esc_url($brand_image['url']); ?>" alt="<?php echo esc_attr($brand_name); ?>" class="w-5 h-5 object-contain">
          <?php endif; ?>
          <?php echo esc_html($brand_name); ?>
        </a>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>
</div>
<?php endif; ?>
         <?php

$category = get_term_by('slug', 'tablets', 'product_cat');

if ($category) :
    $term_id = 'product_cat_' . $category->term_id;
    $shop_page_url = get_permalink(get_page_by_path('shop-2'));
?>
<div class="header_category flex flex-col gap-3 py-[10px]">
  <div class="categies flex justify-between pl-[15px] pr-[20px]">
    <div class="category flex gap-[6px] items-center">
      <img src="https://static.priceoye.pk/images/tablets.svg">
      <p class="text-[#404040] text-[13px] font-normal">Tablets</p>
    </div>
    <img class="shop_dropdown" src="https://static.priceoye.pk/images/caret.svg">
  </div>

  <?php if (have_rows('brand_images', $term_id)) : ?>
    <div class="filter_option flex flex-col font-normal mt-3 pb-[2.5rem] border-t border-[#dbdbdb] hidden">
      <?php while (have_rows('brand_images', $term_id)) : the_row(); 
        $brand_name = get_sub_field('name');
        $brand_image = get_sub_field('image');
        ?>
        <a class="py-[5px] px-[17px] text-[13px] text-[#404040] cat_headerbrand capitalize flex items-center gap-2" 
           href="<?php echo esc_url(add_query_arg('brand[]', $brand_name, $shop_page_url)); ?>">
          <?php if ($brand_image) : ?>
            <img src="<?php echo esc_url($brand_image['url']); ?>" alt="<?php echo esc_attr($brand_name); ?>" class="w-5 h-5 object-contain">
          <?php endif; ?>
          <?php echo esc_html($brand_name); ?>
        </a>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>
</div>
<?php endif; ?>
         <?php

$category = get_term_by('slug', 'laptops', 'product_cat');

if ($category) :
    $term_id = 'product_cat_' . $category->term_id;
    $shop_page_url = get_permalink(get_page_by_path('shop-2'));
?>
<div class="header_category flex flex-col gap-3 py-[10px]">
  <div class="categies flex justify-between pl-[15px] pr-[20px]">
    <div class="category flex gap-[6px] items-center">
      <img src="https://static.priceoye.pk/images/laptop-mac-outline.svg">
      <p class="text-[#404040] text-[13px] font-normal">Laptops</p>
    </div>
    <img class="shop_dropdown" src="https://static.priceoye.pk/images/caret.svg">
  </div>

  <?php if (have_rows('brand_images', $term_id)) : ?>
    <div class="filter_option flex flex-col font-normal mt-3 pb-[2.5rem] border-t border-[#dbdbdb] hidden">
      <?php while (have_rows('brand_images', $term_id)) : the_row(); 
        $brand_name = get_sub_field('name');
        $brand_image = get_sub_field('image');
        ?>
        <a class="py-[5px] px-[17px] text-[13px] text-[#404040] cat_headerbrand capitalize flex items-center gap-2" 
           href="<?php echo esc_url(add_query_arg('brand[]', $brand_name, $shop_page_url)); ?>">
          <?php if ($brand_image) : ?>
            <img src="<?php echo esc_url($brand_image['url']); ?>" alt="<?php echo esc_attr($brand_name); ?>" class="w-5 h-5 object-contain">
          <?php endif; ?>
          <?php echo esc_html($brand_name); ?>
        </a>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>
</div>
<?php endif; ?>
 
          <h1 class="mt-[60px] mb-[10px]">MAIN NAVIGATION</h1>
          <?php

          wp_nav_menu(
            array(
              'theme_location' => 'footer-menu1',
              'container_class' => 'catanav_class'
            )
          );
          ?>
        </div>
      </div>

    </div>
    </div>
  </header>
<script>
  document.querySelectorAll('.categies').forEach(category => {
    category.addEventListener('click', () => {
      const catfilterOption = category.nextElementSibling;
      const headerCategory = category.closest('.header_category');

      if (catfilterOption && catfilterOption.classList.contains('filter_option')) {
        catfilterOption.classList.toggle('hidden');
        category.classList.toggle('downoption');
        headerCategory.classList.toggle('bg-[#748a980d]');
      }
    });
  });
</script>
