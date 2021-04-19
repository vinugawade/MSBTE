<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TimeTable</title>
    <link rel="icon" href="../Img/calendar.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../CSS/Global.css">
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/45cb967df4.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="../CSS/TimeTable.css">

</head>
<!-- rgb(132, 140, 255) -->

<body style="background: #7F7FD5; background: -webkit-linear-gradient(to bottom, #91EAE4, #86A8E7, #7F7FD5);   background: linear-gradient(to bottom, #91EAE4, #86A8E7, #7F7FD5);">
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
                        <a class="nav-link text-dark" href="./gen_notice_pdf.php">Notice</a>
                            <a class="nav-link text-dark" href="./HTML/aboutus.html">About Us</a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
    <main>
        <div class="container-fluid">
            <div class="card-deck">
                <form action="../DataBase/Time-Table-DB.php#insert" method="POST" class="form-inline card pt-5 m-3 p-3" role="form">
                    <div class="form-group card-header bg-dark text-white">
                        <legend>Fill TimeTable</legend>
                    </div>
                    <div class="card-body row">
                        <div class="form-group col-md-3">
                            <legend class="flabel"><i class="fas fa-cloud-sun"></i> Which Day:</legend>
                            <input type="number" name="iday" id="day" min=0 placeholder="Day of Exam" class="form-control" required>
                        </div>

                        <div class="form-group col-md-3">
                            <legend class="flabel"><i class="fas fa-calendar-day"></i> Date:</legend>
                            <input type="date" name="idate" id="date" class="form-control" required>
                        </div>

                        <div class="form-group col-md-3">
                            <legend class="flabel"><i class="fas fa-clock"></i> Time:</legend>
                            <input type="time" name="itime" id="time" class="form-control" required>
                        </div>

                        <div class="form-group col-md-3">
                            <legend class="flabel"><i class="fas fa-clock"></i> Hours:</legend>
                            <input type="number" name="ihour" id="hour" min=1 placeholder="Exam hours" class="form-control" required>
                        </div>

                        <div class="form-group col-md-3">
                            <legend class="flabel"><i class="fas fa-book-reader"></i> Scheme:</legend>
                            <select class="form-control" name="ischeme" id="scheme" required>
                                <option value="">Select Scheme</option>
                                <option value="I_Scheme">I_Scheme</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <legend class="flabel"><i class="fas fa-building"></i> Department:</legend>
                            <select class="form-control" id="department" name="idepartment" onchange="random_function()" required>
                                <option value="">Select Department</option>
                                <option value="Computer">Computer</option>
                                <option value="Mechanical">Mechanical</option>
                                <option value="Electrical">Electrical</option>
                                <option value="Civil">Civil</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <legend class="flabel"><i class="fas fa-book-reader"></i> Semester:</legend>
                            <select class="form-control" id="year_sem" name="iyear_sem"  onchange="random_function()" required>
                                <option value="">Select Semester</option>
                                <option value="F.Y.SEM-1">F.Y.SEM-1</option>
                                <option value="F.Y.SEM-2">F.Y.SEM-2</option>
                                <option value="S.Y.SEM-3">S.Y.SEM-3</option>
                                <option value="S.Y.SEM-4">S.Y.SEM-4</option>
                                <option value="T.Y.SEM-5">T.Y.SEM-5</option>
                                <option value="T.Y.SEM-6">T.Y.SEM-6</option>
                            </select>
                        </div>



                        <div class="form-group col-md-3">
                            <legend class="flabel"><i class="fas fa-book-reader"></i> Subject:</legend>
                            <select name="isubject" id="subject" class="form-control" required>
                                    <option>Select Subject</option>
                            </select>
                        </div>


                        <div class="form-group col-md-3">
                            <legend class="flabel"><i class="fas fa-book-reader"></i> Session:</legend>
                            <select class="form-control" id="session" name="isession" required>
                                <option value="">Select Session</option>
                                <option value="Morning">Morning</option>
                                <option value="Afternoon">Afternoon</option>
                            </select>
                        </div>

                        <div class="form-group col-sm-3 col-md-3">
                            <legend class="flabel"><i class="fas fa-users"></i> Students Count:</legend>
                            <input type="number" name="istudents_count" placeholder="No. of Students"
                                id="students_count" min=0 class="form-control" required>
                        </div>

                        <div class="form-group col-sm-3 col-md-3">
                            <legend class="flabel"><i class="fas fa-users"></i> Required Block Count:</legend>
                            <input type="number" name="iblock_count" placeholder="No. of Blocks" id="block_count"
                            min=1 class="form-control" required>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <center>
                                    <button type="submit" name="idone" class="btn btn-outline-primary btn-lg btn-block"><i class="fas fa-check fa-1x"></i> Submit</button>
                                </center>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <center>
                                    <form action="../DataBase/Time-Table-DB.php#update" method="POST">
                                    <input type="hidden" name="get_id" id="get_id" value="">
                                        <button type="submit" name="update"
                                            class="btn btn-outline-info btn-lg btn-block"><i
                                                class="fas fa-edit fa-1x"></i> Update</button>
                                    </form>
                                </center>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
    </main>
    <section>
        <div class="container-fluid">
            <div class="card-deck">
                <div class="card-body">
                    <table id="Time-Table-View" class="table bg-light table-hover">
                        <thead class="thead table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Day</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Hours</th>
                                <th scope="col">Department</th>
                                <th scope="col">Year/Sem</th>
                                <th scope="col">Scheme</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Session</th>
                                <th scope="col">Students</th>
                                <th scope="col">Requ.Block</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $staterun=(new PDO("sqlite:../DataBase/ExamDB.db"))->prepare("SELECT * FROM `TimeTable` ORDER BY `date` ASC");
                                $staterun->execute();
                                $data = $staterun->fetchAll();
                                foreach(@$data as $row){
                        ?>
                            <tr>
                                <th scope="row"><?php echo $row['id']; ?></th>
                                <td><?php echo $row['day']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                <td><?php echo $row['time']; ?></td>
                                <td><?php echo $row['hour']; ?></td>
                                <td><?php echo $row['department']; ?></td>
                                <td><?php echo $row['year_sem']; ?></td>
                                <td><?php echo $row['scheme']; ?></td>
                                <td><?php echo $row['subject']; ?></td>
                                <td><?php echo $row['session']; ?></td>
                                <td><?php echo $row['students_count']; ?></td>
                                <td><?php echo $row['blocks']; ?></td>
                                <td>
                                    <form action="../DataBase/Time-Table-DB.php#delete" method="POST">
                                        <input type="hidden" name="get_id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="get_date" value="<?php echo $row['date']; ?>">

                                        <button class="btn btn-outline-danger btn-block" type="submit" id="delete" name="delete"><i
                                                class="fas fa-trash-alt"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <footer>

    </footer>
    <!-- JavaScript -->
    <script type=" text/javascript" src="../JavaScript/Time-Table-Script.js" charset="utf-8"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
</body>

</html>