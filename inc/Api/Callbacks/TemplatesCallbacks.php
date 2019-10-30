<?php
/**
* @package ABC Plugin
* This API handles and routes callbacks from templates
*/

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class TemplatesCallbacks extends BaseController
{

    public function turbinesDashboard(){

        return require_once( "$this->plugin_path/templates/turbines/turbines.php" );
        //return require_once( "$this->plugin_path/templates/turbines/add_turbine.php" );
    
    }
    public function turbinesAddNew(){

        return require_once( "$this->plugin_path/templates/turbines/add_turbine.php" );
    
    }

    public function windparksDashboard(){

        return require_once( "$this->plugin_path/templates/windparks/windparks.php" );
        //return require_once( "$this->plugin_path/templates/turbines/add_turbine.php" );
    
    }
    public function windparksAddNew(){

        return require_once( "$this->plugin_path/templates/windparks/add_windpark.php" );
    
    }

    public function eventsDashboard(){

        return require_once( "$this->plugin_path/templates/events/events.php" );
        //return require_once( "$this->plugin_path/templates/events/add_event.php" );
    
    }
    public function eventsAddNew(){

        return require_once( "$this->plugin_path/templates/events/events_test.php" );
    
    }
    public function eventsEdit(){

        return require_once( "$this->plugin_path/templates/events/edit_event.php" );
    
    }
    
    public function rtmDashboard()
    {
        return require_once( "$this->plugin_path/templates/rtm/rtm.php" );
    }

    public function testDashboard()
    {
        return require_once( "$this->plugin_path/templates/turbines/turbines_test.php" );
    }

    #============================================
    public function TextField( $args )
    {
        $title          =   $args["title"];
        $name           =   $args["name"];
        $value          =   $args["value"];
        $placeholder    =   $args["placeholder"];
        $required       =   $args["required"];
        $type           =   $args["type"];
        echo '<tr>';
        echo '<td><th><label for="'.$name.'">'.$title.'</th></td>';
        echo '<td></td>';
        echo '<td><input    class="form-control"
                        type="'.$type.'"
                        value="'.$value.'"
                        name="'.$name.'"
                        placeholder="'.$placeholder.'"
                        '.$required.'></td>';
        echo '</tr>';
    }
    public function TextHiddenField( $args )
    {
        $name           =   $args["name"];
        $value          =   $args["value"];
        echo '<tr>';
        echo '<td><input
                        class="form-control"
                        type="hidden"
                        value="'.$value.'"
                        name="'.$name.'"></td>';
        echo '</tr>';
    }
    public function TextAreaField($args)
    {
        $title          =   $args["title"];
        $name           =   $args["name"];
        $value          =   $args["value"];
        $placeholder    =   $args["placeholder"];
        $required       =   $args["required"];
        echo '<tr>';
        echo '<td><th><label for="'.$name.'">'.$title.'</th></td>';
        echo '<td></td>';
        echo '<td><input    class="form-control"
                        value="'.$value.'"
                        name="'.$name.'"
                        placeholder="'.$placeholder.'"
                        '.$required.'></td>';
        echo '</tr>';
    }
    public function DropDownMenu( $args )
    {
        $title      =   $args["title"];
        $name       =   $args["name"];
        $menu_items =   $args["menu_items"];
        $value      =   $args["value"];

        echo '<tr>';
        echo '<td><th><label for="'.$name.'">'.$title.'</th></td>';
        echo '<td></td>';
        echo '<td><select name="'.$name.'" class="form-control">';
        echo '<option value="'.$value.'" selected>'.$value.'</option>';
        foreach($menu_items as $item){
            if( $item != $value ){
                echo '<option value="'.$item.'">'.$item.'</option>';
            }
        }
        echo '</select></td>';
        echo '</tr>';
    }
    public function DatePicker($args)
    {
        $title      =   $args["title"];
        $name       =   $args["name"];
        $value      =   $args["value"];
        echo '<tr>';
        echo '<td><th><label for="'.$name.'">'.$title.'</th></td>';
        echo '<td></td>';
        echo '<td>';
        echo '<input type="date" class="form-control" value="'.$value.'">';
        echo '</div></div></td>';
        echo '</tr>';
    }
    public function TextHeader($args)
    {
        $name       =   $args["name"];
        $value      =   $args["value"];
        echo '<td><th name="'.$name.'">'.$value.'</th></td>';
        # code...
    }
    public function TextPlane($args)
    {
        $name       =   $args["name"];
        $value      =   $args["value"];
        echo '<p>'.$value.'</p>';
        # code...
    }
    public function SubmitButton($args)
    {
        $name       =   $args["name"];
        $title      =   $args["title"];
        $class      =   $args["class"];
        echo '<button name="'.$name.'" class="'.$class.'" type="submit">'.$title.'</button>';
    }
}
?>