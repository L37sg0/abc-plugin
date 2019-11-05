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
    public $result_columns;
    public $column_titles;
    public $windpark_names;
    public $pageController;
    public $perPageLimit;
    public $result_data;
    public $page;
    public $search_word;
    public $search_category;

    public function register()
    {        
        $this->table_name = "abc_logerr";
        $this->data = array(
            "start_date"            =>  $_POST["start_date"],//current_time( 'mysql' ),
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
            "id","start_date","end_date","stay_time","windpark",
            "turbine_serial_number","event_title","working_team",//"description",
            "team_arrive_date","changed_parts",
            "dispatcher_name");
        $this->column_titles  = array(
            "Начало", "Край", "Престой", "Ветропарк", "Турбина",
            "Събитие", "Екип", //"Описание",
            "Начало на Работа", "Подменени компоненти",
            "Диспечер"
        );
        $this->search_word = null;
        $this->search_category=null;

        $this->windpark_names = [];
        $results = $this->dataApi->readTable("abc_windparks", array("id","name"));
        foreach($results as $result){
            $result = (array) $result;
            array_push( $this->windpark_names, $result["name"] );
        }

        $this->perPageLimit = 20;
        $this->page = 1;

        $this->result_data = $this->cutDataOnPages( $this->table_name, $this->result_columns, $this->perPageLimit, $this->search_category, $this->search_word );
        //$this->ShowPageNavigator();
        $this->ShowPages($this->result_data,$this->page);
        
    }
    public function AddNew()
    {
        $clock = $this->ClockCalendar();

        ob_start();
        echo '<form method="post" action="#">';
        echo '<table class="table table-hover">';
        echo '<tr>';
        $this->TextHeader(array(
            "name"  =>  "",
            "value" =>  "Добавяне на Log"
        ));
        echo '</tr>';
        echo '<tr>';

        $this->DatePicker(array(
            "name"      =>  "start_date",
            "title"     =>  "Начало",
            "date"     =>  $clock["year"]."-".$clock["month"]."-".$clock["day"],
            "time"     =>  $clock["hour"].":".$clock["minute"],
        ));
        $this->DatePicker(array(
            "name"      =>  "end_date",
            "title"     =>  "Край",
            "date"     =>  $clock["year"]."-".$clock["month"]."-".$clock["day"],
            "time"     =>  $clock["hour"].":".$clock["minute"],
        ));
        echo '</tr>';
        echo '<tr>';
        $this->TextField(array(
            "name"      =>  "stay_time",
            "title"     =>  "Престой",
            "value"     =>  ""
        ));
        $this->DropDownMenu(array(
            "name"      =>  "windpark",
            "title"     =>  "Ветропарк",
            "value"     =>  "",            
            "option"    =>  "required",
            "menu_items"=>  $this->windpark_names
        ));
        echo '</tr>';
        echo '<tr>';
        $this->TextField(array(
            "name"      =>  "turbine_serial_number",
            "title"     =>  "Турбина",
            "value"     =>  ""
        ));
        $this->TextField(array(
            "name"      =>  "event_title",
            "title"     =>  "Събитие",
            "value"     =>  ""
        ));
        echo '</tr>';
        echo '<tr>';
        $this->DropDownMenu(array(
            "name"      =>  "working_team",
            "title"     =>  "Екип",
            "value"     =>  "",            
            "option"    =>  "required",
            "menu_items"=>  array("ABC","Vestas","Е-Про")
        ));
        $this->TextAreaField(array(
            "name"      =>  "description",
            "title"     =>  "Описание",
            "value"     =>  "",
            "option"    =>  "required"
        ));
        echo '</tr>';
        echo '<tr>';
        $this->DatePicker(array(
            "name"      =>  "team_arrive_date",
            "title"     =>  "Начало на работа",
            "date"     =>  $clock["year"]."-".$clock["month"]."-".$clock["day"],
            "time"     =>  $clock["hour"].":".$clock["minute"],
        ));
        $this->TextAreaField(array(
            "name"      =>  "changed_parts",
            "title"     =>  "Подменени компоненти",
            "value"     =>  ""
        ));
        echo '</tr>';
        echo '<tr>';
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
    /* public function ShowHeader()
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
        $this->TextField(array(
            "name"      =>  "search_word",
            "value"     =>  "",  
            "placeholder"   =>  "Търси за ..."
        ));
        echo '</div>';
        echo '<div class="col-sm">';
        $this->DropDownMenu(array(
            "name"      =>  "search_category",
            "value"     =>  "",            
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
    } */
    public function ShowPages($data,$page)
    {
        ob_start();

        $this->ShowPageNavigator();

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
        foreach( $data[$page-1] as $result ){
            $result = (array) $result;
            echo "<tr>";
            for($i=1;$i<count($result);$i++){

                $this->TextPlane(array(
                    "name"  =>  "",
                    "value" =>  $result[$this->result_columns[$i]]
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

        $this->ShowPageNavigator();
        
    }
    public function EditForm($data)
    {
        ob_start();
        echo '<form method="post" action="#">';
        echo '<table class="table table-hover">';
        echo '<tr>';
        $this->TextHeader(array(
            "name"  =>  "",
            "value" =>  "Редакция на Log"
        ));
        echo '</tr>';
        echo '<tr>';

        $this->DatePicker(array(
            "name"      =>  "start_date",
            "title"     =>  "Начало",
            //"option"    =>  "readonly",
            "date"     =>  $data["start_date"]//$clock["year"]."-".$clock["month"]."-".$clock["day"],
            //"time"     =>  $clock["hour"].":".$clock["minute"],
        ));
        $this->DatePicker(array(
            "name"      =>  "end_date",
            "title"     =>  "Край",
            "date"     =>  $data["end_date"]/* $clock["year"]."-".$clock["month"]."-".$clock["day"],
            "time"     =>  $clock["hour"].":".$clock["minute"], */
        ));
        echo '</tr>';
        echo '<tr>';
        $this->TextField(array(
            "name"      =>  "stay_time",
            "title"     =>  "Престой",
            "value"     =>  $data["stay_time"]
        ));
        $this->DropDownMenu(array(
            "name"      =>  "windpark",
            "title"     =>  "Ветропарк",
            "value"     =>  $data["windpark"],            
            "option"    =>  "required",
            "menu_items"=>  $this->windpark_names
        ));
        echo '</tr>';
        echo '<tr>';
        $this->TextField(array(
            "name"      =>  "turbine_serial_number",
            "title"     =>  "Турбина",
            "value"     =>  $data["turbine_serial_number"]
        ));
        $this->TextField(array(
            "name"      =>  "event_title",
            "title"     =>  "Събитие",
            "value"     =>  $data["event_title"]
        ));
        echo '</tr>';
        echo '<tr>';
        $this->DropDownMenu(array(
            "name"      =>  "working_team",
            "title"     =>  "Екип",
            "value"     =>  $data["working_team"],            
            "option"    =>  "required",
            "menu_items"=>  array("ABC","Vestas","Е-Про")
        ));
        $this->TextAreaField(array(
            "name"      =>  "description",
            "title"     =>  "Описание",
            "value"     =>  $data["description"],
            "option"    =>  "required"
        ));
        echo '</tr>';
        echo '<tr>';
        $this->DatePicker(array(
            "name"      =>  "team_arrive_date",
            "title"     =>  "Начало на работа",
            "date"     =>  $data["team_arrive_date"]/* $clock["year"]."-".$clock["month"]."-".$clock["day"],
            "time"     =>  $clock["hour"].":".$clock["minute"], */
        ));
        $this->TextAreaField(array(
            "name"      =>  "changed_parts",
            "title"     =>  "Подменени компоненти",
            "value"     =>  $data["changed_parts"]
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
    public function ShowPageNavigator()
    {
        echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">';
        echo '<div class="collapse navbar-collapse" id="navbarSupportedContent">';
        echo '<div class="col-sm">';
        echo '<table class="table table-bordered">';
        echo '<tr>';
        echo '<form class="form-inline my-2 my-lg-0" action="#" method="post"';
        $this->SubmitButton(array(
            "name"      =>  "add",
            "color"     =>  "primary",
            "icon"      =>  "glyphicon glyphicon-plus-sign",
            "title"     =>  "Добави"
        ));
        $this->TextHeader(array(
            "name"  =>  "",
            "value" =>  "Брой резултати на страница: "
        ));
        $this->DropDownMenu(array(
            "name"      =>  "page_results",
            //"title"     =>  "Категория",
            "value"     =>  $this->perPageLimit,            
            //"option"    =>  "required",
            "menu_items"=>  range(10,50,10)
        ));
        $this->SubmitButton(array(
            "name"      =>  "reload",
            "color"     =>  "primary",
            //"icon"      =>  "glyphicon glyphicon-plus-sign",
            "title"     =>  "Обнови"
        ));
        $this->TextHeader(array(
            "name"  =>  "",
            "value" =>  "Брой страници: ".count($this->result_data)." "
        ));
        $this->SubmitButton(array(
            "name"      =>  "go_to",
            "color"     =>  "primary",
            //"icon"      =>  "glyphicon glyphicon-plus-sign",
            "title"     =>  "Отиди на:"
        ));    
        $this->DropDownMenu(array(
            "name"      =>  "page_number",
            //"title"     =>  "Категория",
            "value"     =>  $this->page,            
            //"option"    =>  "required",
            "menu_items"=>  range(1,count($this->result_data),1)
        ));
        echo '</form>';
        echo '</tr>';
        echo '</table>';
        echo '</div>';
        echo '</div>';
        echo '</nav>';
        # code...
    }

    public function cutDataOnPages( $table_name, $result_columns, $perPageLimit, $search_category=null, $search_word=null  )
    {
        $this->data = $this->dataApi->readTable( $table_name, $result_columns, $search_category, $search_word );
        $this->data = array_chunk($this->data, $perPageLimit);
        return $this->data;
    }
}
?>