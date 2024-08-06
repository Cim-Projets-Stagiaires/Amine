<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Modifier enseignant</title>
    <script>
        function toggleOtherInput(selectElement, inputId) {
            var input = document.getElementById(inputId);
            if (selectElement.value === 'autre') {
                input.style.display = 'block';
            } else {
                input.style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <div class="container my-5">
        <header class="d-flex justify-content-between my-4">
            <h1>Modifier l'enseignant</h1>
            <div>
                <a href="index.php" class="btn btn-primary">Retour</a>
            </div>
        </header>
        <form action="process.php" method="post">
            <?php 
            if (isset($_GET['id'])) {
                include("connect.php");
                $id = $_GET['id'];
                $sql = "SELECT * FROM enseignants WHERE id=$id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
                
                $departement_other_selected = !in_array($row["departement"], ["PHYSIQUE APPLIQUÉE", "MATHEMATIQUES", "INFORMATIQUE", "SCIENCES CHIMIQUES"]);
                $etablissement_other_selected = !in_array($row["etablissement"], ["FSTG", "FSSM", "ENSA"]);
                $specialite_other_selected = !in_array($row["specialite"], ["Matériaux", "Électronique", "Télécommunications"]);
                ?>
                <div class="form-element my-4">
                    <input type="text" class="form-control" name="nom" placeholder="Nom" value="<?php echo htmlspecialchars($row["nom"]); ?>" required>
                </div>
                <div class="form-element my-4">
                    <input type="text" class="form-control" name="prenom" placeholder="Prénom" value="<?php echo htmlspecialchars($row["prenom"]); ?>" required>
                </div>
                <div class="form-element my-4">
                    <select id="departement" name="departement" class="form-control" onchange="toggleOtherInput(this, 'departement_other')">
                        <option value="PHYSIQUE APPLIQUÉE" <?php echo $row["departement"] === 'PHYSIQUE APPLIQUÉE' ? 'selected' : ''; ?>>PHYSIQUE APPLIQUÉE</option>
                        <option value="MATHEMATIQUES" <?php echo $row["departement"] === 'MATHEMATIQUES' ? 'selected' : ''; ?>>MATHEMATIQUES</option>
                        <option value="INFORMATIQUE" <?php echo $row["departement"] === 'INFORMATIQUE' ? 'selected' : ''; ?>>INFORMATIQUE</option>
                        <option value="SCIENCES CHIMIQUES" <?php echo $row["departement"] === 'SCIENCES CHIMIQUES' ? 'selected' : ''; ?>>SCIENCES CHIMIQUES</option>
                        <option value="autre" <?php echo $departement_other_selected ? 'selected' : ''; ?>>Autre</option>
                    </select>
                    <input type="text" id="departement_other" name="departement_other" class="form-control mt-2" placeholder="Veuillez préciser" value="<?php echo $departement_other_selected ? htmlspecialchars($row["departement"]) : ''; ?>" style="<?php echo $departement_other_selected ? 'display: block;' : 'display: none;'; ?>">
                </div>
                <div class="form-element my-4">
                    <select id="specialite" name="specialite" class="form-control" onchange="toggleOtherInput(this, 'specialite_other')">
                        <option value="Physique du solide" <?php echo $row["specialite"] === 'Physique du solide' ? 'selected' : ''; ?>>Physique du solide</option>
                        <option value="Électronique" <?php echo $row["specialite"] === 'Electronique' ? 'selected' : ''; ?>>Electronique</option>
                        <option value="Télécommunications" <?php echo $row["specialite"] === 'Télécommunications' ? 'selected' : ''; ?>>Télécommunications</option>
                        <option value="Electrotechnique" <?php echo $row["specialite"] === 'Electrotechnique' ? 'selected' : ''; ?>>Electrotechnique</option>
                        <option value="Automatique" <?php echo $row["specialite"] === 'Automatique' ? 'selected' : ''; ?>>Automatique</option>

                        <option value="autre" <?php echo $specialite_other_selected ? 'selected' : ''; ?>>Autre</option>
                    </select>
                    <input type="text" id="specialite_other" name="specialite_other" class="form-control mt-2" placeholder="Veuillez préciser" value="<?php echo $specialite_other_selected ? htmlspecialchars($row["specialite"]) : ''; ?>" style="<?php echo $specialite_other_selected ? 'display: block;' : 'display: none;'; ?>">
                </div>
                <div class="form-element my-4">
                    <select id="etablissement" name="etablissement" class="form-control" onchange="toggleOtherInput(this, 'etablissement_other')" required>
                        <option value="FSTG" <?php echo $row["etablissement"] === 'FSTG' ? 'selected' : ''; ?>>FSTG</option>
                        <option value="FSSM" <?php echo $row["etablissement"] === 'FSSM' ? 'selected' : ''; ?>>FSSM</option>
                        <option value="ENSA" <?php echo $row["etablissement"] === 'ENSA' ? 'selected' : ''; ?>>ENSA</option>
                        <option value="autre" <?php echo $etablissement_other_selected ? 'selected' : ''; ?>>Autre</option>
                    </select>
                    <input type="text" id="etablissement_other" name="etablissement_other" class="form-control mt-2" placeholder="Veuillez préciser" value="<?php echo $etablissement_other_selected ? htmlspecialchars($row["etablissement"]) : ''; ?>" style="<?php echo $etablissement_other_selected ? 'display: block;' : 'display: none;'; ?>">
                </div>
                <div class="form-element my-4">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="update" value="Valider" class="btn btn-primary">
                </div>
                <?php
            }
            ?>
        </form>
    </div>
</body>
</html>
