<!DOCTYPE html>
<html lang="en">
    <head>
    
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
                integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- heading -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="col-sm">
                    <h1>Ветропаркове</h1>
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
                        <option value="owner"               >Собственик</option>
                    </select>
                    <button name="search" class="btn btn-primary my-2 my-sm-0" type="submit">Търси</button>
                </form>
            </div>
        </nav>
        <div class="container mt-5">
            <table class='table table-hover'>
                <?php 
                use Inc\Api\Handlers\TemplateHandler;
                $handler = new TemplateHandler;
                $data = array(
                    "name"                  => $_POST["windpark_name"],
                    "owner"                 => $_POST["windpark_owner"],
                    "description"           => $_POST["windpark_description"],
                );
                $result_columns = array("id","name","owner");
                $table_name = "abc_windparks";
                $callback = "windparksAddNew";
                $handler->register();
                $handler->handle( $table_name, $data, $result_columns, $callback );
                ?>
            </table>
        </div>
    </body>
</html>        