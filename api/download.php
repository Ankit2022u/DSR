<?php
session_start();
require "dbcon.php";
require "functions.php";
$start_date = $_SESSION['start_date'];
$end_date = $_SESSION['end_date'];

// Major crime download
if (isset($_POST['major_crime_download'])) {
    $output_major_crimes = $_SESSION['major_crimes'];
    $html = "<table>
                <tr>
                    <th colspan=15 center>समस्त अपराधो की जानकारी | $start_date - $end_date </th>
                </tr>
                <tr>
                    <th>क्रमांक</th>
                    <th>ज़िला</th>
                    <th>अनुभाग</th>
                    <th>पुलिस थाना</th>
                    <th>अपराध क्रमांक</th>
                    <th>धारा</th>
                    <th>प्रार्थी का नाम व पता</th>
                    <th>घटना दिनांक व समय</th>
                    <th>घटना स्थल</th>
                    <th>सूचना दिनाक व समय</th>
                    <th>कायमीकर्ता</th>
                    <th>आरोपी/संदिग्ध का नाम व पता</th>
                    <th>गिरफ्तारी दिनाक व समय</th>
                    <th>मृतक - मृतिका / आहत - आहता / पीड़ित - पीड़िता का नाम</th>
                    <th>विवरण</th>
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
                        <td>
                            " . $i++ . "
                        </td>
                        <td>
                            " . $row['district'] . " 
                        </td>
                        <td>
                            " . $row['sub_division'] . " 
                        </td>
                        <td>
                            " . $row['police_station'] . " 
                        </td>
                        <td>
                            " . $row['crime_number'] . " 
                        </td>
                        <td>
                            " . $row['penal_code'] . " 
                        </td>
                        <td>
                            " . $row['applicant_name'] . " | " . $row['applicant_address'] . " 
                        </td>
                        <td>
                            " . $row['incident_date'] . " | " . $row['incident_time'] . " 
                        </td>
                        <td>
                            " . $row['incident_place'] . " 
                        </td>
                        <td>
                            " . $row['reporting_date'] . " | " . $row['reporting_time'] . " 
                        </td>
                        <td>
                            " . $row['fir_writer'] . " 
                        </td>
                        <td>
                            " . $row['culprit_name'] . " | " . $row['culprit_address'] . " 
                        </td>
                        <td>
                            " . $row['arrest_date'] . " | " . $row['arrest_time'] . " 
                        </td>
                        <td>
                            " . $victim_name . " 
                        </td>
                        <td>
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

    $html = "<table>";
    $html.= "<tr>दैनिक प्रतिवेदन प्रतिबंधात्मकता कार्यवाही/लघु अधिनियम रेंज सरगुजा जिला सरगुजा | $start_date - $end_date</tr>";
    foreach ($districts as $dist) {

        $html .= "<tr>
                    <th colspan=28>" . $dist['district'] . "</th>
                </tr>
                <tr>        
                    <th rowspan=2>क्रमांक</th>
                    <th rowspan=2>पुलिस थाना</th>";
        foreach ($top_row as $cols) {
            $html .= "<th colspan=2>" . $cols . "</th>";
        }

        $html .= "</tr>";
        $x = 1;
        $html .= "<tr>";
        for ($i = 1; $i <= 13; $i++) {
            $html .= "<td>प्र.</td><td>व्य.</td>";
        }
        $html .= "</tr>";

        $substations = get_sub_divisions($dist['district']);
        foreach ($substations as $sub) {
            $stations = get_police_stations($dist['district'], $sub['sub_division']);
            foreach ($stations as $ps) {
                $html .= "<tr><td>" . $x++ . "</td>";
                $html .= "<td>" . $ps['police_station'] . "</td>";
                foreach ($top_row as $act) {
                    $cases = get_acts_count($_SESSION['start_date'], $_SESSION['end_date'], $act, $ps['police_station']);
                    if (($cases != false) and $cases['case_count'] >= 1) {
                        $html .= "<td>" . $cases['case_count'] . "</td>";
                        $html .= "<td>" . $cases['people_count'] . "</td>";
                    } else {
                        $html .= "<td></td><td></td>";
                    }
                }
                $html .= "</tr>";
            }
        }
        
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
    $html = "<table>
                <tr>
                    <th>क्रमांक</th>
                    <th>ज़िला</th>
                    <th>अनुभाग</th>
                    <th>पुलिस थाना</th>
                    <th>अपराध क्रमांक</th>
                    <th>धारा</th>
                    <th>एफ.आई.आर. का दिनाक</th>
                    <th>आरोपी/संदिग्ध का नाम व पता</th>
                    <th>प्ररण की अद्यतन स्थिति</th>
                    <th>न्यायालय का नाम</th>
                    <th>न्यायालय के फैसले का संक्षिप्त विवरण</th>
                </tr>";
    $i = 1;
    foreach ($output_ongoing_cases as $ongoingcase) {
        foreach ($ongoingcase as $row) {
            $html .= "<tr>
                        <td>
                            " . $i++ . "
                        </td>
                        <td>
                            " . $row['district'] . " 
                        </td>
                        <td>
                            " . $row['sub_division'] . " 
                        </td>
                        <td>
                            " . $row['police_station'] . " 
                        </td>
                        <td>
                            " . $row['crime_number'] . " 
                        </td>
                        <td>
                            " . $row['penal_code'] . " 
                        </td>
                        <td>
                            " . $row['fir_date'] . " 
                        </td>
                        <td>
                            " . $row['culprit_name'] . " | " . $row['culprit_address'] . " 
                        </td>
                        <td>
                            " . $row['case_status'] . " 
                        </td>
                        <td>
                            " . $row['name_of_court'] . " 
                        </td>
                        <td>
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

    $html = "<table>
                <tr>
                    <th colspan=13 center>समस्त मर्ग की जानकारी | $start_date - $end_date </th>
                </tr>
                <tr>
                <th>क्रमांक</th>
                <th>ज़िला</th>
                <th>अनुभाग</th>
                <th>पुलिस थाना</th>
                <th>मर्ग क्रमांक</th>
                <th>धारा</th>
                <th>घटना दिनांक व समय</th>
                <th>घटना स्थान</th>
                <th>सूचना दिनांक व समय</th>
                <th>प्रार्थी</th>
                <th>मृतक/मृतिका का नाम</th>
                <th>कायमीकर्ता का नाम</th>
                <th>सबब मौत</th>
                </tr>";
    $i = 1;
    foreach ($output_dead_bodies as $deadbody) {
        foreach ($deadbody as $row) {
            $html .= "<tr>
                        <td>
                            " . $i++ . "
                        </td>
                        <td>
                            " . $row['district'] . " 
                        </td>
                        <td>
                            " . $row['sub_division'] . " 
                        </td>
                        <td>
                            " . $row['police_station'] . " 
                        </td>
                        <td>
                            " . $row['dead_body_number'] . " 
                        </td>
                        <td>
                            " . $row['penal_code'] . " 
                        </td>
                        <td>
                        " . $row['accident_date'] . " | " . $row['accident_time'] . " 
                        </td>
                        <td>
                            " . $row['accident_place'] . " 
                        </td>
                        <td>
                            " . $row['information_date'] . " | " . $row['information_time'] . " 
                        </td>
                        <td>
                            " . $row['applicant_name'] . " 
                        </td>
                        <td>
                            " . $row['deceased_name'] . " 
                        </td>
                        <td>
                            " . $row['fir_writer'] . " 
                        </td>
                        <td>
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

    $html = "<table>
                <tr>
                    <th colspan=10 center>महत्पूर्ण कार्यवाहिया / उपलब्धियां | $start_date - $end_date</th>
                </tr>
                <tr>
                    th>क्रमांक</th>
                    <th>ज़िला</th>
                    <th>अनुभाग</th>
                    <th>थाना/चौकी</th>
                    <th>गंभीर अपराधों में गिरफ्तारि / महत्वपूर्ण गिरफ्तारि</th>
                    <th>कोर्ट द्वारा दिए गये निर्णय (दोषमुक्त / सजा / जमानत /
                    रद्द)</th>
                    <th>आपरेशन मुस्कान / गुम इंसान दस्तायी</th>
                    <th>डकैती / लुट / चोरी का खुलासा</th>
                    <th>विविध जैसे जन जागरुकता अभियान मे विशेष सफलता या प्राण रक्षा,गिरफ्तारी वारंटो की तमिलि आदि</th>
                    <th>धारा 102 के तहत कि गई कार्यवाही</th>
                </tr>";
    $i = 1;
    foreach ($output_important_achievements as $impaction) {
        foreach ($impaction as $row) {
            $html .= "<tr>
                        <td>
                            " . $i++ . "
                        </td>
                        <td>
                            " . $row['district'] . " 
                        </td>
                        <td>
                            " . $row['sub_division'] . " 
                        </td>
                        <td>
                            " . $row['police_station'] . " 
                        </td>
                        <td>
                            " . $row['arrest_in_major_crime'] . " 
                        </td>
                        <td>
                            " . $row['decision_given_by_the_court'] . " 
                        </td>
                        <td>
                        " . $row['missing_man_document'] . " 
                        </td>
                        <td>
                            " . $row['robbery'] . " 
                        </td>
                        <td>
                            " . $row['miscellaneous'] . " 
                        </td>
                        <td>
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

    $html = "<table>
                <tr>
                    <th colspan=11 center>कोर्ट का निर्णय | $start_date - $end_date </th>
                </tr>
                <tr>
                    <th>क्रमांक</th>
                    <th>ज़िला</th>
                    <th>अनुभाग</th>
                    <th>थाना/चौकी</th>
                    <th>कोर्ट का नाम</th>
                    <th>अपराध क्रमांक</th>
                    <th>धारा</th>
                    <th>कायमी दिनांक</th>
                    <th>आरोपी का नाम व पता</th>
                    <th>दिनांक</th>
                    <th>निर्णय</th>
                </tr>";
    $i = 1;
    foreach ($output_court_judgements as $impaction) {
        foreach ($impaction as $row) {
            $html .= "<tr>
                        <td>
                            " . $i++ . "
                        </td>
                        <td>
                            " . $row['district'] . " 
                        </td>
                        <td>
                            " . $row['sub_division'] . " 
                        </td>
                        <td>
                            " . $row['police_station'] . " 
                        </td>
                        <td>
                            " . $row['court_name'] . " 
                        </td>
                        <td>
                            " . $row['crime_number'] . " 
                        </td>
                        <td>
                        " . $row['penal_code'] . " 
                        </td>
                        <td>
                        " . $row['result_date'] . " 
                        </td>
                        <td>
                            " . $row['culprit_name'] . " | " . $row['culprit_address'] . " 
                        </td>
                        <td>
                            " . (new DateTime($row['updated_at']))->format('Y-m-d') . " 
                        </td>
                        <td>
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


?>