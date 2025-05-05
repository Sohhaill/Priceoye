<?php
/* Template Name: Category Shop Page */
get_header();

$category_slug = sanitize_text_field($_GET['category'] ?? '');

$args = [
    'post_type' => 'product',
    'posts_per_page' => -1,
];

if (!empty($category_slug)) {
    $args['tax_query'] = [
        [
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => $category_slug,
        ]
    ];
}

$query = new WP_Query($args);
?>

<div class="container py-10">
    <?php if (empty($query->have_posts())) : ?>
        <h2 class="text-2xl font-bold mb-5 uppercase">There is no products in <?php echo $category_slug?></h2>
    <?php endif; ?>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 py-10">
        <?php while ($query->have_posts()) : $query->the_post(); global $product; ?>
            <div class="border border-[2.20px] border-[#d7d9db] p-4 rounded-[20px] bg-white">
                <a class="flex flex-col items-center gap-[7px]" href="<?php the_permalink(); ?>">
                    <?php echo $product->get_image(); ?>
                    <h3 class="text-lg font-semibold"><?php the_title(); ?></h3>
                    <p><?php echo $product->get_price_html(); ?></p>
                </a>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
</div>

<?php get_footer(); ?>
