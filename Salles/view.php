<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Détails de la salle</title>
    <style>
        .room-details {
            background-color: #f5f5f5;
            border-radius: 0.5rem;
            border: 1px solid #dee2e6;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            padding: 2rem;
            margin: 1rem 0;
        }
        .room-details h3 {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .room-details p {
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Détails de la salle</h1>
            <div>
                <a href="index.php" class="btn btn-primary">Retour</a>
            </div>
        </header>
        <div class="room-details">
            <?php
            include("connect.php");
            $id = $_GET['id'];
            if ($id) {
                $sql = "SELECT * FROM salles WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                if ($row = mysqli_fetch_array($result)) {
            ?>
                    <h3>Nom:</h3>
                    <p><?php echo htmlspecialchars($row["nom"]); ?></p>
            <?php
                } else {
                    echo "<h3>Aucune salle trouvée</h3>";
                }
            } else {
                echo "<h3>ID non fourni</h3>";
            }
            ?>
        </div>
    </div>
</body>
</html>
