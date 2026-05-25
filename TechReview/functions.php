<?php

function techreview_enqueue_styles() {
    wp_enqueue_style('techreview-style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'techreview_enqueue_styles');

function techreview_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'techreview_setup');