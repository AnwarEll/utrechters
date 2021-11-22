<?php
include '../../config/config.php';
session_start();
if (!strpos($_SESSION['userPerms'], 'manageLocations')) {
    die("You don't have permission to do this!");
}
if (isset($_POST['addSubmit'])) {
    $locName    = $_POST['locationName'];
    $locCity    = $_POST['locationCity'];
    $locUrl     = $_POST['locationUrl'];

    $insertSql  = "INSERT INTO `tbl_locations` (`location_name`, `location_city`, `location_url`) VALUES ('$locName', '$locCity', '$locUrl')";
    $iResult    = $dbconn->query($insertSql);
    if (!$iResult) {
        die("Error; " . $dbconn->error);
    } else {
        header("Location: ../locations.php");
    }
}

if (isset($_POST['editSubmit'])) {
    $locId      = $_POST['locationId'];
    $locName    = $_POST['locationName'];
    $locCity    = $_POST['locationCity'];
    $locUrl     = $_POST['locationUrl'];

    $updateSql  = "UPDATE `tbl_locations` SET `location_name`='$locName', `location_city`='$locCity', `location_url`='$locUrl' WHERE `location_id`='$locId'";
    $uResult    = $dbconn->query($updateSql);
    if (!$uResult) {
        die("Error; " . $dbconn->error);
    } else {
        header("Location: ../locations.php");
    }
}

if (isset($_POST['deleteSubmit'])) {
    if (!isset($_POST['confirmation'])) {
        die("Please confirm that yout want to delete this event!");
    }
    $locationId    = $_POST['locationId'];
    $deleteSql  = "DELETE FROM `tbl_locations` WHERE `location_id`='$locationId'";
    $dResult    = $dbconn->query($deleteSql);
    if (!$dResult) {
        die("Error; " . $dbconn->error);
    } else {
        header("Location: ../locations.php");
    }
}
