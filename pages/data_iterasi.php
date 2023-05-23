<?php
include '../aksi/koneksi.php';

$cluster = null;
$iterasi = null;
$id_marker = null;
if (isset($_GET['cluster']) && isset($_GET['iterasi'])) {
    $cluster = $_GET['cluster'];
    $iterasi = $_GET['iterasi'];
    $id_marker = $_GET['id_marker'];
    // $id_marker = isset($_GET['id_marker']) ? $_GET['id_marker'] : null;
}

?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content=''>
    <meta name='author' content=''>

    <title>SISTEM CLUSTERING COVID-19</title>

    <!-- Bootstrap Core CSS -->
    <link href='../css/bootstrap.min.css' rel='stylesheet'>

    <!-- MetisMenu CSS -->
    <link href='../css/metisMenu.min.css' rel='stylesheet'>

    <!-- Timeline CSS -->
    <link href='../css/timeline.css' rel='stylesheet'>

    <!-- Custom CSS -->
    <link href='../css/startmin.css' rel='stylesheet'>

    <!-- Morris Charts CSS -->
    <link href='../css/morris.css' rel='stylesheet'>

    <!-- Custom Fonts -->
    <link href='../css/font-awesome.min.css' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="dashboard.php">Admin</a>
            </div>

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>


            <ul class="nav navbar-right navbar-top-links">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> User <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="index.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="dashboard.php" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-map" aria-hidden="true"></i>Data iterasi</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Iterasi K-Means</h1>
                        <form method="get" action="../pages/data_iterasi.php">
                            <label for="cluster">Jumlah Cluster:</label>
                            <select name="cluster" id="cluster">
                                <option value="">---</option>
                                <?php
                                // $query1 = "SELECT DISTINCT `jumlah_cluster` FROM `iterasi`";
                                // $sql1 = mysqli_query($koneksi, $query1);
                                // $row1 = mysqli_fetch_all($sql1);
                                // for ($i = 0; $i < count($row1); $i++) {
                                //     echo " <option value="3">3</option>";
                                // }
                                ?>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <label for="iterasi">Iterasi:</label>
                            <select name="iterasi" id="iterasi">
                                <option value="">---</option>
                            </select>
                            <input type="hidden" id="id_marker" name="id_marker" value="<?php echo $id_marker; ?>">
                            <button class='btn btn-success' style="margin-bottom: 10px;" id="submit" disabled>Pilih Data</button>
                        </form>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Tabel Cluster <?php echo $cluster; ?>
                                Iterasi ke-<?php echo $iterasi; ?>
                            </div>

                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <?php
                                    if ($cluster) {
                                        if($id_marker!=null){
                                            $query1 = "SELECT centroid.Pusat_C1,centroid.Pusat_C2,centroid.Pusat_C3 FROM centroid LEFT JOIN iterasi ON centroid.id_iterasi=iterasi.id_iterasi LEFT JOIN tb_jumlah_cluster ON tb_jumlah_cluster.id=iterasi.id_jumlah_cluster  where iterasi.iterasi= " . $iterasi . " and tb_jumlah_cluster.jumlah_cluster = " . $cluster;
                                        
                                        } else {
                                            $query1 = "SELECT centroid.Pusat_C1,centroid.Pusat_C2,centroid.Pusat_C3 FROM centroid LEFT JOIN iterasi ON centroid.id_iterasi=iterasi.id_iterasi LEFT JOIN tb_jumlah_cluster ON tb_jumlah_cluster.id=iterasi.id_jumlah_cluster  where iterasi.iterasi= " . $iterasi;
                                        
                                        }
                                        $sql1 = mysqli_query($koneksi, $query1);
                                        $row1 = mysqli_fetch_all($sql1);
                                        for ($i = 0; $i < count($row1); $i++) {
                                            $j = $i + 1;
                                            echo "<p>Pusat Cluster " . $j . " :" . $row1[$i][0] . "," . $row1[$i][1] . "," . $row1[$i][2] . "  </p>";
                                        }
                                    }
                                    ?>
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>no</th>
                                                <th>Kecamatan</th>
                                                <?php
                                                if ($cluster == 3) {
                                                    echo "<th>C1</th>
                                                    <th>C2</th>
                                                    <th>C3</th>
                                                    <th>Hasil</th>";
                                                } elseif ($cluster == 4) {
                                                    echo "<th>C1</th>
                                                    <th>C2</th>
                                                    <th>C3</th>
                                                    <th>C4</th>
                                                    <th>Hasil</th>";
                                                } elseif ($cluster == 5) {
                                                    echo "<th>C1</th>
                                                    <th>C2</th>
                                                    <th>C3</th>
                                                    <th>C4</th>
                                                    <th>C5</th>
                                                    <th>Hasil</th>";
                                                }
                                                ?>
                                            </tr>
                                        </thead>
                                        <?php
                                        $no = 1;
                                        if ($cluster == 3) {
                                            if($id_marker!=null){
                                                $query1 = "SELECT marker.kecamatan, cluster.C1,cluster.C2,cluster.C3,cluster.Hasil FROM `cluster_3` AS cluster LEFT JOIN iterasi ON cluster.id_iterasi = iterasi.id_iterasi LEFT JOIN covid ON cluster.id_covid=covid.id_covid LEFT JOIN marker ON covid.id_marker=marker.id_marker LEFT JOIN tb_jumlah_cluster ON tb_jumlah_cluster.id=iterasi.id_jumlah_cluster WHERE iterasi.iterasi = " . $iterasi . " AND tb_jumlah_cluster.jumlah_cluster = " . $cluster . " AND covid.id_marker=".$id_marker;
                                            } else {
                                                $query1 = "SELECT marker.kecamatan, cluster.C1,cluster.C2,cluster.C3,cluster.Hasil FROM `cluster_3` AS cluster LEFT JOIN iterasi ON cluster.id_iterasi = iterasi.id_iterasi LEFT JOIN covid ON cluster.id_covid=covid.id_covid LEFT JOIN marker ON covid.id_marker=marker.id_marker LEFT JOIN tb_jumlah_cluster ON tb_jumlah_cluster.id=iterasi.id_jumlah_cluster WHERE iterasi.iterasi = " . $iterasi . " AND tb_jumlah_cluster.jumlah_cluster = " . $cluster;
                                            }
                                            $sql1 = mysqli_query($koneksi, $query1);
                                            while ($row1 = mysqli_fetch_array($sql1)) {
                                                echo "<tr><td>" . $no++ . "</td>
                                                <td>" . $row1['kecamatan'] . "</td>
                                                <td>" . $row1['C1'] . "</td>
                                                <td>" . $row1['C2'] . "</td>
                                                <td>" . $row1['C3'] . "</td>
                                                <td>" . $row1['Hasil'] . "</td>";
                                            }
                                        } elseif ($cluster == 4) {
                                            if($id_marker!=null){
                                                $query1 = "SELECT marker.kecamatan, cluster.C1,cluster.C2,cluster.C3,cluster.C4,cluster.Hasil FROM `cluster_4` AS cluster LEFT JOIN iterasi ON cluster.id_iterasi = iterasi.id_iterasi LEFT JOIN covid ON cluster.id_covid=covid.id_covid LEFT JOIN marker ON covid.id_marker=marker.id_marker LEFT JOIN tb_jumlah_cluster ON tb_jumlah_cluster.id=iterasi.id_jumlah_cluster WHERE iterasi.iterasi = " . $iterasi . " AND tb_jumlah_cluster.jumlah_cluster = " . $cluster . " AND covid.id_marker=".$id_marker;
                                            } else {
                                                $query1 = "SELECT marker.kecamatan, cluster.C1,cluster.C2,cluster.C3,cluster.C4,cluster.Hasil FROM `cluster_4` AS cluster LEFT JOIN iterasi ON cluster.id_iterasi = iterasi.id_iterasi LEFT JOIN covid ON cluster.id_covid=covid.id_covid LEFT JOIN marker ON covid.id_marker=marker.id_marker LEFT JOIN tb_jumlah_cluster ON tb_jumlah_cluster.id=iterasi.id_jumlah_cluster WHERE iterasi.iterasi = " . $iterasi . " AND tb_jumlah_cluster.jumlah_cluster = " . $cluster;
                                            }
                                            $sql1 = mysqli_query($koneksi, $query1);
                                            while ($row1 = mysqli_fetch_array($sql1)) {
                                                echo "<tr><td>" . $no++ . "</td>
                                                <td>" . $row1['kecamatan'] . "</td>
                                                <td>" . $row1['C1'] . "</td>
                                                <td>" . $row1['C2'] . "</td>
                                                <td>" . $row1['C3'] . "</td>
                                                <td>" . $row1['C4'] . "</td>
                                                <td>" . $row1['Hasil'] . "</td>";
                                            }
                                        } elseif ($cluster == 5) {
                                            if($id_marker!=null) {
                                                $query1 = "SELECT marker.kecamatan, cluster.C1,cluster.C2,cluster.C3,cluster.C4,cluster.Hasil FROM `cluster_4` AS cluster LEFT JOIN iterasi ON cluster.id_iterasi = iterasi.id_iterasi LEFT JOIN covid ON cluster.id_covid=covid.id_covid LEFT JOIN marker ON covid.id_marker=marker.id_marker LEFT JOIN tb_jumlah_cluster ON tb_jumlah_cluster.id=iterasi.id_jumlah_cluster WHERE iterasi.iterasi = " . $iterasi . " AND tb_jumlah_cluster.jumlah_cluster = " . $cluster. " AND covid.id_marker=".$id_marker;
                                            } else {
                                                $query1 = "SELECT marker.kecamatan, cluster.C1,cluster.C2,cluster.C3,cluster.C4,cluster.C5,cluster.Hasil FROM `cluster_5` AS cluster LEFT JOIN iterasi ON cluster.id_iterasi = iterasi.id_iterasi LEFT JOIN covid ON cluster.id_covid=covid.id_covid LEFT JOIN marker ON covid.id_marker=marker.id_marker LEFT JOIN tb_jumlah_cluster ON tb_jumlah_cluster.id=iterasi.id_jumlah_cluster WHERE iterasi.iterasi = " . $iterasi . " AND tb_jumlah_cluster.jumlah_cluster = " . $cluster;
                                            }
                                            // $query1 = "SELECT marker.kecamatan, cluster.C1,cluster.C2,cluster.C3,cluster.C4,cluster.C5,cluster.Hasil FROM `cluster_5` AS cluster LEFT JOIN iterasi ON cluster.id_iterasi = iterasi.id_iterasi LEFT JOIN covid ON cluster.id_covid=covid.id_covid LEFT JOIN marker ON covid.id_marker=marker.id_marker LEFT JOIN tb_jumlah_cluster ON tb_jumlah_cluster.id=iterasi.id_jumlah_cluster WHERE iterasi.iterasi = " . $iterasi . " AND tb_jumlah_cluster.jumlah_cluster = " . $cluster. " AND covid.id_marker=".$id_marker;
                                            $sql1 = mysqli_query($koneksi, $query1);
                                            while ($row1 = mysqli_fetch_array($sql1)) {
                                                echo "<tr><td>" . $no++ . "</td>
                                                <td>" . $row1['kecamatan'] . "</td>
                                                <td>" . $row1['C1'] . "</td>
                                                <td>" . $row1['C2'] . "</td>
                                                <td>" . $row1['C3'] . "</td>
                                                <td>" . $row1['C4'] . "</td>
                                                <td>" . $row1['C5'] . "</td>
                                                <td>" . $row1['Hasil'] . "</td>";
                                            }
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /#page-wrapper -->

            </div>
            <!-- /#wrapper -->

            <!-- jQuery -->
            <script src="../js/jquery.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#cluster').change(function() {
                        var cluster = $(this).val();
                        console.log('-----------',cluster)
                        if (cluster == "") {
                            $('#iterasi').val("");
                            $('#submit').attr('disabled', true);
                        } else {
                            $.ajax({
                                url: '../aksi/get_data_iterasi.php',
                                type: "POST",
                                data: {
                                    "cluster": cluster,
                                },
                                success: function(data) {
                                    $('#iterasi').html(data);
                                    $('#submit').removeAttr('disabled');
                                }
                            })
                        }
                    });
                });
            </script>

            <!-- Bootstrap Core JavaScript -->
            <script src="../js/bootstrap.min.js"></script>

            <!-- Metis Menu Plugin JavaScript -->
            <script src="../js/metisMenu.min.js"></script>

            <!-- Morris Charts JavaScript -->
            <script src="../js/raphael.min.js"></script>
            <script src="../js/morris.min.js"></script>
            <script src="../js/morris-data.js"></script>

            <!-- Custom Theme JavaScript -->
            <script src="../js/startmin.js"></script>

</body>

</html>