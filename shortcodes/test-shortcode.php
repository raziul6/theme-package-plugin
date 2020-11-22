<?php
function test_about_shortcode($atts, $content = null){
    extract( shortcode_atts( array(
        'title'         => '',
    ), $atts) );
    $test_markup ='';
    return $test_markup;
}
add_shortcode('test_about', 'test_about_shortcode');