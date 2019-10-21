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
                                        <option value='Друг'>Друг</option>
                                        <?php
                                        use Inc\Api\Handlers\TemplateHandler;
                                        $handler = new TemplateHandler;
                                        $handler->register();
                                        $handler->showList("abc_windparks", array("id","name"));
                                        ?>
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
                                    <button type="submit" name="save" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-plus"></span> Запази
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
            </div>
    </body>
</html>