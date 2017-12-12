<?php

/**
 * @package api_dev_tes
 * @version 1.0
 */
/*
Plugin Name: Test Api Settings
Plugin URI: 
Description: 
Author: 
Version: 
Author URI: 
*/

function install_api_dev(){}
register_activation_hook( __FILE__, 'install_api_dev' );

function api_dev_filter($valor){
    $valor["Configuracion1"] = "_apidev_".$valor["Configuracion1"];
    $valor["Configuracion2"] = "_apidev_".$valor["Configuracion2"];
    return $valor;
}
// hacer registro de configuraciones, los dos primeros parametros son obligatorios 
function dev_settings_init()
{
    $args = [
        'sanitize_callback'=>'api_dev_filter',
        'default'=>'Esta opcion no se encuentra registrada'
    ];
    //resgirar una nueva configuracion en pagina general
    register_setting( 'general', 'first_config_dev', $args );

    //registratr  una nueva seccion para pagina general

    add_settings_section( "dev_config_section", 
    "Primera Configuracion", 
    "dev_config_section_cb",
    'general');

//cargar un campo para configuracion 

    add_settings_field(
        'dev_config_field1', 
        'Configuracion1', 
        "dev_config_field_cb", 
        "general",  
        'dev_config_section',
        [//este array es opcional para definir configuraciones, pero seria obligatorio cuando se quiere procesar mas de un valor de configuracion a registrar
            'label_for'=>'Configuracion1',
            'class'=>'clase_campo',
            'dev_data_custom'=>'dato personalizado'
        ]);
        add_settings_field(
            'dev_config_field2', 
            'Configuracion2', 
            "dev_config_field2_cb", 
            "general",  
            'dev_config_section',
            [//este array es opcional para definir configuraciones, pero seria obligatorio cuando se quiere procesar mas de un valor de configuracion a registrar
                'label_for'=>'Configuracion2',
                'class'=>'clase_campo',
                'dev_data_custom'=>'dato personalizado'
            ]);
}

//creamos una entrada a la tabla opciones de la base de datos, con el nombre
//clave siendo este el segundo parametro del add_action 
add_action( 'admin_init', 'dev_settings_init');

function dev_config_section_cb()
{
    echo "<h1>Configuracion Pruebas </h1>";
}
//se pasa valor si el caso es de mas de un parametro para ser procesado 
function dev_config_field_cb($args)
{
    // recueprar el valor de una configuracion por medio de su clave
    $devconfig  = get_option('first_config_dev');
    $devconfig = isset($devconfig[$args['label_for']]) ? esc_attr( $devconfig[$args['label_for']] ) :'';
    $output = "<input type='text' 
    name='first_config_dev[{$args['label_for']}]' 
    value='$devconfig' />";
    echo $output;
}
function dev_config_field2_cb($args)
{
    // recueprar el valor de una configuracion por medio de su clave
    $devconfig  = get_option('first_config_dev');
    $devconfig = isset($devconfig[$args['label_for']]) ? esc_attr( $devconfig[$args['label_for']] ) :'';
    $output = "<input type='text' 
    name='first_config_dev[{$args['label_for']}]' 
    value='$devconfig' />";
    echo $output;
}


// guardar datos en la tabla de opciones de wp
$datos = "Este es un dato para almacenar";
add_option( 'option_custom', $datos);

$datos_arr = [
    "valor 1",
    15,
    false,
    "titulo"=> "este es un titulo"
];

//add_option( 'array_options', $datos_arr);
//actualizar una opcion creada
update_option( 'array_options', $datos_arr );

//obtener los datos de una opcion almacenada, el segundo parametro es un valor por defecto 
get_option( 'array_options', 'este dato no se encontro en db' );

//quitamos una opcion de la tabla de la base de datos
delete_option( 'array_options' );