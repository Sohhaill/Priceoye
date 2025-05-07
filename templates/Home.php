<?php
/*
Template Name: Home Page
*/

?>

<?php get_header()?>


<div class="cat_slider h-[94px] !bg-white">
<div class="swiper cattop container">

  <div class="swiper-wrapper">
  <?php
$parent = get_term_by('slug', 'topcategory', 'product_cat');
$children = get_terms('product_cat', array(
    
    'parent' => $parent->term_id,
    'hide_empty' => false,
));
?>

<?php foreach ($children as $child) :
    $thumbnail_id = get_term_meta($child->term_id, 'thumbnail_id', true);
    $image_url = wp_get_attachment_url($thumbnail_id);
    $shop_page_url = get_permalink( get_page_by_path( 'category-shop' ) ); 
    $term_link = add_query_arg( 'category', $child->slug, $shop_page_url );


?>
    <div class="swiper-slide">
        <a href="<?php echo esc_url($term_link); ?>">
            <div class="vediosldies slider_inner flex items-center justify-center flex-col p-[7.5px]"> 
                <?php if ($image_url) : ?>       
                    <img src="<?php echo esc_url($image_url); ?>" width="48">
                <?php endif; ?>
                <p class="sldier_productprice text-[12px] text-center"><?php echo esc_html($child->name); ?></p>
            </div>
        </a>
    </div>
<?php endforeach; ?>



  

  </div>

  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>

</div>

</div>

<section class="bannersection mt-[15px]" >
    <div class="swiper bannerswiper">
        <div class="swiper-wrapper" >
            <?php 
            
            $banner_images= get_field('banner_slider');
          
            
            ?>
            <?php foreach ($banner_images as $image) :
                
            ?>
            <div class="swiper-slide banner_innerslider">
    <img src="<?php echo esc_url($image['images']['url'])?>" class="w-full" >
</div>
<?php endforeach?>



</div>

<div class="swiper-button-prev bannernav1"></div>
  <div class="swiper-button-next bannernav2"></div>
</div>

</section>
<section class="sale mt-[30px]" >
<div class="container m-auto">
    <div class="topbanner relative">
        <img class="m-auto" src="<?php echo get_template_directory_uri(  );?>/assets/img/sale-home-desk.png" >
        <h1 class=" text-[20px] md:text-[40px] font-[600] text-center z-[22] absolute top-[1px] md:top-[22px] text-white w-[93%]" >Spring Season Sale</h1>
    </div>
   
</div>
</section>
<section class="seasongrid bg-[#09907e] " >
<?php
$args = array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => 'mobiles',
        ),
    ),
);
$shop_page_url = get_permalink( get_page_by_path( 'category-shop' ) ); 
$shopall = add_query_arg( 'category', 'mobiles', $shop_page_url );
$products = new WP_Query($args);

if ($products->have_posts()) :
    $posts_array = $products->posts;
    ?>
<div class="springgrid container !pt-[60px] !pb-[30px]">
    <div class="viewall text-right pb-[30px] flex justify-between items-center">
    <h1 class="text-[18px] font-[600] text-white" >Latest Mobiles</h1>
        
        <a href="<?php echo esc_url($shopall); ?>" ><button class="cursor-pointer whitebtn font-[600]  border border-[#c1bdbd] py-[10px] px-[20px] text-[12px] text-center rounded-[4px]" >View All</button></a>
    </div>
   

    <div class="swiper season_maingrid ">
        <div class="swiper-wrapper ">
        <?php foreach ($posts_array as $post) : 
                setup_postdata($post);
                global $product;

                $image = get_the_post_thumbnail_url($post->ID, 'medium');
                $name = get_the_title($post->ID);
              
                ?>
       <div class="swiper-slide">
    
    <div class="mainslide">
<div class="topgrid relative  bg-white flex justify-center items-center flex-col p-[20px] rounded-[5px]">
<a  href="<?php echo get_permalink($post->ID); ?>">
        <img src="<?php echo esc_url($image); ?>" width="120">
        </a>
        <p class="name font-[600] text-[13px] mt-[15px] mb-[10px] text-[#404040] h-[32px] self-start" ><?php echo esc_attr($name); ?></p>
        <p class="text-[12px] text-[#07121b66] flex flex-col self-start " ><?php echo $product->get_price_html(); ?></p>
        <?php ?>
        <div class="regularprice self-end flex justify-end w-full">
          
          
                <p class="text-[#0bb07e] bg-[#f0faf7] rounded-[8px] p-[5px] font-[600] text-[10px]" >30% OFF</p>
           
        </div>
        <div class="home-badges !w-fit absolute top-[1px] right-[1px]">
               <img src="<?php echo get_template_directory_uri(  );?>/assets/img/priceoye-sale-20250415-9maty.png" width="60" height="60" >
            </div>

    
</div>

</div>
       </div>
<?php endforeach?>

</div>
<div class="swiper-button-prev season_maingridav1"></div>
  <div class="swiper-button-next season_maingridnav2"></div>
    </div>
        
<?php
else :
    echo '<p>No products found in this category.</p>';
endif;
wp_reset_query(); 
?>
 


</div>

</section>
<section class="Crazydeal mt-[30px] pb-[60px] " >
<?php
$args = array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => 'new-arrivals',
        ),
    ),
);

$shop_page_url = get_permalink( get_page_by_path( 'category-shop' ) ); 
$speaker = add_query_arg( 'category', 'bluetooth-speaker', $shop_page_url );
$products = new WP_Query($args);

if ($products->have_posts()) :
    $posts_array = $products->posts;
    ?>
<div class="springgrid container !pt-[60px] !pb-[30px]">
    <div class="viewall text-right pb-[30px] flex justify-between items-center">
        <h1 class="text-[18px] font-[600] text-black" ><span class="text-[#f53d3d]" >New </span>Arrivals</h1>
            </div>
   

    <div class="swiper crazyslider">
        <div class="swiper-wrapper ">
        <?php foreach ($posts_array as $post) : 
                setup_postdata($post);
                global $product;

                $image = get_the_post_thumbnail_url($post->ID, 'medium');
                $name = get_the_title($post->ID);
              
                ?>
       <div class="swiper-slide">
    
    <div class="mainslide">
<div class="topgrid relative  bg-white flex justify-center items-center flex-col p-[20px] rounded-[5px]">
<a  href="<?php echo get_permalink($post->ID); ?>">
        <img class="object-fill !h-[120px]" src="<?php echo esc_url($image); ?>" width="120">
        </a>
        <p class="name font-[600] text-[13px] mt-[15px] mb-[10px] text-[#404040] h-[32px] self-start" ><?php echo esc_attr($name); ?></p>
        <p class="text-[12px] text-[#07121b66] flex flex-col self-start " ><?php echo $product->get_price_html(); ?></p>
        <div class="regularprice self-end flex justify-end w-full">
          
          
                <p class="text-[#0bb07e] bg-[#f0faf7] rounded-[8px] p-[5px] font-[600] text-[10px]" >30% OFF</p>
           
        </div>
       
    
</div>

</div>
       </div>
<?php endforeach?>

</div>

    </div>
        
<?php
else :
    echo '<p>No products found in this category.</p>';
endif;
wp_reset_query(); 
?>
 


</div>

</section>
<section class="wirlessairbuds mt-[30px] pb-[60px] " >
<?php
$args = array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => 'wireless-airbuds',
        ),
    ),
);

$products = new WP_Query($args);
$shop_page_url = get_permalink( get_page_by_path( 'category-shop' ) ); 
$wirelessall = add_query_arg( 'category', 'wireless-airbuds', $shop_page_url );
if ($products->have_posts()) :
    $posts_array = $products->posts;
    ?>
<div class="springgrid container !pt-[60px] !pb-[30px]">
    <div class="viewall text-right pb-[30px] flex justify-between items-center">
        <h1 class="text-[18px] font-[600] text-white" >Latest Wireless Earbuds</h1>
        <a  href="<?php echo esc_url($wirelessall); ?>" ><button class="cursor-pointer whitebtn font-[600]  border border-[#c1bdbd] py-[10px] px-[20px] text-[12px] text-center rounded-[4px]" >View All</button></a>
    </div>
   

    <div class="swiper season_maingrid ">
        <div class="swiper-wrapper ">
        <?php foreach ($posts_array as $post) : 
         $shop_page_url = get_permalink( get_page_by_path( 'category-shop' ) ); 
        


                setup_postdata($post);
                global $product;

                $image = get_the_post_thumbnail_url($post->ID, 'medium');
                $name = get_the_title($post->ID);
              
                ?>
       <div class="swiper-slide">
    
    <div class="mainslide">
<div class="topgrid relative  bg-white flex justify-center items-center flex-col p-[20px] rounded-[5px]">
<a  href="<?php echo get_permalink($post->ID); ?>">
        <img class="object-fill !h-[120px]" src="<?php echo esc_url($image); ?>" width="120">
        </a>
        <p class="name font-[600] text-[13px] mt-[15px] mb-[10px] text-[#404040] h-[32px] self-start" ><?php echo esc_attr($name); ?></p>
        <p class="text-[12px] text-[#07121b66] flex flex-col self-start " ><?php echo $product->get_price_html(); ?></p>
        <div class="regularprice self-end flex justify-end w-full">
          
          
                <p class="text-[#0bb07e] bg-[#f0faf7] rounded-[8px] p-[5px] font-[600] text-[10px]" >30% OFF</p>
           
        </div>
        <div class="home-badges !w-fit absolute top-[1px] right-[1px]">
               <img src="<?php echo get_template_directory_uri(  );?>/assets/img/priceoye-sale-20250415-9maty.png" width="60" height="60" >
            </div>

    
</div>

</div>
       </div>
<?php endforeach?>

</div>
<div class="swiper-button-prev season_maingridav1"></div>
  <div class="swiper-button-next season_maingridnav2"></div>
    </div>
        
<?php
else :
    echo '<p>No products found in this category.</p>';
endif;
wp_reset_query(); 
?>
 


</div>

</section>
<section class="installment_banner mt-[unset] md:mt-[70px]" >
    <?php
    $installmentbanner = get_field('buynowbanner');


    ?>
<img class="w-full" src="<?php echo $installmentbanner['url'] ?>" >

</section>
<section class="smartwatches mt-[30px] pb-[60px] " >
<?php
$args = array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => 'smart-watches-2',
        ),
    ),
);

$shop_page_url = get_permalink( get_page_by_path( 'category-shop' ) ); 
$watches = add_query_arg( 'category', 'smart-watches-2', $shop_page_url );
$products = new WP_Query($args);

if ($products->have_posts()) :
    $posts_array = $products->posts;
    ?>
<div class="springgrid container !pt-[60px] !pb-[30px]">
    <div class="viewall text-right pb-[30px] flex justify-between items-center">
        <h1 class="text-[18px] font-[600] text-white" >Latest Smart Watches</h1>
        <a href="<?php echo esc_url($watches) ?>" ><button class="cursor-pointer whitebtn font-[600]  border border-[#c1bdbd] py-[10px] px-[20px] text-[12px] text-center rounded-[4px]" >View All</button></a>
    </div>
   

    <div class="swiper season_maingrid ">
        <div class="swiper-wrapper ">
        <?php foreach ($posts_array as $post) : 
                setup_postdata($post);
                global $product;

                $image = get_the_post_thumbnail_url($post->ID, 'medium');
                $name = get_the_title($post->ID);
              
                ?>
       <div class="swiper-slide">
    
    <div class="mainslide">
<div class="topgrid relative  bg-white flex justify-center items-center flex-col p-[20px] rounded-[5px]">
<a  href="<?php echo get_permalink($post->ID); ?>">
        <img class="object-fill !h-[120px]" src="<?php echo esc_url($image); ?>" width="120">
        </a>
        <p class="name font-[600] text-[13px] mt-[15px] mb-[10px] text-[#404040] h-[32px] self-start" ><?php echo esc_attr($name); ?></p>
        <p class="text-[12px] text-[#07121b66] flex flex-col self-start " ><?php echo $product->get_price_html(); ?></p>
        <div class="regularprice self-end flex justify-end w-full">
          
          
                <p class="text-[#0bb07e] bg-[#f0faf7] rounded-[8px] p-[5px] font-[600] text-[10px]" >30% OFF</p>
           
        </div>
        <div class="home-badges !w-fit absolute top-[1px] right-[1px]">
               <img src="<?php echo get_template_directory_uri(  );?>/assets/img/priceoye-sale-20250415-9maty.png" width="60" height="60" >
            </div>

    
</div>

</div>
       </div>
<?php endforeach?>

</div>
<div class="swiper-button-prev season_maingridav1"></div>
  <div class="swiper-button-next season_maingridnav2"></div>
    </div>
        
<?php
else :
    echo '<p>No products found in this category.</p>';
endif;
wp_reset_query(); 
?>
 


</div>

</section>
<section  class="best_seller">

    <div class="bestsellertext !pt-[60px] !pb-[30px] flex flex-col container justify-center items-center">
    <h1 class="text-[18px] text-[#404040] font-[600]" >Best Seller</h1>
    <p class="text-[14px]" >Get the best prices in town</p>
    </div>
    <?php
$args = array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => 'best-seller',
        ),
    ),
);

$products = new WP_Query($args);

if ($products->have_posts()) :
    $posts_array = $products->posts;
    ?>
               
    <div class="bestsellerinner container grid gap-[15px] grid-cols-[41%_28%_28%]">
    <?php foreach ($posts_array as $post) : 
                setup_postdata($post);
                global $product;

                $image = get_the_post_thumbnail_url($post->ID, 'medium');
                $name = get_the_title($post->ID);
              
                ?>

    <a  class="griditemsbest" href="<?php echo get_permalink($post->ID); ?>">
       <div class="bg-white p-[20px] rounded-[5px] flex flex-col items-start relative h-full ">
        <div class="nameandimage flex flex-col lg:flex-row">
<p class="font-[600] text-[13px] " ><?php echo esc_attr($name); ?></p>

<img class="m-[auto]" src="<?php echo esc_url($image); ?>" width="170">
</div>
<div class="best_price  w-full">
<p class="text-[12px] text-[#07121b66] flex flex-col self-start " ><?php echo $product->get_price_html(); ?></p>

<div class="regularprice self-start flex justify-end w-full">
      
            <p class="text-[#0bb07e] bg-[#f0faf7] rounded-[8px] p-[5px] font-[600] text-[10px]">30% OFF</p>
       
    </div>
      
</div>
    </div>
    </a>
    <?php endforeach?>

</div>
    <?php
else :
    echo '<p>No products found in this category.</p>';
endif;
wp_reset_query(); 
?>

</section>
<section class="speaker mt-[30px] pb-[60px] " >
<?php
$args = array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => 'bluetooth-speaker',
        ),
    ),
);

$shop_page_url = get_permalink( get_page_by_path( 'category-shop' ) ); 
$speaker = add_query_arg( 'category', 'bluetooth-speaker', $shop_page_url );
$products = new WP_Query($args);

if ($products->have_posts()) :
    $posts_array = $products->posts;
    ?>
<div class="springgrid container !pt-[60px] !pb-[30px]">
    <div class="viewall text-right pb-[30px] flex justify-between items-center">
        <h1 class="text-[18px] font-[600] text-white" >Latest Bluetooth Speakers</h1>
        <a href="<?php echo esc_url($speaker) ?>" ><button class="cursor-pointer whitebtn font-[600]  border border-[#c1bdbd] py-[10px] px-[20px] text-[12px] text-center rounded-[4px]" >View All</button></a>
    </div>
   

    <div class="swiper season_maingrid ">
        <div class="swiper-wrapper ">
        <?php foreach ($posts_array as $post) : 
                setup_postdata($post);
                global $product;

                $image = get_the_post_thumbnail_url($post->ID, 'medium');
                $name = get_the_title($post->ID);
              
                ?>
       <div class="swiper-slide">
    
    <div class="mainslide">
<div class="topgrid relative  bg-white flex justify-center items-center flex-col p-[20px] rounded-[5px]">
<a  href="<?php echo get_permalink($post->ID); ?>">
        <img class="object-fill !h-[120px]" src="<?php echo esc_url($image); ?>" width="120">
        </a>
        <p class="name font-[600] text-[13px] mt-[15px] mb-[10px] text-[#404040] h-[32px] self-start" ><?php echo esc_attr($name); ?></p>
        <p class="text-[12px] text-[#07121b66] flex flex-col self-start " ><?php echo $product->get_price_html(); ?></p>
        <div class="regularprice self-end flex justify-end w-full">
          
          
                <p class="text-[#0bb07e] bg-[#f0faf7] rounded-[8px] p-[5px] font-[600] text-[10px]" >30% OFF</p>
           
        </div>
        <div class="home-badges !w-fit absolute top-[1px] right-[1px]">
               <img src="<?php echo get_template_directory_uri(  );?>/assets/img/priceoye-sale-20250415-9maty.png" width="60" height="60" >
            </div>

    
</div>

</div>
       </div>
<?php endforeach?>

</div>
<div class="swiper-button-prev season_maingridav1"></div>
  <div class="swiper-button-next season_maingridnav2"></div>
    </div>
        
<?php
else :
    echo '<p>No products found in this category.</p>';
endif;
wp_reset_query(); 
?>
 


</div>

</section>
<section class="Crazydeal mt-[30px] pb-[60px] " >
<?php
$args = array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => 'crazy-deal',
        ),
    ),
);

$shop_page_url = get_permalink( get_page_by_path( 'category-shop' ) ); 
$speaker = add_query_arg( 'category', 'bluetooth-speaker', $shop_page_url );
$products = new WP_Query($args);

if ($products->have_posts()) :
    $posts_array = $products->posts;
    ?>
<div class="springgrid container !pt-[60px] !pb-[30px]">
    <div class="viewall text-right pb-[30px] flex justify-between items-center">
        <h1 class="text-[18px] font-[600] text-black" ><span class="text-[#f53d3d]" >Craziest Deals</span> of the Year</h1>
            </div>
   

    <div class="swiper crazyslider">
        <div class="swiper-wrapper ">
        <?php foreach ($posts_array as $post) : 
                setup_postdata($post);
                global $product;

                $image = get_the_post_thumbnail_url($post->ID, 'medium');
                $name = get_the_title($post->ID);
              
                ?>
       <div class="swiper-slide">
    
    <div class="mainslide">
<div class="topgrid relative  bg-white flex justify-center items-center flex-col p-[20px] rounded-[5px]">
<a  href="<?php echo get_permalink($post->ID); ?>">
        <img class="object-fill !h-[120px]" src="<?php echo esc_url($image); ?>" width="120">
        </a>
        <p class="name font-[600] text-[13px] mt-[15px] mb-[10px] text-[#404040] h-[32px] self-start" ><?php echo esc_attr($name); ?></p>
        <p class="text-[12px] text-[#07121b66] flex flex-col self-start " ><?php echo $product->get_price_html(); ?></p>
        <div class="regularprice self-end flex justify-end w-full">
          
          
                <p class="text-[#0bb07e] bg-[#f0faf7] rounded-[8px] p-[5px] font-[600] text-[10px]" >30% OFF</p>
           
        </div>
       
    
</div>

</div>
       </div>
<?php endforeach?>

</div>

    </div>
        
<?php
else :
    echo '<p>No products found in this category.</p>';
endif;
wp_reset_query(); 
?>
 


</div>

</section>
<section class="orderpackage mt-[unset] md:mt-[70px]" >
    <?php
    $orderpackage = get_field('orderpackage');


    ?>
<img class="w-full" src="<?php echo $orderpackage['url'] ?>" >

</section>
<section class="Tablets mt-[30px] pb-[60px] " >
<?php
$args = array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => 'tablets',
        ),
    ),
);

$products = new WP_Query($args);
$shop_page_url = get_permalink( get_page_by_path( 'category-shop' ) ); 
$wirelessall = add_query_arg( 'category', 'tablets', $shop_page_url );
if ($products->have_posts()) :
    $posts_array = $products->posts;
    ?>
<div class="springgrid container !pt-[60px] !pb-[30px]">
    <div class="viewall text-right pb-[30px] flex justify-between items-center">
        <h1 class="text-[18px] font-[600] text-white" >Latest Tablets</h1>
        <a  href="<?php echo esc_url($wirelessall); ?>" ><button class="cursor-pointer whitebtn font-[600]  border border-[#c1bdbd] py-[10px] px-[20px] text-[12px] text-center rounded-[4px]" >View All</button></a>
    </div>
   

    <div class="swiper season_maingrid ">
        <div class="swiper-wrapper ">
        <?php foreach ($posts_array as $post) : 
         $shop_page_url = get_permalink( get_page_by_path( 'category-shop' ) ); 
        


                setup_postdata($post);
                global $product;

                $image = get_the_post_thumbnail_url($post->ID, 'medium');
                $name = get_the_title($post->ID);
              
                ?>
       <div class="swiper-slide">
    
    <div class="mainslide">
<div class="topgrid relative  bg-white flex justify-center items-center flex-col p-[20px] rounded-[5px]">
<a  href="<?php echo get_permalink($post->ID); ?>">
        <img class="object-fill !h-[120px]" src="<?php echo esc_url($image); ?>" width="120">
        </a>
        <p class="name font-[600] text-[13px] mt-[15px] mb-[10px] text-[#404040] h-[32px] self-start" ><?php echo esc_attr($name); ?></p>
        <p class="text-[12px] text-[#07121b66] flex flex-col self-start " ><?php echo $product->get_price_html(); ?></p>
        <div class="regularprice self-end flex justify-end w-full">
          
          
                <p class="text-[#0bb07e] bg-[#f0faf7] rounded-[8px] p-[5px] font-[600] text-[10px]" >30% OFF</p>
           
        </div>
        <div class="home-badges !w-fit absolute top-[1px] right-[1px]">
               <img src="<?php echo get_template_directory_uri(  );?>/assets/img/priceoye-sale-20250415-9maty.png" width="60" height="60" >
            </div>

    
</div>

</div>
       </div>
<?php endforeach?>

</div>
<div class="swiper-button-prev season_maingridav1"></div>
  <div class="swiper-button-next season_maingridnav2"></div>
    </div>
        
<?php
else :
    echo '<p>No products found in this category.</p>';
endif;
wp_reset_query(); 
?>
 


</div>

</section>
<section>
    <div class="container">
    <h1 class="text-[18px] font-[600] text-black pb-[30px] pt-[60px] " >Reason to Buy</h1>
    <div class="reason_group">
        <div class="reason_info flex flex-col md:flex-row items-center justify-evenly px-[unset] pt-[7px] pb-[20px]   md:p-[20px] rounded-[10px] md:rounded-[20px]">
            <img class="w-[95px] md:w-[155px] " src="https://static.priceoye.pk/images/home/extended-warranty.svg">
            <div class="reason_detail flex flex-col items-center">
                <h4 class="mb-[20px] text-white  text-[14px] md:text-[18px] text-center" >Priceoye<br>Extended Warranty</h4>
                <a  href="https://priceoye.pk/extended-warranty-terms-condition" class="bg-[#f88b2a] rounded-[4px] cursor-pointer m-auto text-white px-[12px] py-[6px] text-[12px]" >Know More</a>
            </div>
        </div>
        <div class="reason_info flex flex-col md:flex-row items-center justify-evenly px-[unset] pt-[7px] pb-[20px]   md:p-[20px] rounded-[10px] md:rounded-[20px]">
            <img class="w-[95px] md:w-[155px] " src="	https://static.priceoye.pk/images/home/order-packaging.svg" >
            <div class="reason_detail flex flex-col items-center">
                <h4 class="mb-[20px] text-white  text-[14px] md:text-[18px] text-center" >Packaging
                <br>Video</h4>
                <a  href="https://priceoye.pk/order-packaging" class="bg-[#f88b2a] rounded-[4px] cursor-pointer m-auto text-white px-[12px] py-[6px] text-[12px]" >Know More</a>
            </div>
        </div>
        <div class="reason_info flex flex-col md:flex-row items-center justify-evenly px-[unset] pt-[7px] pb-[20px]   md:p-[20px] rounded-[10px] md:rounded-[20px]">
            <img class="w-[95px] md:w-[155px] " src="	https://static.priceoye.pk/images/home/feature-shipping.svg">
            <div class="reason_detail flex flex-col items-center">
                <h4 class="mb-[20px] text-white  text-[14px] md:text-[18px] text-center" >Open Parcel<br>(ISB - LHR - KHI)</h4>
                <a  href="https://priceoye.pk/parcel-policy" class="bg-[#f88b2a] rounded-[4px] cursor-pointer m-auto text-white px-[12px] py-[6px] text-[12px]" >Know More</a>
            </div>
        </div>
        <div class="reason_info flex flex-col md:flex-row items-center justify-evenly px-[unset] pt-[7px] pb-[20px]   md:p-[20px] rounded-[10px] md:rounded-[20px]">
            <img class="w-[95px] md:w-[155px] " src="https://static.priceoye.pk/images/home/easy_instalment.svg">
            <div class="reason_detail flex flex-col items-center">
                <h4 class="mb-[20px] text-white  text-[14px] md:text-[18px] text-center" >Easy<br>Installments</h4>
                <a href="https://priceoye.pk/bnpl"  class="bg-[#f88b2a] rounded-[4px] cursor-pointer m-auto text-white px-[12px] py-[6px] text-[12px]" >Know More</a>
            </div>
        </div>
    </div>
    </div>
</section>
<section class="Laptops mt-[30px] pb-[60px] " >
<?php
$args = array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => 'laptops',
        ),
    ),
);

$shop_page_url = get_permalink( get_page_by_path( 'category-shop' ) ); 
$speaker = add_query_arg( 'category', 'laptops', $shop_page_url );
$products = new WP_Query($args);

if ($products->have_posts()) :
    $posts_array = $products->posts;
    ?>
<div class="springgrid container !pt-[60px] !pb-[30px]">
    <div class="viewall text-right pb-[30px] flex justify-between items-center">
        <h1 class="text-[18px] font-[600] text-white" >Latest Laptops</h1>
        <a href="<?php echo esc_url($speaker) ?>" ><button class="cursor-pointer whitebtn font-[600]  border border-[#c1bdbd] py-[10px] px-[20px] text-[12px] text-center rounded-[4px]" >View All</button></a>
    </div>
   

    <div class="swiper season_maingrid ">
        <div class="swiper-wrapper ">
        <?php foreach ($posts_array as $post) : 
                setup_postdata($post);
                global $product;

                $image = get_the_post_thumbnail_url($post->ID, 'medium');
                $name = get_the_title($post->ID);
              
                ?>
       <div class="swiper-slide">
    
    <div class="mainslide">
<div class="topgrid relative  bg-white flex justify-center items-center flex-col p-[20px] rounded-[5px]">
<a  href="<?php echo get_permalink($post->ID); ?>">
        <img class="object-fill !h-[120px]" src="<?php echo esc_url($image); ?>" width="120">
        </a>
        <p class="name font-[600] text-[13px] mt-[15px] mb-[10px] text-[#404040] h-[32px] self-start" ><?php echo esc_attr($name); ?></p>
        <p class="text-[12px] text-[#07121b66] flex flex-col self-start " ><?php echo $product->get_price_html(); ?></p>
        <div class="regularprice self-end flex justify-end w-full">
          
          
                <p class="text-[#0bb07e] bg-[#f0faf7] rounded-[8px] p-[5px] font-[600] text-[10px]" >30% OFF</p>
           
        </div>
        <div class="home-badges !w-fit absolute top-[1px] right-[1px]">
               <img src="<?php echo get_template_directory_uri(  );?>/assets/img/priceoye-sale-20250415-9maty.png" width="60" height="60" >
            </div>

    
</div>

</div>
       </div>
<?php endforeach?>

</div>
<div class="swiper-button-prev season_maingridav1"></div>
  <div class="swiper-button-next season_maingridnav2"></div>
    </div>
        
<?php
else :
    echo '<p>No products found in this category.</p>';
endif;
wp_reset_query(); 
?>
 


</div>

</section>

<section>
<?php
$parent = get_term_by('slug', 'topcategory', 'product_cat');
$children = get_terms('product_cat', array(
    
    'parent' => $parent->term_id,
    'hide_empty' => false,
    'number' => 4
));
?>

    <div class="container">
    <h1 class="text-[18px] font-[600] text-black !pt-[60px] !pb-[30px]" >Shop More Categories</h1>
    </div>
    <div class="bg-[#f9dcff] py-[30px]">
<div class="shopmore container flex justify-center items-center gap-[15px]">
<?php foreach ($children as $child) :
    $thumbnail_id = get_term_meta($child->term_id, 'thumbnail_id', true);
    $image_url = wp_get_attachment_url($thumbnail_id);
    $shop_page_url = get_permalink( get_page_by_path( 'category-shop' ) ); 
    $term_link = add_query_arg( 'category', $child->slug, $shop_page_url );


?>
 <a href="<?php echo esc_url($term_link); ?>">
    <div class="bg-white morecategories border-[2px] border-[#8804a6] w-[120px] rounded-[11px] ">
        <img class="m-auto" src="<?php echo esc_url($image_url); ?>" height="85" width="85" >
        <div class="title bg-[#8804a6] ">
        <h1 class="text-white text-center text-[13px] pb-[16px] pt-[3px]" ><?php echo esc_html($child->name); ?></h1>
    </div>
    </div>
    </a>
   <?php endforeach?>
</div>
    </div>
</section>
<section class="power-banks mt-[30px] pb-[60px] " >
<?php
$args = array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => 'power-banks',
        ),
    ),
);

$shop_page_url = get_permalink( get_page_by_path( 'category-shop' ) ); 
$speaker = add_query_arg( 'category', 'power-banks', $shop_page_url );
$products = new WP_Query($args);

if ($products->have_posts()) :
    $posts_array = $products->posts;
    ?>
<div class="springgrid container !pt-[60px] !pb-[30px]">
    <div class="viewall text-right pb-[30px] flex justify-between items-center">
        <h1 class="text-[18px] font-[600] text-white" >Latest Power Banks</h1>
        <a href="<?php echo esc_url($speaker) ?>" ><button class="cursor-pointer whitebtn font-[600]  border border-[#c1bdbd] py-[10px] px-[20px] text-[12px] text-center rounded-[4px]" >View All</button></a>
    </div>
   

    <div class="swiper season_maingrid ">
        <div class="swiper-wrapper ">
        <?php foreach ($posts_array as $post) : 
                setup_postdata($post);
                global $product;

                $image = get_the_post_thumbnail_url($post->ID, 'medium');
                $name = get_the_title($post->ID);
              
                ?>
       <div class="swiper-slide">
    
    <div class="mainslide">
<div class="topgrid relative  bg-white flex justify-center items-center flex-col p-[20px] rounded-[5px]">
<a  href="<?php echo get_permalink($post->ID); ?>">
        <img class="object-fill !h-[120px]" src="<?php echo esc_url($image); ?>" width="120">
        </a>
        <p class="name font-[600] text-[13px] mt-[15px] mb-[10px] text-[#404040] h-[32px] self-start" ><?php echo esc_attr($name); ?></p>
        <p class="text-[12px] text-[#07121b66] flex flex-col self-start " ><?php echo $product->get_price_html(); ?></p>
        <div class="regularprice self-end flex justify-end w-full">
          
          
                <p class="text-[#0bb07e] bg-[#f0faf7] rounded-[8px] p-[5px] font-[600] text-[10px]" >30% OFF</p>
           
        </div>
        <div class="home-badges !w-fit absolute top-[1px] right-[1px]">
               <img src="<?php echo get_template_directory_uri(  );?>/assets/img/priceoye-sale-20250415-9maty.png" width="60" height="60" >
            </div>

    
</div>

</div>
       </div>
<?php endforeach?>

</div>
<div class="swiper-button-prev season_maingridav1"></div>
  <div class="swiper-button-next season_maingridnav2"></div>
    </div>
        
<?php
else :
    echo '<p>No products found in this category.</p>';
endif;
wp_reset_query(); 
?>
 


</div>

</section>
<?php get_footer()?>