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

$specs = array_filter(
    array(
        $area ? esc_html( $area ) . ' m²' : '',
        $rooms ? esc_html( $rooms ) . ' rooms' : '',
        $has_parking ? 'Parking ✓' : '',
    )
);

$spec_line = $specs ? implode( ' • ', $specs ) : 'No specs available';
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
        <h3 class="property-card-title">
            <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a>
        </h3>

        <?php if ( $address ) : ?>
            <p class="property-card-location">📍 <?php echo esc_html( $address ); ?></p>
        <?php endif; ?>

        <div class="property-card-price">
            <?php if ( $price ) : ?>
                <?php echo esc_html( $price ); ?><span class="property-card-price-currency">$</span>
                <?php if ( $offer_type === 'Rent' ) : ?><span class="property-card-price-period"> / mo</span><?php endif; ?>
            <?php else : ?>
                Contact us
            <?php endif; ?>
        </div>

        <div class="property-card-specline"><?php echo esc_html( $spec_line ); ?></div>

        <div class="property-card-footer">
            <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="btn-details">View Details</a>
        </div>
    </div>

</article>