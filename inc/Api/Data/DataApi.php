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
    
        $sql = "CREATE TABLE $this->table_name" . $this->table_structure . "$charset_collate;";

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
        
        $wpdb->insert( $table_name, $this->data );

    }

    // edit data
    public function editData(){
        
    }

    // delete data
    public function deleteData(){
        
    }
}

?>