<?php
/**
* @package ABC Plugin
*/

namespace Inc\Base;

use \Inc\Base\BaseController;

class SettingsLinks extends BaseController
{

    public function register(){
        add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
    }

    function settings_link( $links ){
        // add custom settings link
        $settings_link = '<a href="admin.php?page=abc_settings">Настройки</a>';
        array_push( $links, $settings_link );
        return $links;
    }
}

?>