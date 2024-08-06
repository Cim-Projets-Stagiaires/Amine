<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../Navbar/navbar.css"> 
    <title>Promotions</title>
    <style>
        .container {
            padding: 2rem;
        }
        .student-photo {
            width: 120px; 
            height: 120px; 
            border-radius: 50%; 
            object-fit: cover; 
            border: 2px solid #dee2e6; 
        }
        .student-card {
            text-align: center;
            margin-bottom: 2rem;
        }
        .student-card h5 {
            margin-top: 1rem;
        }
        .header-title {
            text-align: center;
            margin: 2rem 0;
        }
    </style>
</head>
<body>
    <?php include('../Navbar/navbar.html'); ?>

    <div class="container">
        <header class="header-title">
            <h1>Trombinoscope des étudiants</h1>
        </header>
        
        <div class="row">
        <?php
        include('connect.php'); 
        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sqlSelect = "SELECT id, nom, prenom, photo FROM etudiants";
        $result = mysqli_query($conn, $sqlSelect);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        while ($data = mysqli_fetch_array($result)) {
            $photoPath = !empty($data['photo']) && file_exists('../uploads/' . $data['photo']) ? '../uploads/' . htmlspecialchars($data['photo']) : '../uploads/default.png';
            ?>
            <div class="col-md-3 student-card">
                <a href="view.php?id=<?php echo $data['id']; ?>">
                    <img src="<?php echo $photoPath; ?>" alt="Photo de l'étudiant" class="student-photo">
                </a>
                <h5><?php echo htmlspecialchars($data['nom'] . ' ' . $data['prenom']); ?></h5>
            </div>
            <?php
        }
        ?>
        </div>
    </div>
</body>
</html>
