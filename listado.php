<?php 
//Llamamos a las clases
require_once 'dataBase.php';
require_once 'user.class.php';
//Fin -- Llamamos a las clases


$USUARIO = new User();

$buscarInput = '';

if (isset($_GET['buscar'])) {
    $buscar = $_GET['buscar'];
    if (empty(trim($buscar))) {
        $buscar = null;
    }else{
        $buscarInput = $buscar;
    }
}else{
    $buscar = null;
}

$usuarios = $USUARIO->listado($buscar);
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <script src="js/jquery.min.js"></script>
    <script type="text/javascript">
        $( document ).ready(function() {
            $('#buscar').select();
        });
    </script>

    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <main class="row">
        <div class="col_12">
            <h1>Lista de usuarios</h1>
        </div>

        <div class="col_12 table">        
            <div class="col_12 table_header">
                <div class="col_3 table_hd">Nombre</div>
                <div class="col_3 table_hd">Apellido</div>
                <div class="col_3 table_hd">E-mail</div>
                <div class="col_3 table_hd">Opciones</div>
            </div>
            <div class="col_12">
                <form class="col_12 buscar_topTable flex">
                    <input class="" id="buscar" name="buscar" type="search" placeholder="Buscar Nombre" autofocus="" value="<?=$buscarInput?>"></input>
                    <button class="" type="submit" name="buscarBtn">Buscar</button>
                </form>
            </div>
            <?php 
                if (count($usuarios)==0) {
                        ?>
                        <div class="col_12 table_row flex flex-align-center">
                            <div class="col_12 table_td table_sr">Sin Resultados...</div>
                        </div>
                        <?php 
                }else{                
                    foreach ($usuarios as $indiceNun => $userObj) {
                        ?>
                        <div class="col_12 table_row flex flex-align-center">
                            <div class="col_3 table_td"><?=$userObj->nombre?></div>
                            <div class="col_3 table_td"><?=$userObj->apellido?></div>
                            <div class="col_3 table_td"><?=$userObj->mail?></div>
                            <div class="col_3 table_td">
                                <ul class="flex flex-justify-space-around menu_opciones">
                                    <li><a href="editar.php?idUsuario=<?=$userObj->id?>" class="btn_normal btn_editar">Editar</a></li>
                                    <li><a href="detalle.php?idUsuario=<?=$userObj->id?>" class="btn_normal btn_consulta">Consultar</a></li>
                                </ul>
                            </div>
                        </div>
                        <?php 
                    }
                }
             ?>
        </div>


    </main>
</body>
</html>