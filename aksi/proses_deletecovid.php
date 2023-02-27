<?php

require ( 'koneksi.php' );

$id1 = $_REQUEST[ 'id_del' ];
$query1 = 'DELETE FROM covid WHERE id_covid='.$id1;
$sql2 = $koneksi->query( $query1 );

if ( $sql2 == true ) {
    echo "<script> 
	alert('Data berhasil dihapus!');
	document.location.href=' http://localhost/skripsi/pages/data_covid.php';
	</script>
	";
} else {
    echo "<script> 
	alert('Data Gagal dihapus!');
	document.location.href=' http://localhost/skripsi/pages/data_covid.php';
	</script>";
}

?>