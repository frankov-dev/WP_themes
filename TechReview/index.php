<?php 
// Підключаємо шапку
get_header(); 
?>

<main class="main-content">
    <div class="home-layout-container">

        <?php 
        // Покажемо слайдер як для блогу, так і для статичної головної сторінки
        if ( is_home() || is_front_page() ) {
            get_template_part( 'template-parts/content/hero-slider' ); 
        }
        ?>

        <div class="main-reviews-column">
            <?php if ( is_category() ) : ?>
                <h2 class="section-title">Розділ: <?php single_cat_title(); ?></h2>
            <?php else : ?>
                <h2 class="section-title">Останні огляди та новини</h2>
            <?php endif; ?>

            <div class="tech-posts-grid">
                <?php 
                if ( have_posts() ) : 
                    while ( have_posts() ) : the_post(); 
                        get_template_part( 'template-parts/content/card' ); 
                    endwhile; 
                else : 
                    echo '<p>Новин поки що немає.</p>';
                endif; 
                ?>
            </div>
        </div>
      
        <?php if ( is_home() || is_front_page() ) : ?>
            <aside class="quick-news-sidebar">
                <h3 class="sidebar-title">⚡ Блискавка новин</h3>
                <div class="quick-news-feed">
                    <?php
                    // Кастомний запит до бази: дай нам 5 постів із типом 'quick_news'
                    $quick_args = array(
                        'post_type'      => 'quick_news',
                        'posts_per_page' => 5
                    );
                    $quick_query = new WP_Query( $quick_args );

                    if ( $quick_query->have_posts() ) :
                        while ( $quick_query->have_posts() ) : $quick_query->the_post();
                            
                            // Підтягуємо наш новий створений шаблон
                            get_template_part( 'template-parts/content/quick-card' );

                        endwhile;
                        // Обов'язково скидаємо глобальні дані поста, щоб не зламати основний цикл WP!
                        wp_reset_postdata();
                    else :
                        echo '<p class="no-quick-news">Коротких новин за сьогодні немає.</p>';
                    endif;
                    ?>
                </div>
            </aside>
        <?php endif; ?>
        

    </div>
</main>

<?php 
// Підключаємо футер
get_footer(); 
?>