<?php
/**
 * Property Single Content Layout
 * Simplified version: pure text address with a direct premium link to Google Maps (No API keys needed!).
 */

    $price       = get_field( 'property_price' );
    $area        = get_field( 'property_area' );
    $rooms       = get_field( 'property_rooms' );
    $address     = get_field( 'property_address' );
    $offer_type  = get_field( 'property_offer_type' );
    $has_parking = get_field( 'property_has_parking' );
    $agent_post  = get_field( 'property_agent' ); // Об'єкт зв'язаного поста Агента

    // Твій універсальний хелпер безпечного вибору значень
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

    // --- 🗺️ ЛОГІКА ТЕКСТОВОЇ АДРЕСИ ТА ПОСИЛАННЯ НА КАРТУ ---
    $address_text    = '';
    $google_maps_url = '';

    if ( is_array( $address ) ) {
        $address_text = (string) $pick_value( $address, array( 'address', 'formatted_address', 'label' ), '' );
    } else {
        $address_text = trim( (string) $address );
    }

    // Створюємо офіційне універсальне посилання для пошуку в Google Maps
    if ( $address_text ) {
        $google_maps_url = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $address_text );
    }

    // --- 👥 ЛОГІКА АГЕНТА (CPT Post Object) ---
    $agent_name   = get_the_author_meta( 'display_name' );
    $agent_phone  = '';
    $agent_email  = '';
    $agent_avatar = '';

    if ( $agent_post && is_object( $agent_post ) ) {
        $agent_id     = $agent_post->ID;
        $agent_name   = get_the_title( $agent_id ); 
        $agent_phone  = get_field( 'agent_phone', $agent_id ); 
        $agent_email  = get_field( 'agent_email', $agent_id );
        $agent_avatar = get_the_post_thumbnail_url( $agent_id, 'medium' ); 
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

<a class="back-btn back-to-catalog" href="<?php echo esc_url( home_url( '/' ) ); ?>">← Back to Catalog</a>

<div class="property-heading-header" style="margin: 20px 0 25px 0; display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
    <h1 class="property-main-title" style="margin: 0; font-weight: 800; font-size: clamp(28px, 4vw, 38px);"><?php the_title(); ?></h1>
    <?php if ( $offer_type ) : ?>
        <span class="pro-status-badge status-<?php echo strtolower(esc_attr($offer_type)); ?>" style="padding: 6px 14px; border-radius: 30px; font-size: 13px; font-weight: 800; text-transform: uppercase; background: <?php echo $offer_type === 'Rent' ? '#dbeafe' : '#fee2e2'; ?>; color: <?php echo $offer_type === 'Rent' ? '#3b82f6' : '#ef4444'; ?>;">
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

        <section class="property-map-wrapper" style="background: #ffffff; padding: 25px; border-radius: 18px; box-shadow: 0 4px 20px rgba(139, 94, 60, 0.02); border: 1px solid rgba(139, 94, 60, 0.05); margin-top: 35px;">
            <h2>Location</h2>

            <?php if ( $address_text ) : ?>
                <p class="map-address-text" style="color: #5f6368; margin-bottom: 20px; font-size: 16px;">🏢 <strong>Address:</strong> <?php echo esc_html( $address_text ); ?></p>
                
                <a class="agent-btn phone-btn" href="<?php echo esc_url( $google_maps_url ); ?>" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; justify-content: center; padding: 14px 24px; border-radius: 12px; text-decoration: none; font-weight: 700; font-size: 14px; background: var(--estate-accent); color: #ffffff; transition: background 0.2s ease;">
                    🗺️ Open in Google Maps
                </a>
            <?php else : ?>
                <p style="color: var(--estate-muted); font-style: italic;">Address not specified.</p>
            <?php endif; ?>
        </section>
    </div>

    <aside class="property-right-column">
        <div class="sidebar-agent-card">
            <div class="agent-avatar-box">
                <img src="<?php echo esc_url( $agent_avatar ); ?>" alt="<?php echo esc_attr( $agent_name ); ?>">
            </div>

            <span class="agent-status-tag">Listing Agent</span>
            <h2 class="agent-sidebar-name" style="font-size: 20px; color: #202124; margin: 5px 0 20px 0; font-weight: 700;"><?php echo esc_html( $agent_name ); ?></h2>

            <div class="agent-sidebar-contacts" style="display: flex; flex-direction: column; gap: 10px;">
                <?php if ( $clean_phone ) : ?>
                    <a class="agent-btn phone-btn" href="tel:<?php echo esc_attr( $clean_phone ); ?>">📞 Call Agent</a>
                    
                    <a class="agent-btn telegram-btn" href="https://t.me/<?php echo esc_attr( str_replace('+', '', $clean_phone) ); ?>" target="_blank" style="background: #e0f2fe; color: #0369a1; display: block; padding: 12px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; text-align: center;">💬 Chat via Telegram</a>
                    <a class="agent-btn whatsapp-btn" href="https://wa.me/<?php echo esc_attr( $clean_phone ); ?>" target="_blank" style="background: #dcfce7; color: #15803d; display: block; padding: 12px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; text-align: center;">🟢 Chat via WhatsApp</a>
                <?php endif; ?>

                <?php if ( $agent_email ) : ?>
                    <a class="agent-btn email-btn" href="mailto:<?php echo esc_attr( $agent_email ); ?>">✉️ Email Agent</a>
                <?php endif; ?>
            </div>
        </div>
    </aside>
</div>