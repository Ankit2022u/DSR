<?php
function summary_pdf($date, $district, $data)
{
    $script = "<script src='https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js'></script>
    <script>
        function downloadpdf() {
            const data = document.getElementById('data');
            const options = {
                margin: [0, 0, 0, 0],
                filename: 'Summary-" . $district . " (" . $date . ").pdf',
                image: { type: 'jpeg', quality: 1 },
                html2canvas: { scale: 4 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };
            html2pdf().set(options).from(data).save();
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
                        height: 297mm;
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
}

function application_pdf($date, $district, $data)
{
    $style = '<style>
    body {
        background-color: black;
    }

    #data {
        margin: 0 auto;
        padding: 15mm 18mm 30mm 13mm;
        width: 210mm;
        height: 297mm;
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
</style>';

    $script = '<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script><script>
function downloadpdf() {
    const element = document.getElementById("data");
    const opt = {
        margin: [0, 0, 0, 0],
        filename: "Application-' . $district . ' (' . $date . ').pdf",
        image: { type: "jpeg", quality: 1 },
        html2canvas: { scale: 4 },
        jsPDF: { unit: "mm", format: "a4", orientation: "portrait" }
    }

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

विषय - डी०एस०आर० नये प्रारूप के मुताबिक दिनांक '.$date.'
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
        <td>- </td>
        <td>' . $data['gangrape_count'] . '</td>
    </tr>
    <tr>
        <td>2.</td>
        <td>नर बलि प्रकरण </td>
        <td>- </td>
        <td>TODO</td>
    </tr>
    <tr>
        <td>3.</td>
        <td>महत्वपूर्ण गुम इंसान</td>
        <td>- </td>
        <td>TODO</td>
    </tr>
    <tr>
        <td>4.</td>
        <td>महत्वपूर्ण हत्या</td>
        <td>- </td>
        <td>TODO</td>
    </tr>
    <tr>
        <td>5.</td>
        <td>चोरी</td>
        <td>- </td>
        <td>TODO</td>
    </tr>
    <tr>
        <td>6.</td>
        <td>लूट</td>
        <td>- </td>
        <td>' . $data['robbery_count'] . '</td>
    </tr>
    <tr>
        <td>7.</td>
        <td>डकैती</td>
        <td>- </td>
        <td>' . $data['dacoity_count'] . '</td>
    </tr>
    <tr>
        <td>8.</td>
        <td>फिरौती हेतु अपहरण</td>
        <td>- </td>
        <td>' . $data['kidnap_for_ransom_count'] . '</td>
    </tr>
    <tr>
        <td>9.</td>
        <td>महत्वपूर्ण नक्सली अपराध</td>
        <td>- </td>
        <td>TODO</td>
    </tr>
    <tr>
        <td>10.</td>
        <td>पुलिस कर्मचारियों की हत्या या उन पर हमला</td>
        <td>- </td>
        <td></td>
    </tr>

</tbody>
</table>

<pre style="margin-top: 3px; font-size: 16px; padding: 0px;">

प्रतिलिपि:-
01.	आईजी रेंज सरगुजा                                    प्रभारी
                                                कंट्रोल रूम रेंज सरगुजा</pre>';

    $inner_style = '';

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

}

?>