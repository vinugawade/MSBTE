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

$year = substr(strval($_POST['ex_date']),0,4);
$supername=@$_POST["supervisor"];
$date=@$_POST["ex_date"];
$session=@$_POST["session"];
$course_name=@$_POST["dept"];

$selectdata = (new PDO("sqlite:../DataBase/ExamDB.db"))->prepare("SELECT `subject`,`year_sem`,`scheme` FROM `TimeTable` WHERE `date`=:idate AND `session`=:isession AND `department`=:idept");
$selectdata->bindValue(':idate', @$_POST["ex_date"]);
$selectdata->bindValue(':isession', @$_POST["session"]);
$selectdata->bindValue(':idept', @$_POST["dept"]);
$selectdata->execute();
$data = $selectdata->fetchAll();
// echo"<pre>";print_r($data);
$subject=$data[0]['subject'];
$scheme=$data[0]['scheme'];
$sem=$data[0]['year_sem'];
$sub_code= (int) filter_var($subject, FILTER_SANITIZE_NUMBER_INT);
$dep=array("Computer"=>"CO","Mechanical"=>"ME","Civil"=>"CE","Electrical"=>"EE");
// $dep=($subject=='Computer' ?"CO": $subject=="Mechanical")? "ME" : $subject=="Civil" ? "CE" : $subject=="Electrical" ? "EE" : "None";
$course_code=$dep[$course_name]."-".$sem[-1]."-".$scheme[0];
// echo"<pre>";print_r($sub_code);
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
<strong>
<table>
<tr><td style="text-align:left;">Exam : Summer/Winter '.$year.'</td><td style="text-align:left;">Institute Code: 1742</td></tr>
<tr><td style="text-align:left;">Course/Year/Semester Master : </td><td style="text-align:left;">Session: '.$session.'</td></tr>
<tr><td style="text-align:left;">Course Name :'.$course_name.' </td><td style="text-align:left;">Course Code :'.$course_code.'</td></tr>
<tr><td style="text-align:left;">Subject : '.$subject.' </td><td style="text-align:left;">Subject Code: '.$sub_code.'</td></tr>
<tr><td style="text-align:left;">Date: '.$date.'</td><td style="text-align:left;">Name of Supervisor: '.$supername.'</td></tr>
</table>
</strong><br>

<style>
td{text-align:center;}
</style>
<strong>
<table border="1"  cellpadding="2">
<tr><td width="30">Sr.No</td><td width="100">Exam Seat No</td><td width="100">Main Answer Book No</td><td width="130">Supplement Number</td><td width="130">Sign</td></tr>
<tr><td width="30">1 </td>   <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">2 </td>   <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">3 </td>   <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">4 </td>   <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">5 </td>   <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">6 </td>   <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">7 </td>   <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">8 </td>   <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">9 </td>   <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">10</td>  <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">11</td>  <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">12</td>  <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">13</td>  <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">14</td>  <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">15</td>  <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">16</td>  <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">17</td>  <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">18</td>  <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">19</td>  <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">20</td>  <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">21</td>  <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">22</td>  <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">23</td>  <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">24</td>  <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">25</td>  <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">26</td>  <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">27</td>  <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">28</td>  <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">29</td>  <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
<tr><td width="30">30</td>  <td width="100">  </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>
</table>
</strong>
<p>
    <strong>Total Present :__________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Absent:____________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total:_____________ &nbsp;</strong>
</p>
<p></p>
<table>
<tr><td>Name & sign of</td><td> Name and Sign of Officer </td></tr>
<tr><td> Supervisor</td><td> Incharge</td></tr>
</table>
';
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//Close and output PDF document
$pdf->Output('Attendance-Report.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+