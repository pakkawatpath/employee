<?php
include_once "db.php";

$fileMimes = array(
    'text/x-comma-separated-values',
    'text/comma-separated-values',
    'application/octet-stream',
    'application/vnd.ms-excel',
    'application/x-csv',
    'text/x-csv',
    'text/csv',
    'application/csv',
    'application/excel',
    'application/vnd.msexcel',
    'text/plain'
);

/* $checkx = mysqli_query($conn, "SELECT * FROM `newdata` WHERE `PersonID` = '$PersonID' AND `Time` = '$Time' AND `type` = 'new'");
if (($checkx->num_rows) > 0) {
    mysqli_query($conn, "DELETE FROM `newdata` WHERE `PersonID` = '$PersonID' AND `Time` = '$Time' AND `type` = 'new'");
} */

if (isset($_POST['submit'])) {


    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes)) {
        $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

        // Skip the two line
        fgetcsv($csvFile);

        while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE) {
            // Get row data
            $PID = $getData[0];
            $UID = $getData[1];
            $nameth = $getData[2];
            $lnameth = $getData[3];
            $nameen = $getData[4];
            $lnameen = $getData[5];
            $idcard = $getData[6];
            $position = $getData[7];
            $department = $getData[8];
            $phone = $getData[9];
            $telephone = $getData[10];
            $email = $getData[11];
            $startdate = $getData[12];
            $startdate = str_replace('/', '-', $startdate);
            $startdate = date_create($startdate);
            $startdate = date_format($startdate, "Y-m-d");

            $check = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` = '$PID' AND `iduser` = '$UID'");
            if (($check->num_rows) > 0) {
                continue;
            } elseif (empty($PID) && empty($UID)) {
                continue;
            } else {
                mysqli_query($conn, "INSERT INTO `employee`(`pid`, `iduser`, `nameth`, `lastnameth`, `nameen`, `lastnameen`, `idcard`, `position`, `department`, `phone`, `telephone`, `email`, `startdate`)
                                    VALUES ('" . trim($PID) . "', 
                                            '" . trim($UID) . "', 
                                            '" . trim($nameth) . "', 
                                            '" . trim($lnameth) . "', 
                                            '" . trim($nameen) . "', 
                                            '" . trim($lnameen) . "', 
                                            '" . trim($idcard) . "', 
                                            '" . trim($position) . "', 
                                            '" . trim($department) . "', 
                                            '" . trim($phone) . "', 
                                            '" . trim($telephone) . "',
                                            '" . trim($email) . "',
                                            '" . trim($startdate) . "')");
                $cd = mysqli_query($conn, "SELECT * FROM `department` WHERE `department` = '$department'");
                if (($cd->num_rows) > 0) {
                    continue;
                } else {
                    mysqli_query($conn, "INSERT INTO `department`(`department`) VALUES ('$department')");
                }

                $cp = mysqli_query($conn, "SELECT * FROM `position` WHERE `position` = '$position'");
                if (($cp->num_rows) > 0) {
                    continue;
                } else {
                    mysqli_query($conn, "INSERT INTO `position`(`position`) VALUES ('$position')");
                }
            }
        }
    }
    fclose($csvFile);

    // Close opened CSV file

    header("Location: upload.php");
}
