<?php

// Include the main TCPDF library (search for installation path).
require_once('./includes/TCPDF/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Vinay Gawade');
$pdf->SetTitle('Supervisor Notice');
$pdf->SetSubject('Supervisor Notice Generation into PDF');
$pdf->SetKeywords('Supervisor, PDF, Notice');

// set default header data
// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// set header and footer fonts
// $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
// $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
// $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// // add a page
$pdf->AddPage();
class cellchk
{
    public  $idate;
    function dataprint($cell)
    {
        $send = null;
        switch ($cell) {

            case 1:
                $getdata = (new PDO("sqlite:../DataBase/ExamDB.db"))->prepare("SELECT `date` FROM `super_notice` WHERE `super_name`=:iname GROUP BY `date`");
                $getdata->bindValue(':iname', @$_POST['super_name']);
                $getdata->execute();
                $data = $getdata->fetchAll(PDO::FETCH_ASSOC);
                for ($i = 0; $i < count($data); $i++) {
                    $this->idate .= $data[$i]['date'] . ",";
                    $send .= '<td width="40"><strong>' . $data[$i]['date'] . '</strong></td>';
                }
                break;
            case 2:

                for ($i = 0; $i < count(explode(",", $this->idate)) - 1; $i++) {
                    $getdata = (new PDO("sqlite:../DataBase/ExamDB.db"))->prepare("SELECT * FROM `super_notice` WHERE `super_name`=:iname AND `date`=:idate AND `session`='Morning'");
                    $getdata->bindValue(':iname', @$_POST['super_name']);
                    $getdata->bindValue(':idate', @explode(",", $this->idate)[$i]);
                    $getdata->execute();
                    $data = $getdata->fetchAll(PDO::FETCH_ASSOC);
                    $send .= str_contains(json_encode($data), "Morning") ? ' <td width="40">&radic;</td>' : ' <td width="40">-</td>';
                }
                break;
            case 3:
                for ($i = 0; $i < count(explode(",", $this->idate)) - 1; $i++) {
                    $getdata = (new PDO("sqlite:../DataBase/ExamDB.db"))->prepare("SELECT * FROM `super_notice` WHERE `super_name`=:iname AND `date`=:idate AND `session`='Afternoon'");
                    $getdata->bindValue(':iname', @$_POST['super_name']);
                    $getdata->bindValue(':idate', @explode(",", $this->idate)[$i]);
                    $getdata->execute();
                    $data = $getdata->fetchAll(PDO::FETCH_ASSOC);
                    $send .= str_contains(json_encode($data), "Afternoon") ? ' <td width="40">&radic;</td>' : ' <td width="40">-</td>';
                }
                break;

            default:
                echo "Not run";
                break;
        }
        return $send;
    }
}

$year = date("Y");
$super_name = @$_POST['super_name'];
$super_dept = @$_POST['super_dept'];
$morning_time = $_POST['morning-time'];
$afternoon_time = $_POST['afternoon-time'];
$cl = new cellchk();

$html = '
<table border="1" width="515">
    <tr>
        <td>
            <p align="center">
                <strong>Shri Yashwantrao Bhonsale Education Society&rsquo;s</strong>
            </p>
            <h2 align="center">
                <strong>
                    <b>YASHWANTRAO BHONSALE POLYTECHNIC</b>
                </strong>
            </h2>
            <p align="center">
                <strong>Approved by AICTE, DTE &amp;Affiliated to MSBTE Mumbai</strong>
            </p>
            <p>
                <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DTE CODE 3400 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MSBTE CODE 1740</strong>
            </p>
            <h3 align="center">
                <strong>MSBTE EXAMINATION SUMMER/WINTER - ' . $year . ' </strong>
            </h3>
        </td>
    </tr>
</table>
<p>Ref.&nbsp;No:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:</p>
<p>
    <strong>To,</strong>
</p>
<ol>
    <li>
        <strong>' . $super_name . ',</strong>
    </li>
</ol>
<p>Lecturer, ' . $super_dept . ' Department,</p>
<p>YBP, Sawantwadi.</p>
<p>
    <strong>Subject: -Appointment as Supervisor for MSBTE Summer/Winter ' . $year . '  Examination.</strong>
</p>
<p>Dear Sir,</p>
<p>
    &nbsp;&nbsp;&nbsp;With reference to the above, you have been appointed as <strong>Supervisor</strong>
    for the <strong>Summer/Winter ' . $year . '  Examination </strong>
    as per following timetable.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</p>
<p>&nbsp;&nbsp;&nbsp;You have to conduct examination as per the rules and regulations laid down by MSBTE Mumbai. Serious action will be taken against misconduct and violation of rules and regulations.</p>
<p>&nbsp;&nbsp;&nbsp;Please find enclose herewith duties &amp;responsibilities of Supervisor.</p>
<table cellspacing="0" border="1" style="text-align:center;" width="515" cellpadding="0">
    <tbody>
    <tr>
            <td width="75">
            <strong>Date/ Session</strong>
            </td>
                ' . $cl->dataprint(1) . '
    </tr>
    <tr>
            <td width="75">
            <strong>Morning</strong>
            </td>
                ' . $cl->dataprint(2) . '
    </tr>
    <tr>
            <td width="75">
            <strong>Afternoon</strong>
            </td>
                ' . $cl->dataprint(3) . '
    </tr>

    </tbody>
</table>

<p>
    <strong>Reporting Time:</strong>
</p>
<p>
    <strong>Morning</strong>
    : ' . $morning_time . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Afternoon</strong>
    : ' . $afternoon_time . '

</p>
<p>
    <strong>
        <u>Instruction for Supervisor:</u>
    </strong>
</p>
<ul>
    <li>No any leave will be sanctioned in between exam period.</li>
    <li>Do one day prior alternative arrangement of your supervision at your level in case of any emergency and inform to Exam officer In-charge.</li>
</ul>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="right">Chief Officer In-charge &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p align="right">MSBTE Examination Summer/Winter-' . $year . ' </p>
<p align="right">Exam Center: 1740 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//Close and output PDF document
$pdf->Output('Supervisor-Notice.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+