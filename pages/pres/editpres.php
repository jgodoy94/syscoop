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
                    <?php
                        if($_SESSION['vrip']==2){
                            echo "<li><a href='gen.php'>Gerencia</a></li>";
                        }
                    ?>
                    <li><a href="../../index.php">Salir</a></li>
                </ul>
            </nav>
            <div id="principal-body">
                <div class="busqueda">
                    <?php
                        if(isset($_SESSION['tempsoli']) && !empty($_SESSION['tempsoli'])){
                            require("../../models/nnoc.php");
                            $soli = $_SESSION['tempsoli'];
                            $query = "select * from lbtserp where liso = $soli and serpest = 'f'";
                            $tluser = pg_query($nnoc, $query);
                            if($tluser){
                                if(pg_num_rows($tluser) > 0){
                                    while( $obj = pg_fetch_object($tluser) ){
                                        $tomon = $obj->tomon;
                                        $satouc = $obj->satouc;
                                        $roirp = $obj->roirp;
                                    }

                                    echo "
                                    <form action='editpres.php' method='post' class='formedit'>
                                        <h3>EDICION DE SOLICITUD $soli</h3>
                                        <label>MONTO: </label><input type='text' required placeholder='$tomon' name='tomon'>
                                        <label>CUOTAS: </label><input type='text' required placeholder='$satouc' name='satouc'>
                                        <label>PRIORIDAD: </label><input type='text' required placeholder='$roirp' name='roirp'>
                                        <input type='submit' value='GUARDAR CAMBIOS'>
                                    </form>
                                    ";
                                }
                                else{
                                    echo "
                                    <h3>NO SE PUEDEN EDITAR LOS DATOS DE ESTA SOLICITUD DE PRESTAMOS</h3>
                                    <h4>LA SOLICITUD $soli NO SE ENCUENTRA DISPONIBLE PARA EDICION YA QUE SE ENCUNETRA ACTIVA</h4>
                                    ";
                                }
                            }
                            else{
                                echo "
                                <h3>NO SE PUEDEN EDITAR LOS DATOS DE ESTA SOLICITUD DE PRESTAMOS</h3>
                                <h4>ACCESO DENEGADO PARA EDICION DE LA SOLICITUD $soli</h4>
                                ";
                            }
                        }
                        else{
                            echo "
                            <h3>NO SE RECIBIO NINGUNA SOLICITUD PARA EDICION</h3>
                            ";
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>