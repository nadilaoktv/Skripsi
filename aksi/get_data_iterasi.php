<?php

require('koneksi.php');

$cluster = $_POST['cluster'];

$query = "SELECT iterasi FROM iterasi LEFT JOIN tb_jumlah_cluster ON tb_jumlah_cluster.id=iterasi.id_jumlah_cluster where tb_jumlah_cluster.jumlah_cluster = '$cluster'";
$data = mysqli_query($koneksi, $query);
$result = mysqli_fetch_all($data);

$options = "<option value=''>---</option>";
foreach ($result as $value) {
    $options .= "<option value='" . $value[0] . "'>" . $value[0] . "</option>";
}

echo $options;
