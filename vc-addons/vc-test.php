<?php
vc_map( 
    array(
        "name" => esc_html__( "Brands Addon", 'dust-toolkit' ),
        "base" => "dust_brand",
        "category" => esc_html__( "Dust", 'dust-toolkit'),
        'icon' => DUST_ACC_URL . '/assets/images/dust.jpg',
        "params" => array(
            array(
                "type" => "attach_images",
                "heading" => esc_html__( "Brand Logo", 'dust-toolkit' ),
                "param_name" => "brands",
            ), 
        )
    )   
);