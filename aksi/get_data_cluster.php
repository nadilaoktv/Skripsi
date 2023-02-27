<?php

require ( 'koneksi.php' );

$kec = $_POST['kecamatan' ];

$query= "SELECT * FROM covid where id_marker='$kec'";
$data = mysqli_query($koneksi,$query);
$result = mysqli_fetch_assoc($data);
echo json_encode($result);
