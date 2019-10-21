<?php
/**
* @package ABC Plugin
*/
/**
 * DataApi is application which makes comunication with the sql database
 */
namespace Inc\Api\Data;

class DataApi
{
    // create table
    public function createTable( string $table_name=null, string $table_structure=null ){

        global $wpdb;
        
        $table_name = $wpdb->prefix . $table_name;

        $table_structure = $table_structure;

        $charset_collate = $wpdb->get_charset_collate();
    
        $sql = "CREATE TABLE IF NOT EXISTS $table_name" . $table_structure . "$charset_collate;";

        $wpdb->query($sql);

    }

    // edit table
    public function editTable( string $table_name=null, string $new_table_structure=null ){
        
    }

    // drop table
    public function dropTable( string $table_name=null ){

        global $wpdb;
                
        $table_name = $wpdb->prefix . $table_name;

        $sql = "DROP TABLE $table_name;";

        $wpdb->query($sql); 

    }

    // write data
    public function writeData( string $table_name = null, array $data=[] ){
        global $wpdb;

        $table_name = $wpdb->prefix . $table_name;

        $data = $data;
        
        $wpdb->insert( $table_name, $data );

    }

    // read table
    public function readTable( string $table_name=null, array $result_columns=null, string $search_category=null, string $search_word=null ){
        global $wpdb;

        $table_name = $wpdb->prefix . $table_name;

        $result_columns = implode(",",$result_columns);
        //echo "<script>console.log('" . $result_columns . "');</script>";

        $search_category = $search_category;

        $search_word = $search_word;

        if( $search_word && $search_category ){
        
            $result = $wpdb->get_results(
                "
                SELECT "        . $result_columns .   "
                FROM "          . $table_name .       "
                WHERE "         . $search_category .  "
                LIKE '%"        . $search_word .      "%'"
            );
        }else{
            $result = $wpdb->get_results(
                "
                SELECT id, "    . $result_columns . "
                FROM "          . $table_name 
            );
        }
        return $result;
    }

    // read row
    public function readRow( string $table_name, int $row_id=0 ){ 
        
        global $wpdb;

        $table_name = $wpdb->prefix . $table_name;
        
        $result = $wpdb->get_row( "SELECT * FROM $table_name WHERE id = $row_id" );

        return $result;
        
    }

    // edit data
    public function editRow(){
        
    }

    // delete data
    public function deleteRow( string $table_name, int $row_id=0 ){

        global $wpdb;

        $table_name = $wpdb->prefix . $table_name;

        $wpdb->delete( $table_name, array( 'id' => $row_id ) );

        echo "<script>console.log('ROW DELETED.');</script>";
        
        
    }
}

?>