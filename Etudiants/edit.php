<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <title>Modifier étudiant</title>
</head>
<body>
    <div class="container my-5">
        <header class="d-flex justify-content-between my-4">
            <h1>Modifier l'étudiant</h1>
            <div>
                <a href="index.php" class="btn btn-primary">Retour</a>
            </div>
        </header>
        <form action="process.php" method="post" enctype="multipart/form-data">
            <?php 
            if (isset($_GET['id'])) {
                include("connect.php");
                $id = intval($_GET['id']);
                $sql = "SELECT * FROM etudiants WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                ?>
            <div class="form-element my-4">
                <input type="text" class="form-control" name="nom" placeholder="Nom" value="<?php echo htmlspecialchars(stripslashes($row["nom"]), ENT_QUOTES); ?>" required>
            </div>
            <div class="form-element my-4">
                <input type="text" class="form-control" name="prenom" placeholder="Prénom" value="<?php echo htmlspecialchars(stripslashes($row["prenom"]), ENT_QUOTES); ?>" required>
            </div>
            <div class="form-element my-4">
                <select class="form-control" name="formation" required>
                    <option value="">Formation</option>
                    <option value="Licence" <?php echo ($row["formation"] == 'Licence') ? 'selected' : ''; ?>>Licence</option>
                    <option value="Cycle Master" <?php echo ($row["formation"] == 'Cycle Master') ? 'selected' : ''; ?>>Cycle Master</option>
                    <option value="Cycle Ingénieur" <?php echo ($row["formation"] == 'Cycle Ingénieur') ? 'selected' : ''; ?>>Cycle Ingénieur</option>
                </select>
            </div>
            <div class="form-element my-4">
                <select class="form-control" name="filiere" required>
                    <option value="">Filière</option>
                </select>
            </div>
            <div class="form-element my-4">
                <input type="text" class="form-control" name="sujet_de_pfe" placeholder="Sujet de PFE" value="<?php echo htmlspecialchars(stripslashes($row["sujet_de_pfe"]), ENT_QUOTES); ?>" required>
            </div>
            <div class="form-element my-4">
                <input type="text" class="form-control" name="entreprise" placeholder="Entreprise" value="<?php echo htmlspecialchars(stripslashes($row["entreprise"]), ENT_QUOTES); ?>" required>
            </div>
            <div class="form-element my-4">
                <select class="form-control" name="encadrant_interne" required>
                    <option value="">Encadrant interne</option>
                    <?php
                    $sql = "SELECT id, CONCAT(nom, ' ', prenom) AS nom_complet FROM enseignants";
                    $result = mysqli_query($conn, $sql);
                    while ($teacher = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$teacher['id']}'" . ($teacher['id'] == $row['encadrant_interne'] ? ' selected' : '') . ">{$teacher['nom_complet']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-element my-4">
                <input type="text" class="form-control" name="encadrant_externe" placeholder="Encadrant Externe" value="<?php echo htmlspecialchars(stripslashes($row["encadrant_externe"]), ENT_QUOTES); ?>">
            </div>
            <div class="form-element my-4">
                <label for="photo" class="form-label">Changer la photo</label>
                <input type="file" class="form-control" id="photo" name="photo">
                <?php if (!empty($row['photo'])): ?>
                    <img src="../uploads/<?php echo htmlspecialchars($row['photo']); ?>" alt="Photo actuelle" class="img-thumbnail my-2" style="width: 150px;">
                <?php endif; ?>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-element my-4">
                <input type="submit" name="update" value="Valider" class="btn btn-primary">
            </div>
            <?php 
            } else {
                echo "Aucun ID spécifié.";
            }
            ?>
        </form>
    </div>
    <script>
        function updateFiliereOptions(selectedFormation) {
            const filiereSelect = document.querySelector('select[name="filiere"]');
            filiereSelect.innerHTML = '<option value="">Filière</option>';
            if (selectedFormation === 'Licence') {
                filiereSelect.innerHTML += '<option value="BA">BA</option><option value="BP">BP</option><option value="GARM">GARM</option><option value="EAU ET ENVIRONNEMENT">EAU ET ENVIRONNEMENT</option><option value="SIR">SIR</option><option value="MIASI">MIASI</option><option value="IEEA">IEEA</option><option value="PCM">PCM</option>';
            } else if (selectedFormation === 'Cycle Master') {
                filiereSelect.innerHTML += '<option value="MABIOVA">MABIOVA</option><option value="MOCASIM">MOCASIM</option><option value="GAA">GAA</option><option value="R&D-PCS">R&D-PCS</option><option value="ChemBioNat">ChemBioNat</option><option value="GE">GE</option><option value="MA">MA</option><option value="SDAD">SDAD</option><option value="EVG">EVG</option>';
            } else if (selectedFormation === 'Cycle Ingénieur') {
                filiereSelect.innerHTML += '<option value="ISA">ISA</option><option value="IRSI">IRSI</option><option value="GMP">GMP</option><option value="ERME">ERME</option><option value="IFA">IFA</option><option value="GC">GC</option>';
            }
        }

        document.querySelector('select[name="formation"]').addEventListener('change', function() {
            updateFiliereOptions(this.value);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const selectedFormation = document.querySelector('select[name="formation"]').value;
            updateFiliereOptions(selectedFormation);
            
            const selectedFiliere = "<?php echo htmlspecialchars(stripslashes($row['filiere']), ENT_QUOTES); ?>";
            if (selectedFiliere) {
                const filiereSelect = document.querySelector('select[name="filiere"]');
                for (let option of filiereSelect.options) {
                    if (option.value === selectedFiliere) {
                        option.selected = true;
                        break;
                    }
                }
            }
        });
    </script>
</body>
</html>
