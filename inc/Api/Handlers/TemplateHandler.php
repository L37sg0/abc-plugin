<?php
/**
* @package ABC Plugin
* TemplateHandler is Api which handles php scripts in templates
*/

namespace Inc\Api\Handlers;

use Inc\Api\Data\DataApi;
use \Inc\Api\Callbacks\TemplatesCallbacks;

class TemplateHandler
{
    public $dataApi;
    public $data = [];

    public function register()
    {
        $this->dataApi              = new DataApi;
        $this->templatesCallbacks   = new TemplatesCallbacks();
    }

    //method for handling templates $_POST
    public function handle( string $table_name="", array $data=[], array $result_columns=[], array $column_titles=[], $add_callback=null, $edit_callback=null )
    {
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

        }  

        if( isset( $_POST["save"] ) ){
            $this->dataApi->writeData( $table_name, $data );
            ob_get_clean();
            $this->showContent( $table_name, $result_columns, $column_titles );

        }
        if( isset( $_POST["save_edit"] ) ){
            $this->dataApi->editRow( $table_name, $result_columns );
            ob_get_clean();
            $this->showContent( $table_name, $result_columns, $column_titles );

        }

        if( isset( $_POST["edit"] ) ){

            ob_get_clean();
            $this->showRow( $table_name, $_POST["row_id"], $result_columns, $result_titles );
            //$this->templatesCallbacks->$edit_callback();

        } 

        if( isset( $_POST["delete"] ) ){

            $this->removeRow( $table_name, $_POST["row_id"] );
            ob_get_clean();
            $this->showContent( $table_name, $result_columns, $column_titles );

        }  
            
    }       

    // method for handling data visualization
    public function showContent( string $table_name="", array $result_columns=[], array $column_titles=[], string $search_category=null, string $search_word=null )
    {
        ob_start(); 
        $results = $this->dataApi->readTable( $table_name, $result_columns, $search_category, $search_word );
        
        echo "<tr>";
        for($i=0;$i<count($column_titles);$i++){
                
            echo"<th>" . $column_titles[$i] . "</th>";
            
        }
        echo "</tr>";
        foreach( $results as $result ){

            $result = (array) $result;
            echo "<tr>";
            for($i=1;$i<count($result);$i++){
                
                echo"<td>" . $result[$result_columns[$i]] . "</td>";
                
            }
            echo '<form method="post" action="#">';
            echo '<td><input type="hidden" name="row_id" value="' . $result["id"] . '"></td>';
            echo '<td><button name="edit" class="btn btn-primary btn-sm" type="submit">Редакция</button>';
            echo '<button name="delete" class="btn btn-danger btn-sm" type="submit">X</button></td>';
            echo "</form></tr>";
        }
    }

    // method showing list from data column
    public function showList( string $table_name="", array $columns=[])
    {
        $results = $this->dataApi->readTable( $table_name, $columns );
        foreach( $results as $result ){

            $result = (array) $result;

            echo"<option value='" . $result["name"] . "'>" . $result["name"] . "</option>";

        }
    }

    // method showing row from a table in preview form
    public function showRow( string $table_name="", $row_id=null, array $result_columns=[], array $result_titles=null )
    {
        ob_start(); 
        $results =(array) $this->dataApi->readRow( $table_name, $row_id );

        echo '<div class="container mt-5"><!-- heading --><div class="row">
                <div class="col-sm"><h1>Промяна на ' . $result_titles["head"] . '</h1></div>
            </div><form action="#" method="post"><table class="table table-hover">';
            echo'<tr><td><input type="hidden" name="' . $result_columns[0] . '" value="' . $results[$result_columns[0]] .  '" class="form-control" required></td></tr>';


        for($i=1;$i<count($result_columns);$i++){

            echo'<tr><td>' . $result_titles[$i] . '</td>
            <td><input type="text" name="' . $result_columns[$i] . '" value="' . $results[$result_columns[$i]] .  '" class="form-control" required></td></tr>';

        }
        echo '<tr><td></td><td>
        <button type="submit" name="save_edit" class="btn btn-primary">
            <span class="glyphicon glyphicon-plus"></span> Запази Промените
        </button>
                        </td></tr></table></form></div>';
        echo '
        <form action="#" method="post">
                        <button type="submit" name="search" class="btn btn-danger">
                            <span class="glyphicon glyphicon-plus"></span> Отказ
                        </button></form>';
    }

    // Method for deleting row from given table.
    public function removeRow(string $table_name="", int $row_id=null)
    {
        $this->dataApi->deleteRow( $table_name, $row_id );

    }

}
?>
