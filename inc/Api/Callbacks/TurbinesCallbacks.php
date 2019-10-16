<?php
/**
* @package ABC Plugin
*/

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class TurbinesCallbacks extends BaseController
{

    public function turbinesDashboard(){

        return require_once( "$this->plugin_path/templates/turbines/turbines.php" );
        //return require_once( "$this->plugin_path/templates/turbines/add_turbine.php" );
    
    }
    public function turbinesAddNew(){

        return require_once( "$this->plugin_path/templates/turbines/add_turbine.php" );
    
    }

    /*public function turbinesAdminSection(){

        echo '';

    }

    public function turbinesTurbineName(){

        $value = esc_attr( get_option( 'turbine_name' ) );
        echo '<input type="text" class="regular-text" name="turbine_name" value="' . $value . '"placeholder="Въведи име на Турбина">';

    }
    public function turbinesTurbineOwner(){

        $value = esc_attr( get_option( 'turbine_owner' ) );
        echo '<input type="text" class="regular-text" name="turbine_owner" value="' . $value . '"placeholder="Въведи Фирма Собственик">';

    }
    public function turbinesTurbinePower(){

        $value = esc_attr( get_option( 'turbine_power' ) );
        echo '<input type="text" class="regular-text" name="turbine_power" value="' . $value . '"placeholder="Въведи мощност на Турбина">';

    }
    public function turbinesTurbineWindpark(){

        $value = esc_attr( get_option( 'turbine_windpark' ) );
        echo '<input type="text" class="regular-text" name="turbine_windpark" value="' . $value . '"placeholder="Въведи Ветропарк към Турбина">';

    }
    public function turbinesTurbineDescription(){

        $value = esc_attr( get_option( 'turbine_description' ) );
        echo '<textarea type="input" class="regular-text" name="turbine_description" value="' . $value . '"placeholder="Въведи Описание към Турбина"></textarea>';

    }*/

}
?>