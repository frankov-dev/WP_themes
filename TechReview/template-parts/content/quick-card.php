<?php
/**
 * Шаблон для відображення одного елемента у стрічці швидких новин
 */
?>
<div class="quick-news-item">
    <span class="quick-news-time">🕒 <?php echo get_the_time('H:i'); ?></span>
    <h4 class="quick-news-title"><?php the_title(); ?></h4>
    <div class="quick-news-text">
        <?php the_content(); ?>
    </div>
</div>