<?php
/**
 * Реєстрація кастомних типів записів (Custom Post Types)
 */

function techreview_register_custom_post_types() {
    $args = array(
        'labels' => array(
            'name'               => 'Швидкі новини',
            'singular_name'      => 'Швидка новина',
            'add_new'            => 'Додати новину',
            'add_new_item'       => 'Додати нову швидку новину',
            'edit_item'          => 'Редагувати новину',
            'all_items'          => 'Всі швидкі новини',
        ),
        'public'             => true,
        'has_archive'        => true, // Автоматично створює окрему сторінку-архів для всіх коротких новин!
        'menu_icon'          => 'dashicons-megaphone', // Крута іконка рупора в адмінці
        'show_in_rest'       => true, // Вмикає сучасний редактор Gutenberg
        'supports'           => array( 'title', 'editor' ) // Для швидкої новини потрібен лише заголовок і короткий текст
    );
    
    register_post_type( 'quick_news', $args );
}
add_action( 'init', 'techreview_register_custom_post_types' );

function register_hero_slides_cpt() {
    register_post_type( 'hero_slide', array(
        'labels' => array(
            'name'          => 'Слайди банера',
            'singular_name' => 'Слайд',
            'add_new'       => 'Додати слайд',
        ),
        'public'      => true,
        'has_archive' => false, // Нам не потрібна сторінка архіву для слайдів
        'menu_icon'   => 'dashicons-images-alt2', // Іконка з картинками
        'supports'    => array( 'title', 'thumbnail' ), // Заголовок і картинка
        'show_in_rest'=> true,
    ));
}
add_action( 'init', 'register_hero_slides_cpt' );