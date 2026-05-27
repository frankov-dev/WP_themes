<?php
/**
 * Шаблон для Gutenberg-блока "Таблиця Характеристик"
 */

$cpu     = get_field('spec_cpu');
$gpu     = get_field('spec_gpu');
$ram     = get_field('spec_ram');
$storage = get_field('spec_storage');
?>

<div class="specs-table-block">
    <h4>📊 Технічні характеристики</h4>
    
    <table>
        <tr>
            <th>Процесор</th>
            <td><?php echo $cpu ? $cpu : 'Не вказано...'; ?></td>
        </tr>
        <tr>
            <th>Графічна карта</th>
            <td><?php echo $gpu ? $gpu : 'Не вказано...'; ?></td>
        </tr>
        <tr>
            <th>Оперативна пам'ять</th>
            <td><?php echo $ram ? $ram : 'Не вказано...'; ?></td>
        </tr>
        <tr>
            <th>Накопичувач (SSD/HDD)</th>
            <td><?php echo $storage ? $storage : 'Не вказано...'; ?></td>
        </tr>
    </table>
</div>