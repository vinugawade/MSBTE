<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Generate PDF</title>
    <link rel="icon" href="../Img/PDF.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../CSS/Global.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/45cb967df4.js" crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

</head>

<body class="text-center" style="background: #7F7FD5; background: -webkit-linear-gradient(to bottom, #91EAE4, #86A8E7, #7F7FD5);   background: linear-gradient(to bottom, #91EAE4, #86A8E7, #7F7FD5); ">
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
    <div class="pt-0 pb-5 mx-auto flex-column">
        <main>
            <h1 class="m-0 p-lg-3 p-2">Select Supervisor</h1>
            <div class="container-fluid p-0 m-0">
                <div class="card-deck">
                    <div class="card-body p-0 m-lg-4">
                        <table id="Notice-Table-View" class="table bg-light table-hover text-black" style="overflow-x:auto;">
                            <thead class="thead table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $staterun = (new PDO("sqlite:../DataBase/ExamDB.db"))->prepare("SELECT * FROM `Supervisor` ORDER BY `supervisor_name` ASC");
                                $staterun->execute();
                                $data = $staterun->fetchAll();
                                foreach (@$data as $row) {
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $row['id']; ?></th>
                                        <td><?php echo $row['supervisor_name']; ?></td>
                                        <td><?php echo $row['department']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-file-pdf ">&nbsp;Generate PDF</i></button>

                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>


                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Select Reporting Time</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form action="./Generate_PDF.php" target="_blank" method="POST">
                                                                <input type="hidden"  class="form-control"  name="super_name" id="s_name">
                                                                <div class="mb-3">
                                                                    <label for="get-time-morning" class="col-form-label">Morning Time:</label>
                                                                    <input type="time" name="morning-time" class="form-control"  required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="get-time-afternoon" class="col-form-label">Afternoon Time:</label>
                                                                    <input type="time" name="afternoon-time" class="form-control" required>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Continue</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                    </div>
                </div>
            </div>
    </div>
    </main>
</body>
<!-- JavaScript -->
<script type=" text/javascript" src="../JavaScript/Gen_notice_pdf.js" charset="utf-8"></script>
<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

</html>