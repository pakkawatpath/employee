<?php
include_once "db.php";

require_once 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

if (isset($_POST['download'])) {

    $sheet->setCellValue('A1', 'รหัสพนักงาน');
    $sheet->setCellValue('B1', 'ชื่อ');
    $sheet->setCellValue('C1', 'นามสกุล');
    $sheet->setCellValue('D1', 'Name');
    $sheet->setCellValue('E1', 'Surname');
    $sheet->setCellValue('F1', 'ตำแหน่ง');
    $sheet->setCellValue('G1', 'แผนก');
    $sheet->setCellValue('H1', 'email');
    $sheet->setCellValue('I1', 'วันเริ่มงาน');
    $sheet->setCellValue('J1', 'วันลาออก');

    $query = "SELECT * FROM `employee` ORDER BY `pid` ASC";
    $result = mysqli_query($conn, $query);

    $row = 2;
    while ($row_data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $row_data['pid']);
        $sheet->setCellValue('B' . $row, $row_data['nameth']);
        $sheet->setCellValue('C' . $row, $row_data['lastnameth']);
        $sheet->setCellValue('D' . $row, $row_data['nameen']);
        $sheet->setCellValue('E' . $row, $row_data['lastnameen']);
        $sheet->setCellValue('F' . $row, $row_data['position']);
        $sheet->setCellValue('G' . $row, $row_data['department']);
        $sheet->setCellValue('H' . $row, $row_data['email']);
        $sheet->setCellValue('I' . $row, $row_data['startdate']);
        $sheet->setCellValue('J' . $row, $row_data['enddate']);
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
    $sheet->getColumnDimension('J')->setAutoSize(true);
    $filename = "User" . ".xlsx";

    $writer = new Xlsx($spreadsheet);
    $writer->save($filename);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    readfile($filename);
    unlink($filename);
    exit;
}
