<?php 
// Підключаємо шапку
get_header(); 
?>

<main class="main-content">
    
    <?php if ( is_category() ) : ?>
        <h2 class="section-title">Розділ: <?php single_cat_title(); ?></h2>
    <?php else : ?>
        <h2 class="section-title">Останні огляди та новини</h2>
    <?php endif; ?>

    <div class="tech-posts-grid">
        
        <?php 
        if ( have_posts() ) : 
            while ( have_posts() ) : the_post(); ?>
                <?php 
                // Підтягуємо наш створений файл картки
                get_template_part( 'template-parts/content/card' ); 
                ?> 
                

            <?php 
            endwhile; 
        else : 
            echo '<p>Новин поки що немає.</p>';
        endif; 
        ?>

    </div>
</main>

<?php 
// Підключаємо футер
get_footer(); 
?>