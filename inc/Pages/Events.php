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
        
        $this->TextField(array(
            "name"      =>  "title",
            "title"     =>  (isset($data["title"])?$data["title"]:"Заглавие"),
            "value"     =>  "",
            "requred"   =>  "required"
        ));
        $this->TextField(array(
            "name"      =>  "description",
            "title"     =>  "Описание",
            "value"     =>  "",
            "requred"   =>  "required"
        ));
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
        $this->DatePicker(array(
            "name"      =>  "date",
            "value"      =>  "2012-05-12",
            "title"     =>  "Дата"
        ));
        $this->SubmitButton(array(
            "name"      =>  "save",
            "title"     =>  "Запази",
            "class"     =>  "btn btn-primary my-2 my-sm-0"
        ));

        echo '</table>';
        echo '</form>';
    }
    public function ShowRows()
    {
        # code...
    }
    public function EditForm()
    {
        # code...
    }

}
?>