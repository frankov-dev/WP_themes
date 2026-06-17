<?php

function estate_pro_register_custom_post_types() {
    $args = array(
        'labels' => array(
            'name'          => 'Properties',
            'singular_name' => 'Property',
            'add_new'       => 'Add New Property',
        ),
        'public'       => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-admin-home',
        'show_in_rest'  => true,
        'supports'      => array( 'title', 'editor', 'thumbnail' ),
    );

    register_post_type( 'property', $args );

    $args = array(
        'labels' => array(
            'name'          => 'Agents',
            'singular_name' => 'Agent',
            'add_new'       => 'Add New Agent Profile',
            'add_new_item'  => 'Add New Agent Profile',
            'edit_item'     => 'Edit Agent',
        ),
        'public'       => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-businessman',
        'supports'      => array( 'title', 'thumbnail' ),
        'show_in_rest'  => true,
    );
    register_post_type( 'agent', $args );

}

add_action( 'init', 'estate_pro_register_custom_post_types' );