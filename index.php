<?php
    session_start();
    $_SESSION = array();
    session_destroy();
?>
<html>
    <head>
        <title>Syscoop</title>
        <meta charset="utf8">
    </head>
    <body>
        <div>
            <div>
                <form action="auth/auth.php" method="post">
                    <img src="assets/logo.php">
                    <input type="text" name="usr" placeholder="USUARIO" required>
                    <input type="password" name="pss" placeholder="CONTRASEÑA" required>
                    <input type="submit" value="INGRESAR">
                </form>
            </div>
        </div>
    </body>
</html>