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
    public function AddNew()
    {
        echo '<form method="post" action="#">';
        echo '<table class="table table-hover">';
        echo '<tr>';
        $this->TextField(array(
            "name"      =>  "title",
            "title"     =>  "Заглавие",
            "value"     =>  "",
            "requred"   =>  "required"
        ));
        $this->TextField(array(
            "name"      =>  "description",
            "title"     =>  "Описание",
            "value"     =>  "",
            "requred"   =>  "required"
        ));
        echo '</tr>';
        echo '<tr>';
        $this->DropDownMenu(array(
            "name"      =>  "category",
            "value"     =>  "",
            "title"     =>  "Категория",
            "requred"   =>  "required",
            "menu_items"=>  array("Ремонт","Обслужване")
        ));
        $this->DropDownMenu(array(
            "name"      =>  "status",
            "value"     =>  "",
            "title"     =>  "Статус",
            "requred"   =>  "required",
            "menu_items"=>  array("Изпълнено","Чакащо","Започнато изпълнение")
        ));
        echo '</tr>';
        echo '<tr>';
        $this->DropDownMenu(array(
            "name"      =>  "place",
            "value"     =>  "",
            "title"     =>  "Място",
            "requred"   =>  "required",
            "menu_items"=>  array("База","Турбина","Обект")
        ));
        $this->DatePicker(array(
            "name"      =>  "date",
            "value"      =>  "2012-05-12",
            "title"     =>  "Дата"
        ));
        echo '</tr>';
        echo '<tr>';
        $this->SubmitButton(array(
            "name"      =>  "save",
            "title"     =>  "Запази"
        ));
        echo '</tr>';/* 
        echo '<tr>';
        $this->EditButton(array(
            "name"      =>  "save",
            "title"     =>  "Редакция"
        ));
        $this->DeleteButton(array(
            "name"      =>  "save",
            //"title"     =>  "Запази"
        ));
        echo '</tr>'; */

        echo '</table>';
        echo '</form>';
    }
    public function ShowRows()
    {
        $result_columns = array("id", "date", "title", "description", "place", "writen_by");
        $table_name = "abc_events";
        $column_titles  = array("Дата", "Заглавие", "Описание", "Място", "Добавено от");
        $results = $this->dataApi->readTable( $table_name, $result_columns, $search_category, $search_word );
        

        echo '<table class="table table-hover table-info">';
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
                "name"  =>  "",
                "value" =>  $result["id"]
            ));
            $this->EditButton(array(
                "name"      =>  "edit",
                "title"     =>  "Редакция"
            ));
            $this->DeleteButton(array(
                "name"      =>  "delete",
                //"title"     =>  "Запази"
            ));
            echo "</form>";
            echo "</tr>";

        echo '</table>';
        }

    }
    public function EditForm()
    {
        # code...
    }

}
?>