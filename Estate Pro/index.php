<?php get_header(); ?>

<main class="main-catalog">
    <h1 class="catalog-title">Наші пропозиції</h1>

    <div class="properties-grid">
        <?php
        $args = array(
            'post_type'      => 'property',
            'posts_per_page' => 9
        );
        $query = new WP_Query($args);

        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post(); ?>
                <?php get_template_part( 'template-parts/content/property-card' ); ?>

            <?php 
            endwhile;
            wp_reset_postdata(); 
        else : 
            echo '<p class="no-posts">Оговорених об\'єктів не знайдено.</p>';
        endif;
        ?>

    </div>
</main>

<?php get_footer(); ?>