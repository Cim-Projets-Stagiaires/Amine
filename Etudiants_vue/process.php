<?php
include("connect.php");

if (isset($_POST['create'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $formation = $_POST['formation'];
    $filiere = $_POST['filiere'];
    $sujet_de_pfe = $_POST['sujet_de_pfe'];
    $entreprise = $_POST['entreprise'];
    $encadrant_interne = $_POST['encadrant_interne'];
    $encadrant_externe = $_POST['encadrant_externe'];
    
    // Gestion du fichier image
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $photoName = basename($_FILES['photo']['name']);
        $photoTmpName = $_FILES['photo']['tmp_name'];
        $photoPath = '../uploads/' . $photoName;
        
        // Déplacer le fichier vers le dossier uploads
        if (move_uploaded_file($photoTmpName, $photoPath)) {
            echo "Image téléchargée avec succès.";
        } else {
            die("Erreur lors du téléchargement de l'image.");
        }
    } else {
        $photoPath = null; // Pas d'image téléchargée
    }

    // Préparation de la requête d'insertion
    $sql = "INSERT INTO etudiants (nom, prenom, formation, filiere, sujet_de_pfe, entreprise, encadrant_interne, encadrant_externe, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $nom, $prenom, $formation, $filiere, $sujet_de_pfe, $entreprise, $encadrant_interne, $encadrant_externe, $photoPath);

    if ($stmt->execute()) {
        session_start();
        $_SESSION["create"] = "Étudiant ajouté avec succès !";
        header("Location: index.php");
    } else {
        die("Erreur lors de l'ajout de l'étudiant: " . $stmt->error);
    }
} elseif (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $formation = $_POST['formation'];
    $filiere = $_POST['filiere'];
    $sujet_de_pfe = $_POST['sujet_de_pfe'];
    $entreprise = $_POST['entreprise'];
    $encadrant_interne = $_POST['encadrant_interne'];
    $encadrant_externe = $_POST['encadrant_externe'];
    
    // Gestion du fichier image
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $photoName = basename($_FILES['photo']['name']);
        $photoTmpName = $_FILES['photo']['tmp_name'];
        $photoPath = '../uploads/' . $photoName;
        
        // Déplacer le fichier vers le dossier uploads
        if (move_uploaded_file($photoTmpName, $photoPath)) {
            echo "Image téléchargée avec succès.";
        } else {
            die("Erreur lors du téléchargement de l'image.");
        }
    } else {
        $photoPath = $_POST['current_photo']; // Conserver l'ancienne photo si aucune nouvelle image n'est téléchargée
    }

    // Préparation de la requête de mise à jour
    $sql = "UPDATE etudiants SET nom=?, prenom=?, formation=?, filiere=?, sujet_de_pfe=?, entreprise=?, encadrant_interne=?, encadrant_externe=?, photo=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssi", $nom, $prenom, $formation, $filiere, $sujet_de_pfe, $entreprise, $encadrant_interne, $encadrant_externe, $photoPath, $id);

    if ($stmt->execute()) {
        session_start();
        $_SESSION["update"] = "Étudiant modifié avec succès !";
        header("Location: index.php");
    } else {
        die("Erreur lors de la modification de l'étudiant: " . $stmt->error);
    }
} elseif (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM etudiants WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        session_start();
        $_SESSION["delete"] = "Étudiant supprimé avec succès !";
        header("Location: index.php");
    } else {
        die("Erreur lors de la suppression de l'étudiant: " . $stmt->error);
    }
} else {
    echo "Aucune action spécifiée.";
}
?>
