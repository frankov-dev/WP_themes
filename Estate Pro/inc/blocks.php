<?php

function estate_pro_register_my_first_block() {
    if ( function_exists( 'acf_register_block_type' ) ) {
        acf_register_block_type(
            array(
                'name'            => 'agent_card',
                'title'           => 'Картка Агента',
                'description'     => 'Блок для виведення контактів ріелтора.',
                'render_template' => get_template_directory() . '/template-parts/blocks/agent-card.php',
                'category'        => 'formatting',
                'icon'            => 'admin-users',
            )
        );
    }
}
add_action( 'acf/init', 'estate_pro_register_my_first_block' );