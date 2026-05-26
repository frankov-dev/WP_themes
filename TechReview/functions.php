<?php

function techreview_enqueue_styles() {
    wp_enqueue_style('techreview-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'techreview_enqueue_styles');

function techreview_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus(array(
        'primary' => 'Primary Menu',
    ));
}
add_action('after_setup_theme', 'techreview_setup');

function techreview_acf_register_blocks() {
    if ( function_exists('acf_register_block_type') ) {
        
        // Блок Плюсів та Мінусів
        acf_register_block_type( array(
            'name'            => 'pros_cons',
            'title'           => 'Плюси та Мінуси',
            'description'     => 'Блок для порівняння переваг та недоліків гаджета.',
            'render_template' => 'template-parts/blocks/pros-cons.php',
            'category'        => 'formatting',
            'icon'            => 'thumbs-up',
        ) );

        acf_register_block_type( array(
            'name'            => 'specs_table',
            'title'           => 'Таблиця Характеристик',
            'description'     => 'Блок для відображення технічних характеристик у вигляді таблиці.',
            'render_template' => 'template-parts/blocks/specs-table.php',
            'category'        => 'formatting',
            'icon'            => 'table-row-after',
        ));
    }
}
add_action('acf/init', 'techreview_acf_register_blocks');