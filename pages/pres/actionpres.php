<?php
    require("../../models/nnoc.php");
    session_start();
    if(!isset($_SESSION['resu']) || empty($_SESSION['resu']) || !isset($_SESSION['AUTH']) || empty($_SESSION['AUTH']) || $_SESSION['AUTH'] != true){
        header("Location: ../index.php");
    }

    if(isset($_POST['solidi']) && !empty($_POST['solidi'])){
        $_SESSION['tempsoli'] = $_POST['solidi'];
        if($_POST['action'] == "Editar"){
            header("Location: editpres.php");
        }
        else if($_POST['action'] == "Cancelar"){
            header("Location: comdpres.php");
        }
    }
?>