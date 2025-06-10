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
    <title>New Serial</title>
    <style>
        #maker {
            margin-left: 15px;
        }

        #comtype {
            margin-right: 10px;
        }

        #commodel {
            margin-right: 14px;
        }

        #rental {
            margin-left: 14px;
        }

        #accessory {
            margin-right: 10px;
        }

        #accesscode {
            margin-right: 25px;
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
                <h1>เพิ่ม Serial</h1>
            </div>
        </div>
        <form action="addserialandcontract.php" method="POST">
            <br>
            <div class="col align-self-center">
                <?php
                if (empty($_SESSION['serialno'])) {
                ?>
                    <div id="" class="col">SerialNo<span>*</span>: <input type="text" name="serialno" autocomplete="off" required></div>
                <?php
                } else {
                ?>
                    <div id="" class="col">SerialNo<span>*</span>: <input type="text" name="serialno" value="<?php echo $_SESSION['serialno'] ?>" autocomplete="off" required></div>
                <?php
                }
                ?>
            </div>
            <br>
            <div class="col align-self-center">
                <select name="contractno">
                    <option value="" disabled selected>ContractNo</option>
                    <?php
                    $xc = mysqli_query($conn, "SELECT DISTINCT `contractno` FROM `contractmaster` ");
                    while ($contract = $xc->fetch_array()) {
                    ?>
                        <option value="<?php echo $contract['contractno'] ?>"><?php echo $contract['contractno'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <br>

            <div class="col align-self-center">
                <select name="makersel">
                    <option value="">Maker</option>
                    <?php
                    $xm = mysqli_query($conn, "SELECT DISTINCT `maker` FROM `maker`");
                    while ($maker = $xm->fetch_array()) {
                    ?>
                        <option value="<?php echo $maker['maker'] ?>"><?php echo $maker['maker'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <br>
            <div class="col align-self-center">
                <input type="checkbox" id="makerch" onclick="check()">
                <label style="font-weight: normal;" for="maker">เพื่ม Maker อื่นๆ</label>
                <?php
                if (empty($_SESSION['maker'])) {
                ?>
                    <input style="display: none;margin-left:490px;" type="text" id="maker" name="maker" autocomplete="off">
                <?php
                } else {
                ?>
                    <input style="display: none;margin-left:490px;" type="text" id="maker" name="maker" value="<?php echo $_SESSION['maker'] ?>" autocomplete="off">
                <?php
                }
                ?>
            </div>
            <br>

            <div class="col align-self-center">
                <p>Com Type<span>*</span></p>
                <select name="selectcomtype" id="selectcomtype" onchange="check()">
                    <option>------------</option>
                    <option value="notebook">Notebook</option>
                    <option value="desktop">Desktop</option>
                    <option value="monitor">Monitor</option>
                    <option value="printer">Printer</option>
                    <option value="hdd">HDD</option>
                </select>
            </div>
            <br>
            <div class="col align-self-center">
                <p></p>
                <label style="display:none;font-weight: normal;" for="notebookselect" id="notebooklabel">Notebook</label>
                <select style="display:none;margin-left:535px;" id="notebookselect" name="notebookselect">
                    <option value="">Model</option>
                    <?php
                    $xnotebook = mysqli_query($conn, "SELECT DISTINCT `commodel` FROM `commodel` WHERE `type` = 'Notebook' AND `spec` = ''");
                    while ($notebookmodel = $xnotebook->fetch_array()) {
                    ?>
                        <option value="<?php echo $notebookmodel['commodel'] ?>"><?php echo $notebookmodel['commodel'] ?></option>
                    <?php
                    }
                    ?>
                </select> 
                <input style="display:none;" type="checkbox" id="checkmodel" onclick="check()">
                <input type="hidden" name="typenotebook" value="Notebook">
                <label style="display:none;font-weight: normal;" for="notebookmodel" id="notebooklabel2">เพิ่มModelที่ไม่มีให้เลือก :</label>
                <?php
                if (empty($_SESSION['notebookmodel'])) {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="notebookmodel" name="notebookmodel" autocomplete="off">
                    <?php
                } else {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="notebookmodel" name="notebookmodel" value="<?php echo $_SESSION['notebookmodel'] ?>" autocomplete="off">
                    <?php
                }
                ?>
                
                <p></p>
                <label style="display:none;font-weight: normal;" for="cpuselect" id="cpulabel">CPU:</label>
                <select style="display:none;margin-left:535px;" id="cpuselect" name="cpuselect">
                    <option value="">CPU</option>
                    <?php
                    $xcpu = mysqli_query($conn, "SELECT DISTINCT `commodel` FROM `commodel` WHERE `type` = 'Notebook' AND `spec` = 'CPU'");
                    while ($cpumodel = $xcpu->fetch_array()) {
                    ?>
                        <option value="<?php echo $cpumodel['commodel'] ?>"><?php echo $cpumodel['commodel'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input style="display:none;" type="checkbox" id="checkcpu" onclick="check()">
                <input type="hidden" name="typecpu" value="CPU">
                <label style="display:none;font-weight: normal;" for="cpumodel" id="cpulabel2">เพิ่มCPUที่ไม่มีให้เลือก :</label>
                <?php
                if (empty($_SESSION['cpumodel'])) {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="cpumodel" name="cpumodel" autocomplete="off">
                    <?php
                } else {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="cpumodel" name="cpumodel" value="<?php echo $_SESSION['cpumodel'] ?>" autocomplete="off">
                    <?php
                }
                ?>
                
                <p></p>
                <label style="display:none;font-weight: normal;" for="ramselect" id="ramlabel">RAM:</label>
                <select style="display:none;margin-left:535px;" id="ramselect" name="ramselect">
                    <option value="">RAM</option>
                    <?php
                    $xram = mysqli_query($conn, "SELECT DISTINCT `commodel` FROM `commodel` WHERE `type` = 'Notebook' AND `spec` = 'RAM'");
                    while ($rammodel = $xram->fetch_array()) {
                    ?>
                        <option value="<?php echo $rammodel['commodel'] ?>"><?php echo $rammodel['commodel'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input style="display:none;" type="checkbox" id="checkram" onclick="check()">
                <input type="hidden" name="typeram" value="RAM">
                <label style="display:none;font-weight: normal;" for="rammodel" id="ramlabel2">เพิ่มRAMที่ไม่มีให้เลือก :</label>
                <?php
                if (empty($_SESSION['rammodel'])) {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="rammodel" name="rammodel" autocomplete="off">
                    <?php
                } else {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="rammodel" name="rammodel" value="<?php echo $_SESSION['rammodel'] ?>" autocomplete="off">
                    <?php
                }
                ?>
                
                <p></p>
                <label style="display:none;font-weight: normal;" for="ssdselect" id="ssdlabel">SSD:</label>
                <select style="display:none;margin-left:535px;" id="ssdselect" name="ssdselect">
                    <option value="">SSD</option>
                    <?php
                    $xssd = mysqli_query($conn, "SELECT DISTINCT `commodel` FROM `commodel` WHERE `type` = 'Notebook' AND `spec` = 'SSD'");
                    while ($ssdmodel = $xssd->fetch_array()) {
                    ?>
                        <option value="<?php echo $ssdmodel['commodel'] ?>"><?php echo $ssdmodel['commodel'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input style="display:none;" type="checkbox" id="checkssd" onclick="check()">
                <input type="hidden" name="typessd" value="SSD">
                <label style="display:none;font-weight: normal;" for="ssdmodel" id="ssdlabel2">เพิ่มSSDที่ไม่มีให้เลือก :</label>
                <?php
                if (empty($_SESSION['ssdmodel'])) {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="ssdmodel" name="ssdmodel" autocomplete="off">
                    <?php
                } else {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="ssdmodel" name="ssdmodel" value="<?php echo $_SESSION['ssdmodel'] ?>" autocomplete="off">
                    <?php
                }
                ?>
                <p></p>
                <label style="display:none;font-weight: normal;" for="osselect" id="oslabel">Operating System:</label>
                <select style="display:none;margin-left:500px;" id="osselect" name="osselect">
                    <option value="">Operating System</option>
                    <?php
                    $xos = mysqli_query($conn, "SELECT DISTINCT `commodel` FROM `commodel` WHERE `type` = 'Notebook' AND `spec` = 'OS'");
                    while ($osmodel = $xos->fetch_array()) {
                    ?>
                        <option value="<?php echo $osmodel['commodel'] ?>"><?php echo $osmodel['commodel'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input style="display:none;" type="checkbox" id="checkos" onclick="check()">
                <input type="hidden" name="typeos" value="OS">
                <label style="display:none;font-weight: normal;" for="osmodel" id="oslabel2">เพิ่มOperating Systemที่ไม่มีให้เลือก :</label>
                <?php
                if (empty($_SESSION['osmodel'])) {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="osmodel" name="osmodel" autocomplete="off">
                    <?php
                } else {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="osmodel" name="osmodel" value="<?php echo $_SESSION['osmodel'] ?>" autocomplete="off">
                    <?php
                }
                ?>
                
                <p></p>
                <label style="display:none;font-weight: normal;" for="wrselect" id="wrlabel">Warranty:</label>
                <select style="display:none;margin-left:530px;" id="wrselect" name="wrselect">
                    <option value="">Warranty</option>
                    <?php
                    $xwr = mysqli_query($conn, "SELECT DISTINCT `commodel` FROM `commodel` WHERE `type` = 'Notebook' AND `spec` = 'Warranty'");
                    while ($wrmodel = $xwr->fetch_array()) {
                    ?>
                        <option value="<?php echo $wrmodel['commodel'] ?>"><?php echo $wrmodel['commodel'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input style="display:none;" type="checkbox" id="checkwr" onclick="check()">
                <input type="hidden" name="typewr" value="Warranty">
                <label style="display:none;font-weight: normal;" for="wrmodel" id="wrlabel2">เพิ่มWarrantyที่ไม่มีให้เลือก :</label>
                <?php
                if (empty($_SESSION['wrmodel'])) {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="wrmodel" name="wrmodel" autocomplete="off">
                    <?php
                } else {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="wrmodel" name="wrmodel" value="<?php echo $_SESSION['wrmodel'] ?>"  autocomplete="off">
                    <?php
                }
                ?>
            </div>

            <div class="col align-self-center">
                <label style="display:none;font-weight: normal;" for="desktopselect" id="desktoplabel">Desktop</label>
                <select style="display:none;margin-left:535px;" id="desktopselect" name="desktopselect">
                    <option value="">Model</option>
                    <?php
                    $xdesktop = mysqli_query($conn, "SELECT DISTINCT `commodel` FROM `commodel` WHERE `type` = 'DeskTop' AND `spec` = ''");
                    while ($desktopmodel = $xdesktop->fetch_array()) {
                    ?>
                        <option value="<?php echo $desktopmodel['commodel'] ?>"><?php echo $desktopmodel['commodel'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input style="display:none;" type="checkbox" id="checkdesktop" onclick="check()">
                <input type="hidden" name="typedesktop" value="DeskTop">
                <label style="display:none;font-weight: normal;" for="deaktopmodel" id="desktoplabel2">เพิ่มModelที่ไม่มีให้เลือก :</label>
                <?php
                if (empty($_SESSION['desktopmodel'])) {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="desktopmodel" name="desktopmodel" autocomplete="off">
                    <?php
                } else {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="desktopmodel" name="desktopmodel" value="<?php echo $_SESSION['desktopmodel'] ?>" autocomplete="off">
                    <?php
                }
                ?>
                <p></p>
                <label style="display:none;font-weight: normal;" for="desktopcpuselect" id="desktopcpulabel">CPU:</label>
                <select style="display:none;margin-left:535px;" id="desktopcpuselect" name="desktopcpuselect">
                    <option value="">CPU</option>
                    <?php
                    $xdesktopcpu = mysqli_query($conn, "SELECT DISTINCT `commodel` FROM `commodel` WHERE `type` = 'DeskTop' AND `spec` = 'CPU'");
                    while ($desktopcpumodel = $xdesktopcpu->fetch_array()) {
                    ?>
                        <option value="<?php echo $desktopcpumodel['commodel'] ?>"><?php echo $desktopcpumodel['commodel'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input style="display:none;" type="checkbox" id="checkdesktopcpu" onclick="check()">
                <label style="display:none;font-weight: normal;" for="desktopcpumodel" id="desktopcpulabel2">เพิ่มCPUที่ไม่มีให้เลือก :</label>
                <?php
                if (empty($_SESSION['desktopcpumodel'])) {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="desktopcpumodel" name="desktopcpumodel" autocomplete="off">
                    <?php
                } else {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="desktopcpumodel" name="desktopcpumodel" value="<?php echo $_SESSION['desktopcpumodel'] ?>" autocomplete="off">
                    <?php
                }
                ?>
                
                <p></p>
                <label style="display:none;font-weight: normal;" for="desktopramselect" id="desktopramlabel">RAM:</label>
                <select style="display:none;margin-left:535px;" id="desktopramselect" name="desktopramselect">
                    <option value="">RAM</option>
                    <?php
                    $xdesktopram = mysqli_query($conn, "SELECT DISTINCT `commodel` FROM `commodel` WHERE `type` = 'DeskTop' AND `spec` = 'RAM'");
                    while ($desktoprammodel = $xdesktopram->fetch_array()) {
                    ?>
                        <option value="<?php echo $desktoprammodel['commodel'] ?>"><?php echo $desktoprammodel['commodel'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input style="display:none;" type="checkbox" id="checkdesktopram" onclick="check()">
                <label style="display:none;font-weight: normal;" for="desktoprammodel" id="desktopramlabel2">เพิ่มRAMที่ไม่มีให้เลือก :</label>
                <?php
                if (empty($_SESSION['desktoprammodel'])) {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="desktoprammodel" name="desktoprammodel" autocomplete="off">
                    <?php
                } else {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="desktoprammodel" name="desktoprammodel" value="<?php echo $_SESSION['desktoprammodel'] ?>" autocomplete="off">
                    <?php
                }
                ?>
                
                <p></p>
                <label style="display:none;font-weight: normal;" for="desktopssdselect" id="desktopssdlabel">SSD:</label>
                <select style="display:none;margin-left:535px;" id="desktopssdselect" name="desktopssdselect">
                    <option value="">SSD</option>
                    <?php
                    $xdesktopssd = mysqli_query($conn, "SELECT DISTINCT `commodel` FROM `commodel` WHERE `type` = 'DeskTop' AND `spec` = 'SSD'");
                    while ($desktopssdmodel = $xdesktopssd->fetch_array()) {
                    ?>
                        <option value="<?php echo $desktopssdmodel['commodel'] ?>"><?php echo $desktopssdmodel['commodel'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input style="display:none;" type="checkbox" id="checkdesktopssd" onclick="check()">
                <label style="display:none;font-weight: normal;" for="desktopssdmodel" id="desktopssdlabel2">เพิ่มSSDที่ไม่มีให้เลือก :</label>
                <?php
                if (empty($_SESSION['desktopssdmodel'])) {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="desktopssdmodel" name="desktopssdmodel" autocomplete="off">
                    <?php
                } else {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="desktopssdmodel" name="desktopssdmodel" value="<?php echo $_SESSION['desktopssdmodel'] ?>" autocomplete="off">
                    <?php
                }
                ?>
                
                <p></p>
                <label style="display:none;font-weight: normal;" for="desktoposselect" id="desktoposlabel">Operating System:</label>
                <select style="display:none;margin-left:500px;" id="desktoposselect" name="desktoposselect">
                    <option value="">Operating System</option>
                    <?php
                    $xdesktopos = mysqli_query($conn, "SELECT DISTINCT `commodel` FROM `commodel` WHERE `type` = 'DeskTop' AND `spec` = 'OS'");
                    while ($desktoposmodel = $xdesktopos->fetch_array()) {
                    ?>
                        <option value="<?php echo $desktoposmodel['commodel'] ?>"><?php echo $desktoposmodel['commodel'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input style="display:none;" type="checkbox" id="checkdesktopos" onclick="check()">
                <label style="display:none;font-weight: normal;" for="desktoposmodel" id="desktoposlabel2">เพิ่มOperating Systemที่ไม่มีให้เลือก :</label>
                <?php
                if (empty($_SESSION['desktoposmodel'])) {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="desktoposmodel" name="desktoposmodel" autocomplete="off">
                    <?php
                } else {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="desktoposmodel" name="desktoposmodel" value="<?php echo $_SESSION['desktoposmodel'] ?>" autocomplete="off">
                    <?php
                }
                ?>
                
                <p></p>
                <label style="display:none;font-weight: normal;" for="desktopwrselect" id="desktopwrlabel">Warranty:</label>
                <select style="display:none;margin-left:530px;" id="desktopwrselect" name="desktopwrselect">
                    <option value="">Warranty</option>
                    <?php
                    $xdesktopwr = mysqli_query($conn, "SELECT DISTINCT `commodel` FROM `commodel` WHERE `type` = 'DeskTop' AND `spec` = 'Warranty'");
                    while ($desktopwrmodel = $xdesktopwr->fetch_array()) {
                    ?>
                        <option value="<?php echo $desktopwrmodel['commodel'] ?>"><?php echo $desktopwrmodel['commodel'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input style="display:none;" type="checkbox" id="checkdesktopwr" onclick="check()">
                <label style="display:none;font-weight: normal;" for="desktopwrmodel" id="desktopwrlabel2">เพิ่มWarrantyที่ไม่มีให้เลือก :</label>
                <?php
                if (empty($_SESSION['desktopwrmodel'])) {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="desktopwrmodel" name="desktopwrmodel" autocomplete="off">
                    <?php
                } else {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="desktopwrmodel" name="desktopwrmodel" value="<?php echo $_SESSION['desktopwrmodel'] ?>" autocomplete="off">
                    <?php
                }
                ?>
            </div>

            <div class="col align-self-center">
                <label style="display:none;font-weight: normal;" for="monitorselect" id="monitorlabel">Monitor :</label>
                <select style="display:none;margin-left:535px;" id="monitorselect" name="monitorselect">
                    <option value="">Monitor</option>
                    <?php
                    $xmonitor = mysqli_query($conn, "SELECT DISTINCT `commodel` FROM `commodel` WHERE `type` = 'Monitor'");
                    while ($monitormodel = $xmonitor->fetch_array()) {
                    ?>
                        <option value="<?php echo $monitormodel['commodel'] ?>"><?php echo $monitormodel['commodel'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input style="display:none;" type="checkbox" id="checkmonitor" onclick="check()">
                <input type="hidden" name="monitor" value="Monitor">
                <label style="display:none;font-weight: normal;" for="monitormodel" id="monitorlabel2">เพิ่มMonitorที่ไม่มีให้เลือก :</label>
                <?php
                if (empty($_SESSION['monitormodel'])) {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="monitormodel" name="monitormodel" autocomplete="off">
                    <?php
                } else {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="monitormodel" name="monitormodel" value="<?php echo $_SESSION['monitormodel'] ?>" autocomplete="off">
                    <?php
                }
                ?>
                
            </div>

            <div class="col align-self-center">
                <label style="display:none;font-weight: normal;" for="printerselect" id="printerlabel">Printer :</label>
                <select style="display:none;margin-left:535px;" id="printerselect" name="printerselect">
                    <option value="">Printer</option>
                    <?php
                    $xprinter = mysqli_query($conn, "SELECT DISTINCT `commodel` FROM `commodel` WHERE `type` = 'Printer'");
                    while ($printermodel = $xprinter->fetch_array()) {
                    ?>
                        <option value="<?php echo $printermodel['commodel'] ?>"><?php echo $printermodel['commodel'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input style="display:none;" type="checkbox" id="checkprinter" onclick="check()">
                <input type="hidden" name="printer" value="Printer">
                <label style="display:none;font-weight: normal;" for="printermodel" id="printerlabel2">เพิ่มPrinterที่ไม่มีให้เลือก :</label>
                <?php
                if (empty($_SESSION['printermodel'])) {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="printermodel" name="printermodel" autocomplete="off">
                    <?php
                } else {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="printermodel" name="printermodel" value="<?php echo $_SESSION['printermodel'] ?>" autocomplete="off">
                    <?php
                }
                ?>
                
            </div>

            <div class="col align-self-center">
                <label style="display:none;font-weight: normal;" for="hddselect" id="hddlabel">HDD :</label>
                <select style="display:none;margin-left:545px;" id="hddselect" name="hddselect">
                    <option value="">HDD</option>
                    <?php
                    $xhdd = mysqli_query($conn, "SELECT DISTINCT `commodel` FROM `commodel` WHERE `type` = 'HDD'");
                    while ($hddmodel = $xhdd->fetch_array()) {
                    ?>
                        <option value="<?php echo $hddmodel['commodel'] ?>"><?php echo $hddmodel['commodel'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input style="display:none;" type="checkbox" id="checkhdd" onclick="check()">
                <input type="hidden" name="hdd" value="HDD">
                <label style="display:none;font-weight: normal;" for="hddmodel" id="hddlabel2">เพิ่มHDDที่ไม่มีให้เลือก</label>
                <?php
                if (empty($_SESSION['hddmodel'])) {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="hddmodel" name="hddmodel" autocomplete="off">
                    <?php
                } else {
                    ?>
                    <input style="display:none;margin-left:490px;" type="text" id="hddmodel" name="hddmodel" value="<?php echo $_SESSION['hddmodel'] ?>" autocomplete="off">
                    <?php
                }
                ?>
                
            </div>
            <br>

            <div class="col align-self-center">
                <?php
                if (empty($_SESSION['rental'])) {
                ?>
                    <div id="rental" class="col">Rental<span>*</span>: <input type="text" name="rental" autocomplete="off" required></div>
                <?php
                } else {
                ?>
                    <div id="rental" class="col">Rental<span>*</span>: <input type="text" name="rental" autocomplete="off" value="<?php echo $_SESSION['rental'] ?>" required></div>
                <?php
                }
                ?>

            </div>
            <br>
            <div class="col align-self-center">
                <?php
                if (empty($_SESSION['accessory'])) {
                ?>
                    <div id="accessory" class="col">Accessory<span>*</span>: <input type="text" name="accessory" autocomplete="off" required></div>
                <?php
                } else {
                ?>
                    <div id="accessory" class="col">Accessory<span>*</span>: <input type="text" name="accessory" value="<?php echo $_SESSION['accessory'] ?>" autocomplete="off" required></div>
                <?php
                }
                ?>

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
            <input type="submit" class="btn btn-primary" name="newserial" value="เพิ่ม">
            <div style="margin: 50px 2% -10px;text-align:center;"></div>
        </form>
    </div>

    <script>
        function check() {
            var makerch = document.getElementById('makerch');
            var maker = document.getElementById('maker');

            if (makerch.checked == true) {
                maker.style.display = "block";
            } else {
                maker.style.display = "none";
            }

            var selectcomtype = document.getElementById('selectcomtype').value;

            var notebooklabel = document.getElementById('notebooklabel');
            var notebookmodel = document.getElementById('notebookmodel');
            var notebookselect = document.getElementById('notebookselect');
            var notebooklabel2 = document.getElementById('notebooklabel2');
            var checkmodel = document.getElementById('checkmodel');

            var cpulabel = document.getElementById('cpulabel');
            var cpumodel = document.getElementById('cpumodel');
            var cpuselect = document.getElementById('cpuselect');
            var cpulabel2 = document.getElementById('cpulabel2');
            var checkcpu = document.getElementById('checkcpu');

            var ramlabel = document.getElementById('ramlabel');
            var rammodel = document.getElementById('rammodel');
            var ramselect = document.getElementById('ramselect');
            var ramlabel2 = document.getElementById('ramlabel2');
            var checkram = document.getElementById('checkram');

            var ssdlabel = document.getElementById('ssdlabel');
            var ssdmodel = document.getElementById('ssdmodel');
            var ssdselect = document.getElementById('ssdselect');
            var ssdlabel2 = document.getElementById('ssdlabel2');
            var checkssd = document.getElementById('checkssd');

            var oslabel = document.getElementById('oslabel');
            var osmodel = document.getElementById('osmodel');
            var osselect = document.getElementById('osselect');
            var oslabel2 = document.getElementById('oslabel2');
            var checkos = document.getElementById('checkos');

            var wrlabel = document.getElementById('wrlabel');
            var wrmodel = document.getElementById('wrmodel');
            var wrselect = document.getElementById('wrselect');
            var wrlabel2 = document.getElementById('wrlabel2');
            var checkwr = document.getElementById('checkwr');

            var desktoplabel = document.getElementById('desktoplabel');
            var desktopmodel = document.getElementById('desktopmodel');
            var desktopselect = document.getElementById('desktopselect');
            var desktoplabel2 = document.getElementById('desktoplabel2');
            var checkdestop = document.getElementById('checkdesktop');

            var desktopcpulabel = document.getElementById('desktopcpulabel');
            var desktopcpumodel = document.getElementById('desktopcpumodel');
            var desktopcpuselect = document.getElementById('desktopcpuselect');
            var desktopcpulabel2 = document.getElementById('desktopcpulabel2');
            var checkdestopcpu = document.getElementById('checkdesktopcpu');

            var desktopramlabel = document.getElementById('desktopramlabel');
            var desktoprammodel = document.getElementById('desktoprammodel');
            var desktopramselect = document.getElementById('desktopramselect');
            var desktopramlabel2 = document.getElementById('desktopramlabel2');
            var checkdestopram = document.getElementById('checkdesktopram');

            var desktopssdlabel = document.getElementById('desktopssdlabel');
            var desktopssdmodel = document.getElementById('desktopssdmodel');
            var desktopssdselect = document.getElementById('desktopssdselect');
            var desktopssdlabel2 = document.getElementById('desktopssdlabel2');
            var checkdestopssd = document.getElementById('checkdesktopssd');

            var desktoposlabel = document.getElementById('desktoposlabel');
            var desktoposmodel = document.getElementById('desktoposmodel');
            var desktoposselect = document.getElementById('desktoposselect');
            var desktoposlabel2 = document.getElementById('desktoposlabel2');
            var checkdestopos = document.getElementById('checkdesktopos');

            var desktopwrlabel = document.getElementById('desktopwrlabel');
            var desktopwrmodel = document.getElementById('desktopwrmodel');
            var desktopwrselect = document.getElementById('desktopwrselect');
            var desktopwrlabel2 = document.getElementById('desktopwrlabel2');
            var checkdestopwr = document.getElementById('checkdesktopwr');
            
            var monitorlabel = document.getElementById('monitorlabel');
            var monitormodel = document.getElementById('monitormodel');
            var monitorselect = document.getElementById('monitorselect');
            var monitorlabel2 = document.getElementById('monitorlabel2');
            var checkmonitor = document.getElementById('checkmonitor');

            var printerlabel = document.getElementById('printerlabel');
            var printermodel = document.getElementById('printermodel');
            var printerselect = document.getElementById('printerselect');
            var printerlabel2 = document.getElementById('printerlabel2');
            var checkprinter = document.getElementById('checkprinter');

            var hddlabel = document.getElementById('hddlabel');
            var hddmodel = document.getElementById('hddmodel');
            var hddselect = document.getElementById('hddselect');
            var hddlabel2 = document.getElementById('hddlabel2');
            var checkhdd = document.getElementById('checkhdd');

            if (selectcomtype == 'notebook') {
                notebooklabel2.style.display = "inline-block";
                notebookselect.style.display = "block";
                notebooklabel.style.display = "block";
                cpulabel2.style.display = "inline-block";
                cpuselect.style.display = "block";
                cpulabel.style.display = "block";
                ramlabel2.style.display = "inline-block";
                ramselect.style.display = "block";
                ramlabel.style.display = "block";
                ssdlabel2.style.display = "inline-block";
                ssdselect.style.display = "block";
                ssdlabel.style.display = "block";
                oslabel2.style.display = "inline-block";
                osselect.style.display = "block";
                oslabel.style.display = "block";
                wrlabel2.style.display = "inline-block";
                wrselect.style.display = "block";
                wrlabel.style.display = "block";
                checkmodel.style.display = "inline-block";
                checkcpu.style.display = "inline-block";
                checkram.style.display = "inline-block";
                checkssd.style.display = "inline-block";
                checkos.style.display = "inline-block";
                checkwr.style.display = "inline-block";
            } else {
                checkmodel.checked = false;
                notebooklabel2.style.display = "none";
                notebookselect.style.display = "none";
                notebooklabel.style.display = "none";
                checkcpu.checked = false;
                cpulabel2.style.display = "none";
                cpuselect.style.display = "none";
                cpulabel.style.display = "none";
                checkram.checked = false;
                ramlabel2.style.display = "none";
                ramselect.style.display = "none";
                ramlabel.style.display = "none";
                checkssd.checked = false;
                ssdlabel2.style.display = "none";
                ssdselect.style.display = "none";
                ssdlabel.style.display = "none";
                checkos.checked = false;
                oslabel2.style.display = "none";
                osselect.style.display = "none";
                oslabel.style.display = "none";
                checkwr.checked = false;
                wrlabel2.style.display = "none";
                wrselect.style.display = "none";
                wrlabel.style.display = "none";
                checkmodel.style.display = "none";
                checkcpu.style.display = "none";
                checkram.style.display = "none";
                checkssd.style.display = "none";
                checkos.style.display = "none";
                checkwr.style.display = "none";
            }

            if (selectcomtype == 'desktop') {
                desktoplabel2.style.display = "inline-block";
                desktopselect.style.display = "block";
                desktoplabel.style.display = "block";
                desktopcpulabel2.style.display = "inline-block";
                desktopcpuselect.style.display = "block";
                desktopcpulabel.style.display = "block";
                desktopramlabel2.style.display = "inline-block";
                desktopramselect.style.display = "block";
                desktopramlabel.style.display = "block";
                desktopssdlabel2.style.display = "inline-block";
                desktopssdselect.style.display = "block";
                desktopssdlabel.style.display = "block";
                desktoposlabel2.style.display = "inline-block";
                desktoposselect.style.display = "block";
                desktoposlabel.style.display = "block";
                desktopwrlabel2.style.display = "inline-block";
                desktopwrselect.style.display = "block";
                desktopwrlabel.style.display = "block";
                checkdesktop.style.display = "inline-block";
                checkdesktopcpu.style.display = "inline-block";
                checkdesktopram.style.display = "inline-block";
                checkdesktopssd.style.display = "inline-block";
                checkdesktopos.style.display = "inline-block";
                checkdesktopwr.style.display = "inline-block";
            } else {
                checkdestop.checked = false;
                desktoplabel2.style.display = "none";
                desktopselect.style.display = "none";
                desktoplabel.style.display = "none";
                checkdestopcpu.checked = false;
                desktopcpulabel2.style.display = "none";
                desktopcpuselect.style.display = "none";
                desktopcpulabel.style.display = "none";
                checkdestopram.checked = false;
                desktopramlabel2.style.display = "none";
                desktopramselect.style.display = "none";
                desktopramlabel.style.display = "none";
                checkdestopssd.checked = false;
                desktopssdlabel2.style.display = "none";
                desktopssdselect.style.display = "none";
                desktopssdlabel.style.display = "none";
                checkdestopos.checked = false;
                desktoposlabel2.style.display = "none";
                desktoposselect.style.display = "none";
                desktoposlabel.style.display = "none";
                checkdestopwr.checked = false;
                desktopwrlabel2.style.display = "none";
                desktopwrselect.style.display = "none";
                desktopwrlabel.style.display = "none";
                checkdesktop.style.display = "none";
                checkdesktopcpu.style.display = "none";
                checkdesktopram.style.display = "none";
                checkdesktopssd.style.display = "none";
                checkdesktopos.style.display = "none";
                checkdesktopwr.style.display = "none";

            }

            if (selectcomtype == 'monitor') {
                monitorlabel2.style.display = "inline-block";
                monitorselect.style.display = "block";
                monitorlabel.style.display = "block";
                checkmonitor.style.display = "inline-block";
            } else {
                checkmonitor.checked = false;
                monitorlabel2.style.display = "none";
                monitorselect.style.display = "none";
                monitorlabel.style.display = "none";
                checkmonitor.style.display = "none";
            }

            if (selectcomtype == 'printer') {
                printerlabel2.style.display = "inline-block";
                printerselect.style.display = "block";
                printerlabel.style.display = "block";
                checkprinter.style.display = "inline-block";
            } else {
                checkprinter.checked = false;
                printerlabel2.style.display = "none";
                printerselect.style.display = "none";
                printerlabel.style.display = "none";
                checkprinter.style.display = "none";
            }

            if (selectcomtype == 'hdd') {
                hddlabel2.style.display = "inline-block";
                hddselect.style.display = "block";
                hddlabel.style.display = "block";
                checkhdd.style.display = "inline-block";
            } else {
                checkhdd.checked = false;
                hddlabel2.style.display = "none";
                hddselect.style.display = "none";
                hddlabel.style.display = "none";
                checkhdd.style.display = "none";
            }

            if (checkmodel.checked == true) {
                notebookmodel.style.display = "block";
            } else {
                notebookmodel.style.display = "none";
            }

            if (checkcpu.checked == true) {
                cpumodel.style.display = "block";
            } else {
                cpumodel.style.display = "none";
            }

            if (checkram.checked == true) {
                rammodel.style.display = "block";
            } else {
                rammodel.style.display = "none";
            }

            if (checkssd.checked == true) {
                ssdmodel.style.display = "block";
            } else {
                ssdmodel.style.display = "none";
            }

            if (checkos.checked == true) {
                osmodel.style.display = "block";
            } else {
                osmodel.style.display = "none";
            }

            if (checkwr.checked == true) {
                wrmodel.style.display = "block";
            } else {
                wrmodel.style.display = "none";
            }

            if (checkdestop.checked == true) {
                desktopmodel.style.display = "block";
            } else {
                desktopmodel.style.display = "none";
            }

            if (checkdestopcpu.checked == true) {
                desktopcpumodel.style.display = "block";
            } else {
                desktopcpumodel.style.display = "none";
            }

            if (checkdestopram.checked == true) {
                desktoprammodel.style.display = "block";
            } else {
                desktoprammodel.style.display = "none";
            }

            if (checkdestopssd.checked == true) {
                desktopssdmodel.style.display = "block";
            } else {
                desktopssdmodel.style.display = "none";
            }

            if (checkdestopos.checked == true) {
                desktoposmodel.style.display = "block";
            } else {
                desktoposmodel.style.display = "none";
            }

            if (checkdestopwr.checked == true) {
                desktopwrmodel.style.display = "block";
            } else {
                desktopwrmodel.style.display = "none";
            }

            if (checkmonitor.checked == true) {
                monitormodel.style.display = "block";
            } else {
                monitormodel.style.display = "none";
            }

            if (checkprinter.checked == true) {
                printermodel.style.display = "block";
            } else {
                printermodel.style.display = "none";
            }

            if (checkhdd.checked == true) {
                hddmodel.style.display = "block";
            } else {
                hddmodel.style.display = "none";
            }
        }
    </script>

</body>

</html>