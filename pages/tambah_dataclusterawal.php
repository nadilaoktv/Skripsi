<?php
include "../aksi/koneksi.php";

$cluster = $_GET["cluster"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SISTEM CLUSTERING COVID-19</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/startmin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">


    <script src="https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css" rel="stylesheet" />

    <script src="https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js"></script>
    <link href="https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@300&display=swap" rel="stylesheet">
    <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js"></script>
    <link href="https://api.tiles.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css" rel="stylesheet" />
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
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                        <h1 class="page-header">Data Cluster Awal</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Data Lokasi
                            </div>
                            <div class="panel-body">
                                <form method="post" action="../aksi/act_tambah_cluster_awal.php" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="hidden" id="cluster" name="cluster" value="<?= $cluster ?>">
                                                <label>Centroid <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="centroid"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Kecamatan<span class="text-danger">*</span></label>
                                                <select class="form-control" type="text" name="kecamatan" id="kecamatan">
                                                    <option value="">---</option>
                                                    <?php
                                                    $query = mysqli_query($koneksi, "SELECT covid.id_covid,marker.kecamatan FROM covid LEFT JOIN marker ON covid.id_marker=marker.id_marker") or die(mysqli_error($koneksi));
                                                    while ($data = mysqli_fetch_array($query)) {
                                                        echo "<option value = $data[id_covid]> $data[kecamatan] </option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Positif <span class="text-denger">*</span></label>
                                                <input class="form-control" type="text" name="positif" id="positif" readonly />
                                            </div>
                                            <div class="form-group">
                                                <label>Sembuh <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="sembuh" id="sembuh" readonly />
                                            </div>
                                            <div class="form-group">
                                                <label>Meninggal <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="meninggal" id="meninggal" readonly />
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary" id="submit" disabled><span class="glyphicon glyphicon-save"></span> Simpan</button>
                                                <a class="btn btn-danger" href="data_clusterawal.php"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div id="map" style="height: 400px;"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script type="text/javascript">
        L.mapbox.accessToken = 'pk.eyJ1IjoibmFkaWxhb2t0diIsImEiOiJjbDlxZHRqNHIwNHBkM3VxbDJ2dnpwdjc2In0.SF-4dZs0-xYNFB4Olyd0Zg';
        var map = L.mapbox.map('map')
            .setView([0.6148553730577153, 116.38333684517843], 7)
            .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));


        var myLayer = L.mapbox.featureLayer().addTo(map);

        var latInput = document.querySelector("[name=latitude]");
        var lntInput = document.querySelector("[name=longitude]");

        var curLocation = [0.6148553730577153, 116.38333684517843];

        map.attributionControl.setPrefix(false);

        var marker = new L.marker(curLocation, {
            draggable: "false",
        });

        map.addLayer(marker);
    </script>

    <script>
        $(document).ready(function() {
            $('#kecamatan').change(function() {
                var kec = $(this).val();
                if (kec == "") {
                    $('#positif').val("");
                    $('#sembuh').val("");
                    $('#meninggal').val("");
                    $('#submit').attr('disabled', true);
                } else {
                    $.ajax({
                        url: '../aksi/get_data_cluster.php',
                        type: "POST",
                        data: {
                            "kecamatan": kec,
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#positif').val(data.positif);
                                $('#sembuh').val(data.sembuh);
                                $('#meninggal').val(data.meninggal);
                                $('#submit').removeAttr('disabled');
                            } else {
                                $('#positif').val("invalid");
                                $('#sembuh').val("invalid");
                                $('#meninggal').val("invalid");
                            }
                        }
                    })
                }
            });
        });
    </script>

    <!-- jQuery -->
    <script src="../js/jquery.min.js">
        < /scrip>

        <
        !--Bootstrap Core JavaScript-- >
        <
        script src = "../js/bootstrap.min.js" >
    </script>

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