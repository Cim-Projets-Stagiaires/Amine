<?php
if (isset($_GET['id'])) {
    include("connect.php");
    $id = intval($_GET['id']);

    $sqlDeleteJuryMembers = "DELETE FROM membres_jury WHERE id_soutenance IN (SELECT id FROM soutenances WHERE id_etudiant = ?)";
    $stmt = $conn->prepare($sqlDeleteJuryMembers);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $sqlDeleteSoutenances = "DELETE FROM soutenances WHERE id_etudiant = ?";
    $stmt = $conn->prepare($sqlDeleteSoutenances);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $sqlDeleteStudent = "DELETE FROM etudiants WHERE id = ?";
    $stmt = $conn->prepare($sqlDeleteStudent);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        session_start();
        $_SESSION["delete"] = "Étudiant supprimé avec succès !";
        header("Location: index.php");
    } else {
        die("Erreur lors de la suppression de l'étudiant: " . $conn->error);
    }
} else {
    echo "Étudiant n'existe pas.";
}
?>
