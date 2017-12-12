<?php
/**
 * @package config_custom_full_dev
 * @version 1.6
 */
/*
Plugin Name: Pagina de configuracion completa
Plugin URI: 
Description: 
Author: 
Version: 
Author URI: 
*/

function install_configfull_dev(){}
    register_activation_hook( __FILE__, 'install_configfull_dev' );

    
    
    // agregar accion para asignar nuevo menu   
    add_action( 'admin_menu', 'dev_options_page_full');

    function dev_options_page_full()
    {
        //agrega un menu en la configuracion del sitio  
        add_menu_page( 
            'DEV Menu Config test ', 
            'Menu Config test', 
            'manage_options', 
            'dev_config_full', 
            'dev_menu_test_display_full', 
            plugin_dir_url( __FILE__).'img/ico.png', 
            15 );
    }

    //funcion donde definimos todo lo que se mostrara en la opcion del menu
    function dev_menu_test_display_full()
    {
        if(current_user_can( 'manage_options' )){
            if(isset($_GET['settings-updated'])){
            //se llama el componente para mostrar los mensajes 
                add_settings_error( 
                    'dev_config_full', 
                    'dev_config_full', 
                    'Guardada', 
                    'updated' );
            }
            settings_errors( 'dev_config_full');
            ?>
            <form action="options.php" method="post">
            <?php
            //se configuran los parametros para poder enviarse
            settings_fields( 'dev_config_full' );
            //se carga como valor de la vista 
            do_settings_sections( 'dev_config_full' );
            submit_button( "Guardar");
            ?>
            </form>
            <?php
        }
    }


    function api_dev_filter_full($valor){
        $valor["Configuracion1"] = $valor["Configuracion1"];
        $valor["Configuracion2"] = $valor["Configuracion2"];
        return $valor;
    }

    function dev_settings_init_full()
    {
        $args = [
            'sanitize_callback'=>'api_dev_filter_full',
            'default'=>'Esta opcion no se encuentra registrada'
        ];
        //resgirar una nueva configuracion en pagina general
        register_setting( 'dev_config_full', 'first_config_dev_full', $args );
    
        //registratr  una nueva seccion para pagina general
    
        add_settings_section( "dev_config_section_full", 
        "Primera Configuracion", 
        "dev_config_section_cb_full",
        'dev_config_full');
    
    //cargar un campo para configuracion 
    
        add_settings_field(
            'dev_config_field1_full', 
            'Configuracion1', 
            "dev_config_field_cb_full", 
            "dev_config_full",  
            'dev_config_section_full',
            [//este array es opcional para definir configuraciones, pero seria obligatorio cuando se quiere procesar mas de un valor de configuracion a registrar
                'label_for'=>'Configuracion1',
                'class'=>'clase_campo',
                'dev_data_custom'=>'dato personalizado'
            ]);
            add_settings_field(
                'dev_config_field2_full', 
                'Configuracion2', 
                "dev_config_field2_cb_full", 
                "dev_config_full",  
                'dev_config_section_full',
                [//este array es opcional para definir configuraciones, pero seria obligatorio cuando se quiere procesar mas de un valor de configuracion a registrar
                    'label_for'=>'Configuracion2',
                    'class'=>'clase_campo',
                    'dev_data_custom'=>'dato personalizado'
                ]);
    }
    
    //creamos una entrada a la tabla opciones de la base de datos, con el nombre
    //clave siendo este el segundo parametro del add_action 
    add_action( 'admin_init', 'dev_settings_init_full');
    
    function dev_config_section_cb_full()
    {
        echo "<h1>Configuracion Pruebas </h1>";
    }
    //se pasa valor si el caso es de mas de un parametro para ser procesado 
    function dev_config_field_cb_full($args)
    {
        // recueprar el valor de una configuracion por medio de su clave
        $devconfig  = get_option('first_config_dev_full');
        $devconfig = isset($devconfig[$args['label_for']]) ? esc_attr( $devconfig[$args['label_for']] ) :'';
        $output = "<input type='text' 
        name='first_config_dev_full[{$args['label_for']}]' 
        value='$devconfig' />";
        echo $output;
    }
    function dev_config_field2_cb_full($args)
    {
        // recueprar el valor de una configuracion por medio de su clave
        $devconfig  = get_option('first_config_dev_full');
        $devconfig = isset($devconfig[$args['label_for']]) ? esc_attr( $devconfig[$args['label_for']] ) :'';
        $output = "<input type='text' 
        name='first_config_dev_full[{$args['label_for']}]' 
        value='$devconfig' />";
        echo $output;
    }