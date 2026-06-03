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

// Якщо слайдів нема — підвантажимо для налагодження звичайні пости як fallback
if ( ! $slides->have_posts() ) {
    $slides = new WP_Query( array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'orderby'        => 'date',
        'order'          => 'DESC'
    ) );
    $using_fallback = true;
} else {
    $using_fallback = false;
}
?>

<?php if ( $slides->have_posts() ) : ?>
    <?php if ( isset( $using_fallback ) && $using_fallback ) : ?>
        <!-- Debug: No hero_slide CPT entries found — showing recent posts as fallback -->
    <?php endif; ?>
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
                            <?php 
                            $desc = get_field('slide_description');
                            if ( ! empty( $desc ) ) {
                                echo wp_kses_post( $desc );
                            } else {
                                // fallback: use post excerpt if ACF field missing
                                the_excerpt();
                            }
                            ?>
                        </div>

                        <?php 
                        $link = get_field('slide_link'); 
                        if( $link && ! empty( $link['url'] ) ): ?>
                            <a href="<?php echo esc_url($link['url']); ?>" class="slide-btn">Читати далі</a>
                        <?php else: ?>
                            <a href="<?php the_permalink(); ?>" class="slide-btn">Читати далі</a>
                        <?php endif; ?>
                    </div>

                </div>
            <?php $i++; endwhile; wp_reset_postdata(); ?>
        </div>

        <div class="slider-controls" aria-label="Hero slider controls">
            <button type="button" class="slider-arrow slider-arrow-prev" aria-label="Попередній слайд">&#8249;</button>
            <button type="button" class="slider-arrow slider-arrow-next" aria-label="Наступний слайд">&#8250;</button>
        </div>

        <div class="slider-timer" aria-live="polite" aria-atomic="true" hidden></div>
    </div>
<?php endif; ?>