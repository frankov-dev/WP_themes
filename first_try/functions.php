<?php
/**
 * Functions and definitions
 */

function first_try_scripts() {
	// Підключаємо основний файл стилів style.css
	wp_enqueue_style( 'first-try-style', get_stylesheet_uri(), array(), '1.0' );
	// Кажемо WordPress: "Коли будеш завантажувати скрипти, виконай мою функцію"
	add_action( 'wp_enqueue_scripts', 'first_try_scripts' );
}

