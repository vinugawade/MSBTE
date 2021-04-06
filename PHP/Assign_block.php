<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Assign Block</title>
<link rel="icon" href="./Img/home.png" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="./CSS/home.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/45cb967df4.js" crossorigin="anonymous"></script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<meta name="theme-color" content="">
</head>

<body>
<form action="./Assign_block.php" method="post">
<div>
        <select name="date" id="idate" required>
            <option value="">Select Date</option>
            <?php
            $dept = (new PDO("sqlite:../DataBase/ExamDB.db"))->prepare('SELECT * FROM `TimeTable` GROUP BY `date`');
            $dept->execute();
            $data = $dept->fetchAll();
            foreach (@$data as $row) {
                echo "<option value=" . $row['date'] . ">" . $row['date'] . "</option>";
            }
            ?>
        </select>
    </div>

    <div>
        <select name="session" id="isession" required>
            <option value="">Select Session</option>
            <?php
            $sess = (new PDO("sqlite:../DataBase/ExamDB.db"))->prepare('SELECT * FROM `TimeTable` GROUP BY `session`');
            $sess->execute();
            $data = $sess->fetchAll();
            foreach (@$data as $row) {
                echo "<option value=" . $row['session'] . ">" . $row['session'] . "</option>";
            }
            ?>
        </select>
    </div>
    <div><input type="submit" name="submit" value="Check"></div>
    </form>

   <?php if(isset($_POST['submit'])){ ?>
    <table>
        <tbody>
            <tr>
                <th>students_count</th>
                <th>Required_block</th>
            </tr>
            <tr>
                <?php
                $select = (new PDO("sqlite:../DataBase/ExamDB.db"))->prepare('SELECT cast(round(SUM(students_count)/5)+1 AS INT) AS Required_block, SUM(students_count) As students_count FROM "TimeTable" WHERE `date`=:idate AND `session`=:isession');
                $select->bindValue(':idate',@$_POST['date']);
                $select->bindValue(':isession',@$_POST['session']);
                $select->execute();
                $data = $select->fetchAll();
                foreach (@$data as $row) {
                    print("<td>" . $row['students_count'] . "</td><td>" . $row['Required_block'] . "</td>");
                    $block_count=$row['Required_block'];
                } ?>
            </tr>
        </tbody>
    </table>
<?php
$student = (new PDO("sqlite:../DataBase/ExamDB.db"))->prepare('SELECT seat_no,COUNT(seat_no) AS t FROM `Students` ORDER BY `seat_no` ASC');
$student->execute();
$list=$student->fetchAll();
echo"<pre>";
print_r($list);
$start=$list[0]['seat_no'];
$end=$list[0]['seat_no']+4;
$limit=$list[0]['t'];
for ($i=1; $i <=$block_count; $i++) {

    // for ($k=0; $k <$list[0]['t']; $k++) {
    //     // print($k."<br>");
    // }
    $student = (new PDO("sqlite:../DataBase/ExamDB.db"))->prepare('INSERT INTO "blocks" VALUES (:iblock, :istart,:iend, "")');
    $student->bindValue(":iblock",$i);
    $student->bindValue(":istart",$start);
    $student->bindValue(":iend",$end);
    $student->execute();
print("loop".$i."--".($start)."  ".($end)."<br>");
$start+=5;
$end+=5;

}
?>
    <table>
        <tbody>
            <tr>
                <th>Block No</th>
                <th>Start Seat</th>
                <th>End Seat</th>
                <th>Supervisor Name</th>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <?php }else{
        echo"<h1>Nothing Submited</h1>";
    }?>
    <!-- <script src="" async defer></script> -->
</body>
<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

</html>