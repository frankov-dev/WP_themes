<?php
$offer_type  = get_field( 'property_offer_type' );
$badge_class = ( $offer_type === 'Rent' ) ? 'badge--rent' : 'badge--sale';
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

            <p class="property-meta__row">Площа: <strong><?php the_field( 'property_area' ); ?> м²</strong></p>
            <p class="property-meta__row">Кімнат: <strong><?php the_field( 'property_rooms' ); ?></strong></p>

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