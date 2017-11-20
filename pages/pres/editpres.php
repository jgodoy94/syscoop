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
        <link rel="stylesheet" type="text/css" href="../styles/pres.css">
    </head>
    <body>
        <div id="principal-container">
            <header>
                <img src="">
                <h1><a href="dash.php">Syscoop</a> - Préstamos</h1>
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
                <div class="busqueda">
                    <form action="pres.php" method="post">
                        <input type="text" required placeholder="Codigo de Afiliado" name="codeafi">
                        <input type="submit" value="BUSCAR">
                    </form>
                    <a href="pres/npres.php">Nuevo Préstamo</a>
                </div>
            </div>
        </div>
    </body>
</html>