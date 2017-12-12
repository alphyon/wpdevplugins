<?php
/**
 * @package Short_Codes_dev
 * @version 1.6
 */
/*
Plugin Name: Short code dev ejemplos
Plugin URI: 
Description: 
Author: José Antonio Henriquez Chavarria
Version: 
Author URI: 
*/

function install_dev_short(){
    
}

register_activation_hook( __FILE__, 'install_dev_short' );

if(!function_exists('first_short_code')){
    function first_short_code($attr, $contenido)
    {
        $data = <<<TEXT
       <input type="text" name="text">
       <input type="submit" name="bt" value="prueba">
TEXT;
        return "<p style='color:red'>Ejecutando codigo</p><h1>$contenido</h1>.$data";
    }
}

if(!function_exists('short_code_par')){
    function short_code_par($attr, $contenido){
        $attr_def = [
            'text' => 'texto de prueba',
            'size' => '16px',
            'color'=>'blue',
            'url'=> '#'
        ];

        $attr = array_change_key_case((array)$attr, CASE_LOWER);
        extract(shortcode_atts( $attr_def, $attr), EXTR_OVERWRITE);

        return "<a href='$url'> $text </a>";
    }
}

add_shortcode( 'short_dev', 'first_short_code' );
add_shortcode( 'short_urlex', 'short_code_par' );