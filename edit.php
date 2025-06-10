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
    <div class="container text-center">
        <div class="row">
            <div class="col-1">
                <button onclick="history.back()" class="btn btn-danger">BACK</button>
            </div>
            <!-- <div class="col"></div>
            <div class="col"></div> -->
        </div>
        <div class="row">
            <div class="col-12">
                <h1>แก้ไข</h1>
            </div>
        </div>
        <br>
        <form action="action.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="pidd" value="<?php echo $pid ?>">
            <input type="hidden" name="page" value="<?php echo $page ?>">
            <?php
            $data = base64_encode($result['img'])
            ?>
            <?php if (!empty($data)) {
            ?>
                <td class="text-center" width="1%"><img id="blah" src="data:image/jpeg;base64, <?php echo $data ?>" height="190" width="210" /></td>
            <?php
            } else {
            ?>
                <img id="blah" width="190px" height="210px" />
            <?php
            } ?>
            <br>
            <br>
            <input type='file' id="imgInp" name="img" accept="image/*" /><br />
            <br>
            <div class="row">
                <div class="col">รหัสพนักงาน: <input type="text" require name="pid" value="<?php echo $result['pid'] ?>" class="form-group mx-sm-3 mb-2"></div>
            </div>
            <br>
            <div class="row">
                <?php
                $user = $result['iduser'];
                ?>
                <input type="hidden" name="iduser" value="<?php echo $user ?>">
                <div id="user" class="col">Username: <input type="text" name="iduser" require value="<?php echo strtolower($user) ?>" class="form-group mx-sm-3 mb-2"></div>
            </div>
            <br>
            <div class="row">
                <div class="col"> คำนำหน้า:
                    <select name="x">
                        <?php
                        if (empty($result['nametitles(TH)'])) {
                        ?>
                            <option disabled selected>---------------</option>
                            <option value="นาย">นาย/Mr.</option>
                            <option value="นาง">นาง/Mrs.</option>
                            <option value="นางสาว">นางสาว/Miss</option>
                        <?php
                        } elseif ($result['nametitles(TH)'] == "นาย") {
                        ?>
                            <option value="<?php echo $result['nametitles(TH)'] ?>">นาย/Mr.</option>
                            <option value="นาง">นาง/Mrs.</option>
                            <option value="นางสาว">นางสาว/Miss</option>
                        <?php
                        } elseif ($result['nametitles(TH)'] == "นาง") {
                        ?>
                            <option value="<?php echo $result['nametitles(TH)'] ?>">นาง/Mrs.</option>
                            <option value="นาย">นาย/Mr.</option>
                            <option value="นางสาว">นางสาว/Miss</option>
                        <?php
                        } elseif ($result['nametitles(TH)'] == "นางสาว") {
                        ?>
                            <option value="<?php echo $result['nametitles(TH)'] ?>">นางสาว/Miss</option>
                            <option value="นาย">นาย/Mr.</option>
                            <option value="นาง">นาง/Mrs.</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div id="nameth" class="col">ชื่อ: <input type="text" require name="nameth" value="<?php echo $result['nameth'] ?>" class="form-group mx-sm-3 mb-2"></div>
            </div>
            <br>
            <div class="row">
                <div id="lastnameth" class="col">นามสกุล: <input type="text" require name="lastnameth" value="<?php echo $result['lastnameth'] ?>" class="form-group mx-sm-3 mb-2"></div>
            </div>
            <br>
            <div class="row">
                <div id="nameen" class="col">ชื่อเล่น: <input type="text" require name="nickname" value="<?php echo $result['nickname'] ?>" class="form-group mx-sm-3 mb-2"></div>
            </div>
            <br>
            <div class="row">
                <div id="nameen" class="col">Name: <input type="text" require name="nameen" value="<?php echo $result['nameen'] ?>" class="form-group mx-sm-3 mb-2"></div>
            </div>
            <br>
            <div class="row">
                <div id="lastnameen" class="col">Last name: <input type="text" require name="lastnameen" value="<?php echo $result['lastnameen'] ?>" class="form-group mx-sm-3 mb-2"></div>
            </div>
            <br>
            <!-- <div class="row">
                <div id="idcard" class="col">บัตรประชาชน: <input type="text" require name="idcard" value="<?php echo $result['idcard'] ?>" class="form-group mx-sm-3 mb-2"></div>
            </div>
            <br> -->

            <div class="row">
                <div id="phone" class="col">เบอร์มือถือ: <input type="text" name="phone" value="<?php echo $result['phone'] ?>" class="form-group mx-sm-3 mb-2"></div>
            </div>
            <br>
            <div class="row">
                <div id="telephone" class="col">เบอร์โทรโต๊ะ: <input type="text" name="telephone" value="<?php echo $result['telephone'] ?>" class="form-group mx-sm-3 mb-2"></div>
            </div>
            <br>
            <div class="row">
                <div id="email" class="col">Email: <input type="text" size="28" name="email" value="<?php echo $result['email'] ?>" class="form-group mx-sm-3 mb-2"></div>
            </div>
            <br>
            <div class="row">
                <div id="pos" class="col">ตำแหน่ง:
                    <select name="position">
                        <?php
                        $pos = $result['position'];
                        // $check = mysqli_query($conn, "SELECT DISTINCT `position` FROM `position` WHERE `position` = '$pos'");
                        // $x = $check->fetch_array();
                        ?>
                        <option value="<?php echo $pos ?>"><?php echo $pos ?></option>
                        <?php
                        $posx = mysqli_query($conn, "SELECT DISTINCT `position` FROM `position` WHERE `position` NOT IN ('$pos') ORDER BY `position`");
                        while ($respos = $posx->fetch_array()) {
                            if (empty($respos['position'])) {
                                continue;
                            }
                        ?>
                            <option value="<?php echo $respos['position'] ?>"><?php echo $respos['position'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div id="depart" class="col">แผนก:
                    <select name="department">
                        <?php
                        $depart = $result['department'];
                        // $check = mysqli_query($conn, "SELECT DISTINCT `department` FROM `department` WHERE `department` = '$depart'");
                        // $x = $check->fetch_array();
                        ?>
                        <option value="<?php echo $depart ?>"><?php echo $depart ?></option>
                        <?php
                        $departx = mysqli_query($conn, "SELECT DISTINCT `department` FROM `department` WHERE `department` NOT IN ('$depart') ORDER BY `department`");
                        while ($resdepart = $departx->fetch_array()) {
                            if (empty($resdepart['department'])) {
                                continue;
                            }
                        ?>
                            <option value="<?php echo $resdepart['department'] ?>"><?php echo $resdepart['department'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <br>
            <?php
            $bodx = str_replace("/", "-", $result['bod']);
            $body = date_create($bodx);
            $bod = date_format($body, 'Y-m-d');

            $sddatex = str_replace("/", "-", $result['startdate']);
            $sddatey = date_create($sddatex);
            $sddate = date_format($sddatey, 'Y-m-d');
            if (!empty($result['enddate'])) {
                $eddatex = str_replace("/", "-", $result['enddate']);
                $eddatey = date_create($eddatex);
                $eddate = date_format($eddatey, "Y-m-d");
            } else {
                $eddate = '';
            }
            ?>
            <div class="row">
                <div class="col" style="margin-right: 35px;">วันเกิด: <input type="date" name="bod" value="<?php echo $bod ?>" class="form-group mx-sm-3 mb-2"></div>
            </div>
            <br>
            <div class="row">
                <div id="sd" class="col">วันเริ่มงาน: <input type="date" name="startdate" value="<?php echo $sddate ?>" class="form-group mx-sm-3 mb-2"></div>
            </div>
            <br>

            <?php
            if (empty($result['hardware'])) {
                echo '<p><label for="hardware">อุปกรณ์คอมพิวเตอร์ ( Hardware )</label></p>';
                echo '<textarea type="text" id="hardware" name="hardware" rows="4" cols="50"></textarea>';
            } else {
            ?>
                <p><label for="hardware">อุปกรณ์คอมพิวเตอร์ ( Hardware )</label></p>
                <textarea type="text" id="hardware" name="hardware" rows="4" cols="50"><?php echo $result['hardware'] ?></textarea>
            <?php
            }
            ?>
            <br>
            <?php
            if (empty($result['software'])) {
                echo '<p><label for="software">โปรแกรมสำเร็จรูป ( Software )</label></p>';
                echo '<textarea type="text" id="software" name="software" rows="4" cols="50"></textarea>';
            } else {
            ?>
                <p><label for="software">โปรแกรมสำเร็จรูป ( Software )</label></p>
                <textarea type="text" id="software" name="software" rows="4" cols="50"><?php echo $result['software'] ?></textarea>
            <?php
            }
            ?>
            <br>
            <?php
            if (empty($result['application'])) {
                echo '<p><label for="application">โปรแกรมพัฒนาขึ้นเอง ( Application )</label></p>';
                echo '<textarea type="text" id="application" name="application" rows="4" cols="50"></textarea>';
            } else {
            ?>
                <p><label for="application">โปรแกรมพัฒนาขึ้นเอง ( Application )</label></p>
                <textarea type="text" id="application" name="application" rows="4" cols="50"><?php echo $result['application'] ?></textarea>
            <?php
            }
            ?>
            <br>
            <?php
            if (empty($result['network'])) {
                echo '<p><label for="network">Network Login User ( Network , VPN ) ,Share Drive</label></p>';
                echo '<textarea type="text" id="network" name="network" rows="4" cols="50"></textarea>';
            } else {
            ?>
                <p><label for="network">Network Login User ( Network , VPN ) ,Share Drive</label></p>
                <textarea type="text" id="network" name="network" rows="4" cols="50"><?php echo $result['network'] ?></textarea>
            <?php
            }
            ?>
            <br>
            <?php
            if (empty($result['other'])) {
                echo '<p><label for="other">รายละเอียดอื่นๆ</label></p>';
                echo '<textarea type="text" id="other" name="other" rows="4" cols="50"></textarea>';
            } else {
            ?>
                <p><label for="other">รายละเอียดอื่นๆ</label></p>
                <textarea type="text" id="other" name="other" rows="4" cols="50"><?php echo $result['other'] ?></textarea>
            <?php
            }
            ?>
            <br>
            <p><label>รถส่วนตัว</label></p>
            <div class="row">
                <div id="carbrand" class="col">ยี่ห้อรถ/รุ่นรถ: <input type="text" require name="carbrand" value="<?php echo $result['carbrand'] ?>" class="form-group mx-sm-3 mb-2"></div>
            </div>
            <br>
            <div class="row">
                <div id="carregistration" class="col">ทะเบียนรถ: <input type="text" require name="carregistration" value="<?php echo $result['carregistration'] ?>" class="form-group mx-sm-3 mb-2"></div>
            </div>
            <br>
            <p><label>ที่จอดรถ</p>
            <?php
            if (empty($result['parkingpst'])) {
            ?>
                <input type="checkbox" id="parkingpst" name="parkingpst" value="check1">
                <label for="parkingpst">ที่จอดรถอาคารพีเอสที</label>&nbsp;&nbsp;
            <?php
            } else {
            ?>
                <input type="checkbox" id="parkingpst" name="parkingpst" value="check1" checked>
                <label for="parkingpst">ที่จอดรถอาคารพีเอสที</label>&nbsp;&nbsp;
            <?php
            }
            ?>
            <br>
            <?php
            if (empty($result['parking'])) {
            ?>
                <input type="checkbox" id="parking" name="parking" value="check2">
                <label for="parking">ที่จอดรถเช่า</label>
            <?php
            } else {
            ?>
                <input type="checkbox" id="parking" name="parking" value="check2" checked>
                <label for="parking">ที่จอดรถเช่า</label>
            <?php
            }
            ?>
            <br>
            <br>
            <?php
            if (empty($result['card'])) {
            ?>
                <p style="font-weight: 900;">นามบัตร</p>
                <label for="myCheck">จำนวน</label>
                <input type="checkbox" id="myCheck" name="card" value="card">
                <label for="myCheck">100ใบ</label>
            <?php
            } else {
            ?>
                <p style="font-weight: 900;">นามบัตร</p>
                <label for="myCheck">จำนวน</label>
                <input type="checkbox" id="myCheck" name="card" value="card" checked>
                <label for="myCheck">100ใบ</label>
            <?php
            }
            ?>

            <br>
            <br>
            <p><label>Fleet card</label></p>
            <label for="fleetcardcarbrand" style="margin-left: 15px;">ยี่ห้อรถ/รุ่นรถ</label>
            <input type="text" id="fleetcardcarbrand" name="fleetcardcarbrand" value="<?php echo $result['fleetcardcarbrand'] ?>" autocomplete="off">
            <br>
            <br>
            <label for="fleetcardcarregistration" style="margin-left: 30px;">ทะเบียนรถ</label>
            <input type="text" id="fleetcardcarregistration" name="fleetcardcarregistration" value="<?php echo $result['fleetcardcarregistration'] ?>" autocomplete="off">
            <br>
            <br>
            <label for="fleetcardfuel" style="margin-left: 40px;">เชื้อเพลิง</label>
            <input type="text" id="fleetcardfuel" name="fleetcardfuel" value="<?php echo $result['fleetcardfuel'] ?>" autocomplete="off">
            <br>
            <br>
            <label for="fleetcardlimit" style="margin-left: 60px;">วงเงิน</label>
            <input type="text" id="fleetcardlimit" name="fleetcardlimit" value="<?php echo $result['fleetcardlimit'] ?>" autocomplete="off">
            <br>
            <br>
            <label for="fleetcarddocuments">เอกสารประกอบ</label>
            <input type="text" id="fleetcarddocuments" name="fleetcarddocuments" value="<?php echo $result['fleetcarddocuments'] ?>" autocomplete="off">
            <br>
            <br>
            <br>
            <?php
            $check0 = "";
            $check1 = "";
            $check2 = "";
            $check3 = "";
            $check4 = "";
            switch ($result['mobilephonenumber']) {
                case "phone0":
                    $check0 = "checked";
                    break;
                case "phone1":
                    $check1 = "checked";
                    break;
                case "phone2":
                    $check2 = "checked";
                    break;
                case "phone3":
                    $check3 = "checked";
                    break;
                case "phone4":
                    $check4 = "checked";
                    break;
            }

            ?>
            <p style="font-weight: 900;">เบอร์โทรศัพท์มือถือ</p>
            <input type="radio" id="mobilephonenumber" name="mobilephonenumber" value="phone0" <?php echo $check0 ?>>
            <label for="phone">ไม่มี</label>
            <br>
            <input type="radio" id="mobilephonenumber" name="mobilephonenumber" value="phone1" <?php echo $check1 ?>>
            <label for="phone">เดือนละ 449 บาท โทรฟรีทุกเครือข่ายไม่จำกัด เน็ท 10 GB</label>
            <br>
            <input type="radio" id="mobilephonenumber" name="mobilephonenumber" value="phone2" <?php echo $check2 ?>>
            <label for="phone">เดือนละ 599 บาท โทรฟรีทุกเครือข่ายไม่จำกัด เน็ท 20 GB</label>
            <br>
            <input type="radio" id="mobilephonenumber" name="mobilephonenumber" value="phone3" <?php echo $check3 ?>>
            <label for="phone">เดือนละ 799 บาท โทรฟรีทุกเครือข่ายไม่จำกัด เน็ท 40 GB</label>
            <br>
            <input type="radio" id="mobilephonenumber" name="mobilephonenumber" value="phone4" <?php echo $check4 ?>>
            <label for="phone">เดือนละ 999 บาท โทรฟรีทุกเครือข่ายไม่จำกัด เน็ท 65 GB</label>
            <br>
            <br>
            <?php
            if ($result['officeequipment'] == 'tool1') {
                $checktool0 = '';
                $checktool1 = 'checked';
            } else {
                $checktool0 = 'checked';
                $checktool1 = '';
            }
            ?>
            <p style="font-weight: 900;">อุปกรณ์สำนักงาน</p>
            <input type="radio" id="officeequipment" name="officeequipment" value="tool0" <?php echo $checktool0 ?>>
            <label for="officeequipment">ไม่มี</label>
            <br>
            <input type="radio" id="officeequipment" name="officeequipment" value="tool1" <?php echo $checktool1 ?>>
            <label for="officeequipment">อุปกรณ์สำนักงาน</label>
            <br>
            <br>

            <p style="font-weight: 900;">อื่นๆ</p>
            <?php
            if (empty($result['other1'])) {
                echo '<p for="other1">1.</p>';
                echo '<textarea style="margin-left:auto;margin-right:auto;" type="text" id="other1" name="other1" maxlength="36" autocomplete="off" rows="4" cols="50"></textarea>';
            } else {
            ?>
                <p for="other1">1.</p>
                <!-- <textarea type="text" id="one" name="one" maxlength="36" autocomplete="off"> -->
                <textarea style="margin-left:auto;margin-right:auto;" type="text" id="other1" name="other1" maxlength="36" autocomplete="off" rows="4" cols="50"><?php echo $result['other1'] ?></textarea>
            <?php } ?>
            <br>
            <br>

            <?php
            if (empty($result['other2'])) {
                echo '<p for="other2">2.</p>';
                echo '<textarea style="margin-left:auto;margin-right:auto;" type="text" id="other2" name="other2" maxlength="36" autocomplete="off" rows="4" cols="50"></textarea>';
            } else {
            ?>
                <p for="other2">2.</p>
                <!-- <textarea type="text" id="one" name="one" maxlength="36" autocomplete="off"> -->
                <textarea style="margin-left:auto;margin-right:auto;" type="text" id="other2" name="other2" maxlength="36" autocomplete="off" rows="4" cols="50"><?php echo $result['other2'] ?></textarea>
            <?php } ?>
            <br>
            <br>

            <?php
            if (empty($result['other3'])) {
                echo '<p for="other3">3.</p>';
                echo '<textarea style="margin-left:auto;margin-right:auto;" type="text" id="other3" name="other3" maxlength="36" autocomplete="off" rows="4" cols="50"></textarea>';
            } else {
            ?>
                <p for="other3">3.</p>
                <!-- <textarea type="text" id="one" name="one" maxlength="36" autocomplete="off"> -->
                <textarea style="margin-left:auto;margin-right:auto;" type="text" id="other3" name="other3" maxlength="36" autocomplete="off" rows="4" cols="50"><?php echo $result['other3'] ?></textarea>
            <?php } ?>
            <br>
            <br>

            <?php
            if (empty($result['other4'])) {
                echo '<p for="other4">4.</p>';
                echo '<textarea style="margin-left:auto;margin-right:auto;" type="text" id="other4" name="other4" maxlength="36" autocomplete="off" rows="4" cols="50"></textarea>';
            } else {
            ?>
                <p for="other4">4.</p>
                <!-- <textarea type="text" id="one" name="one" maxlength="36" autocomplete="off"> -->
                <textarea style="margin-left:auto;margin-right:auto;" type="text" id="other4" name="other4" maxlength="36" autocomplete="off" rows="4" cols="50"><?php echo $result['other4'] ?></textarea>
            <?php } ?>
            <br>
            <br>

            <?php
            if (empty($result['other5'])) {
                echo '<p for="other5">5.</p>';
                echo '<textarea style="margin-left:auto;margin-right:auto;" type="text" id="other5" name="other5" maxlength="36" autocomplete="off" rows="4" cols="50"></textarea>';
            } else {
            ?>
                <p for="other5">5.</p>
                <!-- <textarea type="text" id="one" name="one" maxlength="36" autocomplete="off"> -->
                <textarea style="margin-left:auto;margin-right:auto;" type="text" id="other5" name="other5" maxlength="36" autocomplete="off" rows="4" cols="50"><?php echo $result['other5'] ?></textarea>
            <?php } ?>
            <br>
            <br>

            <?php
            if (empty($result['other6'])) {
                echo '<p for="other6">6.</p>';
                echo '<textarea style="margin-left:auto;margin-right:auto;" type="text" id="other6" name="other6" maxlength="36" autocomplete="off" rows="4" cols="50"></textarea>';
            } else {
            ?>
                <p for="other6">6.</p>
                <!-- <textarea type="text" id="one" name="one" maxlength="36" autocomplete="off"> -->
                <textarea style="margin-left:auto;margin-right:auto;" type="text" id="other6" name="other6" maxlength="36" autocomplete="off" rows="4" cols="50"><?php echo $result['other6'] ?></textarea>
            <?php } ?>
            <br>
            <br>
            <div class="row">
                <div id="ed" class="col">วันสิ้นสุดการทำงาน: <input type="date" name="enddate" value="<?php echo $eddate ?>" class="form-group mx-sm-3 mb-2"></div>
            </div>
            <br>
            <!-- <div class="row align-items-center">
                <div class="col-4"></div>
                <div class="col-2">
                    <?php
                    if ($result['status'] == 'online') {
                        echo '<div><input type="radio" value="yes" name="check" checked>เสร็จสิ้น</div>';
                    } else {
                        echo '<div><input type="radio" value="yes" name="check">เสร็จสิ้น</div>';
                    }
                    ?>
                </div>

                <div class="col-2">
                    <?php
                    if ($result['status'] == 'disable') {
                        echo '<div><input type="radio" value="no" name="check" checked>ยกเลิก/ลาออก</div>';
                    } else {
                        echo '<div><input type="radio" value="no" name="check">ยกเลิก/ลาออก</div>';
                    }

                    ?>
                </div>

            </div>
            <br> -->
            <?php
            if (empty($result['description'])) {
                echo '<p><label for="des">หมายเหตุ</label></p>';
                echo '<textarea type="text" id="des" name="des" rows="4" cols="50"></textarea>';
            } else {
            ?>
                <p><label for="des">หมายเหตุ</label></p>
                <textarea type="text" id="des" name="des" rows="4" cols="50"><?php echo $result['description'] ?></textarea>
            <?php
            }
            ?>

            <br>
            <br>


            <input type="submit" class="btn btn-primary" name="save" value="บันทึก">
            <input type="submit" class="btn btn-warning" value="บันทึกและส่งอีเมล" name="sandemail">
            <input type="submit" class="btn btn-danger" name="saveout" value="บันทึกยืนยันลาออกและส่งอีเมล" name="sandemail">

            <br>
            <br>

        </form>
    </div>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });
    </script>
</body>

</html>