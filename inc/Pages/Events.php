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

    public function register()
    {
        
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
        $table_name = "abc_events";
        $column_titles  = array("Дата", "Заглавие", "Описание", "Място", "Добавено от");
        $results = $this->dataApi->readTable( $table_name, $result_columns, $search_category, $search_word );
        

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
    public function EditForm($row_id)
    {
        $table_name = "abc_events";
        $data = (array) $this->dataApi->readRow( $table_name, $row_id );
        echo '<h3>Промяна на Събитие</h3>';
        $this->AddNew($data);
    }

    ####################################33
    //method for handling templates $_POST
    public function handle()
    {/* 
        $this->showContent( $table_name, $result_columns, $column_titles );
    
        if( isset( $_POST["search"] ) ){

            ob_get_clean();                
            $search_word = $_POST["search_word"];
            $search_category = $_POST["search_category"];
            $this->showContent( $table_name, $result_columns, $column_titles, $search_category, $search_word );
            
        }

        if( isset( $_POST["add_new"] ) ){

            ob_get_clean();
            $this->templatesCallbacks->$add_callback();

            $this->turbines_dd["name"] = "Turbinata 2 malelei";
            echo '<script>console.log("'.$this->turbines_dd["name"].'");</script>';

        }   */
/* 
        if( isset( $_POST["save"] ) ){
            $this->dataApi->writeData( $table_name, $data );
            ob_get_clean();
            //$this->showContent( $table_name, $result_columns, $column_titles );

        }
        if( isset( $_POST["save_edit"] ) ){
            $this->dataApi->editRow( $table_name, $result_columns );
            ob_get_clean();
            $this->showContent( $table_name, $result_columns, $column_titles );

        } */

        if( isset( $_POST["edit"] ) ){

            
            ob_start();
            header('Location: #tab4');
            ob_end_flush();
            die();
            $this->EditForm($_POST["row_id"]);
        } 

        if( isset( $_POST["delete"] ) ){
/* 
            $this->removeRow( $table_name, $_POST["row_id"] );
            ob_get_clean();
            $this->showContent( $table_name, $result_columns, $column_titles ); */

        }  
            
    }       

}
?>