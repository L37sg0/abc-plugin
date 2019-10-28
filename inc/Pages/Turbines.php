<?php
/**
* @package ABC Plugin
*/

namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\TemplatesCallbacks;

//$this->turbines_dd = array();

class Turbines extends BaseController
{
    public $settings;

    public $callbacks;

    public $templatesCallbacks;

    public $pages = array();

    public $subpages = array();

    public function register(){        

        $this->settings             = new SettingsApi();   
        
        $this->callbacks            = new AdminCallbacks();

        $this->templatesCallbacks   = new TemplatesCallbacks();

        //$this->setSubpages();

        $this->setSettings();

        $this->setSections();

        $this->setFields();
        
        $this->settings->addSubPages( $this->subpages )->register();
    }

    public function setSubpages(){

        $this->subpages = array(
            array(
                'parent_slug'=> 'abc_windparks',
                'page_title' => 'Турбини TEst',
                'menu_title' => 'Турбини TEst',
                'capability'=>'manage_options',
                //'capability'=>'read',
                'menu_slug'  => 'abc_turbines_test',
                'callback'   => array( $this->templatesCallbacks, 'testDashboard' ),
            )
        );
        echo '<script>console.log("'. $this->subpages[0]["parent_slug"] .'");</script>';

    }

    public function setSettings(){

        $args = array(
            array(
                'option_group' => 'turbines_settings',
                'option_name'  => 'turbines_settings_name',   
            )
        );
        
        $this->settings->setSettings( $args );

    }

    public function setSections(){

        $args = array(
            array(
                'id'        => 'turbines_list_section',
                'title'     => 'Турбини',
                //'callback'  => array( $this->templatesCallbacks, 'turbinesGlobal' ),
                'page'      => 'abc_turbines_test',   
            ),
        );
        
        $this->settings->setSections( $args );

    }

     public function setFields(){

        $windpark_names = [];
        $results = $this->dataApi->readTable("abc_windparks", array("id","name"));
        foreach($results as $result){
            $result = (array) $result;
            array_push( $windpark_names, $result["name"] );
        }

        $args = array(
            array(
                'id'        => 'id',
                'callback'  => array( $this->templatesCallbacks, 'TextField' ), 
                'page'      => 'abc_turbines_test',
                'section'   => 'turbines_list_section',  
                'args'      => array(
                    'name'  =>  'id',
                    'value' =>  isset( $this->turbines_dd["id"] ) ? $this->turbines_dd["id"] : '',
                    'type'  =>  'hidden'
                ),  
            ),
            array(
                'id'        => 'name',
                'title'     => 'Име',
                'callback'  => array( $this->templatesCallbacks, 'TextField' ), 
                'page'      => 'abc_turbines_test',
                'section'   => 'turbines_list_section',  
                'args'      => array(
                    'label_for'     =>  'name',
                    'name'          =>  'name',
                    'class'         =>  'example-label_forclass',
                    'placeholder'   =>  'Въведи име на турбина',
                    'required'      =>  'required',
                    'value' =>  isset( $this->turbines_dd["name"] ) ? $this->turbines_dd["name"] : 'Turbinata',
                ),  
            ),
            array(
                'id'        => 'serial_number',
                'title'     => 'Сериен Номер',
                'callback'  => array( $this->templatesCallbacks, 'TextField' ), 
                'page'      => 'abc_turbines_test',
                'section'   => 'turbines_list_section',  
                'args'      => array(
                    'label_for'     =>  'serial_number',
                    'name'          =>  'serial_number',
                    'class'         =>  'example-class',
                    'required'      =>  'required',
                ),  
            ),
            array(
                'id'        => 'vendor',
                'title'     => 'Производител',
                'callback'  => array( $this->templatesCallbacks, 'DropDownMenu' ), 
                'page'      => 'abc_turbines_test',
                'section'   => 'turbines_list_section', 
                'args'      => array(
                    'label_for' =>  'vendor',
                    'name'      =>  'vendor',
                    'class'     =>  'example-class',
                    //'value'     =>  'Милениум',
                    'menu_items'    => array( "Vestas","Nordtank","Neg Micon","Power Wind","Micon","Nordex","HSW","An Bonus" )
                ),  
            ),
            array(
                'id'        => 'model',
                'title'     => 'Модел/Тип',
                'callback'  => array( $this->templatesCallbacks, 'TextField' ), 
                'page'      => 'abc_turbines_test',
                'section'   => 'turbines_list_section', 
                'args'      => array(
                    'label_for'     =>  'model',
                    'name'          =>  'model',
                    'class'         =>  'example-class',
                    'required'      =>  'required',
                ),  
            ),
            array(
                'id'        => 'power',
                'title'     => 'Мощност в MW',
                'callback'  => array( $this->templatesCallbacks, 'TextField' ), 
                'page'      => 'abc_turbines_test',
                'section'   => 'turbines_list_section', 
                'args'      => array(
                    'label_for'     =>  'power',
                    'name'          =>  'power',
                    'class'         =>  'example-class',
                    'required'      =>  'required',
                ),  
            ),
            array(
                'id'        => 'owner',
                'title'     => 'Собственик',
                'callback'  => array( $this->templatesCallbacks, 'TextField' ), 
                'page'      => 'abc_turbines_test',
                'section'   => 'turbines_list_section', 
                'args'      => array(
                    'label_for'     =>  'owner',
                    'name'          =>  'owner',
                    'class'         =>  'example-class',
                    'required'      =>  'required',
                ),  
            ),
            array(
                'id'        => 'windpark',
                'title'     => 'Ветропарк',
                'callback'  => array( $this->templatesCallbacks, 'DropDownMenu' ), 
                'page'      => 'abc_turbines_test',
                'section'   => 'turbines_list_section', 
                'args'      => array(
                    'label_for'     =>  'windpark',
                    'name'          =>  'windpark',
                    'class'         =>  'example-class',
                    //'value'         =>  'Арко',
                    'menu_items'    => $windpark_names,
                ),  
            ),
            array(
                'id'        => 'gearbox_vendor',
                'title'     => 'Производител - Скоростна Кутия',
                'callback'  => array( $this->templatesCallbacks, 'TextField' ), 
                'page'      => 'abc_turbines_test',
                'section'   => 'turbines_list_section', 
                'args'      => array(
                    'label_for' =>  'gearbox_vendor',
                    'name'      =>  'gearbox_vendor',
                    'class'     =>  'example-class',
                ),  
            ),
            array(
                'id'        => 'gearbox_number',
                'title'     => 'Сериен № - Скоростна Кутия',
                'callback'  => array( $this->templatesCallbacks, 'TextField' ), 
                'page'      => 'abc_turbines_test',
                'section'   => 'turbines_list_section', 
                'args'      => array(
                    'label_for' =>  'gearbox_number',
                    'name'      =>  'nagearbox_numberme',
                    'class'     =>  'example-class',
                ),  
            ),
            array(
                'id'        => 'hydraulics_vendor',
                'title'     => 'Производител - Хидравлика',
                'callback'  => array( $this->templatesCallbacks, 'TextField' ), 
                'page'      => 'abc_turbines_test',
                'section'   => 'turbines_list_section', 
                'args'      => array(
                    'label_for' =>  'hydraulics_vendor',
                    'name'      =>  'hydraulics_vendor',
                    'class'     =>  'example-class',
                ),  
            ),
            array(
                'id'        => 'hydraulics_number',
                'title'     => 'Сериен № - Хидравлика',
                'callback'  => array( $this->templatesCallbacks, 'TextField' ), 
                'page'      => 'abc_turbines_test',
                'section'   => 'turbines_list_section', 
                'args'      => array(
                    'label_for' =>  'hydraulics_number',
                    'name'      =>  'hydraulics_number',
                    'class'     =>  'example-class',
                ),  
            ),
            array(
                'id'        => 'generator_vendor',
                'title'     => 'Производител - Генератор',
                'callback'  => array( $this->templatesCallbacks, 'TextField' ), 
                'page'      => 'abc_turbines_test',
                'section'   => 'turbines_list_section', 
                'args'      => array(
                    'label_for' =>  'generator_vendor',
                    'name'      =>  'generator_vendor',
                    'class'     =>  'example-class',
                ),  
            ),
            array(
                'id'        => 'generator_number',
                'title'     => 'Сериен № - Генератор',
                'callback'  => array( $this->templatesCallbacks, 'TextField' ), 
                'page'      => 'abc_turbines_test',
                'section'   => 'turbines_list_section', 
                'args'      => array(
                    'label_for' =>  'generator_number',
                    'name'      =>  'generator_number',
                    'class'     =>  'example-class',
                ),  
            ),
            array(
                'id'        => 'transformer_vendor',
                'title'     => 'Производител - Трансформатор',
                'callback'  => array( $this->templatesCallbacks, 'TextField' ), 
                'page'      => 'abc_turbines_test',
                'section'   => 'turbines_list_section', 
                'args'      => array(
                    'label_for' =>  'transformer_vendor',
                    'name'      =>  'namtransformer_vendore',
                    'class'     =>  'example-class',
                ),  
            ),
            array(
                'id'        => 'transformer_number',
                'title'     => 'Сериен № - Трансформатор',
                'callback'  => array( $this->templatesCallbacks, 'TextField' ), 
                'page'      => 'abc_turbines_test',
                'section'   => 'turbines_list_section', 
                'args'      => array(
                    'label_for' =>  'transformer_number',
                    'name'      =>  'transformer_number',
                    'class'     =>  'example-class',
                ),  
            ),
        );
        
        $this->settings->setFields( $args );

    } 
}