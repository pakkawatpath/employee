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
    <title>Add</title>
    <style>
        #serialno {
            margin-left: 12px;
        }

        #username {
            margin-right: 1px;
        }

        #accesscode {
            margin-right: 13px;
        }

        span {
            color: red;
        }
    </style>
</head>

<body>
    <?php
    include_once 'db.php';
    date_default_timezone_set('Asia/Bangkok');
    
    @$username = $_GET['username'];
    @$page = $_GET['page'];
    @$check = $_GET['check'];
    if (isset($check)) {
        $row = mysqli_query($conn, "SELECT * FROM `serialmaster` WHERE `username` = '$username'");
        $result = $row->fetch_array();
        @$id = $result['id'];
        @$contractno = $result['contractno'];
        @$serialno = $result['serialno'];
        @$accesscode = $result['accesscode'];
    } else {
        @$id = $_GET['id'];
        @$accesscode = $_GET['accesscode'];
        @$company = $_GET['company'];
        @$serialno = $_GET['serialno'];
        @$contractno = $_GET['contractno'];
    }
    ?>
    <br>
    <div class="container text-center">
        <div class="row">
            <div class="col-1">
                <button onclick="history.back()" class="btn btn-danger">BACK</button>
            </div>
        </div>
        <div class="col align-self-center">
            <div class="col">
                <h1>Add ComputerLeasing</h1>
            </div>
        </div>
        <form action="addserialandcontract.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <br>
            <div class="col align-self-center">
                <div id="" class="col">ContactNo<span>*</span>: <input type="text" name="contractno" value="<?php echo $contractno ?>" autocomplete="off" disabled></div>
                <input type="hidden" name="contractno" value="<?php echo $contractno ?>">
            </div>
            <br>
            <div class="col align-self-center">
                <div id="serialno" class="col">SerialNo<span>*</span>: <input type="text" name="serialno" value="<?php echo $serialno ?>" autocomplete="off" disabled></div>
                <input type="hidden" name="serialno" value="<?php echo $serialno ?>">
            </div>
            <br>
            <div class="col align-self-center">
                <div id="accesscode" class="col">AccessCode<span>*</span>: <input type="text" name="accesscode" value="<?php echo $accesscode ?>" autocomplete="off" disabled></div>
                <input type="hidden" name="accesscode" value="<?php echo $accesscode ?>">
            </div>
            <br>
            <div class="col align-self-center">
                <!-- <?php
                        if (!empty($username)) {
                        ?>
                    <div id="username" class="col">UserName<span>*</span>: <input type="text" name="username" value="<?php echo $username ?>" autocomplete="off"></div>
                <?php
                        } else {
                ?>
                    <div id="username" class="col">UserName<span>*</span>: <input type="text" name="username" autocomplete="off"></div>
                <?php
                        }
                ?> -->

                <select name="username">
                    <?php
                    if (empty($username)) {
                    ?>
                        <option value="">เพิ่ม User</option>
                        <?php
                    } else {
                        $xuser = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` = '$username'");
                        while ($user = $xuser->fetch_array()) {
                        ?>
                            <option value="<?php echo $user['pid'] ?>"><?php echo $user['nameth'] . " " . $user['lastnameth'] ?></option>
                    <?php
                        }
                    }
                    ?>

                    <?php
                    $xcompany = mysqli_query($conn, "SELECT * FROM `company` WHERE `Companyname` = '$company'");
                    $companyname = $xcompany->fetch_array();
                    $companycode = $companyname['Companycode'] . '%';
                    $xemployee = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$companycode' AND `pid` NOT IN ('$username')");
                    while ($employee = $xemployee->fetch_array()) {
                    ?>
                        <option value="<?php echo $employee['pid'] ?>"><?php echo $employee['nameth'] . " " . $employee['lastnameth'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <br>

            <input type="hidden" name="page" value="<?php echo $page ?>">
            <input type="submit" class="btn btn-primary" name="updateserial" value="เพิ่ม">
            <input type="submit" class="btn btn-danger" name="clearuser" value="ลบชื่อผู้ใช้งาน">
            <div style="margin: 50px 2% -10px;text-align:center;"></div>
        </form>
    </div>

</body>

</html>