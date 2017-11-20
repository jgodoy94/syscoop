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
    </head>
    <body>
        <div id="principal-container">
            <header>
                <img src="">
                <h1><a href="dash.php">Syscoop</a> - Cuentas</h1>
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
                    <form action="cue.php" method="post">
                        <input type="text" name="afiliado" required placeholder="Codigo de Afiliado">
                        <input type="submit" value="BUSCAR">
                    </form>
                </div>
                <?php
                    require("../models/nnoc.php");
                    if(isset($_POST['afiliado']) && !empty($_POST['afiliado'])){
                        $afi = $_POST['afiliado'];
                        $query = "select elpmedi from lbtelpme where elpmedeco = '$afi'";

                        $tluser = pg_query($nnoc, $query);
                        echo "<div>";
                        if($tluser){
                            if(pg_num_rows($tluser)>0){
                                while($obj = pg_fetch_object($tluser)){
                                    $elpmedi = $obj->elpmedi;
                                }
                                    $query = "select liso, tomon from lbtserp where elpmedi = '$elpmedi'";
            
                                    $tluser = pg_query($nnoc, $query);
                                    if($tluser){
                                        if(pg_num_rows($tluser)>0){
                                            while($obj = pg_fetch_object($tluser)){
                                                $soli = $obj->liso;
                                                $tomon = $obj->tomon;
                                                echo "
                                                    <label>SOLICITUD:</label>
                                                    <label>$soli</label>
                                                    <label>MONTO:</label>
                                                    <label>$tomon</label>
                                                ";
                                            }
                                        }
            
                                    }
                                    echo "
                                        <form action='cue.php' method='post'>
                
                                        </form>
                                    ";
                            }

                        }
                        echo "
                        </div>
                        <div>
                            <form action='cue.php' method='post'>
    
                            </form>
                        </div>
                        ";
                    }
                ?>
            </div>
        </div>
    </body>
</html>