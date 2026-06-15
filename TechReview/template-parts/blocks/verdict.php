<?php
/**
 * Шаблон для Gutenberg-блока "Вердикт Автора"
 */

$score   = get_field('verdict_score');
$summary = get_field('verdict_summary');
?>

<div class="verdict-block" role="group" aria-label="Вердикт автора">
    <?php if ( $score ) : ?>
        <div class="verdict-score-zone">
            <div class="score-number"><?php echo esc_html($score); ?></div>
            <div class="score-label">Рейтинг</div>
        </div>
    <?php endif; ?>
    <div class="verdict-text-zone">
        <h4>🏁 Підсумковий вердикт</h4>
        <p><?php echo $summary ? esc_html($summary) : 'Напишіть тут свій фінальний висновок щодо пристрою...'; ?></p>
    </div>
</div>