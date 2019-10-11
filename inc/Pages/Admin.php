<?php
/**
* @package ABC Plugin
*/

namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{

    public $settings;

    public $callbacks;

    public $pages = array();

    public $subpages = array();

    public function register(){        

        $this->settings = new SettingsApi();   
        
        $this->callbacks = new AdminCallbacks();

        $this->setPages();

        $this->setSubpages();

        $this->setSettings();

        $this->setSections();

        $this->setFields();
        
        $this->settings->addPages( $this->pages )->withSubPage( 'Ветропаркове' )->
        addSubPages( $this->subpages )->register();
    }

    public function setPages(){

        $this->pages = array(
            array('page_title'=>'Ветропаркове',
                  'menu_title'=>'ВП Мениджър ',
                  'capability'=>'manage_options',
                  'menu_slug' =>'abc_plugin',
                  'callback'  => array( $this->callbacks, 'windparksDashboard' ),
                  'icon_url'  =>'dashicons-hammer',
                  'position'  => 110
            ),
        );

    }

    public function setSubpages(){

        $this->subpages = array(
            array(
                'parent_slug'=> 'abc_plugin',
                'page_title' => 'Настройки на ВП Мениджър',
                'menu_title' => 'Настройки',
                'capability' => 'manage_options',
                'menu_slug'  => 'abc_settings',
                'callback'   => array( $this->callbacks, 'abcSettings' ),
            ),
            /*array(
                'parent_slug'=> 'abc_plugin',
                'page_title' => 'Турбини',
                'menu_title' => 'списък с Турбини',
                'capability' => 'manage_options',
                'menu_slug'  => 'abc_taxonomies',
                'callback'   => array( $this->callbacks, 'turbinesDashboard' ),
            ),
            array(
                'parent_slug'=> 'abc_plugin',
                'page_title' => 'Custom Widgets',
                'menu_title' => 'Widgets',
                'capability' => 'manage_options',
                'menu_slug'  => 'abc_widgets',
                'callback'   => array( $this->callbacks, 'turbineInfo' ),
            ),*/
        );

    }

    public function setSettings(){

        $args = array(
            array(
                'option_group' => 'turbines_options_group',
                'option_name'  => 'text_example',
                'callback'     => array( $this->callbacks, 'turbinesOptionGroup' ),    
            ),
            array(
                'option_group' => 'turbines_options_group',
                'option_name'  => 'turbine_name',
            ),
        );
        
        $this->settings->setSettings( $args );

    }

    public function setSections(){

        $args = array(
            array(
                'id'        => 'turbines_admin_index',
                'title'     => 'Settings',
                'callback'  => array( $this->callbacks, 'turbinesAdminSection' ),
                'page'      => 'abc_plugin',   
            ),
        );
        
        $this->settings->setSections( $args );

    }

    public function setFields(){

        $args = array(
            array(
                'id'        => 'text_example',
                'title'     => 'Text Example',
                'callback'  => array( $this->callbacks, 'turbinesTextExample' ), 
                'page'      => 'abc_plugin',
                'section'   => 'turbines_admin_index', 
                'args'      => array(
                    'label_for' =>  'text_example',
                    'class'     =>  'example-class',
                ),  
            ),
            array(
                'id'        => 'turbine_name',
                'title'     => 'Turbine Name',
                'callback'  => array( $this->callbacks, 'turbinesTurbineName' ), 
                'page'      => 'abc_plugin',
                'section'   => 'turbines_admin_index', 
                'args'      => array(
                    'label_for' =>  'turbine_name',
                    'class'     =>  'example-class',
                ),  
            ),
        );
        
        $this->settings->setFields( $args );

    }

}

?>