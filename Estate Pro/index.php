<?php get_header(); // Підключаємо header.php ?>

<main class="main-catalog">
    <h1 class="catalog-title">Наші пропозиції</h1>

    <div class="properties-grid">
        
        <?php
        // Наш кастомний запит до бази даних
        $args = array(
            'post_type'      => 'property',
            'posts_per_page' => 6
        );
        $query = new WP_Query($args);

        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post(); ?>
                
                <article class="property-card">
                    
                    <div class="property-image">
                        <?php the_post_thumbnail('medium'); ?>
                    </div>

                    <div class="property-info">
                        <h3 class="property-title"><?php the_title(); ?></h3>
                        
                        <a href="<?php the_permalink(); ?>" class="property-link">
                            Переглянути деталі
                        </a>
                    </div>

                </article>

            <?php 
            endwhile;
            wp_reset_postdata(); // Очищаємо за собою глобальні змінні
        else : 
            echo '<p class="no-posts">Оголошень поки немає.</p>';
        endif;
        ?>

    </div>
</main>

<?php get_footer(); // Підключаємо footer.php ?>