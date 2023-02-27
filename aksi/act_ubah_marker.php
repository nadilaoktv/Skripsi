<?php
include 'koneksi.php';
$id = $_POST[ 'id_marker' ];
$kecamatan = $_POST[ 'kecamatan' ];
$latitude = $_POST[ 'latitude' ];
$longitude = $_POST[ 'longitude' ];

$query =  "UPDATE marker SET kecamatan='$kecamatan', latitude='$latitude', longitude='$longitude' WHERE id_marker='$id'" ;
$sql = $koneksi->query( $query );
if ( $sql == true ) {
    echo "<script> 
        alert('Data berhasil ditambahkan!');
        document.location.href = 'http://localhost/skripsi/pages/data_marker.php';
        </script>
        ";
} else {
    echo "<script> 
            alert('Data Gagal ditambahkan!');
            document.location.href = 'http://localhost/skripsi/pages/data_marker.php'";
}
?>
