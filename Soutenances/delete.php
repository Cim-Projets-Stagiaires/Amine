<?php
include('connect.php');

$id = $_GET['id'];

$sqlDeleteJury = "DELETE FROM membres_jury WHERE id_soutenance = $id";
$resultJury = mysqli_query($conn, $sqlDeleteJury);

if ($resultJury) {
    $sqlDeleteSoutenance = "DELETE FROM soutenances WHERE id = $id";
    $resultSoutenance = mysqli_query($conn, $sqlDeleteSoutenance);

    if ($resultSoutenance) {
        session_start();
        $_SESSION['message'] = "Soutenance supprimée avec succès";
        header("Location: index.php");
    } else {
        echo "Erreur lors de la suppression de la soutenance : " . mysqli_error($conn);
    }
} else {
    echo "Erreur lors de la suppression des membres du jury : " . mysqli_error($conn);
}

mysqli_close($conn);
?>
