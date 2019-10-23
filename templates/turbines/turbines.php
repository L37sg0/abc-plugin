<!DOCTYPE html>
<html lang="en">
    <head>
    
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
                integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
        <?php
        
        ?>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- heading -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="col-sm">
                    <h1>Турбини</h1>
                </div>
                <!-- button for add new -->
                <div class="col-sm">
                    <form class="form-inline my-2 my-lg-0" action="#" method="post">
                        <button name="add_new" class="btn btn-primary my-2 my-sm-0" type="submit">Добави</button>
                    </form>
                </div>
                <!-- search form -->
                <form class="form-inline my-2 my-lg-0" action="#" method="post">

                    <input class="form-control mr-sm-2" type="search" name="search_word" placeholder="Търси за..." aria-label="Search">
                    <!--Тук се избира категория за търсене-->
                    <select name="search_category" class="form-control">
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
                    </select>
                    <button name="search" class="btn btn-primary my-2 my-sm-0" type="submit">Търси</button>
                </form>
            </div>
        </nav>
        <!--container for the dinamic content-->
        <div class="container mt-5">
            <table class='table table-hover'>
                <?php
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
    </body>
</html>        