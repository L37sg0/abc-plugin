<?php
/**
* @package ABC Plugin
*/

namespace Inc\Api\CRUD;

use \Inc\Api\Callbacks\TemplatesCallbacks;
use \Inc\Api\Pagination\PageController;


class CRUD extends TemplatesCallbacks
{
    public $table_name;
    public $result_columns;
    public $column_titles;
    public $page_number;
    public $number_of_pages;
    public $perPageLimit;
    public $search_category;
    public $search_word;
    public $order_columns;
    public $order_type;

    public function register()
    {        

        $this->table_name       =   null;
        $this->result_columns   =   null;
        $this->column_titles    =   null;
        $this->page_number      =   1;
        $this->number_of_pages  =   1;
        $this->perPageLimit     =   20;
        $this->search_category  =   null;
        $this->search_word      =   null;
        $this->order_columns    =   array("id");
        $this->order_type       =   "DESC";//"ASC";
        
        $this->load();

        $this->Read($this->get_page());
        
    }
    public function load()
    {
        $this->data = $this->dataApi->readTable( 
            $this->table_name, $this->result_columns,
            $this->search_category, $this->search_word,
            $this->order_columns, $this->order_type
        );

        $this->data = array_chunk($this->data, $this->perPageLimit);
        $this->number_of_pages = count($this->data);
    }

    public function get_page()
    {
        return $this->data[$this->page_number-1];
    }

    public function test_input($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
    
    public function Create()
    {
        ob_start();
        echo '<form method="post" action="#">';
        echo '<table class="table table-hover">';
        echo '<tr>';
        @content;
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

    public function Read($data)
    {
        ob_start();

        $this->Navigation();

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
                if($result["status"]){
                    switch ($result["status"]){
                        case "Висок":
                            echo '<tr class="alert alert-danger">';
                            break;
                        case "Среден":
                            echo '<tr class="alert alert-warning">';
                            break;
                        case "Нисък":
                            echo '<tr class="alert alert-success">';
                            break;
                        case "Инфо":
                            echo '<tr class="alert alert-info">';
                            break;
                    }
                }else{
                    echo '<tr>';
                }
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

    public function Update($data)
    {
        ob_start();
        echo '<form method="post" action="#">';
        echo '<table class="table table-hover">';
        echo '<tr>';
        @content($data);
        echo '</tr>';
        echo '<tr>';
        $this->SubmitButton(array(
            "name"      =>  "update",
            "title"     =>  "Запази",
            "color"     =>  "primary",
            "icon"      =>  "glyphicon glyphicon-ok-sign"
        ));
        echo '</tr>';

        echo '</table>';
        echo '</form>';
    }

    public function Delete($row_id)
    {
        $this->dataApi->deleteRow( $this->table_name, $row_id );
    }

    public function Navigation()
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