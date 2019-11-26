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
            array('page_title'=>'Обекти',
                  'menu_title'=>'Обекти',
                  //'capability'=>'manage_options',
                  'capability'=>'read',
                  'menu_slug' =>'abc_windparks',
                  'callback'  => array( $this->templatesCallbacks, 'windparksDashboard' ),
                  'icon_url'  =>'dashicons-sos',
                  'position'  => 110
            ),
            array('page_title'=>'Мениджмънт',
                  'menu_title'=>'Мениджмънт',
                  //'capability'=>'manage_options',
                  'capability'=>'read',
                  'menu_slug' =>'abc_management',
                  'callback'  => array( $this->templatesCallbacks, 'messagesDashboard' ),
                  'icon_url'  =>'dashicons-admin-post',
                  'position'  => 112
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
                'page_title' => 'Подстанции',
                'menu_title' => 'Подстанции',
                //'capability'=>'manage_options',
                'capability'=>'read',
                'menu_slug'  => 'abc_substations',
                'callback'   => array( $this->templatesCallbacks, 'substationsDashboard' ),
            ),
            array(
                'parent_slug'=> 'abc_windparks',
                'page_title' => 'Изводи',
                'menu_title' => 'Изводи',
                //'capability'=>'manage_options',
                'capability'=>'read',
                'menu_slug'  => 'abc_outlets',
                'callback'   => array( $this->templatesCallbacks, 'outletsDashboard' ),
            ),
            array(
                'parent_slug'=> 'abc_windparks',
                'page_title' => 'Уредби',
                'menu_title' => 'Уредби',
                //'capability'=>'manage_options',
                'capability'=>'read',
                'menu_slug'  => 'abc_switchgears',
                'callback'   => array( $this->templatesCallbacks, 'switchgearsDashboard' ),
            ),
            array(
                'parent_slug'=> 'abc_windparks',
                'page_title' => 'Обекти',
                'menu_title' => 'Обекти',
                //'capability'=>'manage_options',
                'capability'=>'read',
                'menu_slug'  => 'abc_others',
                'callback'   => array( $this->templatesCallbacks, 'othersDashboard' ),
            ),
            array(
                'parent_slug'=> 'abc_windparks',
                'page_title' => 'Настройки на ВП Мениджър',
                'menu_title' => 'Настройки',
                'capability' => 'manage_options',
                'menu_slug'  => 'abc_settings',
                'callback'   => array( $this->callbacks, 'abcSettings' ),
            ),
            array(
                'parent_slug'=> 'abc_management',
                'page_title' => 'LogErr',
                'menu_title' => 'LogErr',
                //'capability'=>'manage_options',
                'capability'=>'read',
                'menu_slug'  => 'abc_logerr',
                'callback'   => array( $this->templatesCallbacks, 'logerrDashboard' ),
            ),/* 
            array(
                'parent_slug'=> 'abc_management',
                'page_title' => 'Съобщения',
                'menu_title' => 'Съобщения',
                //'capability'=>'manage_options',
                'capability'=>'read',
                'menu_slug'  => 'abc_messages',
                'callback'   => array( $this->templatesCallbacks, 'messagesDashboard' ),
            ), */
            array(
                'parent_slug'=> 'abc_management',
                'page_title' => 'Събития',
                'menu_title' => 'Събития',
                'capability'=>'manage_options',
                //'capability'=>'read',
                'menu_slug'  => 'abc_events',
                'callback'   => array( $this->templatesCallbacks, 'eventsDashboard' ),
            ),
            array(
                'parent_slug'=> 'abc_management',
                'page_title' => 'Данни Реално време',
                'menu_title' => 'ДРВ',
                'capability'=>'manage_options',
                //'capability'=>'read',
                'menu_slug'  => 'abc_rtm',
                'callback'   => array( $this->templatesCallbacks, 'rtmDashboard' ),
            ),
            array(
                'parent_slug'=> 'abc_management',
                'page_title' => 'Мрежови Прекъсвания',
                'menu_title' => 'Мрежови Прекъсвания',
                'capability'=>'manage_options',
                //'capability'=>'read',
                'menu_slug'  => 'abc_interruptions',
                'callback'   => array( $this->templatesCallbacks, 'interruptionsDashboard' ),
            )
        );

    }

}

?>