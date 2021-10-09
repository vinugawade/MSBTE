<?php
function Create_Tables_First(){
$Create_Table_Students = (new PDO("sqlite:./ExamDB.db"))->prepare('CREATE TABLE IF NOT EXISTS "Students" (	"id"	INTEGER,"student_name"	TEXT,"seat_no"	INTEGER,"enroll_no"	INTEGER UNIQUE,"department"	TEXT,"year_sem"	TEXT)');
$Create_Table_Students->execute();

$Create_Table_Supervisor = (new PDO("sqlite:./ExamDB.db"))->prepare('CREATE TABLE IF NOT EXISTS "Supervisor" ("id"	INTEGER,"supervisor_name"	TEXT,"department"	TEXT)');
$Create_Table_Supervisor->execute();

$Create_Table_TimeTable = (new PDO("sqlite:./ExamDB.db"))->prepare('CREATE TABLE IF NOT EXISTS "TimeTable" ("id"	INTEGER,"day"	INTEGER,"time"	TEXT,"hour"	INTEGER,"date"	TEXT,"department"	TEXT,"year_sem"	TEXT,"scheme"	TEXT,"subject"	TEXT,"session"	TEXT,"students_count"	INTEGER,"blocks" INTEGER)');
$Create_Table_TimeTable->execute();

$Create_Table_blocks = (new PDO("sqlite:./ExamDB.db"))->prepare('CREATE TABLE IF NOT EXISTS "blocks" ("block_no"	INTEGER,"ex_date" TEXT,"session"	TEXT,"start"	INTEGER,"end"	INTEGER,"supervisor"	TEXT,"dept"	BLOB DEFAULT null)');
$Create_Table_blocks->execute();

$Create_Table_super_notice = (new PDO("sqlite:./ExamDB.db"))->prepare('CREATE TABLE IF NOT EXISTS "super_notice" ("super_name"	TEXT NOT NULL,"dept"	TEXT NOT NULL,"date"	TEXT,"session"	TEXT NOT NULL, "block_no"	INTEGER)');
$Create_Table_super_notice->execute();
}
?>