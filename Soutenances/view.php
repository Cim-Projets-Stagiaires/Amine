<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Détails</title>
    <style>
        .details-container {
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 5px;
        }
        .details-container h3 {
            margin-top: 20px;
        }
        .details-container p {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Détails de la soutenance</h1>
            <div>
                <a href="index.php" class="btn btn-primary">Retour</a>
            </div>
        </header>
        <div class="details-container">
            <?php
            include("connect.php");
            $id = $_GET['id'];
            if ($id) {
                $sql = "SELECT soutenances.*, etudiants.nom AS etudiant_nom, etudiants.prenom AS etudiant_prenom, salles.nom AS salle_nom 
                        FROM soutenances 
                        JOIN etudiants ON soutenances.id_etudiant = etudiants.id 
                        JOIN salles ON soutenances.id_salle = salles.id 
                        WHERE soutenances.id = $id";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    if ($row) {
                        ?>
                        <h3>Nom Prénom:</h3>
                        <p><?php echo $row["etudiant_nom"] . ' ' . $row["etudiant_prenom"]; ?></p>
                        <h3>Sujet de PFE:</h3>
                        <p><?php echo $row["sujet_de_pfe"]; ?></p>
                        <h3>Entreprise:</h3>
                        <p><?php echo $row["nom_entreprise"]; ?></p>
                        <h3>Encadrant Interne:</h3>
                        <p><?php echo $row["encadrant_interne"]; ?></p>
                        <h3>Encadrant Externe:</h3>
                        <p><?php echo $row["encadrant_externe"]; ?></p>
                        <h3>Salle:</h3>
                        <p><?php echo $row["salle_nom"]; ?></p>
                        <h3>Date:</h3>
                        <p><?php echo $row["date"]; ?></p>
                        <h3>Heure:</h3>
                        <p><?php echo $row["heure"]; ?></p>
                        <?php
                    } else {
                        echo "<h3>Aucune soutenance trouvée</h3>";
                    }
                } else {
                    echo "Erreur dans la requête: " . mysqli_error($conn);
                }
            } else {
                echo "<h3>ID de soutenance non fourni</h3>";
            }
            ?>
        </div>
    </div>
</body>
</html>
