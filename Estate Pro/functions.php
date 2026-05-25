<?php
/**
 * КРОК 1: Вмикаємо вбудовані фічі WordPress
 */
function estate_pro_enqueue_assets() {
    wp_enqueue_style( 'estate-pro-style', get_stylesheet_uri(), array(), '1.0' );
    wp_enqueue_script( 'estate-pro-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'estate_pro_enqueue_assets' );

function estate_pro_theme_setup() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'estate_pro_theme_setup' );


/**
 * КРОК 2: Реєструємо наш власний розділ "Properties"
 */
function estate_pro_register_property_type() {
    $args = array(
        'labels' => array(
            'name'          => 'Properties',
            'singular_name' => 'Property',
            'add_new'       => 'Add New Property'
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-admin-home',
        'show_in_rest' => true, // Вмикає Gutenberg
        'supports'     => array( 'title', 'editor', 'thumbnail' )
    );
    register_post_type( 'property', $args );
}
add_action( 'init', 'estate_pro_register_property_type' );


/**
 * КРОК 3: Реєстрація кастомного Gutenberg-блока через ACF
 */
function estate_pro_register_my_first_block() {
    if ( function_exists('acf_register_block_type') ) {
        acf_register_block_type( array(
            'name'            => 'agent_card',
            'title'           => 'Картка Агента',
            'description'     => 'Блок для виведення контактів ріелтора.',
            'render_template' => 'template-parts/blocks/agent-card.php',
            'category'        => 'formatting',
            'icon'            => 'admin-users',
        ) );
    }
}
add_action('acf/init', 'estate_pro_register_my_first_block');