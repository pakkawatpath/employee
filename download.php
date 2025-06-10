<?php
include_once "db.php";

require_once 'vendor/autoload.php';

date_default_timezone_set('Asia/Bangkok');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

if (isset($_POST['download'])) {

    $sheet->setCellValue('A1', 'ContactNo');
    $sheet->setCellValue('B1', 'SerialNo');
    $sheet->setCellValue('C1', 'Username');
    $sheet->setCellValue('D1', 'Type');
    $sheet->setCellValue('E1', 'Detail');
    $sheet->setCellValue('F1', 'StrDate');
    $sheet->setCellValue('G1', 'EndDate');
    $sheet->setCellValue('H1', 'Accessory');
    $sheet->setCellValue('I1', 'AccessCode');

    $query = "SELECT serialmaster.id, serialmaster.contractno, serialmaster.serialno, serialmaster.username, serialmaster.comtype, serialmaster.commodel, contractmaster.strdate, contractmaster.enddate, serialmaster.accessory, serialmaster.accesscode FROM `serialmaster` INNER JOIN contractmaster ON serialmaster.contractno = contractmaster.contractno WHERE `username` <> '' order by serialmaster.contractno DESC";
    $result = mysqli_query($conn, $query);
    $row = 2;
    while ($row_data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $row_data['contractno']);
        $sheet->setCellValue('B' . $row, $row_data['serialno']);
        if (!empty($row_data['username'])) {
            $pid = $row_data['username'];
            $xemployee = mysqli_query($conn, "SELECT * FROM `employee` WHERE `pid` = '$pid'");
            while ($employee = $xemployee->fetch_array()) {
                $user = $employee['nameth'] . " " . $employee['lastnameth'];
            }

            if (empty($employee)) {
                $user = $pid;
            }
        } else {
            $user = '';
        }
        $sheet->setCellValue('C' . $row, $user);
        $sheet->setCellValue('D' . $row, $row_data['comtype']);
        $sheet->setCellValue('E' . $row, $row_data['commodel']);

        $constrdate = $row_data['strdate'];
        $xstrdate = date_create($constrdate);
        $strdate = date_format($xstrdate, "d-m-Y");

        $sheet->setCellValue('F' . $row, $strdate);

        $conenddate = $row_data['enddate'];
        $ydate = date_create($conenddate);
        $enddate = date_format($ydate, "d-m-Y");

        $sheet->setCellValue('G' . $row, $enddate);
        $sheet->setCellValue('H' . $row, $row_data['accessory']);
        $sheet->setCellValue('I' . $row, $row_data['accesscode']);
        $row++;
    }
    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getColumnDimension('D')->setAutoSize(true);
    $sheet->getColumnDimension('E')->setAutoSize(true);
    $sheet->getColumnDimension('F')->setAutoSize(true);
    $sheet->getColumnDimension('G')->setAutoSize(true);
    $sheet->getColumnDimension('H')->setAutoSize(true);
    $sheet->getColumnDimension('I')->setAutoSize(true);
    $today = date("d-m-Y");
    $filename = "ComputerLeasing_" . $today . ".xlsx";

    $writer = new Xlsx($spreadsheet);
    $writer->save($filename);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    readfile($filename);
    unlink($filename);
    exit;
}
