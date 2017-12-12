<?php
/**
 * @package menu_dev
 * @version 1.o
 */
/*
Plugin Name: Menu  dev ejemplos
Plugin URI: 
Description: 
Author: 
Version: 
Author URI: 
*/

function install_menu_dev(){}
    register_activation_hook( __FILE__, 'install_menu_dev' );

    
    
    // agregar accion para asignar nuevo menu   
    add_action( 'admin_menu', 'dev_options_page');

    function dev_options_page()
    {
        //agrega un menu en la configuracion del sitio  
        add_menu_page( 
            'DEV Menu test ', 
            'Menu test', 
            'manage_options', 
            'dev_test', 
            'dev_menu_test_display', 
            plugin_dir_url( __FILE__).'img/ico.png', 
            15 );
    }

    //funcion donde definimos todo lo que se mostrara en la opcion del menu
    function dev_menu_test_display()
    {
        echo 'Menu opciones test';
    }