<?php
    require("../../models/nnoc.php");
    session_start();
    if(!isset($_SESSION['resu']) || empty($_SESSION['resu']) || !isset($_SESSION['AUTH']) || empty($_SESSION['AUTH']) || $_SESSION['AUTH'] != true){
        header("Location: ../index.html");
    }
?>
<html>
    <head>
        <title>CoopSys</title>
        <meta charset="utf8">        
        <link rel="stylesheet" type="text/css" href="../../styles/general.css">
        <link rel="stylesheet" type="text/css" href="../../styles/pres.css">
    </head>
    <body>
        <div id="principal-container">
            <header>
                <img src="">
                <h1><a href="dash.php">Syscoop</a> - Registro Nuevo Préstamo</h1>
            </header>
            <nav>
                <ul>
                    <li><a href="../afi.php">Afiliados</a></li>
                    <li><a href="../pres.php">Préstamos</a></li>
                    <li><a href="../cue.php">Cuentas</a></li>
                    <li><a href="../gen.php">Gerencia</a></li>
                </ul>
            </nav>
            <div id="principal-body">
                <?php
                    require("../../models/nnoc.php");
                    $query = "select elpmedi, mena from lbtelpme";

                    echo "
                    <div class='subdivpres2'>
                        <form action='npres.php' method='post'>
                            <label>SOLICITUD: </label>
                            <input type='number' name='solicitud' min='0' required></input><br><br>
                            <label>EMPLEADO SOLICITANTE: </label>
                            <select name='empleado' required>
                    ";
                    $tluser = pg_query($nnoc, $query);
                    if($tluser){
                        if(pg_num_rows($tluser) > 0){
                            while($obj = pg_fetch_object($tluser)){
                                $id = $obj->elpmedi;
                                $elpme = $obj->mena;
                                echo "
                                    <option value='$id'>$elpme</option>
                                ";
                            }
                        }
                    }

                    $query = "select oiralas from lbtelpme where elpmedi = '$code'";

                    $tluser = pg_query($nnoc, $query);

                    if($tluser){
                        if(pg_num_rows($tluser) > 0){
                            while( $obj = pg_fetch_object($tluser) ){
                                $oiralas = $obj->oiralas;
                            }
                        }
                    }
                    echo "
                            </select><br><br>
                            <label>TIPO DE PRESTAMO: </label>
                            <select name='tipopres' required>
                                <option value='1'>Préstamo Automatico</option>
                                <option value='2'>CrediCoo</option>
                                <option value='3'>Credito Vehicular</option>
                                <option value='4'>Credito Vacacional</option>
                            </select><br><br>
                            <label>MONTO: </label>
                            <input type='number' name='monto'min='0' max='5000' required></input><br><br>
                            <label>CUOTAS: </label>
                            <input type='number' name='cuotas' min='1' max='48' required></input><br><br>
                            <label>PRIORIDAD: </label>
                            <select name='prioridad' required>
                                <option value='0'>Baja</option>
                                <option value='1'>Media</option>
                                <option value='2'>Alta</option>
                            </select><br><br>
                            <input type='submit' value='Ejecutar Solicitud'></input>
                        </form>
                    </div>
                    ";


                ?>
            </div>
        </div>
    </body>
</html>