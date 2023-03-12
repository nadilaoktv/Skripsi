<?php
include "koneksi.php";
$id_jlm_cluster = $_POST['cluster'];
$no_centroid = $_POST['centroid'];
$id_covid = $_POST['kecamatan'];

$query = "INSERT INTO `centroid_awal`(`no_centroid`, `id_covid`, `id_jumlah_cluster`) VALUES ('" . $no_centroid . "','" . $id_covid . "','" . $id_jlm_cluster . "')";
$sql = $koneksi->query($query);

header("Location: ../pages/data_clusterawal.php");
exit;
