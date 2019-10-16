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
            owner text NOT NULL,
            description text NOT NULL,
            PRIMARY KEY  (id)
        )");
        $dataApi->createTable('abc_turbines',"(
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name text NOT NULL,
            serial_number text NOT NULL,
            vendor text NOT NULL,
            model text NOT NULL,
            power text NOT NULL,
            owner text NOT NULL,
            windpark text NOT NULL,
            gearbox_vendor text NOT NULL,
            gearbox_number text NOT NULL,
            hydraulics_vendor text NOT NULL,
            hydraulics_number text NOT NULL,
            generator_vendor text NOT NULL,
            generator_number text NOT NULL,
            transformer_vendor text NOT NULL,
            transformer_number text NOT NULL,
            PRIMARY KEY  (id)
        )");
        $dataApi->createTable('abc_events',"(
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            title tinytext NOT NULL,
            description tinytext NOT NULL,
            place text NOT NULL,
            writen_by varchar(55) DEFAULT '' NOT NULL,
            PRIMARY KEY  (id)
        )");

    }
}

?>