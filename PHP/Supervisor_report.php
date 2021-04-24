<?php
            $selectblock = (new PDO("sqlite:../DataBase/ExamDB.db"))->prepare("SELECT * FROM `blocks` WHERE `ex_date`=:idate AND `session`=:isession");
            $selectblock->bindValue(':idate', @$_POST['date']);
            $selectblock->bindValue(':isession', @$_POST['session']);
            $selectblock->execute();
            $data = $selectblock->fetchAll(PDO::FETCH_ASSOC);

            foreach (@$data as $row) {
                echo"<pre>";print_r($row);

                $dept= implode(",",
                    explode
                    ("        ",trim(
                        strval($row['dept'])," "
                )
            )
        );

        echo count(explode(",",$dept));
        foreach (explode(",",$dept) as $value) {
echo $value."<br>";
        }
    }

?>