<?php include './Prime_DB_Creator.php'; ?>
<div id="insert">
<?php
if(isset($_POST['idone'])){
    Create_Tables_First();
    insert();
}
function insert(){
    $name=@$_POST["isupervisor_name"];
    $select = (new PDO("sqlite:./ExamDB.db"))->prepare('SELECT * FROM `Supervisor` WHERE `supervisor_name` = :isupervisor_name AND `department`=:department');
    $select->bindValue(':isupervisor_name',@$_POST['isupervisor_name']);
    $select->bindValue(':department',@$_POST['idepartment']);
    $select->execute();
    $rows = $select->fetchAll(PDO::FETCH_ASSOC);
    if ($rows) {
        echo"<script>alert('Supervisor Already Exist.');</script>";
        echo"<script>location.href='../PHP/Supervisor Form.php'</script>";
    } else {
        try{

               $staterun=(new PDO("sqlite:./ExamDB.db"))->prepare('INSERT INTO `Supervisor` VALUES (:icount, :isupervisor_name, :idepartment)');
               $staterun->bindValue(':icount',getRowCount());
               $staterun->bindValue(':isupervisor_name',@$_POST['isupervisor_name']);
               $staterun->bindValue(':idepartment',@$_POST['idepartment']);
               if($staterun->execute()){

                   echo"<script>alert('". $name ." Added...');</script>";
                   echo"<script>location.href='../PHP/Supervisor Form.php'</script>";

               }

            }catch(PDOException $d){
                 echo "Exception: ".$d;
                 echo"<script>alert('Error...');</script>";
                 $staterun->errorCode();
            }
        }
}
?>
</div>
<div id="delete">
<?php
if(isset($_POST['delete'])){
    delete();
}
function delete(){
    try{

            $staterun=(new PDO("sqlite:./ExamDB.db"))->prepare('DELETE FROM `Supervisor` WHERE `id`=:get_id');
            $staterun->bindValue(':get_id',@$_POST['get_id']);

            if($staterun->execute()){
                updateIds();
                echo"<script>alert('Data Deleted...');</script>";
                echo"<script>location.href='../PHP/Supervisor Form.php'</script>";
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
    Create_Tables_First();
    update();
}
    function update(){
        $select = (new PDO("sqlite:./ExamDB.db"))->prepare('SELECT * FROM `Supervisor` WHERE `supervisor_name` = :isupervisor_name AND `department`=:department');
        $select->bindValue(':isupervisor_name',@$_POST['isupervisor_name']);
        $select->bindValue(':department',@$_POST['idepartment']);
        $select->execute();
        $rows = $select->fetchAll(PDO::FETCH_ASSOC);
        if ($rows) {
            echo"<script>alert('Supervisor Already Exist.');</script>";
            echo"<script>location.href='../PHP/Supervisor Form.php'</script>";
        } else {
            try{

            $staterun=(new PDO("sqlite:./ExamDB.db"))->prepare("UPDATE `Supervisor` SET `supervisor_name`=:supervisor_name,`department`=:department WHERE `id`=:id");
            $staterun->bindValue(':supervisor_name',@$_POST['isupervisor_name']);
            $staterun->bindValue(':department',@$_POST['idepartment']);
            $staterun->bindValue(':id',@$_POST['get_id']);

            if($staterun->execute()){
                echo"<script>alert('Data Updated...');</script>";
                echo"<script>location.href='../PHP/Supervisor Form.php'</script>";
            }

        }catch(PDOException $d){
            echo "Exception: ".$d;
            echo"<script>alert('Update Error...');</script>";
            $staterun->errorCode();
        }
    }

 }
?>
</div>
<?php
            // FUNCTION TO GET EXISTING ROWS IN DATABASE
            function getRowCount(){
                $icount=(new PDO("sqlite:./ExamDB.db"))->query("SELECT COUNT(*) FROM (SELECT * FROM `Supervisor`)");
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
                $staterun=(new PDO("sqlite:./ExamDB.db"))->prepare("SELECT rowid FROM `Supervisor`");
                $staterun->execute();
                $data = $staterun->fetchAll();
                $c=1;
                $n=getRowCount();
                for($i=0;$i<$n-1;$i+=1){
                    $staterun=(new PDO("sqlite:./ExamDB.db"))->prepare("UPDATE `Supervisor` SET `id`=:id WHERE rowid=:icount");
                    $staterun->bindValue(':id',$c);
                    $staterun->bindValue(':icount',$data[$i][0]);
                    $staterun->execute();
                    $c+=1;
                }
            }
            // FUNCTION TO RESET TABLE ID'S WHILE DELETING
?>





