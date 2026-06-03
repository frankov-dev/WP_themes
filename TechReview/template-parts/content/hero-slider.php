<?php
/**
 * Оновлений слайдер: бере дані з CPT "hero_slide"
 */

// Запитуємо саме наш новий тип поста
$slides = new WP_Query( array( 
    'post_type'      => 'hero_slide', 
    'posts_per_page' => 5,
    'orderby'        => 'date',
    'order'          => 'DESC'
));
?>

<?php if ( $slides->have_posts() ) : ?>
    <div class="hero-slider-wrapper">
        <div class="hero-slider">
            <?php 
            $i = 0;
            while ( $slides->have_posts() ) : $slides->the_post(); 
                $active_class = ($i === 0) ? ' active' : '';
            ?>
                <div class="slide <?php echo $active_class; ?>">
                    
                    <div class="slide-image">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail('large'); ?>
                        <?php else : ?>
                            <img src="https://picsum.photos/1200/500?random=<?php echo get_the_ID(); ?>" alt="Slide">
                        <?php endif; ?>
                    </div>

                    <div class="slide-content">
                        <h2 class="slide-title"><?php the_title(); ?></h2>
                        
                        <div class="slide-excerpt">
                            <?php the_field('slide_description'); ?>
                        </div>

                        <?php 
                        $link = get_field('slide_link'); 
                        if( $link ): ?>
                            <a href="<?php echo esc_url($link['url']); ?>" class="slide-btn">Читати далі</a>
                        <?php endif; ?>
                    </div>

                </div>
            <?php $i++; endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
<?php endif; ?>