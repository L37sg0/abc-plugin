<?php
/**
* @package ABC Plugin
*/

namespace Inc\Pages;

use \Inc\Api\Callbacks\TemplatesCallbacks;
use \Inc\Api\Pagination\PageController;


class Windparks extends TemplatesCallbacks
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
        $this->table_name = "abc_windparks";
        $this->data = array(
            "id"                    =>  (isset($_POST["id"])?$this->pageController->test_input($_POST["id"]): ""),
            "name"                  => $this->pageController->test_input($_POST["name"]),
            "owner"                 => $this->pageController->test_input($_POST["owner"]),
            "description"           => $this->pageController->test_input($_POST["description"]),
        );
        $this->result_columns = array(
            "id","name","owner","description"
        );
        $this->column_titles  = array(
            "Име", "Собственик", "Описание"
        );
        $this->search_word = null;
        $this->search_category=null;

        /* $this->windpark_names = [];
        $results = $this->dataApi->readTable("abc_windparks", array("id","name"));
        foreach($results as $result){
            $result = (array) $result;
            array_push( $this->windpark_names, $result["name"] );
        } */


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
            "value" =>  "Добавяне на Ветропарк"
        ));
        echo '</tr>';
        echo '<tr>';
        $this->TextField(array(
            "name"      =>  "name",
            "title"     =>  "Название",
            "value"     =>  ""
        ));
        $this->TextField(array(
            "name"      =>  "owner",
            "title"     =>  "Собственик",
            "value"     =>  ""
        ));
        echo '</tr>';
        echo '<tr>';
        $this->TextAreaField(array(
            "name"      =>  "description",
            "title"     =>  "Описание",
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
            "value" =>  "Редакция на Ветропарк"
        ));
        $this->TextHiddenField(array(
            "name"  =>  "id",
            "value" =>  $data["id"],
        ));
        echo '</tr>';
        echo '<tr>';
        $this->TextField(array(
            "name"      =>  "name",
            "title"     =>  "Название",
            "value"     =>  $data["name"]
        ));
        $this->TextField(array(
            "name"      =>  "owner",
            "title"     =>  "Собственик",
            "value"     =>  $data["owner"]
        ));
        echo '</tr>';
        echo '<tr>';
        $this->TextAreaField(array(
            "name"      =>  "description",
            "title"     =>  "Описание",
            "value"     =>  $data["description"]
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