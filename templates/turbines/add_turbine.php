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
                            <h1>Добавяне на Турбина</h1>
                        </div>
                    </div>
                    <!-- alert will be here -->
                    <!-- table will be here -->
                    <form action='#' method='post'>
                        <table class='table table-hover'>
                        
                        <tr>
                                <td>Име</td>
                                <td><input type='text' name='turbine_name' value='' class='form-control' required></td>
                            </tr>
                            <tr>
                                <td>Сериен номер</td>
                                <td><input type='text' name='turbine_serial_number' value='' class='form-control' required></td>
                            </tr>
                            <tr>
                                <td>Производител</td>
                                <td>
                                    <select name='turbine_vendor' class='form-control'>
                                        <option value="Vestas"      >Vestas</option>
                                        <option value="Nordtank"    >Nordtank</option>
                                        <option value="Neg Micon"   >Neg Micon</option>
                                        <option value='Power Wind'  >Power Wind</option>
                                        <option value='Micon'       >Micon</option>
                                        <option value='Nordex'      >Nordex</option>
                                        <option value='HSW'         >HSW</option>
                                        <option value='An Bonus'    >An Bonus</option>
                                    </select>
                                </td>
                            </tr> 
                            <tr>
                                <td>Модел/Тип</td>
                                <td><input type='text' name='turbine_model' value='' class='form-control' required></td>
                            </tr> 
                            <tr>
                                <td>Мощност в MW</td>
                                <td><input type='text' name='turbine_power' value='' class='form-control' required></td>
                            </tr> 
                            <tr>
                                <td>Собственик</td>
                                <td><input type='text' name='turbine_owner' value='' class='form-control' required></td>
                            </tr> 
                            <tr>
                                <td>Ветропарк</td>
                                <td>
                                    <select name='turbine_windpark' class='form-control'>
                                        <!--Трябва да показва списък с въведените обекти ветропаркове-->
                                        <option value='Ветропарк 1'>Ветропарк 1</option>
                                        <option value='Ветропарк 2'>Ветропарк 2</option>
                                        <option value='Ветропарк 3'>Ветропарк 3</option>
                                    </select>
                                </td>
                            </tr> 
                            <tr>
                                <td>Производител - Скоростна Кутия</td>
                                <td><input type='text' name='gearbox_vendor' value='' class='form-control'></td>
                            </tr> 
                            <tr>
                                <td>Сериен № - Скоростна Кутия</td>
                                <td><input type='text' name='gearbox_number' value='' class='form-control'></td>
                            </tr> 
                            <tr>
                                <td>Производител - Хидравлика</td>
                                <td><input type='text' name='hydraulics_vendor' value='' class='form-control'></td>
                            </tr> 
                            <tr>
                                <td>Сериен № - Хидравлика</td>
                                <td><input type='text' name='hydraulics_number' value='' class='form-control'></td>
                            </tr> 
                            <tr>
                                <td>Производител - Генератор</td>
                                <td><input type='text' name='generator_vendor' value='' class='form-control'></td>
                            </tr> 
                            <tr>
                                <td>Сериен № - Генератор</td>
                                <td><input type='text' name='generator_number' value='' class='form-control'></td>
                            </tr> 
                            <tr>
                                <td>Производител - Трансформатор</td>
                                <td><input type='text' name='transformer_vendor' value='' class='form-control'></td>
                            </tr> 
                            <tr>
                                <td>Сериен № - Трансформатор</td>
                                <td><input type='text' name='transformer_number' value='' class='form-control'></td>
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
                                "name"                  => $_POST["turbine_name"],
                                "serial_number"         => $_POST["turbine_serial_number"],
                                "vendor"                => $_POST["turbine_vendor"],
                                "model"                 => $_POST["turbine_model"],
                                "power"                 => $_POST["turbine_power"],
                                "owner"                 => $_POST["turbine_owner"],
                                "windpark"              => $_POST["turbine_windpark"],
                                "gearbox_vendor"        => $_POST["gearbox_vendor"],
                                "gearbox_number"        => $_POST["gearbox_number"],
                                "hydraulics_vendor"     => $_POST["hydraulics_vendor"],
                                "hydraulics_number"     => $_POST["hydraulics_number"],
                                "generator_vendor"      => $_POST["generator_vendor"],
                                "generator_number"      => $_POST["generator_number"],
                                "transformer_vendor"    => $_POST["transformer_vendor"],
                                "transformer_number"    => $_POST["transformer_number"],
                            );
                            $dataApi->writeData( "abc_turbines", $data );

                        }
                                
                    ?>
            </div>
    </body>
</html>