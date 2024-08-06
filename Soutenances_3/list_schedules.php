<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../Navbar/navbar.css"> 
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
        table {
            width: 100%;
        }
        table td, table th {
            vertical-align: middle;
            text-align: center;
            padding: 10px !important;
            word-wrap: break-word;
        }
        table th {
            font-size: 1.25rem; 
            font-weight: bold; 
        }
        table td {
            font-weight: 600; 
        }
        table tr:nth-child(even) td {
            background-color: #e9ecef; 
        }
        table a {
            color: #000; 
            text-decoration: none; 
        }
        table a:hover {
            text-decoration: underline; 
        }
        .btn-group {
            display: flex;
            justify-content: center;
        }
        .btn-group a {
            margin: 0 5px;
        }
        .col-extended {
            min-width: 150px; 
        }
        .col-wrapped {
            white-space: normal; 
        }
        .text-left {
            text-align: left !important; 
        }
    </style>
</head>
<body>
    <?php include('../Navbar/navbar.html'); ?>

    <div class="container-fluid my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Liste des soutenances</h1>
            <div>
                <a href="formulaire_soutenances.php" class="btn btn-primary">Planifier des soutenances</a>
            </div>
        </header>
        
        <?php
        session_start();
        if (isset($_SESSION['schedule'])) {
        ?>
        <div class="alert alert-success">
            <?php 
            echo $_SESSION['schedule'];
            unset($_SESSION['schedule']);
            ?>
        </div>
        <?php
        }
        ?>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="col-reduced">N°</th>
                        <th class="col-reduced">Étudiant</th>
                        <th class="col-wrapped">Sujet de PFE</th>
                        <th class="col-reduced">Entreprise</th>
                        <th class="col-extended">Encadrant Interne</th>
                        <th class="col-reduced">Encadrant Externe</th>
                        <th class="col-extended text-left">Jury</th>
                        <th class="col-reduced">Lieu</th>
                        <th class="col-extended">Date</th>
                        <th class="col-reduced">Heure</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                include('connect.php');

                $sqlSelect = "
                    SELECT s.id, e.prenom AS etudiant_prenom, e.nom AS etudiant_nom, s.sujet_de_pfe, s.nom_entreprise, 
                        s.encadrant_interne, s.encadrant_externe, sa.nom AS nom_salle, s.date, s.heure, s.nom_jury 
                    FROM soutenances s
                    JOIN etudiants e ON s.id_etudiant = e.id
                    JOIN salles sa ON s.id_salle = sa.id
                    ORDER BY s.heure";
                    
                $result = mysqli_query($conn, $sqlSelect);
                while ($data = mysqli_fetch_array($result)) {
                    $jury = explode(',', $data['nom_jury']); 
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($data['id']); ?></td>
                        <td><?php echo htmlspecialchars($data['etudiant_nom'] . ' ' . $data['etudiant_prenom']); ?></td>
                        <td class="col-wrapped"><?php echo htmlspecialchars($data['sujet_de_pfe']); ?></td>
                        <td><?php echo htmlspecialchars($data['nom_entreprise']); ?></td>
                        <td class="col-extended"><a href="jury_details.php?name=<?php echo urlencode($data['encadrant_interne']); ?>"><?php echo htmlspecialchars($data['encadrant_interne']); ?></a></td>
                        <td><?php echo htmlspecialchars($data['encadrant_externe']); ?></td>
                        <td class="col-extended text-left">
                            <?php
                            foreach ($jury as $member) {
                                $member = trim($member); 
                                echo '- <a href="jury_details.php?name=' . urlencode($member) . '">' . htmlspecialchars($member) . '</a><br>';
                            }
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($data['nom_salle']); ?></td>
                        <td class="col-extended"><?php echo date('d-m-Y', strtotime($data['date'])); ?></td>
                        <td><?php echo date('H:i', strtotime($data['heure'])); ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>