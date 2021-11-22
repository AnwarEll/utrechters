<?php
include '../../config/config.php';
session_start();

if (strpos($_SESSION['userPerms'], 'manageUsers') !== false) {
} else {
    die("You don't have permission to do this!");
}
if (isset($_POST['addSubmit'])) {
    $firstName  = $_POST['firstname'];
    $lastName   = $_POST['lastname'];
    $userEmail  = $_POST['email'];
    $userType   = $_POST['usertype'];
    $password   = $_POST['password'];
    $rPassword  = $_POST['repeatPassword'];

    if (!$password = $rPassword) {
        die("Passwords do not match.");
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
    }
    $uniqueCheckSql = "SELECT * FROM `tbl_users` WHERE `email`='$userEmail'";
    $uniqueResult = $dbconn->query($uniqueCheckSql);
    if ($uniqueResult->num_rows > 0) {
        die("Email address is already registerd.");
    }

    $insertSql  = "INSERT INTO `tbl_users` (`firstname`, `lastname`, `email`, `usertype`, `password`) VALUES ('$firstName', '$lastName', '$userEmail', '$userType', '$password')";
    $iResult    = $dbconn->query($insertSql);
    if (!$iResult) {
        die("Error; " . $dbconn->error);
    } else {
        header("Location: ../users.php");
    }
}

if (isset($_POST['editSubmit'])) {
    $userId     = $_POST['userId'];
    $firstName  = $_POST['firstname'];
    $lastName   = $_POST['lastname'];
    $userEmail  = $_POST['email'];
    $userType   = $_POST['usertype'];
    if (!isset($_POST['password'])) {
        $password   = $_POST['password'];
        $rPassword  = $_POST['repeatPassword'];

        if (!$password = $rPassword) {
            die("Passwords do not match.");
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        $updateSql  = "UPDATE `tbl_users` SET `firstname`='$firstName', `lastname`='$lastName', `email`='$userEmail', `usertype`='$userType', `password`='$password' WHERE `id`=$userId";
        $uResult    = $dbconn->query($updateSql);
        if (!$uResult) {
            die("Error; " . $dbconn->error);
        } else {
            header("Location: ../users.php");
        }
    } else {
        $updateSql  = "UPDATE `tbl_users` SET `firstname`='$firstName', `lastname`='$lastName', `email`='$userEmail', `usertype`='$userType' WHERE `id`=$userId";
        $uResult    = $dbconn->query($updateSql);
        if (!$uResult) {
            die("Error; " . $dbconn->error);
        } else {
            header("Location: ../users.php");
        }
    }
}

if (isset($_POST['deleteSubmit'])) {
    if (!isset($_POST['confirmation'])) {
        die("Please confirm that yout want to delete this users!");
    }
    $userId    = $_POST['userId'];
    $deleteSql  = "DELETE FROM `tbl_users` WHERE `id`='$userId'";
    $dResult    = $dbconn->query($deleteSql);
    if (!$dResult) {
        die("Error; " . $dbconn->error);
    } else {
        header("Location: ../users.php");
    }
}
