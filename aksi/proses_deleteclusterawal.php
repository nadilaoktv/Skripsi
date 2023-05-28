<?php

require ( 'koneksi.php' );

$id1 = $_GET[ 'id_clusterawal' ];
$query1 = "DELETE FROM centroid_awal WHERE id=$id1";
$sql2 = $koneksi->query( $query1 );

if ( $sql2 == true ) {
    echo "<script> 
	alert('Data berhasil dihapus!');
	document.location.href = ' http://localhost/skripsi/pages/data_clusterawal.php';
	</script>
	";
} else {
    echo "<script> 
	alert('Data Gagal dihapus!');
	
	</script>";
}

?>