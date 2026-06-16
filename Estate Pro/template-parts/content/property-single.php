<?php
/**
 * Property Single Content Layout
 * Full single-property layout refactored for CPT Agents, .env Google Maps, and Pro functionality.
 */

    $price       = get_field( 'property_price' );
    $area        = get_field( 'property_area' );
    $rooms       = get_field( 'property_rooms' );
    $address     = get_field( 'property_address' );
    $offer_type  = get_field( 'property_offer_type' );
    $has_parking = get_field( 'property_has_parking' );
    $agent_post  = get_field( 'property_agent' ); // Отримуємо об'єкт зв'язаного поста агента

    // Твій крутий універсальний хелпер безпечного вибору значень
    $pick_value = static function ( $source, array $keys, $default = '' ) {
        if ( ! is_array( $source ) ) {
            return $default;
        }

        foreach ( $keys as $key ) {
            if ( array_key_exists( $key, $source ) && '' !== $source[ $key ] && null !== $source[ $key ] ) {
                return $source[ $key ];
            }
        }

        return $default;
    };

    // --- 🗺️ ЛОГІКА ГЕОЛОКАЦІЇ ТА КАРТИ ---
    $address_text   = '';
    $distance_badge = '';
    $map_src        = '';

    if ( is_array( $address ) ) {
        $address_text = (string) $pick_value( $address, array( 'address', 'formatted_address', 'label' ), '' );
        $lat          = $pick_value( $address, array( 'lat', 'latitude' ), '' );
        $lng          = $pick_value( $address, array( 'lng', 'lon', 'longitude' ), '' );

        // 🧮 Твоя нова штучка: Рахуємо відстань до центру міста (Площа Ринок, Львів)
        if ( '' !== $lat && '' !== $lng ) {
            $center_lat = 49.842951; 
            $center_lng = 24.031111;
            $earth_radius = 6371; // Радіус Землі в км

            $dLat = deg2rad( (float)$lat - $center_lat );
            $dLng = deg2rad( (float)$lng - $center_lng );

            $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($center_lat)) * cos(deg2rad((float)$lat)) * sin($dLng/2) * sin($dLng/2);
            $c = 2 * atan2(sqrt($a), sqrt(1-$a));
            $km = round( $earth_radius * $c, 1 );
            $distance_badge = '<span class="geo-distance-badge">📍 ' . $km . ' km from center</span>';
        }
    } else {
        $address_text = trim( (string) $address );
    }

    // Використовуємо офіційний Embed API з твоєю константою з .env
    if ( $address_text && defined('GOOGLE_MAPS_API_KEY') && GOOGLE_MAPS_API_KEY ) {
        $map_src = 'https://www.google.com/maps/embed/v1/place?key=' . esc_attr( GOOGLE_MAPS_API_KEY ) . '&q=' . urlencode( $address_text ) . '&zoom=15';
    }

    // --- 👥 ЛОГІКА АГЕНТА (ЗЧИТУЄМО З ІНШОГО ПОСТА ЗА ID) ---
    $agent_name   = get_the_author_meta( 'display_name' );
    $agent_phone  = '';
    $agent_email  = '';
    $agent_avatar = '';

    if ( $agent_post && is_object( $agent_post ) ) {
        $agent_id     = $agent_post->ID;
        $agent_name   = get_the_title( $agent_id ); // Ім'я беремо з заголовка поста агента
        $agent_phone  = get_field( 'agent_phone', $agent_id ); // Поля тягнемо з ID поста агента
        $agent_email  = get_field( 'agent_email', $agent_id );
        $agent_avatar = get_the_post_thumbnail_url( $agent_id, 'medium' ); // Аватарка — це Featured Image агента
    }

    if ( ! $agent_avatar ) {
        $agent_avatar = get_avatar_url( get_the_author_meta( 'ID' ), array( 'size' => 220 ) );
    }

    // Форматування ціни
    $price_display = $price ? esc_html( $price ) . ' $' : 'Contact for price';
    if ( $offer_type === 'Rent' ) {
        $price_display .= ' / mo';
    }

    $clean_phone = $agent_phone ? preg_replace( '/[^0-9+]/', '', $agent_phone ) : '';
    $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
?>

<a class="back-btn back-to-catalog" href="<?php echo esc_url( home_url( '/' ) ); ?>">&larr; Back to Catalog</a>

<div class="property-heading-header" style="margin: 20px 0 25px 0;">
    <h1 class="property-main-title" style="margin: 0; display: inline-block; vertical-align: middle;"><?php the_title(); ?></h1>
    <?php if ( $offer_type ) : ?>
        <span class="pro-status-badge status-<?php echo strtolower(esc_attr($offer_type)); ?>" style="margin-left: 15px; padding: 6px 14px; border-radius: 30px; font-size: 13px; font-weight: 800; text-transform: uppercase; background: <?php echo $offer_type === 'Rent' ? '#dbeafe' : '#fee2e2'; ?>; color: <?php echo $offer_type === 'Rent' ? '#3b82f6' : '#ef4444'; ?>;">
            For <?php echo esc_html($offer_type); ?>
        </span>
    <?php endif; ?>
</div>

<div class="property-hero-image">
    <?php if ( $thumbnail_url ) : ?>
        <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
    <?php else : ?>
        <img src="https://placehold.co/1400x900/eef2f5/7f8c8d?text=No+Image" alt="No Image Available">
    <?php endif; ?>
</div>

<div class="property-grid-layout">
    <div class="property-left-column">
        <section class="specs-card-box" aria-label="Property specifications">
            <div class="spec-grid-item">
                <div class="spec-icon">💰</div>
                <div>
                    <span class="spec-title">Price</span>
                    <div class="spec-value"><?php echo wp_kses_post( $price_display ); ?></div>
                </div>
            </div>

            <div class="spec-grid-item">
                <div class="spec-icon">📐</div>
                <div>
                    <span class="spec-title">Area</span>
                    <div class="spec-value"><?php echo $area ? esc_html( $area ) . ' m²' : 'N/A'; ?></div>
                </div>
            </div>

            <div class="spec-grid-item">
                <div class="spec-icon">🛏️</div>
                <div>
                    <span class="spec-title">Rooms</span>
                    <div class="spec-value"><?php echo $rooms ? esc_html( $rooms ) : 'N/A'; ?></div>
                </div>
            </div>

            <div class="spec-grid-item">
                <div class="spec-icon">🚗</div>
                <div>
                    <span class="spec-title">Parking</span>
                    <div class="spec-value"><?php echo $has_parking ? 'Available' : 'None'; ?></div>
                </div>
            </div>
        </section>

        <section class="property-details-block">
            <h2>Description</h2>
            <div class="full-description">
                <?php the_content(); ?>
            </div>
        </section>

        <section class="property-map-wrapper">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; flex-wrap: wrap; gap: 10px;">
                <h2 style="margin: 0;">Location & Infrastructure</h2>
                <?php echo $distance_badge; // Наш красивий бейдж з кілометрами ?>
            </div>

            <?php if ( $address_text ) : ?>
                <p class="map-address-text" style="color: #5f6368; margin-bottom: 15px;">🏢 <strong>Full Address:</strong> <?php echo esc_html( $address_text ); ?></p>
            <?php endif; ?>

            <?php if ( $map_src ) : ?>
                <div class="google-iframe-container" style="width: 100%; height: 380px; border-radius: 14px; overflow: hidden;">
                    <iframe
                        title="Property location map"
                        src="<?php echo esc_url( $map_src ); ?>"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen
                    ></iframe>
                </div>
            <?php endif; ?>
        </section>
    </div>

    <aside class="property-right-column">
        <div class="sidebar-agent-card">
            <div class="agent-avatar-box">
                <img src="<?php echo esc_url( $agent_avatar ); ?>" alt="<?php echo esc_attr( $agent_name ); ?>">
            </div>

            <span class="agent-status-tag">Listing Agent</span>
            <h2 class="agent-sidebar-name"><?php echo esc_html( $agent_name ); ?></h2>

            <div class="agent-sidebar-contacts" style="display: flex; flex-direction: column; gap: 10px;">
                <?php if ( $agent_phone ) : ?>
                    <a class="agent-btn phone-btn" href="tel:<?php echo esc_attr( $clean_phone ); ?>">📞 Call Agent</a>
                    
                    <!-- ⚡ Функціональні кнопки миттєвого зв'язку в один клік -->
                    <a class="agent-btn telegram-btn" href="https://t.me/<?php echo esc_attr( str_replace('+', '', $clean_phone) ); ?>" target="_blank" style="background: #e0f2fe; color: #0369a1;">💬 Chat via Telegram</a>
                    <a class="agent-btn whatsapp-btn" href="https://wa.me/<?php echo esc_attr( $clean_phone ); ?>" target="_blank" style="background: #dcfce7; color: #15803d;">🟢 Chat via WhatsApp</a>
                <?php endif; ?>

                <?php if ( $agent_email ) : ?>
                    <a class="agent-btn email-btn" href="mailto:<?php echo esc_attr( $agent_email ); ?>">✉️ Email Agent</a>
                <?php endif; ?>
            </div>
        </div>
    </aside>
</div>