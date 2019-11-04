<?php
/**
* @package ABC Plugin
*/
/**
 * DataApi is application which makes comunication with the sql database
 */
namespace Inc\Api\Pagination;

use Inc\Base\BaseController;


class PageController extends BaseController
{
    public $perPageLimit;
    public $pages;
    public $data;
    public function register( $table_name, $result_columns )
    {
        $this->perPageLimit=10;
        $this->data = $this->dataApi->readTable( $table_name, $result_columns );
        $this->data = array_chunk($this->data, $this->perPageLimit);
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
    public function get_page_number($page)
    {
        if( isset( $page ) && $page <= count( $this->data ) ){

            return $this->data[$page];

        }
        else{
            $this->get_last_page();
        }
    }
    public function get_number_of_pages()
    {
        return count($this->data);
    }
}

?>