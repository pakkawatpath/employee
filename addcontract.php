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
    <title>New Contract</title>
    <style>
        #condesc {
            margin-left: 14px;
        }

        #rental {
            margin-left: 31px;
        }

        #vendor {
            margin-left: 27px;
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
                <h1>เพิ่ม Contract</h1>
            </div>
        </div>
        <form action="addserialandcontract.php" method="POST">
            <br>
            <div class="col align-self-center">
                <!-- <?php
                        if (empty($_SESSION['nameth'])) {
                        ?>
                    <div id="nameth" class="col">ชื่อ<span>*</span>: <input type="text" name="nameth" class="form-group mx-sm-3 mb-2" autocomplete="off" required></div>
                <?php
                        } else {
                ?>
                    <div id="nameth" class="col">ชื่อ<span>*</span>: <input type="text" name="nameth" value="<?php echo $_SESSION['nameth'] ?>" class="form-group mx-sm-3 mb-2" autocomplete="off" required></div>
                <?php
                        }
                ?> -->
                <div id="" class="col">ContractNo<span>*</span>: <input type="text" name="contractno" autocomplete="off" required></div>
            </div>
            <br>
            <div class="col align-self-center">
                <div id="condesc" class="col">ConDesc<span>*</span>: <input type="text" name="condesc" autocomplete="off" required></div>
            </div>
            <br>
            <div class="col align-self-center">
                <div id="rental" class="col">Rental<span>*</span>: <input type="text" name="rental" autocomplete="off" required></div>
            </div>
            <br>
            <div class="col align-self-center">
                <div style="margin-left: 30px" id="sd" class="col">Start Date<span>*</span>: <input type="date" name="stdate" class="form-group mx-sm-3 mb-2" required></div>
            </div>
            <br>
            <div class="col align-self-center">
                <div style="margin-left: 30px" id="sd" class="col">End Date<span>*</span>: <input type="date" name="eddate" class="form-group mx-sm-3 mb-2" required></div>
            </div>
            <br>
            <div class="col align-self-center">
                <select name="company">
                    <option value="" disabled selected>Company</option>
                    <?php
                    $x = mysqli_query($conn, "SELECT * FROM `company`");
                    while ($com = $x->fetch_array()) {
                    ?>
                        <option value="<?php echo $com['Companyname'] ?>"><?php echo $com['Companyname'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <br>
            <div class="col align-self-center">
                <div id="vendor" class="col">Vendor<span>*</span>: <input type="text" name="vendor" autocomplete="off" required></div>
            </div>
            <br>
            <input type="submit" class="btn btn-primary" name="newcon" value="เพิ่ม">
            <div style="margin: 50px 2% -10px;text-align:center;"></div>
        </form>
    </div>

</body>

</html>