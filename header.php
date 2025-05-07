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
  <title>Wotheme</title>
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
      <div class="header_logins hidden lg:block ">
        <a href="<?php echo $Header_login['url'] ?>"
          class="py-[10px] text-[12px] px-[20px] text-[#48afff] bg-white text-center rounded-[4px] login tracking-widest mr-[10px]"><?php echo $Header_login['title'] ?></a>
        <a href="<?php echo $Header_signup['url'] ?>"
          class="py-[10px] text-[12px] px-[20px] border border-[#fff] text-white bg-transparent text-center rounded-[4px] register tracking-widest"><?php echo $Header_signup['title'] ?></a>
      </div>
    </div>
    <div
      class="menuslider  top-[1px] bg-[#00000080] absolute z-[-1] h-screen   left-[0px] opacity-0 transition-all delay-150 duration-300 ease-in-out">
      <div class="hamburgers w-[0px] transition-all delay-150 duration-300 ease-in-out h-screen">
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
            <a
              class="py-[10px] font-bold text-[12px] px-[20px] text-[#48afff] bg-white text-center rounded-[4px] login tracking-widest mt-[10px] block w-[90%]">Logins</a>
          </div>
          <img src="https://static.priceoye.pk/icons/close-box.svg" class="close-icon cursor-pointer" alt="close-icon"
            width="20px" height="20px">

        </div>
        <div
          class="menu_below h-full p-[0px] text-[#748a98] text-[12px] font-[600] bg-white transition-all delay-150 duration-300 ease-in-out">
          <h1 class="mb-[10px]">CATEGORIES</h1>
          <?php

          wp_nav_menu(
            array(
              'theme_location' => 'header-menu',
              'container_class' => 'catanav_class'
            )
          );
          ?>

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