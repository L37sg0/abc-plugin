<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   --><script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <form action="#" method="post">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab1">Списък</a></li>
                <li><a data-toggle="tab" type="submit" name="add_new" href="#tab2">Добави</a></li>
                <li><a data-toggle="tab" href="#tab3">Експорт</a></li>
            </ul>
        </form>

    <div class="tab-content">
        <div id="tab1" class="tab-pane fade in active">
        
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <!-- heading -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="col-sm">
                        <h1>Турбини</h1>
                    </div>
                    <!-- search form -->
                    <form class="form-inline my-2 my-lg-0" action="#" method="post">

                        <input class="form-control mr-sm-2" type="search" name="search_word" placeholder="Търси за..." aria-label="Search">
                        <!--Тук се избира категория за търсене-->
                        <!-- <select name="search_category" class="form-control">
                            <option value="name"                >Име</option>
                            <option value="serial_number"       >Сериен Номер</option>
                            <option value="vendor"              >Производител</option>
                            <option value="model"               >Модел</option>
                            <option value="power"               >Мощност</option>
                            <option value="owner"               >Собственик</option>
                            <option value="windpark"            >Ветропарк</option>
                            <option value="gearbox_vendor"      >Ск. Кутия </option>
                            <option value="gearbox_number"      >Ск. Кутия Номер</option>
                            <option value="hydraulics_vendor"   >Хидравлика</option>
                            <option value="hydraulics_number"   >Хидравлика Номер</option>
                            <option value="generator_vendor"    >Генератор</option>
                            <option value="generator_number"    >Генератор Номер</option>
                            <option value="transformer_vendor"  >Трансформатор</option>
                            <option value="transformer_number"  >Трансформатор Номер</option>
                        </select> -->
                        <?php
                            use Inc\Api\Callbacks\TemplatesCallbacks;
                            $callback = new TemplatesCallbacks;
                            $callback->DropDownMenu( array(
                                "name"=>"search_category",
                                "menu_items"=>array( "name","serial_number","vendor" )
                            ));
                            
                        ?>
                        <button name="search" class="btn btn-primary my-2 my-sm-0" type="submit">Търси</button>
                    </form>
                </div>
            </nav>
        <!--container for the dinamic content-->
            <table class='table table-hover'>
                <?php

                /* $options = get_option( 'turbines_settings_name' ) ?: array();
                foreach($options as $option){
                    echo '<script>console.log("'.$option.'");</script>';
                } */
                use Inc\Api\Handlers\TemplateHandler;
                $handler = new TemplateHandler;
                $handler->register();
                $data = array(
                    "name"                  => $_POST["name"],
                    "serial_number"         => $_POST["serial_number"],
                    "vendor"                => $_POST["vendor"],
                    "model"                 => $_POST["model"],
                    "power"                 => $_POST["power"],
                    "owner"                 => $_POST["owner"],
                    "windpark"              => $_POST["windpark"],
                    "gearbox_vendor"        => $_POST["gearbox_vendor"],
                    "gearbox_number"        => $_POST["gearbox_number"],
                    "hydraulics_vendor"     => $_POST["hydraulics_vendor"],
                    "hydraulics_number"     => $_POST["hydraulics_number"],
                    "generator_vendor"      => $_POST["generator_vendor"],
                    "generator_number"      => $_POST["generator_number"],
                    "transformer_vendor"    => $_POST["transformer_vendor"],
                    "transformer_number"    => $_POST["transformer_number"],
                );
                $result_columns = array("id","name","serial_number","vendor","model","power","owner","windpark");
                $column_titles  = array("Име", "Сериен Номер", "Производител", "Модел", "Мощност", "Собственик", "Ветропарк");
                $callback       = "turbinesAddNew";
                $table_name     = "abc_turbines";
                $handler->handle( $table_name, $data, $result_columns, $column_titles, $callback ); 
                ?>
            </table> 
        </div>
        <div id="tab2" class="tab-pane fade">
            <h3>Добавяне на Турбина</h3>
            <form action="#" method="post">
                <?php
                settings_fields( 'turbines_settings_name' );
                do_settings_sections( 'abc_turbines_test' );
                echo '
                <button type="submit" name="save" class="btn btn-primary">
                    <span class="glyphicon glyphicon-ok-sign"></span> Запази
                </button>';
                ?>
            </form>
        </div>
        <div id="tab3" class="tab-pane fade">
            <h3>Експортиране</h3>
            <p>Експортиране на резултат от търсене във формат по избор.</p>
        </div>
    </div>
    </div>
</body>
</html>
