<?php 
/**
 * Шаблон для відображення звичайних статичних сторінок (Pages)
 */
get_header(); 
?>

<main class="standard-page-container">
    <?php 
    // Запускаємо стандартний цикл для виведення контенту сторінки
    while ( have_posts() ) : the_post(); 
    ?>
        
        <h1 class="page-title"><?php the_title(); ?></h1>
        
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="page-featured-image">
                <?php the_post_thumbnail('large'); ?>
            </div>
        <?php endif; ?>

        <div class="page-content">
            <?php the_content(); ?>
        </div>

    <?php endwhile; ?>
</main>

<?php 
get_footer(); 
?>