<?php
/**
 * Шаблон для Gutenberg-блока "Вердикт Автора"
 */

$score   = get_field('verdict_score');
$summary = get_field('verdict_summary');

$score_value = is_numeric( $score ) ? (int) $score : null;

if ( null !== $score_value ) {
    if ( $score_value <= 4 ) {
        $score_class = 'score-number is-low';
    } elseif ( $score_value <= 6 ) {
        $score_class = 'score-number is-medium';
    } else {
        $score_class = 'score-number is-high';
    }
} else {
    $score_class = 'score-number';
}
?>

<div class="verdict-block" role="group" aria-label="Вердикт автора">
    <?php if ( null !== $score_value ) : ?>
        <div class="verdict-score-zone">
            <div class="<?php echo esc_attr( $score_class ); ?>"><?php echo esc_html( $score_value ); ?></div>
            <div class="score-label">Рейтинг</div>
        </div>
    <?php endif; ?>
    <div class="verdict-text-zone">
        <h4>🏁 Підсумковий вердикт</h4>
        <p><?php echo $summary ? esc_html($summary) : 'Напишіть тут свій фінальний висновок щодо пристрою...'; ?></p>
    </div>
</div>