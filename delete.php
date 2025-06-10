<?php
include_once 'db.php';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
$delete = $_GET['pid'];
$sql = $conn->query("DELETE FROM `employee` WHERE `pid` = '$delete'");
if ($sql) {
    header('Location: profile?Page=' . $page);
} else {
    echo "ERROR";
}
}

if (isset($_GET['company'])) {
    $com = $_GET['company'];
    mysqli_query($conn, "DELETE FROM `company` WHERE `Companycode` = '$com'");
    echo '<script>';
    echo "window.location.href='option.php?company=all'";
    echo '</script>';
}

if (isset($_GET['department'])) {
    $depart = $_GET['department'];
    mysqli_query($conn, "DELETE FROM `department` WHERE `department` = '$depart'");
    echo '<script>';
    echo "window.location.href='option.php?depart=1'";
    echo '</script>';
}

if (isset($_GET['position'])) {
    $posi = $_GET['position'];
    mysqli_query($conn, "DELETE FROM `position` WHERE `position` = '$posi'");
    echo '<script>';
    echo "window.location.href='option.php?posi=1'";
    echo '</script>';
}

if (isset($_GET['user'])) {
    $user = $_GET['user'];
    mysqli_query($conn, "DELETE FROM `user` WHERE `user` = '$user'");
    echo '<script>';
    echo "window.location.href='option.php?user=all'";
    echo '</script>';
}

if (isset($_GET['email'])) {
    $email = $_GET['email'];
    mysqli_query($conn, "DELETE FROM `email` WHERE `email` = '$email'");
    echo '<script>';
    echo "window.location.href='option.php?email=all'";
    echo '</script>';
}

if (isset($_GET['contractno'])) {
    $id = $_GET['id'];
    $contractno = $_GET['contractno'];
    mysqli_query($conn, "DELETE FROM `contractmaster` WHERE `id` = '$id' AND `contractno` = '$contractno'");
    echo '<script>';
    echo "window.location.href='option.php?contract_master=1'";
    echo '</script>';
}

if (isset($_GET['serialno'])) {
    $id = $_GET['id'];
    $serialno = $_GET['serialno'];
    mysqli_query($conn, "DELETE FROM `serialmaster` WHERE `id` = '$id' AND `serialno` = '$serialno'");
    echo '<script>';
    echo "window.location.href='option.php?serial_master=1'";
    echo '</script>';
}