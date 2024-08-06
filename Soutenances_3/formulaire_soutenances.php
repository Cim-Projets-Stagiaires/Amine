<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Navbar/navbar.css"> 
    <title>Planifier des soutenances</title>
</head>
<body>
    <?php include('../Navbar/navbar.html'); ?>

    <div class="container mt-5">
        <header class="d-flex justify-content-between my-4">
            <h2>Planifier des soutenances</h2>
            <div>
                <a href="list_schedules.php" class="btn btn-primary">Retour à la liste des soutenances</a>
            </div>
        </header>
        <form action="generate_schedule.php" method="post">
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label">Durée de la soutenance</label>
                <select class="form-control" id="duration" name="duration" required>
                    <option value="30">30 min</option>
                    <option value="45">45 min</option>
                    <option value="60">60 min</option>
                    <option value="75">75 min</option>
                    <option value="90">90 min</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="start_time" class="form-label">Heure de début</label>
                <input type="time" class="form-control" id="start_time" name="start_time" required>
            </div>
            <button type="submit" name="generate" class="btn btn-primary">Générer l'emploi du temps</button>
        </form>
    </div>
</body>
</html>
