<?php
/**
* @package ABC Plugin
*/

namespace Inc\Pages;

//use \Inc\Api\SettingsApi;
//use \Inc\Base\BaseController;
//use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\TemplatesCallbacks;


class Events extends TemplatesCallbacks
{
    //public $callbacks;

    public $table_name;
    public $data;

    public function register()
    {
        $this->table_name = "abc_events";
        $this->data = array(
          "date"                  => current_time( 'mysql' ),
          "title"                 => $_POST["title"],
          "description"           => $_POST["description"],
          "place"                 => $_POST["place"],
          "writen_by"             => wp_get_current_user()->user_login,
        );
        
    }
    public function AddNew($data)
    {
        echo '<form method="post" action="#">';
        echo '<table class="table table-hover">';
        echo '<tr>';

        $this->TextField(array(
            "name"      =>  "title",
            "title"     =>  "Заглавие",
            "value"     =>  (isset($data["title"])?$data["title"]:""),
            "requred"   =>  "required"
        ));
        $this->TextField(array(
            "name"      =>  "description",
            "title"     =>  "Описание",
            "value"     =>  (isset($data["title"])?$data["description"]:""),
            "requred"   =>  "required"
        ));
        echo '</tr>';
        echo '<tr>';
        $this->DropDownMenu(array(
            "name"      =>  "category",
            "title"     =>  "Категория",
            "value"     =>  (isset($data["category"])?$data["category"]:""),
            "requred"   =>  "required",
            "menu_items"=>  array("Ремонт","Обслужване")
        ));
        $this->DropDownMenu(array(
            "name"      =>  "status",
            "title"     =>  "Статус",
            "value"     =>  (isset($data["status"])?$data["status"]:""),
            "requred"   =>  "required",
            "menu_items"=>  array("Изпълнено","Чакащо","Започнато изпълнение")
        ));
        echo '</tr>';
        echo '<tr>';
        $this->DropDownMenu(array(
            "name"      =>  "place",
            "title"     =>  "Място",
            "value"     =>  (isset($data["place"])?$data["place"]:""),
            "requred"   =>  "required",
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
            "name"      =>  "save",
            "title"     =>  "Запази"
        ));
        echo '</tr>';

        echo '</table>';
        echo '</form>';
    }
    public function ShowRows()
    {
        $result_columns = array("id", "date", "title", "description", "place", "writen_by");
        $column_titles  = array("Дата", "Заглавие", "Описание", "Място", "Добавено от");
        $results = $this->dataApi->readTable( $this->table_name, $result_columns);
        

        echo '<table class="table table-hover table-bordered">';
        echo "<tr>";
        for($i=0;$i<count($column_titles);$i++){
            
            $this->TextHeader(array(
                "name"  =>  "",
                "value" =>  $column_titles[$i]
            ));
            
        }
        echo "</tr>";
        foreach( $results as $result ){

            $result = (array) $result;
            echo "<tr>";
            for($i=1;$i<count($result);$i++){

                $this->TextPlane(array(
                    "name"  =>  "",
                    "value" =>  $result[$result_columns[$i]]
                ));
                
            }
            echo '<form method="post" action="#">';
            
            $this->TextHiddenField(array(
                "name"  =>  "row_id",
                "value" =>  $result["id"]
            ));
            $this->EditButton(array(
                "name"      =>  "edit",
                //"title"     =>  "Редакция"
            ));
            $this->DeleteButton(array(
                "name"      =>  "delete",
                //"title"     =>  "Изтрий"
            ));
            echo "</form>";
            echo "</tr>";
        }
        echo '</table>';
        

    }
    public function EditForm($data)
    {
        echo '<h3>Промяна на Събитие</h3>';

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
            "disabled"  =>  "disabled"
        ));
        $this->TextField(array(
            "name"      =>  "description",
            "title"     =>  "Описание",
            "value"     =>  $data["description"],
            "disabled"  =>  "disabled"
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
            "title"     =>  "Обнови"
        ));
        echo '</tr>';

        echo '</table>';
        echo '</form>';
    }

    ####################################33
    //method for handling templates $_POST
    public function handle()
    {/* 
        $this->showContent( $table_name, $result_columns, $column_titles );
    row
        if( isset( $_POST["search"] ) ){

            ob_get_clean();                
            $search_word = $_POST["search_word"];
            $search_category = $_POST["search_category"];
            $this->showContent( $table_name, $result_columns, $column_titles, $search_category, $search_word );
            
        } */

        if( isset( $_POST["save"] ) ){
            $this->dataApi->writeData( $this->table_name, $this->data );
            //header("Refresh:0");

        }
        if( isset( $_POST["update"] ) ){
            $this->dataApi->updateRow( $this->table_name, $this->data );
            //header("Refresh:0");

        }

        if( isset( $_POST["edit"] ) ){

            $row = (array) $this->dataApi->readRow( $this->table_name, $_POST["row_id"] );
            $this->EditForm($row);
        } 

        if( isset( $_POST["delete"] ) ){

            $this->dataApi->deleteRow( $table_name, $_POST["row_id"] );
            //header("Refresh:0");

        }  
            
    }       

}
?>