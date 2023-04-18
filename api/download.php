<?php
session_start();
require "dbcon.php";
require "functions.php";

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// if (!(isset($_SESSION['user-data']))) {
//     header("Location: ../index.php");
// }

// if (isset($_POST['view'])) {
//     $district = mysqli_real_escape_string($con, $_POST['district']);
//     $police_station = mysqli_real_escape_string($con, $_POST['police_station']);
//     $start_date = mysqli_real_escape_string($con, $_POST['start_date']);
//     $end_date = mysqli_real_escape_string($con, $_POST['end_date']);
//     $dead_bodies = isset($_POST['dead_bodies']) ? mysqli_real_escape_string($con, $_POST['dead_bodies']) : 0;
//     $ongoing_cases = isset($_POST['ongoing_cases']) ? mysqli_real_escape_string($con, $_POST['ongoing_cases']) : 0;
//     $minor_crimes = isset($_POST['minor_crimes']) ? mysqli_real_escape_string($con, $_POST['minor_crimes']) : 0;
//     $major_crimes = isset($_POST['major_crimes']) ? mysqli_real_escape_string($con, $_POST['major_crimes']) : 0;
//     $districts = districts();

//     $output_dead_bodies = array();
//     $output_minor_crimes = array();
//     $output_major_crimes = array();
//     $output_ongoing_cases = array();

//     if ($district == 'All') {
//         foreach ($districts as $row) {
//             if ($dead_bodies == 'on') {
//                 $output_dead_bodies[] = find_dead_bodies($row['district'], $start_date, $end_date);
//             }
//             if ($minor_crimes == 'on') {
//                 $output_minor_crimes[] = find_minor_crimes($row['district'], $start_date, $end_date);
//             }
//             if ($major_crimes == 'on') {
//                 $output_major_crimes[] = find_major_crimes($row['district'], $start_date, $end_date);
//             }
//             if ($ongoing_cases == 'on') {
//                 $output_ongoing_cases[] = find_ongoing_cases($row['district'], $start_date, $end_date);
//             }
//         }
//     } else {
//         if ($dead_bodies == 'on') {
//             $output_dead_bodies[] = find_dead_bodies($district, $start_date, $end_date);
//         }
//         if ($minor_crimes == 'on') {
//             $output_minor_crimes[] = find_minor_crimes($district, $start_date, $end_date);
//         }
//         if ($major_crimes == 'on') {
//             $output_major_crimes[] = find_major_crimes($district, $start_date, $end_date);
//         }
//         if ($ongoing_cases == 'on') {
//             $output_ongoing_cases[] = find_ongoing_cases($district, $start_date, $end_date);
//         }
//     }

//     // create a new PhpSpreadsheet object
//     $spreadsheet = new Spreadsheet();

//     if (!empty($output_dead_bodies)) {
//         $worksheet1 = $spreadsheet->getActiveSheet(); // get the active sheet
//         $worksheet1->setTitle('Dead Bodies'); // set the
//         // Populate the first worksheet with data
//         $row = 1;
//         foreach ($output_dead_bodies as $data) {
//             foreach ($data as $val) {
//                 $col = 1;
//                 foreach ($val as $cell) {
//                     $worksheet1->setCellValueByColumnAndRow($col, $row, $cell);
//                     $col++;
//                 }
//                 $row++;
//             }
//         }
//     }

//     // Create a new worksheet for minor crimes
//     $worksheet2 = $spreadsheet->createSheet();
//     $worksheet2->setTitle('Minor Crimes');

//     // Populate the second worksheet with data
//     $row = 1;
//     foreach ($output_minor_crimes as $data) {
//         foreach ($data as $val) {
//             $col = 1;
//             foreach ($val as $cell) {
//                 $worksheet2->setCellValueByColumnAndRow($col, $row, $cell);
//                 $col++;
//             }
//             $row++;
//         }
//     }

//     // Create a new worksheet for major crimes
//     $worksheet3 = $spreadsheet->createSheet();
//     $worksheet3->setTitle('Major Crimes');

//     // Populate the third worksheet with data
//     $row = 1;
//     foreach ($output_major_crimes as $data) {
//         foreach ($data as $val) {
//             $col = 1;
//             foreach ($val as $cell) {
//                 $worksheet3->setCellValueByColumnAndRow($col, $row, $cell);
//                 $col++;
//             }
//             $row++;
//         }
//     }

//     // Create a new worksheet for ongoing cases
//     $worksheet4 = $spreadsheet->createSheet();
//     $worksheet4->setTitle('Ongoing Cases');

//     // Populate the fourth worksheet with data
//     $row = 1;
//     foreach ($output_ongoing_cases as $data) {
//         foreach ($data as $val) {
//             $col = 1;
//             foreach ($val as $cell) {
//                 $worksheet4->setCellValueByColumnAndRow($col, $row, $cell);
//                 $col++;
//             }
//             $row++;
//         }
//     }

//     // Set the active worksheet index to the first sheet
//     $spreadsheet->setActiveSheetIndex(0);

//     // Save the Excel file
//     $writer = new Xlsx($spreadsheet);
//     $filename = 'crime_data.xlsx';
//     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//     header('Content-Disposition: attachment; filename="' . $filename . '"');
//     $writer->save('php://output');

// }
?>