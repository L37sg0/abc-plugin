<?php
/**
* @package ABC Plugin
*/

namespace Inc\Base;

use Inc\Api\Data\DataApi;

class Deactivate
{
    public static function deactivate(){

        flush_rewrite_rules();

        //$dataApi = new DataApi;

        //$dataApi->dropTable( 'abc_turbines' );
        //$dataApi->dropTable( 'abc_windparks' );
        //$dataApi->dropTable( 'abc_events' );

    }// handling plugin deactivation
}

?>