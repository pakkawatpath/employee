<!DOCTYPE html>
<html lang="en">

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

<?php
include_once 'db.php';
//error_reporting(E_ERROR | E_PARSE);
if (isset($_POST['new'])) {
    $pid = trim($_POST['pid']);
    $nameth = trim($_POST['nameth']);
    $lastnameth = trim($_POST['lastnameth']);
    $nameen = trim($_POST['nameen']);
    $lastnameen = trim($_POST['lastnameen']);
    // $idcard = $_POST['idcard'];
    $position = trim($_POST['position']);
    $department = trim($_POST['department']);
    $phone = trim($_POST['phone']);
    $des = trim($_POST['des']);

    if (!empty($_POST['telephone'])) {
        $telephone = trim($_POST['telephone']);
    } else {
        $telephone = '';
    }

    $email = trim($_POST['email']);
    $sd = trim($_POST['sd']);
    $nickname = trim($_POST['nickname']);
    $n = trim($_POST['1']);
    $bod = trim($_POST['bod']);
    // echo $_POST['park1'];
    // echo $_POST['park2'];

    if (empty($_POST['park1']) && empty($_POST['park2'])) {
        $park1 = '';
        $park2 = '';
    } elseif (empty($_POST['park1'])) {
        $park1 = '';
        $park2 = $_POST['park2'];
    } elseif (empty($_POST['park2'])) {
        $park1 = $_POST['park1'];
        $park2 = '';
    } else {
        $park1 = $_POST['park1'];
        $park2 = $_POST['park2'];
    }

    if (isset($_POST['card'])) {
        $card = $_POST['card'];
    } else {
        $card = '';
    }

    $carname = $_POST['carname'];
    $carregi = $_POST['carregi'];
    $fuel = $_POST['fuel'];
    $limit = $_POST['limit'];
    $doc = $_POST['documents'];

    if (isset($_POST['phonech'])) {
        $phonech = $_POST['phonech'];
    } else {
        $phonech = '';
    }

    if (isset($_POST['tool'])) {
        $tool = $_POST['tool'];
    } else {
        $tool = '';
    }
    
    $hardware = trim($_POST['hardware']);
    $software = trim($_POST['software']);
    $app = trim($_POST['app']);
    $net = trim($_POST['network']);
    $de = trim($_POST['de']);
    $carname0 = trim($_POST['carname0']);
    $carregi1 = trim($_POST['carregi1']);
    if (empty($_POST['one'])) {
        $one = '';
    } else {
        $one = trim($_POST['one']);
    }

    if (empty($_POST['two'])) {
        $two = '';
    } else {
        $two = trim($_POST['two']);
    }

    if (empty($_POST['three'])) {
        $three = '';
    } else {
        $three = trim($_POST['three']);
    }

    if (empty($_POST['four'])) {
        $four = '';
    } else {
        $four = trim($_POST['four']);
    }

    if (empty($_POST['five'])) {
        $five = '';
    } else {
        $five = trim($_POST['five']);
    }

    if (empty($_POST['six'])) {
        $six = '';
    } else {
        $six = trim($_POST['six']);
    }


    $check = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` = '$pid'");
    $result = $check->fetch_array();

    $_SESSION['pid'] = $pid;
    $_SESSION['nameth'] = $nameth;
    $_SESSION['lastnameth'] = $lastnameth;
    $_SESSION['nameen'] = $nameen;
    $_SESSION['lastnameen'] = $lastnameen;
    $_SESSION['phone'] = $phone;
    $_SESSION['telephone'] = $telephone;
    $_SESSION['email'] = $email;
    $_SESSION['sd'] = $sd;
    $_SESSION['nickname'] = $nickname;
    $_SESSION['hardware'] = $hardware;
    $_SESSION['software'] = $software;
    $_SESSION['app'] = $app;
    $_SESSION['network'] = $net;
    $_SESSION['de'] = $de;
    $_SESSION['carname0'] = $carname0;
    $_SESSION['carregi1'] = $carregi1;
    $_SESSION['carname'] = $carname;
    $_SESSION['carregi'] = $carregi;
    $_SESSION['fuel'] = $fuel;
    $_SESSION['limit'] = $limit;
    $_SESSION['doc'] = $doc;
    $_SESSION['one'] = $one;
    $_SESSION['two'] = $two;
    $_SESSION['three'] = $three;
    $_SESSION['four'] = $four;
    $_SESSION['five'] = $five;
    $_SESSION['six'] = $six;
    $_SESSION['description'] = $des;
    //echo 'qwe';
    if (isset($result)) {
        echo "<script>";
        // echo "Swal.fire('หมายเลขเลขพนักงานซ้ำ','','error').then(function() {history.back()})";
        echo "history.back(alert('หมายเลขเลขพนักงานซ้ำ'))";
        echo "</script>";
    } else {
        if (!empty($_FILES["img"]["tmp_name"])) {
            $fp = fopen($_FILES["img"]["tmp_name"], "r");
            $readbinary = fread($fp, filesize($_FILES["img"]["tmp_name"]));
            fclose($fp);
            $filedata = addslashes($readbinary);
        } else {
            $filedata = '';
        }
        date_default_timezone_set('Asia/Bangkok');
        $time = date('H:i');
        $t = date_create($time);
        $time = date_format($t, "H:i");
        $date = date_create($sd);
        $udate = date_format($date, "d/m/Y");
        $name = strtolower($nameen);
        $lastname = strtolower(substr($lastnameen, 0, 1));
        $iduser = $name . "." . $lastname;
        $check = mysqli_query($conn, "SELECT * FROM `employee` WHERE `iduser` = '$iduser'");
        $x = $check->fetch_all();
        $admin = $_SESSION["UserID"] . " " . $udate . " " . $time . " " . " add new user " . $name;
        if ($n == 'นาย') {
            $nn = 'Mr.';
        } elseif ($n == 'นาง') {
            $nn = 'Mrs.';
        } elseif ($n == 'นางสาว') {
            $nn = 'Miss';
        }
?>

        <body>
            <form id="form" action="sendmail.php" method="get">
                <input type="hidden" name="pid" value="<?php echo $pid ?>">
                <input type="hidden" name="nameth" value="<?php echo $nameth ?>">
                <input type="hidden" name="lastnameth" value="<?php echo $lastnameth ?>">
                <input type="hidden" name="nameen" value="<?php echo $nameen ?>">
                <input type="hidden" name="lastnameen" value="<?php echo $lastnameen ?>">
                <input type="hidden" name="position" value="<?php echo $position ?>">
                <input type="hidden" name="department" value="<?php echo $department ?>">
                <input type="hidden" name="phone" value="<?php echo $phone ?>">
                <input type="hidden" name="telephone" value="<?php echo $telephone ?>">
                <input type="hidden" name="email" value="<?php echo $email ?>">
                <input type="hidden" name="sd" value="<?php echo $sd ?>">
                <input type="hidden" name="n" value="<?php echo $n ?>">
                <input type="hidden" name="nn" value="<?php echo $nn ?>">
                <input type="hidden" name="park1" value="<?php echo $park1 ?>">
                <input type="hidden" name="park2" value="<?php echo $park2 ?>">
                <input type="hidden" name="card" value="<?php echo $card ?>">
                <input type="hidden" name="carname" value="<?php echo $carname ?>">
                <input type="hidden" name="carregi" value="<?php echo $carregi ?>">
                <input type="hidden" name="fuel" value="<?php echo $fuel ?>">
                <input type="hidden" name="limit" value="<?php echo $limit ?>">
                <input type="hidden" name="doc" value="<?php echo $doc ?>">
                <input type="hidden" name="phonech" value="<?php echo $phonech ?>">
                <input type="hidden" name="tool" value="<?php echo $tool ?>">
                <input type="hidden" name="one" value="<?php echo $one ?>">
                <input type="hidden" name="two" value="<?php echo $two ?>">
                <input type="hidden" name="three" value="<?php echo $three ?>">
                <input type="hidden" name="four" value="<?php echo $four ?>">
                <input type="hidden" name="five" value="<?php echo $five ?>">
                <input type="hidden" name="six" value="<?php echo $six ?>">
                <input type="hidden" name="hardware" value="<?php echo $hardware ?>">
                <input type="hidden" name="software" value="<?php echo $software ?>">
                <input type="hidden" name="app" value="<?php echo $app ?>">
                <input type="hidden" name="net" value="<?php echo $net ?>">
                <input type="hidden" name="de" value="<?php echo $de ?>">
                <input type="hidden" name="carname0" value="<?php echo $carname0 ?>">
                <input type="hidden" name="carregi1" value="<?php echo $carregi1 ?>">
                <input type="hidden" name="sd" value="<?php echo $sd ?>">
                <input type="hidden" name="iduser" value="<?php echo $iduser ?>">
                <input type="hidden" name="des" value="<?php echo $des ?>">
            </form>
            <img src="./icon/load.gif" width="10%" style="display: block;margin-left: auto;margin-right: auto;">
        </body>

</html>

<?php
        if (!empty($x)) {
            $lastname = strtolower(substr($lastnameen, 0, 2));
            $iduser = $name . "." . $lastname;
            //mysqli_query($conn, "INSERT INTO `employee`(`pid`, `iduser`, `nameth`, `lastnameth`, `nameen`, `lastnameen`, `idcard`, `position`, `department`, `phone`, `telephone`, `email`, `startdate`) VALUES ('$pid','$iduser','$nameth','$lastnameth','$nameen','$lastnameen','$idcard','$position','$department','$phone','$telephone','$email','$udate')");
            //mysqli_query($conn, "INSERT INTO `employee`(`pid`, `iduser`, `nametitles(TH)`, `nameth`, `lastnameth`, `nickname`, `nametitles(EN)`, `nameen`, `lastnameen`, `position`, `department`, `phone`, `telephone`, `email`, `bod`, `startdate`, `img`, `log`) VALUES ('$pid','$iduser','$n','$nameth','$lastnameth', '$nickname', '$nn','$nameen','$lastnameen','$position','$department','$phone','$telephone','$email', '$bod','$sd', '$filedata', '$admin')");
            mysqli_query($conn, "INSERT INTO `employee`(`pid`, `iduser`, `nametitles(TH)`, `nameth`, `lastnameth`, `nickname`, `nametitles(EN)`, `nameen`, `lastnameen`, `position`, `department`, `phone`, `telephone`, `email`, `bod`, `startdate`, `img`, `hardware`, `software`, `application`, `network`, `other`, `carbrand`, `carregistration`, `parkingpst`, `parking`, `card`, `fleetcardcarbrand`, `fleetcardcarregistration`, `fleetcardfuel`, `fleetcardLimit`, `fleetcarddocuments`, `mobilephonenumber`, `officeequipment`, `other1`, `other2`, `other3`, `other4`, `other5`, `other6`, `log`) VALUES ('$pid','$iduser','$n','$nameth','$lastnameth', '$nickname', '$nn','$nameen','$lastnameen','$position','$department','$phone','$telephone','$email', '$bod','$sd', '$filedata', '$hardware', '$software', '$app', '$net', '$de', '$carname0', '$carregi1', '$park1', '$park2', '$card', '$carname', '$carregi', '$fuel', '$limit', '$doc', '$phonech', '$tool', '$one', '$two', '$three', '$four', '$five', '$six', '$admin')");
        } else {
            // mysqli_query($conn, "INSERT INTO `employee`(`pid`, `iduser`, `nameth`, `lastnameth`, `nameen`, `lastnameen`, `idcard`, `position`, `department`, `phone`, `telephone`, `email`, `startdate`) VALUES ('$pid','$iduser','$nameth','$lastnameth','$nameen','$lastnameen','$idcard','$position','$department','$phone','$telephone','$email','$udate')");
            //mysqli_query($conn, "INSERT INTO `employee`(`pid`, `iduser`, `nametitles(TH)`, `nameth`, `lastnameth`, `nickname`, `nametitles(EN)`, `nameen`, `lastnameen`, `position`, `department`, `phone`, `telephone`, `email`, `bod`, `startdate`, `img`, `log`) VALUES ('$pid','$iduser','$n','$nameth','$lastnameth', '$nickname', '$nn','$nameen','$lastnameen','$position','$department','$phone','$telephone','$email', '$bod','$sd', '$filedata', '$admin')");
            mysqli_query($conn, "INSERT INTO `employee`(`pid`, `iduser`, `nametitles(TH)`, `nameth`, `lastnameth`, `nickname`, `nametitles(EN)`, `nameen`, `lastnameen`, `position`, `department`, `phone`, `telephone`, `email`, `bod`, `startdate`, `img`, `hardware`, `software`, `application`, `network`, `other`, `carbrand`, `carregistration`, `parkingpst`, `parking`, `card`, `fleetcardcarbrand`, `fleetcardcarregistration`, `fleetcardfuel`, `fleetcardLimit`, `fleetcarddocuments`, `mobilephonenumber`, `officeequipment`, `other1`, `other2`, `other3`, `other4`, `other5`, `other6`, `log`) VALUES ('$pid','$iduser','$n','$nameth','$lastnameth', '$nickname', '$nn','$nameen','$lastnameen','$position','$department','$phone','$telephone','$email', '$bod','$sd', '$filedata', '$hardware', '$software', '$app', '$net', '$de', '$carname0', '$carregi1', '$park1', '$park2', '$card', '$carname', '$carregi', '$fuel', '$limit', '$doc', '$phonech', '$tool', '$one', '$two', '$three', '$four', '$five', '$six', '$admin')");
        }
        $ad = $_SESSION["UserID"];
        $admin =  $udate . " " . $time . " " . " add new user " . $name;
        mysqli_query($conn, "UPDATE `user` SET `log`='$admin' WHERE `user` = '$ad'");
?>
<?php
        echo "<script>";
        echo "Swal.fire('เพิ่มเรียบร้อยแล้ว','','success').then(function() {
            document.getElementById('form').submit();  
        })";
        echo "</script>";
    }
}
?>
<!-- document.getElementById('form').submit(); -->