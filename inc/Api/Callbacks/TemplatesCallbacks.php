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

        return require_once( "$this->plugin_path/templates/objects/turbines/turbines.php" );
    
    }

    public function windparksDashboard(){

        return require_once( "$this->plugin_path/templates/objects/windparks/windparks.php" );
    
    }
    public function substationsDashboard(){

        return require_once( "$this->plugin_path/templates/objects/substations/substations.php" );
    
    }
    public function outletsDashboard(){

        return require_once( "$this->plugin_path/templates/objects/outlets/outlets.php" );
    
    }
    public function switchgearsDashboard(){

        return require_once( "$this->plugin_path/templates/objects/switchgears/switchgears.php" );
    
    }
    public function othersDashboard(){

        return require_once( "$this->plugin_path/templates/objects/others/others.php" );
    
    }

    public function eventsDashboard(){

        return require_once( "$this->plugin_path/templates/management/events/events.php" );
    
    }
    
    public function rtmDashboard()
    {
        return require_once( "$this->plugin_path/templates/management/rtm/rtm.php" );
    }

    public function logerrDashboard()
    {
        return require_once( "$this->plugin_path/templates/management/logerr/logerr.php" );
    }
    public function interruptionsDashboard()
    {
        return require_once( "$this->plugin_path/templates/management/interruptions/interruptions.php" );
    }
    public function messagesDashboard()
    {
        return require_once( "$this->plugin_path/templates/management/messages/messages.php" );
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
        $option         =   $args["option"];
        $type           =   "text";
        if($title){
            echo '<th><label for="'.$name.'">'.$title.'</th>';
        }
        echo '<td><textarea    class="form-control"
            rows="5"
            cols="40"
            type="'.$type.'"
            name="'.$name.'"
            placeholder="'.$placeholder.'"
            '.$option.'>'.$value.'</textarea></td>';
    }
    public function DropDownMenu( $args )
    {
        $title      =   $args["title"];
        $name       =   $args["name"];
        $menu_items =   $args["menu_items"];
        $value      =   $args["value"];
        $option     =   $args["option"];
        if($title){
            echo '<th><label for="'.$name.'">'.$title.'</th>';
        }
        echo '<td><select name="'.$name.'" class="form-control" '.$option.'>';
        echo '<option value="'.$value.'" selected>'.$value.'</option>';
        foreach($menu_items as $item){
            if( $item != $value ){
                echo '<option value="'.$item.'">'.$item.'</option>';
            }
        }
        echo '</select></td>';
    }/* 
    public function DropDownMenu( $args )
    {
        $title      =   $args["title"];
        $name       =   $args["name"];
        $menu_items =   $args["menu_items"];
        $value      =   $args["value"];
        $option     =   $args["option"];
        if($title){
            echo '<th><label for="'.$name.'">'.$title.'</th>';
        }
        echo '<td><select name="'.$name.'" class="form-control" '.$option.'>';
        echo '<option value="'.$value.'" selected>'.$value.'</option>';
        foreach($menu_items as $item){
            if( $item["id"] != $value ){
                echo '<option value="'.$item["id"].'">'.$item["name"].'</option>';
            }
        }
        echo '</select></td>';
    } */
    public function MultiSelectMenu( $args )
    {
        $title      =   $args["title"];
        $name       =   $args["name"];
        $menu_items =   $args["menu_items"];
        $value      =   $args["value"];
        if($title){
            echo '<th><label for="'.$name.'">'.$title.'</th>';
        }
        echo '      
          <td><select class="mdb-select colorful-select dropdown-primary md-form" multiple searchable="Search here..">
            <option value="" disabled selected>Избери екип</option>';
            foreach($menu_items as $item){
                if( $item != $value ){
                    echo '<option value="'.$item.'">'.$item.'</option>';
                }
            }
          echo '</select></td>
      ';
    }
    public function DatePicker($args)
    {
        $title      =   $args["title"];
        $name       =   $args["name"];
        $date       =   $args["date"];
        if($title){
            echo '<th><label for="'.$name.'">'.$title.'</th>';
        }
        echo '<td>';
        echo '<input type="date" name="'.$name.'" class="form-control" value="'.$date.'">';
        echo '</td>';
    }
    public function TimeResult($args)
    {
        $title          =   $args["title"];
        $name           =   $args["name"];
        $first          =   $args["first"];
        $second         =   $args["second"];
        if($title){
            echo '<th><label for="'.$name.'">'.$title.'</th>';
        }
        echo '<td>';
        echo '<input type="text" onClick="CalculateTime('.$first.','.$second.','.$name.');" name="'.$name.'" class="form-control" value="">';
        echo '</td>';
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
        echo '
        <td>
        <button type="submit" name="'.$name.'" class="btn btn-'.$color.' btn-sm">
            <span class="'.$icon.'"></span> '.$title.'
        </button>
        </td>';/* 
        echo '
        <td>
        <button type="submit" name="" class="btn btn-danger btn-sm">
            <span class="'.$icon.'"></span> Отказ
        </button>
        </td>'; */
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

    public function PrintButton($args)
    {
        $name       =   $args["name"];
        $title      =   $args["title"];
        $icon       =   $args["icon"];
        $color      =   $args["color"];
        $data       =   $args["data"];
        ?> 
        <td>
        <button onClick="PrintElem('logs');" type="submit" name="<?php echo $name; ?>" class="btn btn-<?php echo $color; ?> btn-sm">
            <span class="<?php echo $icon; ?>"></span> <?php echo $title; ?>
        </button>
        </td>
    <?php
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