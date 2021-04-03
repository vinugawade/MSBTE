<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Supervisor Form</title>
    <link rel="icon" href="../Img/teachers.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../CSS/super.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Global.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/45cb967df4.js" crossorigin="anonymous"></script>

</head>


<body class="row m-0">
    <main class="col-lg-6 p-0 m-0 px-lg-0">
        <div class="container-fluid p-0 m-0">
            <div class="row p-0 m-0">
                <div class="col-lg-12 col-md-12 form-container m-0 p-0">
                <div class="col-lg-8 col-md-12 col-sm-9 col-xs-12 form-box mx-3 mb-4">
                    <div class="logo mb-3">
                        <div class="text-center">
                            <img src="../Img/Head-Img.png" width="150px">
                        </div>
                    </div>
                    <div class="heading mb-4 text-center">
                        <h4>Fill Supervisor Info</h4>
                    </div>
                    <form action="../DataBase/Supervisor-DB.php#insert" method="POST">

                    <div class="form-group row">
                            <label for="isupervisor_name" class="col-md-12 flabel"><i class="fas fa-file-signature"></i>Supervisor Name:</label>
                            <div class="col-md-12">
                                <input class="form-control my-1" type="text" name="isupervisor_name" id="supervisor_name" placeholder="Enter Your Name" pattern="^[A-Z a-z]+$" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="idate" class="col-md-12 flabel"><i class="fas fas fa-calendar-day"></i> Supervision Date:</label>
                            <div class="col-md-12">
                                <input class="form-control my-1" type="date" name="idate" id="date" required>
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
                        <div class="row">
                        <div class="text-center py-3 col-lg-6">
                            <button type="submit" name="idone" class="btn btn-lg btn-primary font-weight-bold h2 btn-block my-1"><i class="fas fa-check fa-1x" aria-hidden="true"></i>&nbsp;Submit</button>
                        </div>
                        <div class="text-center py-3 col-lg-6">
                        <form action="../DataBase/Supervisor-DB.php#update" method="POST">
                                    <input type="hidden" name="get_id" id="get_id" value="">
                                        <button type="submit" name="update" class="btn btn-lg btn-primary font-weight-bold h2 btn-block my-1"><i class="fas fa-edit fa-1x"></i> Update</button>
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
                    <table id="Supervisor-Table-View" class="table table-hover bg-transparent text-black" style="overflow-x:auto;">
                        <thead class="thead table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Supervision Date</th>
                                <th scope="col">Dept</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $staterun=(new PDO("sqlite:../DataBase/ExamDB.db"))->prepare("SELECT * FROM `Supervisor` ORDER BY `date` ASC");
                                $staterun->execute();
                                $data = $staterun->fetchAll();
                                foreach(@$data as $row){
                           ?>
                            <tr>
                                <th scope="row"><?php echo $row['id']; ?></th>
                                <td><?php echo $row['supervisor_name']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                <td><?php echo $row['department']; ?></td>
                                <td>
                                    <form action="../DataBase/Supervisor-DB.php#delete" method="POST">
                                        <input type="hidden" name="get_id" value="<?php echo $row['id']; ?>">

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
    </body>
    <!-- JavaScript -->
    <script type=" text/javascript" src="../JavaScript/Supervisor-Script.js" charset="utf-8"></script>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
</html>