<?php
include_once "db.php";
error_reporting(0);
$pid = $_GET['pid'];
$nameth = $_GET['nameth'];
$lastnameth = $_GET['lastnameth'];
$nameen = $_GET['nameen'];
$lastnameen = $_GET['lastnameen'];
$position = $_GET['position'];
$department = $_GET['department'];
$phone = $_GET['phone'];
$telephone = $_GET['telephone'];
$email = $_GET['email'];
$sd = $_GET['sd'];
$n = $_GET['n'];
$nn = $_GET['nn'];
$hardware = $_GET['hardware'];
$software = $_GET['software'];
$app = $_GET['app'];
$net = $_GET['net'];
$de = $_GET['de'];
$iduser = $_GET['iduser'];
$description = $_GET['des'];

require_once 'vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [__DIR__ . '\fonts',]),
    'fontdata' => $fontData + [
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' => 'THSarabunNew Bold.ttf'
        ]
    ],
]);

$pidx = substr($pid, 0, 2);
$c = mysqli_query($conn, "SELECT * FROM `company` WHERE `Companycode` = '$pidx'");
$cc = $c->fetch_array();

$x = strtolower($cc['Companyname']);
$pst = ($x == 'pst') ? $company = 'บริษัท เพาเวอร์ โซลูชั่น เทคโนโลยี จำกัด' : '';
$biggas = ($x == 'biggas') ? $company = 'บริษัท บิ๊กแก๊ส เทคโนโลยี จำกัด' : '';
$tpn = ($x == 'tpn') ? $company = 'บริษัท ไทย ไปป์ ไลน์ เน็ตเวิร์ค จำกัด' : '';
$bgtlo = ($x == 'bgtlo') ? $company = 'บริษัท บีจีที โลจิสติกส์ จำกัด' : '';
$jn = ($x == 'jn') ? $company = 'บริษัท เจเอ็น เอ็นเนอร์จี คอร์ปอเรชั่น จำกัด' : '';

$y = 'c';
$a = ($y == 'a') ? '<img width="15" height="15" src="icon\check.gif">' : '<img width="17" height="17" src="icon\uncheck.gif">';
$b = ($y == 'b') ? '<img width="15" height="15" src="icon\check.gif">' : '<img width="17" height="17" src="icon\uncheck.gif">';
$c = ($y == 'c') ? '<img width="15" height="15" src="icon\check.gif">' : '<img width="17" height="17" src="icon\uncheck.gif">';
$d = ($y == 'd') ? '<img width="15" height="15" src="icon\check.gif">' : '<img width="17" height="17" src="icon\uncheck.gif">';
$e = ($y == 'e') ? '<img width="15" height="15" src="icon\check.gif">' : '<img width="17" height="17" src="icon\uncheck.gif">';
$f = ($y == 'f') ? '<img width="15" height="15" src="icon\check.gif">' : '<img width="17" height="17" src="icon\uncheck.gif">';
$space = str_repeat('&nbsp;', 7);
$cspace = str_repeat('&nbsp;', 2);

if (empty($hardware)) {
    $hd = '<img width="15" height="15" src="icon\uncheck.gif">';
} else {
    $hd = '<img width="15" height="15" src="icon\check.gif">';
}

if (empty($software)) {
    $sw = '<img width="15" height="15" src="icon\uncheck.gif">';
} else {
    $sw = '<img width="15" height="15" src="icon\check.gif">';
}

if (empty($app)) {
    $ap = '<img width="15" height="15" src="icon\uncheck.gif">';
} else {
    $ap = '<img width="15" height="15" src="icon\check.gif">';
}

if (empty($net)) {
    $ne = '<img width="15" height="15" src="icon\uncheck.gif">';
} else {
    $ne = '<img width="15" height="15" src="icon\check.gif">';
}

if (empty($de)) {
    $des = '<img width="15" height="15" src="icon\uncheck.gif">';
} else {
    $des = '<img width="15" height="15" src="icon\check.gif">';
}

$un = '<img width="15" height="15" src="icon\check.gif">';

$name = $n . $nameth . ' ' . $lastnameth;


$x1 = wordwrap($hardware, 139, "<br>\n", TRUE);
$y1 = wordwrap($hardware, 98, "<br>\n", TRUE);
// $department = wordwrap($department, 30, "<br>\n", true);

date_default_timezone_set('Asia/Bangkok');

$num = mysqli_query($conn, "SELECT * FROM `lognumber`");
$result = $num->fetch_array();

if ($result['y'] != date('Y')) {
    $num = sprintf("%03d", 1);
} else {
    $num = $result['number'] + 1;
    $num = sprintf("%03d", $num);
}

if (empty($result['number'])) {
    $year = date('Y');
    $month = date('m');
    $num = sprintf("%03d", 1);
    mysqli_query($conn, "INSERT INTO `lognumber`(`y`, `m`, `number`) VALUES ('$year','$month','$num')");
} else {
    $year = date('Y');
    $month = date('m');
    mysqli_query($conn, "UPDATE `lognumber` SET `y`='$year',`m`='$month',`number`= '$num' ");
}

$number = $year . $month . '-' . $num;
$nameandlastnameen = $nameen . ' ' . $lastnameen;

$content = "<style>
                    body {
                            font-family: 'Sarabun';
                        }

                    table {
                            border-collapse: collapse;
                            width:100%;
                            table-layout: auto;
                        }

                    </style>
                    
                    <table>
                    <tbody> 
                    <tr>
                            <th colspan='4' style='font-size: 24px;text-align:center;background-color: #dddddd;border: 1px solid black;'>MIS REQUEST</th>
                        </tr>
                        <tr>
                            <td colspan='4' style='text-align:right;border: 1px solid black;'>Request No.$number $space</td>
                        </tr>
                        <tr>
                            <td style='text-align:center;border: 1px solid black;'>
                            <table>
                            <tr>
                            <td>
                            บริษัท
                            </td>
                            </tr>
                            </table>
                            </td>

                            <td colspan='3' style='text-align:left;border: 1px solid black;'>
                            <table>
                            <tr>
                            <td>
                            $company
                            </td>
                            </tr>
                            </table>
                            </td>
                        </tr>
                        
                        <tr> 
                            <td rowspan='2' style='text-align:center;border: 1px solid black;'>ผู้ขอรับบริการ</td>

                            <td>
                            <table>
                            <tr>
                            <td>
                            รหัสพนักงาน $pid 
                            </td>
                            </tr>
                            </table>
                            </td>

                            <td>
                            <table>
                            <tr>
                            <td>
                            ชื่อ-นามสกุล $name
                            </td>
                            </tr>
                            </table>
                            </td>
    
                            <td style='border-right: 1px solid black;'>
                            <table>
                            <tr>
                            <td>
                            โทร $telephone
                            </td>
                            </tr>
                            </table>
                            </td>
                            
                        </tr>
                        <tr>
                            <td colspan='3' style='border-bottom: 1px solid black;border-right: 1px solid black;'>
                            <table style='table-layout:fixed;'>
                            <tr>
                            <td>
                            รหัส/ชื่อแผนก 
                            </td>
                            <td>
                            <span style='font-size: 12px;'>$department</span>
                            </td>
                            <td>
                            ตำแหน่ง 
                            </td>
                            <td>
                            <span style='font-size: 12px;'>$position</span>
                            </td>
                            </table>
                            </td>
                            </tr>
                        </tr>
                        <tr>
                            <td style='text-align:center;border: 1px solid black;'>ประเภทการร้องขอ</td>
                            <td colspan='3' style='text-align:center;border: 1px solid black;'>
                            <table>
                            <tr>
                            <td>
                            $a $cspace สั่งซื้อ $space $b $cspace เพิ่ม $space $c $cspace สร้างใหม่ $space $d $cspace แก้ไข $space $e $cspace ปรับปรุง $space $f $cspace เปลี่ยนแปลง
                            </td>
                            </tr>
                            </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='4' style='font-size: 16px;background-color: #dddddd;border-left: 1px solid black;border-right: 1px solid black;'>$hd อุปกรณ์คอมพิวเตอร์ ( Hardware )  โปรดระบุรายละเอียด เช่น คอมพิวเตอร์ ,  Printer ,  จอ Monitor</td>
                        </tr>
                        <tr>
                            <td colspan='4' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
                        </tr>
                        <tr>
                            <td colspan='4' style='text-align:left;border-left: 1px solid black;border-right: 1px solid black;'>
                            <table>
                            <tr>
                            <td>
                            $hardware
                            </td>
                            </tr>
                            </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='4' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
                        </tr>
                        <tr>
                            <td colspan='4' style='text-align:left;font-size: 16px;background-color: #dddddd;border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;'>$sw โปรแกรมสำเร็จรูป ( Software )  โปรดระบุรายละเอียด เช่น Windows ,  MS Office , Outlook, Formular, Sage, SAP</td>
                        </tr>
                        <tr>
                            <td colspan='4' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
                        </tr>
                        <tr>
                            <td colspan='4' style='text-align:left;border-left: 1px solid black;border-right: 1px solid black;'>
                            <table>
                            <tr>
                            <td>
                            $software
                            </td>
                            </tr>
                            </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='4' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
                        </tr>
                        <tr>
                            <td colspan='4' style='font-size: 16px;background-color: #dddddd;border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;'>$ap โปรแกรมพัฒนาขึ้นเอง ( Application )  โปรดระบุรายละเอียด เช่น  Report บัญชี</td>
                        </tr>
                        <tr>
                            <td colspan='4' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
                        </tr>
                        <tr>
                            <td colspan='4' style='text-align:left;border-left: 1px solid black;border-right: 1px solid black;'>
                            <table>
                            <tr>
                            <td>
                            $app
                            </td>
                            </tr>
                            </table>
                            </td>
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
                            <td colspan='4' style='text-align:left;border-left: 1px solid black;border-right: 1px solid black;'>
                            <table>
                            <tr>
                            <td>
                            $email
                            </td>
                            </tr>
                            </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='4' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
                        </tr>
                        <tr>
                            <td colspan='4' style='font-size: 16px;background-color: #dddddd;border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;'>$ne Network Login User  ( Network , VPN ) ,Share Drive</td>
                        </tr>
                        <tr>
                            <td colspan='4' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
                        </tr>
                        <tr>
                            <td colspan='4' style='text-align:left;border-left: 1px solid black;border-right: 1px solid black;'>
                            <table>
                            <tr>
                            <td>
                            <table>
                            <tr>
                            <td>
                            $nameandlastnameen
                            </td>
                            </tr>
                            <tr>
                            <td>
                            $net
                            </td>
                            </tr>
                            </table>
                            </td>
                            </tr>
                            </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='4' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
                        </tr>
                        <tr>
                            <td colspan='4' style='font-size: 16px;background-color: #dddddd;border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;'>$des อื่นๆ โปรดระบุรายละเอียด</td>
                        </tr>
                        <tr>
                            <td colspan='4' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
                        </tr>
                        <tr>
                            <td colspan='4' style='text-align:left;border-left: 1px solid black;border-right: 1px solid black;'>
                            <table>
                            <tr>
                            <td>
                            $de
                            </td>
                            </tr>
                            </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='4' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
                        </tr>
                        <tr>
                            <td style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;'>ผู้ขอรับบริการ</td>
                            <td style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;'>ผู้จัดการแผนก / ฝ่าย ต้นสังกัด</td>
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
                            <td colspan='4' style='border-left: 1px solid black;border-right: 1px solid black;'></td>
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
                            <td colspan='3' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
                            <td style='text-align:center;border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;'>ผู้ขอรับบริการ ( รับมอบงาน )</td>
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
$xpdf = $mpdf->Output('', 's');


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

$mpdf1 = new $mpdf1(array(
    'fontDir' => array_merge($fontDirs, array(__DIR__ . '\fonts')),
    'fontdata' => $fontData + array('sarabun' => array('R' => 'THSarabunNew.ttf', 'I' => 'THSarabunNew Italic.ttf', 'B' => 'THSarabunNew Bold.ttf')),
));

date_default_timezone_set("Asia/Bangkok");
$date = date('Y') + 543;
$date = substr($date, 2);
$pic1 = '<img src="icon/Picture2.gif" width="150" height="90">';
$pic2 = '<img src="icon/Picture2.gif" width="90" height="60">';

$cn = $_GET['carname'];
$cr = $_GET['carregi'];
$fuel = $_GET['fuel'];
$limit = $_GET['limit'];
$doc = $_GET['doc'];

$namet = $n . $nameth;

if (!empty($_GET['card'])) {
    $cardcheck = '<img src="icon/check.gif" width="15" height="15">';
    $comm = $company;
    $nt = $nameth;
    $lt = $lastnameth;
    $ne = $nameen;
    $le = $lastnameen;
    $posi = $position;
    $tel = $telephone;
    $ph = $phone;
    $em = $email;
    $item = '100';
} else {
    $cardcheck = '<img src="icon/uncheck.gif" width="15" height="15">';
    $descard = "";
    $comm = '';
    $nt = '';
    $lt = '';
    $ne = '';
    $le = '';
    $posi = '';
    $tel = '';
    $ph = '';
    $em = '';
    $item = '';
}

if (isset($net)) {
    $net = '<img src="icon/check.gif" width="15" height="15">';
} else {
    $net = '<img src="icon/uncheck.gif" width="15" height="15">';
}

if (isset($tool)) {
    $tool = '<img src="icon/check.gif" width="15" height="15">';
} else {
    $tool = '<img src="icon/uncheck.gif" width="15" height="15">';
}

if ($_GET['park1'] == 'check1') {
    $ch1 = '<img src="icon/check.gif" width="15" height="15">';
} else {
    $ch1 = '<img src="icon/uncheck.gif" width="15" height="15">';
}
if ($_GET['park2'] == 'check2') {
    $ch2 = '<img src="icon/check.gif" width="15" height="15">';
} else {
    $ch2 = '<img src="icon/uncheck.gif" width="15" height="15">';
}
$com = $cc['Companyname'];

if ($com == 'PST') {
    $com = 'PSTC';
}

$cphone = $_GET['phonech'];

if ($cphone != 'phone0') {
    $cp1 = '<img src="icon/uncheck.gif" width="15" height="15">';
    $cp2 = '<img src="icon/uncheck.gif" width="15" height="15">';
    $cp3 = '<img src="icon/uncheck.gif" width="15" height="15">';
    $cp4 = '<img src="icon/uncheck.gif" width="15" height="15">';
    if ($cphone == 'phone1') {
        $cp1 = '<img src="icon/check.gif" width="15" height="15">';
    } elseif ($cphone == 'phone2') {
        $cp2 = '<img src="icon/check.gif" width="15" height="15">';
    } elseif ($cphone == 'phone3') {
        $cp3 = '<img src="icon/check.gif" width="15" height="15">';
    } elseif ($cphone == 'phone4') {
        $cp4 = '<img src="icon/check.gif" width="15" height="15">';
    }
} else {
    $cp1 = '<img src="icon/uncheck.gif" width="15" height="15">';
    $cp2 = '<img src="icon/uncheck.gif" width="15" height="15">';
    $cp3 = '<img src="icon/uncheck.gif" width="15" height="15">';
    $cp4 = '<img src="icon/uncheck.gif" width="15" height="15">';
}
if ($_GET['tool'] == 'tool1') {
    $ct = '<img src="icon/check.gif" width="15" height="15">';
} else {
    $ct = '<img src="icon/uncheck.gif" width="15" height="15">';
}
$space = str_repeat('&nbsp;', 50);
$spacez = str_repeat('&nbsp;', 15);
$spacea = str_repeat('&nbsp;', 22);
$spaceb = str_repeat('&nbsp;', 41);
$spacec = str_repeat('&nbsp;', 14);
$spacex = str_repeat('&nbsp;', 55);
$spacecom = str_repeat('&nbsp;', 2);
$spacecom1 = str_repeat('&nbsp;', 12);
$spacecom2 = str_repeat('&nbsp;', 4);
$x = '<img src="icon/Picture2.gif" width="100" height="60">';
$y = '<img src="icon/Picture2.gif" width="90" height="60">';
$one = $_GET['one'];
$two = $_GET['two'];
$three = $_GET['three'];
$four = $_GET['four'];
$five = $_GET['five'];
$six = $_GET['six'];
$carname0 = $_GET['carname0'];
$carregi1 = $_GET['carregi1'];
$content1 = "<style>
                        body {
                            font-family: 'Sarabun';
                        }

                        table.a {
                            width: 100%;
                        }
                        
                        table, th, td {
                            border-collapse: collapse;
                        }

                    </style>
                    <table class='a' style='margin-left: auto;margin-right: auto;'>
                        <tbody>
                            <tr>
                                <td colspan='4' style='background-color: #4472c4;'><table><tr><td style='text-align:left;'>$x</td><td style='text-align:left;font-size: 17px;padding-left:40px'>$spacea New Employee Starter Kit , Admin Request</td></tr></table></td>
                                <td  style='border: 1px solid black;text-align:center'><p>For Admin</p><br><p>No.$number/$date</p></td>
                            </tr>
                            <tr>
                                <td colspan='6' style='text-align:center;background-color: #F8CBAD;font-size: 15px;'>ข้อมูลส่วนตัว</td>
                            </tr>
                            <tr>
                                <td>
                                <table>
                                <tr>
                                <td style='font-size: 15px;'>
                                ชื่อ
                                </td>
                                <td style='font-size: 15px;'>
                                $spacez $namet
                                </td>
                                <td style='font-size: 15px;'>
                                $spacez นามสกุล
                                </td>
                                <td style='font-size: 15px;'>
                                $spacez $lastnameth
                                </td>
                                </tr>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <table>
                                <tr>
                                <td  style='font-size: 15px;'>
                                ตำแหน่ง
                                </td>
                                <td style='font-size: 15px;'>
                                $spacez $position
                                </td>
                                </tr>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <table>
                                <tr>
                                <td>
                                บริษัท
                                </td>
                                <td style='font-size: 15px;'>
                                $spacez $com
                                </td>
                                <td style='font-size: 15px;'>
                                $spacez วันเริ่มงาน
                                </td>
                                <td style='font-size: 15px;'>
                                $spacez $sd
                                </td>
                                </tr>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='6' style='text-align:center;background-color: #F8CBAD;font-size: 15px;'>ที่จอดรถ</td>
                            </tr>
                            <tr>
                                <td>
                                <table>
                                <tr>
                                <td style='font-size: 15px;'>
                                ที่จอดรถ
                                </td>
                                <td>
                                $spacecom $ch1
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom ที่จอดรถอาคารพีเอสที
                                </td>
                                <td>
                                $spacecom $ch2
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom ที่จอดรถเช่า
                                </td>
                                <td>$spacecom //</td>
                                <td style='font-size: 15px;'>
                                $spacecom ยี่ห้อรถ/รุ่นรถ
                                </td>
                                <td>
                                $spacecom $carname0
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom ทะเบียนรถ
                                </td>
                                <td>
                                $spacecom $carregi1
                                </td>
                                </tr>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='6' style='background-color: #D9E1F2;text-align:left;font-size: 15px;'>การปฏิบัติ Admin $space ดำเนินการเรียบร้อย เมื่อ</td>
                            </tr>
                            <tr>
                                <td colspan='6' style='text-align:center;background-color: #F8CBAD;font-size: 15px;'>นามบัตร</td>
                            </tr>
                            <tr>
                                <td>
                                <table>
                                <tr>
                                <td>
                                จำนวน
                                </td>
                                <td>
                                $spacecom $cardcheck
                                </td>
                                <td>
                                $spacecom 100ใบ
                                </td>
                                </tr>
                                </table>
                                </td>
                            </tr>
                            <tr> 
                                <td colspan='5' style='text-align:left;background-color: #9BC2E6;'><table><tr><td>$y</td><td style='text-align:left;font-size: 17px;padding-left:40px'>$spaceb รายละเอียดทำนามบัตร</td></tr></table></td>
                            </tr>
                            <tr>
                                <td>
                                <table>
                                <tr>
                                <td style='font-size: 15px;'>
                                บริษัท
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom1 $comm
                                </td>
                                </tr>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td><br></td>
                            </tr>
                            <tr>
                                <td>
                                <table>
                                <tr>
                                <td style='font-size: 15px;'>
                                ชื่อ(ภาษาไทย) 
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 $nt
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 นามสกุล(ภาษาไทย)
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 $lt
                                </td>
                                </tr>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <table>
                                <tr>
                                <td style='font-size: 15px;' >
                                ชื่อ(ภาษาอังกฤษ)
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 $ne
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 นามสกุล(ภาษาอังกฤษ)
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 $le
                                </td>
                                </tr>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <table>
                                <tr>
                                <td style='font-size: 15px;'>
                                ตำแหน่ง (ภาษาอังกฤษ)
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 $posi
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 เบอร์ต่อ
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 $tel
                                </td>
                                </tr>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <table>
                                <tr>
                                <td style='font-size: 15px;'>
                                เบอร์โทรศัพท์มือถือ
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 $ph
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 อีเมล์
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 $em
                                </td>
                                </tr>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <table>
                                <tr>
                                <td style='font-size: 15px;'>
                                จำนวน
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 $item
                                </td>
                                </tr>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='6' style='background-color: #D9E1F2;text-align:left;font-size: 15px;'>การปฏิบัติ Admin $space ดำเนินการเรียบร้อย เมื่อ</td>
                            </tr>
                            <tr>
                                <td colspan='6' style='text-align:center;background-color: #F8CBAD;font-size: 15px;'>Fleet card</td>
                            </tr>
                            <tr>
                                <td>
                                <table>
                                <tr>
                                <td style='font-size: 15px;'>
                                ยี่ห้อรถ/รุ่นรถ
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 $cn
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 ทะเบียนรถ
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 $cr
                                </td>
                                </tr>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <table>
                                <tr>
                                <td style='font-size: 15px;'>
                                เชื้อเพลิง
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 $fuel
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 วงเงิน
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 $limit
                                </td>
                                </tr>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <table>
                                <tr>
                                <td style='font-size: 15px;'>
                                เอกสารประกอบ
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 $doc
                                </td>
                                </tr>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='6' style='background-color: #D9E1F2;text-align:left;font-size: 15px;'>การปฏิบัติ Admin $space ดำเนินการเรียบร้อย เมื่อ</td>
                            </tr>
                            <tr>
                                <td colspan='6' style='text-align:center;background-color: #F8CBAD;font-size: 15px;'>เบอร์โทรศัพท์มือถือ</td>
                            </tr>
                            <tr>
                                <td>
                                <table>
                                <tr>
                                <td>
                                $cp1
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 เดือนละ 449 บาท โทรฟรีทุกเครือข่ายไม่จำกัด เน็ท 10 GB
                                </td>
                                </tr>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <table>
                                <tr>
                                <td>
                                $cp2
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 เดือนละ 599 บาท โทรฟรีทุกเครือข่ายไม่จำกัด เน็ท 20 GB
                                </td>
                                </tr>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <table>
                                <tr>
                                <td>
                                $cp3
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 เดือนละ 799 บาท โทรฟรีทุกเครือข่ายไม่จำกัด เน็ท 40 GB
                                </td>
                                </tr>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <table>
                                <tr>
                                <td>
                                $cp4
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 เดือนละ 999 บาท โทรฟรีทุกเครือข่ายไม่จำกัด เน็ท 65 GB
                                </td>
                                </tr>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='6' style='background-color: #D9E1F2;text-align:left;font-size: 15px;'>การปฏิบัติ Admin $space ดำเนินการเรียบร้อย เมื่อ</td>
                            </tr>
                            <tr>
                                <td colspan='6' style='text-align:center;background-color: #F8CBAD;font-size: 15px;'>อุปกรณ์สำนักงาน</td>
                            </tr>
                            <tr>
                                <td>
                                <table>
                                <tr>
                                <td>
                                $ct
                                </td>
                                <td style='font-size: 15px;'>
                                $spacecom2 อุปกรณ์สำนักงาน
                                </td>
                                </tr>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='6' style='background-color: #D9E1F2;text-align:left;font-size: 15px;'>การปฏิบัติ Admin $space ดำเนินการเรียบร้อย เมื่อ</td>
                            </tr>
                            <tr>
                                <td colspan='6' style='text-align:center;background-color: #F8CBAD;font-size: 15px;'>อื่นๆ</td>
                            </tr>
                            <tr>
                                <td>
                                <table>
                                <tr>
                                <td style='font-size: 15px;'>1.</td>
                                <td style='font-size: 15px;width: 10px;'>$one</td>
                                </tr>
                                </table>
                                </td>
                                <td>
                                <table>
                                <tr>
                                <td style='font-size: 15px;text-align:left;'>4.</td>
                                <td style='font-size: 15px;'>$four</td>
                                </tr>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <table>
                                <tr>
                                <td style='font-size: 15px;'>2.</td>
                                <td style='font-size: 15px;width: 10px;'>$two</td>
                                </tr>
                                </table>
                                </td>
                                <td>
                                <table>
                                <tr>
                                <td style='font-size: 15px;text-align:left;'>5.</td>
                                <td style='font-size: 15px;'>$five</td>
                                </tr>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <table>
                                <tr>
                                <td style='font-size: 15px;'>3.</td>
                                <td style='font-size: 15px;width: 10px;'>$three</td>
                                </tr>
                                </table>
                                </td>
                                <td>
                                <table>
                                <tr>
                                <td style='font-size: 15px;text-align:left;'>6.</td>
                                <td style='font-size: 15px;'>$six</td>
                                </tr>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='6' style='background-color: #D9E1F2;text-align:left;'>การปฏิบัติ Admin $space ดำเนินการเรียบร้อย เมื่อ</td>
                            </tr>
                        </tbody>
                    </table>";
$mpdf1->WriteHTML($content1);
$ypdf = $mpdf1->Output('', 's');


?>

<!DOCTYPE html>
<html>

<head>
    <title>PDF</title>
    <meta http-equiv="Content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Sarabun';
        }

        th,
        td {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <img src="./icon/load.gif" width="10%" style="display: block;margin-left: auto;margin-right: auto;">
    <?php
    $sd = $_GET['sd'];
    //$html = ob_get_contents(); // ทำการเก็บค่า HTML จากคำสั่ง ob_start()
    // ให้ทำการบันทึกโค้ด HTML เป็น PDF โดยบันทึกเป็นไฟล์ชื่อ MyPDF.pdf
    //$a = 'PHPMailer\PHPMailer\PHPMailer';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    // require 'PHPMailer/PHPMailerAutoload.php';

    /* Exception class. */

    require '.\PHPMailer\src\Exception.php';

    /* The main PHPMailer class. */
    require '.\PHPMailer\src\PHPMailer.php';

    /* SMTP class, needed if you want to use SMTP. */
    require '.\PHPMailer\src\SMTP.php';

    //require 'C:\xampp\htdocs\profile\PHPMailer\src\POP3.php';

    $mail = new PHPMailer;
    // include 'pdf_.php';
    $fullnameth = $nameth . " " . $lastnameth;
    $fullnameen = $nameen . " " . $lastnameen;
    $card = $_GET['card'];
    if (!empty($card)) {
        $card = 'มี';
    } else {
        $card = 'ไม่มี';
    }
    $user = $_SESSION['UserID'];
    $com = $cc['Companyname'];
    $body = "<table style='width: 100%;border-collapse: collapse;border: 1px solid black;text-align: center;'>
                <tr>
                    <th style='border: 1px solid black;'>รหัสพนักงาน</th>
                    <th style='border: 1px solid black;'>ชื่อ - นามสกุล (ไทย)</th>
                    <th style='border: 1px solid black;'>ชื่อ - นามสกุล (Eng)</th>
                    <th style='border: 1px solid black;'>Username</th>
                    <th style='border: 1px solid black;'>E-Mail</th>
                    <th style='border: 1px solid black;'>บริษัท</th>
                    <th style='border: 1px solid black;'>ตำแหน่ง</th>
                    <th style='border: 1px solid black;'>แผนก</th>
                    <th style='border: 1px solid black;'>นามบัตร</th>
                    <th style='border: 1px solid black;'>วันเริ่มทำงาน</th>
                    <th style='border: 1px solid black;'>วันที่สิ้นสุด</th>
                    <th style='border: 1px solid black;'>หมายเหตุ</th>
                    <th style='border: 1px solid black;'>ผู้ส่ง</th>
                </tr>
                <tr>
                    <td style='border: 1px solid black;'>$pid</td>
                    <td style='border: 1px solid black;'>$fullnameth</td>
                    <td style='border: 1px solid black;'>$fullnameen</td>
                    <td style='border: 1px solid black;'>$iduser</td>
                    <td style='border: 1px solid black;'>$email</td>
                    <td style='border: 1px solid black;'>$com</td>
                    <td style='border: 1px solid black;'>$position</td>
                    <td style='border: 1px solid black;'>$department</td>
                    <th style='border: 1px solid black;'>$card</th>
                    <td style='border: 1px solid black;'>$sd</td>
                    <td style='border: 1px solid black;'></td>
                    <td style='border: 1px solid black;'>$description</td>
                    <td style='border: 1px solid black;'>$user</td>
                </tr>
            </table>";

    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = "system.pst@gmail.com";
        $mail->Password   = "ndrhxbrkrzpypiqs";
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
        $mail->CharSet = "UTF-8";

        $mail->setFrom('system.pst@gmail.com');
        $row = mysqli_query($conn, "SELECT * FROM `email`");

        while ($result = $row->fetch_array()) {
            $mail->addAddress($result["email"]);
        }
        //$mail->addAddress('waranon@pst.co.th');
        // $mail->addAddress('receiver2@gfg.com', 'Name');
        $text = "ขอแจ้งข้อมูลการเริ่มงานของพนักงานใหม่";

        $mail->isHTML(true);
        $mail->Subject = $text;
        $mail->AllowEmpty = true;
        // $mail->Body = 'test';                                
        $mail->AddStringAttachment($xpdf, 'FM-MIS-01-01 rev.00 MIS Request Form.pdf');
        $mail->AddStringAttachment($ypdf, 'New Emp Kit.pdf');
        $mail->Body = $body;
        $mail->send();
        echo '<script>';
        echo "window.location.href='profile?Page=1'";
        echo '</script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
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
        $_SESSION['six'],
        $_SESSION['description']
    );
    ?>
</body>

</html>