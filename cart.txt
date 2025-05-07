<?php
get_header();
?>

<div class="container py-[30px]">
    <h1 class="text-[40px] font-bold mb-[20px]">Your Cart</h1>
    <?php echo do_shortcode('[woocommerce_cart]'); ?>
</div>

<?php get_footer(); ?>
