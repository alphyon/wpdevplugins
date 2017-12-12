<?php
/**
 * @package Custom_post_Type
 * @version 1.6
 */
/*
Plugin Name: Custom post type
Plugin URI: 
Description: 
Author: 
Version: 
Author URI: 
*/

//este tipo de elementos se carga para  mostrar post personalizados
function install_custompost_type(){

}

register_activation_hook( __FILE__, install_custompost_type );

function dev_cpt_init()
{
    $labels=[
        'name'=>'Productos',//__('prodcutos','idioma') si se quiere usar i18n
        'singular_name'=>'Prodcuto'
    ];
    $args =[
        'labels'=>$labels,
        'public'=>true,
        'has_archive'=>true, //enlazar a una pagina par mostrar items
        'supports'=>[
            'title',
            'editor',
            'thumbnail'
        ], //agregar  soprte de algunos elementos extras como imagenes
        'capability'=>'post',
        'show_in_menu'=>true, //mostrar opcion en memu superior, tambien podemos pasar el slug 
        'show_ui'=>true,
        'show_in_nav_menus'=>false,
        'show_in_admin_bar'=>false
    ];

    register_post_type( 'productos', $args );
    flush_rewrite_rules(  ); //limpia los permisos de muestra de las reglas

}

add_action( 'init', 'dev_cpt_init' );