<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../Navbar/navbar.css"> 
    <title>Liste des enseignants</title>
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
    <?php include('../Navbar/navbar.html'); ?>

    <div class="container-fluid my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Liste des enseignants</h1>
            <div>
                <a href="create.php" class="btn btn-primary">Ajouter un enseignant</a>
            </div>
        </header>
        <?php
        session_start();
        if (isset($_SESSION["create"])) {
        ?>
        <div class="alert alert-success">
            <?php 
            echo $_SESSION["create"];
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
            echo $_SESSION["update"];
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
            echo $_SESSION["delete"];
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
                <th>Nom</th>
                <th>Prénom</th>
                <th>Département</th>
                <th>Spécialité</th>
                <th>Etablissement</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        
        <?php
        include('connect.php');
        $sqlSelect = "SELECT * FROM enseignants";
        $result = mysqli_query($conn,$sqlSelect);
        while($data = mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?php echo $data['id']; ?></td>
                <td><?php echo $data['nom']; ?></td>
                <td><?php echo $data['prenom']; ?></td>
                <td><?php echo $data['departement']; ?></td>
                <td><?php echo $data['specialite']; ?></td>
                <td><?php echo $data['etablissement']; ?></td>
                <td class="d-flex justify-content-around"> 
                    <a href="view.php?id=<?php echo $data['id']; ?>" class="btn btn-info btn-sm mx-1">Plus</a>
                    <a href="edit.php?id=<?php echo $data['id']; ?>" class="btn btn-warning btn-sm mx-1">Modifier</a>
                    <a href="delete.php?id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm mx-1">Supprimer</a>
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
