<?php
session_start();
include("connect.php");

if (isset($_POST['generate'])) {
    $date = $_POST['date'];
    $duration = intval($_POST['duration']); 
    $startTime = $_POST['start_time'];

    $timeSlots = [];
    $currentTime = strtotime($startTime);
    while (date('H:i', $currentTime) < '12:00') {
        $timeSlots[] = date('H:i', $currentTime);
        $currentTime = strtotime("+$duration minutes", $currentTime);
    }
    $currentTime = strtotime('15:00');
    while (date('H:i', $currentTime) < '19:00') {
        $timeSlots[] = date('H:i', $currentTime);
        $currentTime = strtotime("+$duration minutes", $currentTime);
    }

    $deleteOldSchedules = "DELETE FROM soutenances";
    mysqli_query($conn, $deleteOldSchedules);

    $sqlStudents = "SELECT * FROM etudiants";
    $resultStudents = mysqli_query($conn, $sqlStudents);
    $students = mysqli_fetch_all($resultStudents, MYSQLI_ASSOC);

    $sqlRooms = "SELECT * FROM salles";
    $resultRooms = mysqli_query($conn, $sqlRooms);
    $rooms = mysqli_fetch_all($resultRooms, MYSQLI_ASSOC);

    $sqlTeachers = "SELECT * FROM enseignants";
    $resultTeachers = mysqli_query($conn, $sqlTeachers);
    $teachers = mysqli_fetch_all($resultTeachers, MYSQLI_ASSOC);

    $stmtInsert = mysqli_prepare($conn, "INSERT INTO soutenances (id_etudiant, id_salle, date, heure, sujet_de_pfe, nom_entreprise, encadrant_interne, encadrant_externe, nom_salle, nom_jury) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $roomUsage = [];
    $teacherUsage = [];

    foreach ($students as $student) {
        $assigned = false;

        foreach ($timeSlots as $hour) {
            $availableRoom = null;
            foreach ($rooms as $room) {
                if (!isset($roomUsage[$hour][$room['id']])) {
                    $availableRoom = $room;
                    $roomUsage[$hour][$room['id']] = true;
                    break;
                }
            }

            if (!$availableRoom) {
                continue; 
            }

            $internalSupervisor = $student['encadrant_interne'];
            $internalTeacher = array_filter($teachers, fn($t) => $t['id'] == $internalSupervisor);
            $internalTeacher = array_pop($internalTeacher);

            if (isset($teacherUsage[$hour][$internalTeacher['id']])) {
                continue; 
            }

            $otherTeachers = array_filter($teachers, fn($t) => $t['id'] != $internalSupervisor);
            shuffle($otherTeachers);
            $juryMembers = [];
            foreach ($otherTeachers as $member) {
                if (!isset($teacherUsage[$hour][$member['id']])) {
                    $juryMembers[] = $member;
                    if (count($juryMembers) === 2) break;
                }
            }

            if (count($juryMembers) < 2) {
                continue; 
            }

            $juryList = $internalTeacher['nom'] . " " . $internalTeacher['prenom'] . ", ";
            foreach ($juryMembers as $member) {
                $juryList .= $member['nom'] . " " . $member['prenom'] . ", ";
                $teacherUsage[$hour][$member['id']] = true;
            }
            $juryList = rtrim($juryList, ", ");

            $studentId = $student['id'];
            $roomId = $availableRoom['id'];
            $pfeSubject = $student['sujet_de_pfe'];
            $companyName = $student['entreprise'];
            $internalSupervisorName = $internalTeacher['nom'] . " " . $internalTeacher['prenom'];
            $externalSupervisor = $student['encadrant_externe'];
            $roomName = $availableRoom['nom'];

            mysqli_stmt_bind_param($stmtInsert, 'iissssssss', $studentId, $roomId, $date, $hour, $pfeSubject, $companyName, $internalSupervisorName, $externalSupervisor, $roomName, $juryList);
            mysqli_stmt_execute($stmtInsert);

            $teacherUsage[$hour][$internalTeacher['id']] = true;

            $assigned = true;
            break; 
        }

        if (!$assigned) {
            $_SESSION['schedule'] = "Impossible de programmer toutes les soutenances. Vérifiez les disponibilités.";
            header("Location: list_schedules.php");
            exit();
        }
    }

    mysqli_stmt_close($stmtInsert);

    $_SESSION['schedule'] = "Emploi du temps généré avec succès !";
    header("Location: list_schedules.php");
    exit();
}
?>
