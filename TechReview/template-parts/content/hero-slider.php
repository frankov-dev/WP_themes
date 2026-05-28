<?php
/**
 * Скелет слайдера з картинкою та описом статті
 */

$slider_args = array(
    'post_type'      => 'post',      
    'posts_per_page' => 3,           
);

$slider_query = new WP_Query($slider_args);
?>

<?php if ( $slider_query->have_posts() ) : ?>
    <div class="hero-slider-wrapper">
        <div class="hero-slider">
            
            <?php 
            $slide_index = 0;
            while ( $slider_query->have_posts() ) : $slider_query->the_post(); 
                $active_class = ($slide_index === 0) ? ' active' : '';
            ?>
                <div class="slide<?php echo $active_class; ?>">
                    
                    <div class="slide-image">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail('large'); ?>
                        <?php else : ?>
                            <img src="https://picsum.photos/1200/500?random=<?php echo get_the_ID(); ?>" alt="<?php the_title_attribute(); ?>">
                        <?php endif; ?>
                    </div>

                    <div class="slide-content">
                        <span class="slide-badge">🔥 Гарячий огляд</span>
                        
                        <h2 class="slide-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>

                        <div class="slide-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>

                </div>
            <?php 
                $slide_index++;
            endwhile; 
            wp_reset_postdata(); 
            ?>

        </div>
    </div>
<?php endif; ?>