<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <title>Ajouter étudiant</title>
</head>
<body>
    <div class="container my-5">
        <header class="d-flex justify-content-between my-4">
            <h1>Ajouter un nouvel étudiant</h1>
            <div>
                <a href="index.php" class="btn btn-primary">Retour</a>
            </div>
        </header>
        
        <form action="process.php" method="post" enctype="multipart/form-data">
            <div class="form-element my-4">
                <input type="text" class="form-control" name="nom" placeholder="Nom" required>
            </div>
            <div class="form-element my-4">
                <input type="text" class="form-control" name="prenom" placeholder="Prénom" required>
            </div>
            <div class="form-element my-4">
                <select class="form-control" name="formation" required>
                    <option value="">Formation</option>
                    <option value="Licence">Licence</option>
                    <option value="Cycle Master">Cycle Master</option>
                    <option value="Cycle Ingénieur">Cycle Ingénieur</option>
                </select>
            </div>
            <div class="form-element my-4">
                <select class="form-control" name="filiere" required>
                    <option value="">Filière</option>
                </select>
            </div>
            <div class="form-element my-4">
                <input type="text" class="form-control" name="sujet_de_pfe" placeholder="Sujet de PFE" required>
            </div>
            <div class="form-element my-4">
                <input type="text" class="form-control" name="entreprise" placeholder="Entreprise" required>
            </div>
            <div class="form-element my-4">
                <select class="form-control" name="encadrant_interne" required>
                    <option value="">Encadrant interne</option>
                    <?php
                    include("connect.php");
                    $sql = "SELECT id, CONCAT(nom, ' ', prenom) AS nom_complet FROM enseignants";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['id']}'>{$row['nom_complet']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-element my-4">
                <input type="text" class="form-control" name="encadrant_externe" placeholder="Encadrant Externe">
            </div>
            <div class="form-element my-4">
                <label for="photo" class="form-label">Télécharger une photo</label>
                <input type="file" class="form-control" id="photo" name="photo">
            </div>
            <div class="form-element my-4">
                <input type="submit" name="create" value="Ajouter" class="btn btn-primary">
            </div>
        </form>
    </div>
    <script>
        document.querySelector('select[name="formation"]').addEventListener('change', function() {
            const filiereSelect = document.querySelector('select[name="filiere"]');
            filiereSelect.innerHTML = '<option value="">Filière</option>';
            const formation = this.value;
            if (formation === 'Licence') {
                filiereSelect.innerHTML += '<option value="BA">BA</option><option value="BP">BP</option><option value="GARM">GARM</option><option value="EAU ET ENVIRONNEMENT">EAU ET ENVIRONNEMENT</option><option value="SIR">SIR</option><option value="MIASI">MIASI</option><option value="IEEA">IEEA</option><option value="PCM">PCM</option>';
            } else if (formation === 'Cycle Master') {
                filiereSelect.innerHTML += '<option value="MABIOVA">MABIOVA</option><option value="MOCASIM">MOCASIM</option><option value="GAA">GAA</option><option value="R&D-PCS">R&D-PCS</option><option value="ChemBioNat">ChemBioNat</option><option value="GE">GE</option><option value="MA">MA</option><option value="SDAD">SDAD</option><option value="EVG">EVG</option>';
            } else if (formation === 'Cycle Ingénieur') {
                filiereSelect.innerHTML += '<option value="ISA">ISA</option><option value="IRSI">IRSI</option><option value="GMP">GMP</option><option value="ERME">ERME</option><option value="IFA">IFA</option><option value="GC">GC</option>';
            }
        });
    </script>
</body>
</html>
