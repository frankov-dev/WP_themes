<?php get_header(); ?>

<main class="single-property-wrapper">
    <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'template-parts/content/property-single' ); ?>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>