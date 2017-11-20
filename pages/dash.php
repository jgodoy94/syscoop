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
                <h1>Syscoop - Dash</h1>
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
            </div>
        </div>
    </body>
</html>