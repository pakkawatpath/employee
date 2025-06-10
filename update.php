<?php
include_once 'db.php';
if ($_GET['type'] == 'de') {
    $re = mysqli_query($conn, "SELECT DISTINCT `department` FROM `employee` WHERE `department` NOT IN (SELECT `department` FROM `department`)");
    while ($res = $re->fetch_array()) {
        $x = $res['department'];
        mysqli_query($conn, "INSERT INTO `department`(`department`) VALUES ('$x')");
    }
    echo "<script>";
    echo "window.location.href='option'";
    echo "</script>";
}
if ($_GET['type'] == 'posi') {
    $re = mysqli_query($conn, "SELECT DISTINCT `position` FROM `employee` WHERE `position` NOT IN (SELECT `position` FROM `position`)");
    while ($res = $re->fetch_array()) {
        $x = $res['position'];
        mysqli_query($conn, "INSERT INTO `position`(`position`) VALUES ('$x')");
    }
    echo "<script>";
    echo "window.location.href='option'";
    echo "</script>";
}
