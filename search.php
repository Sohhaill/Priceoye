<?php get_header(); ?>
<div class="search_page">
<div class="search container !py-[70px]">
  <h1 class="text-[16px] font-semibold mb-6 capitalize">
    Search Results for: "<?php echo get_search_query(); ?>"
  </h1>

  <?php if (have_posts()) : ?>
    <div class="searchpage grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-[9px]">
      <?php while (have_posts()) : the_post(); ?>
        <?php if ('product' === get_post_type()) : ?>
          <?php wc_get_template_part('content', 'product'); ?>
        <?php endif; ?>
      <?php endwhile; ?>
    </div>

    <div class="mt-8">
      <?php the_posts_pagination(); ?>
    </div>

  <?php else : ?>
    <p>No products found matching your search.</p>
  <?php endif; ?>
</div>
</div>
<?php get_footer(); ?>
