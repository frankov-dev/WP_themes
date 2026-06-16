<?php
$offer_type  = get_field( 'property_offer_type' );
$badge_class = ( $offer_type === 'Rent' ) ? 'badge--rent' : 'badge--sale';
$price = get_field( 'property_price' );
$area = get_field( 'property_area' );
$rooms = get_field( 'property_rooms' );
$has_parking = get_field( 'property_has_parking' );

$compact_meta = array();
if ( $area ) { $compact_meta[] = esc_html( $area ) . ' м²'; }
if ( $rooms ) { $compact_meta[] = esc_html( $rooms ) . ' кімн.'; }
if ( $has_parking ) { $compact_meta[] = 'Паркінг'; }
else { $compact_meta[] = 'Без паркінгу'; }
// Fallback image: use Unsplash query for real interior/exterior photos
$fallback_image = 'https://source.unsplash.com/800x600/?apartment,interior,house';
?>

<article class="property-card">
    <div class="property-image">
        <?php
        if ( has_post_thumbnail() ) {
            the_post_thumbnail( 'medium' );
        } else {
            echo '<img src="https://picsum.photos/800/600?random=' . esc_attr( get_the_ID() ) . '" alt="' . esc_attr( get_the_title() ) . '">';
        }
        ?>
    </div>

    <div class="property-info">
        <?php if ( $offer_type ) : ?>
            <span class="badge <?php echo esc_attr( $badge_class ); ?>">
                <?php echo esc_html( $offer_type ); ?>
            </span>
        <?php endif; ?>

        <h3 class="property-title"><?php the_title(); ?></h3>

        <p class="property-address">
            📍 <?php the_field( 'property_address' ); ?>
        </p>

        <hr>

        <div class="property-meta">
            <p class="property-meta__row">Ціна:
                <strong class="property-price">
                    <?php the_field( 'property_price' ); ?> $
                    <?php if ( $offer_type === 'Rent' ) { echo '<span class="property-rent-period">/ міс.</span>'; } ?>
                </strong>
            </p>

                            echo '<img src="' . esc_url( $fallback_image ) . '" alt="' . esc_attr( get_the_title() ) . '">';
            <p class="property-meta__row">Кімнат: <strong><?php the_field( 'property_rooms' ); ?></strong></p>

                        <?php if ( $price ) : ?>
                            <span class="property-price-overlay"><?php echo esc_html( $price ); ?> $</span>
                        <?php endif; ?>
            <p class="property-meta__row">Паркінг:
                <strong>
                    <?php if ( get_field( 'property_has_parking' ) ) : ?>
                        <span class="parking-yes">✅ Є у наявності</span>
                    <?php else : ?>
                        <span class="parking-no">❌ Немає</span>
                    <?php endif; ?>
                </strong>
            </p>
        </div>

        <a href="<?php the_permalink(); ?>" class="property-link">
            Переглянути деталі
        </a>
    </div>
</article>