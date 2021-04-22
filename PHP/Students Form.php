<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Form</title>
    <link rel="icon" href="../Img/student.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../CSS/student.css">
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
                            <h4>Fill Student Info</h4>
                        </div>
                        <form action="../DataBase/Students-DB.php#insert" method="POST">
                            <div class="form-group row">
                                <label for="istudent_name" class="col-md-12 flabel"><i class="fas fa-file-signature"></i> Student Name:</label>
                                <div class="col-md-12">
                                    <input class="form-control my-1" type="text" name="istudent_name" id="student_name" placeholder="Enter Your Name" pattern="^[A-Z a-z]+$" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="iseat_no" class="col-md-12 flabel"><i class="fas fa-book-reader"></i> Seat Number:</label>
                                <div class="col-md-12">
                                    <input class="form-control my-1" type="number" name="iseat_no" id="seat_no" placeholder="Enter Seat No" pattern="\b[0-9]{6,6}\b" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ienrollment_no" class="col-md-12 flabel"><i class="fas fa-book-reader"></i>Enrollment Number:</label>
                                <div class="col-md-12">
                                    <input class="form-control my-1" type="number" name="ienrollment_no" id="enrolment_no" placeholder="Enter Enrollment No" pattern="[0-9]{10}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="idepartment" class="col-md-12 flabel"><i class="fas fa-building"></i> Select Department:</label>
                                <div class="col-md-12">
                                    <select class="form-control my-1" name="idepartment" id="department" required>
                                        <option value="">Select Department</option>
                                        <option value="Computer">Computer</option>
                                        <option value="Mechanical">Mechanical</option>
                                        <option value="Electrical">Electrical</option>
                                        <option value="Civil">Civil</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="iyear_sem" class="col-md-12 flabel"><i class="fas fa-book-reader"></i> Select Semester:</label>
                                <div class="col-md-12">
                                    <select class="form-control my-1" name="iyear_sem" id="year_sem" required>
                                        <option value="">Select Semester</option>
                                        <option value="F.Y.SEM-1">F.Y.SEM-1</option>
                                        <option value="F.Y.SEM-2">F.Y.SEM-2</option>
                                        <option value="S.Y.SEM-3">S.Y.SEM-3</option>
                                        <option value="S.Y.SEM-4">S.Y.SEM-4</option>
                                        <option value="T.Y.SEM-5">T.Y.SEM-5</option>
                                        <option value="T.Y.SEM-6">T.Y.SEM-6</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="text-center py-3 col-lg-6">
                                    <button type="submit" name="idone" class="btn btn-lg btn-primary font-weight-bold h2 btn-block"><i class="fas fa-check fa-1x" aria-hidden="true"></i>&nbsp;Submit</button>
                                </div>
                                <div class="text-center py-3 col-lg-6">
                                    <form action="../DataBase/Students-DB.php#update" method="POST">
                                        <input type="hidden" name="get_id" id="get_id" value="">
                                        <button type="submit" name="update" class="btn btn-lg btn-primary font-weight-bold h2 btn-block"><i class="fas fa-edit fa-1x"></i> Update</button>
                                    </form>
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
                    <table id="Student-Table-View" class="table table-hover bg-transparent text-black " style="overflow-x:auto;">
                        <thead class="thead table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">SeatNo</th>
                                <th scope="col">Enroll No</th>
                                <th scope="col">Dept</th>
                                <th scope="col">Year/Sem</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $staterun = (new PDO("sqlite:../DataBase/ExamDB.db"))->prepare("SELECT * FROM `Students` ORDER BY `enroll_no` ASC");
                            $staterun->execute();
                            $data = $staterun->fetchAll();
                            foreach (@$data as $row) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $row['id']; ?></th>
                                    <td><?php echo $row['student_name']; ?></td>
                                    <td><?php echo $row['seat_no']; ?></td>
                                    <td><?php echo $row['enroll_no']; ?></td>
                                    <td><?php echo $row['department']; ?></td>
                                    <td><?php echo $row['year_sem']; ?></td>
                                    <td>
                                        <form action="../DataBase/Students-DB.php#delete" method="POST">
                                            <input type="hidden" name="get_id" value="<?php echo $row['id']; ?>">

                                            <button class="btn btn-outline-danger btn-block" type="submit" id="delete" name="delete"><span class="fas fa-trash-alt fa-sm">&nbsp;Delete</span> </button>
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
<!-- JavaScript -->
<script type=" text/javascript" src="../JavaScript/Students-Script.js" charset="utf-8"></script>
<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

</html>