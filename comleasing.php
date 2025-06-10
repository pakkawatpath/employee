<?php
include_once 'menu.php';
if (!$_SESSION["UserID"]) {
    echo "<script>";
    echo "window.location='index.php'";
    echo "</script>";
} else {
    date_default_timezone_set('Asia/Bangkok');
    // echo $_SESSION["type"];
?>
    <!DOCTYPE html>
    <html>

    <head>
        <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script> -->

        <title>ComputerLeasing</title>
        <style>
            table,
            th,
            td {
                border: 1px solid black;
                text-align: center;
            }

            th,
            td {
                padding-top: 5px;
                padding-bottom: 5px;
            }
        </style>

    </head>

    <body>
        <div class="container" style="text-align: center;">
            <h1>ComputerLeasing</h1>
        </div>

        <div class="tab">
            <div class="container">
                <div class="row justify-content-between">
                    <div>
                        <?php
                        include_once 'db.php';
                        $x = mysqli_query($conn, "SELECT * FROM `company` ORDER by `Companycode`");
                        while ($res = $x->fetch_array()) {
                        ?>
                            <a href="selcomleasing?Page=1&com=<?php echo $res['Companyname'] ?>" class="btn btn-outline-primary"><?php echo $res['Companyname'] ?></a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <form action="comleasing.php" method="get">
            <input type="hidden" name="Page" value="1">
            <div class="container" style="text-align: center;">
                <label>ค้นหา ContactNo:</label>
                <input type="text" name="searchcontact">
                <label>SerialNo:</label>
                <input type="text" name="searchserial">
            </div>
            <br>
            <!-- <div class="container" style="text-align: center;">
                <label>ตั้งแต่วันที่</label>
                <input type="date" name="date1">
                <label>ถึงวันที่</label>
                <input type="date" name="date2">
            </div>
            <br> -->
            <div style="text-align: center;">
                <input type="submit" value="ค้นหา" name='searchcom'>
            </div>
        </form>
        <br>
        <form action="download.php" method="post">
            <div style="text-align: center;">
                <input type="submit" value="Export" name='download'>
            </div>
        </form>

        <?php
        $Per_Page = 25;   // Per Page
        $Page = $_GET["Page"];
        if (!$_GET["Page"]) {
            $Page = 1;
        }
        $Page_Start = (($Per_Page * $Page) - $Per_Page);

        if (!empty($_GET['searchcontact'])) {
            $searchcontact = '%' . $_GET['searchcontact'] . '%';
        } else {
            $searchcontact = '';
        }

        if (!empty($_GET['searchserial'])) {
            $searchserial = '%' . $_GET['searchserial'] . '%';
        } else {
            $searchserial = '';
        }

        if (!empty($_GET['date1'])) {
            $date1 = $_GET['date1'];
        } else {
            $date1 = '';
        }

        if (!empty($_GET['date2'])) {
            $date2 = $_GET['date2'];
        } else {
            $date2 = '';
        }


        if (!empty($searchcontact) || !empty($searchserial) || !empty($date1) || !empty($date2)) {
            if (!empty($date1)) {
                $sqldbs = "SELECT serialmaster.id, serialmaster.contractno, serialmaster.serialno, serialmaster.username, serialmaster.comtype, serialmaster.commodel, contractmaster.strdate, contractmaster.enddate, serialmaster.accessory, serialmaster.accesscode FROM `serialmaster` INNER JOIN contractmaster ON serialmaster.contractno = contractmaster.contractno WHERE `serialmaster`.`serialno` LIKE '$searchserial' AND `serialmaster`.`contractno` LIKE '$searchcontact' AND contractmaster.strdate BETWEEN '$date1' AND '$date2' order by serialmaster.contractno DESC LIMIT $Page_Start , $Per_Page 1";
                $objQuery = mysqli_query($conn, "SELECT serialmaster.id, serialmaster.contractno, serialmaster.serialno, serialmaster.username, serialmaster.comtype, serialmaster.commodel, contractmaster.strdate, serialmaster.accessory, serialmaster.accesscode FROM `serialmaster` INNER JOIN contractmaster ON serialmaster.contractno = contractmaster.contractno WHERE `serialmaster`.`serialno` LIKE '$searchserial' AND `serialmaster`.`contractno` LIKE '$searchcontact' AND contractmaster.strdate BETWEEN '$date1' AND '$date2'");
            } else {
                if (empty($searchcontact) && empty($searchserial)) {
                    $sqldbs = "SELECT serialmaster.id, serialmaster.contractno, serialmaster.serialno, serialmaster.username, serialmaster.comtype, serialmaster.commodel, contractmaster.strdate, contractmaster.enddate, serialmaster.accessory, serialmaster.accesscode FROM `serialmaster` INNER JOIN contractmaster ON serialmaster.contractno = contractmaster.contractno WHERE contractmaster.strdate BETWEEN '$date1' AND '$date2' order by serialmaster.contractno DESC LIMIT $Page_Start , $Per_Page 2";
                    $objQuery = mysqli_query($conn, "SELECT serialmaster.id, serialmaster.contractno, serialmaster.serialno, serialmaster.username, serialmaster.comtype, serialmaster.commodel, contractmaster.strdate, serialmaster.accessory, serialmaster.accesscode FROM `serialmaster` INNER JOIN contractmaster ON serialmaster.contractno = contractmaster.contractno WHERE contractmaster.strdate BETWEEN '$date1' AND '$date2'");
                } elseif (!empty($searchcontact) || !empty($searchserial)) {
                    $sqldbs = "SELECT serialmaster.id, serialmaster.contractno, serialmaster.serialno, serialmaster.username, serialmaster.comtype, serialmaster.commodel, contractmaster.strdate, contractmaster.enddate, serialmaster.accessory, serialmaster.accesscode FROM `serialmaster` INNER JOIN contractmaster ON serialmaster.contractno = contractmaster.contractno WHERE (`serialmaster`.`serialno` LIKE '$searchserial' OR `serialmaster`.`contractno` LIKE '$searchcontact') order by serialmaster.contractno DESC LIMIT $Page_Start , $Per_Page ";
                    $objQuery = mysqli_query($conn, "SELECT serialmaster.id, serialmaster.contractno, serialmaster.serialno, serialmaster.username, serialmaster.comtype, serialmaster.commodel, contractmaster.strdate, serialmaster.accessory, serialmaster.accesscode FROM `serialmaster` INNER JOIN contractmaster ON serialmaster.contractno = contractmaster.contractno WHERE (`serialmaster`.`serialno` LIKE '$searchserial' OR `serialmaster`.`contractno` LIKE '$searchcontact')");
                } else {
                    $sqldbs = "SELECT serialmaster.id, serialmaster.contractno, serialmaster.serialno, serialmaster.username, serialmaster.comtype, serialmaster.commodel, contractmaster.strdate, contractmaster.enddate, serialmaster.accessory, serialmaster.accesscode FROM `serialmaster` INNER JOIN contractmaster ON serialmaster.contractno = contractmaster.contractno WHERE (`serialmaster`.`serialno` LIKE '$searchserial' OR `serialmaster`.`contractno` LIKE '$searchcontact') AND contractmaster.strdate BETWEEN '$date1' AND '$date2' order by serialmaster.contractno DESC LIMIT $Page_Start , $Per_Page ";
                    $objQuery = mysqli_query($conn, "SELECT serialmaster.id, serialmaster.contractno, serialmaster.serialno, serialmaster.username, serialmaster.comtype, serialmaster.commodel, contractmaster.strdate, serialmaster.accessory, serialmaster.accesscode FROM `serialmaster` INNER JOIN contractmaster ON serialmaster.contractno = contractmaster.contractno WHERE (`serialmaster`.`serialno` LIKE '$searchserial' OR `serialmaster`.`contractno` LIKE '$searchcontact') AND contractmaster.strdate BETWEEN '$date1' AND '$date2'");
                }
            }
        } else {
            $sqldbs = "SELECT serialmaster.id, serialmaster.contractno, serialmaster.serialno, serialmaster.username, serialmaster.comtype, serialmaster.commodel, contractmaster.strdate, contractmaster.enddate, serialmaster.accessory, serialmaster.accesscode FROM `serialmaster` INNER JOIN contractmaster ON serialmaster.contractno = contractmaster.contractno order by serialmaster.contractno DESC LIMIT $Page_Start , $Per_Page ";
            $objQuery = mysqli_query($conn, "SELECT serialmaster.id, serialmaster.contractno, serialmaster.serialno, serialmaster.username, serialmaster.comtype, serialmaster.commodel, contractmaster.strdate, contractmaster.enddate, serialmaster.accessory, serialmaster.accesscode FROM `serialmaster` INNER JOIN contractmaster ON serialmaster.contractno = contractmaster.contractno");
        }

        $Num_Rows = mysqli_num_rows($objQuery);
        if ($Num_Rows <= $Per_Page) {
            $Num_Pages = 1;
        } else if (($Num_Rows % $Per_Page) == 0) {
            $Num_Pages = ($Num_Rows / $Per_Page);
        } else {
            $Num_Pages = ($Num_Rows / $Per_Page) + 1;
            $Num_Pages = (int)$Num_Pages;
        }

        $First_Page = min(1, $Page);
        $Prev_Page = $Page - 1;
        $Next_Page = $Page + 1;
        $Last_Page = max($Num_Pages, $Page);

        function get_pagination_links($current_page, $total_pages, $url)
        {
            $links = "";
            if ($total_pages >= 1 && $current_page <= $total_pages) {
                $links .= "<a href=\"$url?Page=1\">1</a>";
                $i = max(2, $current_page - 3);
                if ($i > 2)
                    $links .= " ... ";
                for ($i; $i <= min($current_page + 3, $total_pages); $i++) {
                    if ($current_page == $i) {
                        $links .=  "<a href=\"$url?Page=$i\"> <b>$i</b> </a>";
                    }
                    // elseif ($i == $total_pages) {
                    //     continue;
                    // } 
                    else {
                        $links .=  "<a href=\"$url?Page=$i\"> $i </a>";
                    }
                }
            }
            return $links;
        }
        ?>
        <br>
        <div style="text-align:center;">
            <div class="row ">
                <div class="col-4"></div>
                <div class="col-4">
                    <?php

                    if ($Prev_Page) {
                        echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$First_Page'><< First</a> ";
                    }

                    if ($Prev_Page) {
                        echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page'><< Back</a> ";
                    }

                    echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME']);

                    if ($Page != $Num_Pages) {
                        echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$Next_Page'>Next>></a> ";
                    }

                    if ($Page != $Num_Pages) {
                        echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$Last_Page'>Last>></a> ";
                    }

                    ?>
                </div>
            </div>
        </div>
        <br>
        <div style="margin-left: 10px;margin-right: 10px;">
            <table style="border-collapse: collapse;width: 100%;font-size:1em;border-spacing: 20px;zoom: 80%;">
                <tbody>
                    <tr>
                        <th style="width: 5%">แก้ไข</th>
                        <th style="width: 5%">ContactNo</th>
                        <th style="width: 5%">SerialNo</th>
                        <th style="width: 5%">Username</th>
                        <th style="width: 5%">Type</th>
                        <th style="width: 5%">Detail</th>
                        <th style="width: 5%">StrDate</th>
                        <th style="width: 5%">EndDate</th>
                        <th style="width: 5%">Accessory</th>
                        <th style="width: 5%">AccessCode</th>
                    </tr>
                    <?php
                    $resultdbs = mysqli_query($conn, $sqldbs);
                    while ($result = $resultdbs->fetch_array()) {
                    ?>
                        <tr>
                            <td>
                                <form action="addcomleauser.php" method="get">
                                    <input type="hidden" name="id" value="<?php echo $result['id'] ?>">
                                    <input type="hidden" name="contractno" value="<?php echo $result['contractno'] ?>">
                                    <input type="hidden" name="serialno" value="<?php echo $result['serialno'] ?>">
                                    <input type="hidden" name="username" value="<?php echo $result['username'] ?>">
                                    <input type="hidden" name="accesscode" value="<?php echo $result['accesscode'] ?>">
                                    <input type="hidden" name="company" value="<?php echo $result['company'] ?>">
                                    <input type="hidden" name="page" value="<?php echo $Page ?>">
                                    <input type="image" src="icon\edit.gif">
                                </form>
                            </td>
                            <td><?php echo $result['contractno'] ?></td>
                            <td><?php echo $result['serialno'] ?></td>
                            <?php
                            if (!empty($result['username'])) {
                                $pid = $result['username'];
                                $xemployee = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` = '$pid'");
                                while ($employee = $xemployee->fetch_array()) {
                                    $user = $employee['nameth'] . " " . $employee['lastnameth'];
                                }

                                if (empty($user)) {
                                    $user = $pid;
                                }
                            } else {
                                $user = '';
                            }
                            ?>
                            <td><?php echo $user ?></td>
                            <td><?php echo $result['comtype'] ?></td>
                            <td><?php echo $result['commodel'] ?></td>
                            <?php
                            $constrdate = $result['strdate'];
                            $xstrdate = date_create($constrdate);
                            $strdate = date_format($xstrdate, "d-m-Y");
                            ?>
                            <td><?php echo $strdate ?></td>
                            <?php

                            $conenddate = $result['enddate'];
                            $ydate = date_create($conenddate);
                            $enddate = date_format($ydate, "d-m-Y");
                            ?>
                            <td><?php echo $enddate ?></td>
                            <td><?php echo $result['accessory'] ?></td>
                            <td><?php echo $result['accesscode'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>


        <br>
        <div style="text-align:center;">
            <div class="col">
                <?php

                if ($Prev_Page) {
                    echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$First_Page'><< First</a> ";
                }

                if ($Prev_Page) {
                    echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page'><< Back</a> ";
                }

                echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME']);

                if ($Page != $Num_Pages) {
                    echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$Next_Page'>Next>></a> ";
                }

                if ($Page != $Num_Pages) {
                    echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$Last_Page'>Last>></a> ";
                }

                ?>
            </div>
        </div>

    </body>

    </html>
<?php
}
