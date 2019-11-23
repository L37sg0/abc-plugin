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
        $dataApi->createTable('abc_logerr',"(
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            start_date timestamp NOT NULL,
            end_date timestamp NOT NULL,
            stay_time time NOT NULL,
            windpark varchar(16) NOT NULL,
            turbine_serial_number varchar(10) NOT NULL,
            event_title varchar(50) NOT NULL,
            working_team varchar(100) NOT NULL,
            description varchar(200) NOT NULL,
            team_arrive_date timestamp NOT NULL,
            changed_parts varchar(200) NOT NULL,
            dispatcher_name varchar(16) NOT NULL,
            PRIMARY KEY  (id)
        )");
        $dataApi->createTable('abc_substations',"(
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(16) NOT NULL,
            description varchar(200) NOT NULL,
            PRIMARY KEY  (id)
        )");
        $dataApi->createTable('abc_outlets',"(
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(16) NOT NULL,
            substation varchar(16) NOT NULL,
            backup varchar(16) NOT NULL,
            description varchar(200) NOT NULL,
            PRIMARY KEY  (id)
        )");
        $dataApi->createTable('abc_switchgears',"(
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(16) NOT NULL,
            substation varchar(16) NOT NULL,
            outlet varchar(16) NOT NULL,
            description varchar(200) NOT NULL,
            PRIMARY KEY  (id)
        )");
        $dataApi->createTable('abc_others',"(
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(30) NOT NULL,
            type varchar(30) NOT NULL,
            description varchar(200) NOT NULL,
            PRIMARY KEY  (id)
        )");
        $dataApi->createTable('abc_interruptions',"(
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            date date NOT NULL,
            start time NOT NULL,
            stop time NOT NULL,
            place varchar(30) NOT NULL,
            reason varchar(30) NOT NULL,
            contractor varchar(30) NOT NULL,
            description varchar(200) NOT NULL,
            writen_by varchar(30) NOT NULL,
            PRIMARY KEY  (id)
        )");

    }
}

?>