<?php
/**
 * КРОК 1: Вмикаємо вбудовані фічі WordPress
 * * Ми створюємо функцію, яка каже WordPress, які стандартні можливості 
 * двигуна наша тема взагалі підтримує.
 */


function estate_pro_enqueue_assets() {
    wp_enqueue_style( 'estate-pro-style', get_stylesheet_uri(), array(), '1.0' );
    // При потребі підключіть скрипти так:
    wp_enqueue_script( 'estate-pro-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'estate_pro_enqueue_assets' );

function estate_pro_theme_setup() {
    
    // Вмикаємо підтримку "Featured Image" (головне фото для постів/квартир)
    // Без цього в адмінці просто не буде віконця для завантаження картинки об'єкта.
    add_theme_support( 'post-thumbnails' );

    // Кажемо WP самому керувати тегом <title> в браузері.
    // Тобі не доведеться вручну писати назву сайту в кожному файлі.
    add_theme_support( 'title-tag' );
}
// Прив'язуємо нашу функцію на подію "Тема завантажилась"
add_action( 'after_setup_theme', 'estate_pro_theme_setup' );


/**
 * КРОК 2: Реєструємо наш власний розділ "Нерухомість"
 * * WordPress вміє працювати з текстом, але він не знає, що таке "Квартира".
 * Ми вчимо його новому типу даних.
 */
function estate_pro_register_property_type() {

    // Створюємо масив налаштувань. Це просто конфіг для функції register_post_type.
    $args = array(
        'labels' => array(
            'name'          => 'Properties',     // Назва вкладки в лівому меню адмінки
            'singular_name' => 'Property',       // Як називається один об'єкт
            'add_new'       => 'Add New Property'// Текст на кнопці "Додати"
        ),
        'public'       => true,                  // Робить цей тип контенту доступним на самому сайті
        'has_archive'  => true,                  // Дозволяє виводити список всіх об'єктів (архів)
        'menu_icon'    => 'dashicons-admin-home', // Іконка будиночка в адмінці
        'show_in_rest' => true,                  // Вмикає сучасний редактор блоків (Gutenberg)
        'supports'     => array( 'title', 'editor', 'thumbnail' ) // Що юзер може редагувати: Заголовок, Опис, Фото
    );

    // Викликаємо вбудовану функцію WP.
    // Перший параметр 'property' — це системний ID нашого типу (slug). 
    // Другий параметр $args — наш масив з налаштуваннями.
    register_post_type( 'property', $args );
}
// Прив'язуємо цю логіку на подію 'init' (коли система повністю готова)
add_action( 'init', 'estate_pro_register_property_type' );