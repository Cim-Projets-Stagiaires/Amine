<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Ajouter nouveau enseignant</title>
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
            <h1>Ajouter un nouveau enseignant</h1>
            <div>
                <a href="index.php" class="btn btn-primary">Retour</a>
            </div>
        </header>
        
        <form action="process.php" method="post">
            <div class="form-element my-4">
                <input type="text" class="form-control" name="nom" placeholder="Nom" required>
            </div>
            <div class="form-element my-4">
                <input type="text" class="form-control" name="prenom" placeholder="Prénom" required>
            </div>
            <div class="form-element my-4">
                <select id="departement" name="departement" class="form-control" onchange="toggleOtherInput(this, 'departement_other')">
                    <option value="" disabled selected>Département</option>    
                    <option value="PHYSIQUE APPLIQUÉE">PHYSIQUE APPLIQUÉE</option>
                    <option value="MATHEMATIQUES">MATHEMATIQUES</option>
                    <option value="INFORMATIQUE">INFORMATIQUE</option>
                    <option value="SCIENCES CHIMIQUES">SCIENCES CHIMIQUES</option>
                    <option value="autre">Autre</option>
                </select>
                <input type="text" id="departement_other" name="departement_other" class="form-control mt-2" placeholder="Saisir un département" style="display: none;">
            </div>
            <div class="form-element my-4">
                <select id="specialite" name="specialite" class="form-control" onchange="toggleOtherInput(this, 'specialite_other')">
                    <option value="" disabled selected>Spécialité</option>
                    <option value="Physique du solide">Physique du solide</option>
                    <option value="Electronique">Electronique</option>
                    <option value="Télécommunications">Télécommunications</option>
                    <option value="Electrotechnique">Electrotechnique</option>
                    <option value="Automatique">Automatique</option>
                    
                    <option value="autre">Autre</option>
                </select>
                <input type="text" id="specialite_other" name="specialite_other" class="form-control mt-2" placeholder="Saisir une spécialité" style="display: none;">
            </div>
            <div class="form-element my-4">
                <select id="etablissement" name="etablissement" class="form-control" onchange="toggleOtherInput(this, 'etablissement_other')" required>
                    <option value="" disabled selected>Établissement</option>     
                    <option value="FSTG">FSTG</option>
                    <option value="FSSM">FSSM</option>
                    <option value="ENSA">ENSA</option>
                    <option value="autre">Autre</option>
                </select>
                <input type="text" id="etablissement_other" name="etablissement_other" class="form-control mt-2" placeholder="Saisir un établissement" style="display: none;">
            </div>
            <div class="form-element my-4">
                <input type="submit" name="create" value="Ajouter" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>
