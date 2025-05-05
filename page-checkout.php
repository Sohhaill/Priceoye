<?php


get_header();
?>

<div class="container py-[30px]">
    <h1 class="text-[24px] font-bold mb-[20px]">Checkout</h1>
    <?php echo do_shortcode('[woocommerce_checkout]'); ?>
</div>

<?php get_footer(); ?>
