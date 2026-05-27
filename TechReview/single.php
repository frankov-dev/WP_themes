<?php 
/**
 * Шаблон для відображення повної статті
 */
get_header(); 
?>

<main class="single-post-container">
    <?php 
    // Чистий стандартний цикл WordPress без зайвих знаків
    while ( have_posts() ) : the_post(); 
    ?>
        
        <h1 class="single-post-title"><?php the_title(); ?></h1>
        
        <div class="full-post-image">
            <?php if ( has_post_thumbnail() ) { the_post_thumbnail('large'); } ?>
        </div>

        <div class="full-post-text">
            <?php the_content(); ?>
        </div>

    <?php endwhile; ?>
</main>

<?php 
get_footer(); 
?>