<?php
/**
 * Шаблон для Gutenberg-блока "Плюси та Мінуси"
 */

$pros = get_field('tech_pros');
$cons = get_field('tech_cons');
?>

<div class="pros-cons-block">
    
    <div class="pros-col">
        <h4>👍 Плюси</h4>
        <div class="block-content">
            <?php echo $pros ? $pros : 'Тут будуть плюси...'; ?>
        </div>
    </div>

    <div class="cons-col">
        <h4>👎 Мінуси</h4>
        <div class="block-content">
            <?php echo $cons ? $cons : 'Тут будуть мінуси...'; ?>
        </div>
    </div>

</div>