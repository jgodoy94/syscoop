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
        <link rel="stylesheet" type="text/css" href="../../styles/general.css">
        <link rel="stylesheet" type="text/css" href="../../styles/afi.css">
    </head>
    <body>
        <div id="principal-container">
            <header>
                <img src="">
                <h1><a href="dash.php">Syscoop</a> - Registro De Afiliados</h1>
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
                    }
                ?>
            </div>
        </div>
    </body>
</html>