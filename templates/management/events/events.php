<!DOCTYPE html>
<html lang="en">
<head>
  <title>Събития</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
</head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <!-- heading -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div class="col-sm">
        <h1>Събития</h1>
    </div>
  </nav>

  <div class="container">
  <?php
    use Inc\Pages\Management\Events;

    $page = new Events;
    $page->register();

    if( isset( $_POST["save"] ) ){
      $this->dataApi->writeData( $page->table_name, $page->data );
      ob_get_clean();
      $page->pageController->load();
      $page->ShowPages($page->pageController->get_last_page());
      echo '<script>console.log("saved!");</script>';

    }
    if( isset( $_POST["update"] ) ){
      $this->dataApi->editRow( $page->table_name, $page->data );
      ob_get_clean();
      $page->pageController->load();
      $page->ShowPages($page->pageController->get_page());

    }

    if( isset( $_POST["edit"] ) ){

      $row_id = $page->pageController->test_input($_POST["row_id"]);
      $this->row = (array) $this->dataApi->readRow( $page->table_name, $row_id );
      ob_get_clean();
      $page->EditForm($this->row);
    } 

    if( isset( $_POST["delete"] ) ){

      $row_id = $page->pageController->test_input($_POST["row_id"]);
      $this->dataApi->deleteRow( $page->table_name, $row_id );
      ob_get_clean();
      $page->pageController->load();
      $page->ShowPages($page->pageController->get_page());

    }  
    
    if( isset( $_POST["add"] ) ){

      ob_get_clean();
      $page->AddNew();

    }
    if( isset( $_POST["go_to"] ) ){
      $page->pageController->search_category = $page->pageController->test_input($_POST["search_category"]);
      $page->pageController->search_word = $page->pageController->test_input($_POST["search_word"]);
      $page->pageController->page_number = $page->pageController->test_input($_POST["page_number"]);
      $page->pageController->perPageLimit = $page->pageController->test_input($_POST["page_results"]);
      ob_get_clean();
      $page->pageController->load();
      $page->ShowPages($page->pageController->get_page());
      

    }
    if( isset( $_POST["reload"] ) ){
      $page->pageController->search_category = $page->pageController->test_input($_POST["search_category"]);
      $page->pageController->search_word = $page->pageController->test_input($_POST["search_word"]);
      $page->pageController->page_number = 1;
      $page->pageController->perPageLimit = $page->pageController->test_input($_POST["page_results"]);
      ob_get_clean();
      $page->pageController->load();
      $page->ShowPages($page->pageController->get_page());

    }              
        
    
    ?>
  </div>
  </body>
</html>
