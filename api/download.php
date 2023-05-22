<?php
session_start();
require "dbcon.php";
require "functions.php";

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

        $script = "<script src='https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js'></script>
        <script>
            function downloadpdf() {
                const data = document.getElementById('data');
                const options = {
                    margin: [0, 0, 0, 0],
                    filename: 'Summary-".$district." (".$date.").pdf',
                    image: { type: 'jpeg', quality: 1 },
                    html2canvas: { scale: 5 },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' };
                html2pdf().set(options).from(data).save();
            }
        </script>";

        $html='<h1 style="font-size: 19px; text-align: center; font-weight: 600;">दैनिक
        प्रतिवेदन दिनांक '.$date.'</h1>
    <pre style="margin: 0px; padding:0px;">
प्रति,
    पुलिस महानिदेशक
    अ०अ०वि० पुमु० .
    नया रायपुर छ०ग०

कृप्यारेंज पुलिस महा निरीक्षक सरगुजा के दैनिक प्रतिवेदन दिनांक की जानकारी निम्नानुसार है:-</pre>
    <table>
        <thead>
            <tr>
                <th
                    style="padding: 2px 10px;">क्र०</th>
                <th style="padding: 2px 10px;">अपराध
                    शीर्ष</th>
                <th style="padding: 2px 10px;">प्रकरण
                    संख्या</th>
                <th style="padding: 2px 10px;">आरोपियों
                    की संख्या</th>
                <th style="padding: 2px 10px;">गिरफ्तार
                    आरोपियों की संख्या</th>
                <th style="padding: 2px 15px;">अन्य</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row">1</td>
                <td class="notcenter">हत्या</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td scope="row">2</td>
                <td class="notcenter">सामूहिक बलात्कार</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td scope="row">3</td>
                <td class="notcenter">बलात्कार</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td scope="row">4</td>
                <td class="notcenter">धारा 363 भा०द०वि०</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td scope="row">5</td>
                <td class="notcenter">नरबलि प्रकरण</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td scope="row">6</td>
                <td class="notcenter">डकैती</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td scope="row">7</td>
                <td class="notcenter">लूट</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td scope="row">8</td>
                <td class="notcenter">फिरौती हेतु अपहरण</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td scope="row">9</td>
                <td class="notcenter">महत्वपूर्ण नक्सली अपराध</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td scope="row">10</td>
                <td class="notcenter">पुलिस कर्मचारियों पर हत्या हमला</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr> <th colspan="6" class="notcenter">लघु अधिनियम :-</th>
            </tr>
            <tr>
                <td scope="row">11</td>
                <td class="notcenter">आबकारी एक्ट</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td scope="row">12</td>
                <td class="notcenter">जुआ</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td scope="row">10</td>
                <td class="notcenter">पुलिस कर्मचारियों पर हत्या हमला</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr><tr>
                <td scope="row">13</td>
                <td class="notcenter">आर्म्स एक्ट</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td scope="row">14</td>
                <td class="notcenter">नारकोटिक्स एक्ट</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td scope="row">15</td>
                <td class="notcenter">सट्टा</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td scope="row">16</td>
                <td class="notcenter">मोटरयान अधिनियम</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr> <th colspan="6" class="notcenter">प्रतिबंधात्मक
                    कार्यवाही :-</th> </tr>

            <tr>
                <td scope="row">17</td>
                <td class="notcenter">धारा 41(1) जा०फौ०</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td scope="row">18</td>
                <td class="notcenter">धारा 41(2) जा०फौ०</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td scope="row">19</td>
                <td class="notcenter">धारा 109 जा०फौ०</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td scope="row">20</td>
                <td class="notcenter">धारा 110 जा०फौ०</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td scope="row">21</td>
                <td class="notcenter">धारा 151 जा०फौ०</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td scope="row">22</td>
                <td class="notcenter">धारा 107,116(3) जा०फौ०</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td scope="row">23</td>
                <td class="notcenter">धारा 145 जा०फौ०</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td scope="row">24</td>
                <td class="notcenter">धारा 102 जा०फौ०</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td scope="row">25</td>
                <td class="notcenter">जिला बदर</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td scope="row">26</td>
                <td class="notcenter">रा०सु०का०</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td scope="row"></td>
                <td class="notcenter">योग</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td scope="row" class="notcenter">योग</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <pre style="margin-top: 3px; padding: 0px;">
प्रतिलिपि:-
01.आईजी रेंज                                                            प्रभारी
सरगुजा                                                            कंट्रोल रूम रेंज सरगुजा
                                                                      

    </pre>';

        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>DSR PDF</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
            <style>
                td, th{
                    border: 1px solid black;
                    text-align: center;
                }
                .notcenter{
                    text-align: start;
                }
                *{
                    font-size: 14px;
                }
            </style>
            '.$script.'
        </head>
        <body>
        <button class="bn btn-success" onclick="downloadpdf()">Print</button>
        <div class="main" style="padding:15mm 18mm 30mm 13mm; width: 210mm; height:297mm" id="data">'.$html.'</div>
        </body>
        </html>';

    } elseif ($document == "MinorCrime") {

    } elseif ($document == "MajorCrime") {

    } elseif ($document == "Crime") {

    } elseif ($document == "Deadbody") {

    } elseif ($document == "Achievement") {

    } elseif ($document == "Disposal") {

    } elseif ($document == "Judgement") {

    }
    // Condition when All is selected
    else {

    }

}
?>

<!-- <th style='border:1px solid black; border-collapse: collapse; vertical-align:middle;'>अनुभाग</th> -->