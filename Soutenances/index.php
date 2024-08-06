<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Liste des soutenances</title>
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        .container-fluid {
            flex: 1;
        }
        table td, table th {
            vertical-align: middle;
            text-align: center;
            padding: 20px !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Liste des soutenances</h1>
        </header>
        
        <?php
        session_start();
        if (isset($_SESSION["message"])) {
            echo '<div class="alert alert-success">' . $_SESSION["message"] . '</div>';
            unset($_SESSION["message"]);
        }
        ?>
        
        <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Étudiant</th>
                <th>Sujet de PFE</th>
                <th>Entreprise</th>
                <th>Encadrant Interne</th>
                <th>Encadrant Externe</th>
                <th>Salle</th>
                <th>Date</th>
                <th>Heure</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        
        <?php
        include('connect.php');
        $sqlSelect = "SELECT soutenances.id, etudiants.nom AS etudiant_nom, etudiants.prenom AS etudiant_prenom, soutenances.sujet_de_pfe, soutenances.nom_entreprise, soutenances.encadrant_interne, soutenances.encadrant_externe, salles.nom AS salle_nom, soutenances.date, soutenances.heure 
                      FROM soutenances 
                      JOIN etudiants ON soutenances.id_etudiant = etudiants.id
                      JOIN salles ON soutenances.id_salle = salles.id";
        $result = mysqli_query($conn, $sqlSelect);
        if (!$result) {
            echo "Erreur dans la requête: " . mysqli_error($conn);
        } else {
            while($data = mysqli_fetch_array($result)){
                ?>
                <tr>
                    <td><?php echo $data['id']; ?></td>
                    <td><?php echo $data['etudiant_nom'] . ' ' . $data['etudiant_prenom']; ?></td>
                    <td><?php echo $data['sujet_de_pfe']; ?></td>
                    <td><?php echo $data['nom_entreprise']; ?></td>
                    <td><?php echo $data['encadrant_interne']; ?></td>
                    <td><?php echo $data['encadrant_externe']; ?></td>
                    <td><?php echo $data['salle_nom']; ?></td>
                    <td><?php echo $data['date']; ?></td>
                    <td><?php echo $data['heure']; ?></td>
                    
                    <td class="d-flex justify-content-around">
                        <a href="view.php?id=<?php echo $data['id']; ?>" class="btn btn-info btn-sm mx-1">Plus</a>
                        <a href="edit.php?id=<?php echo $data['id']; ?>" class="btn btn-warning btn-sm mx-1">Modifier</a>
                        <a href="delete.php?id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm mx-1">Supprimer</a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
        </table>
    </div>
</body>
</html>
