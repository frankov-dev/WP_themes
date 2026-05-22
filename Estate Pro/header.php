<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); // Без цього WordPress не підключить наш style.css! ?>
</head>
<body <?php body_class(); ?>>

    <header class="site-header">
        <div class="header-container">
            <a href="<?php echo home_url('/'); ?>" class="site-logo">Estate Pro</a>
        </div>
    </header>