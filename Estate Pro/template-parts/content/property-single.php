<?php
/**
 * Property Single Content Layout
 * Pushing all ACF variables into clean PHP logic.
 */

// 1. Зчитуємо прості текстові та числові поля
$price      = get_field('property_price');
$area       = get_field('property_area');
$rooms      = get_field('property_rooms');
$address    = get_field('property_address');
$offer_type = get_field('property_offer_type'); // Поверне 'Rent' або 'Sale'

// 2. Зчитуємо прапорець (True / False)
$has_parking = get_field('property_has_parking'); // Поверне true або false

?>

<!-- ВЕРСТКА ХАРАКТЕРИСТИК -->
<div class="property-features-box">
    
    <div class="feature-item">
        <span>💰 Price:</span>
        <strong><?php echo $price ? esc_html($price) . ' $' : 'Contact for price'; ?></strong>
    </div>

    <div class="feature-item">
        <span>📐 Area:</span>
        <strong><?php echo $area ? esc_html($area) . ' m²' : 'N/A'; ?></strong>
    </div>

    <div class="feature-item">
        <span>🚪 Rooms:</span>
        <strong><?php echo $rooms ? esc_html($rooms) : 'N/A'; ?></strong>
    </div>

    <!-- Обробка вибору Оренда/Продаж -->
    <div class="feature-item">
        <span>Label:</span>
        <span class="badge badge-<?php echo esc_attr(strtolower($offer_type)); ?>">
            <?php echo esc_html($offer_type); ?>
        </span>
    </div>

    <!-- Обробка логічного поля (True/False) -->
    <div class="feature-item">
        <span>🚗 Parking:</span>
        <strong><?php echo $has_parking ? '✅ Available' : '❌ None'; ?></strong>
    </div>

</div>