<?php
/**
 * Шаблон для нового Gutenberg-блока "Гнучкі характеристики" (через Repeater)
 */
?>

<div class="specs-table-block">
    <h4>📊 Технічні характеристики</h4>
    
    <?php 
    // Перевіряємо, чи адмін додав хоча б один рядок у наш новий репітер
    if ( have_rows('flexible_specs_repeater') ) : 
    ?>
        <table>
            <?php 
            // Запускаємо цикл по нових полях
            while ( have_rows('flexible_specs_repeater') ) : the_row(); 
                $label = get_sub_field('flex_spec_label');
                $value = get_sub_field('flex_spec_value');
                
                if ( $label || $value ) :
            ?>
                <tr>
                    <th><?php echo esc_html($label); ?></th>
                    <td><?php echo esc_html($value); ?></td>
                </tr>
            <?php 
                endif;
            endwhile; 
            ?>
        </table>
    <?php else : ?>
        <p style="font-size: 14px; color: var(--color-text-secondary); font-style: italic;">
            Таблиця порожня. Натисніть "+ Додати рядок" у налаштуваннях блоку в адмінці.
        </p>
    <?php endif; ?>
</div>