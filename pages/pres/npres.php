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
                <h1><a href="dash.php">Syscoop</a> - Préstamos</h1>
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
                <div class="busqueda">
                    <form action="comdpres.php" method="post">
                        <h3>CONFIRME LA CANCELACION DE LA SOLICITUD DE PRESTAMO</h3>
                        <input type="submit" name ="decis" value="NO">
                        <input type="submit" name ="decis" value="SI">
                    </form>
                </div>
                <?php
                    require("../../models/nnoc.php");
                    if(isset($_SESSION['tempsoli']) && !empty($_SESSION['tempsoli'])){
                        $soli = $_SESSION['tempsoli'];
                        if(isset($_POST['decis']) && !empty($_POST['decis'])){
                            if($_POST['decis'] == "NO"){
                                header("Location: ../pres.php");
                            }
                            else if($_POST['decis'] == "SI"){
                                $query = "select serpest from lbtserp where liso = '$soli'";
                                $tluser = pg_query($nnoc, $query);
    
                                if(pg_num_rows($tluser) > 0){
                                    while( $obj = pg_fetch_object($tluser) ){
                                        $serpest = $obj->serpest;
                                        if($serpest == 'f'){
                                            $query = "delete from lbtserp where liso ='$soli'";
                                            pg_query($nnoc, $query);                                            
                                            header("Location: ../pres.php");
                                        }
                                        else if($obj->serpest == 't'){
                                            header("Location: ../pres.php");
                                        }
                                    }
                                }
                                else{ 
                                    echo 
                                    "<div class='subdivpres1'>
                                        <h1>NO SE ENCONTRO DATOS DE PRESTAMO PARA EL AFILIADO $mena</h1>
                                    </div>";
                                }
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>