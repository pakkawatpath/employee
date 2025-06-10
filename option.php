<?php
include_once 'menu.php';
include_once 'db.php';
include_once 'tabop.php';
unset(
    $_SESSION['serialno'],
    $_SESSION['maker'],
    $_SESSION['comtype'],
    $_SESSION['commodel'],
    $_SESSION['rental'],
    $_SESSION['accessory'],
    $_SESSION['notebookmodel'],
    $_SESSION['cpumodel'],
    $_SESSION['rammodel'],
    $_SESSION['ssdmodel'],
    $_SESSION['osmodel'],
    $_SESSION['wrmodel']
);
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

        span {
            color: red;
        }
    </style>

</head>

<body>

    <?php

    if (isset($_GET['company'])) {
    ?>
        <div class="container">
            <br>
            <div style="text-align: center;">
                <form action="insert" method="post">
                    <label>รหัสบริษัท<span>*</span></label>
                    <input type="text" name="cid" autocomplete="off">
                    <label>ชื่อบริษัท<span>*</span></label>
                    <input type="text" name="cname" autocomplete="off">
                    <input type="submit" value="เพิ่ม">
                </form>
            </div>
            <br>
            <table width=100%; style="border-collapse: collapse;font-size:1em;border-spacing: 20px;">
                <thead>
                    <tr>
                        <!-- <th class="text-center" width="1%">แก้ไข</th> -->
                        <th class="text-center" width="1%">ลบ</th>
                        <th class="text-center" width="10%">รหัสบริษัท</th>
                        <th class="text-center" width="10%">บริษัท</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $sqldbs = "SELECT * FROM `company` ORDER BY `Companycode`";
                    $resultdbs = mysqli_query($conn, $sqldbs);
                    while ($rowdbs = $resultdbs->fetch_array()) :
                    ?>

                        <tr>
                            <!-- <td class="text-center" width="1%"><a href='editpage.php?company=<?php echo $rowdbs['Companyname'] ?>'><img src='icon/edit.gif' /></button></a></td> -->
                            <td class="text-center"><a href='delete.php?company=<?php echo $rowdbs['Companycode'] ?>' onclick="return confirm('ต้องการลบหรือไม่')"><img src='icon/delete.gif' /></a></td>
                            <td class="text-center"><?php echo $rowdbs['Companycode']; ?></td>
                            <td class="text-center"><?php echo $rowdbs['Companyname']; ?></td>
                        </tr>

                    <?php endwhile ?>

                </tbody>

            </table></br>
        </div>
    <?php
    } elseif (isset($_GET['depart'])) {
        $Per_Page = 25;   // Per Page
        $Page = $_GET["depart"];
        if (!$_GET["depart"]) {
            $Page = 1;
        }
        $Page_Start = (($Per_Page * $Page) - $Per_Page);
        $sqldbs = "SELECT * FROM `department` ORDER BY `department` LIMIT $Page_Start , $Per_Page ";
        $objQuery = mysqli_query($conn, "SELECT * FROM `department`");

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
                $links .= "<a href=\"$url?depart=1\">1</a>";
                $i = max(2, $current_page - 3);
                if ($i > 2)
                    $links .= " ... ";
                for ($i; $i <= min($current_page + 3, $total_pages); $i++) {
                    if ($current_page == $i) {
                        $links .=  "<a href=\"$url?depart=$i\"> <b>$i</b> </a>";
                    }
                    // elseif ($i == $total_pages) {
                    //     continue;
                    // } 
                    else {
                        $links .=  "<a href=\"$url?depart=$i\"> $i </a>";
                    }
                }
            }
            return $links;
        }
    ?>
        <div class="container">
            <br>
            <div style="text-align: center;">
                <form action="insert" method="post">
                    <label>เพิ่มแผนก:<span>*</span></label>
                    <input type="text" name="depart" autocomplete="off">
                    <input type="submit" value="เพิ่ม">
                </form>
            </div>
            <br>
            <div style="text-align: center;">
                <form action="option" method="get">
                    <label>ค้นหา:<span>*</span></label>
                    <input type="text" name="deopx" placeholder="ค้นหา" autocomplete="off">
                    <input type="submit" name="deop" value="ค้นหา">
                </form>
            </div>
            <br>
            <div style="text-align:center;">
                <div class="row ">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <?php

                        if ($Prev_Page) {
                            echo " <a href='$_SERVER[SCRIPT_NAME]?depart=$First_Page'><< First</a> ";
                        }

                        if ($Prev_Page) {
                            echo " <a href='$_SERVER[SCRIPT_NAME]?depart=$Prev_Page'><< Back</a> ";
                        }

                        echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME']);

                        if ($Page != $Num_Pages) {
                            echo " <a href ='$_SERVER[SCRIPT_NAME]?depart=$Next_Page'>Next>></a> ";
                        }

                        if ($Page != $Num_Pages) {
                            echo " <a href ='$_SERVER[SCRIPT_NAME]?depart=$Last_Page'>Last>></a> ";
                        }

                        ?>
                    </div>
                </div>
            </div>
            <table width=100%; style="border-collapse: collapse;font-size:1em;border-spacing: 20px;">
                <thead>
                    <tr>
                        <!-- <th class="text-center" width="1%">แก้ไข</th> -->
                        <th class="text-center" width="1%">ลบ</th>
                        <th class="text-center" width="10%">แผนก</th>
                    </tr>
                </thead>

                <tbody>
                    <div style="margin: 10px 2% -10px;text-align:center;"></div>

                    <?php

                    $resultdbs = mysqli_query($conn, $sqldbs);
                    while ($rowdbs = $resultdbs->fetch_array()) :
                    ?>

                        <tr>
                            <!-- <td class="text-center" width="1%"><a href='editpage.php?company=<?php echo $rowdbs['Companyname'] ?>'><img src='icon/edit.gif' /></button></a></td> -->
                            <td class="text-center"><a href='delete.php?department=<?php echo $rowdbs['department'] ?>' onclick="return confirm('ต้องการลบหรือไม่')"><img src='icon/delete.gif' /></a></td>
                            <td class="text-center"><?php echo $rowdbs['department']; ?></td>

                        </tr>

                    <?php
                    endwhile;
                    ?>



                </tbody>

            </table></br>
            <div style="text-align:center;">
                <div class="row ">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <?php

                        if ($Prev_Page) {
                            echo " <a href='$_SERVER[SCRIPT_NAME]?depart=$First_Page'><< First</a> ";
                        }

                        if ($Prev_Page) {
                            echo " <a href='$_SERVER[SCRIPT_NAME]?depart=$Prev_Page'><< Back</a> ";
                        }

                        echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME']);

                        if ($Page != $Num_Pages) {
                            echo " <a href ='$_SERVER[SCRIPT_NAME]?depart=$Next_Page'>Next>></a> ";
                        }

                        if ($Page != $Num_Pages) {
                            echo " <a href ='$_SERVER[SCRIPT_NAME]?depart=$Last_Page'>Last>></a> ";
                        }

                        ?>
                    </div>
                </div>
            </div>
            <br>
        </div>
    <?php
    } elseif (isset($_GET['posi'])) {
        $Per_Page = 25;   // Per Page
        $Page = $_GET["posi"];
        if (!$_GET["posi"]) {
            $Page = 1;
        }
        $Page_Start = (($Per_Page * $Page) - $Per_Page);
        $sqldbs = "SELECT * FROM `position` ORDER BY `position` LIMIT $Page_Start , $Per_Page ";
        $objQuery = mysqli_query($conn, "SELECT * FROM `position` ");

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
                $links .= "<a href=\"$url?posi=1\">1</a>";
                $i = max(2, $current_page - 3);
                if ($i > 2)
                    $links .= " ... ";
                for ($i; $i <= min($current_page + 3, $total_pages); $i++) {
                    if ($current_page == $i) {
                        $links .=  "<a href=\"$url?posi=$i\"> <b>$i</b> </a>";
                    }
                    // elseif ($i == $total_pages) {
                    //     continue;
                    // } 
                    else {
                        $links .=  "<a href=\"$url?posi=$i\"> $i </a>";
                    }
                }
            }
            return $links;
        }
    ?>
        <div class="container">

            <br>
            <div style="text-align: center;">
                <form action="insert" method="post">
                    <label>เพิ่มตำแหน่ง:<span>*</span></label>
                    <input type="text" name="posi" autocomplete="off">
                    <input type="submit" value="เพิ่ม">
                </form>
            </div>
            <br>
            <div style="text-align: center;">
                <form action="option" method="get">
                    <label>ค้นหา:<span>*</span></label>
                    <input type="text" name="posix" placeholder="ค้นหา" autocomplete="off">
                    <input type="submit" name="posiy" value="ค้นหา">
                </form>
            </div>
            <br>
            <div style="text-align:center;">
                <div class="row ">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <?php

                        if ($Prev_Page) {
                            echo " <a href='$_SERVER[SCRIPT_NAME]?posi=$First_Page'><< First</a> ";
                        }

                        if ($Prev_Page) {
                            echo " <a href='$_SERVER[SCRIPT_NAME]?posi=$Prev_Page'><< Back</a> ";
                        }

                        echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME']);

                        if ($Page != $Num_Pages) {
                            echo " <a href ='$_SERVER[SCRIPT_NAME]?posi=$Next_Page'>Next>></a> ";
                        }

                        if ($Page != $Num_Pages) {
                            echo " <a href ='$_SERVER[SCRIPT_NAME]?posi=$Last_Page'>Last>></a> ";
                        }

                        ?>
                    </div>
                </div>
            </div>
            <br>
            <table width=100%; style="border-collapse: collapse;font-size:1em;border-spacing: 20px;">
                <thead>
                    <tr>
                        <!-- <th class="text-center" width="1%">แก้ไข</th> -->
                        <th class="text-center" width="1%">ลบ</th>
                        <th class="text-center" width="10%">ตำแหน่ง</th>
                    </tr>
                </thead>

                <tbody>
                    <div style="margin: 10px 2% -10px;text-align:center;"></div>

                    <?php

                    $resultdbs = mysqli_query($conn, $sqldbs);
                    while ($rowdbs = $resultdbs->fetch_array()) :
                    ?>

                        <tr>
                            <!-- <td class="text-center" width="1%"><a href='editpage.php?company=<?php echo $rowdbs['Companyname'] ?>'><img src='icon/edit.gif' /></button></a></td> -->
                            <td class="text-center"><a href='delete.php?position=<?php echo $rowdbs['position'] ?>' onclick="return confirm('ต้องการลบหรือไม่')"><img src='icon/delete.gif' /></a></td>
                            <td class="text-center"><?php echo $rowdbs['position']; ?></td>
                        </tr>

                    <?php endwhile ?>

                </tbody>

            </table></br>
            <div style="text-align:center;">
                <div class="row ">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <?php

                        if ($Prev_Page) {
                            echo " <a href='$_SERVER[SCRIPT_NAME]?posi=$First_Page'><< First</a> ";
                        }

                        if ($Prev_Page) {
                            echo " <a href='$_SERVER[SCRIPT_NAME]?posi=$Prev_Page'><< Back</a> ";
                        }

                        echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME']);

                        if ($Page != $Num_Pages) {
                            echo " <a href ='$_SERVER[SCRIPT_NAME]?posi=$Next_Page'>Next>></a> ";
                        }

                        if ($Page != $Num_Pages) {
                            echo " <a href ='$_SERVER[SCRIPT_NAME]?posi=$Last_Page'>Last>></a> ";
                        }

                        ?>
                    </div>
                </div>
            </div>
            <br>
        </div>
    <?php
    } elseif (isset($_GET['user'])) {
    ?>
        <br>
        <?php
        include_once "user.php";
        ?>
    <?php
    } elseif (isset($_GET['email'])) {
    ?>
        <div class="container">
            <br>
            <div style="text-align: center;">
                <form action="insert" method="post">
                    <label>Email<span>*</span></label>
                    <input type="email" name="email" autocomplete="off">
                    <input type="submit" value="เพิ่ม">
                </form>
            </div>
            <br>
            <table width=100%; style="border-collapse: collapse;font-size:1em;border-spacing: 20px;">
                <thead>
                    <tr>
                        <!-- <th class="text-center" width="1%">แก้ไข</th> -->
                        <th class="text-center" width="1%">ลบ</th>
                        <th class="text-center" width="10%">Email</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $sqldbs = "SELECT * FROM `email` ORDER BY `email`";
                    $resultdbs = mysqli_query($conn, $sqldbs);
                    while ($rowdbs = $resultdbs->fetch_array()) :
                    ?>

                        <tr>
                            <!-- <td class="text-center" width="1%"><a href='editpage.php?company=<?php echo $rowdbs['email'] ?>'><img src='icon/edit.gif' /></button></a></td> -->
                            <td class="text-center"><a href='delete.php?email=<?php echo $rowdbs['email'] ?>' onclick="return confirm('ต้องการลบหรือไม่')"><img src='icon/delete.gif' /></a></td>
                            <td class="text-center"><?php echo $rowdbs['email']; ?></td>
                        </tr>

                    <?php endwhile ?>

                </tbody>

            </table>
            </br>
        </div>
    <?php
    } elseif (isset($_GET['serial_master'])) {
        $Per_Page = 25;   // Per Page
        $Page = $_GET["serial_master"];
        if (!$_GET["serial_master"]) {
            $Page = 1;
        }
        $Page_Start = (($Per_Page * $Page) - $Per_Page);
        $sqldbs = "SELECT * FROM `serialmaster` ORDER BY `contractno` DESC LIMIT $Page_Start , $Per_Page ";
        $objQuery = mysqli_query($conn, "SELECT * FROM `serialmaster` ");

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
                $links .= "<a href=\"$url?serial_master=1\">1</a>";
                $i = max(2, $current_page - 3);
                if ($i > 2)
                    $links .= " ... ";
                for ($i; $i <= min($current_page + 3, $total_pages); $i++) {
                    if ($current_page == $i) {
                        $links .=  "<a href=\"$url?serial_master=$i\"> <b>$i</b> </a>";
                    }
                    // elseif ($i == $total_pages) {
                    //     continue;
                    // } 
                    else {
                        $links .=  "<a href=\"$url?serial_master=$i\"> $i </a>";
                    }
                }
            }
            return $links;
        }
    ?>
        <div class="container">
            <br>
            <div style="text-align: right;">
                <a href='addserial'><img src='icon/plus.png' /></button></a>
            </div>
            <br>
            <div style="text-align:center;">
                <div class="row ">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <?php

                        if ($Prev_Page) {
                            echo " <a href='$_SERVER[SCRIPT_NAME]?serial_master=$First_Page'><< First</a> ";
                        }

                        if ($Prev_Page) {
                            echo " <a href='$_SERVER[SCRIPT_NAME]?serial_master=$Prev_Page'><< Back</a> ";
                        }

                        echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME']);

                        if ($Page != $Num_Pages) {
                            echo " <a href ='$_SERVER[SCRIPT_NAME]?serial_master=$Next_Page'>Next>></a> ";
                        }

                        if ($Page != $Num_Pages) {
                            echo " <a href ='$_SERVER[SCRIPT_NAME]?serial_master=$Last_Page'>Last>></a> ";
                        }

                        ?>
                    </div>
                </div>
            </div>
            <br>
            <table width=100%; style="border-collapse: collapse;font-size:1em;border-spacing: 20px;">
                <thead>
                    <tr>
                        <!-- <th class="text-center" width="1%">แก้ไข</th> -->
                        <th class="text-center" width="5%">ลบ</th>
                        <th class="text-center" width="10%">ContractNo</th>
                        <th class="text-center" width="10%">SerialNo</th>
                        <th class="text-center" width="10%">Maker</th>
                        <th class="text-center" width="10%">ComType</th>
                        <th class="text-center" width="10%">ComModel</th>
                        <th class="text-center" width="10%">Rental</th>
                        <th class="text-center" width="10%">EndDate</th>
                        <th class="text-center" width="10%">Accessory</th>
                        <th class="text-center" width="10%">Accesscode</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $resultdbs = mysqli_query($conn, $sqldbs);
                    while ($rowdbs = $resultdbs->fetch_array()) :
                    ?>
                        <tr>
                            <td class="text-center"><a href='delete.php?id=<?php echo $rowdbs['id'] ?>&serialno=<?php echo $rowdbs['serialno'] ?>' onclick="return confirm('ต้องการลบหรือไม่')"><img src='icon/delete.gif' /></a></td>
                            <td class="text-center"><?php echo $rowdbs['contractno']; ?></td>
                            <td class="text-center"><?php echo $rowdbs['serialno']; ?></td>
                            <td class="text-center"><?php echo $rowdbs['maker']; ?></td>
                            <td class="text-center"><?php echo $rowdbs['comtype']; ?></td>
                            <td class="text-center"><?php echo $rowdbs['commodel']; ?></td>
                            <td class="text-center"><?php echo $rowdbs['rental']; ?></td>
                            <?php
                            $contractno = $rowdbs['contractno'];
                            $xenddate = mysqli_query($conn, "SELECT * FROM `contractmaster` WHERE `contractno` = '$contractno'");
                            $end = $xenddate->fetch_array();
                            $ydate = date_create($end['enddate']);
                            $enddate = date_format($ydate, "d-m-Y");
                            ?>
                            <td class="text-center"><?php echo $enddate ?></td>
                            <td class="text-center"><?php echo $rowdbs['accessory']; ?></td>
                            <td class="text-center"><?php echo $rowdbs['accesscode']; ?></td>
                        </tr>

                    <?php endwhile ?>

                </tbody>

            </table>
            <br>
            <div style="text-align:center;">
                <div class="row ">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <?php

                        if ($Prev_Page) {
                            echo " <a href='$_SERVER[SCRIPT_NAME]?serial_master=$First_Page'><< First</a> ";
                        }

                        if ($Prev_Page) {
                            echo " <a href='$_SERVER[SCRIPT_NAME]?serial_master=$Prev_Page'><< Back</a> ";
                        }

                        echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME']);

                        if ($Page != $Num_Pages) {
                            echo " <a href ='$_SERVER[SCRIPT_NAME]?serial_master=$Next_Page'>Next>></a> ";
                        }

                        if ($Page != $Num_Pages) {
                            echo " <a href ='$_SERVER[SCRIPT_NAME]?serial_master=$Last_Page'>Last>></a> ";
                        }

                        ?>
                    </div>
                </div>
            </div>
            <br>
        </div>
    <?php
    } elseif (isset($_GET['contract_master'])) {
        $Per_Page = 25;   // Per Page
        $Page = $_GET["contract_master"];
        if (!$_GET["contract_master"]) {
            $Page = 1;
        }
        $Page_Start = (($Per_Page * $Page) - $Per_Page);
        $sqldbs = "SELECT * FROM `contractmaster` ORDER BY `contractno` DESC LIMIT $Page_Start , $Per_Page ";
        $objQuery = mysqli_query($conn, "SELECT * FROM `contractmaster`");

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
                $links .= "<a href=\"$url?contract_master=1\">1</a>";
                $i = max(2, $current_page - 3);
                if ($i > 2)
                    $links .= " ... ";
                for ($i; $i <= min($current_page + 3, $total_pages); $i++) {
                    if ($current_page == $i) {
                        $links .=  "<a href=\"$url?contract_master=$i\"> <b>$i</b> </a>";
                    }
                    // elseif ($i == $total_pages) {
                    //     continue;
                    // } 
                    else {
                        $links .=  "<a href=\"$url?contract_master=$i\"> $i </a>";
                    }
                }
            }
            return $links;
        }
    ?>
        <div class="container">
            <br>
            <div style="text-align: right;">
                <a href='addcontract'><img src='icon/plus.png' /></button></a>
            </div>
            <br>
            <div style="text-align:center;">
                <div class="row ">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <?php

                        if ($Prev_Page) {
                            echo " <a href='$_SERVER[SCRIPT_NAME]?contract_master=$First_Page'><< First</a> ";
                        }

                        if ($Prev_Page) {
                            echo " <a href='$_SERVER[SCRIPT_NAME]?contract_master=$Prev_Page'><< Back</a> ";
                        }

                        echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME']);

                        if ($Page != $Num_Pages) {
                            echo " <a href ='$_SERVER[SCRIPT_NAME]?contract_master=$Next_Page'>Next>></a> ";
                        }

                        if ($Page != $Num_Pages) {
                            echo " <a href ='$_SERVER[SCRIPT_NAME]?contract_master=$Last_Page'>Last>></a> ";
                        }

                        ?>
                    </div>
                </div>
            </div>
            <br>
            <table width=100%; style="border-collapse: collapse;font-size:1em;border-spacing: 20px;">
                <thead>
                    <tr>
                        <!-- <th class="text-center" width="1%">แก้ไข</th> -->
                        <th class="text-center" width="5%">ลบ</th>
                        <th class="text-center" width="10%">ContractNo</th>
                        <th class="text-center" width="10%">ConDesc</th>
                        <th class="text-center" width="10%">StrDate</th>
                        <th class="text-center" width="10%">EndDate</th>
                        <th class="text-center" width="10%">Rental</th>
                        <th class="text-center" width="10%">Company</th>
                        <th class="text-center" width="10%">Vendor</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $resultdbs = mysqli_query($conn, $sqldbs);
                    while ($rowdbs = $resultdbs->fetch_array()) :
                    ?>
                        <tr>
                            <td class="text-center"><a href='delete.php?id=<?php echo $rowdbs['id'] ?>&contractno=<?php echo $rowdbs['contractno'] ?>' onclick="return confirm('ต้องการลบหรือไม่')"><img src='icon/delete.gif' /></a></td>
                            <td class="text-center"><?php echo $rowdbs['contractno']; ?></td>
                            <td class="text-center"><?php echo $rowdbs['condesc']; ?></td>
                            <?php
                            $xdate = date_create($rowdbs['strdate']);
                            $strdate = date_format($xdate, "d-m-Y");
                            $ydate = date_create($rowdbs['enddate']);
                            $enddate = date_format($ydate, "d-m-Y");
                            ?>
                            <td class="text-center"><?php echo $strdate ?></td>
                            <td class="text-center"><?php echo $enddate ?></td>
                            <td class="text-center"><?php echo $rowdbs['rental']; ?></td>
                            <td class="text-center"><?php echo $rowdbs['company']; ?></td>
                            <td class="text-center"><?php echo $rowdbs['vendor']; ?></td>
                        </tr>

                    <?php endwhile ?>

                </tbody>

            </table>
            <br>
            <div style="text-align:center;">
                <div class="row ">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <?php

                        if ($Prev_Page) {
                            echo " <a href='$_SERVER[SCRIPT_NAME]?contract_master=$First_Page'><< First</a> ";
                        }

                        if ($Prev_Page) {
                            echo " <a href='$_SERVER[SCRIPT_NAME]?contract_master=$Prev_Page'><< Back</a> ";
                        }

                        echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME']);

                        if ($Page != $Num_Pages) {
                            echo " <a href ='$_SERVER[SCRIPT_NAME]?contract_master=$Next_Page'>Next>></a> ";
                        }

                        if ($Page != $Num_Pages) {
                            echo " <a href ='$_SERVER[SCRIPT_NAME]?contract_master=$Last_Page'>Last>></a> ";
                        }

                        ?>
                    </div>
                </div>
            </div>
            <br>
        </div>
    <?php
    } else if (isset($_GET['Download'])) {
    ?>
        <form action="downuser.php" method="post">
            <div style="text-align: center;margin-top: 5%;">
                <p>Download พนักงานทั้งหมด</p>
                <input type="submit" value="Export" name='download'>
            </div>
        </form>
    <?php
    }
    ?>





</body>

</html>