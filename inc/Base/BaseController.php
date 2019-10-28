<?php
/**
* @package ABC Plugin
*/

namespace Inc\Base;

use Inc\Api\Data\DataApi;

class BaseController
{
    public $plugin_path;
    public $plugin_url;
    public $plugin;
    public $turbines_dd;

    public $dataApi;

    public function __construct(){
        $this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
        $this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
        $this->plugin = plugin_basename( dirname( __FILE__, 3 ) ) . '/abc-plugin.php';

        $this->dataApi = new DataApi();
        $this->turbines_dd = array();
    }
}

?>