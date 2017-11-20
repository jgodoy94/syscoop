<?php
    require("../../models/nnoc.php");
    session_start();
    if(!isset($_SESSION['resu']) || empty($_SESSION['resu']) || !isset($_SESSION['AUTH']) || empty($_SESSION['AUTH']) || $_SESSION['AUTH'] != true){
        header("Location: ../index.html");
    }

    if(isset($_POST['solidi']) && !empty($_POST['solidi'])){
        $soli = $_POST['solidi'];
        if($_POST['action'] == "Editar"){
            $_SESSION['tempsoli'] = $soli;
            header("Location: editpres.php");
        }
        else if($_POST['action'] == "Cancelar"){
            $query = "delete from lbtserp where liso ='$soli'";

            pg_query($nnoc, $query);

            header("Location: ../pres.php");
        }
    }
?>