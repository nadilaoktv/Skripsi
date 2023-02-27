<?php 
include "koneksi.php";
$kecamatan = $_POST['kecamatan'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
     
		// mysqli_query($koneksi, "INSERT INTO marker (kecamatan, latitude, longitude)VALUES('$kecamatan','$latitude','$latitude')");
		// echo "<script>
		// alert('Data Berhasil Ditambahkan');
		// </script>

		$query = "INSERT INTO marker (kecamatan, latitude, longitude) VALUES ('".$kecamatan."','".$latitude."','".$longitude."')";

		$sql = $koneksi->query($query);

if($sql==true){
	echo "<script> 
	alert('Data berhasil ditambahkan!');
	document.location.href = ' http://localhost/skripsi/pages/data_marker.php';
	</script>
	";
}else{
	echo "<script> 
	alert('Data Gagal ditambahkan!');
	document.location.href = ' http://localhost/skripsi/pages/tambah_data_marker.php';
	</script>";
}