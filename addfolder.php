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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <style>
        #user {
            margin-left: 5px;
        }

        #nameth {
            margin-left: 50px;
        }

        #lastnameth,
        #pos {
            margin-left: 20px;
        }

        #nameen {
            margin-left: 30px;
        }

        #lastnameen {
            margin-left: 5px;
        }

        #idcard {
            margin-right: 10px;
            margin-left: 1px;
        }

        #phone {
            margin-left: 7px;
        }

        #telephone {
            margin-right: 7px;
            margin-left: 1px;
        }

        #sd {
            margin-right: 55px;
            margin-left: 1px;
        }

        #ed {
            margin-right: 110px;
            margin-left: 1px;
        }

        #email {
            margin-left: 90px;
        }

        #imgInp {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <?php
    include_once "db.php";
    $pid = $_GET['iduser'];
    $page = $_GET['page'];
    $query = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` = '$pid'");
    $result = $query->fetch_array();
    ?>

    <br>
    <div class="container">
        <div class="row">
            <div class="col-1">
                <button onclick="history.back()" class="btn btn-danger">BACK</button>
            </div>
            <!-- <div class="col"></div>
            <div class="col"></div> -->
        </div>

        <h1>แก้ไข</h1>

        <br>
        <form action="" method="post">
            <input type="hidden" name="pidd" value="<?php echo $pid ?>">
            <input type="hidden" name="page" value="<?php echo $page ?>">
            <p>เลขพนักงาน <b><?php echo $pid ?></b></p>
            <p for="selectfolder">เลือกโฟลเดอร์</p>
            <div id="jstree">
                <ul>
                    <?php
                    $f = mysqli_query($conn, "SELECT DISTINCT `folder` FROM `folder`");
                    while ($folder = $f->fetch_array()) {
                    ?>
                        <li><?php echo $folder['folder'] ?>
                            <ul>
                                <?php
                                $fol = $folder['folder'];
                                $s = mysqli_query($conn, "SELECT `subfolder` FROM `folder` WHERE `folder` = '$fol' AND `subfolder` <> ''");
                                while ($subfolder = $s->fetch_array()) {
                                ?>
                                    <li><?php echo $subfolder['subfolder'] ?></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <br>
            <br>
            <p id="demo"></p>
            <input type="submit" class="btn btn-primary" value="ยืนยัน">
            <br>
            <br>
        </form>
    </div>
    <script>
        $(function() {

        $('#jstree').jstree({
            "checkbox": {
                "keep_selected_style": false
            },
            "plugins": ["checkbox"]
        });
        });

        // $('#jstree').on("changed.jstree", function(e, data) {
        //     console.log(data.selected);
        // });

        // $('button').on('click', function() {
        //     $('#jstree').jstree(true).select_node('child_node_1');
        //     $('#jstree').jstree('select_node', 'child_node_1');
        //     $.jstree.reference('#jstree').select_node('child_node_1');
        // });

    </script>
</body>

</html>