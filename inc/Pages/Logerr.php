<?php
/**
* @package ABC Plugin
*/

namespace Inc\Pages;

//use \Inc\Api\SettingsApi;
//use \Inc\Base\BaseController;
//use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\TemplatesCallbacks;


class Logerr extends TemplatesCallbacks
{
    //public $callbacks;

    public $table_name;
    public $data;
    public $row;
    public $result_columns;
    public $column_titles;

    public function register()
    {
        $this->table_name = "abc_logerr";
        $this->data = array(
            "start_date"            =>  current_time( 'mysql' ),
            "end_date"              =>  $_POST["end_date"],
            "stay_time"             =>  $_POST["stay_time"],
            "windpark"              =>  $_POST["windpark"],
            "turbine_serial_number" =>  $_POST["turbine_serial_number"],
            "event_title"           =>  $_POST["event_title"],
            "working_team"          =>  $_POST["working_team"],
            "description"           =>  $_POST["description"],
            "team_arrive_date"      =>  $_POST["team_arrive_date"],
            "changed_parts"         =>  $_POST["changed_parts"],
            "dispatcher_name"       =>  wp_get_current_user()->user_login,
        );
        $this->result_columns = array(
            "start_date", "end_date", "stay_time", "windpark", "turbine_serial_number",
            "event_title", "working_team", "description", "team_arrive_date", "changed_parts",
            "dispatcher_name");
        $this->column_titles  = array(
            "Начало", "Край", "Престой", "Ветропарк", "Турбина",
            "Събитие", "Екип", "Описание", "Начало на Работа", "Подменени компоненти",
            "Диспечер"
        );
        
    }
    public function AddNew($data)
    {
        ob_start();
        echo '<form method="post" action="#">';
        echo '<table class="table table-hover">';
        echo '<tr>';
        $this->TextHeader(array(
            "name"  =>  "",
            "value" =>  "Добавяне на Събитие"
        ));
        echo '</tr>';
        echo '<tr>';

        $this->TextField(array(
            "name"      =>  "title",
            "title"     =>  "Заглавие",
            "value"     =>  (isset($data["title"])?$data["title"]:""),
            "option"    =>  "required"
        ));
        $this->TextField(array(
            "name"      =>  "description",
            "title"     =>  "Описание",
            "value"     =>  (isset($data["title"])?$data["description"]:""),            
            "option"    =>  "required"
        ));
        echo '</tr>';
        echo '<tr>';
        $this->DropDownMenu(array(
            "name"      =>  "category",
            "title"     =>  "Категория",
            "value"     =>  (isset($data["category"])?$data["category"]:""),            
            "option"    =>  "required",
            "menu_items"=>  array("Ремонт","Обслужване")
        ));
        $this->DropDownMenu(array(
            "name"      =>  "status",
            "title"     =>  "Статус",
            "value"     =>  (isset($data["status"])?$data["status"]:""),            
            "option"    =>  "required",
            "menu_items"=>  array("Изпълнено","Чакащо","Започнато изпълнение")
        ));
        echo '</tr>';
        echo '<tr>';
        $this->DropDownMenu(array(
            "name"      =>  "place",
            "title"     =>  "Място",
            "value"     =>  (isset($data["place"])?$data["place"]:""),            
            "option"    =>  "required",
            "menu_items"=>  array("База","Турбина","Обект")
        ));
        $this->DatePicker(array(
            "name"      =>  "date",
            "title"     =>  "Дата",
            "value"      =>  (isset($data["date"])?$data["date"]:"2012-05-12")
        ));
        echo '</tr>';
        echo '<tr>';
        $result_columns = array("id", "date", "title", "description", "place", "writen_by");
        $column_titles  = array("Дата", "Заглавие", "Описание", "Място", "Добавено от");
        $this->SubmitButton(array(
            "name"      =>  "save",
            "title"     =>  "Запази",
            "color"     =>  "primary",
            "icon"      =>  "glyphicon glyphicon-ok-sign"
        ));
        echo '</tr>';

        echo '</table>';
        echo '</form>';
    }
    public function ShowHeader(Type $var = null)
    {
        echo '<table>';
        echo '<tr>';
        echo '<form method="post" action="#">';
        echo '<div class="col-sm">';
        $this->TextHeader(array(
            "name"  =>  "",
            "value" =>  "Събития",
            "size"  =>  3
        ));
        echo '</div>';
        echo '<div class="col-sm">';
        $this->SubmitButton(array(
            "name"      =>  "add",
            "color"     =>  "primary",
            "icon"      =>  "glyphicon glyphicon-plus-sign",
            "title"     =>  "Добави"
        ));
        echo '</div>';
        echo '<div class="col-sm">';
        $this->TextField(array(
            "name"      =>  "search_word",
            "value"     =>  "",  
            "placeholder"   =>  "Търси за ..."
        ));
        echo '</div>';
        echo '<div class="col-sm">';
        $this->DropDownMenu(array(
            "name"      =>  "search_category",
            //"title"     =>  "Категория",
            "value"     =>  "",            
            //"option"    =>  "required",
            "menu_items"=>  array("Заглавие","Дата")
        ));
        echo '</div>';
        echo '<div class="col-sm">';
        $this->SubmitButton(array(
            "name"      =>  "search",
            "color"     =>  "primary",
            "icon"      =>  "glyphicon glyphicon-plus-sign",
            "title"     =>  "Търси"
        ));
        echo '</div>';
        echo '</form>';
        echo '</tr>';
        echo '</table>';
    }
    public function ShowRows()
    {
        ob_start();
        $results = $this->dataApi->readTable( $this->table_name, $this->result_columns);
        

        echo '<table class="table table-hover table-bordered">';
        echo "<tr>";
        for($i=0;$i<count($this->column_titles);$i++){
            
            $this->TextHeader(array(
                "name"  =>  "",
                "value" =>  $this->column_titles[$i],
                //"size"  =>  4
            ));
            
        }
        echo "</tr>";
        foreach( $results as $result ){
        //for($j=0;$j<20;$j++){
            $result = (array) $result;
            //$result[$j] = (array) $result[$j];
            echo "<tr>";
            for($i=1;$i<count($result);$i++){
            //for($i=1;$i<count($result[$j]);$i++){

                $this->TextPlane(array(
                    "name"  =>  "",
                    "value" =>  $result[$this->result_columns[$i]]
                    //"value" =>  $result[$j][$this->result_columns[$i]]
                ));
                
            }
            echo '<form method="post" action="#">';
            
            $this->TextHiddenField(array(
                "name"  =>  "row_id",
                "value" =>  $result["id"]
            ));
            $this->SubmitButton(array(
                "name"      =>  "edit",
                "color"     =>  "primary",
                "icon"      =>  "glyphicon glyphicon-open"
                //"title"     =>  "Изтрий"
            ));
            $this->SubmitButton(array(
                "name"      =>  "delete",
                "color"     =>  "danger",
                "icon"      =>  "glyphicon glyphicon-remove-sign"
                //"title"     =>  "Изтрий"
            ));
            echo "</form>";
            echo "</tr>";
        }
        echo '</table>';
        

    }
    public function EditForm($data)
    {
        ob_start();
        echo '<form method="post" action="#">';
        echo '<table class="table table-hover">';
        echo '<tr>';
        $this->TextHiddenField(array(
            "name"  =>  "id",
            "value" =>  $data["id"]
        ));
        echo '</tr>';
        echo '<tr>';

        $this->TextField(array(
            "name"      =>  "title",
            "title"     =>  "Заглавие",
            "value"     =>  $data["title"],
            "option"    =>  "readonly"
        ));
        $this->TextField(array(
            "name"      =>  "description",
            "title"     =>  "Описание",
            "value"     =>  $data["description"],
            //"disabled"  =>  "disabled"
        ));
        echo '</tr>';
        echo '<tr>';
        $this->DropDownMenu(array(
            "name"      =>  "category",
            "title"     =>  "Категория",
            "value"     =>  $data["category"],
            "menu_items"=>  array("Ремонт","Обслужване")
        ));
        $this->DropDownMenu(array(
            "name"      =>  "status",
            "title"     =>  "Статус",
            "value"     =>  $data["status"],
            "menu_items"=>  array("Изпълнено","Чакащо","Започнато изпълнение")
        ));
        echo '</tr>';
        echo '<tr>';
        $this->DropDownMenu(array(
            "name"      =>  "place",
            "title"     =>  "Място",
            "value"     =>  $data["place"],
            "disabled"  =>  "disabled",
            "menu_items"=>  array("База","Турбина","Обект")
        ));
        $this->DatePicker(array(
            "name"      =>  "date",
            "title"     =>  "Дата",
            "value"      =>  (isset($data["date"])?$data["date"]:"2012-05-12")
        ));
        echo '</tr>';
        echo '<tr>';
        $this->SubmitButton(array(
            "name"      =>  "update",
            "title"     =>  "Обнови",
            "color"     =>  "primary",
            "icon"      =>  "glyphicon glyphicon-ok-sign"
        ));
        echo '</tr>';

        echo '</table>';
        echo '</form>';
    }
}
?>