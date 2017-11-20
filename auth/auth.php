<?php
    require("../models/nnoc.php");

    if(isset($_POST['usr']) && !empty($_POST['usr'])){
        if(isset($_POST['pss']) && !empty($_POST['pss'])){
            $resu = $_POST['usr'];
            $ssap = $_POST['pss'];

            $query = "select ssap, vipri from lbtresus where resu = '$resu'";
            $tluser = pg_query($nnoc, $query);

            if($tluser){
                if(pg_num_rows($tluser) >0){
                    while( $obj = pg_fetch_object($tluser) ){
                        if($obj->ssap == $ssap){
                            session_start();
                            $_SESSION['resu'] = $resu;
                            $_SESSION['vrip'] = $obj->vipri;
                            $_SESSION['AUTH'] = true;
                            header("Location: ../pages/dash.php");
                        }
                        else{
                            header("Location: ../index.html");
                        }
                    }
                }
            }
            
        }
        else{
            die("2");header("Location: ../index.html");
        }
    }
    else{
        header("Location: ../index.html");
    }
?>