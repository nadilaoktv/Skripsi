<?php
if (isset($_POST['jumlah_cluster'])) {
	perhitungan($_POST['jumlah_cluster']);
}

function perhitungan($jumlah_cluster)
{
	require_once 'koneksi.php';

	// Get data
	$query = "SELECT id_covid,positif,sembuh,meninggal FROM covid";
	$temp = mysqli_query($koneksi, $query);
	$data = mysqli_fetch_all($temp);

	// Jumlah cluster
	$k = $jumlah_cluster;

	// Inisialisasi centroid awal secara random
	$acuan = [0, 1, 2, 4, 5];
	$centroids = array();
	for ($i = 0; $i < $k; $i++) {
		$centroids[$i] = array($data[$acuan[$i]][1], $data[$acuan[$i]][2], $data[$acuan[$i]][3]);
	}

	// Drop perhitungan lama sebelumnya
	$query1 = 'DELETE FROM iterasi WHERE jumlah_cluster=' . $k;
	$sql1 = $koneksi->query($query1);

	$iterasi = 1;
	// Melakukan iterasi hingga konvergen
	while (true) {
		// input keterangan perhitungan baru
		$query2 = "INSERT INTO iterasi (iterasi, jumlah_cluster) VALUES ('" . $iterasi . "', '" . $k . "')";
		$sql2 = $koneksi->query($query2);
		// simpan pusat cluster
		$last_id_iterasi = $koneksi->insert_id;
		for ($i = 0; $i < $k; $i++) {
			$query3 = "INSERT INTO centroid (id_iterasi, Pusat_C1, Pusat_C2, Pusat_C3) VALUES ('" . $last_id_iterasi . "', '" . $centroids[$i][0] . "', '" . $centroids[$i][1] . "', '" . $centroids[$i][2] . "')";
			$sql3 = $koneksi->query($query3);
		}

		// Menghitung jarak setiap data ke setiap centroid V
		$distances = array();
		for ($i = 0; $i < count($data); $i++) {
			for ($j = 0; $j < $k; $j++) {
				$distances[$i][$j] = sqrt(pow($data[$i][1] - $centroids[$j][0], 2) + pow($data[$i][2] - $centroids[$j][1], 2) + pow($data[$i][3] - $centroids[$j][2], 2));
			}
		}

		// Mengelompokkan data ke cluster terdekat V
		$clusters = array();
		$query4 = "";
		for ($i = 0; $i < count($data); $i++) {
			$closest = array_keys($distances[$i], min($distances[$i]));
			$clusters[$closest[0]][] = $data[$i];

			// simpan distance dan hasil cluster
			if ($k == 3) {
				$query4 = "INSERT INTO cluster_3 (id_iterasi, id_covid, C1, C2, C3, Hasil) VALUES ('" . $last_id_iterasi . "', '" . $data[$i][0] . "', '" . $distances[$i][0] . "', '" . $distances[$i][1] . "', '" . $distances[$i][2] . "', '" . $closest[0] + 1 . "')";
			} elseif ($k == 4) {
				$query4 = "INSERT INTO cluster_4 (id_iterasi, id_covid, C1, C2, C3, C4, Hasil) VALUES ('" . $last_id_iterasi . "', '" . $data[$i][0] . "', '" . $distances[$i][0] . "', '" . $distances[$i][1] . "', '" . $distances[$i][2] . "', '" . $distances[$i][3] . "', '" . $closest[0] + 1 . "')";
			} elseif ($k == 5) {
				$query4 = "INSERT INTO cluster_5 (id_iterasi, id_covid, C1, C2, C3, C4, C5, Hasil) VALUES ('" . $last_id_iterasi . "', '" . $data[$i][0] . "', '" . $distances[$i][0] . "', '" . $distances[$i][1] . "', '" . $distances[$i][2] . "', '" . $distances[$i][3] . "', '" . $distances[$i][4] . "', '" . $closest[0] + 1 . "')";
			}
			$sql4 = $koneksi->query($query4);
		}

		// Menentukan centroid baru
		$new_centroids = array();
		for ($i = 0; $i < $k; $i++) {
			$x = 0;
			$y = 0;
			$z = 0;
			for ($j = 0; $j < count($clusters[$i]); $j++) {
				$x += $clusters[$i][$j][1];
				$y += $clusters[$i][$j][2];
				$z += $clusters[$i][$j][3];
			}
			if (count($clusters[$i]) > 0) {
				$new_centroids[] = array($x / count($clusters[$i]), $y / count($clusters[$i]), $z / count($clusters[$i]));
			} else {
				// Jika tidak ada data dalam cluster, tetap gunakan centroid lama
				$new_centroids[] = $centroids[$i];
			}
		}

		// Jika centroid tidak berubah, hentikan iterasi
		if ($new_centroids == $centroids) {
			break;
		}

		// Simpan centroid baru dan lanjutkan iterasi
		$centroids = $new_centroids;
		$iterasi++;
	}
	header("Location: ../pages/data_iterasi.php?cluster=" . $k . "&iterasi=1");
	exit;
}
