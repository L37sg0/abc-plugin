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

        return require_once( "$this->plugin_path/templates/events/events_test.php" );
        //return require_once( "$this->plugin_path/templates/events/add_event.php" );
    
    }
    public function eventsAddNew(){

        return require_once( "$this->plugin_path/templates/events/add_event.php" );
    
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
        
        echo '<td><th><label for="'.$name.'">'.$title.'</th></td>';
        //echo '<td></td>';
        echo '<td><input    class="form-control"
                        type="'.$type.'"
                        value="'.$value.'"
                        name="'.$name.'"
                        placeholder="'.$placeholder.'"
                        '.$required.'></td>';
    }
    public function TextHiddenField( $args )
    {
        $name           =   $args["name"];
        $value          =   $args["value"];
        echo '<td><input
                        class="form-control"
                        type="hidden"
                        value="'.$value.'"
                        name="'.$name.'"></td>';
    }
    public function TextAreaField($args)
    {
        $title          =   $args["title"];
        $name           =   $args["name"];
        $value          =   $args["value"];
        $placeholder    =   $args["placeholder"];
        $required       =   $args["required"];
        echo '<td><th><label for="'.$name.'">'.$title.'</th></td>';
        echo '<td></td>';
        echo '<td><input    class="form-control"
                        value="'.$value.'"
                        name="'.$name.'"
                        placeholder="'.$placeholder.'"
                        '.$required.'></td>';
    }
    public function DropDownMenu( $args )
    {
        $title      =   $args["title"];
        $name       =   $args["name"];
        $menu_items =   $args["menu_items"];
        $value      =   $args["value"];

        echo '<td><th><label for="'.$name.'">'.$title.'</th></td>';
        //echo '<td></td>';
        echo '<td><select name="'.$name.'" class="form-control">';
        echo '<option value="'.$value.'" selected>'.$value.'</option>';
        foreach($menu_items as $item){
            if( $item != $value ){
                echo '<option value="'.$item.'">'.$item.'</option>';
            }
        }
        echo '</select></td>';
    }
    public function DatePicker($args)
    {
        $title      =   $args["title"];
        $name       =   $args["name"];
        $value      =   $args["value"];
        echo '<td><th><label for="'.$name.'">'.$title.'</th></td>';
        //echo '<td></td>';
        echo '<td>';
        echo '<input type="date" class="form-control" value="'.$value.'">';
        echo '</div></div></td>';
    }
    public function TextHeader($args)
    {
        $name       =   $args["name"];
        $value      =   $args["value"];
        echo '<td><th name="'.$name.'">'.$value.'</th></td>';
    }
    public function TextPlane($args)
    {
        $name       =   $args["name"];
        $value      =   $args["value"];
        echo '<td><p name="'.$name.'">'.$value.'</p></td>';
        
    }
    public function SubmitButton($args)
    {
        $name       =   $args["name"];
        $title      =   $args["title"];
        echo '
        <td></td>
        <td>
        <button type="submit" name="'.$name.'" class="btn btn-primary">
            <span class="glyphicon glyphicon-ok-sign"></span> '.$title.'
        </button>
        </td>';
    }
    public function EditButton($args)
    {
        $name       =   $args["name"];
        $title      =   $args["title"];
        echo '
        <td>
        <button type="submit" name="'.$name.'" class="btn btn-primary">
            <span class="glyphicon glyphicon-open"></span> '.$title.'
        </button>
        </td>';
    }
    public function DeleteButton($args)
    {
        $name       =   $args["name"];
        $title      =   $args["title"];
        echo '
        <td>
        <button type="submit" name="'.$name.'" class="btn btn-danger">
            <span class="glyphicon glyphicon-remove-sign"></span> '.$title.'
        </button>
        </td>';
    }
}
?>