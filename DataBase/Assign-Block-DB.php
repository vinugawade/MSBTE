<div id="insert">
    <?php
    if (isset($_POST['submit'])) {
        insert();
    }
    function insert_into_block($block_count)
    {
        $student = (new PDO("sqlite:../DataBase/ExamDB.db"))->prepare('SELECT `seat_no`, COUNT(`seat_no`) AS `t` FROM `Students` ORDER BY `seat_no` ASC');
        $student->execute();
        $list = $student->fetchAll();
        $start = $list[0]['seat_no'];
        $end = $list[0]['seat_no'] + 4;
        $limit = $list[0]['t'];


        for ($i = 1; $i <= $block_count; $i++) {


        $get_dept = (new PDO("sqlite:../DataBase/ExamDB.db"))->prepare('SELECT  `department` FROM `Students` WHERE `seat_no` BETWEEN '.$start.' AND '.$end.' GROUP BY `department` ORDER BY `seat_no` ASC');
        $get_dept->execute();
        $dept = $get_dept->fetchAll(PDO::FETCH_ASSOC);

            $insertblock = (new PDO("sqlite:../DataBase/ExamDB.db"))->prepare('INSERT INTO `blocks` VALUES (:iblock,:idate,:isession, :istart,:iend,null,:dept)');
            $insertblock->bindValue(":iblock", $i);
            $insertblock->bindValue(":istart", $start);
            $insertblock->bindValue(":iend", $end);
            $insertblock->bindValue(':idate', @$_POST['date']);
            $insertblock->bindValue(':isession', @$_POST['session']);
            $insertblock->bindValue(':dept', str_replace("department","",preg_replace('/[^A-Za-z0-9\-]/', ' ', json_encode($dept))));
            $insertblock->execute();
            $start += 5;
            $end += 5;

        }
        return true;
    }
    function insert()
    {
        try {
            $check = (new PDO("sqlite:../DataBase/ExamDB.db"))->prepare("SELECT `session`,count(*) AS `session_block_count` FROM `blocks` WHERE `ex_date`=:idate GROUP BY `session`");
            $check->bindValue(':idate', @$_POST['date']);
            $check->execute();
            $check_data = $check->fetchAll();

            $select = (new PDO("sqlite:../DataBase/ExamDB.db"))->prepare('SELECT `session`,cast(round(SUM(`students_count`+0.5)/5) AS INT) AS `Required_block`, SUM(students_count) As `students_count` FROM `TimeTable` WHERE `date`=:idate AND `session`=:isession');
            $select->bindValue(':idate', @$_POST['date']);
            $select->bindValue(':isession', @$_POST['session']);
            $select->execute();
            $fetch_data = $select->fetchAll();
            foreach (@$fetch_data as $row) {
                $block_count = $row['Required_block'];
            }
            if ($_POST['session'] == 'Morning') {
                if (@$fetch_data[0][1] == @$check_data[1][1]) {
                    // echo $_POST['session'] . "=" . $block_count . "=" . $check_data[1][1];
                    echo "<script>window.location.assign('../PHP/Assign_block.php?date=".$_POST['date']."&session=".$_POST['session']."')</script>";
                } else {
                    //INSERT
                    if(insert_into_block($block_count)){
                        echo "<script>window.location.assign('../PHP/Assign_block.php?date=".$_POST['date']."&session=".$_POST['session']."')</script>";
                    }
                }
            } else {
                if (@$fetch_data[0][1] == @$check_data[0][1]) {
                    // echo  $_POST['session'] . "=" . $block_count . "=" . $check_data[0][1]."=".$fetch_data[0][1];
                    // echo"<pre>";print_r($fetch_data);print_r($check_data);
                    echo "<script>window.location.assign('../PHP/Assign_block.php?date=".$_POST['date']."&session=".$_POST['session']."')</script>";
                } else {
                    //INSERT
                    if(insert_into_block($block_count)){
                        echo "<script>window.location.assign('../PHP/Assign_block.php?date=".$_POST['date']."&session=".$_POST['session']."')</script>";
                    }
                }
            }

        } catch (PDOException $d) {
            echo "Exception: " . $d;
            echo "<script>alert('Error...');</script>";
        }
    }
    ?>
</div>

<!-- <div id="delete">
    <?php
    // if (isset($_POST['delete'])) {
    //     delete();
    // }
    // // else{
    // //     echo"<script>alert('Error to Delete...');</script>";
    // //     echo"<script>location.href='../PHP/TimeTable.php'</script>";
    // // }
    // function delete()
    // {
    //     try {

    //         $staterun = (new PDO("sqlite:./ExamDB.db"))->prepare('DELETE FROM `TimeTable` WHERE `id`=:get_id AND `date`=:get_date');
    //         $staterun->bindValue(':get_id', @$_POST['get_id']);
    //         $staterun->bindValue(':get_date', @$_POST['get_date']);

    //         if ($staterun->execute()) {
    //             updateIds();
    //             echo "<script>alert('Data Deleted...');</script>";
    //             echo "<script>location.href='../PHP/TimeTable.php'</script>";
    //         }
    //     } catch (PDOException $d) {
    //         echo "Exception: " . $d;
    //         echo "<script>alert('Error...');</script>";
    //         $staterun->errorCode();
    //     }
    // }
    ?>
</div> -->

<div id="update">
    <?php
    if (isset($_GET['update'])) {
        update();
    }

    function update()
    {
        try {

            $staterun = (new PDO("sqlite:./ExamDB.db"))->prepare("UPDATE `blocks` SET `supervisor`=:isupervisor WHERE `block_no`=:block_no AND `ex_date`=:idate AND `session`=:isession AND `start`=:istart AND `end`=:iend ");
            $staterun->bindValue(':isupervisor', @$_GET['isupervisor']);
            $staterun->bindValue(':block_no', @$_GET['block_no']);
            $staterun->bindValue(':idate', @$_GET['idate']);
            $staterun->bindValue(':isession', @$_GET['isession']);
            $staterun->bindValue(':istart', @$_GET['start']);
            $staterun->bindValue(':iend', @$_GET['end']);

            $insertsuper = (new PDO("sqlite:./ExamDB.db"))->prepare("INSERT INTO 'super_notice' VALUES (:super_name, :dept,:idate, :isession,:block_no);");
            $insertsuper->bindValue(':super_name', @$_GET['isupervisor']);
            $insertsuper->bindValue(':dept', @$_GET['dept']);
            $insertsuper->bindValue(':idate', @$_GET['idate']);
            $insertsuper->bindValue(':isession', @$_GET['isession']);
            $insertsuper->bindValue(':block_no', @$_GET['block_no']);

            if ($staterun->execute() && $insertsuper->execute()) {
                echo "<script>alert('Supvervisor Set.');</script>";
                echo "<script>window.location.assign('../PHP/Assign_block.php?date=".$_GET['idate']."&session=".$_GET['isession']."')</script>";
            }
        } catch (PDOException $d) {
            echo "Exception: " . $d;
            echo "<script>alert('Error...');</script>";
            $staterun->errorCode();
        }
    }
    ?>
</div>


<?php
// FUNCTION TO GET EXISTING ROWS IN DATABASE
function getRowCount()
{
    $icount = (new PDO("sqlite:./ExamDB.db"))->query("SELECT COUNT(*) FROM (SELECT * FROM `TimeTable`)");
    $icount = $icount->fetchColumn();
    if ($icount == 0) {
        // echo "Exist:".$icount ."<br>";
        return $icount = 1;
    } else if ($icount > 0) {
        // echo "Exist:".$icount ."<br>";
        return $icount = $icount + 1;
    }
}
// FUNCTION TO GET EXISTING ROWS IN DATABASE

// FUNCTION TO RESET TABLE ID'S WHILE DELETING
function updateIds()
{
    $staterun = (new PDO("sqlite:./ExamDB.db"))->prepare("SELECT rowid FROM `TimeTable`");
    $staterun->execute();
    $data = $staterun->fetchAll();
    $c = 1;
    $n = getRowCount();
    for ($i = 0; $i < $n - 1; $i += 1) {
        $staterun = (new PDO("sqlite:./ExamDB.db"))->prepare("UPDATE `TimeTable` SET `id`=:id WHERE rowid=:icount");
        $staterun->bindValue(':id', $c);
        $staterun->bindValue(':icount', $data[$i][0]);
        $staterun->execute();
        $c += 1;
    }
}
// FUNCTION TO RESET TABLE ID'S WHILE DELETING
?>