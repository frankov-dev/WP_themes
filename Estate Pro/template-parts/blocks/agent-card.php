<?php
$agent_name        = function_exists( 'get_field' ) ? get_field( 'agent_name' ) : '';
$agent_role        = function_exists( 'get_field' ) ? get_field( 'agent_role' ) : '';
$agent_phone       = function_exists( 'get_field' ) ? get_field( 'agent_phone' ) : '';
$agent_email       = function_exists( 'get_field' ) ? get_field( 'agent_email' ) : '';
$agent_description = function_exists( 'get_field' ) ? get_field( 'agent_description' ) : '';
$agent_photo       = function_exists( 'get_field' ) ? get_field( 'agent_photo' ) : null;

if ( is_array( $agent_photo ) && ! empty( $agent_photo['ID'] ) ) {
    $agent_photo_id = $agent_photo['ID'];
} elseif ( is_numeric( $agent_photo ) ) {
    $agent_photo_id = $agent_photo;
} else {
    $agent_photo_id = 0;
}
?>

<section class="agent-card">
    <div class="agent-card__media">
        <?php if ( $agent_photo_id ) : ?>
            <?php echo wp_get_attachment_image( $agent_photo_id, 'medium', false, array( 'class' => 'agent-card__image' ) ); ?>
        <?php endif; ?>
    </div>

    <div class="agent-card__body">
        <?php if ( $agent_name ) : ?>
            <h3 class="agent-card__name"><?php echo esc_html( $agent_name ); ?></h3>
        <?php endif; ?>

        <?php if ( $agent_role ) : ?>
            <p class="agent-card__role"><?php echo esc_html( $agent_role ); ?></p>
        <?php endif; ?>

        <?php if ( $agent_description ) : ?>
            <div class="agent-card__description">
                <?php echo wp_kses_post( wpautop( $agent_description ) ); ?>
            </div>
        <?php endif; ?>

        <div class="agent-card__contacts">
            <?php if ( $agent_phone ) : ?>
                <a class="agent-card__contact" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $agent_phone ) ); ?>"><?php echo esc_html( $agent_phone ); ?></a>
            <?php endif; ?>

            <?php if ( $agent_email ) : ?>
                <a class="agent-card__contact" href="mailto:<?php echo esc_attr( $agent_email ); ?>"><?php echo esc_html( $agent_email ); ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>