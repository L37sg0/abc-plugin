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
                            <h1>Добавяне на Събитие</h1>
                        </div>
                    </div>
                    <!-- alert will be here -->
                    <!-- table will be here -->
                    <form action='#' method='post'>
                        <table class='table table-hover'>
                        
                            <tr>
                                <td>Заглавие</td>
                                <td><input type='text' name='title' value='' class='form-control' required></td>
                            </tr>
                                            
                            <tr>
                                <td>Описание</td>
                                <td><textarea name='description' value='' class='form-control'></textarea></td>
                            </tr>
                            <tr>
                                <td>Място</td>
                                <td>
                                    <select name='place' class='form-control'>
                                        <option value="База"    >База</option>
                                        <option value="Турбина" >Турбина</option>
                                        <option value="Друго"   >Друго</option>
                                    </select>
                                </td>
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
                    <form action='#' method='post'>
                                    <button type="submit" name="search" class="btn btn-danger">
                                        <span class="glyphicon glyphicon-plus"></span> Отказ
                                    </button></form>
            </div>
    </body>
</html>