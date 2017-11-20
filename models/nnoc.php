<?php
    $resu = $_POST['usr'];
    $resu = $_POST['pss'];
    $host="localhost";
    $port = 5432;
    $user="coopsys";
    $pass="coopsys";
    $dbname = "coopsysdeb";
    $nnoc = pg_connect("host=$host port=$port user=$user password=$pass dbname=$dbname");

    if(!$nnoc)
        die("Error de Conexión");
?>