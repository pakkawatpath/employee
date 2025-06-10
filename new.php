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
    <title>New</title>
    <style>
        #user {
            margin-left: 10px;
        }

        #nameth {
            margin-left: 57px;
        }

        #lastnameth {
            margin-left: 25px;
        }

        #nickname {
            margin-left: 34px;
        }
        #nameen {
            margin-left: 35px;
        }

        #lastnameen {
            margin-left: 10px;
        }

        #idcard {
            margin-right: 6px;
        }

        #phone {
            margin-left: 17px;
        }

        #email {
            margin-left: 38px;
        }

        #sd {
            margin-right: 50px;
        }

        #telephone {
            margin-left: 7px;
        }

        #imgInp {
            margin-left: 480px;
        }

        span {
            color: red;
        }
    </style>
</head>

<body>
    <?php
    include_once 'db.php';
    ?>
    <br>
    <div class="container text-center">
        <div class="row">
            <div class="col-1">
                <button onclick="history.back()" class="btn btn-danger">BACK</button>
            </div>
        </div>
        <form action="add.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col">
                    <h1>เพิ่มพนักงานใหม่</h1>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <img id="blah" width="190px" height="200px" />
                    <br>
                    <br>
                    <input type='file' id="imgInp" name="img" accept="image/*" /><br />
                </div>
            </div>

            <div class="row">
                <?php
                if (empty($_SESSION['pid'])) {
                ?>
                    <div class="col">รหัสพนักงาน<span>*</span>: <input type="text" name="pid" class="form-group mx-sm-3 mb-2" autocomplete="off" required></div>
                <?php
                } else {
                ?>
                    <div class="col">รหัสพนักงาน<span>*</span>: <input type="text" name="pid" value="<?php echo $_SESSION['pid'] ?>" class="form-group mx-sm-3 mb-2" autocomplete="off" required></div>
                <?php
                }
                ?>
            </div>
            <br>
            <!-- <div class="row">
                <div id="user" class="col">Username: <input type="text" name="iduser" class="form-group mx-sm-3 mb-2"></div>
            </div>
            <br> -->
            <div class="row">
                <div class="col">คำนำหน้า<span>*</span>:
                    <select style="width: 10%;" name="1" required>
                        <option value="" disabled selected>---------------</option>
                        <option value="นาย">นาย/Mr.</option>
                        <option value="นาง">นาง/Mrs.</option>
                        <option value="นางสาว">นางสาว/Miss</option>
                    </select>
                </div>
            </div><br>
            <div class="row">
                <?php
                if (empty($_SESSION['nameth'])) {
                ?>
                    <div id="nameth" class="col">ชื่อ<span>*</span>: <input type="text" name="nameth" class="form-group mx-sm-3 mb-2" autocomplete="off" required></div>
                <?php
                } else {
                ?>
                    <div id="nameth" class="col">ชื่อ<span>*</span>: <input type="text" name="nameth" value="<?php echo $_SESSION['nameth'] ?>" class="form-group mx-sm-3 mb-2" autocomplete="off" required></div>
                <?php
                }
                ?>
            </div>
            <br>
            <div class="row">
                <?php
                if (empty($_SESSION['lastnameth'])) {
                ?>
                    <div id="lastnameth" class="col">นามสกุล<span>*</span>: <input type="text" name="lastnameth" class="form-group mx-sm-3 mb-2" autocomplete="off" required></div>
                <?php
                } else {
                ?>
                    <div id="lastnameth" class="col">นามสกุล<span>*</span>: <input type="text" name="lastnameth" value="<?php echo $_SESSION['lastnameth'] ?>" class="form-group mx-sm-3 mb-2" autocomplete="off" required></div>
                <?php
                }
                ?>
            </div>
            <br>
            <div class="row">
                <?php
                if (empty($_SESSION['nickname'])) {
                ?>
                    <div id="nickname" class="col">ชื่อเล่น<span>*</span>: <input type="text" name="nickname" class="form-group mx-sm-3 mb-2" autocomplete="off" required></div>
                <?php
                } else {
                ?>
                    <div id="nickname" class="col">ชื่อเล่น<span>*</span>: <input type="text" name="nickname" value="<?php echo $_SESSION['nickname'] ?>" class="form-group mx-sm-3 mb-2" autocomplete="off" required></div>
                <?php
                }
                ?>

            </div>
            <br>
            <div class="row">
                <?php
                if (empty($_SESSION['nameen'])) {
                ?>
                    <div id="nameen" class="col">Name<span>*</span>: <input type="text" name="nameen" class="form-group mx-sm-3 mb-2" autocomplete="off" pattern="^[a-zA-Z\s]+$" title="กรุณากรอกชื่อ นามสกุล ภาษาอังกฤษ" required></div>
                <?php
                } else {
                ?>
                    <div id="nameen" class="col">Name<span>*</span>: <input type="text" name="nameen" value="<?php echo $_SESSION['nameen'] ?>" class="form-group mx-sm-3 mb-2" autocomplete="off" pattern="^[a-zA-Z\s]+$" title="กรุณากรอกชื่อ นามสกุล ภาษาอังกฤษ" required></div>
                <?php
                }
                ?>
            </div>
            <br>
            <div class="row">
                <?php
                if (empty($_SESSION['lastnameen'])) {
                ?>
                    <div id="lastnameen" class="col">Lastname<span>*</span>: <input type="text" name="lastnameen" class="form-group mx-sm-3 mb-2" autocomplete="off" pattern="^[a-zA-Z\s]+$" title="กรุณากรอกชื่อ นามสกุล ภาษาอังกฤษ" required></div>
                <?php
                } else {
                ?>
                    <div id="lastnameen" class="col">Lastname<span>*</span>: <input type="text" name="lastnameen" value="<?php echo $_SESSION['lastnameen'] ?>" class="form-group mx-sm-3 mb-2" autocomplete="off" pattern="^[a-zA-Z\s]+$" title="กรุณากรอกชื่อ นามสกุล ภาษาอังกฤษ" required></div>
                <?php
                }
                ?>

            </div>
            <br>
            <!-- <div class="row">
                <div id="idcard" class="col">บัตรประชาชน<span>*</span>: <input type="text" name="idcard" class="form-group mx-sm-3 mb-2"></div>
            </div>
            <br> -->

            <div class="row">
                <?php
                if (empty($_SESSION['phone'])) {
                ?>
                    <div id="phone" class="col">เบอร์มือถือ<span>*</span>: <input type="text" name="phone" class="form-group mx-sm-3 mb-2" maxlength="10" autocomplete="off" required></div>
                <?php
                } else {
                ?>
                    <div id="phone" class="col">เบอร์มือถือ<span>*</span>: <input type="text" name="phone" value="<?php echo $_SESSION['phone'] ?>" class="form-group mx-sm-3 mb-2" maxlength="10" autocomplete="off" required></div>
                <?php
                }
                ?>

            </div>
            <br>
            <div class="row">
                <?php
                if (empty($_SESSION['telephone'])) {
                ?>
                    <div id="telephone" class="col">เบอร์โทรโต๊ะ: <input type="texte" name="telephone" class="form-group mx-sm-3 mb-2" autocomplete="off"></div>
                <?php
                } else {
                ?>
                    <div id="telephone" class="col">เบอร์โทรโต๊ะ: <input type="texte" name="telephone" value="<?php echo $_SESSION['telephone'] ?>" class="form-group mx-sm-3 mb-2" autocomplete="off"></div>
                <?php
                }
                ?>
            </div>
            <br>
            <div class="row">
                <?php
                if (empty($_SESSION['email'])) {
                ?>
                    <div id="email" class="col">Email<span>*</span>: <input type="email" name="email" class="form-group mx-sm-3 mb-2" autocomplete="off"></div>
                <?php
                } else {
                ?>
                    <div id="email" class="col">Email<span>*</span>: <input type="email" name="email" value="<?php echo $_SESSION['email'] ?>" class="form-group mx-sm-3 mb-2" autocomplete="off"></div>
                <?php
                }
                ?>

            </div>
            <br>
            <div class="row">
                <div id="position" class="col">ตำแหน่ง<span>*</span>:
                    <select name="position" required>
                        <option value="" disabled selected>------------------------------------------------------------------------------------------</option>
                        <?php
                        $pos = mysqli_query($conn, "SELECT * FROM `position` ORDER BY `position`");
                        while ($respos = $pos->fetch_array()) {
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
                <div id="department" class="col">แผนก<span>*</span>:
                    <select name="department" required>
                        <option value="" disabled selected>-------------------------------------------------------------</option>
                        <?php
                        $depart = mysqli_query($conn, "SELECT * FROM `department` ORDER BY `department`");
                        while ($resdepart = $depart->fetch_array()) {
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
            <div class="row">
                <div id="bod" class="col">วันเกิด<span>*</span>: <input type="date" name="bod" value="<?php echo $date_now ?>" class="form-group mx-sm-3 mb-2" required></div>
            </div>
            <br>

            <div class="row">
                <?php
                date_default_timezone_set('Asia/Bangkok');
                $date_now = date('Y-m-d H:i');
                $time = date('H:i');
                ?>

                <div style="margin-left: 30px" id="sd" class="col">วันเริ่มงาน<span>*</span>: <input type="date" name="sd" value="<?php echo $date_now ?>" class="form-group mx-sm-3 mb-2" required></div>
                <input type="hidden" name="time" value="<?php echo $time ?>">
            </div>
            <br>
            <input type="checkbox" id="descheck" onclick="check()">
            <label for="des">หมายเหตุ</label>
            <?php
            if (empty($_SESSION['description'])) {
                echo '<textarea style="display:none;margin-left:auto;margin-right:auto;" type="text" id="des" name="des" rows="4" cols="50"></textarea>';
            } else {
            ?>
                <textarea style="display:none;margin-left:auto;margin-right:auto;" type="text" id="des" name="des" rows="4" cols="50"><?php echo $_SESSION['description'] ?></textarea>
            <?php
            }
            ?>
            <br>
            <br>
            <p style="font-weight: 750;">MIS Request</p>
            <input type="checkbox" id="ch1" onclick="check()">
            <label for="hardware">อุปกรณ์คอมพิวเตอร์ ( Hardware )</label>
            <?php
            if (empty($_SESSION['hardware'])) {
            ?>
                <textarea style="display:none;margin-left:auto;margin-right:auto;" type="text" id="hardware" name="hardware" autocomplete="off" rows="4" cols="50"></textarea>
            <?php
            } else {
            ?>
                <textarea style="display:none;margin-left:auto;margin-right:auto;" type="text" id="hardware" name="hardware" autocomplete="off" rows="4" cols="50"><?php echo $_SESSION['hardware'] ?></textarea>
            <?php
            }
            ?>
            <br>

            <input type="checkbox" id="ch2" onclick="check()">
            <label for="software">โปรแกรมสำเร็จรูป ( Software )</label>
            <?php
            if (empty($_SESSION['software'])) {
            ?>
                <textarea style="display:none;margin-left:auto;margin-right:auto;" type="text" id="software" name="software" autocomplete="off" rows="4" cols="50"></textarea>
            <?php
            } else {
            ?>
                <textarea style="display:none;margin-left:auto;margin-right:auto;" type="text" id="software" name="software" autocomplete="off" rows="4" cols="50"><?php echo $_SESSION['software'] ?></textarea>
            <?php
            }
            ?>
            <br>

            <input type="checkbox" id="ch3" onclick="check()">
            <label for="app">โปรแกรมพัฒนาขึ้นเอง ( Application )</label>
            <?php
            if (empty($_SESSION['app'])) {
            ?>
                <textarea style="display:none;margin-left:auto;margin-right:auto;" type="text" id="app" name="app" autocomplete="off" rows="4" cols="50"></textarea>
            <?php
            } else {
            ?>
                <textarea style="display:none;margin-left:auto;margin-right:auto;" type="text" id="app" name="app" autocomplete="off" rows="4" cols="50"><?php echo $_SESSION['app'] ?></textarea>
            <?php
            }
            ?>
            <br>

            <input type="checkbox" id="ch4" onclick="check()">
            <label for="network"> Network Login User ( Network , VPN ) ,Share Drive</label>
            <?php
            if (empty($_SESSION['network'])) {
            ?>
                <textarea style="display:none;margin-left:auto;margin-right:auto;" type="text" id="network" name="network" autocomplete="off" rows="4" cols="50"></textarea>
            <?php
            } else {
            ?>
                <textarea style="display:none;margin-left:auto;margin-right:auto;" type="text" id="network" name="network" autocomplete="off" rows="4" cols="50"><?php echo $_SESSION['network'] ?></textarea>
            <?php
            }
            ?>
            <br>

            <input type="checkbox" id="ch5" onclick="check()">
            <label for="de">อื่นๆ โปรดระบุรายละเอียด</label>
            <?php
            if (empty($_SESSION['de'])) {
            ?>
                <textarea style="display:none;margin-left:auto;margin-right:auto;" type="text" id="de" name="de" autocomplete="off" rows="4" cols="50"></textarea>
            <?php
            } else {
            ?>
                <textarea style="display:none;margin-left:auto;margin-right:auto;" type="text" id="de" name="de" autocomplete="off" rows="4" cols="50"><?php echo $_SESSION['de'] ?></textarea>
            <?php
            }
            ?>
            <br>
            <br>

            <p style="font-weight: 900;">ที่จอดรถ</p>
            <label for="car0" style="margin-left: 15px;">ยี่ห้อรถ/รุ่นรถ</label>
            <?php
            if (empty($_SESSION['carname0'])) {
            ?>
                <input type="text" name="carname0" id="carname0" autocomplete="off">
            <?php
            } else {
            ?>
                <input type="text" name="carname0" id="carname0" value="<?php echo $_SESSION['carname0'] ?>" autocomplete="off">
            <?php
            }
            ?>
            <br>
            <br>

            <label for="car1" style="margin-left: 30px;">ทะเบียนรถ</label>
            <?php
            if (empty($_SESSION['carregi1'])) {
            ?>
                <input type="text" name="carregi1" id="carregi1" autocomplete="off">
            <?php
            } else {
            ?>
                <input type="text" name="carregi1" id="carregi1" value="<?php echo $_SESSION['carregi1'] ?>" autocomplete="off">
            <?php
            }
            ?>
            <br>
            <br>
            <input type="checkbox" id="park1" name="park1" value="check1" onclick="checkcarpark()">
            <label for="park1" id="labelpark1">ที่จอดรถอาคารพีเอสที</label>&nbsp;&nbsp;
            <br>

            <input type="checkbox" id="park2" name="park2" value="check2" onclick="checkcarpark()">
            <label for="park2" id="labelpark2">ที่จอดรถเช่า</label>
            <br>
            <br>
            <p style="font-weight: 900;">นามบัตร</p>
            <label for="myCheck">จำนวน</label>
            <input type="checkbox" id="myCheck" name="card" value="card">
            <label for="myCheck">100ใบ</label>
            <br>
            <br>

            <p style="font-weight: 900;">Fleet card</p>
            <label for="carname" style="margin-left: 15px;">ยี่ห้อรถ/รุ่นรถ</label>
            <?php
            if (empty($_SESSION['carname'])) {
            ?>
                <input type="text" id="carname" name="carname" autocomplete="off">
            <?php
            } else {
            ?>
                <input type="text" id="carname" name="carname" value="<?php echo $_SESSION['carname'] ?>" autocomplete="off">
            <?php
            }
            ?>
            <br>
            <br>

            <label for="carregi" style="margin-left: 30px;">ทะเบียนรถ</label>
            <?php
            if (empty($_SESSION['carregi'])) {
            ?>
                <input type="text" id="carregi" name="carregi" autocomplete="off">
            <?php
            } else {
            ?>
                <input type="text" id="carregi" name="carregi" value="<?php echo $_SESSION['carregi'] ?>" autocomplete="off">
            <?php
            }
            ?>
            <br>
            <br>

            <label for="fuel" style="margin-left: 40px;">เชื้อเพลิง</label>
            <?php
            if (empty($_SESSION['fuel'])) {
            ?>
                <input type="text" id="fuel" name="fuel" autocomplete="off">
            <?php
            } else {
            ?>
                <input type="text" id="fuel" name="fuel" value="<?php echo $_SESSION['fuel'] ?>" autocomplete="off">
            <?php
            }
            ?>
            <br>
            <br>

            <label for="limit" style="margin-left: 60px;">วงเงิน</label>
            <?php
            if (empty($_SESSION['limit'])) {
            ?>
                <input type="text" id="limit" name="limit" autocomplete="off">
            <?php
            } else {
            ?>
                <input type="text" id="limit" name="limit" value="<?php echo $_SESSION['limit'] ?>" autocomplete="off">
            <?php
            }
            ?>
            <br>
            <br>

            <label for="documents">เอกสารประกอบ</label>
            <?php
            if (empty($_SESSION['doc'])) {
            ?>
                <input type="text" id="documents" name="documents" autocomplete="off">
            <?php
            } else {
            ?>
                <input type="text" id="documents" name="documents" value="<?php echo $_SESSION['doc'] ?>" autocomplete="off">
            <?php
            }
            ?>
            <br>
            <br>

            <p style="font-weight: 900;">เบอร์โทรศัพท์มือถือ</p>
            <input type="radio" id="phonech" name="phonech" value="phone0">
            <label for="phone">ไม่มี</label>
            <br>
            <input type="radio" id="phonech" name="phonech" value="phone1">
            <label for="phone">เดือนละ 449 บาท โทรฟรีทุกเครือข่ายไม่จำกัด เน็ท 10 GB</label>
            <br>
            <input type="radio" id="phonech" name="phonech" value="phone2">
            <label for="phone">เดือนละ 599 บาท โทรฟรีทุกเครือข่ายไม่จำกัด เน็ท 20 GB</label>
            <br>
            <input type="radio" id="phonech" name="phonech" value="phone3">
            <label for="phone">เดือนละ 799 บาท โทรฟรีทุกเครือข่ายไม่จำกัด เน็ท 40 GB</label>
            <br>
            <input type="radio" id="phonech" name="phonech" value="phone4">
            <label for="phone">เดือนละ 999 บาท โทรฟรีทุกเครือข่ายไม่จำกัด เน็ท 65 GB</label>
            <br>
            <br>
            <p style="font-weight: 900;">อุปกรณ์สำนักงาน</p>
            <input type="radio" id="tool" name="tool" value="tool0">
            <label for="tool">ไม่มี</label>
            <br>
            <input type="radio" id="tool" name="tool" value="tool1">
            <label for="tool">อุปกรณ์สำนักงาน</label>
            <br>
            <br>
            <p style="font-weight: 900;">อื่นๆ</p>
            <p for="one">1.</p>
            <!-- <textarea type="text" id="one" name="one" maxlength="36" autocomplete="off"> -->
            <?php
            if (empty($_SESSION['one'])) {
            ?>
                <textarea style="margin-left:auto;margin-right:auto;" type="text" id="one" name="one" maxlength="36" autocomplete="off" rows="4" cols="50"></textarea>
            <?php
            } else {
            ?>
                <textarea style="margin-left:auto;margin-right:auto;" type="text" id="one" name="one" maxlength="36" autocomplete="off" rows="4" cols="50"><?php echo $_SESSION['one'] ?></textarea>
            <?php
            }
            ?>
            <br>
            <br>

            <p for="two">2.</p>
            <!-- <input type="text" id="two" name="two" maxlength="36" autocomplete="off"> -->
            <?php
            if (empty($_SESSION['two'])) {
            ?>
                <textarea style="margin-left:auto;margin-right:auto;" type="text" id="two" name="two" maxlength="36" autocomplete="off" rows="4" cols="50"></textarea>
            <?php
            } else {
            ?>
                <textarea style="margin-left:auto;margin-right:auto;" type="text" id="two" name="two" maxlength="36" autocomplete="off" rows="4" cols="50"><?php echo $_SESSION['two'] ?></textarea>
            <?php
            }
            ?>
            <br>
            <br>

            <p for="three">3.</p>
            <?php
            if (empty($_SESSION['three'])) {
            ?>
                <textarea style="margin-left:auto;margin-right:auto;" type="text" id="three" name="three" maxlength="36" autocomplete="off" rows="4" cols="50"></textarea>
            <?php
            } else {
            ?>
                <textarea style="margin-left:auto;margin-right:auto;" type="text" id="three" name="three" maxlength="36" autocomplete="off" rows="4" cols="50"><?php echo $_SESSION['three'] ?></textarea>
            <?php
            }
            ?>
            <!-- <input type="text" id="three" name="three" maxlength="36" autocomplete="off"> -->
            <br>
            <br>

            <p for="four">4.</p>
            <?php
            if (empty($_SESSION['four'])) {
            ?>
                <textarea style="margin-left:auto;margin-right:auto;" type="text" id="four" name="four" maxlength="36" autocomplete="off" rows="4" cols="50"></textarea>
            <?php
            } else {
            ?>
                <textarea style="margin-left:auto;margin-right:auto;" type="text" id="four" name="four" maxlength="36" autocomplete="off" rows="4" cols="50"><?php echo $_SESSION['four'] ?></textarea>
            <?php
            }
            ?>
            <!-- <input type="text" id="four" name="four" maxlength="36" autocomplete="off"> -->
            <br>
            <br>

            <p for="five">5.</p>
            <?php
            if (empty($_SESSION['five'])) {
            ?>
                <textarea style="margin-left:auto;margin-right:auto;" type="text" id="five" name="five" maxlength="36" autocomplete="off" rows="4" cols="50"></textarea>
            <?php
            } else {
            ?>
                <textarea style="margin-left:auto;margin-right:auto;" type="text" id="five" name="five" maxlength="36" autocomplete="off" rows="4" cols="50"><?php echo $_SESSION['five'] ?></textarea>
            <?php
            }
            ?>
            <!-- <input type="text" id="five" name="five" maxlength="36" autocomplete="off"> -->
            <br>
            <br>

            <p for="six">6.</p>
            <?php
            if (empty($_SESSION['six'])) {
            ?>
                <textarea style="margin-left:auto;margin-right:auto;" type="text" id="six" name="six" maxlength="36" autocomplete="off" rows="4" cols="50"></textarea>
            <?php
            } else {
            ?>
                <textarea style="margin-left:auto;margin-right:auto;" type="text" id="six" name="six" maxlength="36" autocomplete="off" rows="4" cols="50"><?php echo $_SESSION['six'] ?></textarea>
            <?php
            }
            ?>
            <!-- <input type="text" id="six" name="six" maxlength="36" autocomplete="off"> -->
            <br>
            <br>

            <input type="hidden" name="admin" value="<?php echo $_SESSION["UserID"] ?>">
            <input type="submit" class="btn btn-primary" name="new" value="ยืนยัน">
            <div style="margin: 50px 2% -10px;text-align:center;"></div>
        </form>
    </div>

    <script>
        function checkcarpark() {
            var carname0 = document.getElementById('carname0').value;
            var carregi1 = document.getElementById('carregi1').value;

            var park1 = document.getElementById('park1');
            var park2 = document.getElementById('park2');

            if (park1.checked == true || park2.checked == true) {
                if (!carname0 || !carregi1) {
                    alert('กรุณากรอกข้อมูลยี่ห้อรถ/รุ่นรถ และทะเบียนรถช่องข้างบนก่อน')
                    park1.checked = false
                    park2.checked = false
                }
            }

        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function check() {
            var ch1 = document.getElementById('ch1');
            var ch2 = document.getElementById('ch2');
            var ch3 = document.getElementById('ch3');
            var ch4 = document.getElementById('ch4');
            var ch5 = document.getElementById('ch5');
            var descheck = document.getElementById('descheck');

            var hardware = document.getElementById('hardware');
            var software = document.getElementById('software');
            var app = document.getElementById('app');
            var net = document.getElementById('network');
            var de = document.getElementById('de');
            var des = document.getElementById('des');

            if (ch1.checked == true) {
                hardware.style.display = "block";
            } else {
                hardware.style.display = "none";
            }

            if (ch2.checked == true) {
                software.style.display = "block";
            } else {
                software.style.display = "none";
            }

            if (ch3.checked == true) {
                app.style.display = "block";
            } else {
                app.style.display = "none";
            }

            if (ch4.checked == true) {
                net.style.display = "block";
            } else {
                net.style.display = "none";
            }

            if (ch5.checked == true) {
                de.style.display = "block";
            } else {
                de.style.display = "none";
            }

            if (descheck.checked == true) {
                des.style.display = "block";
            } else {
                des.style.display = "none";
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });
    </script>

</body>

</html>