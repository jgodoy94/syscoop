<?php
    session_start();
    if(!isset($_SESSION['resu']) || empty($_SESSION['resu']) || !isset($_SESSION['AUTH']) || empty($_SESSION['AUTH']) || $_SESSION['AUTH'] != true){
        header("Location: ../index.php");
    }
?>
<html>
    <head>
        <title>CoopSys</title>
        <meta charset="utf8">        
        <link rel="stylesheet" type="text/css" href="../styles/general.css">
        <link rel="stylesheet" type="text/css" href="../styles/gen.css">
    </head>
    <body>
        <div id="principal-container">
            <header>
                <img src="">
                <h1><a href="dash.php">Syscoop</a> - Gerencia</h1>
            </header>
            <nav>
                <ul>
                    <li><a href="afi.php">Afiliados</a></li>
                    <li><a href="pres.php">Préstamos</a></li>
                    <li><a href="cue.php">Cuentas</a></li>
                    <?php
                        if($_SESSION['vrip']==2){
                            echo "<li><a href='gen.php'>Gerencia</a></li>";
                        }
                    ?>
                    <li><a href="../index.php">Salir</a></li>
                </ul>
            </nav>
            <div id="principal-body">
                <div>
                    <?php
                        require("../models/nnoc.php");
                        $query = "select serpdi, liso, tomon, satouc from lbtserp where serpest='f' ORDER BY roirp DESC";

                        $tluser = pg_query($nnoc, $query);

                        echo "
                            <h2>SOLICITUDES PENDIENTES DE APROBACION</h2>
                        ";

                        if($tluser){
                            if(pg_num_rows($tluser) > 0){
                                while($obj = pg_fetch_object($tluser)){
                                    $di = $obj->serpdi;
                                    $liso = $obj->liso;
                                    $tomon = $obj->tomon;
                                    $satouc = $obj->satouc;
                                    echo "
                                        <label class='data'>ID: </label>
                                        <label class='di'>$di</label>
                                        <label class='soli'>SOLICITUD: </label>
                                        <label class='data'>$liso</label>
                                        <label class='data'>MONTO: </label>
                                        <label class='data'>$tomon</label>
                                        <label class='data'>CUOTAS: </label>
                                        <label class='data'>$satouc</label><br><br><br>
                                    ";
                                }
                            }
                        }

                        echo "
                        <form action='gen.php' method='post' id='datas'>
                            <input type='text' name='solicitud' required placeholder='Solicitud a Gestionar'><br><br>
                            <input type='submit' name='action' value='ACEPTAR'>
                            <input type='submit' name='action' value='DENEGAR'>
                        </form>
                        ";
                    ?>
                    <?php
                        if((isset($_POST['action']) && !empty($_POST['action'])) && (isset($_POST['solicitud']) && !empty($_POST['solicitud'])) ){
                            $action = $_POST['action'];
                            $solicitud = $_POST['solicitud'];
                            if($action == 'ACEPTAR'){
                                $query3 = "select * from lbtserp where liso = '$solicitud'";
                                $tluser3 = pg_query($nnoc, $query3);

                                if($tluser3){
                                    if(pg_num_rows($tluser3)>0){
                                        $query2 = "update lbtserp set serpest='t' where liso = '$solicitud'";
                                        pg_query($nnoc, $query2);
        
                                        echo "
                                        <div>
                                            <h2>SE APROBO LA SOLICITUD DE PRESTAMO $solicitud</h2>
                                        </div>
                                        ";
                                    }
                                    else{
                                        echo "
                                        <div>
                                            <h2>NO SE ENCONTRO LA SOLICITUD $solicitud</h2>
                                        </div>
                                        ";
                                    }
                                }
                                else{
                                    echo "
                                    <div>
                                        <h2>NO SE LOGRO RESOLVER LA VALIDACION DE LA BASE DE DATOS</h2>
                                    </div>
                                    ";
                                }
                                
                            }   
                            else if($action == 'DENEGAR'){
                                $query3 = "select * from lbtserp where liso = '$solicitud'";
                                $tluser3 = pg_query($nnoc, $query3);

                                if($tluser3){
                                    if(pg_num_rows($tluser3)>0){
                                        $query5 = "delete from lbtserp where liso = '$solicitud'";
                                        pg_query($nnoc, $query5);
        
                                        echo "
                                        <div>
                                            <h2>SE ELIMINO LA SOLICITUD DE PRESTAMO $solicitud</h2>
                                        </div>
                                        ";
                                    }
                                    else{
                                        echo "
                                        <div>
                                            <h2>NO SE ENCONTRO LA SOLICITUD $solicitud</h2>
                                        </div>
                                        ";
                                    }
                                }
                                else{
                                    echo "
                                    <div>
                                        <h2>NO SE ENCONTRO LOGRO RESOLVER LA VALIDACION DE LA BASE DE DATOS</h2>
                                    </div>
                                    ";
                                }
                            }                         
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>