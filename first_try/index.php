<?php get_header(); // Ця функція каже WP: "Візьми код із header.php" ?>

<main style="padding: 20px;">
    <h2>Це основний контент сторінки</h2>
    <p>Тут ми будемо виводити наші записи або блоки ACF.</p>
    <div class="custom-subtitle">
        <?php the_field('section_title'); ?>
    </div>
</main>

<?php get_footer(); // Ця функція каже WP: "Візьми код із footer.php" ?>    