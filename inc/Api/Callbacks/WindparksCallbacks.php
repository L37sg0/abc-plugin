<?php
/**
* @package ABC Plugin
*/

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class WindparksCallbacks extends BaseController
{

    public function windparksDashboard(){

        return require_once( "$this->plugin_path/templates/windparks/windparks.php" );
        //return require_once( "$this->plugin_path/templates/turbines/add_turbine.php" );
    
    }
    public function windparksAddNew(){

        return require_once( "$this->plugin_path/templates/windparks/add_windpark.php" );
    
    }
}
?>