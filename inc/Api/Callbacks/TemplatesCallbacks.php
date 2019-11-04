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
    public function logerrDashboard()
    {
        return require_once( "$this->plugin_path/templates/logerr/logerr.php" );
    }

    #============================================
    public function TextField( $args )
    {
        $title          =   $args["title"];
        $name           =   $args["name"];
        $value          =   $args["value"];
        $placeholder    =   $args["placeholder"];
        $option         =   $args["option"];// required/ disabled/ readonly
        $type           =   $args["type"];
        if($title){
            echo '<th><label for="'.$name.'">'.$title.'</th>';
        }
        echo '<td><input    class="form-control"
                        type="'.$type.'"
                        value="'.$value.'"
                        name="'.$name.'"
                        placeholder="'.$placeholder.'"
                        '.$option.'></td>';
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
        $option         =   $args["required"];
        if($title){
            echo '<th><label for="'.$name.'">'.$title.'</th>';
        }
        echo '<td><textarea    class="form-control"
                        value="'.$value.'"
                        name="'.$name.'"
                        placeholder="'.$placeholder.'"
                        '.$option.'></textarea></td>';
    }
    public function DropDownMenu( $args )
    {
        $title      =   $args["title"];
        $name       =   $args["name"];
        $menu_items =   $args["menu_items"];
        $value      =   $args["value"];
        if($title){
            echo '<th><label for="'.$name.'">'.$title.'</th>';
        }
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
        $date       =   $args["date"];
        $time       =   $args["time"];
        if($title){
            echo '<th><label for="'.$name.'">'.$title.'</th>';
        }
        echo '<td>';
        echo '<input type="date" name="'.$name.'" class="form-control" value="'.$date.'">';
        echo '<input type="time" name="time_'.$name.'" class="form-control" value="'.$time.'">';
        //echo '<date-input date="{{date}}" timezone="[[timezone]]"></date-input>';
        echo '</div></div></td>';
    }
    public function TextHeader($args)
    {
        $name       =   $args["name"];
        $value      =   $args["value"];
        //$size       =   ( isset( $args["size"] ) ? $args["size"] : 3);
        echo '<th name="'.$name.'">'.$value.'</th>';
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
        $icon       =   $args["icon"];
        $color      =   $args["color"];
        $data       =   $args["data"];
        echo '
        <td>
        <button type="submit" name="'.$name.'" class="btn btn-'.$color.' btn-sm">
            <span class="'.$icon.'"></span> '.$title.'
        </button>
        </td>';
    }
    public function LinkButton($args)
    {
        $name       =   $args["name"];
        $title      =   $args["title"];
        $target     =   $args["target"];
        $icon       =   $args["icon"];
        echo '
        <td>
        <a name="'.$name.'" type="submit" href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="'.$target.'">
        <span class="'.$icon.'"></span>'.$title.'</a>
        </td>';
    }

    ####################################################3
    public function ClockCalendar()
    {
        $clockcalendar = current_time( 'mysql' );
        list( $year, $month, $day, $hour, $minute, $second ) = preg_split( "([^0-9])", $clockcalendar );
        $clockcalendar = array(
            "year"      =>  $year,
            "month"     =>  $month,
            "day"       =>  $day,
            "hour"      =>  $hour,
            "minute"    =>  $minute,
            "second"    =>  $second
        );
        return $clockcalendar;
    }
}
?>