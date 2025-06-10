<?php
include_once 'menu.php';
include_once 'db.php';
?>
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

        /* body {
            overflow-x: hidden;
        } */
    </style>
</head>

<body>
    <?php
    $cc = $_GET['com'];
    $c = mysqli_query($conn, "SELECT * FROM `company` WHERE `Companyname` = '$cc'");
    $x = $c->fetch_array();
    $xx = $x['Companycode'];
    ?>
    <div class="container">
        <div class="row justify-content-between">
            <div>
                <a href="select?Page=1&com=<?php echo $cc ?>" class="btn btn-outline-primary">ย้อนกลับ</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
        </div>
    </div>
    <form action="search-select.php" method="get">
        <input type="hidden" name="Page" value="1">
        <div class="container" style="text-align: center;">
            <label for="pid">รหัสพนักงาน</label>
            <input type="text" id="pid" name="pid">
            &nbsp;
            <label for="name">ชื่อพนักงาน/ชื่อเล่น</label>
            <input type="text" id="name" name="name">
        </div>
        <br>
        <div class="container" style="text-align: center;">
            <label for="date1">ตั้งแต่วันที่</label>
            <input type="date" id="date1" name="date1">
            <label for="date2">ถึงวันที่</label>
            <input type="date" id="date2" name="date2">
            &nbsp;
            <select name="status">
                <option value="all">รายชื่อทั้งหมด</option>
                <option value="in">รายชื่อที่ยังอยู่</option>
                <option value="out">รายชื่อที่ยกเลิก/ลาออก</option>
            </select>
        </div>
        <input type="hidden" name="com" value="<?php echo $cc ?>">
        <br>
        <div style="text-align: center;">
            <input type="submit" value="ค้นหา" name='su'>
        </div>
    </form>
    <?php

    if (isset($_GET['tool'])) {
    ?>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <form action="tool.php" method="get">

                        <input type="text" name="pid">
                        <input type="submit">
                    </form>
                </div>
            </div>
        </div>
    <?php
    } elseif (isset($_GET['su'])) {
        $pid = $_GET['pid'];
        $name = $_GET['name'];
        $status = $_GET['status'];
        $submit = $_GET['su'];
        $date1 = $_GET['date1'];
        $date2 = $_GET['date2'];
        if (empty($date2)) {
            date_default_timezone_set('Asia/Bangkok');
            $date_now = date('Y-m-d');
            $date2 = $date_now;
        }
        // echo $date1;
        // echo $date2;
        $Per_Page = 25;   // Per Page
        $Page = $_GET["Page"];
        if (!$_GET["Page"]) {
            $Page = 1;
        }

        $Page_Start = (($Per_Page * $Page) - $Per_Page);

        if (empty($pid)) {
            $pid = '';
        } else {
            $pid = $pid . '%';
        }

        if (empty($name)) {
            $name = '';
        } else {
            $name = $name . '%';
        }
        if ($status == 'all' && empty($pid) && empty($name) && empty($date1) && empty($date2)) {
            echo "<script>";
            echo "window.location.href='select.php?Page=1&com=$cc'";
            echo "</script>";
        } elseif ($status == 'in') {
            if (empty($pid) && empty($name) && !empty($date1) && !empty($date2)) {
                $sqldbs = "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `status` != 'disable' AND `startdate` BETWEEN '$date1' AND '$date2' LIMIT $Page_Start , $Per_Page";
                $objQuery = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `status` != 'disable' AND `startdate` BETWEEN '$date1' AND '$date2'");
            } elseif (!empty($date1) && !empty($date2) && empty($pid) && !empty($name)) {
                $sqldbs = "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `nameth` LIKE '$name' OR `nickname` LIKE '$name' AND `startdate` BETWEEN '$date1' AND '$date2' AND `status` != 'disable' LIMIT $Page_Start , $Per_Page";
                $objQuery = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `nameth` LIKE '$name' OR `nickname` LIKE '$name' AND `startdate` BETWEEN '$date1' AND '$date2' AND `status` != 'disable'");
            } elseif (!empty($date1) && !empty($date2) && !empty($pid) && empty($name)) {
                $sqldbs = "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `pid` LIKE '$pid' AND `startdate` BETWEEN '$date1' AND '$date2' AND `status` != 'disable' LIMIT $Page_Start , $Per_Page";
                $objQuery = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `pid` LIKE '$pid' AND `startdate` BETWEEN '$date1' AND '$date2' AND `startdate` BETWEEN '$date1' AND '$date2' AND `status` != 'disable'");
            } elseif (empty($date1) && empty($date2) && !empty($pid) && empty($name)) {
                $sqldbs = "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `pid` LIKE '$pid' AND `status` != 'disable' LIMIT $Page_Start , $Per_Page";
                $objQuery = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `pid` LIKE '$pid' AND `status` != 'disable'");
            } elseif (empty($pid) && !empty($name) && empty($date1) && empty($date2)) {
                $sqldbs = "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `nameth` LIKE '$name' OR `nickname` LIKE '$name' AND `status` != 'disable' LIMIT $Page_Start , $Per_Page";
                $objQuery = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `nameth` LIKE '$name' OR `nickname` LIKE '$name' AND `status` != 'disable'");
            } elseif (empty($pid) && empty($name) && empty($date1) && empty($date2)) {
                $sqldbs = "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `status` != 'disable' LIMIT $Page_Start , $Per_Page";
                $objQuery = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `status` != 'disable' ");
            } elseif (!empty($pid) && !empty($name) && empty($date1) && empty($date2)) {
                $sqldbs = "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `pid` LIKE '$pid' AND (`nameth` LIKE '$name' OR `nickname` LIKE '$name') AND `status` != 'disable' LIMIT $Page_Start , $Per_Page";
                $objQuery = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `pid` LIKE '$pid' AND (`nameth` LIKE '$name' OR `nickname` LIKE '$name') AND `status` != 'disable'");
            } else {
                $sqldbs = "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND (`pid` LIKE '$pid' OR `pid` LIKE '$pid') AND (`nameth` LIKE '$name' OR `nickname` LIKE '$name') AND `status` != 'disable' AND `startdate` BETWEEN '$date1' AND '$date2' LIMIT $Page_Start , $Per_Page";
                $objQuery = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND (`pid` LIKE '$pid' OR `pid` LIKE '$pid') AND (`nameth` LIKE '$name' OR `nickname` LIKE '$name') AND `status` != 'disable' AND `startdate` BETWEEN '$date1' AND '$date2'");
            }
        } elseif ($status == 'out') {
            if (empty($pid) && empty($name) && !empty($date1) && !empty($date2)) {
                $sqldbs = "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `status` = 'disable' AND `enddate` BETWEEN '$date1' AND '$date2' ORDER BY `enddate` DESC LIMIT $Page_Start , $Per_Page";
                $objQuery = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `status` = 'disable' ");
            } elseif (!empty($date1) && !empty($date2) && empty($pid) && !empty($name)) {
                $sqldbs = "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `nameth` LIKE '$name' OR `nickname` LIKE '$name' AND `startdate` BETWEEN '$date1' AND '$date2' AND `status` = 'disable' ORDER BY `enddate` DESC LIMIT $Page_Start , $Per_Page ";
                $objQuery = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `nameth` LIKE '$name' OR `nickname` LIKE '$name' AND `startdate` BETWEEN '$date1' AND '$date2' AND `status` = 'disable'");
            } elseif (!empty($date1) && !empty($date2) && !empty($pid) && empty($name)) {
                $sqldbs = "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `pid` LIKE '$pid' AND `startdate` BETWEEN '$date1' AND '$date2' AND `status` = 'disable' ORDER BY `enddate` DESC LIMIT $Page_Start , $Per_Page ";
                $objQuery = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `pid` LIKE '$pid' AND `startdate` BETWEEN '$date1' AND '$date2' AND `startdate` BETWEEN '$date1' AND '$date2' AND `status` = 'disable'");
            } elseif (empty($date1) && empty($date2) && !empty($pid) && empty($name)) {
                $sqldbs = "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `pid` LIKE '$pid' AND `status` = 'disable' ORDER BY `enddate` DESC LIMIT $Page_Start , $Per_Page ";
                $objQuery = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `pid` LIKE '$pid' AND `status` = 'disable' ");
            } elseif (empty($pid) && !empty($name) && empty($date1) && empty($date2)) {
                $sqldbs = "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `nameth` LIKE '$name' OR `nickname` LIKE '$name' AND `status` = 'disable' ORDER BY `enddate` DESC LIMIT $Page_Start , $Per_Page ";
                $objQuery = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `nameth` LIKE '$name' OR `nickname` LIKE '$name' AND `status` = 'disable' ");
            } elseif (empty($pid) && empty($name) && empty($date1) && empty($date2)) {
                $sqldbs = "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `status` = 'disable' ORDER BY `enddate` DESC LIMIT $Page_Start , $Per_Page ";
                $objQuery = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `status` = 'disable' ");
            } elseif (!empty($pid) && !empty($name) && empty($date1) && empty($date2)) {
                $sqldbs = "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `pid` LIKE '$pid' AND (`nameth` LIKE '$name' OR `nickname` LIKE '$name') AND `status` = 'disable' ORDER BY `enddate` DESC LIMIT $Page_Start , $Per_Page ";
                $objQuery = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `pid` LIKE '$pid' AND (`nameth` LIKE '$name' OR `nickname` LIKE '$name') AND `status` = 'disable'");
            } else {
                $sqldbs = "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND (`pid` LIKE '$pid' OR `pid` LIKE '$pid') AND (`nameth` LIKE '$name' OR `nickname` LIKE '$name') AND `status` = 'disable' AND `enddate` BETWEEN '$date1' AND '$date2' ORDER BY `enddate` DESC LIMIT $Page_Start , $Per_Page ";
                $objQuery = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND (`pid` LIKE '$pid' OR `pid` LIKE '$pid') AND (`nameth` LIKE '$name' OR `nickname` LIKE '$name') AND `status` = 'disable' AND `enddate` BETWEEN '$date1' AND '$date2'");
            }
        } elseif ($status == 'all' && !empty($date1) && !empty($date2) && empty($pid) && !empty($name)) {
            $sqldbs = "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `nameth` LIKE '$name' OR `nickname` LIKE '$name' AND `startdate` BETWEEN '$date1' AND '$date2' LIMIT $Page_Start , $Per_Page";
            $objQuery = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `nameth` LIKE '$name' OR `nickname` LIKE '$name' AND `startdate` BETWEEN '$date1' AND '$date2'");
        } elseif ($status == 'all' && !empty($date1) && !empty($date2) && !empty($pid) && empty($name)) {
            $sqldbs = "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `pid` LIKE '$pid' AND `startdate` BETWEEN '$date1' AND '$date2' LIMIT $Page_Start , $Per_Page";
            $objQuery = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `pid` LIKE '$pid' AND `startdate` BETWEEN '$date1' AND '$date2' AND `startdate` BETWEEN '$date1' AND '$date2'");
        } elseif ($status == 'all' && empty($date1) && empty($date2) && !empty($pid) && empty($name)) {
            $sqldbs = "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `pid` LIKE '$pid' LIMIT $Page_Start , $Per_Page";
            $objQuery = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `pid` LIKE '$pid'");
        } elseif ($status == 'all' && empty($date1) && empty($date2) && empty($pid) && !empty($name)) {
            $sqldbs = "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `nameth` LIKE '$name' OR `nickname` LIKE '$name' LIMIT $Page_Start , $Per_Page";
            $objQuery = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `nameth` LIKE '$name' OR `nickname` LIKE '$name'");
        } elseif ($status == 'all' && empty($pid) && empty($name) && !empty($date1) && !empty($date2)) {
            $sqldbs = "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `startdate` BETWEEN '$date1' AND '$date2' LIMIT $Page_Start , $Per_Page";
            $objQuery = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `startdate` BETWEEN '$date1' AND '$date2'");
        } elseif ($status == 'all' && !empty($pid) && !empty($name) && empty($date1) && empty($date2)) {
            $sqldbs = "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `pid` LIKE '$pid' AND (`nameth` LIKE '$name' OR `nickname` LIKE '$name') LIMIT $Page_Start , $Per_Page";
            $objQuery = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND `pid` LIKE '$pid' AND (`nameth` LIKE '$name' OR `nickname` LIKE '$name')"); 
        } else {
            $sqldbs = "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND (`nameth` LIKE '$name' OR `nickname` LIKE '$name') AND `startdate` BETWEEN '$date1' AND '$date2' LIMIT $Page_Start , $Per_Page";
            $objQuery = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` LIKE '$xx%' AND (`nameth` LIKE '$name' OR `nickname` LIKE '$name') AND `startdate` BETWEEN '$date1' AND '$date2'");
        }

        //echo $sqldbs;

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

        $pid = $_GET['pid'];
        $name = $_GET['name'];
        $status = $_GET['status'];
        function get_pagination_links($current_page, $total_pages, $url, $pid, $name,  $date1, $date2, $status, $cc, $submit)
        {
            $links = "";
            if ($total_pages >= 1 && $current_page <= $total_pages) {
                $links .= "<a href=\"$url?Page=1&pid=$pid&name=$name&date1=$date1&date2=$date2&status=$status&com=$cc&su=$submit\">1</a>";
                $i = max(2, $current_page - 3);
                if ($i > 2)
                    $links .= " ... ";
                for ($i; $i <= min($current_page + 3, $total_pages); $i++) {
                    if ($current_page == $i) {
                        $links .=  "<a href=\"$url?Page=$i&pid=$pid&name=$name&date1=$date1&date2=$date2&status=$status&com=$cc&su=$submit\"> <b>$i</b> </a>";
                    }
                    // elseif ($i == $total_pages) {
                    //     continue;
                    // } 
                    else {
                        $links .=  "<a href=\"$url?Page=$i&pid=$pid&name=$name&date1=$date1&date2=$date2&status=$status&com=$cc&su=$submit\"> $i </a>";
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
                        echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$First_Page&pid=$pid&name=$name&date1=$date1&date2=$date2&status=$status&com=$cc&su=$submit'><< First</a> ";
                    }

                    if ($Prev_Page) {
                        echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page&pid=$pid&name=$name&date1=$date1&date2=$date2&status=$status&com=$cc&su=$submit'><< Back</a> ";
                    }

                    echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME'], $pid, $name, $date1, $date2, $status, $cc, $submit);

                    if ($Page != $Num_Pages) {
                        echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$Next_Page&pid=$pid&name=$name&date1=$date1&date2=$date2&status=$status&com=$cc&su=$submit'>Next>></a> ";
                    }

                    if ($Page != $Num_Pages) {
                        echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$Last_Page&pid=$pid&name=$name&date1=$date1&date2=$date2&status=$status&com=$cc&su=$submit'>Last>></a> ";
                    }

                    ?>
                </div>
            </div>
        </div>
        <br>
        <div style="margin-left: 10px;margin-right: 10px;">
            <table style="border-collapse: collapse;width:100%;font-size:1em;border-spacing: 20px;zoom: 80%;">
                <tbody>
                    <tr>
                        <th style="width: 5%">แก้ไข</th>
                        <!-- <th style="padding-left: 10px;padding-right: 10px;">ลบ</th> -->
                        <th style="width: 5%">รหัสพนักงาน</th>
                        <th style="width: 5%">บริษัท</th>
                        <th style="width: 5%">Username</th>
                        <th style="width: 5%">นาย/นาง/นางสาว</th>
                        <th style="width: 5%">ชื่อ</th>
                        <th style="width: 5%">นามสกุล</th>
                        <th style="width: 5%">ชื่อเล่น</th>
                        <th style="width: 5%">Mr./Mrs./Miss</th>
                        <th style="width: 5%">ชื่อภาษาอังกฤษ</th>
                        <th style="width: 5%">นามสกุลภาษาอังกฤษ</th>
                        <!-- <th style="padding-left: 10px;padding-right: 10px;">บัตรประชาชน</th> -->
                        <th>ตำแหน่ง</th>
                        <th>แผนก</th>
                        <th style="width: 5%">มือถือ</th>
                        <th>เบอร์โทรศัพท์โต๊ะ</th>
                        <th>อีเมล</th>
                        <th style="width: 5%">วันเกิด</th>
                        <th style="width: 5%">สถานะ</th>
                        <th style="width: 5%">วันเริ่มทำงาน</th>
                        <th style="width: 5%">วันยุติการทำงาน</th>
                        <th style="width: 5%">หมายเหตุ</th>
                    </tr>
                    <?php
                    $resultdbs = mysqli_query($conn, $sqldbs);
                    while ($result = $resultdbs->fetch_array()) {
                        if (empty($result['pid']) && empty($result['iduser'])) {
                            continue;
                        }
                    ?>
                        <tr>
                            <td>
                                <form action="edit.php" method="get">
                                    <input type="hidden" name="iduser" value="<?php echo $result['pid'] ?>">
                                    <input type="hidden" name="page" value="<?php echo $Page ?>">
                                    <input type="image" src="icon\edit.gif">
                                </form>
                            </td>
                            <!-- <td>
                                <form action="delete.php" method="get">
                                    <input type="hidden" name="pid" value="<?php echo $result['pid'] ?>">
                                    <input type="hidden" name="page" value="<?php echo $Page ?>">
                                    <input type="image" src="icon\delete.gif" onclick="return confirm('ต้องการลบหรือไม่')">
                                </form>
                            </td> -->
                            <td><?php echo $result['pid'] ?></td>
                            <?php
                            $code = $result['pid'];
                            $code = substr($code, 0, 2);
                            $com1 = mysqli_query($conn, "SELECT * FROM `company` WHERE `Companycode` = '$code'");
                            $result1 = $com1->fetch_array();
                            ?>
                            <td><?php
                                if (empty($result1['Companyname'])) {
                                } else {
                                    echo $result1['Companyname'];
                                }
                                ?></td>
                            <td><?php echo strtolower($result['iduser']) ?></td>
                            <td><?php echo $result['nametitles(TH)'] ?></td>
                            <td><?php echo $result['nameth'] ?></td>
                            <td><?php echo $result['lastnameth'] ?></td>
                            <td><?php echo $result['nickname'] ?></td>
                            <td><?php echo $result['nametitles(EN)'] ?></td>
                            <td><?php echo $result['nameen'] ?></td>
                            <td><?php echo $result['lastnameen'] ?></td>
                            <!-- <td><?php echo $result['idcard'] ?></td> -->
                            <td><?php echo $result['position'] ?></td>
                            <td><?php echo $result['department'] ?></td>
                            <td><?php echo $result['phone'] ?></td>
                            <td><?php echo $result['telephone'] ?></td>
                            <td><?php echo $result['email'] ?></td>
                            <td><?php echo $result['bod'] ?></td>
                            <td><?php echo $result['status'] ?></td>
                            <td><?php echo $result['startdate'] ?></td>
                            <td><?php echo $result['enddate'] ?></td>
                            <td><?php echo $result['description'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <br>
        <div style="text-align:center;">
            <div class="row ">
                <div class="col-4"></div>
                <div class="col-4">
                    <?php

                    if ($Prev_Page) {
                        echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$First_Page&pid=$pid&name=$name&date1=$date1&date2=$date2&status=$status&com=$cc&su=$submit'><< First</a> ";
                    }

                    if ($Prev_Page) {
                        echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page&pid=$pid&name=$name&date1=$date1&date2=$date2&status=$status&com=$cc&su=$submit'><< Back</a> ";
                    }

                    echo get_pagination_links($Page, $Num_Pages, $_SERVER['SCRIPT_NAME'], $pid, $name, $date1, $date2, $status, $cc, $submit);

                    if ($Page != $Num_Pages) {
                        echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$Next_Page&pid=$pid&name=$name&date1=$date1&date2=$date2&status=$status&com=$cc&su=$submit'>Next>></a> ";
                    }

                    if ($Page != $Num_Pages) {
                        echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$Last_Page&pid=$pid&name=$name&date1=$date1&date2=$date2&status=$status&com=$cc&su=$submit'>Last>></a> ";
                    }

                    ?>
                </div>
            </div>
        </div>
        <br>
    <?php
    }
    ?>

</body>

</html>