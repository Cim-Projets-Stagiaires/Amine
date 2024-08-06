<?php
include('connect.php');
if (isset($_POST["create"])) {
    $nom = mysqli_real_escape_string($conn, $_POST["nom"]);
    $sqlInsert = "INSERT INTO salles(nom) VALUES ('$nom')";
    if(mysqli_query($conn,$sqlInsert)){
        session_start();
        $_SESSION["create"] = "Salle ajoutée avec succès!";
        header("Location:index.php");
    }else{
        die("Une erreur s'est produite.");
    }
}
if (isset($_POST["edit"])) {
    $nom = mysqli_real_escape_string($conn, $_POST["nom"]);
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $sqlUpdate = "UPDATE salles SET nom = '$nom' WHERE id='$id'";
    if(mysqli_query($conn,$sqlUpdate)){
        session_start();
        $_SESSION["update"] = "Salle modifiée avec succès!";
        header("Location:index.php");
    }else{
        die("Une erreur s'est produite.");
    }
}
?>