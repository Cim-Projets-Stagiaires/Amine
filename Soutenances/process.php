<?php
include('connect.php');

if (isset($_POST['update_soutenance'])) {
    $id = $_POST['id'];
    $id_etudiant = $_POST['id_etudiant'];
    $id_salle = $_POST['id_salle'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];

    $sql = "UPDATE soutenances SET id_etudiant='$id_etudiant', id_salle='$id_salle', date='$date', heure='$heure' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        session_start();
        $_SESSION["message"] = "Soutenance mise à jour avec succès";
        header("Location: index.php");
    } else {
        echo "Erreur lors de la mise à jour : " . mysqli_error($conn);
    }
}
?>
