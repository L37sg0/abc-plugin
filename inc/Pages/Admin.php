<?php
/**
* @package ABC Plugin
*/

namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\TemplatesCallbacks;

class Admin extends BaseController
{

    public $settings;

    public $callbacks;

    public $turbineCallbacks;

    public $pages = array();

    public $subpages = array();

    public function register(){        

        $this->settings             = new SettingsApi();   
        
        $this->callbacks            = new AdminCallbacks();

        $this->templatesCallbacks   = new TemplatesCallbacks();

        $this->setPages();

        $this->setSubpages();

        /* $this->setSettings();

        $this->setSections();

        $this->setFields(); */
        
        $this->settings->addPages( $this->pages )->withSubPage( 'Ветропаркове' )->
        addSubPages( $this->subpages )->register();
    }

    public function setPages(){

        $this->pages = array(
            array('page_title'=>'Ветропаркове',
                  'menu_title'=>'ВП Мениджър ',
                  //'capability'=>'manage_options',
                  'capability'=>'read',
                  'menu_slug' =>'abc_windparks',
                  'callback'  => array( $this->templatesCallbacks, 'windparksDashboard' ),
                  'icon_url'  =>'dashicons-sos',
                  'position'  => 110
            ),
        );

    }

    public function setSubpages(){

        $this->subpages = array(
            array(
                'parent_slug'=> 'abc_windparks',
                'page_title' => 'Турбини',
                'menu_title' => 'Турбини',
                //'capability'=>'manage_options',
                'capability'=>'read',
                'menu_slug'  => 'abc_turbines',
                'callback'   => array( $this->templatesCallbacks, 'turbinesDashboard' ),
            ),
            array(
                'parent_slug'=> 'abc_windparks',
                'page_title' => 'LogErr',
                'menu_title' => 'LogErr',
                //'capability'=>'manage_options',
                'capability'=>'read',
                'menu_slug'  => 'abc_logerr',
                'callback'   => array( $this->templatesCallbacks, 'logerrDashboard' ),
            ),
            array(
                'parent_slug'=> 'abc_windparks',
                'page_title' => 'Събития',
                'menu_title' => 'Събития',
                //'capability'=>'manage_options',
                'capability'=>'read',
                'menu_slug'  => 'abc_events',
                'callback'   => array( $this->templatesCallbacks, 'eventsDashboard' ),
            ),
            array(
                'parent_slug'=> 'abc_windparks',
                'page_title' => 'Данни Реално време',
                'menu_title' => 'ДРВ',
                //'capability'=>'manage_options',
                'capability'=>'read',
                'menu_slug'  => 'abc_rtm',
                'callback'   => array( $this->templatesCallbacks, 'rtmDashboard' ),
            ),
            array(
                'parent_slug'=> 'abc_windparks',
                'page_title' => 'Настройки на ВП Мениджър',
                'menu_title' => 'Настройки',
                'capability' => 'manage_options',
                'menu_slug'  => 'abc_settings',
                'callback'   => array( $this->callbacks, 'abcSettings' ),
            )
        );

    }
/* 
    public function setSettings(){

        $args = array(
            array(
                'option_group' => 'turbines_options_group',
                'option_name'  => 'add_turbine_form',   
            ),
            array(
                'option_group' => 'turbines_options_group',
                'option_name'  => 'turbine_owner',
            ),
            array(
                'option_group' => 'turbines_options_group',
                'option_name'  => 'turbine_power',
            ),
            array(
                'option_group' => 'turbines_options_group',
                'option_name'  => 'turbine_windpark',
            ),
        );
        
        $this->settings->setSettings( $args );

    } */
/* 
    public function setSections(){

        $args = array(
            array(
                'id'        => 'turbines_admin_index',
                'title'     => 'Добавяне на Турбина',
                //'callback'  => array( $this->turbineCallbacks, 'turbinesGlobal' ),
                'page'      => 'abc_turbines',   
            ),
        );
        
        $this->settings->setSections( $args );

    } */

   /*  public function setFields(){

         $args = array(
            array(
                'id'        => 'add_turbine_form',
                'title'     => 'Име',
                'callback'  => array( $this->turbinesCallbacks, 'turbinesGlobal' ), 
                'page'      => 'abc_turbines',
                'section'   => 'turbines_admin_index',  
                'args'      => array(
                    'label_for' =>  'turbine_name',
                    'class'     =>  'example-class',
                ),  
            ),
            array(
                'id'        => 'turbine_owner',
                'title'     => 'Собственик',
                'callback'  => array( $this->turbineCallbacks, 'turbinesTurbineOwner' ), 
                'page'      => 'abc_turbines',
                'section'   => 'turbines_admin_index', 
                'args'      => array(
                    'label_for' =>  'turbine_owner',
                    'class'     =>  'example-class',
                ),  
            ),
            array(
                'id'        => 'turbine_power',
                'title'     => 'Мощност',
                'callback'  => array( $this->turbineCallbacks, 'turbinesTurbinePower' ), 
                'page'      => 'abc_turbines',
                'section'   => 'turbines_admin_index', 
                'args'      => array(
                    'label_for' =>  'turbine_power',
                    'class'     =>  'example-class',
                ),  
            ),
            array(
                'id'        => 'turbine_windpark',
                'title'     => 'Ветропарк',
                'callback'  => array( $this->turbineCallbacks, 'turbinesTurbineWindpark' ), 
                'page'      => 'abc_turbines',
                'section'   => 'turbines_admin_index', 
                'args'      => array(
                    'label_for' =>  'turbine_windpark',
                    'class'     =>  'example-class',
                ),  
            ),
            array(
                'id'        => 'turbine_description',
                'title'     => 'Описание',
                'callback'  => array( $this->turbineCallbacks, 'turbinesTurbineDescription' ), 
                'page'      => 'abc_turbines',
                'section'   => 'turbines_admin_index', 
                'args'      => array(
                    'label_for' =>  'turbine_description',
                    'class'     =>  'example-class',
                ),  
            ),
        );
        
        $this->settings->setFields( $args );

    } */

}

?>