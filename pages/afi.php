<?php
    session_start();
    if(!isset($_SESSION['resu']) || empty($_SESSION['resu']) || !isset($_SESSION['AUTH']) || empty($_SESSION['AUTH']) || $_SESSION['AUTH'] != true){
        header("Location: ../index.html");
    }
?>
<html>
    <head>
        <title>CoopSys</title>
        <meta charset="utf8">        
        <link rel="stylesheet" type="text/css" href="../styles/general.css">
        <link rel="stylesheet" type="text/css" href="../styles/afi.css">
    </head>
    <body>
        <div id="principal-container">
            <header>
                <img src="">
                <h1><a href="dash.php">Syscoop</a> - Afiliados</h1>
            </header>
            <nav>
                <ul>
                    <li><a href="afi.php">Afiliados</a></li>
                    <li><a href="pres.php">Préstamos</a></li>
                    <li><a href="cue.php">Cuentas</a></li>
                    <li><a href="gen.php">Gerencia</a></li>
                </ul>
            </nav>
            <div id="principal-body">
                <div id="busqueda">
                    <form action="afi.php" method="post">
                        <input type="text" required placeholder="Codigo de Afiliado" name="codeafi">
                        <input type="submit" value="BUSCAR">
                    </form>
                </div>
                <?php
                    if(isset($_POST['codeafi']) && !empty($_POST['codeafi'])){
                        require("../models/nnoc.php");
                        $code = $_POST['codeafi'];
                        $query = "select elpmedi, mena, elpmedeco, ograc from lbtelpme where elpmedeco = '$code'";

                        $tluser = pg_query($nnoc, $query);

                        if($tluser){
                            if(pg_num_rows($tluser) > 0){
                                while( $obj = pg_fetch_object($tluser) ){
                                    $medi = $obj->elpmedi;
                                    $mena = $obj->mena;
                                    $deco = $obj->elpmedeco;
                                    $ograc = $obj->ograc;
                                }

                                echo 
                                "<div class='subdivafi1'>
                                    <label>ID AFILIADO: </label><label>$medi</label>
                                    <label>CODIGO AFILIADO: </label><label>$deco</label>
                                    <label>NOMBRE AFILIADO: </label><label>$mena</label>
                                    <label>CARGO AFILIADO: </label><label>$ograc</label>
                                </div>";

                                $query2 = "select liso, tomon, serpest from lbtserp where elpmedi = '$medi'";

                                $tluser = pg_query($nnoc, $query2);

                                if($tluser){
                                    if(pg_num_rows($tluser) > 0){
                                        echo 
                                        "<div class='subdivafi2'>";
                                        while( $obj = pg_fetch_object($tluser) ){
                                            $liso = $obj->liso;
                                            $tomon = $obj->tomon;
                                            if($obj->serpest == 0){
                                                $serpest = "INACTIVO";
                                            }
                                            else{
                                                $serpest = "ACTIVO";
                                            }
                                            echo "
                                            <label>SOLICITUD: </label><label>$liso</label>
                                            <label>MONTO: </label><label>$tomon</label>
                                            <label>ESTADO: </label><label>$serpest</label>";
                                        }

                                        echo "</div>";
                                    }
                                    else{ 
                                        echo 
                                        "<div class='subdivafi2'>
                                            <h1>NO SE ENCONTRO DATOS DE PRESTAMO PARA EL AFILIADO $mena</h1>
                                        </div>";
                                    }
                                }
                            }
                            else{ 
                                echo 
                                "<div class='subdivafi1'>
                                    <h1>NO SE ENCONTRO EL AFILIADO CON CODIGO DE EMPLEADO $code</h1>
                                </div>";
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>