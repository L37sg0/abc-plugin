<?php
/**
* @package ABC Plugin
*/
/**
 * DataApi is application which makes comunication with the sql database
 */
namespace Inc\Api\Pagination;

use \Inc\Base\BaseController;


class PageController extends BaseController
{
    public $table_name;
    public $result_columns;
    public $data;
    public $number_of_pages;
    public $page_number;
    public $perPageLimit;
    public $search_category;
    public $search_word;

    public function register()
    {
        $this->table_name       =   null;
        $this->result_columns   =   null;
        $this->page_number      =   1;
        $this->perPageLimit     =   10;
        $this->search_category  =   null;
        $this->search_word      =   null;
    }
    public function load()
    {
        $this->data = $this->dataApi->readTable( $this->table_name, $this->result_columns, $this->search_category, $this->search_word );
        $this->data = array_chunk($this->data, $this->perPageLimit);
        $this->number_of_pages = count($this->data);
        //return $this->data;
    }
    public function get_first_page()
    {
        return $this->data[0];
        # code...
    }
    public function get_last_page()
    {
        return end($this->data);
        # code...
    }
    public function get_page()
    {
        return $this->data[$this->page_number-1];
    }
    public function get_page_number()
    {
        return $this->page_number;
    }
    public function get_number_of_pages()
    {
        return count($this->data);
    }
    public function get_all_pages()
    {
        return $this->data;
    }
}

?>