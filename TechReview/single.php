<?php get_header(); ?>

<main class="container" style="background: #fff; padding: 40px; margin-top: 30px; border-radius: 8px;">
    <?php while ( have_posts() ) : have_posts() ? the_post() : null; ?>
        
        <h1 style="font-size: 32px; color: #111; margin-bottom: 20px;"><?php the_title(); ?></h1>
        
        <div class="full-post-image" style="margin-bottom: 30px;">
            <?php if ( has_post_thumbnail() ) { the_post_thumbnail('large', array('style' => 'width:100%; height:auto; border-radius:8px;')); } ?>
        </div>

        <div class="full-post-text" style="font-size: 18px; line-height: 1.7; color: #333;">
            <?php the_content(); ?>
        </div>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>