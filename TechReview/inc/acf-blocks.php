<?php
function techreview_acf_register_blocks() {
    if ( function_exists('acf_register_block_type') ) {
        
        // Блок Плюсів та Мінусів
        acf_register_block_type( array(
            'name'            => 'pros_cons',
            'title'           => 'Плюси та Мінуси',
            'description'     => 'Блок для порівняння переваг та недоліків гаджета.',
            'render_template' => 'template-parts/blocks/pros-cons.php',
            'category'        => 'formatting',
            'icon'            => 'thumbs-up',
        ) );

        acf_register_block_type( array(
            'name'            => 'specs_table',
            'title'           => 'Таблиця Характеристик',
            'description'     => 'Блок для відображення технічних характеристик у вигляді таблиці.',
            'render_template' => 'template-parts/blocks/specs-table.php',
            'category'        => 'formatting',
            'icon'            => 'table-row-after',
        ));

        acf_register_block_type( array(
            'name'            => 'flexible-specs',
            'title'           => 'Гнучка Таблиця Характеристик',
            'description'     => 'Блок для відображення гнучкої таблиці характеристик.',
            'render_template' => 'template-parts/blocks/flexible-specs.php',
            'category'        => 'formatting',
            'icon'            => 'table-row-after',
        ));

        acf_register_block_type( array(
            'name'            => 'verdict_card',
            'title'           => 'Вердикт Автора',
            'description'     => 'Підсумкова плашка з оцінкою гаджета та висновком.',
            'render_template' => 'template-parts/blocks/verdict.php',
            'category'        => 'formatting',
            'icon'            => 'star-filled', // Іконка зірочки
        ) );
    }
}



add_action('acf/init', 'techreview_acf_register_blocks');