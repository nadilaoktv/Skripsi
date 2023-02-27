<?php

require ( 'koneksi.php' );

$id1 = $_GET[ 'id_marker' ];
$query1 = "DELETE FROM marker WHERE id_marker=$id1";
$sql2 = $koneksi->query( $query1 );

if ( $sql2 == true ) {
    echo "<script> 
	alert('Data berhasil dihapus!');
	document.location.href = ' http://localhost/skripsi/pages/data_marker.php';
	</script>
	";
} else {
    echo "<script> 
	alert('Data Gagal dihapus!');
	
	</script>";
}

?>