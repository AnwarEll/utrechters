<?php
include '../../config/config.php';
session_start();
if (!strpos($_SESSION['userPerms'], 'manageEvents')) {
    die("You don't have permission to do this!");
}
if (isset($_POST['addSubmit'])) {
    $errors = array();
    $file_name = $_FILES['eventImage']['name'];
    $file_size = $_FILES['eventImage']['size'];
    $file_tmp = $_FILES['eventImage']['tmp_name'];
    $file_type = $_FILES['eventImage']['type'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

    $extensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, $_SERVER['DOCUMENT_ROOT'] . "/Periode 3/Projectweek/Website/assets/img/event_img/" . $file_name);
        $eventName  = $_POST['eventName'];
        $eventDesc  = $_POST['eventDescription'];
        $location   = $_POST['locationName'];
        $startDate  = $_POST['startDate'];
        $endDate    = $_POST['endDate'];
        $tTickets   = $_POST['availableTickets'];
        $tPrice     = $_POST['ticketPrice'];
        $customUrl  = $_POST['customUrl'];

        $insertSql  = "INSERT INTO `tbl_events` (`event_name`, `event_description`, `event_startdate`, `event_enddate`, `location_id`, `stocktickets`, `totaltickets`, `event_ticketprice` , `event_img`) VALUES ('$eventName', '$eventDesc', '$startDate', '$endDate', '$location', '$tTickets', '$tTickets', '$tPrice', '$file_name')";
        $iResult    = $dbconn->query($insertSql);
        if (!$iResult) {
            die("Error; " . $dbconn->error);
        } else {
            header("Location: ../events.php");
        }
    } else {
        print_r($errors);
    }
}

if (isset($_POST['editSubmit'])) {
    $eventId    = $_POST['eventId'];
    $eventName  = $_POST['eventName'];
    $eventDesc  = $_POST['eventDescription'];
    $location   = $_POST['locationName'];
    $startDate  = $_POST['startDate'];
    $endDate    = $_POST['endDate'];
    $tTickets   = $_POST['totalTickets'];

    $updateSql  = "UPDATE `tbl_events` SET `event_name`='$eventName', `event_description`='$eventDesc', `event_startdate`='$startDate', `event_enddate`='$endDate', `location_id`='$location', `totaltickets`='$tTickets' WHERE `event_id`=$eventId";
    $uResult    = $dbconn->query($updateSql);
    if (!$uResult) {
        die("Error; " . $dbconn->error);
    } else {
        header("Location: ../events.php");
    }
}

if (isset($_POST['deleteSubmit'])) {
    if (!isset($_POST['confirmation'])) {
        die("Please confirm that yout want to delete this event!");
    }
    $eventId    = $_POST['eventId'];
    $deleteSql  = "DELETE FROM `tbl_events` WHERE `event_id`='$eventId'";
    $dResult    = $dbconn->query($deleteSql);
    if (!$dResult) {
        die("Error; " . $dbconn->error);
    } else {
        header("Location: ../events.php");
    }
}
