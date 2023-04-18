<?php
session_start();
require "dbcon.php";

if (isset($_POST['major_crime_download'])) {
    $output_major_crimes = $_SESSION['major_crimes'];
    $html = "<table>
                <tr>
                    <th>Id</th>
                    <th>District</th>
                    <th>Sub-Division</th>
                    <th>Police Station</th>
                    <th>Crime Number</th>
                    <th>Penal-Code</th>
                    <th>Applicant Name</th>
                    <th>Applicant Address</th>
                    <th>Incident Date</th>
                    <th>Incident Time</th>
                    <th>Incident Place</th>
                    <th>Reporting Date</th>
                    <th>Reporting Time</th>
                    <th>Culprit Name</th>
                    <th>Culprit Address</th>
                    <th>Arrest Date</th>
                    <th>Arrest Time</th>
                    <th>Victim Name</th>
                    <th>Description Of Crime</th>
                    <th>Major Crime</th>
                    <th>FIR Writer</th>
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
                            " . $row['applicant_name'] . " 
                        </td>
                        <td>
                            " . $row['applicant_address'] . " 
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
                            " . $row['culprit_name'] . " 
                        </td>
                        <td>
                            " . $row['culprit_address'] . " 
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
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=major_crimes.xls');
    echo $html;
}
if (isset($_POST['minor_crime_download'])) {
    $output_minor_crimes = $_SESSION['minor_crimes'];

    $html = "<table>
                <tr>
                <th>ID</th>
                <th>Time</th>
                <th>Date</th>
                <th>Culprit Name</th>
                <th>Penal Code</th>
                <th>FIR Writer</th>
                </tr>";
    $i = 1;
    foreach ($output_minor_crimes as $minorcrime) {
        foreach ($minorcrime as $row) {
            $html .= "<tr>
                        <td>
                            " . $i++ . "
                        </td>
                        <td>
                            " . (new DateTime($row['time_date']))->format('H:i:s') . " 
                        </td>
                        <td>
                            " . (new DateTime($row['time_date']))->format('Y-m-d') . " 
                        </td>
                        <td>
                            " . $row['culprit_name'] . " 
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
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=minor_crimes.xls');
    echo $html;
}
if (isset($_POST['ongoing_case_download'])) {
    $output_ongoing_cases = $_SESSION['ongoing_cases'];
    $html = "<table>
                <tr>
                    <th>Id</th>
                    <th>District</th>
                    <th>Sub-Division</th>
                    <th>Police Station</th>
                    <th>Crime Number</th>
                    <th>Penal-Code</th>
                    <th>FIR Date</th>
                    <th>Culprit Name</th>
                    <th>Case Status </th>
                    <th>Name Of Court</th>
                    <th>Culprit Address</th>
                    <th>Judgement Of Court</th>
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
                            " . $row['culprit_name'] . " 
                        </td>
                        <td>
                            " . $row['case_status'] . " 
                        </td>
                        <td>
                            " . $row['name_of_court'] . " 
                        </td>
                        <td>
                            " . $row['culprit_address'] . " 
                        </td>
                        <td>
                            " . $row['judgement_of_court'] . " 
                        </td>
                    </tr>";

        }
    }

    $html .= "</table>";
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=ongoing_cases.xls');
    echo $html;

}
if (isset($_POST['dead_body_download'])) {
    $output_dead_bodies = $_SESSION['dead_bodies'];

    $html = "<table>
                <tr>
                <th>Id</th>
                <th>District</th>
                <th>Sub-Division</th>
                <th>Police Station</th>
                <th>Dead Body No.</th>
                <th>Penal-Code</th>
                <th>Accident Date</th>
                <th>Accident Place</th>
                <th>Information Date</th>
                <th>Information Time</th>
                <th>Applicant Name</th>
                <th>Deceased Name</th>
                <th>FIR Writer</th>
                <th>Cause Of Death</th>
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
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=dead_bodies.xls');
    echo $html;
}

?>

<!-- à¤¹à¥‡à¤²à¥‹ à¤†à¤ª à¤•à¥ˆà¤¸à¥‡ -->