<?php
/**
 * Шаблон для Gutenberg-блока "Вердикт Автора"
 */

$score   = get_field('verdict_score');
$summary = get_field('verdict_summary');
?>

<div class="verdict-block">
    <div class="verdict-score-zone">
        <div class="score-number"><?php echo $score ? esc_html($score) : '0'; ?></div>
        <div class="score-label">Рейтинг</div>
    </div>
    <div class="verdict-text-zone">
        <h4>🏁 Підсумковий вердикт</h4>
        <p><?php echo $summary ? esc_html($summary) : 'Напишіть тут свій фінальний висновок щодо пристрою...'; ?></p>
    </div>
</div>