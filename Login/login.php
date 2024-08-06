<?php
session_start();
include 'connect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND role = '$role'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $user;

        if ($user['role'] === 'etudiant') {
            header('Location: ../Etudiants_vue/index.php');
        } elseif ($user['role'] === 'enseignant') {
            header('Location: ../Soutenances_3/list_schedules.php');
        }
    } else {
        echo "Email ou mot de passe incorrect.";
    }
}
?>
