<?php
/**
 * Property Single Layout
 * Simplified version: text address with direct Google Maps link & CPT Agent support.
 */

$price       = get_field( 'property_price' );
$area        = get_field( 'property_area' );
$rooms       = get_field( 'property_rooms' );
$address     = get_field( 'property_address' ); // Очікує звичайний Text від ACF
$offer_type  = get_field( 'property_offer_type' );
$has_parking = get_field( 'property_has_parking' );
$agent_post  = get_field( 'property_agent' ); // Об'єкт зв'язаного поста Агента

// ГЕНЕРАЦІЯ ОФІЦІЙНОГО БЕЗКОШТОВНОГО ПОСИЛАННЯ НА GOOGLE MAPS
$google_maps_url = '';
if ( $address ) {
    $google_maps_url = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( trim( (string) $address ) );
}

// ДАНІ АГЕНТА (Зчитуємо з іншого поста за ID)
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

$clean_phone = $agent_phone ? preg_replace( '/[^0-9+]/', '', $agent_phone ) : '';
?>

<a class="back-btn back-to-catalog" href="<?php echo esc_url( home_url( '/' ) ); ?>">← Back to Catalog</a>

<div class="property-heading-header">
    <h1 class="property-main-title"><?php the_title(); ?></h1>
    <?php if ( $offer_type ) : ?>
        <span class="pro-status-badge status-<?php echo strtolower( esc_attr( $offer_type ) ); ?>">
            For <?php echo esc_html( $offer_type ); ?>
        </span>
    <?php endif; ?>
</div>

<div class="property-hero-image">
    <?php if ( has_post_thumbnail() ) : ?>
        <?php the_post_thumbnail( 'large' ); ?>
    <?php else : ?>
        <img src="https://placehold.co/1400x900/eef2f5/7f8c8d?text=No+Image" alt="No Image">
    <?php endif; ?>
</div>

<div class="property-grid-layout">
    
    <div class="property-left-column">
        
        <section class="specs-card-box">
            <div class="spec-grid-item">
                <div class="spec-icon">💰</div>
                <div>
                    <span class="spec-title">Price</span>
                    <div class="spec-value">
                        <?php echo $price ? esc_html( $price ) . ' $' : 'Contact for price'; ?>
                        <?php echo ( $offer_type === 'Rent' ) ? ' / mo' : ''; ?>
                    </div>
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

        <?php if ( $address ) : ?>
            <section class="property-map-wrapper">
                <h2>Location</h2>
                <p class="map-address-text">🏢 <strong>Address:</strong> <?php echo esc_html( $address ); ?></p>
                
                <a class="agent-btn phone-btn" href="<?php echo esc_url( $google_maps_url ); ?>" target="_blank" rel="noopener noreferrer">
                    🗺️ Open in Google Maps
                </a>
            </section>
        <?php endif; ?>
        
    </div>

    <aside class="property-right-column">
        <div class="sidebar-agent-card">
            <div class="agent-avatar-box">
                <img src="<?php echo esc_url( $agent_avatar ); ?>" alt="<?php echo esc_attr( $agent_name ); ?>">
            </div>

            <span class="agent-status-tag">Listing Agent</span>
            <h2 class="agent-sidebar-name"><?php echo esc_html( $agent_name ); ?></h2>

            <div class="agent-sidebar-contacts">
                <?php if ( $clean_phone ) : ?>
                    <a class="agent-btn phone-btn" href="tel:<?php echo esc_attr( $clean_phone ); ?>">📞 Call Agent</a>
                    <a class="agent-btn telegram-btn" href="https://t.me/<?php echo esc_attr( str_replace('+', '', $clean_phone) ); ?>" target="_blank" style="background: #e0f2fe; color: #0369a1;">💬 Telegram</a>
                    <a class="agent-btn whatsapp-btn" href="https://wa.me/<?php echo esc_attr( $clean_phone ); ?>" target="_blank" style="background: #dcfce7; color: #15803d;">🟢 WhatsApp</a>
                <?php endif; ?>

                <?php if ( $agent_email ) : ?>
                    <a class="agent-btn email-btn" href="mailto:<?php echo esc_attr( $agent_email ); ?>">✉️ Email Agent</a>
                <?php endif; ?>
            </div>
        </div>
    </aside>
    
</div>