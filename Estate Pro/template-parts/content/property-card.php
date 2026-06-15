<?php
$offer_type  = get_field( 'property_offer_type' );
$badge_color = ( $offer_type === 'Rent' ) ? '#7f8c8d' : '#2ecc71';
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
            <span class="badge" style="display:inline-block; background: <?php echo esc_attr( $badge_color ); ?>; color:#fff; padding:3px 8px; font-size:12px; border-radius:4px; margin-bottom:10px; font-weight:bold;">
                <?php echo esc_html( $offer_type ); ?>
            </span>
        <?php endif; ?>

        <h3 class="property-title" style="margin-top:0;"><?php the_title(); ?></h3>

        <p class="property-address" style="color: #7f8c8d; font-size: 14px; margin: 5px 0;">
            📍 <?php the_field( 'property_address' ); ?>
        </p>

        <hr style="border:0; border-top:1px solid #eee; margin:15px 0;">

        <div class="property-meta" style="font-size: 14px; color: #555; margin-bottom: 20px;">
            <p style="margin: 5px 0;">Ціна:
                <strong style="color: #1a73e8; font-size: 16px;">
                    <?php the_field( 'property_price' ); ?> $
                    <?php if ( $offer_type === 'Rent' ) { echo '<span style="font-size:12px; color:#7f8c8d;">/ міс.</span>'; } ?>
                </strong>
            </p>

            <p style="margin: 5px 0;">Площа: <strong><?php the_field( 'property_area' ); ?> м²</strong></p>
            <p style="margin: 5px 0;">Кімнат: <strong><?php the_field( 'property_rooms' ); ?></strong></p>

            <p style="margin: 5px 0;">Паркінг:
                <strong>
                    <?php if ( get_field( 'property_has_parking' ) ) : ?>
                        <span style="color: #2ecc71;">✅ Є у наявності</span>
                    <?php else : ?>
                        <span style="color: #e74c3c; font-weight:normal;">❌ Немає</span>
                    <?php endif; ?>
                </strong>
            </p>
        </div>

        <a href="<?php the_permalink(); ?>" class="property-link">
            Переглянути деталі
        </a>
    </div>
</article>