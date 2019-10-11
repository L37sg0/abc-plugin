<?php
/**
* @package ABC Plugin
*/

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{

    public function windparksDashboard(){

        return require_once( "$this->plugin_path/templates/windparks.php" );
    
    }



    public function abcSettings(){

        return require_once( "$this->plugin_path/templates/settings.php" );
    
    }
    

    public function windparkInfo(){

        return require_once( "$this->plugin_path/templates/windpark_info.php" );
    
    }

    public function turbinesDashboard(){

        return require_once( "$this->plugin_path/templates/turbines.php" );
    
    }
    
    public function turbineInfo(){

        return require_once( "$this->plugin_path/templates/turbine_info.php" );
    
    }
/*
    public function turbinesOptionGroup( $input ){

        return $input;

    }

    public function turbinesAdminSection(){

        echo 'Check this beautiful section!';

    }

    public function turbinesTextExample(){

        $value = esc_attr( get_option( 'text_example' ) );
        echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '"placeholder="Write Something Here!">';

    }

    public function turbinesTurbineName(){

        $value = esc_attr( get_option( 'turbine_name' ) );
        echo '<input type="text" class="regular-text" name="turbine_name" value="' . $value . '"placeholder="Write Turbine Name">';


    }
*/
}