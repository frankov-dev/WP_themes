<?php
/**
 * Property Single Layout
 * Simplified version: text address with direct Google Maps link & CPT Agent support.
 */

$price                = get_field( 'property_price' );
$area                = get_field( 'property_area' );
$rooms               = get_field( 'property_rooms' );
$offer_type          = get_field( 'property_offer_type' );
$has_parking         = get_field( 'property_has_parking' );
$address             = get_field( 'property_full_address' );  
$short_address       = get_field( 'property_short_address' );
$agent_post          = get_field( 'property_agent' ); // Об'єкт зв'язаного поста Агента
$property_features   = get_field( 'property_features' );

if ( ! $short_address && $address ) {
    $address_parts   = array_filter( array_map( 'trim', explode( ',', $address ) ) );
    $short_address   = $address_parts ? $address_parts[0] : $address;
}

$status_text = ( $offer_type === 'Rent' ) ? 'For Rent' : 'For Sale';

$specs = array_filter(
    array(
        $area ? esc_html( $area ) . ' m²' : '',
        $rooms ? esc_html( $rooms ) . ' rooms' : '',
        $has_parking ? 'Parking' : '',
    )
);
    
$spec_line = $specs ? implode( ' • ', $specs ) : 'No specs available';


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

        <div class="property-price-row">
            <p class="property-price">
                <?php if ( $price ) : ?>
                    <span class="property-price-value"><?php echo esc_html( $price ); ?></span><span class="property-price-currency">$</span>
                    <?php if ( $offer_type === 'Rent' ) : ?><span class="property-price-period"> / міс</span><?php endif; ?>
                <?php else : ?>
                    Contact for price
                <?php endif; ?>
            </p>
            <?php if ( $status_text ) : ?>
                <span class="property-status-badge"><?php echo esc_html( $status_text ); ?></span>
            <?php endif; ?>
        </div>

        <!-- <?php if ( $short_address ) : ?>
            <p class="property-location-short"><?php echo esc_html( $short_address ); ?></p>
        <?php endif; ?> -->
        <?php if ( $address ) : ?>
            <p class="property-location-full">📍 <?php echo esc_html( $address ); ?></p>
        <?php endif; ?>

        <p class="property-specs-line"><?php echo esc_html( $spec_line ); ?></p>
    </div>
<div class="property-grid-layout">
    <div class="property-left-column">
        <section class="property-hero-image">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'large' ); ?>
            <?php else : ?>
                <img src="https://placehold.co/1400x900/eef2f5/7f8c8d?text=No+Image" alt="No Image">
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

            <div class="agent-sidebar-contacts">
                <?php if ( $clean_phone ) : ?>
                    <a class="agent-btn agent-btn-primary phone-btn" href="tel:<?php echo esc_attr( $clean_phone ); ?>">
                        <span class="service-icon">📞</span> Call Agent
                    </a>
                <?php endif; ?>

                <?php if ( $agent_email ) : ?>
                    <a class="agent-btn agent-btn-secondary email-btn" href="mailto:<?php echo esc_attr( $agent_email ); ?>">
                        <span class="service-icon">✉️</span> Email Agent
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </aside>
</div>

<?php 
if ( is_string( $property_features ) ) {
    $property_features = array_filter( array_map( 'trim', preg_split( '/[\r\n]+/', $property_features ) ) );
}

if ( ! is_array( $property_features ) || empty( $property_features ) ) {
    $property_features = array( 'Property Feature is not specified' );
}

$property_features = array_map( 'ucwords', $property_features );
?>

<section class="property-features-box">
    <div class="property-features-grid">
        <div class="features-description">
            <h2>Description</h2>
            <div class="feature-description-text">
                <?php ob_start(); the_content(); echo ob_get_clean(); ?>
            </div>
        </div>

        <div class="features-list-column">
            <h2>Features</h2>
            <div class="features-list-chips">
                <?php foreach ( $property_features as $feature ) : ?>
                    <span class="feature-chip">✓ <?php echo esc_html( $feature ); ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
