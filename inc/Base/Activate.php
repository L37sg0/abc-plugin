<?php
/**
* @package ABC Plugin
*/

namespace Inc\Base;

use Inc\Api\Data\DataApi;

class Activate
{
    public $dataApi;

    public static function activate(){

        flush_rewrite_rules();

        $dataApi = new DataApi;

        $dataApi->createTable('abc_windparks',"(
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name tinytext NOT NULL,
            description text NOT NULL,
            PRIMARY KEY  (id)
        )");
        $dataApi->createTable('abc_turbines',"(
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name tinytext NOT NULL,
            technical_description text NOT NULL,
            PRIMARY KEY  (id)
        )");
        $dataApi->createTable('abc_events',"(
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            name tinytext NOT NULL,
            paired_to_turbine text NOT NULL,
            writen_by varchar(55) DEFAULT '' NOT NULL,
            PRIMARY KEY  (id)
        )");

    }
}

?>