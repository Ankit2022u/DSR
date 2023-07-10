<?php
function summary_pdf($date, $district, $data, $type = 1)
{
    $script = "<script src='https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js'></script>
    <script>
        function downloadpdf() {
            const data = document.getElementById('data');
            

            const opt = {
                margin: 0,
                filename: 'Summary-" . $district . " (" . $date . ").pdf',
                image: { type: 'jpeg', quality: 1 },
                html2canvas: { scale: 4 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                pagebreak: { mode: ['avoid-all'] }, // Optional: Avoid page breaks within table rows
                html2pdf: { 
                  margin: { top: 10, right: 0, bottom: 10, left: 0 },
                  filename: 'Summary-" . $district . " (" . $date . ").pdf',
                  image: { type: 'jpeg', quality: 1 },
                html2canvas: { scale: 4 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                }
              };
            
            
            html2pdf().set(opt).from(data).save();
        }
    </script>";

    $style = '<style>
                    body {
                        background-color: black;
                    }
                    #data {
                        margin: 0 auto;
                        padding: 15mm 18mm 30mm 13mm;
                        width: 210mm;
                        min-height: 297mm;
                        background-color: white;
                    }
                    td, th {
                        border: 1px solid black;
                        text-align: center;
                    }
                    .notcenter {
                        text-align: start;
                    }
                    .center {
                        text-align: center;
                        padding : 10px;
                    }
                    * {
                        font-size: 14px;
                    }
                </style>';

    $inner_style = 'padding:15mm 18mm 30mm 13mm; width: 210mm; height:297mm';

    $html = '<h1 style="font-size: 19px; text-align: center; font-weight: 600;">दैनिक
    प्रतिवेदन दिनांक ' . $date . '</h1>
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
            <td>' . $data['murder_count'] . '</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td scope="row">2</td>
            <td class="notcenter">सामूहिक बलात्कार</td>
            <td>' . $data['gangrape_count'] . '</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td scope="row">3</td>
            <td class="notcenter">बलात्कार</td>
            <td>' . $data['rape_count'] . '</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td scope="row">4</td>
            <td class="notcenter">धारा 363 भा०द०वि०</td>
            <td>' . $data['dhara363_count'] . '</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td scope="row">5</td>
            <td class="notcenter">नरबलि प्रकरण</td>
            <td>TODO</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td scope="row">6</td>
            <td class="notcenter">डकैती</td>
            <td>' . $data['dacoity_count'] . '</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td scope="row">7</td>
            <td class="notcenter">लूट</td>
            <td>' . $data['robbery_count'] . '</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td scope="row">8</td>
            <td class="notcenter">फिरौती हेतु अपहरण</td>
            <td>' . $data['kidnap_for_ransom_count'] . '</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td scope="row">9</td>
            <td class="notcenter">महत्वपूर्ण नक्सली अपराध</td>
            <td>TODO</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td scope="row">10</td>
            <td class="notcenter">पुलिस कर्मचारियों पर हत्या हमला</td>
            <td>TODO</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td scope="row">10</td>
            <td class="notcenter">पुलिस कर्मचारियों पर हत्या हमला</td>
            <td>' . $data['dhara363_count'] . '</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr> <th colspan="6" class="notcenter">लघु अधिनियम :-</th>
        </tr>
        <tr>
            <td scope="row">11</td>
            <td class="notcenter">आबकारी एक्ट</td>
            <td>' . $data['आब. एक्ट'] . '</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td scope="row">12</td>
            <td class="notcenter">जुआ</td>
            <td>' . $data['जुआ एक्ट'] . '</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

            <td scope="row">13</td>
            <td class="notcenter">आर्म्स एक्ट</td>
            <td>' . $data['आर्म्स. एक्ट'] . '</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td scope="row">14</td>
            <td class="notcenter">नारकोटिक्स एक्ट</td>
            <td>' . $data['नारको'] . '</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td scope="row">15</td>
            <td class="notcenter">सट्टा</td>
            <td>' . $data['सट्टा'] . '</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td scope="row">16</td>
            <td class="notcenter">मोटरयान अधिनियम</td>
            <td>' . $data['एम. वी. एक्ट'] . '</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr> <th colspan="6" class="notcenter">प्रतिबंधात्मक
                कार्यवाही :-</th> </tr>

        <tr>
            <td scope="row">17</td>
            <td class="notcenter">धारा 41(1) जा०फौ०</td>
            <td>' . $data['41(1) जा. फौ'] . '</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td scope="row">18</td>
            <td class="notcenter">धारा 41(2) जा०फौ०</td>
            <td>' . $data['41(2) जा. फौ'] . '</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td scope="row">19</td>
            <td class="notcenter">धारा 109 जा०फौ०</td>
            <td>' . $data['109 जा. फौ'] . '</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td scope="row">20</td>
            <td class="notcenter">धारा 110 जा०फौ०</td>
            <td>' . $data['110 जा. फौ'] . '</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td scope="row">21</td>
            <td class="notcenter">धारा 151 जा०फौ०</td>
            <td>' . $data['151 जा. फौ'] . '</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td scope="row">22</td>
            <td class="notcenter">धारा 107,116(3) जा०फौ०</td>
            <td>' . $data['107,116 जा. फौ'] . '</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td scope="row">23</td>
            <td class="notcenter">धारा 145 जा०फौ०</td>
            <td>' . $data['145 जा. फौ'] . '</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td scope="row">24</td>
            <td class="notcenter">धारा 102 जा०फौ०</td>
            <td>' . $data['102 जा. फौ'] . '</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td scope="row">25</td>
            <td class="notcenter">जिला बदर</td>
            <td>TODO</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td scope="row">26</td>
            <td class="notcenter">रा०सु०का०</td>
            <td>TODO</td>
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
            <td>' . $data['total'] . '</td>
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
    if ($type) {
        return '<!DOCTYPE html>
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
<div class="center"><button class="btn btn-lg btn-success" onclick="downloadpdf()">Print</button></div>
<div class="main" style="' . $inner_style . '" id="data">' . $html . '</div>
</body>
</html>';
    } else {
        return $html;
    }
}

function application_pdf($date, $district, $data, $type = 1)
{
    $style = '<style>
    body {
        background-color: black;
    }

    #data {
        margin: 0 auto;
        padding: 15mm 18mm 30mm 13mm;
        width: 210mm;
        min-height: 297mm;
        background-color: white;
    }

    .center {
        text-align: center;
        padding: 10px;
    }
    * {
        font-size: 17px;
    }

    #t1 tr,
    #t1 th,
    #t1 td {
        border: 1px solid black;
        text-align: center;
    }

    .notcenter {
        text-align: left !important;
        padding-left: 3px;
    }
    .marginright{
        padding-left: 5px;
        padding-right: 15px;
    }
</style>';

    $script = '<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script><script>
function downloadpdf() {
    const element = document.getElementById("data");
    const opt = {
        margin: 0,
        filename: "Application-' . $district . ' (' . $date . ').pdf",
        image: { type: "jpeg", quality: 1 },
        html2canvas: { scale: 4 },
        jsPDF: { unit: "mm", format: "a4", orientation: "portrait" },
        pagebreak: { mode: ["avoid-all"] }, // Optional: Avoid page breaks within table rows
        html2pdf: { 
          margin: { top: 10, right: 0, bottom: 10, left: 0 },
          filename: "Application-' . $district . ' (' . $date . ').pdf",
          image: { type: "jpeg", quality: 1 },
          html2canvas: { scale: 4 },
          jsPDF: { unit: "mm", format: "a4", orientation: "portrait" }
        }
      };

    html2pdf().set(opt).from(element).save();
}
</script>';

    $html = '<h1 style="font-size: 20px; text-decoration:underline; font-weight: 600; text-align: center;">
कार्यालय पुलिस
अधीक्षक जिला सरगुजा (छत्तीसगढ़)</h1>
<pre>


प्रति,
    पुलिस महानिदेशक
    (छत्तीसगढ़) रायपुर

विषय - डी०एस०आर० नये प्रारूप के मुताबिक दिनांक ' . $date . '
संदर्भ - पुलिस मुख्यालय रायपुर का पत्र क्रमांक पु०मु०/अ०अ०वि०/रा०अ०अ० ब्यूरो/7/2013
       दिनांक 08.01.2013

(ब) जिले में 24 घंटे के अंदर घटित अपराध:-</pre>

<table class="table-bordered" id="t1" style="width:180mm;">
<thead>
    <tr>
        <th>अपराध शीर्ष</th>
        <th>कुल आंकड़े</th>
    </tr>
</thead>
<tbody>
    <tr>
        <td class="notcenter">जिले में पंजीबद्ध पुल भा०द०वि० के प्रकरण </td>
        <td>TODO</td>
    </tr>
    <tr>
        <td class="notcenter">विशेष/स्थानीय अधिनियम </td>
        <td>TODO</td>
    </tr>
    <tr>
        <td class="notcenter">प्रतिबंधात्मक कार्यवाही </td>
        <td>' . $data['restricted_cases_count'] . '</td>
    </tr>
    <tr>
        <td>योग </td>
        <td>TODO</td>
    </tr>
</tbody>
</table>

<table>
<tbody>
    <tr>
        <td>1.</td>
        <td>गैंग रेप</td>
        <td class="marginright">- </td>
        <td>' . $data['gangrape_count'] . '</td>
    </tr>
    <tr>
        <td>2.</td>
        <td>नर बलि प्रकरण </td>
        <td class="marginright">- </td>
        <td>TODO</td>
    </tr>
    <tr>
        <td>3.</td>
        <td>महत्वपूर्ण गुम इंसान</td>
        <td class="marginright">- </td>
        <td>TODO</td>
    </tr>
    <tr>
        <td>4.</td>
        <td>महत्वपूर्ण हत्या</td>
        <td class="marginright">- </td>
        <td>TODO</td>
    </tr>
    <tr>
        <td>5.</td>
        <td>चोरी</td>
        <td class="marginright">- </td>
        <td>TODO</td>
    </tr>
    <tr>
        <td>6.</td>
        <td>लूट</td>
        <td class="marginright">- </td>
        <td>' . $data['robbery_count'] . '</td>
    </tr>
    <tr>
        <td>7.</td>
        <td>डकैती</td>
        <td class="marginright">- </td>
        <td>' . $data['dacoity_count'] . '</td>
    </tr>
    <tr>
        <td>8.</td>
        <td>फिरौती हेतु अपहरण</td>
        <td class="marginright">- </td>
        <td>' . $data['kidnap_for_ransom_count'] . '</td>
    </tr>
    <tr>
        <td>9.</td>
        <td>महत्वपूर्ण नक्सली अपराध</td>
        <td class="marginright">- </td>
        <td>TODO</td>
    </tr>
    <tr>
        <td>10.</td>
        <td>पुलिस कर्मचारियों की हत्या या उन पर हमला</td>
        <td class="marginright">- </td>
        <td></td>
    </tr>

</tbody>
</table>

<pre style="margin-top: 3px; font-size: 16px; padding: 0px;">

प्रतिलिपि:-
01.	आईजी रेंज सरगुजा                                    प्रभारी
                                                   कंट्रोल रूम रेंज सरगुजा</pre>';

    $inner_style = '';
    if ($type) {
        return '<!DOCTYPE html>
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
<div class="center"><button class="btn btn-lg btn-success" onclick="downloadpdf()">Print</button></div>
<div class="main" style="' . $inner_style . '" id="data">' . $html . '</div>
</body>
</html>';
    } else {
        return $html;
    }
}

function minor_crime_pdf($date, $district, $data, $type = 1)
{
    $script = '<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script><script>
    function downloadpdf() {
        const element = document.getElementById("data");

        const opt = {
            margin: 0,
            filename: "Minor Crime-' . $district . ' (' . $date . ').pdf",
            image: { type: "jpeg", quality: 1 },
            html2canvas: { scale: 4 },
            jsPDF: { unit: "mm", format: "a4", orientation: "landscape" },
            pagebreak: { mode: ["avoid-all"] }, // Optional: Avoid page breaks within table rows
            html2pdf: { 
              margin: { top: 10, right: 0, bottom: 10, left: 0 },
              filename: "Minor Crime-' . $district . ' (' . $date . ').pdf",
              image: { type: "jpeg", quality: 1 },
              html2canvas: { scale: 4 },
              jsPDF: { unit: "mm", format: "a4", orientation: "landscape" }
            }
          };
    
        html2pdf().set(opt).from(element).save();
    }
    </script>';

    $style = '<style>
                *{
                    font-size: 12px;
                }
                body {
                    background-color: black;
                }
                .border{
                    border: 1px solid black !important;
                    border-collapse: collapse; vertical-align: middle;
                    text-align: center; 
                }
                #data {
                    margin: 0 auto;
                    padding: 22mm 8mm 22mm 8mm;
                    width: 297mm;
                    min-height: 210mm;
                    background-color: white;
                }
                .center {
                    text-align: center;
                    padding: 10px;
                }
            </style>';

    $html = '<h1 style="font-size: 15px; text-decoration:underline; font-weight: 600; text-align: center;">दैनिक प्रतिवेदन प्रतिबंधात्मकता कार्यवाही/लघु अधिनियम रेंज सरगुजा दिनाक - ' . $date . ' प्रेषित दिनाक ' . get_next_date($date) . '</h1>';
    if ($district != "All") {
        $html .= '<table class="border" style="margin:auto; margin-top:10px; min-width:280mm;">
        <tr>
            <th class="border" colspan=30>जिला - ' . $district . '</th>
        </tr>
        <tr>        
            <th rowspan=2 class="border">क्र.</th>
            <th rowspan=2 class="border">थाना</th>';
        foreach ($data['penal_codes'] as $penal_code) {
            $html .= '<th class="border" colspan=2>' . $penal_code['penal_code'] . '</th>';
        }

        $html .= '</tr><tr>';
        for ($i = 1; $i <= 14; $i++) {
            $html .= '<td class="border">प्र.</td>
        <td class="border">व्य.</th>';
        }
        $html .= "</tr>";
        $x = 1;
        foreach ($data['crime_sum'][$district] as $name => $info) {
            $html .= "<tr><th class ='border'>" . $x++ . "</th>
            <th class='border'>" . $name . "</th>";

            foreach ($data['penal_codes'] as $penal_codes) {
                if (!($info[$penal_codes['penal_code']]['case_count'])) {
                    $info[$penal_codes['penal_code']]['case_count'] = "";
                }
                $html .= "<td class='border'>" . $info[$penal_codes['penal_code']]['case_count'] . "</td>
                <td class='border'>" . $info[$penal_codes['penal_code']]['people_count'] . "</td>";
            }
        }
        $html .= '</table>';
    } else {
        foreach (districts() as $dist) {
            $district = $dist['district'];
            $html .= '<table class="border separate" style="margin:auto; margin-top:10px; min-width:280mm;">
            <tr>
                <th class="border" colspan=30>जिला - ' . $district . '</th>
            </tr>
            <tr>        
                <th rowspan=2 class="border">क्र.</th>
                <th rowspan=2 class="border">थाना</th>';
            foreach ($data['penal_codes'] as $penal_code) {
                $html .= '<th class="border" colspan=2>' . $penal_code['penal_code'] . '</th>';
            }

            $html .= '</tr><tr>';
            for ($i = 1; $i <= 14; $i++) {
                $html .= '<td class="border">प्र.</td>
            <td class="border">व्य.</th>';
            }
            $html .= "</tr>";
            $x = 1;
            foreach ($data['crime_sum'][$district] as $name => $info) {
                $html .= "<tr><th class ='border'>" . $x++ . "</th>
                <th class='border'>" . $name . "</th>";

                foreach ($data['penal_codes'] as $penal_codes) {
                    if (!($info[$penal_codes['penal_code']]['case_count'])) {
                        $info[$penal_codes['penal_code']]['case_count'] = "";
                    }
                    $html .= "<td class='border'>" . $info[$penal_codes['penal_code']]['case_count'] . "</td>
                    <td class='border'>" . $info[$penal_codes['penal_code']]['people_count'] . "</td>";
                }
            }
            $html .= '</table>';
        }
    }
    if ($type) {
        return '<!DOCTYPE html>
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
            <div class="center"><button class="btn btn-lg btn-success" onclick="downloadpdf()">Print</button></div>
            <div class="main" id="data">' . $html . '</div>
            </body>
            </html>';
    } else {
        return $html;
    }
}

function major_crime_pdf($date, $district, $data, $type = 1)
{
    $script = '<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script><script>
    function downloadpdf() {
        const element = document.getElementById("data");

        const opt = {
            margin: 0,
            filename: "Major Crime-' . $district . ' (' . $date . ').pdf",
            image: { type: "jpeg", quality: 1 },
            html2canvas: { scale: 4 },
            jsPDF: { unit: "mm", format: "a4", orientation: "landscape" },
            pagebreak: { mode: ["avoid-all"] }, // Optional: Avoid page breaks within table rows
            html2pdf: { 
              margin: { top: 10, right: 0, bottom: 10, left: 0 },
              filename: "Major Crime-' . $district . ' (' . $date . ').pdf",
              image: { type: "jpeg", quality: 1 },
              html2canvas: { scale: 4 },
              jsPDF: { unit: "mm", format: "a4", orientation: "landscape" }
            }
          };

    
        html2pdf().set(opt).from(element).save();
    }
    </script>';

    $style = '<style>
    *{
        font-size: 14px;
    }
    body {
        background-color: black;
    }
    .border{
        border: 1px solid black !important;
        border-collapse: collapse;
        vertical-align: middle;
        text-align: center; 
    }
    #data {
        margin: 0 auto;
        padding: 13mm 5mm 13mm 5mm;
        width: 297mm;
        min-height: 210mm;
        background-color: white;
    }
    .center {
        text-align: center;
        padding: 10px;
    }
</style>';

    $html = '<h1 style="font-size: 21px; text-decoration:underline; font-weight: 600; text-align: center;">' . $district . ' में घटित समस्त गंभीर अपराधों की जानकारी (डी. एस. आर.) 
    <br> दिनाक - ' . $date . ' प्रेषित दिनाक ' . get_next_date($date) . '</h1>
    <h2 style="font-size: 21px;">जिला — ' . $district . '</h2>
    <table class="border" style="margin:auto; margin-top:10px; min-width:285mm;">
    <tr>
        <th class="border" style="width: 3%;">क्र.</th>
        <th class="border" style="width: 4%;">पुलिस <br>थाना</th>
        <th class="border" style="width: 4%;">अप.क्र.</th>
        <th class="border" style="width: 4%;">धारा</th>
        <th class="border" style="width: 8%;">प्रार्थी का नाम व पता</th>
        <th class="border" style="width: 8%;">घटना दिनांक<br> व समय</th>
        <th class="border" style="width: 5%;">घटना स्थल</th>
        <th class="border" style="width: 8%;">सूचना दिनाक<br> व समय</th>
        <th class="border" style="width: 8%;">कायमीकर्ता</th>
        <th class="border" style="width: 10%;">आरोपी / संदिग्ध का नाम व पता</th>
        <th class="border" style="width: 8%;">गिरफ्तारी दिनाक<br> व समय</th>
        <th class="border" style="width: 10%;">मृतक - मृतिका / आहत - आहता / पीड़ित - पीड़िता का नाम</th>
        <th class="border" style="width: 40%;">विवरण</th>
    </tr>
    ';

    $i = 1;
    foreach ($data['major_crimes'] as $row) {
        if ($row['is_major_crime']) {
            $victim_name = "";
        } else {
            $victim_name = $row['victim_name'];
        }
        $html .= "<tr>
        <td class='border'>
            " . $i++ . "
        </td>
        <td class='border'>
            " . $row['police_station'] . " 
        </td>
        <td class='border'>
            " . $row['crime_number'] . " 
        </td>
        <td class='border'>
            " . $row['penal_code'] . " 
        </td>
        <td class='border'>
            " . $row['applicant_name'] . " " . $row['applicant_address'] . " 
        </td>
        <td class='border'>
            " . $row['incident_date'] . " " . $row['incident_time'] . " 
        </td>
        <td class='border'>
            " . $row['incident_place'] . " 
        </td>
        <td class='border'>
            " . $row['reporting_date'] . " " . $row['reporting_time'] . " 
        </td>
        <td class='border'>
            " . $row['fir_writer'] . " 
        </td>
        <td class='border'>
            " . $row['culprit_name'] . " " . $row['culprit_address'] . " 
        </td>
        <td class='border'>
            " . $row['arrest_date'] . " " . $row['arrest_time'] . " 
        </td>
        <td class='border'>
            " . $victim_name . " 
        </td>
        <td class='border'>
            " . $row['description_of_crime'] . " 
        </td>
    </tr>";
    }
    $html .= "</table>";
    if ($type) {
        return '<!DOCTYPE html>
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
            <div class="center"><button class="btn btn-lg btn-success" onclick="downloadpdf()">Print</button></div>
            <div class="main" id="data">' . $html . '</div>
            </body>
            </html>';
    } else {
        return $html;
    }
}

function crime_pdf($date, $district, $data, $type = 1)
{
    $script = '<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script><script>
    function downloadpdf() {
        const element = document.getElementById("data");
        const opt = {
            margin: [0, 0, 0, 0],
            filename: "Crime-' . $district . ' (' . $date . ').pdf",
            image: { type: "jpeg", quality: 1 },
            html2canvas: { scale: 4 },
            jsPDF: { unit: "mm", format: "a4", orientation: "landscape" }
        }
    
        html2pdf().set(opt).from(element).save();
    }
    </script>';

    $style = '<style>
    *{
        font-size: 14px;
    }
    body {
        background-color: black;
    }
    .border{
        border: 1px solid black !important;
        border-collapse: collapse;
        vertical-align: middle;
        text-align: center; 
    }
    #data {
        margin: 0 auto;
        padding: 13mm 5mm 13mm 5mm;
        width: 297mm;
        min-height: 210mm;
        background-color: white;
    }
    .center {
        text-align: center;
        padding: 10px;
    }
</style>';

    $html = '<h1 style="font-size: 21px; text-decoration:underline; font-weight: 600; text-align: center;">' . $district . ' में घटित समस्त अपराधों की जानकारी (डी. एस. आर.) 
    <br> दिनाक - ' . $date . ' प्रेषित दिनाक ' . get_next_date($date) . '</h1>
    <h2 style="font-size: 21px;">जिला — ' . $district . '</h2>
    <table class="border" style="margin:auto; margin-top:10px; min-width:285mm;">
    <tr>
        <th class="border" style="width: 3%;">क्र.</th>
        <th class="border" style="width: 4%;">पुलिस <br>थाना</th>
        <th class="border" style="width: 4%;">अप.क्र.</th>
        <th class="border" style="width: 4%;">धारा</th>
        <th class="border" style="width: 8%;">प्रार्थी का नाम व पता</th>
        <th class="border" style="width: 8%;">घटना दिनांक<br> व समय</th>
        <th class="border" style="width: 5%;">घटना स्थल</th>
        <th class="border" style="width: 8%;">सूचना दिनाक<br> व समय</th>
        <th class="border" style="width: 8%;">कायमीकर्ता</th>
        <th class="border" style="width: 10%;">आरोपी / संदिग्ध का नाम व पता</th>
        <th class="border" style="width: 8%;">गिरफ्तारी दिनाक<br> व समय</th>
        <th class="border" style="width: 10%;">मृतक - मृतिका / आहत - आहता / पीड़ित - पीड़िता का नाम</th>
        <th class="border" style="width: 40%;">विवरण</th>
    </tr>
    ';

    $i = 1;
    foreach ($data['crimes'] as $row) {
        if ($row['is_major_crime']) {
            $victim_name = "";
        } else {
            $victim_name = $row['victim_name'];
        }
        $html .= "<tr>
        <td class='border'>
            " . $i++ . "
        </td>
        <td class='border'>
            " . $row['police_station'] . " 
        </td>
        <td class='border'>
            " . $row['crime_number'] . " 
        </td>
        <td class='border'>
            " . $row['penal_code'] . " 
        </td>
        <td class='border'>
            " . $row['applicant_name'] . " " . $row['applicant_address'] . " 
        </td>
        <td class='border'>
            " . $row['incident_date'] . " " . $row['incident_time'] . " 
        </td>
        <td class='border'>
            " . $row['incident_place'] . " 
        </td>
        <td class='border'>
            " . $row['reporting_date'] . " " . $row['reporting_time'] . " 
        </td>
        <td class='border'>
            " . $row['fir_writer'] . " 
        </td>
        <td class='border'>
            " . $row['culprit_name'] . " " . $row['culprit_address'] . " 
        </td>
        <td class='border'>
            " . $row['arrest_date'] . " " . $row['arrest_time'] . " 
        </td>
        <td class='border'>
            " . $victim_name . " 
        </td>
        <td class='border'>
            " . $row['description_of_crime'] . " 
        </td>
    </tr>";
    }

    $html .= "</table>";
    if ($type) {
        return '<!DOCTYPE html>
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
            <div class="center"><button class="btn btn-lg btn-success" onclick="downloadpdf()">Print</button></div>
            <div class="main" id="data">' . $html . '</div>
            </body>
            </html>';
    } else {
        return $html;
    }
}

function deadbody_pdf($date, $district, $data, $type = 1)
{
    $script = '<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script><script>
    function downloadpdf() {
        const element = document.getElementById("data");
        const opt = {
          margin: 0,
          filename: "Deadbody-' . $district . ' (' . $date . ').pdf",
          image: { type: "jpeg", quality: 1 },
          html2canvas: { scale: 4 },
          jsPDF: { unit: "mm", format: "a4", orientation: "landscape" },
          pagebreak: { mode: ["avoid-all"] }, // Optional: Avoid page breaks within table rows
          html2pdf: { 
            margin: { top: 10, right: 0, bottom: 10, left: 0 },
            filename: "Deadbody-' . $district . ' (' . $date . ').pdf",
            image: { type: "jpeg", quality: 1 },
            html2canvas: { scale: 4 },
            jsPDF: { unit: "mm", format: "a4", orientation: "landscape" }
          }
        };
      
        html2pdf().set(opt).from(element).save();
      }
    </script>';

    $style = '<style>
    
    *{
        font-size: 15px;
    }
    body {
        background-color: black;
    }
    .border{
        border: 1px solid black !important;
        border-collapse: collapse;
        vertical-align: middle;
        text-align: center; 
    }
    #data {
        margin: 0 auto;
        padding: 13mm 5mm 13mm 5mm;
        width: 297mm;
        min-height: 210mm;
        background-color: white;
    }
    .center {
        text-align: center;
        padding: 10px;
    }
</style>';

    $html = "<h1 style='font-size: 21px; text-decoration:underline; font-weight: 600; text-align: center; margin-bottom: 20px;'>जिला " . $district . " मर्ग की जानकारी दिनाक - " . $date . " प्रेषित दिनाक " . get_next_date($date) . "</h1>
    <table class='border' style='margin:auto; margin-top:10px; min-width:285mm;'>
    <tr>
        <th class='border' style='width: 3%;'>क्र.</th>
        <th class='border' style='width: 4%;'>पुलिस <br>थाना</th>
        <th class='border' style='width: 4%;'>मर्ग <br> क्रमांक</th>
        <th class='border' style='width: 4%;'>धारा</th>
        <th class='border' style='width: 8%;'>घटना दिनांक<br> व समय</th>
        <th class='border' style='width: 5%;'>घटना स्थान</th>
        <th class='border' style='width: 8%;'>सूचना दिनांक<br> व समय</th>
        <th class='border' style='width: 10%;'>प्रार्थी</th>
        <th class='border' style='width: 10%;'>मृतक/मृतिका<br> का नाम</th>
        <th class='border' style='width: 10%;'>कायमीकर्ता<br>का नाम</th>
        <th class='border' style='width: 40%;'>सबब मौत</th>
    </tr>

    ";

    $i = 1;
    foreach ($data['deadbodies'] as $row) {
        $html .= "<tr>
        <td class='border'>
            " . $i++ . "
        </td>
        <td class='border'>
            " . $row['police_station'] . " 
        </td>
        <td class='border'>
            " . $row['dead_body_number'] . " 
        </td>
        <td class='border'>
            " . $row['penal_code'] . " 
        </td>
        <td class='border'>
        " . $row['accident_date'] . " " . $row['accident_time'] . " 
        </td>
        <td class='border'>
        " . $row['accident_place'] . "
        </td>
        <td class='border'>
        " . $row['information_date'] . " " . $row['information_time'] . " 
        </td>
        <td class='border'>
        " . $row['applicant_name'] . "
        </td>
        <td class='border'>
        " . $row['deceased_name'] . " 
        </td>
        <td class='border'>
        " . $row['fir_writer'] . " 
        </td>
        <td class='border'>
        " . $row['cause_of_death'] . "  
        </td>
    </tr>";
    }
    $html .= "</table>";
    if ($type) {
        return '<!DOCTYPE html>
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
            <div class="center"><button class="btn btn-lg btn-success" onclick="downloadpdf()">Print</button></div>
            <div class="main" id="data">' . $html . '</div>
            </body>
            </html>';
    } else {
        return $html;
    }
}

function achievements_pdf($date, $district, $data, $type = 1)
{
    $script = '<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script><script>
    function downloadpdf() {
        const element = document.getElementById("data");

        const opt = {
            margin: 0,
            filename: "Achievements-' . $district . ' (' . $date . ').pdf",
            image: { type: "jpeg", quality: 1 },
            html2canvas: { scale: 4 },
            jsPDF: { unit: "mm", format: "a4", orientation: "landscape" },
            pagebreak: { mode: ["avoid-all"] }, // Optional: Avoid page breaks within table rows
            html2pdf: { 
              margin: { top: 10, right: 0, bottom: 10, left: 0 },
              filename: "Achievements-' . $district . ' (' . $date . ').pdf",
              image: { type: "jpeg", quality: 1 },
              html2canvas: { scale: 4 },
              jsPDF: { unit: "mm", format: "a4", orientation: "landscape" }
            }
          };

    
        html2pdf().set(opt).from(element).save();
    }
    </script>';

    $style = '<style>
    *{
        font-size: 14px;
    }
    body {
        background-color: black;
    }
    .border{
        border: 1px solid black !important;
        border-collapse: collapse;
        vertical-align: middle;
        text-align: center; 
    }
    #data {
        margin: 0 auto;
        padding: 13mm 10mm 13mm 5mm;
        width: 297mm;
        min-height: 210mm;
        background-color: white;
    }
    .center {
        text-align: center;
        padding: 10px;
    }
</style>';

    $html = "<h1 style='font-size: 21px; text-decoration:underline; font-weight: 600; text-align: center; margin-bottom: 20px;'>जिला " . $district . " की महत्पूर्ण कार्यवाहिया / उपलब्धियां </h1>
    <h2 style='font-size: 17px; text-decoration:underline; font-weight: 600; text-align: center; margin-bottom: 20px;'> दिनाक - " . $date . " प्रेषित दिनाक " . get_next_date($date) . "</h2>
    <table class='border' style='margin:auto; margin-top:10px; min-width:285mm;'>
    <tr>
        <th class='border' style='width: 3%;'>क्र.</th>
        <th class='border' style='width: 5%;'>थाना/चौकी</th>
        <th class='border' style='width: 17%;'>गंभीर अपराधों में गिरफ्तारि/ महत्वपूर्ण गिरफ्तारि</th>
        <th class='border' style='width: 12%;'>कोर्ट द्वारा दिए गये<br> निर्णय (दोषमुक्त / सजा <br>/ जमानत /रद्द)</th>
        <th class='border' style='width: 14%;'>आपरेशन मुस्कान / गुम इंसान दस्तायी</th>
        <th class='border' style='width: 8%;'>डकैती / लुट /<br> चोरी का खुलासा</th>
        <th class='border' style='width: 20%;'>विविध जैसे जन जागरुकता अभियान मे विशेष सफलता या प्राण रक्षा,गिरफ्तारी वारंटो की तमिलि आदि</th>
        <th class='border' style='width: 7%'>धारा 102 के<br> तहत कि गई<br> कार्यवाही</th>
    </tr>
    ";

    $i = 1;
    foreach ($data['achievements'] as $row) {
        $html .= "<tr>
        <td class='border'>
            " . $i++ . "
        </td>
        <td class='border'>
            " . $row['police_station'] . " 
        </td>
        <td class='border'>
            " . $row['arrest_in_major_crime'] . " 
        </td>
        <td class='border'>
            " . $row['decision_given_by_the_court'] . " 
        </td>
        <td class='border'>
        " . $row['missing_man_document'] . " 
        </td>
        <td class='border'>
        " . $row['robbery'] . "
        </td>
        <td class='border'>
        " . $row['miscellaneous'] . " 
        </td>
        <td class='border'>
        " . $row['action_taken_under'] . "
        </td>
    </tr>";
    }
    $html .= "</table>";
    if ($type) {
        return '<!DOCTYPE html>
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
            <div class="center"><button class="btn btn-lg btn-success" onclick="downloadpdf()">Print</button></div>
            <div class="main" id="data">' . $html . '</div>
            </body>
            </html>';
    } else {
        return $html;
    }
}

function judgements_pdf($date, $district, $data, $type = 1) //Court judgement() / कोर्ट का निर्णय
{
    $script = '<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script><script>
    function downloadpdf() {
        const element = document.getElementById("data");

        const opt = {
            margin: 0,
            filename: "Court Judgements-' . $district . ' (' . $date . ').pdf",
            image: { type: "jpeg", quality: 1 },
            html2canvas: { scale: 4 },
            jsPDF: { unit: "mm", format: "a4", orientation: "landscape" },
            pagebreak: { mode: ["avoid-all"] }, // Optional: Avoid page breaks within table rows
            html2pdf: { 
              margin: { top: 10, right: 0, bottom: 10, left: 0 },
              filename: "Court Judgements-' . $district . ' (' . $date . ').pdf",
              image: { type: "jpeg", quality: 1 },
              html2canvas: { scale: 4 },
              jsPDF: { unit: "mm", format: "a4", orientation: "landscape" }
            }
          };

    
        html2pdf().set(opt).from(element).save();
    }
    </script>';

    $style = '<style>
    *{
        font-size: 14px;
    }
    body {
        background-color: black;
    }
    .border{
        border: 1px solid black !important;
        border-collapse: collapse;
        vertical-align: middle;
        text-align: center; 
    }
    #data {
        margin: 0 auto;
        padding: 20mm 20mm 14mm 14mm;
        width: 297mm;
        min-height: 210mm;
        background-color: white;
    }
    .center {
        text-align: center;
        padding: 10px;
    }
</style>';

    $html = "<h1 style='font-size: 20px; text-decoration:underline; font-weight: 600; text-align: center; margin-bottom: 20px;'>कोर्ट द्वारा निर्णय जिला " . $district . " (छ.ग.) </h1>
    <h2 style='font-size: 16px; text-decoration:underline; font-weight: 600; text-align: center; margin-bottom: 20px;'> दिनाक - " . $date . " प्रेषित दिनाक " . get_next_date($date) . "</h2>
    <table class='border' style='margin:auto; margin-top:10px; min-width:260mm;'>
    <tr>
        <th class='border' style='width: 3%;'>क्र.</th>
        <th class='border' style='width: 5%;'>थाना/चौकी</th>
        <th class='border' style='width: 10%;'>कोर्ट का नाम</th>
        <th class='border' style='width: 6%;'>अप. क्र.</th>
        <th class='border' style='width: 6%;'>धारा</th>
        <th class='border' style='width: 8%'>कायमी दिनांक</th>
        <th class='border' style='width: 10%;'>आरोपी का नाम व पता</th>
        <th class='border' style='width: 8%;'>दिनांक</th>
        <th class='border' style='width: 40%;'>निर्णय</th>
    </tr>
    ";

    $i = 1;
    foreach ($data['judgements'] as $row) {
        $html .= "<tr>
        <td class='border'>
            " . $i++ . "
        </td>
        <td class='border'>
            " . $row['police_station'] . " 
        </td>
        <td class='border'>
            " . $row['court_name'] . " 
        </td>
        <td class='border'>
            " . $row['crime_number'] . " 
        </td>
        <td class='border'>
        " . $row['penal_code'] . " 
        </td>
        <td class='border'>
        " . $row['result_date'] . "
        </td>
        <td class='border'>
        " . $row['culprit_name'] . " " . $row['culprit_address'] . " 
        </td>
        <td class='border'>
        " . (new DateTime($row['updated_at']))->format('Y-m-d') . "
        </td>
        <td class='border'>
        " . $row['judgement_of_court'] . "
        </td>
    </tr>";
    }
    $html .= "</table>";
    if ($type) {

        return '<!DOCTYPE html>
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
            <div class="center"><button class="btn btn-lg btn-success" onclick="downloadpdf()">Print</button></div>
            <div class="main" id="data">' . $html . '</div>
            </body>
            </html>';
    } else {
        return $html;
    }
}

function disposals_pdf($date, $district, $data, $type = 1)
{
    $script = '<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script><script>
                    function downloadpdf() {
                        const element = document.getElementById("data");

                        const opt = {
                            margin: 0,
                            filename: "Disposals-' . $district . ' (' . $date . ').pdf",
                            image: { type: "jpeg", quality: 1 },
                            html2canvas: { scale: 4 },
                            jsPDF: { unit: "mm", format: "a4", orientation: "landscape" },
                            pagebreak: { mode: ["avoid-all"] }, // Optional: Avoid page breaks within table rows
                            html2pdf: { 
                              margin: { top: 10, right: 0, bottom: 10, left: 0 },
                              filename: "Disposals-' . $district . ' (' . $date . ').pdf",
                              image: { type: "jpeg", quality: 1 },
                              html2canvas: { scale: 4 },
                              jsPDF: { unit: "mm", format: "a4", orientation: "landscape" }
                            }
                          };
                    
                        html2pdf().set(opt).from(element).save();
                    }
                    </script>';

    $style = '<style>
                    *{
                        font-size: 17px;
                    }
                    body {
                        background-color: black;
                    }
                    .border{
                        border: 1px solid black !important;
                        border-collapse: collapse;
                        vertical-align: middle;
                        text-align: center; 
                    }
                    #data {
                        margin: 0 auto;
                        padding: 20mm 20mm 14mm 14mm;
                        width: 297mm;
                        min-height: 210mm;
                        background-color: white;
                    }
                    .center {
                        text-align: center;
                        padding: 10px;
                    }
                </style>';

    $html = "<h1 style='font-size: 20px; text-decoration:underline; font-weight: 600; text-align: center; margin-bottom: 20px;'>अपराध, मर्ग, शिकायत के प्रतिदिन निकाल की दैनिक रिपोर्ट की जानकारी जिला " . $district . "</h1>
    <h2 style='font-size: 13px; text-decoration:underline; font-weight: 300; text-align: center; margin-bottom: 20px;'> दिनाक - 01.01." . date('Y') . " से प्रेषित दिनाक " . $date . "</h2>
    <table class='border' style='margin:auto; margin-top:10px; min-width:260mm;'>";
    $html .= '<tr>        
                <th rowspan=2 class="border">क्र.</th>
                <th rowspan=2 class="border">थाना/चौकी का नाम</th>
                <th colspan=2 class="border">अपराध</th>
                <th colspan=2 class="border">मर्ग</th>
                <th colspan=2 class="border">शिकायत</th>
            </tr><tr>';
    for ($i = 1; $i < 4; $i++) {
        $html .= '<th class="border">पिछला निकाल</th>
                <th class="border">आज का निकाल</th>';
    }
    $i = 0;
    foreach ($data['disposals_crime_old'] as $row => $y) {
        $html .= "<tr>
            <td class='border'>
                " . $i++ . "
            </td>
            <td class='border'>
                " . $row . "
            </td>
            <td class='border'>
                " . $data['disposals_crime_old'][$row] . " 
            </td>
            <td class='border'>
                " . $data['disposals_crime'][$row] . " 
            </td>
            <td class='border'>
                " . $data['disposals_deadbody_old'][$row] . " 
            </td>
            <td class='border'>
                " . $data['disposals_deadbody'][$row] . " 
            </td>
            <td class='border'>
                TODO 
            </td>
            <td class='border'>
                TODO
            </td>
        </tr>";
    }
    $html .= '<tr>
                <th class="border" colspan=2>
                    योग
                </th>
                <th class="border">
                    ' . sum_elements($data['disposals_crime_old']) . '
                </th>
                <th class="border">
                    ' . sum_elements($data['disposals_crime']) . '
                </th>
                <th class="border">
                    ' . sum_elements($data['disposals_deadbody_old']) . '
                </th>
                <th class="border">
                    ' . sum_elements($data['disposals_deadbody']) . '
                </th>
                <th class="border">
                    ' . sum_elements($data['disposals_complain_old']) . '
                </th>
                <th class="border">
                    ' . sum_elements($data['disposals_complain']) . '
                </th>
            </tr>
            </table>';
    if ($type) {
        return '<!DOCTYPE html>
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
        <div class="center"><button class="btn btn-lg btn-success" onclick="downloadpdf()">Print</button></div>
        <div class="main" id="data">' . $html . '</div>
        </body>
        </html>';
    } else {
        return $html;
    }
}
