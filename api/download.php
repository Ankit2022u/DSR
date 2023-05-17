<?php
session_start();
require "dbcon.php";
require "functions.php";
$start_date = $_SESSION['start_date'];
$end_date = $_SESSION['end_date'];
if($start_date == $end_date){
    $text = $start_date;
}
else{
    $text = $start_date." - ".$end_date;
}

// Major crime download
if (isset($_POST['major_crime_download'])) {
    $output_major_crimes = $_SESSION['major_crimes'];
    $html = "<table style='border:1px solid black; border-collapse: collapse;'>
                <tr>
                    <th colspan=14 center style=' font-size: 40px; border:1px solid black; border-collapse: collapse;' >समस्त अपराधो की जानकारी | $text </th>
                </tr>
                <tr>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>क्रमांक</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>ज़िला</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>पुलिस थाना</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>अपराध क्रमांक</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>धारा</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>प्रार्थी का नाम व पता</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>घटना दिनांक व समय</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>घटना स्थल</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>सूचना दिनाक व समय</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>कायमीकर्ता</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>आरोपी/संदिग्ध का नाम व पता</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>गिरफ्तारी दिनाक व समय</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>मृतक - मृतिका / आहत - आहता / पीड़ित - पीड़िता का नाम</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>विवरण</th>
                </tr>";
    $i = 1;
    foreach ($output_major_crimes as $majorcrime) {
        foreach ($majorcrime as $row) {
            if ($row['is_major_crime']) {
                $victim_name = "";
            } else {
                $victim_name = $row['victim_name'];
            }
            $html .= "<tr>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $i++ . "
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['district'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['police_station'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['crime_number'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['penal_code'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['applicant_name'] . " | " . $row['applicant_address'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['incident_date'] . " | " . $row['incident_time'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['incident_place'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['reporting_date'] . " | " . $row['reporting_time'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['fir_writer'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['culprit_name'] . " | " . $row['culprit_address'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['arrest_date'] . " | " . $row['arrest_time'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $victim_name . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['description_of_crime'] . " 
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
    header('Content-Disposition: attachment; filename=major_crimes.xls');
    echo $html;
}

// Minor crime download
if (isset($_POST['minor_crime_download'])) {
    $output_minor_crimes = $_SESSION['minor_crimes'];
    $districts = get_districts();
    $top_row = ["41(1) जा. फौ", "102 जा. फौ", "109 जा. फौ", "110 जा. फौ", "145 जा. फौ", "151 जा. फौ", "107,116 जा. फौ", "सट्टा", "जुआ एक्ट", "आव. एक्ट", "नारको", "आर्म्स. एक्ट", "एम. वी. एक्ट"];

    $html = "<table style='font-size: 40px;border:1px solid black; border-collapse: collapse;'>";
    $html.= "<tr><th colspan=28 style='border:1px solid black; border-collapse: collapse;'>दैनिक प्रतिवेदन प्रतिबंधात्मकता कार्यवाही/लघु अधिनियम रेंज सरगुजा जिला सरगुजा | $text</th></tr>";
    foreach ($districts as $dist) {

        $html .= "<tr>
                    <th colspan=28 style='font-size: 30font-size: 24px;px;border:1px solid black; border-collapse: collapse;'>" . $dist['district'] . "</th>
                </tr>
                <tr>        
                    <th rowspan=2 style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>क्रमांक</th>
                    <th rowspan=2 style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>पुलिस थाना</th>";
        foreach ($top_row as $cols) {
            $html .= "<th colspan=2 style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>" . $cols . "</th>";
        }

        $html .= "</tr>";
        $x = 1;
        $html .= "<tr>";
        for ($i = 1; $i <= 13; $i++) {
            $html .= "<td style='border:1px solid black; border-collapse: collapse;'>प्र.</td><td style='border:1px solid black; border-collapse: collapse;'>व्य.</td>";
        }
        $html .= "</tr>";
        $substations = get_sub_divisions($dist['district']);
        foreach ($substations as $sub) {
            $stations = get_police_stations($dist['district'], $sub['sub_division']);
            foreach ($stations as $ps) {
                $html .= "<tr><td style='border:1px solid black; border-collapse: collapse;'>" . $x++ . "</td>";
                $html .= "<td style='border:1px solid black; border-collapse: collapse;'>" . $ps['police_station'] . "</td>";
                foreach ($top_row as $act) {
                    $cases = get_acts_count($_SESSION['start_date'], $_SESSION['end_date'], $act, $ps['police_station']);
                    if (($cases != false) and $cases['case_count'] >= 1) {
                        $html .= "<td>" . $cases['case_count'] . "</td>";
                        $html .= "<td>" . $cases['people_count'] . "</td>";

                    } else {
                        $html .= "<td style='border:1px solid black; border-collapse: collapse;'></td><td style='border:1px solid black; border-collapse: collapse;'></td>";
                    }
                }
                $html .= "</tr>";
            }
        }
        $html.="<tr><td style='border:1px solid black; border-collapse: collapse;'></td><td style='border:1px solid black; border-collapse: collapse;'>योग</td></tr>";
        
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
    $html = "<table style='border:1px solid black; border-collapse: collapse;'>
                <tr>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>क्रमांक</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>ज़िला</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>पुलिस थाना</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>अपराध क्रमांक</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>धारा</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>एफ.आई.आर. का दिनाक</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>आरोपी/संदिग्ध का नाम व पता</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>प्ररण की अद्यतन स्थिति</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>न्यायालय का नाम</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse;'>न्यायालय के फैसले का संक्षिप्त विवरण</th>
                </tr>";
    $i = 1;
    foreach ($output_ongoing_cases as $ongoingcase) {
        foreach ($ongoingcase as $row) {
            $html .= "<tr>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $i++ . "
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['district'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['police_station'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['crime_number'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['penal_code'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['fir_date'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['culprit_name'] . " | " . $row['culprit_address'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['case_status'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['name_of_court'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
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

    $html = "<table style='border:1px solid black; border-collapse: collapse;'>
                <tr>
                    <th colspan=13 center style='font-size: 40px; border:1px solid black; border-collapse: collapse;'>समस्त मर्ग की जानकारी | $text </th>
                </tr>
                <tr>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>ज़िला</th>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>क्रमांक</th>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>पुलिस थाना</th>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>मर्ग क्रमांक</th>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>धारा</th>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>घटना दिनांक व समय</th>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>घटना स्थान</th>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>सूचना दिनांक व समय</th>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>प्रार्थी</th>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>मृतक/मृतिका का नाम</th>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>कायमीकर्ता का नाम</th>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>सबब मौत</th>
                </tr>";
    $i = 1;
    foreach ($output_dead_bodies as $deadbody) {
        foreach ($deadbody as $row) {
            $html .= "<tr>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $i++ . "
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['district'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['police_station'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['dead_body_number'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['penal_code'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                        " . $row['accident_date'] . " | " . $row['accident_time'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['accident_place'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['information_date'] . " | " . $row['information_time'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['applicant_name'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['deceased_name'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['fir_writer'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['cause_of_death'] . " 
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
    header('Content-Disposition: attachment; filename=dead_bodies.xls');
    echo $html;
}

// Important achievement download
if (isset($_POST['important_achievement_download'])) {
    $output_important_achievements = $_SESSION['important_achievements'];

    $html = "<table style='border:1px solid black; border-collapse: collapse;'>
                <tr>
                    <th colspan=10 center style='font-size: 40px; border:1px solid black; border-collapse: collapse;'>महत्पूर्ण कार्यवाहिया / उपलब्धियां | $text</th>
                </tr>
                <tr>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>क्रमांक</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>ज़िला</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>थाना/चौकी</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>गंभीर अपराधों में गिरफ्तारि / महत्वपूर्ण गिरफ्तारि</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>कोर्ट द्वारा दिए गये निर्णय (दोषमुक्त / सजा / जमानत /
                    रद्द)</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>आपरेशन मुस्कान / गुम इंसान दस्तायी</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>डकैती / लुट / चोरी का खुलासा</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>विविध जैसे जन जागरुकता अभियान मे विशेष सफलता या प्राण रक्षा,गिरफ्तारी वारंटो की तमिलि आदि</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>धारा 102 के तहत कि गई कार्यवाही</th>
                </tr>";
    $i = 1;
    foreach ($output_important_achievements as $impaction) {
        foreach ($impaction as $row) {
            $html .= "<tr>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $i++ . "
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['district'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['police_station'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['arrest_in_major_crime'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['decision_given_by_the_court'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                        " . $row['missing_man_document'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['robbery'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['miscellaneous'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['action_taken_under'] . " 
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
    header('Content-Disposition: attachment; filename=important_achievements.xls');
    echo $html;
}

// Court Judgment download
if (isset($_POST['court_judgement_download'])) {
    $output_court_judgements = $_SESSION['court_judgements'];

    $html = "<table style='border:1px solid black; border-collapse: collapse;'>
                <tr>
                    <th colspan=11 center style='font-size: 40px; border:1px solid black; border-collapse: collapse;'>कोर्ट का निर्णय | $text </th>
                </tr>
                <tr>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>क्रमांक</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>ज़िला</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>थाना/चौकी</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>कोर्ट का नाम</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>अपराध क्रमांक</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>धारा</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>कायमी दिनांक</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>आरोपी का नाम व पता</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>दिनांक</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse;'>निर्णय</th>
                </tr>";
    $i = 1;
    foreach ($output_court_judgements as $impaction) {
        foreach ($impaction as $row) {
            $html .= "<tr>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $i++ . "
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['district'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['police_station'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['court_name'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['crime_number'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                        " . $row['penal_code'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                        " . $row['result_date'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . $row['culprit_name'] . " | " . $row['culprit_address'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
                            " . (new DateTime($row['updated_at']))->format('Y-m-d') . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse;'>
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
    header('Content-Disposition: attachment; filename=court_judgements.xls');
    echo $html;
}

// <td style='border:1px solid black; border-collapse: collapse;'>
//                             " . $row['sub_division'] . " 
//                         </td>
?>

<!-- <th style='border:1px solid black; border-collapse: collapse;'>अनुभाग</th> -->