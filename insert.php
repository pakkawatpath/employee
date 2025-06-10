<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
</head>

<body>
    <?php
    include_once 'db.php';
    error_reporting(E_ERROR | E_PARSE);

    if (isset($_POST['cid']) && isset($_POST['cname'])) {
        $cid = $_POST['cid'];
        $cname = $_POST['cname'];

        if (empty($cid)) {
            echo "<script>";
            echo "Swal.fire('โปรดใส่รหัสบริษัท','','error').then(function() {window.location.href='option.php?company=all'})";
            echo "</script>";
        } elseif (empty($cname)) {
            echo "<script>";
            echo "Swal.fire('โปรดใส่ชื่อบริษัท','','error').then(function() {window.location.href='option.php?company=all'})";
            echo "</script>";
        } else {
            mysqli_query($conn, "INSERT INTO `company`(`Companycode`, `Companyname`) VALUES ('$cid','$cname')");
            echo "<script>";
            echo "Swal.fire('เพิ่มบริษัทเรียบร้อยแล้ว','','success').then(function() {window.location.href='option.php?company=all'})";
            echo "</script>";
        }
    }

    if (isset($_POST['depart'])) {
        $depart = $_POST['depart'];
        $d = mysqli_query($conn, "SELECT * FROM `department` WHERE `department` = '$depart'");
        $dd = $d->fetch_all();
        if (empty($depart)) {
            echo "<script>";
            echo "Swal.fire('โปรดใส่ชื่อแผนก','','error').then(function() {window.location.href='option.php?depart=1'})";
            echo "</script>";
        } elseif (!empty($dd)) {
            echo "<script>";
            echo "Swal.fire('ชื่อแผนกซ้ำ','','error').then(function() {window.location.href='option.php?depart=1'})";
            echo "</script>";
        } else {
            mysqli_query($conn, "INSERT INTO `department`(`department`) VALUES ('$depart')");
            echo "<script>";
            echo "Swal.fire('เพิ่มแผนกเรียบร้อยแล้ว','','success').then(function() {window.location.href='option.php?depart=1'})";
            echo "</script>";
        }
    }

    if (isset($_POST['posi'])) {
        $posi = $_POST['posi'];
        $c = mysqli_query($conn, "SELECT * FROM `position` WHERE `position` = '$posi'");
        $cc = $c->fetch_array();
        if (empty($posi)) {
            echo "<script>";
            echo "Swal.fire('โปรดใส่ชื่อตำแหน่ง','','error').then(function() {window.location.href='option.php?posi=1'})";
            echo "</script>";
        } elseif (!empty($cc)) {
            echo "<script>";
            echo "Swal.fire('ชื่อตำแหน่งซ้ำ','','error').then(function() {window.location.href='option.php?posi=1'})";
            echo "</script>";
        } else {
            mysqli_query($conn, "INSERT INTO `position`(`position`) VALUES ('$posi')");
            echo "<script>";
            echo "Swal.fire('เพิ่มตำแหน่งเรียบร้อยแล้ว','','success').then(function() {window.location.href='option.php?posi=1'})";
            echo "</script>";
        }
    }

    if (isset($_POST['iduser']) && isset($_POST['passuser'])) {
        $id = $_POST['iduser'];
        $pass = $_POST['passuser'];
        $type = $_POST['type'];
        $c = mysqli_query($conn, "SELECT * FROM `user` WHERE `user` = '$id'");
        $c = $c->fetch_array();
        if (empty($id)) {
            echo "<script>";
            echo "Swal.fire('โปรดใส่ID','','error').then(function() {window.location.href='option.php?user=all'})";
            echo "</script>";
        } elseif (!empty($c)) {
            echo "<script>";
            echo "Swal.fire('IDซ้ำ','','error').then(function() {window.location.href='option.php?user=all'})";
            echo "</script>";
        } elseif (empty($pass)) {
            echo "<script>";
            echo "Swal.fire('โปรดใส่Password','','error').then(function() {window.location.href='option.php?user=all'})";
            echo "</script>";
        } elseif (empty($type)) {
            echo "<script>";
            echo "Swal.fire('โปรดใส่Type','','error').then(function() {window.location.href='option.php?user=all'})";
            echo "</script>";
        } else {
            mysqli_query($conn, "INSERT INTO `user`(`user`, `password`, `type`) VALUES ('$id','$pass','$type')");
            echo "<script>";
            echo "Swal.fire('เพิ่มเรียบร้อยแล้ว','','success').then(function() {window.location.href='option.php?user=all'})";
            echo "</script>";
        }
    }

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        if (empty($email)) {
            echo "<script>";
            echo "Swal.fire('โปรดใส่Email','','error').then(function() {window.location.href='option.php?email=all'})";
            echo "</script>";
        } else {
            mysqli_query($conn, "INSERT INTO `email`(`email`) VALUES ('$email')");
            echo "<script>";
            echo "Swal.fire('เพิ่มเรียบร้อยแล้ว','','success').then(function() {window.location.href='option.php?email=all'})";
            echo "</script>";
        }
    }
    ?>
</body>

</html>