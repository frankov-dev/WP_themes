<?php

// Автоматично зчитуємо файл .env з кореня теми
$env_file = __DIR__ . '/.env';

if ( file_exists( $env_file ) ) {
    $env_vars = parse_ini_file( $env_file );
    if ( isset( $env_vars['GOOGLE_MAPS_API_KEY'] ) && ! defined( 'GOOGLE_MAPS_API_KEY' ) ) {
        define( 'GOOGLE_MAPS_API_KEY', $env_vars['GOOGLE_MAPS_API_KEY'] );
    }
}

// Захист: якщо файлу немає (наприклад, на продакшені), створюємо порожню константу, щоб код не падав
if ( ! defined( 'GOOGLE_MAPS_API_KEY' ) ) {
    define( 'GOOGLE_MAPS_API_KEY', '' );
}

require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/cpt.php';
// require_once get_template_directory() . '/inc/blocks.php';
