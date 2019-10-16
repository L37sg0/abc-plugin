<?php
/**
* @package ABC Plugin
* TemplateHandler is Api which handles php scripts in templates
*/

namespace Inc\Api\Handlers;

use Inc\Api\Data\DataApi;
use \Inc\Api\Callbacks\EventsCallbacks;

class TemplateHandler
{
    public $dataApi;

    public function register()
    {
        $this->dataApi = new DataApi;
        $this->handleEvents();
    }
    //method for handling windpark templates
    public function handleEvents()
    {
        if( isset( $_POST["search"] ) ){
            
            $this->table = "abc_events";
            $this->result_columns = "date, title, description, place, writen_by";
            $this->search_word = $_POST["search_word"];
            $this->search_category = $_POST["search_category"];
            $this->results = (array) $this->dataApi->readTable( $this->table, $this->result_columns, $this->search_category, $this->search_word );
            
            foreach( $this->results as $result ){
                echo"<tr><td>" .
                $result->id .               "</td><td>" .
                $result->date .             "</td><td>" .
                $result->title .            "</td><td>" .
                $result->description .      "</td><td>" .
                $result->place .            "</td><td>" .
                $result->writen_by .        "</td></tr>";
            }
        }
        if( isset( $_POST["add_new"] ) ){
            $this->eventsCallbacks = new EventsCallbacks();
            $this->eventsCallbacks->eventsAddNew();
        }  
        if( isset( $_POST["save"] ) ){
            $data = array(
                "date"                  => current_time( 'mysql' ),
                "title"                 => $_POST["event_title"],
                "description"           => $_POST["event_description"],
                "place"                 => $_POST["event_place"],
                "writen_by"             => wp_get_current_user()->user_login,
            );
            //echo $data["name"];
            $this->dataApi->writeData( "abc_events", $data );

        }
    }
    //method for handling turbine templates

    //method for handling events templates

}
?>
