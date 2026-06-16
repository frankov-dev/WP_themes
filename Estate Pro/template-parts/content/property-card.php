<?php
/**
 * Template part for displaying a single property card in the catalog grid.
 * Fully refactored with clean English ACF variables.
 */

// 1. Пул наших нових англомовних змінних
$price       = get_field('property_price');
$area        = get_field('property_area');
$rooms       = get_field('property_rooms');
$offer_type  = get_field('property_offer_type'); // Returns 'Rent' or 'Sale'
$has_parking = get_field('property_has_parking'); // Returns true or false
$address     = get_field('property_address');
?>

<article class="property-card">
    
    <!-- 1. Зображення об'єкта та бейдж типу угоди -->
    <div class="property-card-image">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail('medium_large'); ?>
        <?php else : ?>
            <!-- Заглушка, якщо фотку забули завантажити -->
            <img src="https://placehold.co/600x400/eef2f5/7f8c8d?text=No+Image" alt="No Image Available">
        <?php endif; ?>

        <?php if ( $offer_type ) : ?>
            <span class="property-badge badge-<?php echo strtolower(esc_attr($offer_type)); ?>">
                <?php echo esc_html($offer_type); ?>
            </span>
        <?php endif; ?>
    </div>

    <!-- 2. Контентна частина картки -->
    <div class="property-card-content">
        
        <!-- Головний комерційний заголовок об'єкта -->
        <h3 class="property-card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <!-- Рядок з точкою геолокації (локація для Google карти) -->
        <?php if ( $address ) : ?>
            <div class="property-card-location">
                📍 <span><?php echo esc_html($address); ?></span>
            </div>
        <?php endif; ?>

        <!-- Список технічних характеристик -->
        <div class="property-card-specs">
            
            <div class="spec-row">
                <span class="spec-label">Price:</span>
                <span class="spec-value price-value">
                    <?php echo $price ? esc_html($price) . ' $' : 'Contact us'; ?>
                    <?php echo ($offer_type === 'Rent') ? '<small>/ mo</small>' : ''; ?>
                </span>
            </div>

            <div class="spec-row">
                <span class="spec-label">Area:</span>
                <span class="spec-value"><?php echo $area ? esc_html($area) . ' m²' : 'N/A'; ?></span>
            </div>

            <div class="spec-row">
                <span class="spec-label">Rooms:</span>
                <span class="spec-value"><?php echo $rooms ? esc_html($rooms) : 'N/A'; ?></span>
            </div>

            <div class="spec-row">
                <span class="spec-label">Parking:</span>
                <span class="spec-value"><?php echo $has_parking ? '✅ Available' : '❌ None'; ?></span>
            </div>

        </div>

        <!-- 3. Кнопка переходу на детальну сторінку -->
        <div class="property-card-footer">
            <a href="<?php the_permalink(); ?>" class="btn-details">
                View Details
            </a>
        </div>

    </div>

</article>