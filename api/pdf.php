<?php
session_start();
require "dbcon.php";
require "functions.php";
$start_date = $_SESSION['start_date'];
$end_date = $_SESSION['end_date'];
if ($start_date == $end_date) {
    $text = $start_date;
} else {
    $text = $start_date . " - " . $end_date;
}

$script = "<script
src='https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js'></script>
<script>
function downloadPDF() {
const major = document.getElementById('major');
const minor = document.getElementById('minor');
const dead = document.getElementById('dead');
const imp = document.getElementById('imp');
const court = document.getElementById('court');
const ongoing = document.getElementById('ongoing');


    const major_opt = {
        margin: [0, 0, 0, 0],
        filename: 'Major Crime.pdf',
        image: { type: 'jpeg', quality: 1 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
        };

    const minor_opt = {
        margin: [0, 0, 0, 0],
        filename: 'Minor Crime.pdf',
        image: { type: 'jpeg', quality: 1 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
        };

    const dead_opt = {
        margin: [0, 0, 0, 0],
        filename: 'Dead Bodies.pdf',
        image: { type: 'jpeg', quality: 1 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
        };

    const imp_opt = {
        margin: [0, 0, 0, 0],
        filename: 'Important Achievement.pdf',
        image: { type: 'jpeg', quality: 1 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
        };

    const ongoing_opt = {
        margin: [0, 0, 0, 0],
        filename: 'Ongoing Cases.pdf',
        image: { type: 'jpeg', quality: 1 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
        };

    const court_opt = {
        margin: [0, 0, 0, 0],
        filename: 'Court Judgement.pdf',
        image: { type: 'jpeg', quality: 1 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
        };

html2pdf().set(major_opt).from(major).save();
html2pdf().set(minor_opt).from(minor).save();
html2pdf().set(dead_opt).from(dead).save();
html2pdf().set(imp_opt).from(imp).save();
html2pdf().set(court_opt).from(court).save();
html2pdf().set(ongoing_opt).from(ongoing).save();
}
</script>";

// Major crime download

$mhtml = "";
$output_major_crimes = $_SESSION['major_crimes'];
$districts = get_districts();
$mhtml .= "<table style='vertical-align:middle; margin:5px auto;' width='1050px' cellpadding='0' cellspacing='0' id='major'>";
foreach ($districts as $dist) {
    $distt = $dist['district'];
    $mhtml .= "<tr>
                    <th colspan=13 center style='font-size: 18px; border:0px solid black; border-collapse: collapse; height:75px; vertical-align:middle; text-align:center;'>$distt के समस्त अपराधो की जानकारी | $text </th>
                </tr>
                <tr>
                    <th style='font-size: 16px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:45px;'>क्र.</th>
                    <th style='font-size: 16px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:90px;'>पुलिस थाना</th>
                    <th style='font-size: 16px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:80px;'>अ.क्र.</th>
                    <th style='font-size: 16px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:80px;'>धारा</th>
                    <th style='font-size: 16px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:160px;'>प्रार्थी का नाम व पता</th>
                    <th style='font-size: 16px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:190px;'>घटना दिनांक व समय</th>
                    <th style='font-size: 16px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:130px;'>घटना स्थल</th>
                    <th style='font-size: 16px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:190px;'>सूचना दिनाक व समय</th>
                    <th style='font-size: 16px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:150px;'>कायमीकर्ता</th>
                    <th style='font-size: 16px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:160px;'>आरोपी / संदिग्ध का नाम व पता</th>
                    <th style='font-size: 16px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:190px;'>गिरफ्तारी दिनाक व समय</th>
                    <th style='font-size: 16px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:120px;'>मृतक - मृतिका / आहत - आहता / पीड़ित - पीड़िता का नाम</th>
                    <th style='font-size: 16px;border:1px solid black; border-collapse: collapse; vertical-align:middle; vertical-align:middle; text-align:center; width:225px'>विवरण</th>
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
                $mhtml .= "<tr>
                        <td style='font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $i++ . "
                        </td>
                        <td style='font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['police_station'] . " 
                        </td>
                        <td style='font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['crime_number'] . " 
                        </td>
                        <td style='font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['penal_code'] . " 
                        </td>
                        <td style='font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['applicant_name'] . " " . $row['applicant_address'] . " 
                        </td>
                        <td style='font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['incident_date'] . " " . $row['incident_time'] . " 
                        </td>
                        <td style='font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['incident_place'] . " 
                        </td>
                        <td style='font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['reporting_date'] . " " . $row['reporting_time'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['fir_writer'] . " 
                        </td>
                        <td style='font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['culprit_name'] . " " . $row['culprit_address'] . " 
                        </td>
                        <td style='font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['arrest_date'] . " " . $row['arrest_time'] . " 
                        </td>
                        <td style='font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $victim_name . " 
                        </td>
                        <td style='font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['description_of_crime'] . " 
                        </td>
                    </tr>";
            }
        }
    }
    if (!($found_crimes)) {
        $mhtml .= "<tr>
                    <td colspan=13 style=' height:50px; font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                        निरंक
                    </td>
                </tr>
                ";
    }
    $mhtml .= "<tr><td colspan=13 style='border:1px solid black; border-collapse: collapse;'></td></tr>";
}

$mhtml .= "</table>";




// Minor crime download

$mihtml = "";
$output_minor_crimes = $_SESSION['minor_crimes'];
$districts = get_districts();
$top_row = ["41(1) जा. फौ", "102 जा. फौ", "109 जा. फौ", "110 जा. फौ", "145 जा. फौ", "151 जा. फौ", "107,116 जा. फौ", "सट्टा", "जुआ एक्ट", "आव. एक्ट", "नारको", "आर्म्स. एक्ट", "एम. वी. एक्ट"];

$mihtml .= "<table width='1050px' cellpadding='0' cellspacing='0' style='margin:5px auto; vertical-align:middle;' id='minor'>";
$mihtml .= "<tr><th colspan=28 style='height:55px; font-size: 18px;  border:1px solid black; border-collapse: collapse; vertical-align:middle;'>दैनिक प्रतिवेदन प्रतिबंधात्मकता कार्यवाही/लघु अधिनियम रेंज सरगुजा जिला सरगुजा | $text</th></tr>";
$distnum = 1;
$begin = 0;
$finish = 1;
$numbers = ["5", "16", "21", "31", "36", "48", "53", "58", "63", "74", "79", "94"];
foreach ($districts as $dist) {

    $mihtml .= "<tr>
                    <th colspan=28 style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; height:45px'>" . $dist['district'] . "</th>
                </tr>
                <tr>        
                    <th rowspan=2 style='font-size: 16px;border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:45px;'>क्र.</th>
                    <th rowspan=2 style='font-size: 16px;border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:125px'>पुलिस थाना</th>";
    foreach ($top_row as $cols) {
        $mihtml .= "<th colspan=2 style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>" . $cols . "</th>";
    }

    $mihtml .= "</tr>";
    $x = 1;
    $mihtml .= "<tr>";
    for ($i = 1; $i <= 13; $i++) {
        $mihtml .= "<td style=' font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>प्र.</td><td style=' font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>व्य.</td>";
    }
    $mihtml .= "</tr>";
    $substations = get_sub_divisions($dist['district']);
    foreach ($substations as $sub) {
        $stations = get_police_stations($dist['district'], $sub['sub_division']);
        foreach ($stations as $ps) {
            $mihtml .= "<tr><td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>" . $x++ . "</td>";
            $mihtml .= "<td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>" . $ps['police_station'] . "</td>";
            foreach ($top_row as $act) {
                $cases = get_acts_count($_SESSION['start_date'], $_SESSION['end_date'], $act, $ps['police_station']);
                if (($cases != false) and $cases['case_count'] >= 1) {
                    $mihtml .= "<td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>" . $cases['case_count'] . "</td>";
                    $mihtml .= "<td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>" . $cases['people_count'] . "</td>";
                } else {
                    $mihtml .= "<td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'></td><td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'></td>";
                }
            }
            $mihtml .= "</tr>";
        }
    }
    $alphabets = ["C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB"];
    $mihtml .= "<tr>
                    <td colspan=2 style='font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>योग</td>";
    foreach ($alphabets as $letter) {

        $mihtml .= "<td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>=SUM(" . $letter . $numbers[$begin] . ":" . $letter . $numbers[$finish] . ")</td>";
    }
    $mihtml .= "</tr>";
    $distnum++;
    $begin += 2;
    $finish += 2;
}

$mihtml .= "</table>";




// Ongoing crime download
$output_ongoing_cases = $_SESSION['ongoing_cases'];
$ohtml = "<table width='1050px' cellpadding='0' cellspacing='0' style='margin:5px auto; vertical-align:middle;' id='ongoing'>
                <tr>
                    <th colspan=10 center style='font-size: 18px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; height:50px;' >सक्रिय मामला| $text </th>
                </tr>
                <tr>
                    <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>क्र.</th>
                    <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>ज़िला</th>
                    <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>पुलिस<br>थाना</th>
                    <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>अपराध<br>क्रमांक</th>
                    <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>धारा</th>
                    <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>एफ.आई.आर.<br>का दिनाक</th>
                    <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>आरोपी / संदिग्ध का<br>नाम व पता</th>
                    <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>प्ररण की<br>अद्यतन स्थिति</th>
                    <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>न्यायालय का नाम</th>
                    <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>न्यायालय के फैसले<br>का संक्षिप्त विवरण</th>

                </tr>";
$i = 1;
foreach ($output_ongoing_cases as $ongoingcase) {
    foreach ($ongoingcase as $row) {
        $ohtml .= "<tr>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $i++ . "
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['district'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['police_station'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['crime_number'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['penal_code'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['fir_date'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['culprit_name'] . " " . $row['culprit_address'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['case_status'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['name_of_court'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['judgement_of_court'] . " 
                        </td>
                    </tr>";
    }
}

$ohtml .= "</table>";


// Dead body download
$output_dead_bodies = $_SESSION['dead_bodies'];
$districts = get_districts();
$dhtml = "<table width='1050px' cellpadding='0' cellspacing='0' style='margin:5px auto; vertical-align:middle;' id='dead'>";
foreach ($districts as $dist) {
    $distt = $dist['district'];

    $dhtml .= "<tr>
                    <th colspan=11 center style='font-size: 18px; border:1px solid black; border-collapse: collapse; vertical-align:middle; height:55px;'>$distt के समस्त मर्ग की जानकारी | $text </th>
                </tr>
                <tr>
                <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:45;'>क्र.</th>
                <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:160px'>पुलिस थाना</th>
                <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:90px;'>मर्ग क्रमांक</th>
                <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:80px;'>धारा</th>
                <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:190px;'>घटना दिनांक व समय</th>
                <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:130px;'>घटना स्थान</th>
                <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:190px;'>सूचना दिनांक व समय</th>
                <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:240px;'>प्रार्थी</th>
                <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:190px;'>मृतक/मृतिका का नाम</th>
                <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:220px;'>कायमीकर्ता का नाम</th>
                <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:300px;'>सबब मौत</th>
                </tr>";
    $i = 1;
    $found_bodies = false;
    foreach ($output_dead_bodies as $deadbody) {
        foreach ($deadbody as $row) {
            if ($row['district'] == $distt) {
                $found_bodies = true;
                $dhtml .= "<tr>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; min-height: 50px;'>
                            " . $i++ . "
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; min-height: 50px;'>
                            " . $row['police_station'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; min-height: 50px;'>
                            " . $row['dead_body_number'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; min-height: 50px;'>
                            " . $row['penal_code'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; min-height: 50px;'>
                        " . $row['accident_date'] . " " . $row['accident_time'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; min-height: 50px;'>
                            " . $row['accident_place'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; min-height: 50px;'>
                            " . $row['information_date'] . " " . $row['information_time'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; min-height: 50px;'>
                            " . $row['applicant_name'] . "
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; min-height: 50px;'>
                            " . $row['deceased_name'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; min-height: 50px;'>
                            " . $row['fir_writer'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; min-height: 50px;'>
                            " . $row['cause_of_death'] . " 
                        </td>
                    </tr>";
            }
        }
    }
    if (!($found_bodies)) {
        $dhtml .= "<tr style='height: 40px;'>
                    <td colspan=11 style=' height:50px; font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                        निरंक
                    </td>
                </tr>
                ";
    }
    $dhtml .= "<tr style='height: 40px;'><td colspan=11 style='border:1px solid black; border-collapse: collapse;'></td></tr>";
}

$dhtml .= "</table>";



// Important achievement download
$output_important_achievements = $_SESSION['important_achievements'];
$districts = get_districts();
$ihtml = "<table style='vertical-align:middle; margin:5px auto;' width='1050px' cellpadding='0' cellspacing='0' id='imp'>
            <tr>
                <th colspan=8 center style='font-size: 18px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; height:55px;'>महत्पूर्ण कार्यवाहिया / उपलब्धियां | $text</th>
            </tr>";
foreach ($districts as $dist) {
    $distt = $dist['district'];
    $ihtml .= "<tr>
                    <th colspan=8 style='font-size: 18px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; height:45px'>" . $distt . "</th>
                </tr>";

    $ihtml .= "<tr style='height:150px;'>
                <th style='font-size: 15px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:45px;'>क्र.</th>
                <th style='font-size: 15px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:150px;'>थाना/चौकी</th>
                <th style='font-size: 15px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:500px;'>गंभीर अपराधों में गिरफ्तारि / महत्वपूर्ण गिरफ्तारि</th>
                <th style='font-size: 15px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:170px;'>कोर्ट द्वारा दिए गये निर्णय (दोषमुक्त / सजा / जमानत /रद्द)</th>
                <th style='font-size: 15px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:300px;'>आपरेशन मुस्कान / गुम इंसान दस्तायी</th>
                <th style='font-size: 15px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:120px'>डकैती / लुट / चोरी का खुलासा</th>
                <th style='font-size: 15px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:270px;'>विविध जैसे जन जागरुकता अभियान मे विशेष सफलता या प्राण रक्षा,गिरफ्तारी वारंटो की तमिलि आदि</th>
                <th style='font-size: 15px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:200px;'>धारा 102 के तहत कि गई कार्यवाही</th>
            </tr>";
    $i = 1;
    $found_achievements = false;
    foreach ($output_important_achievements as $impaction) {
        foreach ($impaction as $row) {
            if ($row['district'] == $distt) {
                $found_achievements = true;
                $ihtml .= "<tr>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $i++ . "
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['police_station'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['arrest_in_major_crime'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['decision_given_by_the_court'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                        " . $row['missing_man_document'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['robbery'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['miscellaneous'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['action_taken_under'] . " 
                        </td>
                    </tr>";
            }
        }
    }
    if (!($found_achievements)) {
        $ihtml .= "<tr>
                    <td colspan=8 style=' height:50px; font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                        निरंक
                    </td>
                </tr>
                ";
    }
    $ihtml .= "<tr><td colspan=8></td></tr>";
}

$ihtml .= "</table>";




// Court Judgment download
$output_court_judgements = $_SESSION['court_judgements'];
$districts = get_districts();
$chtml = "<table width='1050px' cellpadding='0' cellspacing='0' style='margin:5px auto; vertical-align:middle;' id='court'>";


foreach ($districts as $dist) {
    $distt = $dist['district'];
    $i = 1;
    $chtml .= "<tr>
                <th colspan=9 center style='font-size: 18px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; height:50;'>कोर्ट के निर्णय | $text </th>
            </tr>";
    $chtml .= "<tr>
                    <th colspan=9 style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; height:45px'>" . $distt . "</th>
                </tr>";

    $chtml .= "<tr style='height:100px'>
            <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:45px;'>क्र.</th>
            <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:200px;'>थाना/चौकी</th>
            <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:250px;'>कोर्ट का नाम</th>
            <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:100px'>अप. क्र.</th>
            <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:250px;'>धारा</th>
            <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:200px;'>कायमी दिनांक</th>
            <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:330px;'>आरोपी का नाम व पता</th>
            <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:135px;'>दिनांक</th>
            <th style='font-size: 16px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:200px;'>निर्णय</th>
        </tr>";

    $found_judgements = false;
    foreach ($output_court_judgements as $judgement) {
        foreach ($judgement as $row) {
            if ($row['district'] == $distt) {
                $found_judgements = true;
                $chtml .= "<tr>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $i++ . "
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['police_station'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['court_name'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['crime_number'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                        " . $row['penal_code'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                        " . $row['result_date'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['culprit_name'] . " " . $row['culprit_address'] . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . (new DateTime($row['updated_at']))->format('Y-m-d') . " 
                        </td>
                        <td style=' font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['judgement_of_court'] . " 
                        </td>
                    </tr>";
            }
        }
    }
    if (!($found_judgements)) {
        $chtml .= "<tr>
            <td colspan=9 style=' height:50px; font-size: 14px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                निरंक
            </td>
        </tr>
        ";
    }
    $chtml .= "<tr><td colspan=9></td></tr>";
}

$chtml .= "</table>";




echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dsr pdf</title>' . $script . '
</head>
<body>
<button class="bn btn-success" onclick="downloadPDF()">Print</button>
<br>
<section id="myTable">
     ' . $mhtml . '<br>' . $mihtml . '<br>' . $ohtml . '<br>' . $dhtml . '<br>' . $ihtml . '<br>' . $chtml . '       
</section>
</body>
</html>';


// <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle;'>
//                             " . $row['sub_division'] . " 
//                         </td>
?>

<!-- <th style='border:1px solid black; border-collapse: collapse; vertical-align:middle;'>अनुभाग</th> -->