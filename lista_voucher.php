<?php
session_start();
include_once "funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

//$sql_borra = "DELETE FROM `voucher_nuevos` WHERE movil >= 'A3000';";
//$datos = $con->query($sql_borra);


$sql_cuenta = "SELECT * FROM `voucher_nuevos` WHERE movil >= 'A3000'";
$cuenta = $con->query($sql_cuenta);
$reg_remi = $cuenta->num_rows;
if ($reg_remi > 0) {
    echo "Faltan borrar";
    //exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VAUCHIN</title>
    <?php head() ?>
</head>

<body>
    <form method="post">
        <button type="submit" name="borrar_remo">BORRAR Voucher de remises</button>
    </form>

    <?php
    // Verificar conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }


    // Verificar si se ha presionado el botón
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['borrar_remo'])) {

        $sql_busca_remo = "DELETE FROM voucher_nuevos WHERE movil >= 3000";
        $borra = $con->query($sql_busca_remo);
        echo $borra_remo = $borra->num_rows;

        // SQL para vaciar la tabla
        //$sql = "TRUNCATE TABLE  voucher_validado";

        if ($con->query($sql_busca_remo) === TRUE) {
            echo "Tabla vaciada exitosamente";
            header("Location: lista_voucher.php");
        } else {
            echo "Error vaciando la tabla: " . $con->error;
        }
    }

    ?>
    <script>
        function deleteProduct(cod_voucher) {
            window.location = "borrar_voucher.php?q=" + cod_voucher;
        }
    </script>

    </head>

    <body>
        <style>
            body {
                margin: 0px 50px;
            }
        </style>
        <div>
            <h3 class="text-center" style="margin: 5px ; ">CARGA DE VOUCHER
                Ver la fecha del primer viaje y hacer la importación el dia siguinete.</h3>
        </div>

        <?php
        date_default_timezone_set('America/Mexico_City');
        $fechaActual = date('Y-m-d');
        $fechaActual;
        $semana = date('W');
        ?>
        <h5 style="text-align: center;"><?php echo $fechaActual . " " . "Semana: " . $semana ?></h5>
        <div class="row">
            <form method="post" id="addproduct" action="import_voucher.php" enctype="multipart/form-data" role="form">
                &nbsp; &nbsp;
                <input type="file" name="name" id="name" class="btn btn-success btn-sm" placeholder="Archivo (.xlsx)">
                &nbsp; &nbsp;
                <button type="submit" class="btn btn-success btn-sm">Importar Datos</button>
                &nbsp;
            </form>
            <form method="post" id="busca" action="buscador_voucher.php" enctype="multipart/form-data" role="form">
                <h6>Buscar x<input type="text" style="width : 100px " id="movil" name="movil" placeholder="MOVIL">
                    <button>Buscar</button>

                </h6>
            </form>

            <form method="post" action="exportar_tabla.php" enctype="multipart/form-data" role="form">
                <h6>Genera Vauchin<input type="text" style="width : 100px " id="v_movil" name="v_movil"
                        placeholder="MOVIL">
                    <button>Buscar</button>

                </h6>
            </form>


            &nbsp; &nbsp;&nbsp; &nbsp;
            <a href="vaciar_tabla_voucher.php" id="miEnlace" class="btn btn-success btn-sm">Limpiar tabla</a>
            &nbsp; &nbsp;&nbsp; &nbsp;


            <a href="../../menu_admin.php" class="btn btn-success btn-sm">SALIR</a>
        </div>

        <?php


        $sql = "SELECT * FROM voucher_nuevos WHERE 1 ORDER BY completado DESC";
        $datos = $con->query($sql);




        ?>
        <h5 style="text-align: center;"><?php echo $datos->num_rows; ?> Voucher importados</h5>


        <table class="table table-bordered table-sm table-hover">
            <thead class="thead-dark">

                <th>id</th>
                <th>V No.</th>
                <th>Fecha</th>
                <th>Nom Pasajero</th>
                <th>Movil</th>
                <th>CC</th>
                <th>Reloj</th>
                <th>Peaje</th>
                <th>Equipaje</th>
                <th>Adicional</th>
                <th>Plus</th>
                <th>Total</th>
                <th>Borrar</th>


            </thead>

            <?php

            while ($d = $datos->fetch_assoc()) {

            ?>
                <tr>
                    <td><?php echo $d['id']; ?></td>
                    <td><?php echo $d['viaje_no']; ?></td>
                    <td><?php echo $d['completado']; ?></td>
                    <td><?php echo $d['nom_pasaj']; ?></td>
                    <td><?php echo (int)$d['movil']; ?></td>
                    <td><?php echo (int)$d['cc']; ?></td>

                    <td><?php echo $reloj = (float)$d['reloj']; ?></td>
                    <td><?php echo $peaje = (float)$d['peaje']; ?></td>
                    <td><?php echo $equipaje = (float)$d['equipaje']; ?></td>
                    <td><?php echo $adicional = (float)$d['adicional']; ?></td>
                    <td><?php echo $plus = (float)$d['plus']; ?></td>
                    <td><?php echo $total = $reloj + $peaje + $equipaje + $adicional + $plus ?></td>


                    <td><a class="btn btn-danger btn-sm" href="#" onclick="deleteProduct(<?php echo $d['id'] ?>)">Borrar</a>
                    </td>
                </tr>
            <?php
            }
            $sql_borra = "TRUNCATE TABLE vauchin";
            $result = $con->query($sql_borra);
            ?>
        </table>
        <script>
            // Selecciona el enlace por su ID
            var enlace = document.getElementById('miEnlace');

            // Añade un evento de clic al enlace
            enlace.addEventListener('click', function(event) {
                // Evita el comportamiento predeterminado del enlace (navegación)
                event.preventDefault();

                // Muestra un mensaje de alerta
                alert('¡Va a borrar todos los vouher!.....');
                window.location = "vaciar_tabla_voucher.php"
            });
        </script>

        <a href="../menu.php">SALIR</a>
        <?php foot(); ?>
    </body>

</html>