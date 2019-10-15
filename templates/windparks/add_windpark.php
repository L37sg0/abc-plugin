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
            <div class="container mt-5">
                    <!-- heading -->
                    <div class="row">
                        <div class="col-sm">
                            <h1>Добавяне на Ветропарк</h1>
                        </div>
                    </div>
                    <!-- alert will be here -->
                    <!-- table will be here -->
                    <form action='#' method='post'>
                        <table class='table table-hover'>
                        
                            <tr>
                                <td>Име</td>
                                <td><input type='text' name='windpark_name' value='' class='form-control' required></td>
                            </tr>
                        
                            <tr>
                                <td>Собственик</td>
                                <td><input type='text' name='windpark_owner' value='' class='form-control' required></td>
                            </tr>
                        
                            <tr>
                                <td>Описание</td>
                                <td><textarea name='windpark_description' value='' class='form-control'></textarea></td>
                            </tr>
                        
                            <tr>
                                <td></td>
                                <td>
                                    <button type="submit" name="submit" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-plus"></span> Запази
                                    </button>
                                </td>
                            </tr>
                        
                        </table>
                    </form>
                    <?php 
                                
                        use Inc\Api\Data\DataApi;
                        //settings_errors();
                        if( isset( $_POST["submit"] ) ){
                            $dataApi = new DataApi;
                            $data = array(
                                "name"                  => $_POST["windpark_name"],
                                "owner"                 => $_POST["windpark_owner"],
                                "description"           => $_POST["windpark_description"],
                            );
                            //echo $data["name"];
                            $dataApi->writeData( "abc_windparks", $data );

                        }
                                
                    ?>
            </div>
    </body>
</html>