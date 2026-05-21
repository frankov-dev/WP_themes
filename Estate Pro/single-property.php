<?php get_header(); ?>

<main class="container" style="padding: 40px; max-width: 800px; margin: 0 auto;">
    
    <?php
    // Тут цикл супер-простий, бо WordPress вже сам знає, на яку квартиру клікнули
    while ( have_posts() ) : the_post(); ?>
        
        <a href="<?php echo home_url(); ?>" style="color: #2c3e50; text-decoration: none;">← Назад до каталогу</a>
        
        <h1 style="font-size: 36px; margin: 20px 0;"><?php the_title(); ?></h1>
        
        <div class="main-image" style="margin-bottom: 30px;">
            <?php the_post_thumbnail('large', array('style' => 'width:100%; border-radius:12px;')); ?>
        </div>

        <div class="full-description" style="font-size: 18px; line-height: 1.6; color: #333;">
            <?php the_content(); ?>
        </div>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>