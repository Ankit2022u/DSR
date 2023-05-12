<?php
session_start();
require "dbcon.php";

if (isset($_POST['major_crime_download'])) {
    $output_major_crimes = $_SESSION['major_crimes'];
    $html = "<table>
                <tr>
                    <th>क्रमांक</th>
                    <th>ज़िला</th>
                    <th>संभाग</th>
                    <th>पुलिस थाना</th>
                    <th>अपराध क्रमांक</th>
                    <th>धारा</th>
                    <th>प्रार्थी का नाम एवम् पता</th>
                    <th>घटना दिनांक</th>
                    <th>घटना का समय</th>
                    <th>घटना स्थल</th>
                    <th>सूचना दिनाक</th>
                    <th>सूचना का समय</th>
                    <th>आरोपी/संदिग्ध का नाम व पता</th>
                    <th>गिरफ्तारी का दिनाक</th>
                    <th>गिरफ्तारी का समय</th>
                    <th>पीड़ित का नाम</th>
                    <th>अपराध का संक्षिप्त विवरण</th>
                    <th>गंभीर अपराध ?</th>
                    <th>कायमीकर्ता</th>
                </tr>";
    $i = 1;
    foreach ($output_major_crimes as $majorcrime) {
        foreach ($majorcrime as $row) {
            if ($row['is_major_crime']) {
                $row_val = "Yes";
            } else {
                $row_val = "No";
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
                            " . $row['applicant_name'] . "|" . $row['applicant_address'] . " 
                        </td>
                        <td>
                            " . $row['incident_date'] . " 
                        </td>
                        <td>
                            " . $row['incident_time'] . " 
                        </td>
                        <td>
                            " . $row['incident_place'] . " 
                        </td>
                        <td>
                            " . $row['reporting_date'] . " 
                        </td>
                        <td>
                            " . $row['reporting_time'] . " 
                        </td>
                        <td>
                            " . $row['culprit_name'] . " | " . $row['culprit_address'] . " 
                        </td>
                        <td>
                            " . $row['arrest_date'] . " 
                        </td>
                        <td>
                            " . $row['arrest_time'] . " 
                        </td>
                        <td>
                            " . $row['victim_name'] . " 
                        </td>
                        <td>
                            " . $row['description_of_crime'] . " 
                        </td>
                        <td>
                            " . $row_val . " 
                        </td>
                        <td>
                            " . $row['fir_writer'] . " 
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
if (isset($_POST['minor_crime_download'])) {
    $output_minor_crimes = $_SESSION['minor_crimes'];

    $html = "<table>
                <tr>
                <th>क्रमांक</th>
                <th>ज़िला</th>
                <th>संभाग</th>
                <th>पुलिस थाना</th>
                <th>समय</th>
                <th>घटना दिनांक</th>
                <th>व्यक्तियों की संख्या</th>
                <th>धारा</th>
                <th>कायमीकर्ता</th>
                </tr>";
    $i = 1;
    foreach ($output_minor_crimes as $minorcrime) {
        foreach ($minorcrime as $row) {
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
                            " . (new DateTime($row['time_date']))->format('H:i:s') . " 
                        </td>
                        <td>
                            " . (new DateTime($row['time_date']))->format('Y-m-d') . " 
                        </td>
                        <td>
                            " . $row['culprit_number'] . " 
                        </td>
                        <td>
                            " . $row['penal_code'] . " 
                        </td>
                        <td>
                            " . $row['fir_writer'] . " 
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
    header('Content-Disposition: attachment; filename=minor_crimes.xls');
    echo $html;
}
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
if (isset($_POST['dead_body_download'])) {
    $output_dead_bodies = $_SESSION['dead_bodies'];

    $html = "<table>
                <tr>
                <th>क्रमांक</th>
                <th>ज़िला</th>
                <th>अनुभाग</th>
                <th>पुलिस थाना</th>
                <th>मर्ग क्रमांक</th>
                <th>धारा</th>
                <th>घटना दिनांक</th>
                <th>घटना का समय </th>
                <th>घटना स्थान</th>
                <th>सूचना दिनांक</th>
                <th>सूचना का समय</th>
                <th>सूचक का नाम</th>
                <th>मृतक का नाम</th>
                <th>कायमीकर्ता</th>
                <th>मृत्यु का कारण</th>
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
                        " . $row['accident_date'] . " 
                        </td>
                        <td>
                        " . $row['accident_time'] . " 
                        </td>
                        <td>
                            " . $row['accident_place'] . " 
                        </td>
                        <td>
                            " . $row['information_date'] . " 
                        </td>
                        <td>
                            " . $row['information_time'] . " 
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

?>

<!-- à¤¹à¥‡à¤²à¥‹ à¤†à¤ª à¤•à¥ˆà¤¸à¥‡ -->