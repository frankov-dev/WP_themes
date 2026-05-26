<?php
/**
 * Шаблон для Gutenberg-блока "Плюси та Мінуси"
 */

// Отримуємо значення з майбутніх ACF полів
$pros = get_field('tech_pros');
$cons = get_field('tech_cons');
?>

<div class="pros-cons-block" style="display: flex; gap: 20px; margin: 30px 0; font-family: sans-serif;">
    
    <div class="pros-col" style="flex: 1; background: #e8f5e9; padding: 20px; border-radius: 8px;">
        <h4 style="margin: 0 0 10px 0; color: #2e7d32; font-size: 18px;">👍 Плюси</h4>
        <div style="color: #333; font-size: 15px; line-height: 1.6;">
            <?php echo $pros ? $pros : 'Тут будуть плюси...'; ?>
        </div>
    </div>

    <div class="cons-col" style="flex: 1; background: #ffebee; padding: 20px; border-radius: 8px;">
        <h4 style="margin: 0 0 10px 0; color: #c62828; font-size: 18px;">👎 Мінуси</h4>
        <div style="color: #333; font-size: 15px; line-height: 1.6;">
            <?php echo $cons ? $cons : 'Тут будуть мінуси...'; ?>
        </div>
    </div>

</div>