<?php

include_once "db.php";

if (isset($_POST['newcon'])) {
    $contractno = $_POST['contractno'];
    $condesc = $_POST['condesc'];
    $rental = $_POST['rental'];
    $stdate = $_POST['stdate'];
    $eddate = $_POST['eddate'];
    $company = $_POST['company'];
    $vendor = $_POST['vendor'];

    mysqli_query($conn, "INSERT INTO `contractmaster`(`contractno`, `condesc`, `strdate`, `enddate`, `rental`, `company`, `vendor`) VALUES ('$contractno','$condesc','$stdate','$eddate','$rental','$company','$vendor')");
?>
    <script>
        alert("เพิ่มสำเร็จ");
        window.location.href = 'option.php?contract_master=1';
    </script>
    <?php
}

if (isset($_POST['newserial'])) {
    $serialno = $_POST['serialno'];
    $contractno = $_POST['contractno'];
    $makersel = $_POST['makersel'];
    $maker = $_POST['maker'];
    $comtype = $_POST['selectcomtype'];
    $rental = $_POST['rental'];
    $accessory = $_POST['accessory'];
    $eddate = $_POST['eddate'];
    $company = $_POST['company'];

    $notebookmodel = $_POST['notebookmodel'];
    $cpumodel = $_POST['cpumodel'];
    $rammodel = $_POST['rammodel'];
    $ssdmodel = $_POST['ssdmodel'];
    $osmodel = $_POST['osmodel'];
    $wrmodel = $_POST['wrmodel'];

    $desktopmodel = $_POST['desktopmodel'];
    $desktopcpumodel = $_POST['desktopcpumodel'];
    $desktoprammodel = $_POST['desktoprammodel'];
    $desktopssdmodel = $_POST['desktopssdmodel'];
    $desktoposmodel = $_POST['desktoposmodel'];
    $desktopwrmodel = $_POST['desktopwrmodel'];

    $monitormodel = $_POST['monitormodel'];

    $printermodel = $_POST['printermodel'];

    $hddmodel = $_POST['hddmodel'];

    $_SESSION['notebookmodel'] = $notebookmodel;
    $_SESSION['cpumodel'] = $cpumodel;
    $_SESSION['rammodel'] = $rammodel;
    $_SESSION['ssdmodel'] = $ssdmodel;
    $_SESSION['osmodel'] = $osmodel;
    $_SESSION['wrmodel'] = $wrmodel;
    $_SESSION['serialno'] = $serialno;
    $_SESSION['maker'] = $maker;
    $_SESSION['rental'] = $rental;
    $_SESSION['accessory'] = $accessory;
    $_SESSION['desktopmodel'] = $desktopmodel;
    $_SESSION['desktopcpumodel'] = $desktopcpumodel;
    $_SESSION['desktoprammodel'] = $desktoprammodel;
    $_SESSION['desktopssdmodel'] = $desktopssdmodel;
    $_SESSION['desktoposmodel'] = $desktoposmodel;
    $_SESSION['desktopwrmodel'] = $desktopwrmodel;
    $_SESSION['monitormodel'] = $monitormodel;
    $_SESSION['printermodel'] = $printermodel;
    $_SESSION['hddmodel'] = $hddmodel;


    $x = mysqli_query($conn, "SELECT * FROM `serialmaster` WHERE `serialno` = '$serialno' AND `contractno` = '$contractno'");
    $check = $x->fetch_array();
    if (isset($check)) {
    ?>
        <script>
            alert("เลขSerialซ้ำ");
            history.back();
        </script>
    <?php
    } elseif (empty($contractno)) {
    ?>
        <script>
            alert("ยังไม่ได้เลือก ContractNo");
            history.back();
        </script>
    <?php
    } elseif (empty($makersel) && empty($maker)) {
    ?>
        <script>
            alert("ยังไม่ได้เลือก Maker");
            history.back();
        </script>
    <?php
    } elseif (empty($comtype)) {
    ?>
        <script>
            alert("ยังไม่ได้เลือก Com Type");
            history.back();
        </script>
        <?php
    } else {
        $typenotebook = $_POST['typenotebook'];
        $typecpu = $_POST['typecpu'];
        $typeram = $_POST['typeram'];
        $typessd = $_POST['typessd'];
        $typeos = $_POST['typeos'];
        $typewr = $_POST['typewr'];
        if ($comtype == 'Notebook') {
            $typenotebook = $_POST['typenotebook'];

            if (empty($_POST['notebookselect']) && empty($_POST['notebookmodel'])) {
        ?>
                <script>
                    alert("โปรดเลือกModel หรือใส่Modelใหม่");
                    history.back();
                </script>
            <?php
            } elseif (empty($_POST['notebookmodel'])) {
                $notebookmodel = $_POST['notebookselect'];
            } else {

                $notebookmodel = $_POST['notebookmodel'];
                mysqli_query($conn, "INSERT INTO `commodel`(`type`, `commodel`) VALUES ('$typenotebook', '$notebookmodel')");
            }

            if (empty($_POST['cpuselect']) && empty($_POST['cpumodel'])) {
            ?>
                <script>
                    alert("โปรดเลือกCPU หรือใส่CPUใหม่");
                    history.back();
                </script>
            <?php
            } elseif (empty($_POST['cpumodel'])) {
                $cpumodel = $_POST['cpuselect'];
            } else {

                $cpumodel = $_POST['cpumodel'];
                mysqli_query($conn, "INSERT INTO `commodel`(`type`, `spec`, `commodel`) VALUES ('$typenotebook','$typecpu','$cpumodel')");
            }

            if (empty($_POST['ramselect']) && empty($_POST['rammodel'])) {
            ?>
                <script>
                    alert("โปรดเลือกRAM หรือใส่RAMใหม่");
                    history.back();
                </script>
            <?php
            } elseif (empty($_POST['rammodel'])) {
                $rammodel = $_POST['ramselect'];
            } else {

                $rammodel = $_POST['rammodel'];
                mysqli_query($conn, "INSERT INTO `commodel`(`type`, `spec`, `commodel`) VALUES ('$typenotebook','$typeram','$rammodel')");
            }

            if (empty($_POST['ssdselect']) && empty($_POST['ssdmodel'])) {
            ?>
                <script>
                    alert("โปรดเลือกSSD หรือใส่SSDใหม่");
                    history.back();
                </script>
            <?php
            } elseif (empty($_POST['ssdmodel'])) {
                $ssdmodel = $_POST['ssdselect'];
            } else {

                $ssdmodel = $_POST['ssdmodel'];
                mysqli_query($conn, "INSERT INTO `commodel`(`type`, `spec`, `commodel`) VALUES ('$typenotebook','$typessd','$ssdmodel')");
            }

            if (empty($_POST['osselect']) && empty($_POST['osmodel'])) {
            ?>
                <script>
                    alert("โปรดเลือกOperating System หรือใส่Operating Systemใหม่");
                    history.back();
                </script>
            <?php
            } elseif (empty($_POST['osmodel'])) {
                $osmodel = $_POST['osselect'];
            } else {

                $osmodel = $_POST['osmodel'];
                mysqli_query($conn, "INSERT INTO `commodel`(`type`, `spec`, `commodel`) VALUES ('$typenotebook','$typeos','$osmodel')");
            }

            if (empty($_POST['wrselect']) && empty($_POST['wrmodel'])) {
            ?>
                <script>
                    alert("โปรดเลือกWarranty หรือใส่Warrantyใหม่");
                    history.back();
                </script>
            <?php
            } elseif (empty($_POST['wrmodel'])) {
                $wrmodel = $_POST['wrselect'];
            } else {

                $wrmodel = $_POST['wrmodel'];
                mysqli_query($conn, "INSERT INTO `commodel`(`type`, `spec`, `commodel`) VALUES ('$typenotebook','$typewr','$wrmodel')");
            }
            $commodel = $notebookmodel . ' ' . $cpumodel . ' ' . $rammodel . ' ' . $ssdmodel . ' ' . $osmodel . ' ' . $wrmodel;
        }

        $typedesktop = $_POST['typedesktop'];

        if ($comtype == 'Desktop') {
            if (empty($_POST['desktopselect']) && empty($_POST['desktopmodel'])) {
            ?>
                <script>
                    alert("โปรดเลือกModel หรือใส่Modelใหม่");
                    history.back();
                </script>
            <?php
            } elseif (empty($_POST['desktopmodel'])) {
                $desktopmodel = $_POST['desktopselect'];
            } else {

                $desktopmodel = $_POST['desktopmodel'];
                mysqli_query($conn, "INSERT INTO `commodel`(`type`, `commodel`) VALUES ('$typedesktop', '$desktopmodel')");
            }

            if (empty($_POST['desktopcpuselect']) && empty($_POST['desktopcpumodel'])) {
            ?>
                <script>
                    alert("โปรดเลือกCPU หรือใส่CPUใหม่");
                    history.back();
                </script>
            <?php
            } elseif (empty($_POST['desktopcpumodel'])) {
                $cpumodel = $_POST['desktopcpuselect'];
            } else {
                $cpumodel = $_POST['desktopcpumodel'];
                mysqli_query($conn, "INSERT INTO `commodel`(`type`, `spec`, `commodel`) VALUES ('$typedesktop','$typecpu','$cpumodel')");
            }

            if (empty($_POST['desktopramselect']) && empty($_POST['desktoprammodel'])) {
            ?>
                <script>
                    alert("โปรดเลือกRAM หรือใส่RAMใหม่");
                    history.back();
                </script>
            <?php
            } elseif (empty($_POST['desktoprammodel'])) {
                $rammodel = $_POST['desktopramselect'];
            } else {

                $rammodel = $_POST['desktoprammodel'];
                mysqli_query($conn, "INSERT INTO `commodel`(`type`, `spec`, `commodel`) VALUES ('$typedesktop','$typeram','$rammodel')");
            }

            if (empty($_POST['desktopssdselect']) && empty($_POST['desktopssdmodel'])) {
            ?>
                <script>
                    alert("โปรดเลือกSSD หรือใส่SSDใหม่");
                    history.back();
                </script>
            <?php
            } elseif (empty($_POST['desktopssdmodel'])) {
                $ssdmodel = $_POST['desktopssdselect'];
            } else {

                $ssdmodel = $_POST['desktopssdmodel'];
                mysqli_query($conn, "INSERT INTO `commodel`(`type`, `spec`, `commodel`) VALUES ('$typedesktop','$typessd','$ssdmodel')");
            }

            if (empty($_POST['desktoposselect']) && empty($_POST['desktoposmodel'])) {
            ?>
                <script>
                    alert("โปรดเลือกOperating System หรือใส่Operating Systemใหม่");
                    history.back();
                </script>
            <?php
            } elseif (empty($_POST['desktoposmodel'])) {
                $osmodel = $_POST['desktoposselect'];
            } else {

                $osmodel = $_POST['desktoposmodel'];
                mysqli_query($conn, "INSERT INTO `commodel`(`type`, `spec`, `commodel`) VALUES ('$typedesktop','$typeos','$osmodel')");
            }

            if (empty($_POST['desktopwrselect']) && empty($_POST['desktopwrmodel'])) {
            ?>
                <script>
                    alert("โปรดเลือกWarranty หรือใส่Warrantyใหม่");
                    history.back();
                </script>
            <?php
            } elseif (empty($_POST['desktopwrmodel'])) {
                $wrmodel = $_POST['desktopwrselect'];
            } else {

                $wrmodel = $_POST['desktopwrmodel'];
                mysqli_query($conn, "INSERT INTO `commodel`(`type`, `spec`, `commodel`) VALUES ('$typedesktop','$typewr','$wrmodel')");
            }
            $commodel = $desktopmodel . ' ' . $cpumodel . ' ' . $rammodel . ' ' . $ssdmodel . ' ' . $osmodel . ' ' . $wrmodel;
        }

        $typemonitor = $_POST['monitor'];
        if ($comtype == 'monitor') {
            if (empty($_POST['monitorselect']) && empty($_POST['monitormodel'])) {
            ?>
                <script>
                    alert("โปรดเลือกMonitor หรือใส่Monitorใหม่");
                    history.back();
                </script>
            <?php
            } elseif (empty($_POST['monitormodel'])) {
                $monitormodel = $_POST['monitorselect'];
            } else {

                $monitormodel = $_POST['monitormodel'];
                mysqli_query($conn, "INSERT INTO `commodel`(`type`, `commodel`) VALUES ('$typemonitor','$monitormodel')");
            }
            $commodel = $monitormodel;
        }

        $typeprinter = $_POST['printer'];

        if ($comtype == 'printer') {
            if (empty($_POST['printerselect']) && empty($_POST['printermodel'])) {
            ?>
                <script>
                    alert("โปรดเลือกPrinter หรือเพิ่มPrinterใหม่");
                    history.back();
                </script>
            <?php
            } elseif (empty($_POST['printermodel'])) {
                $printermodel = $_POST['printerselect'];
            } else {

                $printermodel = $_POST['printermodel'];
                mysqli_query($conn, "INSERT INTO `commodel`(`type`, `commodel`) VALUES ('$typeprinter','$printermodel')");
            }
            $commodel = $printermodel;
        }

        $typehdd = $_POST['hdd'];

        if ($comtype == 'hdd') {
            if (empty($_POST['hddselect']) && empty($_POST['hddmodel'])) {
            ?>
                <script>
                    alert("โปรดเลือกHDD หรือเพิ่มHDDใหม่");
                    history.back();
                </script>
            <?php
            } elseif (empty($_POST['hddmodel'])) {
                $hddmodel = $_POST['hddselect'];
            } else {

                $hddmodel = $_POST['hddmodel'];
                mysqli_query($conn, "INSERT INTO `commodel`(`type`, `commodel`) VALUES ('$typehdd','$hddmodel')");
            }
            $commodel = $hddmodel;
        }

        if (empty($rental)) {
            ?>
            <script>
                alert("ยังไม่ได้ใส่Rental");
                history.back();
            </script>
            <?php
        } else {
            if (empty($accessory)) {
            ?>
                <script>
                    alert("ยังไม่ได้ใส่Accessory");
                    history.back();
                </script>
                <?php
            } else {
                if (empty($eddate)) {
                ?>
                    <script>
                        alert("ยังไม่ได้ใส่End Date");
                        history.back();
                    </script>
                    <?php
                } else {
                    if (empty($company)) {
                    ?>
                        <script>
                            alert("ยังไม่ได้ใส่Company");
                            history.back();
                        </script>
                    <?php
                    } else {
                        if (empty($maker)) {
                            $maker = $makersel;
                        }

                        date_default_timezone_set('Asia/Bangkok');
                        $xyear = mysqli_query($conn, "SELECT * FROM `year` WHERE `company` = '$company'");
                        $chyear = $xyear->fetch_array();
                        $year = date("y") + 43;

                        if ($year == $chyear['year'] && $company == $chyear['company']) {
                            $xnum = $chyear['number'] + 1;
                            $num = sprintf("%03d", $xnum);
                            $accesscode = $company . "-" . $chyear['year'] . $num;
                            mysqli_query($conn, "UPDATE `year` SET `number`='$xnum' WHERE `company` = '$company'");
                        } elseif ($year != $chyear['year'] && $company == $chyear['company']) {
                            $xnum = 1;
                            $num = sprintf("%03d", $xnum);
                            $accesscode = $company . "-" . $year . $num;
                            mysqli_query($conn, "UPDATE `year` SET `year`='$year',`number`='$xnum' WHERE `company` = '$company'");
                        } else {
                            $xnum = 1;
                            $num = sprintf("%03d", $xnum);
                            $accesscode = $company . "-" . $year . $num;
                            mysqli_query($conn, "INSERT INTO `year`(`company`, `year`, `number`) VALUES ('$company','$year','$num')");
                        }

                        mysqli_query($conn, "INSERT INTO `serialmaster`(`serialno`, `contractno`, `maker`, `comtype`, `commodel`, `rental`, `accessory`, `accesscode`,`enddate`, `company`) VALUES ('$serialno','$contractno','$maker','$comtype','$commodel','$rental','$accessory', '$accesscode','$eddate','$company')");

                        $checkmaker = mysqli_query($conn, "SELECT * FROM `maker` WHERE `maker` = '$maker'");
                        $chk = $checkmaker->fetch_array();
                        if (isset($chk)) {
                        } else {
                            mysqli_query($conn, "INSERT INTO `maker`(`maker`) VALUES ('$maker')");
                        }

                        unset(
                            $_SESSION['serialno'],
                            $_SESSION['maker'],
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
                        <script>
                            alert("เพิ่มสำเร็จ");
                            window.location.href = 'option.php?serial_master=1';
                        </script>
    <?php
                    }
                }
            }
        }
    }
}

if (isset($_POST['updateserial'])) {
    $id = $_POST['id'];
    $serialno = $_POST['serialno'];
    $contractno = $_POST['contractno'];
    $username = $_POST['username'];
    $page = $_POST['page'];
    $accesscode = $_POST['accesscode'];

    mysqli_query($conn, "UPDATE `serialmaster` SET `username`='$username' WHERE `id` = '$id' and `serialno` = '$serialno' AND `contractno` = '$contractno' AND `accesscode` = '$accesscode'");
    ?>
    <script>
        alert("เพิ่มสำเร็จ");
        window.location.href = 'comleasing?Page=<?php echo $page ?>';
    </script>
<?php
}

if (isset($_POST['clearuser'])) {
    $serialno = $_POST['serialno'];
    $contractno = $_POST['contractno'];
    $page = $_POST['page'];

    mysqli_query($conn, "UPDATE `serialmaster` SET `username`='' WHERE `serialno` = '$serialno' AND `contractno` = '$contractno' ");
?>
    <script>
        alert("ลบสำเร็จ");
        window.location.href = 'comleasing?Page=<?php echo $page ?>';
    </script>
<?php
}
