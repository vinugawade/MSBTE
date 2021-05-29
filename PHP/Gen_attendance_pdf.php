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

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

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
$selectdata->execute([':idate'=> @$_POST["ex_date"],':isession'=> @$_POST["session"],':idept'=> @$_POST["dept"]]);
$data = $selectdata->fetchAll();
$subject=$data[0]['subject'];
$scheme=$data[0]['scheme'];
$sem=$data[0]['year_sem'];
$sub_code= (int) filter_var($subject, FILTER_SANITIZE_NUMBER_INT);
$dep=array("Computer"=>"CO","Mechanical"=>"ME","Civil"=>"CE","Electrical"=>"EE");
$course_code=$dep[$course_name]."-".$sem[-1]."-".$scheme[0];


$select_seat_no = (new PDO("sqlite:../DataBase/ExamDB.db"))->prepare("SELECT * FROM `Students` WHERE `department`=:idept AND `year_sem`=:iyear_sem AND `seat_no` BETWEEN :istart AND :iend");
$select_seat_no->bindValue(':idept', $course_name);
$select_seat_no->bindValue(':iyear_sem', $sem);
$select_seat_no->bindValue(':istart', @$_POST["start"]);
$select_seat_no->bindValue(':iend', @$_POST["end"]);
$select_seat_no->execute([':idept'=>$course_name,':iyear_sem'=>$sem,':istart'=> @$_POST["start"],':iend'=> @$_POST["end"]]);

$fetch_data = $select_seat_no->fetchAll();


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

<table cellpadding="2">
<tr><td style="text-align:left;"><strong>Exam : Summer/Winter </strong>'.$year.'</td><td style="text-align:left;"><strong>Institute Code:</strong> 1742</td></tr>
<tr><td style="text-align:left;"><strong>Session:</strong> '.$session.' </td><td style="text-align:left;"><strong>Course Name :</strong>'.$course_name.' </td></tr>
<tr><td style="text-align:left;"><strong>Course Code :</strong>'.$course_code.'</td><td style="text-align:left;"><strong>Subject : </strong>'.$subject.' </td></tr>
<tr><td style="text-align:left;"><strong>Subject Code: </strong>'.$sub_code.'</td><td style="text-align:left;"><strong>Date:</strong> '.$date.'</td></tr>
<tr><td colspan="2" style="text-align:left;"><strong>Name of Supervisor:</strong> '.$supername.'</td><td style="text-align:left;"></td></tr>
</table><br>

<style>
td{text-align:center;}
</style>
<strong>
<table border="1" cellpadding="2">
<tr><td width="30">Sr.No</td><td width="100">Exam Seat No</td><td width="100">Main Answer Book No</td><td width="130">Supplement Number</td><td width="130">Sign</td></tr>
';
for ($i=1; $i<=30; $i++) {
$html.='<tr><td width="30">'.$i.' </td>   <td width="100"> '.@$fetch_data[$i-1]["seat_no"].' </td>            <td width="100">  </td>                   <td width="130">  </td>                 <td width="130">  </td></tr>';

}
$html.='</table>
</strong>
<p>
    <strong>Total Present :__________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Absent:____________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.count($fetch_data).' &nbsp;
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