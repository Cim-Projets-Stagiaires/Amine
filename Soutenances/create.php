<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Ajouter nouvelle soutenance</title>
</head>
<body>
    <div class="container my-5">
    <header class="d-flex justify-content-between my-4">
            <h1>Ajouter une nouvelle soutenance</h1>
            <div>
            <a href="index.php" class="btn btn-primary">Retour</a>
            </div>
        </header>
        
        <form action="process.php" method="post">
            <div class="form-elemnt my-4">
                <input type="text" class="form-control" name="nom" placeholder="Nom Prénom">
            </div>
            <div class="form-elemnt my-4">
                <input type="text" class="form-control" name="sujet" placeholder="Sujet de PFE">
            </div>
            <div class="form-elemnt my-4">
                <input type="text" class="form-control" name="entreprise" placeholder="Entreprise">
            </div>
            <div class="form-element my-4">
                <textarea name="encadrant" id="" class="form-control" placeholder="Encadrant"></textarea>
            </div>
            <div class="form-element my-4">
                <textarea name="jury" id="" class="form-control" placeholder="Jury"></textarea>
            </div>
            <div class="form-element my-4">
                <textarea name="lieu" id="" class="form-control" placeholder="Lieu"></textarea>
            </div>
            <div class="form-element my-4">
                <textarea name="date" id="" class="form-control" placeholder="Date"></textarea>
            </div>
            <div class="form-element my-4">
                <textarea name="heure" id="" class="form-control" placeholder="Heure début - Heure fin"></textarea>
            </div>
            <div class="form-element my-4">
                <input type="submit" name="create" value="Ajouter" class="btn btn-primary">
            </div>
        </form>
        
        
    </div>
</body>
</html>