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
        
        $this->table_name = $wpdb->prefix . $table_name;

        $this->table_structure = $table_structure;

        $charset_collate = $wpdb->get_charset_collate();
    
        $sql = "CREATE TABLE IF NOT EXISTS $this->table_name" . $this->table_structure . "$charset_collate;";

        $wpdb->query($sql);

    }

    // edit table
    public function editTable( string $table_name=null, string $new_table_structure=null ){
        
    }

    // drop table
    public function dropTable( string $table_name=null ){

        global $wpdb;
                
        $this->table_name = $wpdb->prefix . $table_name;

        $sql = "DROP TABLE $this->table_name;";

        $wpdb->query($sql); 

    }

    // write data
    public function writeData( string $table_name = null, array $data=[] ){
        global $wpdb;

        $this->table_name = $wpdb->prefix . $table_name;

        $this->data = $data;
        
        $wpdb->insert( $this->table_name, $this->data );

    }

    // read table
    public function readTable( string $table_name=null, string $result_columns=null, string $search_category=null, string $search_word=null ){
        global $wpdb;

        $this->table_name = $wpdb->prefix . $table_name;

        $this->result_columns = $result_columns;

        $this->search_category = $search_category;

        $this->search_word = $search_word;

        if( $this->search_word && $this->search_category ){
        
            $this->result = $wpdb->get_results(
                "
                SELECT id, "    . $this->result_columns .   "
                FROM "          . $this->table_name .       "
                WHERE "         . $this->search_category .  "
                = '"            . $this->search_word .      "'"
            );
        }else{
            $this->result = $wpdb->get_results(
                "
                SELECT id, "    . $this->result_columns . "
                FROM "          . $this->table_name 
            );
        }

        

        //echo "<script>console.log(" . array_keys ( $this->result_columns )[1] . ");</script>";
        return $this->result;
        
        /*foreach( $this->result as $res ){
            echo "<script>console.log('" . $res->name . "');</script>";
        }*/



    }

    // read row



    // edit data
    public function editData(){
        
    }

    // delete data
    public function deleteData(){
        
    }
}

?>