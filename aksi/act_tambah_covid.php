<?php
include 'koneksi.php';
$kecamatan = $_POST[ 'kecamatan' ];
$positif = $_POST[ 'positif' ];
$sembuh = $_POST[ 'sembuh' ];
$meninggal = $_POST[ 'meninggal' ];

//mysqli_query( $koneksi, "INSERT INTO covid set id_marker = '$POST[id_marker]', positif = '$POST[positif]', sembuh = '$POST[sembuh]', meninggal = '$POST[meninggal]'" ) or die ( mysqli_error( $koneksi ) );
$query = "INSERT INTO covid (id_marker, positif, sembuh, meninggal) VALUES ('".$kecamatan."','".$positif."','".$sembuh."','".$meninggal."')";

$sql = $koneksi->query( $query );

if ( $sql == true ) {
    echo "<script> 
	alert('Data berhasil ditambahkan!');
	document.location.href = ' http://localhost/skripsi/pages/data_covid.php';
	</script>
	";
} else {
    echo "<script> 
	alert('Data Gagal ditambahkan!');
	document.location.href = ' http://localhost/skripsi/pages/tambah_datacovid.php';
	</script>";
}