<?php include './Prime_DB_Creator.php'; ?>
<div id="insert">
    <?php
    if (isset($_POST['idone'])) {
        Create_Tables_First();
        insert();
    }
    function insert()
    {
        $name = @$_POST["istudent_name"];
        $select = (new PDO("sqlite:./ExamDB.db"))->prepare('SELECT * FROM `Students` WHERE `enroll_no` = :ienrollment_no');
        $select->bindValue(':ienrollment_no', @$_POST['ienrollment_no']);
        $select->execute();
        $rows = $select->fetchAll(PDO::FETCH_ASSOC);
        if ($rows) {
            echo "<script>alert('Enrollment Number is Exist.');</script>";
            echo "<script>location.href='../PHP/Students Form.php'</script>";
        } else {

            $select = (new PDO("sqlite:./ExamDB.db"))->prepare('SELECT * FROM `Students` WHERE `seat_no` = :iseatno');
            $select->bindValue(':iseatno', @$_POST['iseat_no']);
            $select->execute();
            $rows = $select->fetchAll(PDO::FETCH_ASSOC);
            if ($rows) {
                echo "<script>alert('Seat Number is Exist.');</script>";
                echo "<script>location.href='../PHP/Students Form.php'</script>";
            } else {

            try {
                $staterun = (new PDO("sqlite:./ExamDB.db"))->prepare('INSERT INTO `Students` VALUES (:icount, :istudent_name, :iseat_no, :ienrollment_no, :idepartment, :iyear_sem)');
                $staterun->bindValue(':icount', getRowCount());
                $staterun->bindValue(':istudent_name', @$_POST['istudent_name']);
                $staterun->bindValue(':iseat_no', @$_POST['iseat_no']);
                $staterun->bindValue(':ienrollment_no', @$_POST['ienrollment_no']);
                $staterun->bindValue(':idepartment', @$_POST['idepartment']);
                $staterun->bindValue(':iyear_sem', @$_POST['iyear_sem']);
                if ($staterun->execute()) {

                    echo "<script>alert('" . $name . " Added...');</script>";
                    echo "<script>location.href='../PHP/Students Form.php'</script>";
                }
            } catch (PDOException $d) {
                echo "Exception: " . $d;
                echo "<script>alert('Error...');</script>";
                $staterun->errorCode();
            }
        }
    }
}
    ?>
</div>
<div id="delete">
    <?php
    if (isset($_POST['delete'])) {
        delete();
    }
    function delete()
    {
        try {

            $staterun = (new PDO("sqlite:./ExamDB.db"))->prepare('DELETE FROM `Students` WHERE `id`=:get_id');
            $staterun->bindValue(':get_id', @$_POST['get_id']);
            //AND `date`=:get_date' $staterun->bindValue(':get_date',@$_POST['get_date']);

            if ($staterun->execute()) {
                updateIds();
                echo "<script>alert('Data Deleted...');</script>";
                echo "<script>location.href='../PHP/Students Form.php'</script>";
            }
        } catch (PDOException $d) {
            echo "Exception: " . $d;
            echo "<script>alert('Error...');</script>";
            $staterun->errorCode();
        }
    }
    ?>
</div>
<div id="update">
    <?php
    if (isset($_POST['update'])) {
        Create_Tables_First();
        update();
    }
    function update()
    {

        try {

            $staterun = (new PDO("sqlite:./ExamDB.db"))->prepare("UPDATE `Students` SET `student_name`=:student_name,`seat_no`=:seat_no,`enroll_no`=:enroll_no,`department`=:department,`year_sem`=:year_sem WHERE `id`=:id");
            $staterun->bindValue(':student_name', @$_POST['istudent_name']);
            $staterun->bindValue(':seat_no', @$_POST['iseat_no']);
            $staterun->bindValue(':enroll_no', @$_POST['ienrollment_no']);
            $staterun->bindValue(':department', @$_POST['idepartment']);
            $staterun->bindValue(':year_sem', @$_POST['iyear_sem']);
            $staterun->bindValue(':id', @$_POST['get_id']);
            $clear_blocks = (new PDO("sqlite:./ExamDB.db"))->prepare('DELETE FROM `blocks`');
            $clear_notice = (new PDO("sqlite:./ExamDB.db"))->prepare('DELETE FROM `super_notice`');

            if ($staterun->execute() && $clear_blocks->execute() && $clear_notice->execute()) {
                echo "<script>alert('Data Updated...');location.href='../PHP/Students Form.php';</script>";
            }
        } catch (PDOException $d) {
            echo "Exception: " . $d;
            echo "<script>alert('Value Already Exist...');location.href='../PHP/Students Form.php';</script>";
            $staterun->errorCode();
        }
    }
    ?>
</div>
<?php
// FUNCTION TO GET EXISTING ROWS IN DATABASE
function getRowCount()
{
    $icount = (new PDO("sqlite:./ExamDB.db"))->query("SELECT COUNT(*) FROM (SELECT * FROM `Students`)");
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
    $staterun = (new PDO("sqlite:./ExamDB.db"))->prepare("SELECT rowid FROM `Students`");
    $staterun->execute();
    $data = $staterun->fetchAll();
    $c = 1;
    $n = getRowCount();
    for ($i = 0; $i < $n - 1; $i += 1) {
        $staterun = (new PDO("sqlite:./ExamDB.db"))->prepare("UPDATE `Students` SET `id`=:id WHERE rowid=:icount");
        $staterun->bindValue(':id', $c);
        $staterun->bindValue(':icount', $data[$i][0]);
        $staterun->execute();
        $c += 1;
    }
}
// FUNCTION TO RESET TABLE ID'S WHILE DELETING
?>