<?php
/**
* @package ABC Plugin
*/

namespace Inc\Pages\Management;

use \Inc\Api\Callbacks\TemplatesCallbacks;
use \Inc\Api\Pagination\PageController;


class Logerr extends TemplatesCallbacks
{
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

        $this->pageController = new PageController;
        $this->pageController->register();
        $this->table_name = "abc_logerr";
        $this->data = array(
            "id"                    =>  (isset($_POST["id"])?$this->pageController->test_input($_POST["id"]): ""),
            "start_date"            =>  $this->pageController->test_input($_POST["start_date"]),//current_time( 'mysql' ),
            "end_date"              =>  $this->pageController->test_input($_POST["end_date"]),
            "stay_time"             =>  $this->pageController->test_input($_POST["stay_time"]),
            "windpark"              =>  $this->pageController->test_input($_POST["windpark"]),
            "turbine_serial_number" =>  $this->pageController->test_input($_POST["turbine_serial_number"]),
            "event_title"           =>  $this->pageController->test_input($_POST["event_title"]),
            "working_team"          =>  $this->pageController->test_input($_POST["working_team"]),
            "description"           =>  $this->pageController->test_input($_POST["description"]),
            "team_arrive_date"      =>  $this->pageController->test_input($_POST["team_arrive_date"]),
            "changed_parts"         =>  $this->pageController->test_input($_POST["changed_parts"]),
            "dispatcher_name"       =>  wp_get_current_user()->user_login,
        );
        $this->result_columns = array(
            "id","start_date","end_date","stay_time","windpark",
            "turbine_serial_number","event_title","working_team","description",
            "team_arrive_date","changed_parts",
            "dispatcher_name");
        $this->column_titles  = array(
            "Начало", "Край", "Престой", "Ветропарк", "Турбина",
            "Събитие", "Екип", "Описание",
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


        $this->pageController->table_name       = $this->table_name;
        $this->pageController->result_columns   = $this->result_columns;
        $this->pageController->perPageLimit     = 20;
        $this->pageController->page_number      = 1;
        $this->pageController->search_category  = null;
        $this->pageController->search_word      = null;
        
        $this->pageController->load();

        $this->ShowPages($this->pageController->get_page());
        
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
        $this->TextField(array(
            "name"      =>  "start_date",
            "title"     =>  "Начало",
            "value"     =>  "0000-00-00 00:00:00"
        ));
        $this->TextField(array(
            "name"      =>  "end_date",
            "title"     =>  "Край",
            "value"     =>  "0000-00-00 00:00:00"
        ));
        echo '</tr>';
        echo '<tr>';
        $this->TextField(array(
            "name"      =>  "stay_time",
            "title"     =>  "Престой",
            "value"     =>  "00:00:00"
        ));/* 
        $this->TimeResult(array(
            "name"           =>   "stay_time",
            "title"          =>   "Престой",
            "first"          =>   "start_date",
            "second"         =>   "end_date"
        )); */
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
        $this->MultiSelectMenu(array(
            "name"      =>  "working_team",
            "title"     =>  "Екип",
            "value"     =>  "",
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
        $this->TextField(array(
            "name"      =>  "team_arrive_date",
            "title"     =>  "Начало на работа",
            "value"     =>  "0000-00-00 00:00:00"
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

    public function ShowPages($data)
    {
        ob_start();

        $this->ShowPageNavigator();

        echo '<table id="logs" class="table table-hover table-bordered">';
        echo '<thead><tr>';
        for($i=0;$i<count($this->column_titles);$i++){
            
            $this->TextHeader(array(
                "name"  =>  "",
                "value" =>  $this->column_titles[$i],
            ));
            
        }
        echo '<th colspan=3>Действия</th>';
        echo '</tr></thead>';
        echo '<tbody>';
        if ($data) {
            foreach( $data as $result ){
                $result = (array) $result;
                echo '<tr>';
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
                    "icon"      =>  "glyphicon glyphicon-pencil"
                ));
                $this->SubmitButton(array(
                    "name"      =>  "delete",
                    "color"     =>  "danger",
                    "icon"      =>  "glyphicon glyphicon-trash"
                ));
                echo '</form>';
                echo '</tr>';
            }

        }else{
            echo '<tr><td colspan="10">Няма намерени резултати</td></tr>';
        }
        echo '</tbody>';
        echo '<tfoot><tr>';
        for($i=0;$i<count($this->column_titles);$i++){
            
            $this->TextHeader(array(
                "name"  =>  "",
                "value" =>  $this->column_titles[$i],
            ));
            
        }
        echo '<th colspan=3>Действия</th>';
        echo '</tr></tfoot>';
        echo '</table>';
        
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
        $this->TextHiddenField(array(
            "name"  =>  "id",
            "value" =>  $data["id"],
        ));
        echo '</tr>';
        echo '<tr>';
        $this->TextField(array(
            "name"      =>  "start_date",
            "title"     =>  "Начало",
            "value"     =>  $data["start_date"]
        ));
        $this->TextField(array(
            "name"      =>  "end_date",
            "title"     =>  "Край",
            "value"     =>  $data["end_date"]
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
            "menu_items"=>  array("ABC","Vestas","Е-Про"),
            "option"    =>  "multiple",
        ));
        $this->TextAreaField(array(
            "name"      =>  "description",
            "title"     =>  "Описание",
            "value"     =>  $data["description"]
        ));
        echo '</tr>';
        echo '<tr>';
        $this->TextField(array(
            "name"      =>  "team_arrive_date",
            "title"     =>  "Начало на работа",
            "value"     =>  $data["team_arrive_date"]
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
        echo '<form class="form-inline my-2 my-lg-0" action="#" method="post"';
        echo '<table class="table table-bordered">';
        echo '<tr>';
        $this->PrintButton(array(
            "name"      =>  "print",
            "color"     =>  "success",
            "icon"      =>  "glyphicon glyphicon-print",
            "title"     =>  "Принтирай"
        ));
        $this->SubmitButton(array(
            "name"      =>  "add",
            "color"     =>  "primary",
            "icon"      =>  "glyphicon glyphicon-plus-sign",
            "title"     =>  "Добави"
        ));
        $this->TextField(array(
            "name"      =>  "search_word",
            "value"     =>  $this->pageController->search_word,  
            "placeholder"=> "Търси за..."
        ));
        $this->DropDownMenu(array(
            "name"      =>  "search_category",
            "title"     =>  "в",
            "value"     =>  $this->pageController->search_category,  
            "menu_items"=>  $this->result_columns
        ));

        echo '</tr>';
        echo '<tr>';
        $this->DropDownMenu(array(
            "name"      =>  "page_results",
            "title"     =>  "Брой резултати на страница: ",
            "value"     =>  $this->pageController->perPageLimit,  
            "menu_items"=>  range(10,50,10)
        ));
        $this->SubmitButton(array(
            "name"      =>  "reload",
            "color"     =>  "primary",
            "title"     =>  "Обнови"
        ));
        $this->SubmitButton(array(
            "name"      =>  "go_to",
            "color"     =>  "primary",
            "title"     =>  "Отиди на "
        ));
        $this->DropDownMenu(array(
            "name"      =>  "page_number",
            "title"     =>  "Страница",
            "value"     =>  $this->pageController->page_number,  
            "menu_items"=>  range(1,$this->pageController->number_of_pages,1)
        ));
        $this->TextHeader(array(
            "name"  =>  "",
            "value" =>  "от: ".$this->pageController->number_of_pages." "
        ));
        echo '</tr>';
        echo '</table>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</nav>';
    }

}
?>