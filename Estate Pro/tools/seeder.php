<?php
/**
 * Standalone Seeder inside Theme Folder
 *
 * Usage:
 *  - CLI: `php seeder.php`
 *  - Browser (admin): open while logged in as administrator
 */

$max_levels = 6;
$dir = __DIR__;
$wp_load = '';
for ( $i = 0; $i < $max_levels; $i++ ) {
    $try = $dir . DIRECTORY_SEPARATOR . 'wp-load.php';
    if ( file_exists( $try ) ) {
        $wp_load = $try;
        break;
    }
    $dir = dirname( $dir );
}

if ( ! $wp_load ) {
    $fallback = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'wp-load.php';
    if ( file_exists( $fallback ) ) {
        $wp_load = $fallback;
    }
}

if ( ! $wp_load ) {
    fwrite( STDERR, "wp-load.php not found. Please run this script from inside a WordPress installation.\n" );
    exit(1);
}

require_once $wp_load;

if ( php_sapi_name() !== 'cli' && ! current_user_can( 'manage_options' ) ) {
    wp_die( '🚫 Доступ заборонено. Запустіть скрипт через термінал або залогіньтесь під адміном.' );
}

if ( php_sapi_name() === 'cli' ) {
    echo "🚀 Старт генерації тестових даних..." . PHP_EOL;
} else {
    echo '<p>🚀 Старт генерації тестових даних...</p>';
}

$adjectives   = array( 'Сучасний', 'Затишний', 'Преміум', 'Елітний', 'Стильний', 'Просторий', 'Світлий' );
$types        = array( 'лофт', 'пентхаус', 'апартамент', 'будинок', 'котедж', 'таунхаус' );
$cities       = array( 'Львів (Центр)', 'Львів (Сихів)', 'Хмельницький (Центр)', 'Київ (Поділ)' );
$streets      = array( 'вул. Шевченка', 'вул. Зелена', 'просп. Миру', 'вул. Бандери' );
$descriptions = array(
    'Чудовий варіант для комфортного проживання. Поруч розвинена інфраструктура.',
    'Повністю укомплектована всією необхідною технікою. Зроблено якісний ремонт.',
);

$inserted_count = 0;

for ( $i = 1; $i <= 20; $i++ ) {
    $rand_adj  = $adjectives[ array_rand( $adjectives ) ];
    $rand_type = $types[ array_rand( $types ) ];
    $rand_city = $cities[ array_rand( $cities ) ];
    $rand_str  = $streets[ array_rand( $streets ) ];

    $title   = $rand_adj . ' ' . $rand_type . ' — ' . $rand_city;
    $address = $rand_city . ', ' . $rand_str . ', ' . rand( 1, 100 );

    $offer_type = ( rand( 0, 1 ) === 1 ) ? 'Sale' : 'Rent';
    $price      = ( $offer_type === 'Sale' ) ? rand( 40000, 250000 ) : rand( 300, 1500 );
    $area       = rand( 35, 150 );
    $rooms      = (string) rand( 1, 4 );
    $parking    = rand( 0, 1 );

    $post_id = wp_insert_post(
        array(
            'post_title'   => $title,
            'post_content' => $descriptions[ array_rand( $descriptions ) ],
            'post_status'  => 'publish',
            'post_type'    => 'property',
        )
    );

    if ( $post_id && ! is_wp_error( $post_id ) ) {
        if ( function_exists( 'update_field' ) ) {
            update_field( 'property_price', $price, $post_id );
            update_field( 'property_area', $area, $post_id );
            update_field( 'property_rooms', $rooms, $post_id );
            update_field( 'property_address', $address, $post_id );
            update_field( 'property_offer_type', $offer_type, $post_id );
            update_field( 'property_has_parking', $parking, $post_id );
        }
        $inserted_count++;
    }
}

if ( php_sapi_name() === 'cli' ) {
    echo "✅ Успішно згенеровано об'єктів нерухомості: $inserted_count шт." . PHP_EOL;
} else {
    echo '<p>✅ Успішно згенеровано об\'єктів нерухомості: ' . esc_html( $inserted_count ) . ' шт.</p>';
}