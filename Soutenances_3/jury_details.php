<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Détails du jury</title>
    <style>
        .jury-details {
            background-color: #f5f5f5;
            border-radius: 0.5rem;
            border: 1px solid #dee2e6;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            padding: 2rem;
            margin: 1rem 0;
        }
        .jury-details h3 {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .jury-details p {
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Détails du membre du jury</h1>
            <div>
                <a href="list_schedules.php" class="btn btn-primary">Retour à la liste des soutenances</a>
            </div>
        </header>
        <div class="jury-details">
            <?php
            include('connect.php');
            if (isset($_GET['name'])) {
                $jury_name = mysqli_real_escape_string($conn, $_GET['name']);
                
                $sql = "SELECT * FROM enseignants WHERE CONCAT_WS(' ', nom, prenom) = '$jury_name'";
                $result = mysqli_query($conn, $sql);
                
                if ($data = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Nom:</h3>
                            <p><?php echo htmlspecialchars($data['nom']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h3>Prénom:</h3>
                            <p><?php echo htmlspecialchars($data['prenom']); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Département:</h3>
                            <p><?php echo htmlspecialchars($data['departement']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h3>Spécialité:</h3>
                            <p><?php echo htmlspecialchars($data['specialite']); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Établissement:</h3>
                            <p><?php echo htmlspecialchars($data['etablissement']); ?></p>
                        </div>
                    </div>
                    <?php
                } else {
                    echo '<p>Aucun détail trouvé pour ce membre du jury.</p>';
                }
            } else {
                echo '<p>Nom du jury non spécifié.</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>
