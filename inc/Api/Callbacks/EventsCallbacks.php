<?php
/**
* @package ABC Plugin
*/

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class EventsCallbacks extends BaseController
{

    public function eventsDashboard(){

        return require_once( "$this->plugin_path/templates/events/events.php" );
        //return require_once( "$this->plugin_path/templates/events/add_event.php" );
    
    }
    public function eventsAddNew(){

        return require_once( "$this->plugin_path/templates/events/add_event.php" );
    
    }
}
?>