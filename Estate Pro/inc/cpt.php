<?php

function estate_pro_register_property_type() {
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
}
add_action( 'init', 'estate_pro_register_property_type' );