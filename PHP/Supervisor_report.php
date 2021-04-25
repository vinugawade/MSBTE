<?php

function dataprint($cell)
{
    $getdata = (new PDO("sqlite:../DataBase/ExamDB.db"))->prepare("SELECT * ,(SELECT `date` FROM `super_notice` WHERE `super_name`=:iname GROUP BY `date`) AS `date` FROM `super_notice` WHERE `super_name`=:iname GROUP BY `session`");
    $getdata->bindValue(':iname',"Atul");
    // $getdata->bindValue(':iname', @$_POST['super_name']);
    $getdata->execute();
    $data = $getdata->fetchAll(PDO::FETCH_ASSOC);
    foreach (@$data as $row) {
        // echo"<pre>";print_r($row);
switch ($cell) {
  case 1:
    $send = '
    <td width="40">
        <strong>' . $row["date"] . '</strong>
    </td>
    ';
    break;
    case 2:
      $send =in_array("Morning",$row)? ' <td width="40">&radic;</td>' : ' <td width="40"></td>';
      break;
      case 3:
        $send =in_array("Afteroon",$row)? ' <td width="40">&radic;</td>' : ' <td width="40"></td>';
        break;

  default:

    break;
}
return $send;

        // if($cell==1){
        //     $send = '
        //     <td width="40">
        //         <strong>' . $row["date"] . '</strong>
        //     </td>
        //     ';
        //     return $send;
        // }elseif($cell==2){
        //     $send = '
        //     <td width="40">
        //         ' . in_array("Morning",$row) ? "&radic;":"" . '
        //     </td>
        //     ';
        //     return $send;
        // }elseif($cell==3){
        //     $send = '
        //     <td width="40">
        //         ' . in_array("Afteroon",$row) ? "&radic;":"" . '
        //     </td>
        //     ';
        //     return $send;
        // }

    }
}

$year = date("Y");
$super_name = "Atul";
// $super_name = @$_POST['super_name'];
$morning_time ="";
$afternoon_time = "";
// $morning_time = $_POST['morning-time'];
// $afternoon_time = $_POST['afternoon-time'];


echo '
<table border="1" width="515">
<tr>
<td>
    <p align="center">
        <strong>Shri Yashwantrao Bhonsale Education Society &rsquo;s</strong>
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
<p>Lecturer, Computer Department,</p>
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
        ' . dataprint(1) . '
</tr>
<tr>
    <td width="75">
    <strong>Morning</strong>
    </td>
        ' . dataprint(2) . '
</tr>
<tr>
    <td width="75">
    <strong>Afternoon</strong>
    </td>
        ' . dataprint(3) . '
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

//             $selectblock = (new PDO("sqlite:../DataBase/ExamDB.db"))->prepare("SELECT * FROM `blocks` WHERE `ex_date`=:idate AND `session`=:isession");
//             $selectblock->bindValue(':idate', @$_POST['date']);
//             $selectblock->bindValue(':isession', @$_POST['session']);
//             $selectblock->execute();
//             $data = $selectblock->fetchAll(PDO::FETCH_ASSOC);

//             foreach (@$data as $row) {
//                 echo"<pre>";print_r($row);

//                 $dept= implode(",",
//                     explode
//                     ("        ",trim(
//                         strval($row['dept'])," "
//                 )
//             )
//         );

//         echo count(explode(",",$dept));
//         foreach (explode(",",$dept) as $value) {
// echo $value."<br>";
//         }
//     }

?>