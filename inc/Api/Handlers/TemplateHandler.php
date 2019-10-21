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

    public function register()
    {
        $this->dataApi              = new DataApi;
        $this->templatesCallbacks   = new TemplatesCallbacks();
    }

    //method for handling templates $_POST
    public function handle( string $table_name="", array $data=[], array $result_columns=[], $callback=null )
    {
        $this->showContent( $table_name, $result_columns );
        //$this->showRow( $table_name, 1 );
    
        if( isset( $_POST["search"] ) ){

            ob_get_clean();                
            $search_word = $_POST["search_word"];
            $search_category = $_POST["search_category"];
            $this->showContent( $table_name, $result_columns, $search_category, $search_word );
            
        }

        if( isset( $_POST["add_new"] ) ){

            ob_get_clean();
            $this->templatesCallbacks->$callback();

        }  

        if( isset( $_POST["save"] ) ){
            $this->dataApi->writeData( $table_name, $data );
            ob_get_clean();
            $this->showContent( $table_name, $result_columns );

        }

        if( isset( $_POST["1"] ) ){

            $this->showRow( $table_name, 1 );

        }  
            
    }       

    // method for handling data visualization
    public function showContent( string $table_name="", array $result_columns=[], string $search_category=null, string $search_word=null )
    {
        /* echo '<form method="post" action="options.php" class="inline-block">';
        settings_fields( 'alecaddd_plugin_tax_settings' );
        echo '<input type="hidden" name="remove" value="' . $option['taxonomy'] . '">';
        submit_button( 'Delete', 'delete small', 'submit', false, array(
            'onclick' => 'return confirm("Are you sure you want to delete this Custom Taxonomy? The data associated with it will not be deleted.");'
        ));
        echo '</form>'; */

        ob_start(); 
        $results = $this->dataApi->readTable( $table_name, $result_columns, $search_category, $search_word );
        foreach( $results as $result ){

            $result = (array) $result;
            //echo "<tr type='submit' name='". $result["id"] ."'>";
            echo "<tr>";

            for($i=0;$i<count($result);$i++){
                
                echo"<td>" . $result[$result_columns[$i]];
                
            }
            echo '<form method="post" action="#">';
            echo '<input type="hidden" name="row_id" value="' . $result["id"] . '"></td>';
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
    public function showRow( string $table_name="", int $row_id=0)
    {
        //ob_start(); 
        $results = (array) $this->dataApi->readRow( $table_name, $row_id );
        //echo "<script>console.log('" . $results . "');</script>";
        foreach( $results as $result ){

            $result = (array) $result;
            for($i=0;$i<count($result);$i++){

                echo "<script>console.log('" . $result[$i] . "');</script>";
                //echo"<td>" . $result[$result_columns[$i]] . "</td>";

            }
        }
    }

}
?>
