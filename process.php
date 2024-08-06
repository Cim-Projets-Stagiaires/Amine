<?php
include("connect.php");

if (isset($_POST['create'])) {
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $departement = $_POST['departement'];
    $departement_other = isset($_POST['departement_other']) ? mysqli_real_escape_string($conn, $_POST['departement_other']) : '';
    $etablissement = $_POST['etablissement'];
    $etablissement_other = isset($_POST['etablissement_other']) ? mysqli_real_escape_string($conn, $_POST['etablissement_other']) : '';
    $specialite = $_POST['specialite'];
    $specialite_other = isset($_POST['specialite_other']) ? mysqli_real_escape_string($conn, $_POST['specialite_other']) : '';

    if ($departement === 'autre') {
        $departement = $departement_other;
    }
    if ($etablissement === 'autre') {
        $etablissement = $etablissement_other;
    }
    if ($specialite === 'autre') {
        $specialite = $specialite_other;
    }

    $sql = "INSERT INTO enseignants (nom, prenom, departement, etablissement, specialite) VALUES ('$nom', '$prenom', '$departement', '$etablissement', '$specialite')";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php?status=success");
    } else {
        header("Location: index.php?status=error");
    }
}

if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $departement = $_POST['departement'];
    $departement_other = isset($_POST['departement_other']) ? mysqli_real_escape_string($conn, $_POST['departement_other']) : '';
    $etablissement = $_POST['etablissement'];
    $etablissement_other = isset($_POST['etablissement_other']) ? mysqli_real_escape_string($conn, $_POST['etablissement_other']) : '';
    $specialite = $_POST['specialite'];
    $specialite_other = isset($_POST['specialite_other']) ? mysqli_real_escape_string($conn, $_POST['specialite_other']) : '';

    if ($departement === 'autre') {
        $departement = $departement_other;
    }
    if ($etablissement === 'autre') {
        $etablissement = $etablissement_other;
    }
    if ($specialite === 'autre') {
        $specialite = $specialite_other;
    }

    $sql = "UPDATE enseignants SET nom='$nom', prenom='$prenom', departement='$departement', etablissement='$etablissement', specialite='$specialite' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php?status=success");
    } else {
        header("Location: index.php?status=error");
    }
}
?>
