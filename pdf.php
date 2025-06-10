<?php
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
$x = wordwrap($hardware,139,"<br>\n",TRUE);
$y1 = wordwrap($hardware,98,"<br>\n",TRUE);

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
            <td colspan='4' style='text-align:left;border-left: 1px solid black;border-right: 1px solid black;'></td>
        </tr>
        <tr>
            <td colspan='4' style='text-align:center;border-left: 1px solid black;border-right: 1px solid black;'><br></td>
        </tr>
        <tr>
            <td colspan='4' style='text-align:left;font-size: 16px;background-color: #dddddd;border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;'>$un โปรแกรมสำเร็จรูป ( Software )  โปรดระบุรายละเอียด เช่น Windows ,  MS Office , Outlook, Formular, Sage, SAP</td>
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
$mpdf->Output();
?>

<!-- <!DOCTYPE html>
<html>

<head
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

</html> -->

<?php
//$html = ob_get_contents(); // ทำการเก็บค่า HTML จากคำสั่ง ob_start()
// ให้ทำการบันทึกโค้ด HTML เป็น PDF โดยบันทึกเป็นไฟล์ชื่อ MyPDF.pdf

?>
<a href="test.pdf">คลิกที่นี้</a>
