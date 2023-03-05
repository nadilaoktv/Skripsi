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

    <title>Data Penderita Covid-19</title>

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
                <a class="navbar-brand" href="index.php">Admin</a>
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
                            <a href="data_marker.php"><i class="fa fa-map" aria-hidden="true"></i> Data Lokasi</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Lokasi</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Tabel Data Lokasi
                            </div>

                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <a href='tambah_data_marker.php' class='btn btn-success' style="margin-bottom: 10px;">Tambah Data</a>
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Kecamatan</th>
                                                <th>Longitude</th>
                                                <th>Latitude</th>
                                                <th colspan="2">Action</th>
                                            </tr>
                                        </thead>
                                        <?php

                                        $query1 = "SELECT * FROM marker";
                                        $sql1 = mysqli_query($koneksi, $query1);
                                        $index = 1;
                                        while ($row1 = mysqli_fetch_array($sql1)) {
                                            echo "<tr>
                                            <td>" . $index . "</td>
                                            <td>" . $row1['kecamatan'] . "</td>
                                            <td>" . $row1['longitude'] . "</td>
                                            <td>" . $row1['latitude'] . "</td>

                                          
                                            <td width> <a href='http://localhost/skripsi/aksi/proses_delete.php?id_marker=" . $row1['id_marker'] . "' class = 'btn btn-danger'>Delete</a></td>
                                            <td>
                                            <a href='http://localhost/skripsi/pages/ubah_data_marker.php?id_marker=" . $row1['id_marker'] . "' class = 'btn btn-warning'>Edit</a></td>
</td>";
                                            $index++;
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