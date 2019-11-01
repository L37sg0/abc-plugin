<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
 <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   --><script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <!-- heading -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div class="col-sm">
          <h1>Събития</h1>
      </div>
      <!-- button for add new -->
      <div class="col-sm">
          <form class="form-inline my-2 my-lg-0" action="#" method="post">
              <button name="add" class="btn btn-primary my-2 my-sm-0" type="submit">Добави</button>
          </form>
      </div>
      <!-- search form -->
      <form class="form-inline my-2 my-lg-0" action="#" method="post">

        <input class="form-control mr-sm-2" type="search" name="search_word" placeholder="Търси за..." aria-label="Search">
        <!--Тук се избира категория за търсене-->
        <select name="search_category" class="form-control">
            <option value="date"       >Дата</option>
            <option value="title"      >Заглавие</option>
            <option value="place"      >За Обект</option>
            <option value="writen_by"  >Въведено от</option>
        </select>
        <button name="search" class="btn btn-primary my-2 my-sm-0" type="submit">Търси</button>
      </form>
    </div>
  </nav>

  <div class="container">
    <?php
    use Inc\Pages\Logerr;

    $page = new Logerr;
    $page->register();
    
    $page->ShowRows(); 
    //$page->AddNew(null);    

    if( isset( $_POST["save"] ) ){
        $this->dataApi->writeData( $page->table_name, $page->data );
        ob_get_clean();
        $page->ShowRows();

    }
    if( isset( $_POST["update"] ) ){
        $this->dataApi->editRow( $page->table_name, $page->result_columns );
        ob_get_clean();
        $page->ShowRows();

    }

    if( isset( $_POST["edit"] ) ){

        $this->row = (array) $this->dataApi->readRow( $page->table_name, $_POST["row_id"] );
        ob_get_clean();
        $page->EditForm($this->row);
    } 

    if( isset( $_POST["delete"] ) ){

        $this->dataApi->deleteRow( $page->table_name, $_POST["row_id"] );
        ob_get_clean();
        $page->ShowRows();

    }  
    
    if( isset( $_POST["add"] ) ){

      ob_get_clean();
      $page->AddNew(null);

    }
    ?>
  </div>
  </body>
</html>
