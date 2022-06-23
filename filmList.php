<?php 

require "machine.php";
$results = queryFilmList("SELECT * FROM filmlist");

if (isset($_POST["submit"])) {
    if (tambahFilm($_POST) > 0) {
        echo "
          <script>
          alert('Film Berhasil Ditambahkan');
            document.location.href = 'filmList.php';
          </script>";
      }else {
        echo "
          <script>
            alert('Film gagal Ditambahkan');
            document.location.href = 'filmList.php';
          </script>";
      }
}


if (isset($_POST["cari"])) {

  $keyword = $_POST["search"];
  $results = queryFilmList("SELECT * FROM filmlist WHERE judul LIKE '%".$keyword."%' OR genre LIKE '%".$keyword."%' OR rating LIKE '%".$keyword."%' OR tahun LIKE '%".$keyword."%' OR sutradara LIKE '%".$keyword."%'");
}



 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Rental DVD Lightning</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>
<body>

<div class="wrapper">
    <?php require'assets/html/sidebar.php'; ?>

    <div class="main-panel">
        <?php require'assets/html/navbar.php'; ?>
        <!-- Film List -->
        <div class="content">
            <div class="row">
                    <!-- search function -->
                     <div class="col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Search</h4>
                            </div>
                            <div class="content">
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Cari Film dan Lainnya..</label>
                                                <input name="search" type="text" class="form-control" placeholder="Masukan Data yang ingin dicari..." autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" name="cari" class="btn btn-info btn-fill pull-right">Cari</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- input Function -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Upload Film</h4>
                            </div>
                            <div class="content">
                                <form action="filmList.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Judul Film</label>
                                                <input name="judul" type="judul" class="form-control" placeholder="Masukan Judul Film..." autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Genre Film</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="genre">
                                                  <option value="Drama">Drama</option>
                                                  <option value="Comedy">Comedy</option>
                                                  <option value="Horror">Horror</option>
                                                  <option value="Action">Action</option>
                                                  <option value="Animation">Animation</option>
                                                  <option value="Documenter">Documenter</option>
                                                  <option value="Fantasy">Fantasy</option>
                                                  <option value="Science Fiction (Sci - Fi)">Science Fiction (Sci - Fi)</option>
                                                  <option value="Thriller">Thriller</option>
                                                  <option value="Musical">Musical</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Rating</label>
                                                <select name="rating" class="form-control" id="exampleFormControlSelect1">
                                                  <option values="1">1</option>
                                                  <option values="2">2</option>
                                                  <option values="3">3</option>
                                                  <option values="4">4</option>
                                                  <option values="5">5</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tahun</label>
                                                <input name="tahun" type="text" class="form-control" placeholder="Masukan Tahun Rilis..." autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Sutradara</label>
                                                <input name="sutradara" type="text" class="form-control" placeholder="Masukan Nama Sutradara FIlm..." autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="input-group col-sm-12">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                          </div>
                                          <div class="custom-file">
                                            <input type="file" name="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                          </div>
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-info btn-fill pull-right">Update Film</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row-fluid">
                    <?php foreach($results as $result) : ?>
                    <div class="col-sm-4">
                        <div class="card-columns-fluid">
                            <div class="card" style="padding: 20px;">     
                                  <img src="assets/img/dvd-cover/<?= $result['image']; ?>" class="card-img-top">
                                  <div class="card-body">
                                    <h3 class="card-title"><b><?= $result["judul"]; ?></b></h3>
                                    <p class="card-text">Genre : <?= $result["genre"]; ?></p>
                                    <p class="card-text">Rating : <?= $result["rating"]; ?></p>
                                    <p class="card-text">Years : <?= $result["tahun"]; ?></p>
                                    <p class="card-text">Sutradara : <?= $result["sutradara"]; ?></p>
                                    <a href="hapusFilm.php?id=<?= $result['id']; ?>" onclick="return confirm('Yakin ?');" class="btn btn-danger btn-fill"><i class="pe-7s-trash"></i></a>
                                    <a href="updateFilmList.php?id=<?= $result['id']; ?>" class="btn btn-primary btn-fill"><i class="pe-7s-refresh-2"></i></a>
                                  </div> 
                            </div>  
                        </div>    
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>
</div>


</body>

        <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

</html>
