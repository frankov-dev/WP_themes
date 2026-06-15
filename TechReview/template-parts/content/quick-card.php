<?php
/**
 * Шаблон для відображення одного елемента у стрічці швидких новин
 */
$quick_news_text = get_the_excerpt();

if ( empty( $quick_news_text ) ) {
    $quick_news_text = wp_trim_words( wp_strip_all_tags( get_the_content() ), 20, '…' );
}
?>
<div class="quick-news-item">
    <span class="quick-news-time">🕒 <?php echo get_the_time('H:i'); ?></span>
    <h4 class="quick-news-title"><?php the_title(); ?></h4>
    <div class="quick-news-text">
        <p><?php echo esc_html( $quick_news_text ); ?></p>
    </div>
</div>