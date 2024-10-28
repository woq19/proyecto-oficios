<?php 
require_once 'dataBase.php';
require_once 'user.class.php';


// inicio clase User
$USUARIO = new User();

$idUsuario = 0;

$idError ='';

// vwemos si nos trae idUser por GET (o sea la info viaja por url)
if (isset($_GET['idUsuario'])) {
    // Pasamos a INT para que de un ID válido
    $idUsuario = (int)$_GET['idUsuario'];
    // Verificar si el ID es válido
    if ($idUsuario > 0) {
        // Buscamos el usuario por ID
        $usuario = $USUARIO->getById($idUsuario);
    } else {
        //Msg error si el ID no es válido
        $idError = "ID de usuario no válido.";
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Usuario</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <main class="row detalles">
        <div class="col_12">
            <h1>Detalle del Usuario</h1>
        </div>

        <div class="col_12">
            <?php if ($usuario): ?>
                <div class="col_12 table_header">
                    <div class="col_2 table_hd">Nombre</div>
                    <div class="col_2 table_hd">Apellido</div>
                    <div class="col_2 table_hd">Dni</div>
                    <div class="col_2 table_hd">Plan</div>
                    <div class="col_2 table_hd">E-mail</div>
                    <div class="col_2 table_hd">Contraseña</div>
                </div>
                <div class="col_12 table_row flex flex-align-center">
                    <div class="col_2 table_td"><?= ($usuario->apellido) ?></div>
                    <div class="col_2 table_td"><?= ($usuario->nombre) ?></div>
                    <div class="col_2 table_td"><?= ($usuario->dni) ?></div>
                    <div class="col_2 table_td"><?= ($usuario->plan) ?></div>
                    <div class="col_2 table_td"><?= ($usuario->mail) ?></div>
                    <div class="col_2 table_td"><?= ($usuario->pass) ?></div>
                </div>
            <?php else: ?>
                <h2 class="col_12">Usuario no encontrado.</h2>
            <?php endif; ?>
        </div>
        <a href="listado.php">
            <button class="btn-volver">
                Volver al listado
            </button>
        </a>
    </main>
</body>
</html>