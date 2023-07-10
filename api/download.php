<?php
session_start();
require "dbcon.php";
require "functions.php";
require "download_manager.php";

function data_generator($document, $date, $district)
{
    $data = array();
    if ($document == "Summary") {

        $data['murder_count'] = count_murder_cases($date, $district);
        $data['gangrape_count'] = count_gangrape_cases($date, $district);
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
        foreach ($restricted_penal_codes as $penal_code) {
            $data[$penal_code['penal_code']] = count_cases($date, $district, $penal_code['penal_code']);
        }

        $total = sum_elements($data);
        $data['total'] = $total;
    } elseif ($document == "MinorCrime") {
        $data['crime_sum'] = get_minor_crimes($date, $district);
        if ($district === "All") {
            $data['crime_sum'] = array();
            foreach (districts() as $dist) {
                $district = $dist['district'];
                $data['crime_sum'] += get_minor_crimes($date, $district);
            }
        }
        $data['penal_codes'] = array_merge(get_penal_codes('Minor-Act'), get_penal_codes('Restricted'));
    } elseif ($document == "MajorCrime") {
        $data['major_crimes'] = get_major_crimes($date, $district);
    } elseif ($document == "Crime") {
        $data['crimes'] = get_crimes($date, $district);
    } elseif ($document == "Deadbody") {
        $data['deadbodies'] = get_dead_bodies($date, $district);
    } elseif ($document == "Achievement") {
        $data['achievements'] = get_important_achievements($date, $district);
    } elseif ($document == "Judgement") {
        $data['judgements'] = get_court_judgements($date, $district);
    } elseif ($document == "Application") {

        $data['gangrape_count'] = count_gangrape_cases($date, $district);
        // $data['narbali_prakaran'] = count_narbali_prakaran($date, $district);
        $data['dacoity_count'] = count_dacoity_cases($date, $district);
        $data['robbery_count'] = count_robbery_cases($date, $district);
        $data['kidnap_for_ransom_count'] = count_kidnap_for_ransom_cases($date, $district);

        $restricted_penal_codes = get_penal_codes('Restricted');
        $rdata = array();
        foreach ($restricted_penal_codes as $penal_code) {
            $rdata[$penal_code['penal_code']] = count_cases($date, $district, $penal_code['penal_code']);
        }

        $data['restricted_cases_count'] = sum_elements($rdata);
    } elseif ($document == "Disposal") {
        $data['disposals_crime_old'] = get_old_disposals($date, $district, 'crime');
        $data['disposals_crime'] = get_disposals($date, $district, 'crime');
        $data['disposals_deadbody_old'] = get_old_disposals($date, $district, 'deadbody');
        $data['disposals_deadbody'] = get_disposals($date, $district, 'deadbody');
        $data['disposals_complain_old'] = array();
        $data['disposals_complain'] = array();
    }
    // Condition when All is selected
    else {
        $data['murder_count'] = count_murder_cases($date, $district);
        $data['gangrape_count'] = count_gangrape_cases($date, $district);
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
        foreach ($restricted_penal_codes as $penal_code) {
            $data[$penal_code['penal_code']] = count_cases($date, $district, $penal_code['penal_code']);
        }
        $total = sum_elements($data);
        $data['total'] = $total;
        $data['crime_sum'] = get_minor_crimes($date, $district);
        $data['penal_codes'] = array_merge(get_penal_codes('Minor-Act'), get_penal_codes('Restricted'));
        $data['major_crimes'] = get_major_crimes($date, $district);
        $data['crimes'] = get_crimes($date, $district);
        $data['deadbodies'] = get_dead_bodies($date, $district);
        $data['achievements'] = get_important_achievements($date, $district);
        $data['judgements'] = get_court_judgements($date, $district);
        $data['gangrape_count'] = count_gangrape_cases($date, $district);
        // $data['narbali_prakaran'] = count_narbali_prakaran($date, $district);
        $data['dacoity_count'] = count_dacoity_cases($date, $district);
        $data['robbery_count'] = count_robbery_cases($date, $district);
        $data['kidnap_for_ransom_count'] = count_kidnap_for_ransom_cases($date, $district);
        $restricted_penal_codes = get_penal_codes('Restricted');
        $rdata = array();
        foreach ($restricted_penal_codes as $penal_code) {
            $rdata[$penal_code['penal_code']] = count_cases($date, $district, $penal_code['penal_code']);
        }
        $data['restricted_cases_count'] = sum_elements($rdata);
        $data['disposals_crime_old'] = get_old_disposals($date, $district, 'crime');
        $data['disposals_crime'] = get_disposals($date, $district, 'crime');
        $data['disposals_deadbody_old'] = get_old_disposals($date, $district, 'deadbody');
        $data['disposals_deadbody'] = get_disposals($date, $district, 'deadbody');
        $data['disposals_complain_old'] = array();
        $data['disposals_complain'] = array();
    }
    return $data;
}

$doc_format = $_POST['doc_format'];
$document = $_POST['document_type'];
$date = $_POST['dsr_date'];
$district = $_POST['district'];

// Checking the format and downloading the file
if ($doc_format == "excel") {

    // all and disposal are left

    // summary section -- these will be downloaded as pdf
    if ($document == "Summary") {
        $data = data_generator($document, $date, $district);
        $pdf = summary_pdf($date, $district, $data);
        echo $pdf;
    }

    // application download -- these will be downloaded as pdf
    else if ($document == "Application") {
        $data = data_generator($document, $date, $district);
        $pdf = application_pdf($date, $district, $data);
        echo $pdf;
    }

    // major crime download
    else if ($document == "MajorCrime") {
        // $data['major_crimes'] = get_major_crimes($date, $district);
        $html = "<table style='vertical-align:middle;'>";
        $html .= "<tr>
                        <th colspan=13 center style='font-size: 44px; border:1px solid black; border-collapse: collapse; height:75px; vertical-align:middle; text-align:center;'>";
        if ($district == "All") {
            $html .= 'समस्त जिला';
        } else {
            $html .= $district;
        }

        $html .= " में घटित गंभीर अपराधों की जानकारी (डी. एस. आर.) $date </th>
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
        foreach (get_major_crimes($date, $district) as $row) {
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



        $html .= "</table>";

        $html = '<html xmlns:o="urn:schemas-microsoft-com:office:office"
        xmlns:x="urn:schemas-microsoft-com:office:excel"
        xmlns="http://www.w3.org/TR/REC-html40">'
            . '<head><meta http-equiv="Content-type" content="text/html;charset=UTF-8" /></head>'
            . '<body>' . $html . '</body></html>';

        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=major_crimes' . $date . '.xls');
        echo $html;
    }

    // Minor crime download - error in these section
    else if ($document == "MinorCrime") {
        $districts = get_districts();
        $top_row = ["41(1) जा. फौ", "102 जा. फौ", "109 जा. फौ", "110 जा. फौ", "145 जा. फौ", "151 जा. फौ", "107,116 जा. फौ", "सट्टा", "जुआ एक्ट", "आव. एक्ट", "नारको", "आर्म्स. एक्ट", "एम. वी. एक्ट"];
        if ($district != "All") {
            $html .= '<table class="border" style="margin:auto; margin-top:10px; min-width:280mm;">
            
            <tr>
                <th class="border" colspan="30">जिला - ' . $district . '</th>
            </tr>
            <tr>        
                <th rowspan="2" style="border: 1px solid black;">क्र.</th>
                <th rowspan="2" style="border: 1px solid black;">थाना</th>';
            foreach (array_merge(get_penal_codes('Minor-Act'), get_penal_codes('Restricted')) as $penal_code) {
                $html .= '<th class="border" colspan="2">' . $penal_code['penal_code'] . '</th>';
            }

            $html .= '</tr><tr>';
            for ($i = 1; $i <= 14; $i++) {
                $html .= '<td class="border" style="border: 1px solid black;">प्र.</td>
            <td class="border" style="border: 1px solid black;">व्य.</th>';
            }
            $html .= "</tr>";
            $x = 1;
            foreach (get_minor_crimes($date, $district)[$district] as $name => $info) {
                $html .= "<tr><th class='border' style='border: 1px solid black;'>" . $x++ . "</th>
                <th class='border' style='border: 1px solid black;'>" . $name . "</th>";

                foreach (array_merge(get_penal_codes('Minor-Act'), get_penal_codes('Restricted')) as $penal_codes) {
                    if (!isset($info[$penal_codes['penal_code']]['case_count'])) {
                        $info[$penal_codes['penal_code']]['case_count'] = "";
                    }
                    $html .= "<td class='border' style='border: 1px solid black;'>" . $info[$penal_codes['penal_code']]['case_count'] . "</td>
                    <td class='border' style='border: 1px solid black;'>" . $info[$penal_codes['penal_code']]['people_count'] . "</td>";
                }
            }
            $html .= '</table>';
        } else {
            foreach (districts() as $dist) {
                $district = $dist['district'];
                $html .= '<table class="border separate" style="margin:auto; margin-top:10px; min-width:280mm;">
                
                <tr>
                    <th class="border" colspan="30">जिला - ' . $district . '</th>
                </tr>
                <tr>        
                    <th rowspan="2" style="border: 1px solid black;">क्र.</th>
                    <th rowspan="2" style="border: 1px solid black;">थाना</th>';
                foreach (array_merge(get_penal_codes('Minor-Act'), get_penal_codes('Restricted')) as $penal_code) {
                    $html .= '<th class="border" colspan="2">' . $penal_code['penal_code'] . '</th>';
                }

                $html .= '</tr><tr>';
                for ($i = 1; $i <= 14; $i++) {
                    $html .= '<td class="border" style="border: 1px solid black;">प्र.</td>
                <td class="border" style="border: 1px solid black;">व्य.</th>';
                }
                $html .= "</tr>";
                $x = 1;
                foreach (get_minor_crimes($date, $district)[$district] as $name => $info) {
                    $html .= "<tr><th class='border' style='border: 1px solid black;'>" . $x++ . "</th>
                    <th class='border' style='border: 1px solid black;'>" . $name . "</th>";

                    foreach (array_merge(get_penal_codes('Minor-Act'), get_penal_codes('Restricted')) as $penal_codes) {
                        if (!isset($info[$penal_codes['penal_code']]['case_count'])) {
                            $info[$penal_codes['penal_code']]['case_count'] = "";
                        }
                        $html .= "<td class='border' style='border: 1px solid black;'>" . $info[$penal_codes['penal_code']]['case_count'] . "</td>
                        <td class='border' style='border: 1px solid black;'>" . $info[$penal_codes['penal_code']]['people_count'] . "</td>";
                    }
                }
                $html .= '</table>';
            }
        }


        $html = '<html xmlns:o="urn:schemas-microsoft-com:office:office"
        xmlns:x="urn:schemas-microsoft-com:office:excel"
        xmlns="http://www.w3.org/TR/REC-html40">'
            . '<head><meta http-equiv="Content-type" content="text/html;charset=UTF-8" /></head>'
            . '<body>' . $html . '</body></html>';

        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=minor_crimes' . $date . '.xls');
        echo $html;
    }

    // crime download
    else if ($document == "Crime") {
        $html = "<table style='vertical-align:middle;'>";
        $html .= "<tr>
                        <th colspan=13 center style='font-size: 44px; border:1px solid black; border-collapse: collapse; height:75px; vertical-align:middle; text-align:center;'>";
        if ($district == "All") {
            $html .= 'समस्त जिला';
        } else {
            $html .= $district;
        }
        $html .= "में घटित सामान्य अपराधों की जानकारी (डी. एस. आर.)  $date </th>
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
        foreach (get_crimes($date, $district) as $row) {

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


        $html .= "</table>";

        $html = '<html xmlns:o="urn:schemas-microsoft-com:office:office"
        xmlns:x="urn:schemas-microsoft-com:office:excel"
        xmlns="http://www.w3.org/TR/REC-html40">'
            . '<head><meta http-equiv="Content-type" content="text/html;charset=UTF-8" /></head>'
            . '<body>' . $html . '</body></html>';

        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=crimes' . $date . '.xls');
        echo $html;
    }

    // Dead body download
    else if ($document == "Deadbody") {
        $html = "<table style='vertical-align:middle;'>";
        $html .= "<tr>
                        <th colspan=11 center style='font-size: 40px; border:1px solid black; border-collapse: collapse; vertical-align:middle; height:75px;'>";
        if ($district == "All") {
            $html .= 'समस्त जिला';
        } else {
            $html .= $district;
        }
        $html .= "मर्ग की जानकारी | $date </th>
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
        foreach (get_dead_bodies($date, $district) as $row) {
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

        if (!($found_bodies)) {
            $html .= "<tr style='height: 40px;'>
                        <td colspan=11 style=' height:50px; font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            निरंक
                        </td>
                    </tr>
                    ";
        }
        $html .= "<tr style='height: 40px;'><td colspan=11 style='border:1px solid black; border-collapse: collapse;'></td></tr>";


        $html .= "</table>";

        $html = '<html xmlns:o="urn:schemas-microsoft-com:office:office"
        xmlns:x="urn:schemas-microsoft-com:office:excel"
        xmlns="http://www.w3.org/TR/REC-html40">'
            . '<head><meta http-equiv="Content-type" content="text/html;charset=UTF-8" /></head>'
            . '<body>' . $html . '</body></html>';

        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=dead_bodies' . $date . '.xls');
        echo $html;
    }


    // Important achievement download
    else if ($document == "Achievement") {

        $html = "<table style='vertical-align:middle;'>
                <tr>
                    <th colspan=8 center style='font-size: 42px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; height:75px;'>महत्पूर्ण कार्यवाहिया / उपलब्धियां | $date</th>
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
        $i = 1;
        $found_achievements = false;
        foreach (get_important_achievements($date, $district) as $row) {
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
        if (!($found_achievements)) {
            $html .= "<tr>
                        <td colspan=8 style=' height:50px; font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            निरंक
                        </td>
                    </tr>
                    ";
        }
        $html .= "<tr><td colspan=8></td></tr>";


        $html .= "</table>";

        $html = '<html xmlns:o="urn:schemas-microsoft-com:office:office"
        xmlns:x="urn:schemas-microsoft-com:office:excel"
        xmlns="http://www.w3.org/TR/REC-html40">'
            . '<head><meta http-equiv="Content-type" content="text/html;charset=UTF-8" /></head>'
            . '<body>' . $html . '</body></html>';

        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=important_achievements' . $date . '.xls');
        echo $html;
    }

    // Court Judgment download
    else if ($document == "Judgement") {
        $html = "<table style='vertical-align:middle;'>";

        $html .= "<tr>
                        <th colspan=9 center style='font-size: 40px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; height:75;'>कोर्ट के निर्णय | $date </th>
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

        $found_judgements = false;
        foreach (get_court_judgements($date, $district) as $row) {
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
        if (!($found_judgements)) {
            $html .= "<tr>
                <td colspan=9 style=' height:50px; font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                    निरंक
                </td>
            </tr>
            ";
        }
        $html .= "<tr><td colspan=9></td></tr>";


        $html .= "</table>";

        $html = '<html xmlns:o="urn:schemas-microsoft-com:office:office"
        xmlns:x="urn:schemas-microsoft-com:office:excel"
        xmlns="http://www.w3.org/TR/REC-html40">'
            . '<head><meta http-equiv="Content-type" content="text/html;charset=UTF-8" /></head>'
            . '<body>' . $html . '</body></html>';

        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=court_judgements' . $date . '.xls');
        echo $html;
    } else {

        // Process the message submission
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // ... Process the message and any necessary validation ...

            // Redirect to the previous page with a success message
            $message = urlencode("All file not download at a time!");
            $redirectUrl = $_SERVER["HTTP_REFERER"];
            header("Location: " . $redirectUrl);
            exit;
        }
    }

    // <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle;'>
    // " . $row['sub_division'] . "
    // </td>

} elseif ($doc_format == "pdf") {

    // if ($district)
    // Downloading specific data
    if ($document == "Summary") {
        $data = data_generator($document, $date, $district);
        $pdf = summary_pdf($date, $district, $data);
        echo $pdf;
    } elseif ($document == "MinorCrime") {
        $data = data_generator($document, $date, $district);
        $pdf = minor_crime_pdf($date, $district, $data);
        echo $pdf;
    } elseif ($document == "MajorCrime") {
        $data = data_generator($document, $date, $district);
        $pdf = major_crime_pdf($date, $district, $data);
        echo $pdf;
    } elseif ($document == "Crime") {
        $data = data_generator($document, $date, $district);
        $pdf = crime_pdf($date, $district, $data);
        echo $pdf;
    } elseif ($document == "Deadbody") {
        $data = data_generator($document, $date, $district);
        $pdf = deadbody_pdf($date, $district, $data);
        echo $pdf;
    } elseif ($document == "Achievement") {
        $data = data_generator($document, $date, $district);
        $pdf = achievements_pdf($date, $district, $data);
        echo $pdf;
    } elseif ($document == "Judgement") {
        $data = data_generator($document, $date, $district);
        $pdf = judgements_pdf($date, $district, $data);
        echo $pdf;
    } elseif ($document == "Application") {

        $data = data_generator($document, $date, $district);
        $pdf = application_pdf($date, $district, $data);
        echo $pdf;
    } elseif ($document == "Disposal") {
        $data = data_generator($document, $date, $district);
        $pdf = disposals_pdf($date, $district, $data);
        echo $pdf;
    }
    // Condition when All is selected
    else {
        $data = data_generator($document, $date, $district);
        $ppage1 = summary_pdf($date, $district, $data, 0);
        $ppage2 = application_pdf($date, $district, $data, 0);
        $page1 = minor_crime_pdf($date, $district, $data, 0);
        $page2 = major_crime_pdf($date, $district, $data, 0);
        $page3 = crime_pdf($date, $district, $data, 0);
        $page4 = deadbody_pdf($date, $district, $data, 0);
        $page5 = achievements_pdf($date, $district, $data, 0);
        $page6 = judgements_pdf($date, $district, $data, 0);
        $page7 = disposals_pdf($date, $district, $data, 0);
        $script = "<script src='https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js'></script>
<script>
function downloadpdf1() {
    const data = document.getElementById('pdata');
    const options1 = {
        margin: [0, 0, 0, 0],
        filename: 'Summaries-" . $district . " (" . $date . ").pdf',
        image: {
            type: 'jpeg',
            quality: 1
        },
        html2canvas: {
            scale: 2
        },
        jsPDF: {
            unit: 'mm',
            format: 'a4',
            orientation: 'portrait'
        }
    };

    html2pdf().set(options1).from(data).save();
}

function downloadpdf2() {
    const data = document.getElementById('ldata');
    const options2 = {
        margin: [0, 0, 0, 0],
        filename: 'Details-" . $district . " (" . $date . ").pdf',
        image: {
            type: 'jpeg',
            quality: 1
        },
        html2canvas: {
            scale: 2
        },
        jsPDF: {
            unit: 'mm',
            format: 'a4',
            orientation: 'landscape'
        }
    };
    html2pdf().set(options2).from(data).save();
}
</script>";

        $style = '<style>
/* All */
body {
    background-color: black;
}

.notcenter {
    text-align: start;
}

.center {
    text-align: center;
    padding: 10px;
}

.page {
    margin: 0 auto;
    background-color: white;
    margin-bottom: 10px !important;
    page-break-after: always;
    /* Add page break after each page */
}

.border {
    border: 1px solid black !important;
    border-collapse: collapse;
    vertical-align: middle;
    text-align: center;
}

/* summary */
#ppage1,
#ppage2 {
    padding: 15mm 18mm 30mm 13mm;
    width: 210mm;
    min-height: 297mm;
}

#ppage1 td,
#ppage1 th {
    border: 1px solid black;
    text-align: center;

}

#ppage1 *,
#page2 *,
#page3 *,
#page5 *,
#page6 * {
    font-size: 14px;
}

/* application */

#ppage2 *,
#page7 * {
    font-size: 17px;
}

#ppage2 #t1 tr,
#ppage2 #t1 th,
#ppage2 #t1 td {
    border: 1px solid black;
    text-align: center;
}

#ppage2 .notcenter {
    text-align: left !important;
    padding-left: 3px;
}

#ppage2 .marginright {
    padding-left: 5px;
    padding-right: 15px;
}

/* minor crime */
#page1 {
    padding: 22mm 8mm 22mm 8mm;
    width: 297mm;
    min-height: 210mm;
}

#page1 * {
    font-size: 12px;
}

/* crime */
#page3,
#page2,
#page4,
#page5 {
    padding: 13mm 5mm 13mm 5mm;
    width: 297mm;
    min-height: 210mm;
}

/* deadbody */
#page4 * {
    font-size: 15px;
}

/* jugdements */

#page6,
#page7 {
    padding: 20mm 20mm 14mm 14mm;
    width: 297mm;
    min-height: 210mm;
}
</style>';

        echo '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DSR PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    ' . $style .
            $script . '
</head>

<body>
    <div class="center"><button class="btn btn-lg btn-danger" onclick="downloadpdf1()">Print Summary</button></div>
    <br />
    <div class="center"><button class="btn btn-lg btn-primary" onclick="downloadpdf2()">Print Detail</button></div>
    <div class="main" id="pdata">
        <div id="ppage1" class="page">
            ' . $ppage1 . '
        </div>
        <div id="ppage2" class="page">
            ' . $ppage2 . '
        </div>
    </div>
    <div class="main" id="ldata">
        <div id="page1" class="page">
            ' . $page1 . '
        </div>
        <div id="page2" class="page">
            ' . $page2 . '
        </div>
        <div id="page3" class="page">
            ' . $page3 . '
        </div>
        <div id="page4" class="page">
            ' . $page4 . '
        </div>
        <div id="page5" class="page">
            ' . $page5 . '
        </div>
        <div id="page6" class="page">
            ' . $page6 . '
        </div>
        <div id="page7" class="page">
            ' . $page7 . '
        </div>
    </div>
</body>

</html>';
    }
}
?>

<!-- <th style='border:1px solid black; border-collapse: collapse; vertical-align:middle;'>अनुभाग</th> -->