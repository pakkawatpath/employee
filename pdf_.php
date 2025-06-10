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
date_default_timezone_set("Asia/Bangkok");
$date = date('Y') + 543;
$date = substr($date, 0, 2);
$x = '<img src="icon/Picture2.gif" width="100" height="60">';
$y = '<img src="icon/Picture2.gif" width="90" height="60">';
// $text = '<p style="padding-bottom:20px">New Employee Starter Kit , Admin Request</p>';
$ch = '<img src="icon/check.gif" width="15" height="15">';
$space = str_repeat('&nbsp;', 50);
$spacez = str_repeat('&nbsp;', 15);
$spacea = str_repeat('&nbsp;', 22);
$spaceb = str_repeat('&nbsp;', 41);
$spacec = str_repeat('&nbsp;', 14);
$spacex = str_repeat('&nbsp;', 55);
$spacecom = str_repeat('&nbsp;', 2);
$spacecom1 = str_repeat('&nbsp;', 12);
$spacecom2 = str_repeat('&nbsp;', 4);
$content = "<style>
                body {
                    font-family: 'Sarabun';
                }

                table.a {
                    width: 100%;
                }
                
                table, th, td {
                    border-collapse: collapse;
                }

                // tr{
                //     width: 100%;
                //     display: table;
                //     box-sizing: border-box;
                // }
                // tbody {
                //     width: 100%;
                //     display: block;
                // }

                // td {
                //     font-size: 14px;
                // }
            </style>
            $text
            <table class='a' style='margin-left: auto;margin-right: auto;'>
                <tbody>
                    <tr>
                        <td colspan='4' style='background-color: #4472c4;'><table><tr><td style='text-align:left;'>$x</td><td style='text-align:left;font-size: 15px;'>$spacea New Employee Starter Kit , Admin Request</td></tr></table></td>
                        <td  style='border: 1px solid black;text-align:center'><p>For Admin</p><br><p>No......................../$date</p></td>
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
                        $spacez ภควัตร
                        </td>
                        <td style='font-size: 15px;'>
                        $spacez นามสกุล
                        </td>
                        <td style='font-size: 15px;'>
                        $spacez ปฐมบุรุษรัตน์
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
                        $spacez โปรแกรมเมอร์
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
                        $spacez PSTC
                        </td>
                        <td style='font-size: 15px;'>
                        $spacez วันเริ่มงาน
                        </td>
                        <td style='font-size: 15px;'>
                        $spacez 10/10/2565
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
                        $spacecom $ch
                        </td>
                        <td style='font-size: 15px;'>
                        $spacecom ที่จอดรถอาคารพีเอสที
                        </td>
                        <td>
                        $spacecom $ch
                        </td>
                        <td style='font-size: 15px;'>
                        $spacecom ที่จอดรถเช่า
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
                        $spacecom $ch
                        </td>
                        <td>
                        $spacecom 100ใบ
                        </td>
                        </tr>
                        </table>
                        </td>
                    </tr>
                    <tr> 
                        <td colspan='5' style='text-align:left;background-color: #9BC2E6;'><table><tr><td>$y</td><td style='text-align:left;font-size: 15px;'>$spaceb รายละเอียดทำนามบัตร</td></tr></table></td>
                    </tr>
                    <tr>
                        <td>
                        <table>
                        <tr>
                        <td style='font-size: 15px;'>
                        บริษัท
                        </td>
                        <td style='font-size: 15px;'>
                        $spacecom1 บริษัท เพาเวอร์ โซลูชั่น เทคโนโลยี จำกัด (มหาชน)
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
                        $spacecom2 ภควัตร  
                        </td>
                        <td style='font-size: 15px;'>
                        $spacecom2 นามสกุล(ภาษาไทย)
                        </td>
                        <td style='font-size: 15px;'>
                        $spacecom2 ปฐมบุรุษรัตน์
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
                        $spacecom2 Pakkawat
                        </td>
                        <td style='font-size: 15px;'>
                        $spacecom2 นามสกุล(ภาษาอังกฤษ)
                        </td>
                        <td style='font-size: 15px;'>
                        $spacecom2 Pathombururat
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
                        $spacecom2 Programmer
                        </td>
                        <td style='font-size: 15px;'>
                        $spacecom2 เบอร์ต่อ
                        </td>
                        <td style='font-size: 15px;'>
                        $spacecom2 1112
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
                        $spacecom2 0957322156
                        </td>
                        <td style='font-size: 15px;'>
                        $spacecom2 อีเมล์
                        </td>
                        <td style='font-size: 15px;'>
                        $spacecom2 pakkwat.p@pst.co.th
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
                        $spacecom2 100
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
                        $spacecom2 aaaaaaaaa
                        </td>
                        <td style='font-size: 15px;'>
                        $spacecom2 ทะเบียนรถ
                        </td>
                        <td style='font-size: 15px;'>
                        $spacecom2 aaaaaaaaa
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
                        $spacecom2 aaaaaaaaa
                        </td>
                        <td style='font-size: 15px;'>
                        $spacecom2 วงเงิน
                        </td>
                        <td style='font-size: 15px;'>
                        $spacecom2 aaaaaaaaaa
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
                        $spacecom2 aaaaaaaaaa
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
                        $ch
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
                        $ch
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
                        $ch
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
                        $ch
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
                        $ch
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
                        <td style='font-size: 15px;'>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</td>
                        </tr>
                        </table>
                        </td>
                        <td>
                        <table>
                        <tr>
                        <td style='font-size: 15px;'>4.</td>
                        <td style='font-size: 15px;'>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</td>
                        </tr>
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <table>
                        <tr>
                        <td style='font-size: 15px;'>2.</td>
                        <td style='font-size: 15px;'>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</td>
                        </tr>
                        </table>
                        </td>
                        <td>
                        <table>
                        <tr>
                        <td style='font-size: 15px;'>5.</td>
                        <td style='font-size: 15px;'>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</td>
                        </tr>
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <table>
                        <tr>
                        <td style='font-size: 15px;'>3.</td>
                        <td style='font-size: 15px;'>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</td>
                        </tr>
                        </table>
                        </td>
                        <td>
                        <table>
                        <tr>
                        <td style='font-size: 15px;'>6.</td>
                        <td style='font-size: 15px;'>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</td>
                        </tr>
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='6' style='background-color: #D9E1F2;text-align:left;'>การปฏิบัติ Admin $space ดำเนินการเรียบร้อย เมื่อ</td>
                    </tr>
                </tbody>
            </table>";

$mpdf->WriteHTML($content);
$mpdf->Output();
// $y = $mpdf->Output('test1.pdf', 's');
