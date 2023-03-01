<?php

require ( 'koneksi.php' );

$kec = $_POST['kecamatan' ];

$query= "SELECT positif,sembuh,meninggal,latitude,longitude FROM covid LEFT JOIN marker ON covid.id_marker = marker.id_marker where covid.id_marker = '$kec'";
$data = mysqli_query($koneksi,$query);
$result = mysqli_fetch_assoc($data);
echo json_encode($result);
