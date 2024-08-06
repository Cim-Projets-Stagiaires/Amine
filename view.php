<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Détails de l'enseignant</title>
    <style>
        .teacher-details {
            background-color: #f5f5f5;
            border-radius: 0.5rem;
            border: 1px solid #dee2e6;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            padding: 2rem;
            margin: 1rem 0;
        }
        .teacher-details h3 {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .teacher-details p {
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Détails de l'enseignant</h1>
            <div>
                <a href="index.php" class="btn btn-primary">Retour</a>
            </div>
        </header>
        <div class="teacher-details">
            <?php
            include("connect.php");
            $id = $_GET['id'];
            if ($id) {
                $sql = "SELECT * FROM enseignants WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                if ($row = mysqli_fetch_array($result)) {
            ?>
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
                            <h3>Département:</h3>
                            <p><?php echo htmlspecialchars($row["departement"]); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h3>Spécialité:</h3>
                            <p><?php echo htmlspecialchars($row["specialite"]); ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h3>Établissement:</h3>
                            <p><?php echo htmlspecialchars($row["etablissement"]); ?></p>
                        </div>
                    </div>
            <?php
                } else {
                    echo "<h3>Aucun enseignant trouvé</h3>";
                }
            } else {
                echo "<h3>ID de l'enseignant non fourni</h3>";
            }
            ?>
        </div>
    </div>
</body>
</html>
