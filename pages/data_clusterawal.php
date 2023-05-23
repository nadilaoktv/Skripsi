<?php
include '../aksi/koneksi.php';
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
                            <a href="data_clusterawal.php"><i class="fa fa-map" aria-hidden="true"></i> Data Cluster Awal</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Cluster Awal</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">

                        <?php
                        $query1 = "SELECT * FROM tb_jumlah_cluster";
                        $sql1 = mysqli_query($koneksi, $query1);
                        $cluster = mysqli_fetch_all($sql1);
                        foreach ($cluster as $row) {
                        ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Tabel Cluster - <?= $row[1]; ?> Awal
                                </div>

                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <?php
                                        print_r($row[0]);
                                        $query1 = "SELECT centroid_awal.no_centroid,marker.kecamatan,covid.positif,covid.sembuh,covid.meninggal FROM `centroid_awal` LEFT JOIN covid ON centroid_awal.id_covid=covid.id_covid LEFT JOIN marker ON covid.id_marker=marker.id_marker LEFT JOIN tb_jumlah_cluster ON centroid_awal.id_jumlah_cluster=tb_jumlah_cluster.id WHERE id_jumlah_cluster=" . $row[0]." ORDER BY centroid_awal.no_centroid ASC";
                                        $sql1 = mysqli_query($koneksi, $query1);
                                        $row1 = mysqli_fetch_all($sql1);
                                        if (count($row1) < $row[1]) {
                                        ?>
                                            <a href='tambah_dataclusterawal.php?cluster=<?= $row[0]; ?>' class='btn btn-success' style="margin-bottom: 10px;">Tambah Data</a>
                                        <?php
                                        }
                                        ?>
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Centroid</th>
                                                    <th>Kecamatan</th>
                                                    <th>Positif</th>
                                                    <th>Sembuh</th>
                                                    <th>Meninggal</th>
                                                    <th colspan="2">Action</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            foreach ($row1 as $value) {
                                                echo "<tr><th>" . $value[0] . "</th>
                                                    <td>" . $value[1] . "</td>
                                                    <td>" . $value[2] . "</td>
                                                    <td>" . $value[3] . "</td>
                                                    <td>" . $value[4] . "</td>
                                                    <td width> <a href='../aksi/proses_delete.php?id_del = ' class='btn btn-danger'>Delete</a></td>
                                                    <td>
                                                    <a href='ubah_data_marker.php?id_edit =' class='btn btn-warning'>Edit</a></td></td>";
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /#page-wrapper -->

            </div>
            <!-- /#wrapper -->

            <!-- jQuery -->
            <script src="../js/jquery.min.js"></script>

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