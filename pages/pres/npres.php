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
                            <input type='number' name='monto' min='0' max='50000' required></input><br><br>
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
                <?php
                    require("../../models/nnoc.php");
                    if(isset($_POST['empleado']) && !empty($_POST['empleado'])){
                        $code = $_POST['empleado'];
                        $query = "select oiralas from lbtelpme where elpmedi = '$code'";

                        $tluser = pg_query($nnoc, $query);
                        $oiralas = 0;
                        if($tluser){
                            if(pg_num_rows($tluser) > 0){
                                while( $obj = pg_fetch_object($tluser) ){
                                    $oiralas = $obj->oiralas;
                                }

                                $query2 = "select tomon from lbtserp where elpmedi = '$code' and serpest = 't'";

                                $tluser2 = pg_query($nnoc, $query2);
                                $deuda = 0;

                                if($tluser2){
                                    if(pg_num_rows($tluser2) > 0){
                                        while( $obj = pg_fetch_object($tluser2) ){
                                            $tomon = $obj->tomon;
                                            $deuda = $deuda + $tomon;
                                        }
                                    }
                                }

                                $crediticio = ($oiralas*3)-$deuda;

                                if($_POST['monto'] < $crediticio){
                                    $prio = $_POST['prioridad'];
                                    $monto = $_POST['monto'];
                                    $cuotas = $_POST['cuotas'];
                                    $solic = $_POST['solicitud'];
                                    $query3 = "select * from lbtserp where liso = '$solic'";

                                    $tluser3 = pg_query($nnoc, $query3);

                                    if($tluser3){
                                        if(pg_num_rows($tluser3)<1){
                                            $query5 = "select serpdi from lbtserp";
                                            $tluser5 = pg_query($nnoc, $query5);
                                            $uid=0;
                                            if($tluser5){
                                                if(pg_num_rows($tluser5)>0){
                                                    while($obj = pg_fetch_object($tluser5)){
                                                        $uid=$obj->serpdi;
                                                    }
                                                    $uid = $uid+1;
                                                }
                                            }

                                            $tippres = $_POST['tipopres'];
                                            if($tippres == 1)
                                                $intpres = 0;
                                            else if($tippres == 2)
                                                $intpres = 17;
                                            else if($tippres == 3)
                                                $intpres = 18;
                                            else if($tippres == 4)
                                                $intpres = 20;
                                            
                                            $montoint = ($monto/($cuotas/12))*($intpres/100);

                                            $query4 = "insert into lbtserp values('$uid','$monto','$solic','$cuotas','f','0.0','$montoint','$prio','$code')";
                                            pg_query($nnoc, $query4);

                                            echo "
                                            <div>
                                                <h3>SE HA REALIZADO LA SOLICITUD DE PRESTAMO, ESPERE LA RESPUESTA DE LA COMISION DE PRESTAMO</h3>
                                            </div>
                                        ";
                                        }
                                        else{
                                            echo "
                                                <div>
                                                    <h3>NO SE PUEDE REALIZAR UNA SOLICITUD DE PRESTAMO CON UN ID YA EXISTENTE</h3>
                                                </div>
                                            ";
                                        }
                                    }
                                }
                                else{
                                    echo "
                                        <div>
                                            <h3>NO SE PUEDE REALIZAR UNA SOLICITUD DE PRESTAMO QUE EXEDA SU NIVEL CREDITICIO DISPONIBLE</h3>
                                        </div>
                                    ";
                                }
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>