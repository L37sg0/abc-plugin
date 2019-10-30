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
  <?php
  use Inc\Pages\Events;

  $page = new Events;
  ?>
  <div class="container">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#tab1">Списък</a></li>
        <li><a data-toggle="tab" href="#tab2">Добави</a></li>
        <li><a data-toggle="tab" href="#tab3">Експорт</a></li>
    </ul>

    <div class="tab-content">
        <div id="tab1" class="tab-pane fade in active">
        
          <h3>Събития</h3>
            <?php
              $page->ShowRows();
            ?>
        <!--container for the dinamic content-->
        </div>
        <div id="tab2" class="tab-pane fade">
            <h3>Добавяне на Събитие</h3>
            <?php
              $page->AddNew();
            ?>
        </div>
        <div id="tab3" class="tab-pane fade">
            <h3>Експортиране</h3>
            <p>Експортиране на резултат от търсене във формат по избор.</p>
        </div>
    </div>
  </div>
</body>
</html>
