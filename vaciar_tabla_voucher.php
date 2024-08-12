<?php
session_start();
include_once "funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

//echo "Hola";

$sql_vauchin = "TRUNCATE vauchin";

if ($con->query($sql_vauchin)) {
    echo "La tabla ha sido vaciada correctamente";
} else {
    echo "Error al vaciar la tabla: " . $con->error;
    exit();
}



// Consulta para vaciar la tabla
$sql_nuevos = "TRUNCATE voucher_nuevos";

if ($con->query($sql_nuevos)) {
    echo "La tabla ha sido vaciada correctamente";
} else {
    echo "Error al vaciar la tabla: " . $con->error;
    exit();
}


$sql_temporales = "TRUNCATE voucher_temporales";

if ($con->query($sql_temporales)) {
    echo "La tabla ha sido vaciada correctamente";
} else {
    echo "Error al vaciar la tabla: " . $con->error;
    exit();
}


$sql_validados = "TRUNCATE voucher_validado";

if ($con->query($sql_validados)) {
    echo "La tabla ha sido vaciada correctamente";
} else {
    echo "Error al vaciar la tabla: " . $con->error;
    exit();
}

//exit();
header('Location: lista_voucher.php');
