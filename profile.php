<?php
error_reporting(0);
include_once 'menu.php';
unset(
    $_SESSION['pid'],
    $_SESSION['nameth'],
    $_SESSION['lastnameth'],
    $_SESSION['nameen'],
    $_SESSION['lastnameen'],
    $_SESSION['phone'],
    $_SESSION['telephone'],
    $_SESSION['email'],
    $_SESSION['sd'],
    $_SESSION['nickname'],
    $_SESSION['hardware'],
    $_SESSION['software'],
    $_SESSION['app'],
    $_SESSION['network'],
    $_SESSION['de'],
    $_SESSION['carname0'],
    $_SESSION['carregi1'],
    $_SESSION['carname'],
    $_SESSION['carregi'],
    $_SESSION['fuel'],
    $_SESSION['limit'],
    $_SESSION['doc'],
    $_SESSION['one'],
    $_SESSION['two'],
    $_SESSION['three'],
    $_SESSION['four'],
    $_SESSION['five'],
    $_SESSION['six']
);
if (!$_SESSION["UserID"]) {
    echo "<script>";
    echo "window.location='index.php'";
    echo "</script>";
} else {
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
        <title>Employee</title>
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
            <h1>พนักงาน</h1>
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
                            <a href="select?Page=1&com=<?php echo $res['Companyname'] ?>" class="btn btn-outline-primary"><?php echo $res['Companyname'] ?></a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <form action="search" method="get">
            <input type="hidden" name="Page" value="1">
            <div class="container" style="text-align: center;">
                <label>รหัสพนักงาน</label>
                <input type="text" name="pid">
                &nbsp;
                <label>ชื่อพนักงาน/ชื่อเล่น</label>
                <input type="text" name="name">
            </div>
            <br>
            <div class="container" style="text-align: center;">
                <label>ตั้งแต่วันที่</label>
                <input type="date" name="date1">
                <label>ถึงวันที่</label>
                <input type="date" name="date2">
                &nbsp;
                <select name="status">
                    <option value="all">รายชื่อทั้งหมด</option>
                    <option value="in">รายชื่อที่ยังอยู่</option>
                    <option value="out">รายชื่อที่ยกเลิก/ลาออก</option>
                </select>

            </div>
            <br>
            <div style="text-align: center;">
                <input type="submit" value="ค้นหา" name='su'>
            </div>
        </form>
        <?php
        $Per_Page = 25;   // Per Page
        $Page = $_GET["Page"];
        if (!$_GET["Page"]) {
            $Page = 1;
        }
        $Page_Start = (($Per_Page * $Page) - $Per_Page);
        $sqldbs = "SELECT * FROM `employee` WHERE `status` != 'disable' ORDER BY `pid` LIMIT $Page_Start , $Per_Page ";
        $objQuery = mysqli_query($conn, "SELECT * FROM `employee`");

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
                <div class="col-4">
                    <a href='new'><img src='icon/plus.png' /></button></a>
                </div>
            </div>
        </div>
        <br>
        <div style="margin-left: 10px;margin-right: 10px;">
            <table style="border-collapse: collapse;width: 100%;font-size:1em;border-spacing: 20px;zoom: 80%;">
                <tbody>
                    <tr>
                        <th style="width: 5%">แก้ไข</th>
                        <th>Computer
                            Leasing</th>
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
                        <th style="width: 5%"></th>
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
                            <td>
                                <form action="addcomleauser.php" method="get">
                                    <input type="hidden" name="username" value="<?php echo $result['pid'] ?>">
                                    <input type="hidden" name="check" value="y">
                                    <input type="image" style="width: 30px" src="icon\computer.png">
                                </form>
                            </td>
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
                            <td><?php echo $result['log'] ?></td>
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
