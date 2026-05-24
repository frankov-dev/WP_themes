<?php get_header(); ?>

<main class="single-property-container">
    
    <?php while ( have_posts() ) : the_post(); ?>
        
        <a href="<?php echo home_url('/'); ?>" class="back-to-catalog">← Назад до каталогу</a>
        
        <h1 class="single-property-title"><?php the_title(); ?></h1>
        
        <div class="single-property-image">
            <?php 
            if ( has_post_thumbnail() ) {
                the_post_thumbnail('large'); 
            } else {
                ?>
                <img src="https://picsum.photos/1200/600?random=<?php echo get_the_ID(); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
                <?php
            }
            ?>
        </div>

        <div class="property-details-block">
            <div class="details-specs">
                <p class="spec-item address-item">📍 <?php the_field('property_address'); ?></p>
                
                <?php 
                $offer_type = get_field('property_offer_type'); 
                ?>
                <p class="spec-item price-item">
                     Vogt 💰 <?php the_field('property_price'); ?> $
                    <?php if( $offer_type === 'Rent' ) : ?>
                        <span class="price-period">/ міс.</span>
                    <?php endif; ?>
                </p>
                
                <p class="spec-item">📐 Площа: <?php the_field('property_area'); ?> м²</p>
                <p class="spec-item">🛏️ Кімнат: <?php the_field('property_rooms'); ?></p>
                <p class="spec-item">
                    🚗 Паркінг: 
                    <?php if ( get_field('property_has_parking') ) : ?>
                        <span class="parking-yes">✅ Є у наявності</span>
                    <?php else : ?>
                        <span class="parking-no">❌ Немає</span>
                    <?php endif; ?>
                </p>
            </div>
        </div> 

        <div class="full-description">
            <?php the_content(); ?>
        </div>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>