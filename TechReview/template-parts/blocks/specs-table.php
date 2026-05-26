<?php
/**
 * Шаблон для Gutenberg-блока "Таблиця Характеристик"
 */

// Отримуємо значення з майбутніх ACF полів
$cpu     = get_field('spec_cpu');
$gpu     = get_field('spec_gpu');
$ram     = get_field('spec_ram');
$storage = get_field('spec_storage');
?>

<div class="specs-table-block" style="margin: 30px 0; font-family: sans-serif;">
    <h4 style="margin-bottom: 15px; color: #111; font-size: 18px;">📊 Технічні характеристики</h4>
    
    <table style="width: 100%; border-collapse: collapse; background: #ffffff; border: 1px solid #eef2f5; border-radius: 8px; overflow: hidden;">
        <tr style="border-bottom: 1px solid #eef2f5;">
            <td style="padding: 12px 15px; font-weight: bold; background: #f8f9fa; width: 30%; color: #555;">Процесор</td>
            <td style="padding: 12px 15px; color: #111;"><?php echo $cpu ? $cpu : 'Не вказано...'; ?></td>
        </tr>
        <tr style="border-bottom: 1px solid #eef2f5;">
            <td style="padding: 12px 15px; font-weight: bold; background: #f8f9fa; color: #555;">Графічна карта</td>
            <td style="padding: 12px 15px; color: #111;"><?php echo $gpu ? $gpu : 'Не вказано...'; ?></td>
        </tr>
        <tr>
            <td style="padding: 12px 15px; font-weight: bold; background: #f8f9fa; color: #555;">Оперативна пам'ять</td>
            <td style="padding: 12px 15px; color: #111;"><?php echo $ram ? $ram : 'Не вказано...'; ?></td>
        </tr>
        <tr>
            <td style="padding: 12px 15px; font-weight: bold; background: #f8f9fa; color: #555;">Накопичувач (SSD/HDD)</td>
            <td style="padding: 12px 15px; color: #111;"><?php echo $storage ? $storage : 'Не вказано...'; ?></td>
        </tr>
    </table>
</div>