<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
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

</head>

<body>

    <form method="post" action="login-out.php">

        <div style="margin: 100px 2% -10px;text-align:center;">
            <p><b> Login </b></p>
        </div>
        <div style="margin: 30px 2% -10px;text-align:center;">
            <p> ชื่อผู้ใช้ :
                <input type="text" id="Username" required name="Username" placeholder="Username" autocomplete="off">
            </p>
            <div style="margin-right: 9px;">
                <p>รหัสผ่าน :
                    <input type="password" id="Password" required name="Password" placeholder="Password">
                </p>
            </div>
            <p>
                <button class="btn btn-outline-success" type="submit"><i class="fas fa-sign-in-alt"></i> Login</button>
                &nbsp;&nbsp;
                <button class="btn btn-outline-danger" type="reset"><i class="fas fa-undo"></i> Reset</button>
            </p>
        </div>
    </form>
</body>

</html>