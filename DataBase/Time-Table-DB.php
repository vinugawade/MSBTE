<div id="insert">
<?php
if(isset($_POST['idone'])){
    insert();
}
// else{
//     echo"<script>alert('Error to Insert...');</script>";
//     echo"<script>location.href='../PHP/TimeTable.php'</script>";
// }
function insert(){
            try{

               $staterun=(new PDO("sqlite:./ExamDB.db"))->prepare('INSERT INTO `TimeTable` VALUES (:icount, :iday, :idate, :itime, :idepartment, :iyear_sem, :ischeme, :isubject, :isession, :istudents_count)');
               $staterun->bindValue(':icount',getRowCount());
               $staterun->bindValue(':iday',@$_POST['iday']);
               $staterun->bindValue(':idate',@$_POST['idate']);
               $staterun->bindValue(':itime',@$_POST['itime']);
               $staterun->bindValue(':idepartment',@$_POST['idepartment']);
               $staterun->bindValue(':iyear_sem',@$_POST['iyear_sem']);
               $staterun->bindValue(':ischeme',@$_POST['ischeme']);
               $staterun->bindValue(':isubject',@$_POST['isubject']);
               $staterun->bindValue(':isession',@$_POST['isession']);
               $staterun->bindValue(':istudents_count',@$_POST['istudents_count']);

               if($staterun->execute()){

                   echo"<script>alert('Data Inserted...');</script>";
                   echo"<script>location.href='../PHP/TimeTable.php'</script>";

               }

            }catch(PDOException $d){
                 echo "Exception: ".$d;
                 echo"<script>alert('Error...');</script>";
                 $staterun->errorCode();
            }
}
?>
</div>
<div id="delete">
<?php
if(isset($_POST['delete'])){
    delete();
}
// else{
//     echo"<script>alert('Error to Delete...');</script>";
//     echo"<script>location.href='../PHP/TimeTable.php'</script>";
// }
function delete(){
    try{

            $staterun=(new PDO("sqlite:./ExamDB.db"))->prepare('DELETE FROM `TimeTable` WHERE `id`=:get_id AND `date`=:get_date');
            $staterun->bindValue(':get_id',@$_POST['get_id']);
            $staterun->bindValue(':get_date',@$_POST['get_date']);

            if($staterun->execute()){
                updateIds();
                echo"<script>alert('Data Deleted...');</script>";
                echo"<script>location.href='../PHP/TimeTable.php'</script>";
            }

        }catch(PDOException $d){
            echo "Exception: ".$d;
            echo"<script>alert('Error...');</script>";
            $staterun->errorCode();
        }

}
?>
</div>
<div id="update">
<?php
if(isset($_POST['update'])){
    update();
}
// else{
//     echo"<script>alert('Error to Updated...');</script>";
//     echo"<script>location.href='../PHP/TimeTable.php'</script>";
// }
    function update(){

        try{

            $staterun=(new PDO("sqlite:./ExamDB.db"))->prepare("UPDATE `TimeTable` SET `day`=:iday, `date`=:idate, `subject`=:isubject, `time`=:itime,`department`=:idepartment,`year_sem`=:iyear_sem,`scheme`=:ischeme,`session`=:isession,`students_count`=:istudents_count WHERE `id`=:get_id");
            $staterun->bindValue(':iday',@$_POST['iday']);
            $staterun->bindValue(':get_id',@$_POST['get_id']);
            $staterun->bindValue(':idate',@$_POST['idate']);
            $staterun->bindValue(':itime',@$_POST['itime']);
            $staterun->bindValue(':idepartment',@$_POST['idepartment']);
            $staterun->bindValue(':iyear_sem',@$_POST['iyear_sem']);
            $staterun->bindValue(':ischeme',@$_POST['ischeme']);
            $staterun->bindValue(':isubject',@$_POST['isubject']);
            $staterun->bindValue(':isession',@$_POST['isession']);
            $staterun->bindValue(':istudents_count',@$_POST['istudents_count']);

            if($staterun->execute()){
                echo"<script>alert('Data Updated...');</script>";
                echo"<script>location.href='../PHP/TimeTable.php'</script>";
            }

        }catch(PDOException $d){
            echo "Exception: ".$d;
            echo"<script>alert('Error...');</script>";
            $staterun->errorCode();
        }

    }
?>
</div>
<?php
            // FUNCTION TO GET EXISTING ROWS IN DATABASE
            function getRowCount(){
                $icount=(new PDO("sqlite:./ExamDB.db"))->query("SELECT COUNT(*) FROM (SELECT * FROM `TimeTable`)");
                $icount=$icount->fetchColumn();
                    if($icount==0){
                        // echo "Exist:".$icount ."<br>";
                        return $icount=1;
                    }else if($icount>0){
                        // echo "Exist:".$icount ."<br>";
                        return $icount=$icount+1;
                    }

            }
            // FUNCTION TO GET EXISTING ROWS IN DATABASE

            // FUNCTION TO RESET TABLE ID'S WHILE DELETING
            function updateIds(){
                $staterun=(new PDO("sqlite:./ExamDB.db"))->prepare("SELECT rowid FROM `TimeTable`");
                $staterun->execute();
                $data = $staterun->fetchAll();
                $c=1;
                $n=getRowCount();
                for($i=0;$i<$n-1;$i+=1){
                    $staterun=(new PDO("sqlite:./ExamDB.db"))->prepare("UPDATE `TimeTable` SET `id`=:id WHERE rowid=:icount");
                    $staterun->bindValue(':id',$c);
                    $staterun->bindValue(':icount',$data[$i][0]);
                    $staterun->execute();
                    $c+=1;
                }
            }
            // FUNCTION TO RESET TABLE ID'S WHILE DELETING
?>





