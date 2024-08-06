<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../Navbar/navbar.css"> 
    <title>Liste des étudiants</title>
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
        .btn-group {
            display: flex;
            justify-content: center;
        }
        .btn-group a {
            margin: 0 5px;
        }
        .student-photo {
            width: 100px; 
            height: 100px; 
            border-radius: 50%; 
            object-fit: cover; 
            border: 2px solid #dee2e6; 
        }
    </style>
</head>
<body>
    <?php include('Navbar_Etudiants/navbar.html'); ?>

    <div class="container-fluid my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Liste des étudiants</h1>
            <div>
                <a href="create.php" class="btn btn-primary">Ajouter un étudiant</a>
            </div>
        </header>
        <?php
        session_start();
        if (isset($_SESSION["create"])) {
        ?>
        <div class="alert alert-success">
            <?php 
            echo stripslashes($_SESSION["create"]);
            ?>
        </div>
        <?php
        unset($_SESSION["create"]);
        }
        ?>
        <?php
        if (isset($_SESSION["update"])) {
        ?>
        <div class="alert alert-success">
            <?php 
            echo stripslashes($_SESSION["update"]);
            ?>
        </div>
        <?php
        unset($_SESSION["update"]);
        }
        ?>
        <?php
        if (isset($_SESSION["delete"])) {
        ?>
        <div class="alert alert-success">
            <?php 
            echo stripslashes($_SESSION["delete"]);
            ?>
        </div>
        <?php
        unset($_SESSION["delete"]);
        }
        ?>
        
        <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Formation</th>
                <th>Filière</th>
                <th>Sujet de PFE</th>
                <th>Entreprise</th>
                <th>Encadrant Interne</th>
                <th>Encadrant Externe</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        include('connect.php');
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sqlSelect = "SELECT e.id, e.nom, e.prenom, e.formation, e.filiere, e.sujet_de_pfe, e.entreprise, e.photo, en.nom AS encadrant_interne, e.encadrant_externe FROM etudiants e LEFT JOIN enseignants en ON e.encadrant_interne = en.id";
        $result = mysqli_query($conn, $sqlSelect);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        while ($data = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td><?php echo $data['id']; ?></td>
                <td>
                    <?php if (!empty($data['photo']) && file_exists('../uploads/' . $data['photo'])): ?>
                        <img src="../uploads/<?php echo htmlspecialchars($data['photo']); ?>" alt="Photo de l'étudiant" class="student-photo">
                    <?php else: ?>
                        <img src="../uploads/default.png" alt="Photo par défaut" class="student-photo">
                    <?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars(stripslashes($data['nom'])); ?></td>
                <td><?php echo htmlspecialchars(stripslashes($data['prenom'])); ?></td>
                <td><?php echo htmlspecialchars(stripslashes($data['formation'])); ?></td>
                <td><?php echo htmlspecialchars(stripslashes($data['filiere'])); ?></td>
                <td><?php echo htmlspecialchars(stripslashes($data['sujet_de_pfe'])); ?></td>
                <td><?php echo htmlspecialchars(stripslashes($data['entreprise'])); ?></td>
                <td><?php echo htmlspecialchars(stripslashes($data['encadrant_interne'])); ?></td>
                <td><?php echo htmlspecialchars(stripslashes($data['encadrant_externe'])); ?></td>
                
                <td>
                    <div class="btn-group">
                        <a href="view.php?id=<?php echo $data['id']; ?>" class="btn btn-info btn-sm">Plus</a>
                        <a href="edit.php?id=<?php echo $data['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
<!--                         <a href="delete.php?id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
 -->                    </div>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
        </table>
    </div>
</body>
</html>
