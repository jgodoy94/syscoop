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
                    <input type="text" required placeholder="Codigo de Afiliado">
                </div>
            </div>
        </div>
    </body>
</html>