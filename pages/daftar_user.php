<?php
include '../aksi/koneksi.php'
?>
<!DOCTYPE html>
<html lang = 'en'>
<head>
<meta charset = 'utf-8'>
<meta http-equiv = 'X-UA-Compatible' content = 'IE=edge'>
<meta name = 'viewport' content = 'width=device-width, initial-scale=1'>
<meta name = 'description' content = ''>
<meta name = 'author' content = ''>

<title>SISTEM CLUSTERING COVID-19</title>

<!-- Bootstrap Core CSS -->
<link href = '../css/bootstrap.min.css' rel = 'stylesheet'>

<!-- MetisMenu CSS -->
<link href = '../css/metisMenu.min.css' rel = 'stylesheet'>

<!-- Timeline CSS -->
<link href = '../css/timeline.css' rel = 'stylesheet'>

<!-- Custom CSS -->
<link href = '../css/startmin.css' rel = 'stylesheet'>

<!-- Morris Charts CSS -->
<link href = '../css/morris.css' rel = 'stylesheet'>

<!-- Custom Fonts -->
<link href = '../css/font-awesome.min.css' rel = 'stylesheet' type = 'text/css'>

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
                            <a href="daftar_user.php"><i class="fa fa-user" aria-hidden="true"></i> Data User</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Daftar User</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Tabel Daftar User
                            </div>

                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <a href='tambah_user.php' class='btn btn-success' style="margin-bottom: 10px;">Tambah Data</a>
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th colspan="2">Action</th>
                                            </tr>
                                        </thead>
                                        <?php 
                                        $no=1;
                                        $query1 = "SELECT * FROM tb_user";
                                        $sql1 = mysqli_query($koneksi,$query1);
                                        while ($row1= mysqli_fetch_array($sql1)) {
                                            echo "<tr><th>".$no++."</th>
                                            <td>".$row1['username']."</td>
                                            <td>".$row1['password']."</td>
                                            <td width> <a href='http://localhost/skripsi/proses_deleteuser.php?id_del=".$row1['id']."' class='btn btn-danger'>Delete</a></td>";
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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

  <script src="https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js"></script>
  <link href="https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css" rel="stylesheet" />

  <script src="https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js"></script>
  <link href="https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css" rel="stylesheet" />

  <title>SISTEM CLUSTERING COVID-19</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@300&display=swap" rel="stylesheet">
  <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js"></script>
  <link href="https://api.tiles.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css" rel="stylesheet" />
  <style>
    .marker {
      background-image: url('icon.png');
      background-size: cover;
      width: 20px;
      height: 30px;
      border-radius: 10%;
      cursor: pointer;
    }
    .mapboxgl-popup {
      max-width: 200px;
    }
    .mapboxgl-popup-content {
      text-align: center;
      font-family: 'Open Sans', sans-serif;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #283b4e; padding-left: 10px">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="index.php"> Home </a>
        </li>
          <a class="nav-link" href="berita.php">Portal Berita</a>
          <a class="nav-link" href="pages/login.html">Login</a>
        </li>
      </ul>
    </div>
  </nav>

  <div style="text-align:center;padding: 10px; background-color: lightblue; font-family: 'Exo 2', sans-serif;">
    <?php include "aksi/koneksi.php";?>
    <h1>PEMETAAN PENDERITA COVID-19 </h1>
    <h4>KABUPATEN BERAU</h4>
  </div>
</br>
<a href=""></a>
<div id="map" style="height: 580px; width: 100%;margin-top: -23px; float: all;"></div>

<?php 
$jumlah_data = 0;
$data =[];
for ($i=1; $i < 4; $i++) { 
  $query = "SELECT centroid_awal.no_centroid,marker.kecamatan,marker.longitude,marker.latitude,covid.positif,covid.sembuh,covid.meninggal, centroid_awal.id_covid, marker.id_marker FROM `centroid_awal` LEFT JOIN covid ON centroid_awal.id_covid=covid.id_covid LEFT JOIN marker ON covid.id_marker=marker.id_marker LEFT JOIN tb_jumlah_cluster ON centroid_awal.id_jumlah_cluster=tb_jumlah_cluster.id WHERE id_jumlah_cluster=" . $i." ORDER BY centroid_awal.no_centroid ASC";
  $sql= mysqli_query($koneksi, $query);
  $row1 = mysqli_fetch_all($sql);
  foreach ($row1 as $key => $arr) {
    $data[$jumlah_data] = $row1;
  }
  $jumlah_data++;
}
    // foreach ($data as $value) {
    //   print count($value);
    // }
?>

<script>
  mapboxgl.accessToken = 'pk.eyJ1IjoibmFkaWxhb2t0diIsImEiOiJjbDlxZHRqNHIwNHBkM3VxbDJ2dnpwdjc2In0.SF-4dZs0-xYNFB4Olyd0Zg';

  var geojson = {
    'type': 'FeatureCollection',
    'features': [
    <?php 
    foreach ($data as $row) {
      foreach ($row as $value) {
        echo'{
          "type": "Feature",
          "geometry": {
            "type": "Point",
            "coordinates": ['.$value[2].','.$value[3].']
          },
          "properties": {
            "Kecamatan": "'.$value[1].'",
            "title": "'.$value[1].'",
            "description": "'.$value[1].'",
            "id_marker": "'.$value[8].'"
          }
        },';
      }
    }

    // while ($row = $sql->fetch_array()){ 
    //   echo'{
    //     "type": "Feature",
    //     "geometry": {
    //       "type": "Point",
    //       "coordinates": ['.$row['longitude'].','.$row['latitude'].']
    //     },
    //     "properties": {
    //       "Kecamatan": "'.$row['kecamatan'].'",
    //       "title": "'.$row['longitude'].'",
    //       "description": "'.$row['latitude'].'",
    //     }
    //   },';
    // }
    ?>
    ]
  };

  var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    //center: [1.846291,116.702492],
    // center: [112.06207181593065,-7.838499996470901],
    center: [116.83576284981726, 2.150725548905608, ],
    zoom: 6
  });

      // add markers to map
      geojson.features.forEach(function (marker) {
        // create a HTML element for each feature
        var el = document.createElement('div');
        el.className = 'marker';
        var id_marker = '</p><a href="http://localhost/skripsi/pages/data_iterasi.php?cluster=3&iterasi=1&id_marker=' + marker.properties.id_marker

        // make a marker for each feature and add it to the map
        new mapboxgl.Marker(el)
        .setLngLat(marker.geometry.coordinates)
        .setPopup(
            new mapboxgl.Popup({ offset: 25 }) // add popups
            .setHTML(
              ' <h6>' +
              marker.properties.title +
              '</h6><p>' +
              marker.properties.description + 
              id_marker + '">Detail</a></td>'
              )
            )
        .addTo(map);
      });

      map.on('load', function () {
    // Add a GeoJSON source containing place coordinates and information.
    map.addSource('places', {
      'type': 'geojson',
      'data': geojson
    });

    map.addLayer({
      'id': 'poi-labels',
      'type': 'symbol',
      'source': 'places',
      'layout': {
        'text-field': ['get', 'title'],
        'text-anchor': 'top',
        "text-font": ["DIN Offc Pro Medium", "Arial Unicode MS Bold"],
        "text-size": 15
      },
      'paint': {
        "text-color": "#B22222"
      }
    });
  });


</script>
</body>
</html>

