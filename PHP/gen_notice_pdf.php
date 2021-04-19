<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Generate PDF</title>
    <link rel="icon" href="./Img/home.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/45cb967df4.js" crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <meta name="theme-color" content="">
</head>

<body class="text-center text-white" style="background: #7F7FD5; background: -webkit-linear-gradient(to bottom, #91EAE4, #86A8E7, #7F7FD5);   background: linear-gradient(to bottom, #91EAE4, #86A8E7, #7F7FD5); ">
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
                        <a class="nav-link text-dark" href="../HTML/aboutus.html">About Us</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="pt-0 pb-5 mx-auto flex-column">
        <main>
            <div class="row py-3 mx-2">
                <?php
                $staterun = (new PDO("sqlite:../DataBase/ExamDB.db"))->prepare("SELECT * FROM `Supervisor` ORDER BY `supervisor_name` ASC");
                $staterun->execute();
                $data = $staterun->fetchAll();
                foreach (@$data as $row) {

                    echo '
      <div class="col-lg-6 col-sm-12 py-2 text-center">
      <div style="min-height:60px; min-width:50%;" >
      <form action="./Generate_PDF.php" method="POST">
      <button type="submit" name="super_name" class="card col-lg-12 col-sm-12 py-2" value=' . str_replace(" ","-",$row["supervisor_name"]). '><h4><i class="fas fa-chalkboard-teacher"></i>&nbsp; ' . $row["supervisor_name"] . '</h4></button>
      </form>
      </div>
      </div>
      ';
                }
                ?>
            </div>
    </div>
    </main>
</body>
<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

</html>