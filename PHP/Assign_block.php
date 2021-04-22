<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assign Blocks</title>
    <link rel="icon" href="../Img/student.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../CSS/assign.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Global.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/45cb967df4.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
</head>

<body class="row m-0">
    <header class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
            <div class="container-fluid d-flex">
                <a class="navbar-brand me-auto" href="../index.html">MSBTE</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse flex-row-reverse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link text-dark" aria-current="page" href="../index.html">Home</a>
                        <a class="nav-link text-dark" href="./TimeTable.php">TimeTable</a>
                        <a class="nav-link text-dark" href="./Students Form.php">Students</a>
                        <a class="nav-link text-dark" href="./Supervisor Form.php">Superviser</a>
                        <a class="nav-link text-dark" href="./Assign_block.php">Blocks</a>
                        <a class="nav-link text-dark" href="./Gen_notice_pdf.php">Notice</a>
                        <a class="nav-link text-dark" href="../HTML/aboutus.html">About Us</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="col-lg-6 p-0 m-0 px-lg-0">

        <div class="container-fluid p-0 m-0">
            <div class="row p-0 m-0">
                <div class="col-lg-12 col-md-12 form-container m-0 p-0">
                    <div class="col-lg-8 col-md-12 col-sm-9 col-xs-12 form-box mx-3">
                        <div class="logo mb-3">
                            <div class="text-center">
                                <img src="../Img/Head-Img.png" width="150px">
                            </div>
                        </div>
                        <div class="heading mb-4 text-center">
                            <h4>Check Assign blocks</h4>
                        </div>

                        <form action="../DataBase/Assign-Block-DB.php#insert" class="foa" method="post">
                            <div class="form-group row">
                                <label for="idepartment" class="col-md-12 flabel"><i class="fas fa-building"></i> Select Date:</label>
                                <div class="col-md-12">
                                    <select class="form-control my-1" name="date" id="idate" required>
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
                            </div>

                            <div class="form-group row">
                                <label for="iyear_sem" class="col-md-12 flabel"><i class="fas fa-book-reader"></i> Select session:</label>
                                <div class="col-md-12">
                                    <select class="form-control my-1" name="session" id="isession" required>
                                        <option value="">Select session</option>
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
                            </div>
                            <div class="row">
                                <div class="text-center py-3 col-lg-12">
                                    <button type="submit" name="submit" class="btn btn-lg btn-primary font-weight-bold h2 btn-block"><i class="fas fa-check fa-1x" aria-hidden="true"></i>&nbsp;Check</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </main>
    <section class="col-lg-6 image-container px-lg-0 p-0 m-0 overflow-auto">
        <div class="container-fluid p-0 m-0">
            <div class="card-deck">
                <div class="card-body p-0 m-0">
                    <table id="Blocks-Table-View" class="table table-hover bg-transparent text-black" style="overflow-x:auto;">
                        <thead class="thead table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Session</th>
                                <th scope="col">Start</th>
                                <th scope="col">End</th>
                                <th scope="col">Dept</th>
                                <th scope="col">Supervisor</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            $selectblock = (new PDO("sqlite:../DataBase/ExamDB.db"))->prepare("SELECT * FROM `blocks` WHERE `ex_date`=:idate AND `session`=:isession");
                            $selectblock->bindValue(':idate', @$_GET['date']);
                            $selectblock->bindValue(':isession', @$_GET['session']);
                            $selectblock->execute();
                            $data = $selectblock->fetchAll();
                            foreach (@$data as $row) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $row['block_no']; ?></th>
                                    <td><?php echo $row['ex_date']; ?></td>
                                    <td><?php echo $row['session']; ?></td>
                                    <td><?php echo $row['start']; ?></td>
                                    <td><?php echo $row['end']; ?></td>
                                    <td><?php echo str_replace("        ", " ", trim($row['dept'], " ")); ?></td>
                                    <td><?php

                                        if ($row['supervisor'] == null) {
                                            echo "<select class='form-select form-select-sm p-1 mx-1' id='" . $row['block_no'] . "list'><option selected>Select Supervisor</option>";
                                            $selectblock = (new PDO("sqlite:../DataBase/ExamDB.db"))->prepare('SELECT * FROM `supervisor`');
                                            $selectblock->execute();
                                            $data = $selectblock->fetchAll();
                                            foreach (@$data as $supervisor) {
                                                echo "  <option value='" . $supervisor['supervisor_name'] . "' id='" . $supervisor['supervisor_name'] . "'>" . $supervisor['supervisor_name'] . "</option>";
                                            }
                                            echo "</select>
                                            <script>
                                            document.getElementById('" . $row['block_no'] . "list').addEventListener('change', () => {
                                                supervisor = document.getElementById('" . $row['block_no'] . "list').options[document.getElementById('" . $row['block_no'] . "list').selectedIndex].text;
                                               dept= '".$supervisor['department']."';
                                                updatesupervisor(supervisor,dept);
                                            })
                                            </script>
                                            ";
                                        } else {
                                            echo $row['supervisor'];
                                        }
                                        ?></td>
                                    <td>
                                        <form action="../DataBase/Students-DB.php#delete" method="GET">
                                            <input type="hidden" name="get_id" value="<?php echo $row['block_no']; ?>">
                                            <input type="hidden" name="get_id" value="<?php echo $row['ex_date']; ?>">
                                            <input type="hidden" name="get_id" value="<?php echo $row['session']; ?>">
                                            <input type="hidden" name="get_id" value="<?php echo $row['start']; ?>">
                                            <input type="hidden" name="get_id" value="<?php echo $row['end']; ?>">
                                            <input type="hidden" name="get_id" value="<?php echo $row['supervisor']; ?>">
                                            <button class="btn btn-danger btn-block btn-sm mt-1" type="submit" name="view"><span class="far fa-eye fa-sm">View</span></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>

</body>
<script src="../JavaScript/Assign-block.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

</html>