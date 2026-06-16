<?php
/**
 * Property Single Content Layout
 * Full single-property layout with a dedicated agent group field.
 */

    $price        = get_field( 'property_price' );
    $area         = get_field( 'property_area' );
    $rooms        = get_field( 'property_rooms' );
    $address      = get_field( 'property_address' );
    $offer_type   = get_field( 'property_offer_type' );
    $has_parking  = get_field( 'property_has_parking' );
    $agent_group  = get_field( 'property_agent' );

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

    $address_text = '';
    $map_query    = '';
    $map_src      = '';

    if ( is_array( $address ) ) {
        $address_text = (string) $pick_value( $address, array( 'address', 'formatted_address', 'label' ), '' );
        $lat          = $pick_value( $address, array( 'lat', 'latitude' ), '' );
        $lng          = $pick_value( $address, array( 'lng', 'lon', 'longitude' ), '' );
        $map_query    = ( $lat !== '' && $lng !== '' ) ? rawurlencode( $lat . ',' . $lng ) : rawurlencode( $address_text );
    } else {
        $address_text = trim( (string) $address );
        $map_query    = rawurlencode( $address_text );
    }

    if ( $map_query ) {
        $map_src = 'https://www.google.com/maps?q=' . $map_query . '&z=15&output=embed';
    }

    $agent_group = is_object( $agent_group ) ? get_object_vars( $agent_group ) : ( is_array( $agent_group ) ? $agent_group : array() );

    $agent_name = $pick_value( $agent_group, array( 'agent_name', 'name', 'full_name', 'agent_full_name' ), get_the_author_meta( 'display_name' ) );
    $agent_phone = $pick_value( $agent_group, array( 'agent_phone', 'phone', 'agent_tel', 'tel' ), '' );
    $agent_email = $pick_value( $agent_group, array( 'agent_email', 'email' ), '' );
    $agent_avatar = $pick_value( $agent_group, array( 'agent_avatar', 'avatar', 'image' ), '' );

    if ( is_array( $agent_avatar ) ) {
        $agent_avatar = $pick_value( $agent_avatar, array( 'url', 'sizes.medium', 'sizes.large' ), '' );
    } elseif ( is_numeric( $agent_avatar ) ) {
        $agent_avatar = wp_get_attachment_image_url( (int) $agent_avatar, 'medium' );
    }

    if ( ! $agent_avatar ) {
        $agent_avatar = get_avatar_url( get_the_author_meta( 'ID' ), array( 'size' => 220 ) );
    }

    $price_display = $price ? esc_html( $price ) . ' $' : 'Contact for price';
    if ( $offer_type === 'Rent' ) {
        $price_display .= ' / mo';
    }

    $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
    ?>

<a class="back-btn back-to-catalog" href="<?php echo esc_url( home_url( '/' ) ); ?>">&larr; Back to Catalog</a>

<h1 class="property-main-title"><?php the_title(); ?></h1>

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
            <h2>Location & Infrastructure</h2>

            <?php if ( $address_text ) : ?>
                <p class="map-address-text"><?php echo esc_html( $address_text ); ?></p>
            <?php endif; ?>

            <span class="distance-badge">📍 Prime location near the city center</span>

            <?php if ( $map_src ) : ?>
                <div class="google-iframe-container">
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

            <div class="agent-sidebar-contacts">
                <?php if ( $agent_phone ) : ?>
                    <a class="agent-btn phone-btn" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $agent_phone ) ); ?>">📞 Call Agent</a>
                <?php endif; ?>

                <?php if ( $agent_email ) : ?>
                    <a class="agent-btn email-btn" href="mailto:<?php echo esc_attr( $agent_email ); ?>">✉️ Email Agent</a>
                <?php endif; ?>
            </div>
        </div>
    </aside>
</div>