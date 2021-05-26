<?php

// Include the main TCPDF library (search for installation path).
require_once('./includes/TCPDF/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Vinay Gawade');
$pdf->SetTitle('Student Attendance');
$pdf->SetSubject('Student Attendance Page Generation Into PDF');
$pdf->SetKeywords('Student, PDF, Attendance');
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

$year = date('Y');

// $html = " $_POST[block_no] - $_POST[ex_date] - $_POST[session] - ".substr(strval($_POST['ex_date']),0,4)." - $_POST[supervisor] - $_POST[dept] ";
$html='
<p>
    <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Maharashtra State Board of Technical Education, Mumbai </strong>
</p>
<p>
    <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;End Semester Examination Theory (WINTER/SUMMER) </strong>
</p>
<p>
    <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supervisor Report </strong>
</p>
<!--
<p><strong>Exam : Summer/Winter 2019 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Institute Code: 1742 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Course/Year/Semester Master :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Session: M/A &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Course Name :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Course Code : </strong>
    <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>Subject : IEN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Subject Code:&nbsp;17639 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name of Supervisor: </strong>
</p>-->

<strong>
<table>
<tr><td style="text-align:left;">Exam : Summer/Winter 2019</td><td style="text-align:left;">Institute Code: 1742</td></tr>
<tr><td style="text-align:left;">Course/Year/Semester Master : </td><td style="text-align:left;">Session: M/A</td></tr>
<tr><td style="text-align:left;">Course Name : </td><td style="text-align:left;">Course Code :</td></tr>
<tr><td style="text-align:left;">Subject : IEN </td><td style="text-align:left;">Subject Code: 17639</td></tr>
<tr><td style="text-align:left;">Date: </td><td style="text-align:left;">Name of Supervisor:</td></tr>
</table>
</strong><br>


<table border="1">
<tr><td width="30">Sr.No</td><td width="100">Exam Seat No</td><td width="100">Main Answer Book No</td><td width="130">Supplement Number</td><td width="130">Sign</td></tr>
<tr><td width="30"> 1</td>   <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 2</td>   <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 3</td>   <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 4</td>   <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 5</td>   <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 6</td>   <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 7</td>   <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 8</td>   <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 9</td>   <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 10</td>  <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 11</td>  <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 12</td>  <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 13</td>  <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 14</td>  <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 15</td>  <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 16</td>  <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 17</td>  <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 18</td>  <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 19</td>  <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 20</td>  <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 21</td>  <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 22</td>  <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 23</td>  <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 24</td>  <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 25</td>  <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 26</td>  <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 27</td>  <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 28</td>  <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 29</td>  <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
<tr><td width="30"> 30</td>  <td width="100"></td>            <td width="100"></td>                   <td width="130"></td>                 <td width="130"></td></tr>
</table>
<!--
<style>td{text-align:center;}</style>
<table border="1" width="701">
    <tbody>
        <tr>
            <td width="30">
                <strong>Sr.<br>No.</strong>
            </td>
            <td width="80">
                    <strong>Exam Seat No </strong>

            </td>
            <td width="80">
                    <strong>Main Answer Book No </strong>

            </td>
            <td width="130">
                    <strong>Supplement Number &nbsp;</strong>
            </td>
            <td width="201">
                    <strong>Sign </strong>
            </td>
        </tr>
        <tr>
            <td width="30" >
                1
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                2
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                3
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                4
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                5
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                6
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                7
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                8
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                9
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                10
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                11
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                12
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                13
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                14
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                15
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                16
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                17
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                18
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                19
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                20
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                21
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                22
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                23
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                24
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                25
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                26
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                27
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                28
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                29
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="30">
                30
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="80">
                &nbsp;
            </td>
            <td width="130">
                &nbsp;
            </td>
            <td width="201">
                &nbsp;
            </td>
        </tr>
    </tbody>
</table>-->
<p>
    <strong>Total Present :__________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Absent:____________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total:_____________ &nbsp;</strong>
</p>
<p>
<p></p>
<p></p>

<table>
<tr><td>Name & sign of</td><td> Name and Sign of Officer </td></tr>
<tr><td> Supervisor</td><td> Incharge</td></tr>
</table>

</p>
<!--
<p>Name &amp;sign of &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name and Sign of Officer</p>
<p>Supervisor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Incharge</p>
->
';
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//Close and output PDF document
$pdf->Output('Attendance-Report.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+