<?php
if (isset($_GET['id'])) {
include("connect.php");
$id = $_GET['id'];
$sql = "DELETE FROM salles WHERE id='$id'";
if(mysqli_query($conn,$sql)){
    session_start();
    $_SESSION["delete"] = "Salle supprimée!";
    header("Location:index.php");
}else{
    die("Une erreur s'est produite.");
}
}else{
    echo "Salle n'existe pas.";
}
?>