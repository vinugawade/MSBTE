<?php
$i=0;
$clear_timetable = (new PDO("sqlite:./ExamDB.db"))->prepare('DELETE FROM `TimeTable`');
if($clear_timetable->execute()){
    $i++;
}else{
    echo "<script>alert('Can't Delete Timetable Table.');</script>";
}

$clear_blocks = (new PDO("sqlite:./ExamDB.db"))->prepare('DELETE FROM `blocks`');
if($clear_blocks->execute()){
    $i++;
}else{
    echo "<script>alert('Can't Delete Blocks Table.');</script>";
}

$clear_notice = (new PDO("sqlite:./ExamDB.db"))->prepare('DELETE FROM `super_notice`');
if($clear_notice->execute()){
    $i++;
}else{
    echo "<script>alert('Can't Delete Notice Table.');</script>";
}

if($i==3){
    echo "<script>alert('Database is Clear Now.');location.href='../'</script>";
}
?>