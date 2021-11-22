<?php
session_start();
if ($_SESSION['userType'] != "admin" && $_SESSION['userType'] != "subadmin") {
    header("Location: ../auth/login.php");
}