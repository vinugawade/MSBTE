<?php include './Prime_DB_Creator.php'; ?>
<div id="insert">
    <?php
    if (isset($_POST['idone'])) {
        Create_Tables_First();
        insert();
    }
    function insert()
    {
        try {

            $staterun = (new PDO("sqlite:./ExamDB.db"))->prepare('INSERT INTO `TimeTable` VALUES (:icount, :iday, :itime, :ihour, :idate, :idepartment, :iyear_sem, :ischeme, :isubject, :isession, :istudents_count,:iblock_count)');
            $staterun->bindValue(':icount', getRowCount());
            $staterun->bindValue(':iday', @$_POST['iday']);
            $staterun->bindValue(':idate', @$_POST['idate']);
            $staterun->bindValue(':itime', @$_POST['itime']);
            $staterun->bindValue(':ihour', @$_POST['ihour']);
            $staterun->bindValue(':idepartment', @$_POST['idepartment']);
            $staterun->bindValue(':iyear_sem', @$_POST['iyear_sem']);
            $staterun->bindValue(':ischeme', @$_POST['ischeme']);
            $staterun->bindValue(':isubject', @$_POST['isubject']);
            $staterun->bindValue(':isession', @$_POST['isession']);
            $staterun->bindValue(':istudents_count', @$_POST['istudents_count']);
            $staterun->bindValue(':iblock_count', @$_POST['iblock_count']);
            if ($staterun->execute()) {

                echo "<script>alert('Data Inserted...');</script>";
                echo "<script>location.href='../PHP/TimeTable.php'</script>";
            }
        } catch (PDOException $d) {
            echo "Exception: " . $d;
            echo "<script>alert('Error...');</script>";
            $staterun->errorCode();
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

            $staterun = (new PDO("sqlite:./ExamDB.db"))->prepare('DELETE FROM `TimeTable` WHERE `id`=:get_id AND `date`=:get_date');
            $staterun->bindValue(':get_id', @$_POST['get_id']);
            $staterun->bindValue(':get_date', @$_POST['get_date']);
            $clear_blocks = (new PDO("sqlite:./ExamDB.db"))->prepare('DELETE FROM `blocks`');
            $clear_notice = (new PDO("sqlite:./ExamDB.db"))->prepare('DELETE FROM `super_notice`');

            if ($staterun->execute() && $clear_blocks->execute() && $clear_notice->execute()) {
                updateIds();
                echo "<script>alert('Data Deleted...');</script>";
                echo "<script>location.href='../PHP/TimeTable.php'</script>";
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

            $staterun = (new PDO("sqlite:./ExamDB.db"))->prepare("UPDATE `TimeTable` SET `day`=:iday, `date`=:idate, `subject`=:isubject, `time`=:itime, `hour`=:ihour,`department`=:idepartment,`year_sem`=:iyear_sem,`scheme`=:ischeme,`session`=:isession,`students_count`=:istudents_count, `blocks`=:rblock WHERE `id`=:get_id");
            $staterun->bindValue(':iday', @$_POST['iday']);
            $staterun->bindValue(':get_id', @$_POST['get_id']);
            $staterun->bindValue(':idate', @$_POST['idate']);
            $staterun->bindValue(':itime', @$_POST['itime']);
            $staterun->bindValue(':ihour', @$_POST['ihour']);
            $staterun->bindValue(':idepartment', @$_POST['idepartment']);
            $staterun->bindValue(':iyear_sem', @$_POST['iyear_sem']);
            $staterun->bindValue(':ischeme', @$_POST['ischeme']);
            $staterun->bindValue(':isubject', @$_POST['isubject']);
            $staterun->bindValue(':isession', @$_POST['isession']);
            $staterun->bindValue(':istudents_count', @$_POST['istudents_count']);
            $staterun->bindValue(':rblock', @$_POST['iblock_count']);
            $clear_blocks = (new PDO("sqlite:./ExamDB.db"))->prepare('DELETE FROM `blocks`');
            $clear_notice = (new PDO("sqlite:./ExamDB.db"))->prepare('DELETE FROM `super_notice`');

            if ($staterun->execute() && $clear_blocks->execute() && $clear_notice->execute()) {
                echo "<script>alert('Data Updated...');</script>";
                echo "<script>location.href='../PHP/TimeTable.php'</script>";
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
        return $icount = 1;
    } else if ($icount > 0) {
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