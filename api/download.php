<?php
session_start();
require "dbcon.php";
require "functions.php";
require "download_manager.php";

// $start_date = $_SESSION['start_date'];
// $end_date = $_SESSION['end_date'];
// if ($start_date == $end_date) {
//     $text = $start_date;
// } else {
//     $text = $start_date . " - " . $end_date;
// }

$doc_format = $_POST['doc_format'];
$document = $_POST['document_type'];
$date = $_POST['dsr_date'];
$district = $_POST['district'];

// Checking the format of downloading the file
if ($doc_format == "excel") {

    // Major crime download
    if (isset($_POST['major_crime_download'])) {
        $output_major_crimes = $_SESSION['major_crimes'];
        $districts = get_districts();
        $html = "<table style='vertical-align:middle;'>";
        foreach ($districts as $dist) {
            $distt = $dist['district'];
            $html .= "<tr>
                        <th colspan=13 center style='font-size: 44px; border:1px solid black; border-collapse: collapse; height:75px; vertical-align:middle; text-align:center;'>$distt के समस्त अपराधो की जानकारी | $text </th>
                    </tr>
                    <tr>
                        <th style='font-size: 28px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:45px;'>क्र.</th>
                        <th style='font-size: 28px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:90px;'>पुलिस थाना</th>
                        <th style='font-size: 28px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:80px;'>अ.क्र.</th>
                        <th style='font-size: 28px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:80px;'>धारा</th>
                        <th style='font-size: 28px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:160px;'>प्रार्थी का नाम व पता</th>
                        <th style='font-size: 28px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:190px;'>घटना दिनांक व समय</th>
                        <th style='font-size: 28px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:130px;'>घटना स्थल</th>
                        <th style='font-size: 28px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:190px;'>सूचना दिनाक व समय</th>
                        <th style='font-size: 28px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:150px;'>कायमीकर्ता</th>
                        <th style='font-size: 28px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:160px;'>आरोपी / संदिग्ध का नाम व पता</th>
                        <th style='font-size: 28px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:190px;'>गिरफ्तारी दिनाक व समय</th>
                        <th style='font-size: 28px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:120px;'>मृतक - मृतिका / आहत - आहता / पीड़ित - पीड़िता का नाम</th>
                        <th style='font-size: 28px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:225px'>विवरण</th>
                    </tr>";
            $i = 1;
            $found_crimes = false;
            foreach ($output_major_crimes as $majorcrime) {
                foreach ($majorcrime as $row) {
                    if ($row['district'] == $distt) {
                        $found_crimes = true;
                        if ($row['is_major_crime']) {
                            $victim_name = "";
                        } else {
                            $victim_name = $row['victim_name'];
                        }
                        $html .= "<tr>
                            <td style='font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $i++ . "
                            </td>
                            <td style='font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['police_station'] . " 
                            </td>
                            <td style='font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['crime_number'] . " 
                            </td>
                            <td style='font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['penal_code'] . " 
                            </td>
                            <td style='font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['applicant_name'] . " " . $row['applicant_address'] . " 
                            </td>
                            <td style='font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['incident_date'] . " " . $row['incident_time'] . " 
                            </td>
                            <td style='font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['incident_place'] . " 
                            </td>
                            <td style='font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['reporting_date'] . " " . $row['reporting_time'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['fir_writer'] . " 
                            </td>
                            <td style='font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['culprit_name'] . " " . $row['culprit_address'] . " 
                            </td>
                            <td style='font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['arrest_date'] . " " . $row['arrest_time'] . " 
                            </td>
                            <td style='font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $victim_name . " 
                            </td>
                            <td style='font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['description_of_crime'] . " 
                            </td>
                        </tr>";
                    }
                }
            }
            if (!($found_crimes)) {
                $html .= "<tr>
                        <td colspan=13 style=' height:50px; font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            निरंक
                        </td>
                    </tr>
                    ";
            }
            $html .= "<tr><td colspan=13 style='border:1px solid black; border-collapse: collapse;'></td></tr>";
        }

        $html .= "</table>";

        $html = '<html xmlns:o="urn:schemas-microsoft-com:office:office"
        xmlns:x="urn:schemas-microsoft-com:office:excel"
        xmlns="http://www.w3.org/TR/REC-html40">'
            . '<head><meta http-equiv="Content-type" content="text/html;charset=UTF-8" /></head>'
            . '<body>' . $html . '</body></html>';

        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=major_crimes.xls');
        echo $html;
    }

    // Minor crime download
    if (isset($_POST['minor_crime_download'])) {
        $output_minor_crimes = $_SESSION['minor_crimes'];
        $districts = get_districts();
        $top_row = ["41(1) जा. फौ", "102 जा. फौ", "109 जा. फौ", "110 जा. फौ", "145 जा. फौ", "151 जा. फौ", "107,116 जा. फौ", "सट्टा", "जुआ एक्ट", "आव. एक्ट", "नारको", "आर्म्स. एक्ट", "एम. वी. एक्ट"];

        $html = "<table style='border:1px solid black; border-collapse: collapse; vertical-align:middle;'>";
        $html .= "<tr><th colspan=28 style='height:75px; font-size: 42px;  border:1px solid black; border-collapse: collapse; vertical-align:middle;'>दैनिक प्रतिवेदन प्रतिबंधात्मकता कार्यवाही/लघु अधिनियम रेंज सरगुजा जिला सरगुजा | $text</th></tr>";
        $distnum = 1;
        $begin = 0;
        $finish = 1;
        $numbers = ["5", "16", "21", "31", "36", "48", "53", "58", "63", "74", "79", "94"];
        foreach ($districts as $dist) {

            $html .= "<tr>
                        <th colspan=28 style='font-size: 30px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; height:45px'>" . $dist['district'] . "</th>
                    </tr>
                    <tr>        
                        <th rowspan=2 style='font-size: 24px;border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:45px;'>क्र.</th>
                        <th rowspan=2 style='font-size: 24px;border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:125px'>पुलिस थाना</th>";
            foreach ($top_row as $cols) {
                $html .= "<th colspan=2 style='font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>" . $cols . "</th>";
            }

            $html .= "</tr>";
            $x = 1;
            $html .= "<tr>";
            for ($i = 1; $i <= 13; $i++) {
                $html .= "<td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>प्र.</td><td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>व्य.</td>";
            }
            $html .= "</tr>";
            $substations = get_sub_divisions($dist['district']);
            foreach ($substations as $sub) {
                $stations = get_police_stations($dist['district'], $sub['sub_division']);
                foreach ($stations as $ps) {
                    $html .= "<tr><td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>" . $x++ . "</td>";
                    $html .= "<td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>" . $ps['police_station'] . "</td>";
                    foreach ($top_row as $act) {
                        $cases = get_acts_count($_SESSION['start_date'], $_SESSION['end_date'], $act, $ps['police_station']);
                        if (($cases != false) and $cases['case_count'] >= 1) {
                            $html .= "<td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>" . $cases['case_count'] . "</td>";
                            $html .= "<td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>" . $cases['people_count'] . "</td>";
                        } else {
                            $html .= "<td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'></td><td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'></td>";
                        }
                    }
                    $html .= "</tr>";
                }
            }
            $alphabets = ["C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB"];
            $html .= "<tr>
                        <td colspan=2 style='font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>योग</td>";
            foreach ($alphabets as $letter) {

                $html .= "<td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>=SUM(" . $letter . $numbers[$begin] . ":" . $letter . $numbers[$finish] . ")</td>";
            }
            $html .= "</tr>";
            $distnum++;
            $begin += 2;
            $finish += 2;
        }

        $html .= "</table>";

        $html = '<html xmlns:o="urn:schemas-microsoft-com:office:office"
        xmlns:x="urn:schemas-microsoft-com:office:excel"
        xmlns="http://www.w3.org/TR/REC-html40">'
            . '<head><meta http-equiv="Content-type" content="text/html;charset=UTF-8" /></head>'
            . '<body>' . $html . '</body></html>';

        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=minor_crimes.xls');
        echo $html;
    }

    // Ongoing crime download
    if (isset($_POST['ongoing_case_download'])) {
        $output_ongoing_cases = $_SESSION['ongoing_cases'];
        $html = "<table style='border:1px solid black; border-collapse: collapse; vertical-align:middle;'>
                    <tr>
                        <th colspan=10 center style='font-size: 42px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; height:70px;'>सक्रिय मामला| $text </th>
                    </tr>
                    <tr>
                        <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>क्र.</th>
                        <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>ज़िला</th>
                        <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>पुलिस<br>थाना</th>
                        <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>अपराध<br>क्रमांक</th>
                        <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>धारा</th>
                        <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>एफ.आई.आर.<br>का दिनाक</th>
                        <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>आरोपी / संदिग्ध का<br>नाम व पता</th>
                        <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>प्ररण की<br>अद्यतन स्थिति</th>
                        <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>न्यायालय का नाम</th>
                        <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>न्यायालय के फैसले<br>का संक्षिप्त विवरण</th>
    
                    </tr>";
        $i = 1;
        foreach ($output_ongoing_cases as $ongoingcase) {
            foreach ($ongoingcase as $row) {
                $html .= "<tr>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $i++ . "
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['district'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['police_station'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['crime_number'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['penal_code'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['fir_date'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['culprit_name'] . " " . $row['culprit_address'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['case_status'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['name_of_court'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['judgement_of_court'] . " 
                            </td>
                        </tr>";
            }
        }

        $html .= "</table>";

        $html = '<html xmlns:o="urn:schemas-microsoft-com:office:office"
        xmlns:x="urn:schemas-microsoft-com:office:excel"
        xmlns="http://www.w3.org/TR/REC-html40">'
            . '<head><meta http-equiv="Content-type" content="text/html;charset=UTF-8" /></head>'
            . '<body>' . $html . '</body></html>';

        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=ongoing_cases.xls');
        echo $html;
    }

    // Dead body download
    if (isset($_POST['dead_body_download'])) {
        $output_dead_bodies = $_SESSION['dead_bodies'];
        $districts = get_districts();
        $html = "<table style='vertical-align:middle;'>";
        foreach ($districts as $dist) {
            $distt = $dist['district'];

            $html .= "<tr>
                        <th colspan=11 center style='font-size: 40px; border:1px solid black; border-collapse: collapse; vertical-align:middle; height:75px;'>$distt के समस्त मर्ग की जानकारी | $text </th>
                    </tr>
                    <tr>
                    <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:45;'>क्र.</th>
                    <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:160px'>पुलिस थाना</th>
                    <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:90px;'>मर्ग क्रमांक</th>
                    <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:80px;'>धारा</th>
                    <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:190px;'>घटना दिनांक व समय</th>
                    <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:130px;'>घटना स्थान</th>
                    <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:190px;'>सूचना दिनांक व समय</th>
                    <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:240px;'>प्रार्थी</th>
                    <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:190px;'>मृतक/मृतिका का नाम</th>
                    <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:220px;'>कायमीकर्ता का नाम</th>
                    <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:300px;'>सबब मौत</th>
                    </tr>";
            $i = 1;
            $found_bodies = false;
            foreach ($output_dead_bodies as $deadbody) {
                foreach ($deadbody as $row) {
                    if ($row['district'] == $distt) {
                        $found_bodies = true;
                        $html .= "<tr>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; min-height: 50px;'>
                                " . $i++ . "
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; min-height: 50px;'>
                                " . $row['police_station'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; min-height: 50px;'>
                                " . $row['dead_body_number'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; min-height: 50px;'>
                                " . $row['penal_code'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; min-height: 50px;'>
                            " . $row['accident_date'] . " " . $row['accident_time'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; min-height: 50px;'>
                                " . $row['accident_place'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; min-height: 50px;'>
                                " . $row['information_date'] . " " . $row['information_time'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; min-height: 50px;'>
                                " . $row['applicant_name'] . "
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; min-height: 50px;'>
                                " . $row['deceased_name'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; min-height: 50px;'>
                                " . $row['fir_writer'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; min-height: 50px;'>
                                " . $row['cause_of_death'] . " 
                            </td>
                        </tr>";
                    }
                }
            }
            if (!($found_bodies)) {
                $html .= "<tr style='height: 40px;'>
                        <td colspan=11 style=' height:50px; font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            निरंक
                        </td>
                    </tr>
                    ";
            }
            $html .= "<tr style='height: 40px;'><td colspan=11 style='border:1px solid black; border-collapse: collapse;'></td></tr>";
        }

        $html .= "</table>";

        $html = '<html xmlns:o="urn:schemas-microsoft-com:office:office"
        xmlns:x="urn:schemas-microsoft-com:office:excel"
        xmlns="http://www.w3.org/TR/REC-html40">'
            . '<head><meta http-equiv="Content-type" content="text/html;charset=UTF-8" /></head>'
            . '<body>' . $html . '</body></html>';

        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=dead_bodies.xls');
        echo $html;
    }

    // Important achievement download
    if (isset($_POST['important_achievement_download'])) {
        $output_important_achievements = $_SESSION['important_achievements'];
        $districts = get_districts();
        $html = "<table style='vertical-align:middle;'>
                <tr>
                    <th colspan=8 center style='font-size: 42px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; height:75px;'>महत्पूर्ण कार्यवाहिया / उपलब्धियां | $text</th>
                </tr>
                <tr style='height:240px;'>
                    <th style='font-size: 26px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:45px;'>क्र.</th>
                    <th style='font-size: 26px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:150px;'>थाना/चौकी</th>
                    <th style='font-size: 26px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:500px;'>गंभीर अपराधों में गिरफ्तारि / महत्वपूर्ण गिरफ्तारि</th>
                    <th style='font-size: 26px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:170px;'>कोर्ट द्वारा दिए गये निर्णय (दोषमुक्त / सजा / जमानत /रद्द)</th>
                    <th style='font-size: 26px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:300px;'>आपरेशन मुस्कान / गुम इंसान दस्तायी</th>
                    <th style='font-size: 26px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:120px'>डकैती / लुट / चोरी का खुलासा</th>
                    <th style='font-size: 26px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:270px;'>विविध जैसे जन जागरुकता अभियान मे विशेष सफलता या प्राण रक्षा,गिरफ्तारी वारंटो की तमिलि आदि</th>
                    <th style='font-size: 26px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:200px;'>धारा 102 के तहत कि गई कार्यवाही</th>
                </tr>";
        foreach ($districts as $dist) {
            $distt = $dist['district'];
            $html .= "<tr>
                        <th colspan=8 style='font-size: 30px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; height:45px'>" . $distt . "</th>
                    </tr>";
            $i = 1;
            $found_achievements = false;
            foreach ($output_important_achievements as $impaction) {
                foreach ($impaction as $row) {
                    if ($row['district'] == $distt) {
                        $found_achievements = true;
                        $html .= "<tr>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $i++ . "
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['police_station'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['arrest_in_major_crime'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['decision_given_by_the_court'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['missing_man_document'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['robbery'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['miscellaneous'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['action_taken_under'] . " 
                            </td>
                        </tr>";
                    }
                }
            }
            if (!($found_achievements)) {
                $html .= "<tr>
                        <td colspan=8 style=' height:50px; font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            निरंक
                        </td>
                    </tr>
                    ";
            }
            $html .= "<tr><td colspan=8></td></tr>";
        }

        $html .= "</table>";

        $html = '<html xmlns:o="urn:schemas-microsoft-com:office:office"
        xmlns:x="urn:schemas-microsoft-com:office:excel"
        xmlns="http://www.w3.org/TR/REC-html40">'
            . '<head><meta http-equiv="Content-type" content="text/html;charset=UTF-8" /></head>'
            . '<body>' . $html . '</body></html>';

        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=important_achievements.xls');
        echo $html;
    }

    // Court Judgment download
    if (isset($_POST['court_judgement_download'])) {
        $output_court_judgements = $_SESSION['court_judgements'];
        $districts = get_districts();
        $html = "<table style='vertical-align:middle;'>";

        $html .= "<tr>
                        <th colspan=9 center style='font-size: 40px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; height:75;'>कोर्ट के निर्णय | $text </th>
                    </tr>
                    <tr style='height:100px'>
                        <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:45px;'>क्र.</th>
                        <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:200px;'>थाना/चौकी</th>
                        <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:250px;'>कोर्ट का नाम</th>
                        <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:100px'>अप. क्र.</th>
                        <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:250px;'>धारा</th>
                        <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:200px;'>कायमी दिनांक</th>
                        <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:330px;'>आरोपी का नाम व पता</th>
                        <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:135px;'>दिनांक</th>
                        <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:200px;'>निर्णय</th>
                    </tr>";
        foreach ($districts as $dist) {
            $distt = $dist['district'];
            $i = 1;
            $html .= "<tr>
                        <th colspan=9 style='font-size: 30px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; height:45px'>" . $distt . "</th>
                    </tr>";
            $found_judgements = false;
            foreach ($output_court_judgements as $judgement) {
                foreach ($judgement as $row) {
                    if ($row['district'] == $distt) {
                        $found_judgements = true;
                        $html .= "<tr>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $i++ . "
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['police_station'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['court_name'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['crime_number'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['penal_code'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['result_date'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['culprit_name'] . " " . $row['culprit_address'] . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . (new DateTime($row['updated_at']))->format('Y-m-d') . " 
                            </td>
                            <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                                " . $row['judgement_of_court'] . " 
                            </td>
                        </tr>";
                    }
                }
            }
            if (!($found_judgements)) {
                $html .= "<tr>
                <td colspan=9 style=' height:50px; font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                    निरंक
                </td>
            </tr>
            ";
            }
            $html .= "<tr><td colspan=9></td></tr>";
        }

        $html .= "</table>";

        $html = '<html xmlns:o="urn:schemas-microsoft-com:office:office"
        xmlns:x="urn:schemas-microsoft-com:office:excel"
        xmlns="http://www.w3.org/TR/REC-html40">'
            . '<head><meta http-equiv="Content-type" content="text/html;charset=UTF-8" /></head>'
            . '<body>' . $html . '</body></html>';

        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=court_judgements.xls');
        echo $html;
    }

    // <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle;'>
    //                             " . $row['sub_division'] . " 
    //                         </td>

} elseif ($doc_format == "pdf") {

    // Downloading specific data
    if ($document == "Summary") {
        $data = array();
        $data['murder_count'] = count_murder_cases($date,$district);
        $data['gangrape_count'] = count_gangrape_cases($date,$district);
        $data['rape_count'] = count_rape_cases($date, $district);
        $data['dhara363_count'] = count_ipc_363_cases($date, $district);
        // $data['narbali_prakaran'] = count_narbali_prakaran($date, $district);
        $data['dacoity_count'] = count_dacoity_cases($date, $district);
        $data['robbery_count'] = count_robbery_cases($date, $district);
        $data['kidnap_for_ransom_count'] = count_kidnap_for_ransom_cases($date, $district);

        $minor_penal_codes = get_penal_codes('Minor-Act');
        $restricted_penal_codes = get_penal_codes('Restricted');
        foreach ($minor_penal_codes as $penal_code) {
            $data[$penal_code['penal_code']] = count_cases($date, $district, $penal_code['penal_code']);
        }
        foreach ($restricted_penal_codes as $penal_code){
            $data[$penal_code['penal_code']] = count_cases($date, $district, $penal_code['penal_code']);
        }

        $total = sum_elements($data);
        $data['total'] = $total; 
        $pdf = summary_pdf($date, $district, $data);
        echo $pdf;

    } elseif ($document == "MinorCrime") {
        $data['crime_sum'] = get_minor_crimes($date,$district);
        $data['penal_codes'] = array_merge(get_penal_codes('Minor-Act'), get_penal_codes('Restricted'));
        $pdf = minor_crime_pdf($date, $district, $data);
        echo $pdf;

    } elseif ($document == "MajorCrime") {
        $data['major_crimes'] = get_major_crimes($date,$district);
        $pdf = major_crime_pdf($date, $district, $data);
        echo $pdf;

    } elseif ($document == "Crime") {
        $data['crimes'] = get_crimes($date,$district);
        $pdf = crime_pdf($date, $district, $data);
        echo $pdf;

    } elseif ($document == "Deadbody") {
        $data['deadbodies'] = get_dead_bodies($date,$district);
        $pdf = deadbody_pdf($date, $district, $data);
        echo $pdf;

    } elseif ($document == "Achievement") {
        $data['achievements'] = get_important_achievements($date,$district);
        $pdf = achievements_pdf($date, $district, $data);
        echo $pdf;

    } elseif ($document == "Judgement") {
        $data['judgements'] = get_court_judgements($date,$district);
        $pdf = judgements_pdf($date, $district, $data);
        echo $pdf;

    } elseif ($document == "Application") {

        $data = array();
        $data['gangrape_count'] = count_gangrape_cases($date,$district);
        // $data['narbali_prakaran'] = count_narbali_prakaran($date, $district);
        $data['dacoity_count'] = count_dacoity_cases($date, $district);
        $data['robbery_count'] = count_robbery_cases($date, $district);
        $data['kidnap_for_ransom_count'] = count_kidnap_for_ransom_cases($date, $district);

        $restricted_penal_codes = get_penal_codes('Restricted');
        $rdata = array();
        foreach ($restricted_penal_codes as $penal_code){
            $rdata[$penal_code['penal_code']] = count_cases($date, $district, $penal_code['penal_code']);
        }

        $data['restricted_cases_count'] = sum_elements($rdata);; 
        $pdf = application_pdf($date, $district, $data);
        echo $pdf;

    } elseif ($document == "Disposal") {

    }
    // Condition when All is selected
    else {

    }

}
?>

<!-- <th style='border:1px solid black; border-collapse: collapse; vertical-align:middle;'>अनुभाग</th> -->