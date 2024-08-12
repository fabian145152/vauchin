<?php

session_start();
include_once "funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");


echo $id = $_GET['q'];

$sql = "DELETE FROM `voucher_nuevos` WHERE id =" . $id;
$result = $con->query($sql);

session_destroy();

header("Location: lista_voucher.php");
