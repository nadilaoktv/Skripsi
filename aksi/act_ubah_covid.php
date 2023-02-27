<?php
include 'koneksi.php';
$id = $_POST[ 'id_covid' ];
$kecamatan = $_POST[ 'kecamatan' ];
$positif = $_POST[ 'positif' ];
$sembuh = $_POST[ 'sembuh' ];
$meninggal = $_POST['meninggal'];

$query =  "UPDATE marker, covid SET  positif='$positif', sembuh='$sembuh', meninggal='$meninggal' WHERE marker.id_marker = covid.id_marker AND id_covid='$id'" ;
$sql = $koneksi->query( $query );
if ( $sql == true ) {
    echo "<script> 
        alert('Data berhasil diubah!');
        document.location.href = 'http://localhost/skripsi/pages/data_covid.php';
        </script>
        ";
} else {
    echo "<script> 
            alert('Data Gagal ditambahkan!');
            document.location.href = 'http://localhost/skripsi/pages/data_covid.php'";
}
?>
