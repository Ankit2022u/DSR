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
                    <th colspan=14 center style='font-size: 40px; border:1px solid black; border-collapse: collapse; text-align:center;'>समस्त अपराधो की जानकारी | $text </th>
                </tr>
                <tr>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse; text-align:center;'>क्रमांक</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse; text-align:center;'>ज़िला</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse; text-align:center;'>पुलिस<br>थाना</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse; text-align:center;'>अपराध क्रमांक</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse; text-align:center;'>धारा</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse; text-align:center;'>प्रार्थी का नाम<br>व पता</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse; text-align:center;'>घटना दिनांक<br>व समय</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse; text-align:center;'>घटना स्थल</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse; text-align:center;'>सूचना दिनाक<br>व समय</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse; text-align:center;'>कायमीकर्ता</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse; text-align:center;'>आरोपी/संदिग्ध का<br>नाम व पता</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse; text-align:center;'>गिरफ्तारी दिनाक व समय</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse; text-align:center;'>मृतक - मृतिका /<br> आहत - आहता /<br> पीड़ित - पीड़िता का नाम</th>
                    <th style='font-size: 24px;border:1px solid black; border-collapse: collapse; text-align:center;'>विवरण</th>
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
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $i++ . "
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['district'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['police_station'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['crime_number'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['penal_code'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['applicant_name'] . " " . $row['applicant_address'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['incident_date'] . " " . $row['incident_time'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['incident_place'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['reporting_date'] . " " . $row['reporting_time'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['fir_writer'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['culprit_name'] . " " . $row['culprit_address'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['arrest_date'] . " " . $row['arrest_time'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $victim_name . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
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

    $html = "<table style='border:1px solid black; border-collapse: collapse;'>";
    $html.= "<tr><th colspan=28 style='font-size: 40px;  border:1px solid black; border-collapse: collapse;'>दैनिक प्रतिवेदन प्रतिबंधात्मकता कार्यवाही/लघु अधिनियम रेंज सरगुजा जिला सरगुजा | $text</th></tr>";
    $distnum = 1;
    $begin=0;
    $finish=1;
    $numbers = ["5","16","21","31","36","48","53","58","63","74","79","94"];
    foreach ($districts as $dist) {

        $html .= "<tr>
                    <th colspan=28 style='font-size: 30px; border:1px solid black; border-collapse: collapse; text-align:center;'>" . $dist['district'] . "</th>
                </tr>
                <tr>        
                    <th rowspan=2 style='font-size: 24px;border:1px solid black; border-collapse: collapse; text-align:center;'>क्रमांक</th>
                    <th rowspan=2 style='font-size: 24px;border:1px solid black; border-collapse: collapse; text-align:center;'>पुलिस थाना</th>";
        foreach ($top_row as $cols) {
            $html .= "<th colspan=2 style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>" . $cols . "</th>";
        }

        $html .= "</tr>";
        $x = 1;
        $html .= "<tr>";
        for ($i = 1; $i <= 13; $i++) {
            $html .= "<td style='border:1px solid black; border-collapse: collapse; text-align:center;'>प्र.</td><td style='border:1px solid black; border-collapse: collapse; text-align:center;'>व्य.</td>";
        }
        $html .= "</tr>";
        $substations = get_sub_divisions($dist['district']);
        foreach ($substations as $sub) {
            $stations = get_police_stations($dist['district'], $sub['sub_division']);
            foreach ($stations as $ps) {
                $html .= "<tr><td style='border:1px solid black; border-collapse: collapse; text-align:center;'>" . $x++ . "</td>";
                $html .= "<td style='border:1px solid black; border-collapse: collapse; text-align:center;'>" . $ps['police_station'] . "</td>";
                foreach ($top_row as $act) {
                    $cases = get_acts_count($_SESSION['start_date'], $_SESSION['end_date'], $act, $ps['police_station']);
                    if (($cases != false) and $cases['case_count'] >= 1) {
                        $html .= "<td style='border:1px solid black; border-collapse: collapse; text-align:center;'>" . $cases['case_count'] . "</td>";
                        $html .= "<td style='border:1px solid black; border-collapse: collapse; text-align:center;'>" . $cases['people_count'] . "</td>";

                    } else {
                        $html .= "<td style='border:1px solid black; border-collapse: collapse; text-align:center;'></td><td style='border:1px solid black; border-collapse: collapse; text-align:center;'></td>";
                    }
                }
                $html .= "</tr>";
            }
        }
        $alphabets = ["C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB"];
        $html.="<tr>
                    <td colspan=2 style='border:1px solid black; border-collapse: collapse; text-align:center;'>योग</td>";
        foreach ($alphabets as $letter) {

                        $html.="<td style='border:1px solid black; border-collapse: collapse; text-align:center;'>=SUM(".$letter.$numbers[$begin].":".$letter.$numbers[$finish].")</td>";
        }
        $html.="</tr>";
        $distnum++;
        $begin+=2;
        $finish+=2;
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
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>क्रमांक</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>ज़िला</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>पुलिस<br>थाना</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>अपराध<br>क्रमांक</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>धारा</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>एफ.आई.आर.<br>का दिनाक</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>आरोपी/संदिग्ध का<br>नाम व पता</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>प्ररण की<br>अद्यतन स्थिति</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>न्यायालय का नाम</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>न्यायालय के फैसले<br>का संक्षिप्त विवरण</th>

                </tr>";
    $i = 1;
    foreach ($output_ongoing_cases as $ongoingcase) {
        foreach ($ongoingcase as $row) {
            $html .= "<tr>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $i++ . "
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['district'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['police_station'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['crime_number'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['penal_code'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['fir_date'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['culprit_name'] . " " . $row['culprit_address'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['case_status'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['name_of_court'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
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
                    <th colspan=12 center style='font-size: 40px; border:1px solid black; border-collapse: collapse;'>समस्त मर्ग की जानकारी | $text </th>
                </tr>
                <tr>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>क्रमांक</th>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>ज़िला</th>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>पुलिस<br> थाना</th>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>मर्ग क्रमांक</th>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>धारा</th>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>घटना दिनांक<br> व समय</th>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>घटना स्थान</th>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>सूचना दिनांक<br> व समय</th>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>प्रार्थी</th>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>मृतक/मृतिका<br> का नाम</th>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>कायमीकर्ता<br> का नाम</th>
                <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>सबब मौत</th>
                </tr>";
    $i = 1;
    foreach ($output_dead_bodies as $deadbody) {
        foreach ($deadbody as $row) {
            $html .= "<tr>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $i++ . "
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['district'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['police_station'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['dead_body_number'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['penal_code'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                        " . $row['accident_date'] . " " . $row['accident_time'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['accident_place'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['information_date'] . " " . $row['information_time'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['applicant_name'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['deceased_name'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['fir_writer'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
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

                    <th colspan=10 center style='font-size: 40px; border:1px solid black; border-collapse: collapse; text-align:center;'>महत्पूर्ण कार्यवाहिया / उपलब्धियां | $text</th>
                </tr>
                <tr>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>क्रमांक</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>ज़िला</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>थाना/चौकी</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>गंभीर अपराधों में गिरफ्तारि<br> / महत्वपूर्ण गिरफ्तारि</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>कोर्ट द्वारा दिए गये निर्णय<br> (दोषमुक्त / सजा / जमानत /
                    रद्द)</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>आपरेशन मुस्कान <br>/ गुम इंसान दस्तायी</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>डकैती / लुट<br> / चोरी का खुलासा</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>विविध जैसे जन जागरुकता <br>अभियान मे विशेष सफलता<br> या प्राण रक्षा,गिरफ्तारी <br>वारंटो की तमिलि आदि</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>धारा 102 के तहत <br>कि गई कार्यवाही</th>
                </tr>";
    $i = 1;
    foreach ($output_important_achievements as $impaction) {
        foreach ($impaction as $row) {
            $html .= "<tr>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $i++ . "
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['district'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['police_station'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['arrest_in_major_crime'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['decision_given_by_the_court'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                        " . $row['missing_man_document'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['robbery'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['miscellaneous'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
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

                    <th colspan=11 center style='font-size: 40px; border:1px solid black; border-collapse: collapse; text-align:center;'>कोर्ट का निर्णय | $text </th>
                </tr>
                <tr>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>क्रमांक</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>ज़िला</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>थाना<br>/चौकी</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>कोर्ट का नाम</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>अपराध <br>क्रमांक</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>धारा</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>कायमी<br> दिनांक</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>आरोपी का नाम<br> व पता</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>दिनांक</th>
                    <th style='font-size: 24px; border:1px solid black; border-collapse: collapse; text-align:center;'>निर्णय</th>
                </tr>";
    $i = 1;
    foreach ($output_court_judgements as $impaction) {
        foreach ($impaction as $row) {
            $html .= "<tr>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $i++ . "
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['district'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['police_station'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['court_name'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['crime_number'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                        " . $row['penal_code'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                        " . $row['result_date'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . $row['culprit_name'] . " " . $row['culprit_address'] . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
                            " . (new DateTime($row['updated_at']))->format('Y-m-d') . " 
                        </td>
                        <td style='border:1px solid black; border-collapse: collapse; text-align:center;'>
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