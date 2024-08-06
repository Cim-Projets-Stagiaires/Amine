<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Détails de l'étudiant</title>
    <style>
        .student-details {
            background-color: #f5f5f5;
            border-radius: 0.5rem;
            border: 1px solid #dee2e6;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            padding: 2rem;
            margin: 1rem 0;
        }
        .student-details h3 {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .student-details p {
            font-size: 1rem;
        }
        .photo-container {
            text-align: center;
            margin-bottom: 1rem;
        }
        .photo-container img {
            width: 150px; 
            height: 150px; 
            border-radius: 50%; 
            object-fit: cover; 
            border: 2px solid #dee2e6; 
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Détails de l'étudiant</h1>
            <div>
                <a href="index.php" class="btn btn-primary">Retour</a>
            </div>
        </header>
        <div class="student-details">
            <?php
            include("connect.php");
            $id = $_GET['id'];
            if ($id) {
                $sql = "SELECT e.*, en.nom AS encadrant_interne_nom FROM etudiants e LEFT JOIN enseignants en ON e.encadrant_interne = en.id WHERE e.id = $id";
                $result = mysqli_query($conn, $sql);
                if ($row = mysqli_fetch_array($result)) {
                    $photoPath = $row["photo"] ? htmlspecialchars($row["photo"]) : '../uploads/default.png'; 
            ?>
                    <div class="photo-container">
                        <img src="<?php echo $photoPath; ?>" alt="Photo de l'étudiant">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h3>Nom:</h3>
                            <p><?php echo htmlspecialchars($row["nom"]); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h3>Prénom:</h3>
                            <p><?php echo htmlspecialchars($row["prenom"]); ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h3>Formation:</h3>
                            <p><?php echo htmlspecialchars($row["formation"]); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h3>Filière:</h3>
                            <p><?php echo htmlspecialchars($row["filiere"]); ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h3>Sujet de PFE:</h3>
                            <p><?php echo htmlspecialchars($row["sujet_de_pfe"]); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h3>Entreprise:</h3>
                            <p><?php echo htmlspecialchars($row["entreprise"]); ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h3>Encadrant Interne:</h3>
                            <p><?php echo htmlspecialchars($row["encadrant_interne_nom"]); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h3>Encadrant Externe:</h3>
                            <p><?php echo htmlspecialchars($row["encadrant_externe"]); ?></p>
                        </div>
                    </div>
            <?php
                } else {
                    echo "<h3>Aucun étudiant trouvé</h3>";
                }
            } else {
                echo "<h3>ID non fourni</h3>";
            }
            ?>
        </div>
    </div>
</body>
</html>
