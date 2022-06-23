<?php 

$conn = mysqli_connect("localhost", "root", "", "tokodvd");

function queryTableBooking($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function queryFilmList($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambahFilm($data) {
	global $conn;
	$judul = htmlspecialchars($data["judul"]);
	$genre = htmlspecialchars($data["genre"]);
	$rating = htmlspecialchars($data["rating"]);
	$tahun = htmlspecialchars($data["tahun"]);
	$sutradara = htmlspecialchars($data["sutradara"]);
	$image = upload();

	$query = "INSERT INTO `filmlist` (`id`, `judul`, `genre`, `rating`, `tahun`, `sutradara`, `image`) VALUES (NULL, '$judul', '$genre', '$rating', '$tahun', '$sutradara', '$image')";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function tambahBooking($data) {
	global $conn;
	$judul = htmlspecialchars($data["judul"]);
	$genre = htmlspecialchars($data["genre"]);
	$email = htmlspecialchars($data["email"]);
	$nomor = htmlspecialchars($data["nomor"]);

	$query = "INSERT INTO `booking` (`id`, `judul`, `genre`, `email`, `nomor`) VALUES (NULL, '$judul', '$genre', '$email', '$nomor');";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function updateFilmList($data) {
	global $conn;
	$id = $data["id"];
	$judul = htmlspecialchars($data["judul"]);
	$genre = htmlspecialchars($data["genre"]);
	$rating = htmlspecialchars($data["rating"]);
	$tahun = htmlspecialchars($data["tahun"]);
	$sutradara = htmlspecialchars($data["sutradara"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	if ($_FILES["file"]["error"] === 4) {
		$image = $gambarLama;
	} else {
		$image = upload();
	}

	
	$query = "UPDATE `filmlist` SET
	 `judul` = '$judul',
	 `genre` = '$genre',
	  `rating` = '$rating',
	   `tahun` = '$tahun',
	   `sutradara` = '$sutradara',
	    `image` = '$image'
	     WHERE `filmlist`.`id` = $id";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}




// //////////////////////////////////////////////////////////////////////////////////////

function upload() {
	$namaFile = $_FILES["file"]["name"];
	$ukuranFile = $_FILES["file"]["size"];
	$error = $_FILES["file"]["error"];
	$tmpName = $_FILES["file"]["tmp_name"];

	// cek jika ukuran terlalu besar
	// if ($ukuranFile > 50000) {
	// 	echo "<script>Yg anda upload terlalu besar</script>";
	// 	return false;
	// }

	// cek apakah tidak ada gambar yang di upload
	if ($error === 4) {
		return "";
	}

	//  cek apakah yang di upload adalah gambar
	$ekstensiGambarValid = ["jpg", "jpeg", "png"];
	$ekstensiGambar = explode(".", $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));

	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>Yg anda upload bukan gambar</script>";
		return false;
	}

	// Generate gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= $ekstensiGambar;

	// Lolos pengecekan
	move_uploaded_file($tmpName, 'assets/img/dvd-cover/'.$namaFileBaru);

	// Jika ingin compress
	// $target_path = "asset/img/".$namaFileBaru;
	// $source_img = $tmpName;
 //    $destination_img = $target_path;
	// compress($source_img, $destination_img, 7);
	return $namaFileBaru;
}



 ?>