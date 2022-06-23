<?php 

require 'machine.php';


$query = "SELECT * FROM booking";
$results = queryTableBooking($query);
$querys = queryTableBooking("SELECT * FROM filmlist");

if (isset($_POST["submit"])) {
    if (tambahBooking($_POST) > 0) {
        echo "
          <script>
          alert('Film Berhasil Ditambahkan');
            document.location.href = 'tableBooking.php';
          </script>";
      }else {
        echo "
          <script>
            alert('Film gagal Ditambahkan');
            document.location.href = 'tableBooking.php';
          </script>";
      }
}


if (isset($_POST["cari"])) {

  $keyword = $_POST["search"];
  $results = queryTableBooking("SELECT * FROM booking WHERE judul LIKE '%".$keyword."%' OR genre LIKE '%".$keyword."%' OR email LIKE '%".$keyword."%' OR nomor LIKE '%".$keyword."%'");
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
        <!-- Awal Table -->
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
                                                <label>Cari data Penyewa dan Lainnya..</label>
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
                                <h4 class="title">Upload Penyewa</h4>
                            </div>
                            <div class="content">
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Judul Film</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="judul">
                                                    <?php foreach ($querys as $query) : ?>
                                                    <option value="<?= $query['judul'] ?>"><?= $query['judul'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
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
                                                <label>Email Penyewa</label>
                                                <input name="email" type="text" class="form-control" placeholder="Masukan Alamat Email Penyewa..." autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nomor Telpon</label>
                                                <input name="nomor" type="text" class="form-control" placeholder="Masukan Tahun Rilis..." autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-info btn-fill pull-right">Tambahkan Penyewa</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Halaman Booking</h4>
                                <p class="category">Daftar pengguna yang sedang menyewa DVD</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>No.</th>
                                    	<th>Judul Film</th>
                                    	<th>Genre</th>
                                    	<th>Email Penyewa</th>
                                    	<th>Nomor Telpon/Whatsapp</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach($results as $result) : ?>
                                        <tr>
                                        	<td><?= $i; ?></td>
                                        	<td><?= $result["judul"]; ?></td>
                                        	<td><?= $result["genre"]; ?></td>
                                        	<td><?= $result["email"]; ?></td>
                                        	<td><?= $result["nomor"]; ?></td>
                                            <td>
                                                <a href="hapusBooking.php?id=<?= $result['id']; ?>" onclick="return confirm('Yakin ?');" class="btn btn-danger btn-fill"><i class="pe-7s-trash"></i></a>
                                                <!-- <a href="updateBookingList.php?id=<?= $result['id']; ?>" class="btn btn-primary btn-fill"><i class="pe-7s-refresh-2"></i></a> -->
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Akhir Table -->


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
