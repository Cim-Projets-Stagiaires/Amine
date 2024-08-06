<?php
if (isset($_GET['id'])) {
include("connect.php");
$id = $_GET['id'];
$sql = "DELETE FROM enseignants WHERE id='$id'";
if(mysqli_query($conn,$sql)){
    session_start();
    $_SESSION["delete"] = "Enseignant supprimé !";
    header("Location:index.php");
}else{
    die("Une erreur s'est produite.");
}
}else{
    echo "Enseignant n'existe pas";
}
?>