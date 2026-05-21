<?php get_header(); ?>

<main class="container" style="padding: 20px; max-width: 1200px; margin: 0 auto;">
    
    <h1 style="margin-bottom: 30px;">Каталог нерухомості (Всі оголошення)</h1>

    <div class="properties-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
        
        <?php
        // Кажемо WordPress: "Дістань з бази саме нерухомість"
        $args = array(
            'post_type' => 'property',
            'posts_per_page' => 9
        );
        $query = new WP_Query($args);

        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post(); ?>
                
                <article style="border: 1px solid #ddd; padding: 15px; border-radius: 8px; background: #fff;">
                    
                    <div class="img-wrapper" style="margin-bottom: 15px;">
                        <?php the_post_thumbnail('medium', array('style' => 'width:100%; height:200px; object-fit:cover;')); ?>
                    </div>

                    <h3 style="margin: 10px 0;"><?php the_title(); ?></h3>
                    
                    <a href="<?php the_permalink(); ?>" style="display: inline-block; background: #2c3e50; color: #fff; padding: 10px 15px; text-decoration: none; border-radius: 4px; margin-top: 10px;">
                        Переглянути деталі
                    </a>

                </article>

            <?php 
            endwhile;
            wp_reset_postdata(); //
        else : 
            echo '<p>Оголошень поки немає.</p>';
        endif;
        ?>

    </div>

</main>

<?php get_footer(); ?>