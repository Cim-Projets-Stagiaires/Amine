<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Modifier soutenance</title>
</head>
<body>
    <div class="container my-5">
        <header class="d-flex justify-content-between my-4">
            <h1>Modifier la soutenance</h1>
            <div>
                <a href="index.php" class="btn btn-primary">Retour</a>
            </div>
        </header>
        
        <form action="process.php" method="post">
            <?php 
            if (isset($_GET['id'])) {
                include("connect.php");
                $id = $_GET['id'];
                $sql = "SELECT * FROM soutenances WHERE id=$id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);

                $etudiants = mysqli_query($conn, "SELECT * FROM etudiants");

                $enseignants = mysqli_query($conn, "SELECT * FROM enseignants");

                $salles = mysqli_query($conn, "SELECT * FROM salles");
                ?>
                
                <div class="mb-3">
                    <label for="etudiant" class="form-label">Étudiant</label>
                    <select name="id_etudiant" id="etudiant" class="form-control" required>
                        <option value="" disabled>Choisir un étudiant</option>
                        <?php while($etudiant = mysqli_fetch_assoc($etudiants)): ?>
                            <option value="<?= $etudiant['id'] ?>" <?= $etudiant['id'] == $row['id_etudiant'] ? 'selected' : '' ?>>
                                <?= $etudiant['nom'] . ' ' . $etudiant['prenom'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="sujet_de_pfe" class="form-label">Sujet de PFE</label>
                    <input type="text" name="sujet_de_pfe" id="sujet_de_pfe" class="form-control" value="<?= $row['sujet_de_pfe'] ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="entreprise" class="form-label">Nom de l'entreprise</label>
                    <input type="text" name="entreprise" id="entreprise" class="form-control" value="<?= $row['nom_entreprise'] ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="encadrant_interne" class="form-label">Encadrant interne</label>
                    <input type="text" name="encadrant_interne" id="encadrant_interne" class="form-control" value="<?= $row['encadrant_interne'] ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="encadrant_externe" class="form-label">Encadrant externe</label>
                    <input type="text" name="encadrant_externe" id="encadrant_externe" class="form-control" value="<?= $row['encadrant_externe'] ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="salle" class="form-label">Salle</label>
                    <select name="id_salle" id="salle" class="form-control" required>
                        <option value="" disabled>Choisir une salle</option>
                        <?php while($salle = mysqli_fetch_assoc($salles)): ?>
                            <option value="<?= $salle['id'] ?>" <?= $salle['id'] == $row['id_salle'] ? 'selected' : '' ?>>
                                <?= $salle['nom'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control" value="<?= $row['date'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="heure" class="form-label">Heure</label>
                    <input type="time" name="heure" id="heure" class="form-control" value="<?= $row['heure'] ?>" required>
                </div>
                
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <button type="submit" name="update_soutenance" class="btn btn-primary">Modifier</button>
            <?php 
            } else {
                echo "<p class='text-danger'>Aucune soutenance trouvée !</p>";
            }
            ?>
        </form>
    </div>
</body>
</html>
