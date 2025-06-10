<?php
include_once "db.php";
require_once __DIR__ . '/vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/fonts',
    ]),
    'fontdata' => $fontData + [
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' => 'THSarabunNew Bold.ttf'
        ]
    ],
]);

// ob_start();
$test = $_POST['test'];
$x = '';
$pst = ($x == 'pst') ? '<img width="15" height="15" src="icon\check.gif">' : '<img width="17" height="17" src="icon\uncheck.gif">';
$biggas = ($x == 'biggas') ? '<img width="15" height="15" src="icon\check.gif">' : '<img width="17" height="17" src="icon\uncheck.gif">';
$tpn = ($x == 'tpn') ? '<img width="15" height="15" src="icon\check.gif">' : '<img width="17" height="17" src="icon\uncheck.gif">';
$bgtlo = ($x == 'bgtlo') ? '<img width="15" height="15" src="icon\check.gif">' : '<img width="17" height="17" src="icon\uncheck.gif">';
$jn = ($x == 'jn') ? '<img width="15" height="15" src="icon\check.gif">' : '<img width="17" height="17" src="icon\uncheck.gif">';
$oth = ($x == 'oth') ? '<img width="15" height="15" src="icon\check.gif">' : '<img width="17" height="17" src="icon\uncheck.gif">';

$y = '';
$a = ($y == 'a') ? '<img width="15" height="15" src="icon\check.gif">' : '<img width="17" height="17" src="icon\uncheck.gif">';
$b = ($y == 'b') ? '<img width="15" height="15" src="icon\check.gif">' : '<img width="17" height="17" src="icon\uncheck.gif">';
$c = ($y == 'c') ? '<img width="15" height="15" src="icon\check.gif">' : '<img width="17" height="17" src="icon\uncheck.gif">';
$d = ($y == 'd') ? '<img width="15" height="15" src="icon\check.gif">' : '<img width="17" height="17" src="icon\uncheck.gif">';
$e = ($y == 'e') ? '<img width="15" height="15" src="icon\check.gif">' : '<img width="17" height="17" src="icon\uncheck.gif">';
$f = ($y == 'f') ? '<img width="15" height="15" src="icon\check.gif">' : '<img width="17" height="17" src="icon\uncheck.gif">';
$space = str_repeat('&nbsp;', 7);
$cspace = str_repeat('&nbsp;', 2);
$un = '<img width="15" height="15" src="icon\uncheck.gif">';
$hardware = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
$id = $test;
$name = $test;
$tel = $test;
$depart = $test;
$posi = $test;
$text = $test;
$lname = $test;
$posi = $test;
$com = $test;
$st = $test;
$x = wordwrap($hardware, 139, "<br>\n", TRUE);
$y1 = wordwrap($hardware, 98, "<br>\n", TRUE);
$content = "<style>
        body {
            font-family: 'Sarabun';
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        // td,
        // th {
        //     border: 1px solid black;
        //     text-align:center;
        // }

        // tr:nth-child(odd) {
        //     background-color: #dddddd;
        // }
    </style>
    
    <table style='width:100%'>
    <tbody> 
    <tr>
            <th colspan='4' style='font-size: 24px;text-align:center;background-color: #dddddd;border: 1px solid black;'>MIS REQUEST</th>
        </tr>
        <tr>
            <td colspan='4' style='text-align:right;border: 1px solid black;'>Request No.________________ $space</td>
        </tr>
        <tr>
            <td colspan='1' style='text-align:center;border: 1px solid black;width: 180px'>บริษัท</td>
            <td colspan='3' style='text-align:center;border: 1px solid black;'>$pst $cspace PST $space $biggas $cspace BIGGAS $space $tpn $cspace TPN $space $bgtlo $cspace BGTLO $space $jn $cspace JN $space $oth $cspace Oth.________</td>
        </tr>
        
        <tr> 
            <td rowspan='2' style='text-align:center;border: 1px solid black;'>ผู้ขอรับบริการ</td>
            <td width='18%'>รหัสพนักงาน <span>$id</span> </td>
            <td >ชื่อ-นามสกุล <span>$name</span></td>
            <td style='border-right: 1px solid black;'>โทร <span>$tel</span></td>
            
        </tr>
        <tr>
            <td style='border-bottom: 1px solid black;'>
            รหัส/ชื่อแผนก <span>$depart</span>
            </td>
            <td colspan='2' style='border-right: 1px solid black;border-bottom: 1px solid black;'>
            ตำแหน่ง <span>$posi</span>
            </td>
        </tr>
        <tr>
            <td style='text-align:center;border: 1px solid black;'>ประเภทการร้องขอ</td>
            <td colspan='3' style='text-align:center;border: 1px solid black;'>$a $cspace สั่งซื้อ $space $b $cspace เพิ่ม $space $c $cspace สร้างใหม่ $space $d $cspace แก้ไข $space $e $cspace ปรับปรุง $space $f $cspace เปลี่ยนแปลง</td>
        </tr>
        <tr>
            <td colspan='4' style='font-size: 16px;background-color: #dddddd;border-left: 1px solid black;border-right: 1px solid black;'>$un อุปกรณ์คอมพิวเตอร์ ( Hardware )  โปรดระบุรายละเอียด เช่น คอมพิวเตอร์ ,  Printer ,  จอ Monitor</td>
        </tr>
        <tr>
            <td colspan='4' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
        </tr>
        <tr>
            <td colspan='4' style='text-align:left;border-left: 1px solid black;border-right: 1px solid black;'><span>$x</span></td>
        </tr>
        <tr>
            <td colspan='4' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
        </tr>
        <tr>
            <td colspan='4' style='text-align:center;font-size: 16px;background-color: #dddddd;border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;'>$un โปรแกรมสำเร็จรูป ( Software )  โปรดระบุรายละเอียด เช่น Windows ,  MS Office , Outlook, Formular, Sage, SAP</td>
        </tr>
        <tr>
            <td colspan='4' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
        </tr>
        <tr>
            <td colspan='4' style='text-align:left;border-left: 1px solid black;border-right: 1px solid black;'><span>$x</span></td>
        </tr>
        <tr>
            <td colspan='4' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
        </tr>
        <tr>
            <td colspan='4' style='font-size: 16px;background-color: #dddddd;border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;'>$un โปรแกรมพัฒนาขึ้นเอง ( Application )  โปรดระบุรายละเอียด เช่น  Report บัญชี</td>
        </tr>
        <tr>
            <td colspan='4' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
        </tr>
        <tr>
            <td colspan='4' style='text-align:left;border-left: 1px solid black;border-right: 1px solid black;'><span>$x</span></td>
        </tr>
        <tr>
            <td colspan='4' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
        </tr>
        <tr>
            <td colspan='4' style='font-size: 16px;background-color: #dddddd;border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;'>$un Email</td>
        </tr>
        <tr>
            <td colspan='4' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
        </tr>
        <tr>
            <td colspan='4' style='text-align:left;border-left: 1px solid black;border-right: 1px solid black;'><span>$x</span></td>
        </tr>
        <tr>
            <td colspan='4' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
        </tr>
        <tr>
            <td colspan='4' style='font-size: 16px;background-color: #dddddd;border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;'>$un Network Login User  ( Network , VPN ) ,Share Drive</td>
        </tr>
        <tr>
            <td colspan='4' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
        </tr>
        <tr>
            <td colspan='4' style='text-align:left;border-left: 1px solid black;border-right: 1px solid black;'><span>$x</span></td>
        </tr>
        <tr>
            <td colspan='4' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
        </tr>
        <tr>
            <td colspan='4' style='font-size: 16px;background-color: #dddddd;border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;'>$un อื่นๆ โปรดระบุรายละเอียด</td>
        </tr>
        <tr>
            <td colspan='4' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
        </tr>
        <tr>
            <td colspan='4' style='text-align:left;border-left: 1px solid black;border-right: 1px solid black;'><span>$x</span></td>
        </tr>
        <tr>
            <td colspan='4' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
        </tr>
        <tr>
            <td style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;'>ผู้ขอรับบริการ</td>
            <td style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;width: 178px'>ผู้จัดการแผนก / ฝ่าย ต้นสังกัด</td>
            <td style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;'>ผู้จัดการแผนก / ฝ่าย  MIS</td>
            <td style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;'>ผู้ดำเนินการ</td>
        </tr>
        <tr>
            <td height='20px' style='border-left: 1px solid black;border-right: 1px solid black;'></td>
            <td height='20px' style='border-left: 1px solid black;border-right: 1px solid black;'></td>
            <td height='20px' style='border-left: 1px solid black;border-right: 1px solid black;'></td>
            <td height='20px' style='border-left: 1px solid black;border-right: 1px solid black;'></td>
        </tr>
        <tr>
            <td style='border-left: 1px solid black;border-right: 1px solid black;'>ลงชื่อ___________________________</td>
            <td style='border-left: 1px solid black;border-right: 1px solid black;'>ลงชื่อ___________________________</td>
            <td style='border-left: 1px solid black;border-right: 1px solid black;'>ลงชื่อ___________________________</td>
            <td style='border-left: 1px solid black;border-right: 1px solid black;'>ลงชื่อ___________________________</td>
        </tr>
        <tr>
            <td style='border-left: 1px solid black;border-right: 1px solid black;'>วันที่____________________________</td>
            <td style='border-left: 1px solid black;border-right: 1px solid black;'>วันที่____________________________</td>
            <td style='border-left: 1px solid black;border-right: 1px solid black;'>วันที่____________________________</td>
            <td style='border-left: 1px solid black;border-right: 1px solid black;'>วันที่____________________________</td>
        </tr>
        <tr>
            <td colspan='4' style='font-size: 16px;background-color: #dddddd;border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;'>รายละเอียดการดำเนินการของ MIS     ( เฉพาะเจ้าหน้าที่แผนก MIS )</td>
        </tr>
        <tr>
            <td colspan='4' style='border-left: 1px solid black;border-right: 1px solid black;'><br></td>
        </tr>
        <tr>
            <td colspan='4' style='border-left: 1px solid black;border-right: 1px solid black;'><span>$y1</span></td>
        </tr>
        <tr>
            <td colspan='4' style='border-left: 1px solid black;border-right: 1px solid black;'><br></td>
        </tr>
        <tr>
            <td colspan='4' style='border-left: 1px solid black;border-right: 1px solid black;'></td>
        </tr>
        <tr>
            <td colspan='4' style='border-left: 1px solid black;border-right: 1px solid black;'><br></td>
        </tr>
        <tr>
            <td colspan='3' style='border-left: 1px solid black;border-right: 1px solid black;'></td>
            <td style='text-align:center;border-top: 1px solid black;border-right: 1px solid black;'><br></td>
        </tr>
        <tr>
            <td colspan='3' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
            <td style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'>ผู้ขอรับบริการ ( รับมอบงาน )</td>
        </tr>
        <tr>
            <td colspan='3' style='border-left: 1px solid black;'></td>
            <td style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'></td>
        </tr>
        <tr>
            <td colspan='3' style='border-left: 1px solid black;'></td>
            <td style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
        </tr>
        <tr>
            <td colspan='3' style='border-left: 1px solid black;'></td>
            <td style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'>ลงชื่อ___________________________</td>
        </tr>
        <tr>
            <td colspan='3' style='border-left: 1px solid black;'></td>
            <td style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
        </tr>
        <tr>
            <td colspan='3' style='border-left: 1px solid black;'></td>
            <td style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'>วันที่____________________________</td>
        </tr>
        <tr>
            <td colspan='3' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;'><br></td>
            <td style='text-align:center;border-right: 1px solid black;border-bottom: 1px solid black;'></td>
        </tr>
    </tbody>
       
    </table>";
$mpdf->WriteHTML($content); // ทำการสร้าง PDF ไฟล์
$x = $mpdf->Output('test.pdf', 's');

$mpdf1 = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/fonts',
    ]),
    'fontdata' => $fontData + [
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' => 'THSarabunNew Bold.ttf'
        ]
    ],
]);
date_default_timezone_set("Asia/Bangkok");
$date = date('Y') + 543;
$date = substr($date, 0, 2);
$pic1 = '<img src="icon/Picture2.gif" width="150" height="90">';
$pic2 = '<img src="icon/Picture2.gif" width="90" height="60">';
$ch = '<img src="icon/check.gif" width="15" height="15">';
$spacex = str_repeat('&nbsp;', 50);
$content1 = "<style>
                body {
                    font-family: 'Sarabun';
                }
                table {
                    margin: auto;
                }
                table, th, td {
                    border-collapse: collapse;
                }
                tr{
                    width: 100%;
                    display: table;
                    box-sizing: border-box;
                }
                tbody {
                    width: 100%;
                    display: block;
                }
            </style>
            <table style='width:100%'>
                <tbody>
                    <tr>
                        <th style='background-color: #4472c4;border-right: 1px solid #4472c4;'>$pic1</th>
                        <th colspan='4' style='text-align:center;background-color: #4472c4;'>New Employee Starter Kit , Admin Request</th>
                        <th  style='border: 1px solid black;'><p>For Admin</p><br><p>No......................../$date</p></th>
                    </tr>
                    <tr>
                        <th colspan='6' style='text-align:center;background-color: #F8CBAD;'>ข้อมูลส่วนตัว</th>
                    </tr>
                    <tr>
                        <th>ชื่อ</th>
                        <th><span>$name</span></th>
                        <th>นามสกุล</th>
                        <th><span>$lname</span></th>
                    </tr>
                    <tr>
                        <th>ตำแหน่ง</th>
                        <th><span>$posi</span></th>
                    </tr>
                    <tr>
                        <th>บริษัท</th>
                        <th><span>$com</span></th>
                        <th>วันเริ่มงาน</th>
                        <th><span>$st</span></th>
                    </tr>
                    <tr>
                        <th colspan='6' style='text-align:center;background-color: #F8CBAD;'>ที่จอดรถ</th>
                    </tr>
                    <tr>
                        <th>ที่จอดรถ</th>
                        <th width='170px'>$ch</th>
                        <th>ที่จอดรถอาคารพีเอสที</th>
                        <th width='140px'>$ch</th>
                        <th>ที่จอดรถเช่า</th>
                    </tr>
                    <tr>
                        <th colspan='6' style='background-color: #D9E1F2;text-align:left;'>การปฏิบัติ Admin $spacex ดำเนินการเรียบร้อย เมื่อ</th>
                    </tr>
                    <tr>
                        <th colspan='6' style='text-align:center;background-color: #F8CBAD;'>นามบัตร</th>
                    </tr>
                    <tr>
                        <th>จำนวน</th>
                        <th>$ch</th>
                        <th>100ใบ</th>
                    </tr>
                    <tr> 
                        <th style='background-color: #9BC2E6;border-right: 1px solid #9BC2E6;'>$pic2</th>
                        <th colspan='5' style='text-align:center;background-color: #9BC2E6;'>รายละเอียดทำนามบัตร</th>
                    </tr>
                    <tr>
                        <th>บริษัท</th>
                    </tr>
                    <tr>
                        <th><br></th>
                    </tr>
                    <tr>
                        <th>ชื่อ (ภาษาไทย)</th>
                        <th></th>
                        <th>นามสกุล (ภาษาไทย)</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>ชื่อ (ภาษาอังกฤษ)</th>
                        <th></th>
                        <th>นามสกุล (ภาษาอังกฤษ)</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>ตำแหน่ง (ภาษาอังกฤษ)</th>
                        <th></th>
                        <th>เบอร์ต่อ</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>เบอร์โทรศัพท์มือถือ</th>
                        <th></th>
                        <th>อีเมล์</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>จำนวน</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th colspan='6' style='background-color: #D9E1F2;text-align:left;'>การปฏิบัติ Admin $spacex ดำเนินการเรียบร้อย เมื่อ</th>
                    </tr>
                    <tr>
                        <th colspan='6' style='text-align:center;background-color: #F8CBAD;'>Fleet card</th>
                    </tr>
                    <tr>
                        <th>ยี่ห้อรถ/รุ่นรถ</th>
                        <th></th>
                        <th>ทะเบียนรถ</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>เชื้อเพลิง</th>
                        <th></th>
                        <th>วงเงิน</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>เอกสารประกอบ</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th colspan='6' style='background-color: #D9E1F2;text-align:left;'>การปฏิบัติ Admin $spacex ดำเนินการเรียบร้อย เมื่อ</th>
                    </tr>
                    <tr>
                        <th colspan='6' style='text-align:center;background-color: #F8CBAD;'>เบอร์โทรศัพท์มือถือ</th>
                    </tr>
                    <tr>
                        <th>$ch</th>
                        <th><span>เดือนละ 449 บาท โทรฟรีทุกเครือข่ายไม่จำกัด  เน็ท 10 GB</span></th>
                    </tr>
                    <tr>
                        <th>$ch</th>
                        <th><span>เดือนละ 599  บาท  โทรฟรีทุกเครือข่ายไม่จำกัด เน็ท 20 GB</span></th>
                    </tr>
                    <tr>
                        <th>$ch</th>
                        <th><span>เดือนละ 799 บาท  โทรฟรีทุกเครือข่ายไม่จำกัด เน็ท 40 GB</span></th>
                    </tr>
                    <tr>
                        <th>$ch</th>
                        <th><span>เดือนละ  999 บาท โทรฟรีทุกเครือข่ายไม่จำกัด  เน็ท 65 GB</span></th>
                    </tr>
                    <tr>
                        <th colspan='6' style='background-color: #D9E1F2;text-align:left;'>การปฏิบัติ Admin $spacex ดำเนินการเรียบร้อย เมื่อ</th>
                    </tr>
                    <tr>
                        <th colspan='6' style='text-align:center;background-color: #F8CBAD;'>อุปกรณ์สำนักงาน</th>
                    </tr>
                    <tr>
                        <th>$ch</th>
                        <th>อุปกรณ์สำนักงาน</th>
                    </tr>
                    <tr>
                        <th colspan='6' style='background-color: #D9E1F2;text-align:left;'>การปฏิบัติ Admin $spacex ดำเนินการเรียบร้อย เมื่อ</th>
                    </tr>
                    <tr>
                        <th colspan='6' style='text-align:center;background-color: #F8CBAD;'>อื่นๆ</th>
                    </tr>
                    <tr>
                        <th>1.</th>
                        <th>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</th>
                        <th >4.</th>
                        <th>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</th>
                    </tr>
                    <tr>
                        <th>2.</th>
                        <th></th>
                        <th>5.</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>3.</th>
                        <th></th>
                        <th>6.</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th colspan='6' style='background-color: #D9E1F2;text-align:left;'>การปฏิบัติ Admin $spacex ดำเนินการเรียบร้อย เมื่อ</th>
                    </tr>
                </tbody>
            </table>";

$mpdf1->WriteHTML($content1);
$y = $mpdf1->Output('test1.pdf', 's');

?>

<!DOCTYPE html>
<html>

<head>
    <title>PDF</title>
    <meta http-equiv="Content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">

</head>

<body>


</body>

</html>

<?php
//$html = ob_get_contents(); // ทำการเก็บค่า HTML จากคำสั่ง ob_start()
// ให้ทำการบันทึกโค้ด HTML เป็น PDF โดยบันทึกเป็นไฟล์ชื่อ MyPDF.pdf

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Exception class. */

require 'C:\xampp\htdocs\profile\PHPMailer\src\Exception.php';

/* The main PHPMailer class. */
require 'C:\xampp\htdocs\profile\PHPMailer\src\PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
require 'C:\xampp\htdocs\profile\PHPMailer\src\SMTP.php';

//require 'C:\xampp\htdocs\profile\PHPMailer\src\POP3.php';

$mail = new PHPMailer;
// include 'pdf_.php';

try {
    $mail->SMTPDebug = 4;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = "system.pst@gmail.com";
    $mail->Password   = "ndrhxbrkrzpypiqs";
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('system.pst@gmail.com');
    $row = mysqli_query($conn, "SELECT * FROM `email`");
    
    while ($result = $row->fetch_array()) {
       $mail->addAddress($result["email"]); 
    }
    //$mail->addAddress('waranon@pst.co.th');
    // $mail->addAddress('receiver2@gfg.com', 'Name');

    $mail->isHTML(true);
    $mail->Subject = "Subject Text";
    $mail->AllowEmpty = true;
    // $mail->Body = 'test';                                
    $mail->AddStringAttachment($x, 'FM-MIS-01-01 rev.00 MIS Request Form.pdf');
    $mail->AddStringAttachment($y, 'New Emp Kit.pdf');
    $mail->send();
    echo "Mail has been sent successfully!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>