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
    public $pages;
    public $data;
    public function register( $table_name, $result_columns, $perPageLimit, $search_category=null, $search_word=null  )
    {
        $this->data = $this->dataApi->readTable( $table_name, $result_columns, $search_category, $search_word );
        $this->data = array_chunk($this->data, $perPageLimit);
        return $this->data;
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
        if( $page AND $page-1 < count( $this->data) 
        AND $page > 0 ) {

            return $this->data[$page-1];

        }
        else{
            $this->get_last_page();
        }
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