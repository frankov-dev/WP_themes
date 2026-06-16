<?php
/**
 * Property Card for Catalog Grid
 * Pure and simple layout using basic text fields.
 */

$price       = get_field( 'property_price' );
$area        = get_field( 'property_area' );
$rooms       = get_field( 'property_rooms' );
$offer_type  = get_field( 'property_offer_type' ); // Rent або Sale
$has_parking = get_field( 'property_has_parking' ); // True/False
$address     = get_field( 'property_address' ); 
?>

<article class="property-card">
    
    <div class="property-card-image">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'medium_large' ); ?>
        <?php else : ?>
            <img src="https://placehold.co/600x400/eef2f5/7f8c8d?text=No+Image" alt="No Image">
        <?php endif; ?>

        <?php if ( $offer_type ) : ?>
            <span class="property-badge badge-<?php echo strtolower( esc_attr( $offer_type ) ); ?>">
                For <?php echo esc_html( $offer_type ); ?>
            </span>
        <?php endif; ?>
    </div>

    <div class="property-card-content">
        <h3 class="property-card-title" style="margin: 0 0 12px 0; font-size: 18px; line-height: 1.3;">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <?php if ( $address ) : ?>
            <p class="property-card-location" style="margin: 0 0 12px 0; font-size: 14px; color: #666;">📍 <?php echo esc_html( $address ); ?></p>
        <?php endif; ?>

        <div class="property-card-price" style="margin: 0 0 14px 0; font-size: 26px; font-weight: 800; color: #202124;">
            <?php echo $price ? esc_html( $price ) . ' <span style="font-size: 18px;">$</span>' : 'Contact us'; ?>
            <?php echo ( $offer_type === 'Rent' ) ? '<span style="font-size: 16px; font-weight: 600;"> / mo</span>' : ''; ?>
        </div>

        <div class="property-card-specs" style="margin: 0 0 14px 0; font-size: 14px; color: #5f6368; line-height: 1.6;">
            <?php 
            $specs = [];
            if ( $area ) $specs[] = esc_html( $area ) . ' m²';
            if ( $rooms ) $specs[] = esc_html( $rooms ) . ' rooms';
            if ( $has_parking ) $specs[] = 'Parking';
            echo implode( ' • ', $specs ) ?: 'No specs available';
            ?>
        </div>

        <div class="property-card-footer" style="margin-top: 14px;">
            <a href="<?php the_permalink(); ?>" class="btn-details">View Details</a>
        </div>
    </div>

</article>