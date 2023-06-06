<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

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
    <?php include "aksi/koneksi.php";
    $id_cluster = 1;
    if (isset($_GET['id_cluster'])) {
      $id_cluster = $_GET['id_cluster'];
    }
    // echo $id_cluster;
    ?>
    <h1>PEMETAAN PENDERITA COVID-19 </h1>
    <h4>PROVINSI KALIMANTAN TIMUR</h4>
    <label for="jlm_cluster">Jumlah Cluster</label>
    <select name="jlm_cluster" id="jlm_cluster">
      <?php

      $query = "SELECT * FROM `tb_jumlah_cluster`";
      $sql = mysqli_query($koneksi, $query);
      $row = mysqli_fetch_all($sql);
      foreach ($row as $key => $value) {
        if ($value[0] == $id_cluster) {
          echo '<option value="' . $value[0] . '" selected>' . $value[1] . '</option>';
        } else {
          echo '<option value="' . $value[0] . '">' . $value[1] . '</option>';
        }
      }
      ?>
    </select>
    <?php
    ?>
  </div>
  </br>
  <a href=""></a>
  <div id="map" style="height: 580px; width: 100%;margin-top: -23px; float: all;"></div>

  <?php
  // select id iterasi terakhir dari jumlah cluster
  $query1 = "SELECT * FROM `iterasi` WHERE id_jumlah_cluster = ".$id_cluster." ORDER BY id_iterasi DESC LIMIT 1";
  $sql1 = mysqli_query($koneksi, $query1);
  $row1 = mysqli_fetch_row($sql1);

  // select by id terasi terakhir dari tabel yang sesuai dengan jumlah cluster dan datanya dari tabel covid dangan nama dari tabel marker
  $query2 = "SELECT * FROM `cluster_3` as cluster LEFT JOIN covid ON cluster.id_covid = covid.id_covid LEFT JOIN marker ON covid.id_marker = marker.id_marker WHERE cluster.id_iterasi = ".$row1[0]." ORDER BY cluster.`Hasil` ASC";
  $sql2 = mysqli_query($koneksi, $query2);
  $row2 = mysqli_fetch_all($sql2);

  ?>
  <script src="js/jquery.min.js"></script>
  <script>
    $('#jlm_cluster').on('change', function() {
      var id = $(this).children(":selected").val();
      window.location.href = 'http://localhost/Skripsi_nadila/?id_cluster=' + id;
    });
  </script>
  <script>
    mapboxgl.accessToken = 'pk.eyJ1IjoibmFkaWxhb2t0diIsImEiOiJjbDlxZHRqNHIwNHBkM3VxbDJ2dnpwdjc2In0.SF-4dZs0-xYNFB4Olyd0Zg';

    var geojson = {
      'type': 'FeatureCollection',
      'features': [
        <?php
        foreach ($row2 as $value) {
          $kasus = $value[9] + $value[10] + $value[11];
          echo '{
          "type": "Feature",
          "geometry": {
            "type": "Point",
            "coordinates": [' . $value[15] . ',' . $value[14] . ']
          },
          "properties": {
            "Kecamatan": "' . $value[13] . '",
            "title": "' . $value[13] . '",
            "description": "' . $value[13] . '",
            "id_marker": "' . $value[12] . '",
            "jumlah kasus": "' . $kasus . '",
            "positif": "' . $value[9] . '",
            "sembuh": "' . $value[10] . '",
            "meninggal": "' . $value[11] . '",
            "cluster": "' . $value[6] . '",
          }
        },';
        }
        ?>
      ]
    };

    var map = new mapboxgl.Map({
      container: 'map',
      style: 'mapbox://styles/mapbox/streets-v11',
      center: [117.15701868520085, -0.49605329132571574, ],
      zoom: 7
    });

    // add markers to map
    // geojson.features.forEach(function(marker) {
    //   // create a HTML element for each feature
    //   var el = document.createElement('div');
    //   el.className = 'marker';
    //   var id_marker = '</p><a href="http://localhost/skripsi/pages/data_iterasi.php?cluster=3&iterasi=1&id_marker=' + marker.properties.id_marker

    //   // make a marker for each feature and add it to the map
    //   new mapboxgl.Marker(el)
    //     .setLngLat(marker.geometry.coordinates)
    //     .setPopup(
    //       new mapboxgl.Popup({
    //         offset: 25
    //       }) // add popups
    //       .setHTML(
    //         ' <h6>' +
    //         marker.properties.title +
    //         '</h6><p>' +
    //         marker.properties.description +
    //         id_marker + '">Detail</a></td>'
    //       )
    //     )
    //     .addTo(map);
    // });

    map.on('load', function() {
      // Add a GeoJSON source containing place coordinates and information.
      map.addSource('clusters', {
        'type': 'geojson',
        'data': geojson
      });

      map.addLayer({
        id: 'cluster-1',
        type: 'circle',
        source: 'clusters',
        filter: ['==', ['get', 'cluster'], '1'],
        paint: {
          'circle-color': 'red',
          'circle-radius': 6,
          'circle-opacity': 0.8
        }
      });

      map.addLayer({
        id: 'cluster-2',
        type: 'circle',
        source: 'clusters',
        filter: ['==', ['get', 'cluster'], '2'],
        paint: {
          'circle-color': 'green',
          'circle-radius': 6,
          'circle-opacity': 0.8
        }
      });

      map.addLayer({
        id: 'cluster-3',
        type: 'circle',
        source: 'clusters',
        filter: ['==', ['get', 'cluster'], '3'],
        paint: {
          'circle-color': 'blue',
          'circle-radius': 6,
          'circle-opacity': 0.8
        }
      });
      map.addLayer({
        id: 'cluster-4',
        type: 'circle',
        source: 'clusters',
        filter: ['==', ['get', 'cluster'], '4'],
        paint: {
          'circle-color': 'yellow',
          'circle-radius': 6,
          'circle-opacity': 0.8
        }
      });
      map.addLayer({
        id: 'cluster-5',
        type: 'circle',
        source: 'clusters',
        filter: ['==', ['get', 'cluster'], '5'],
        paint: {
          'circle-color': 'purple',
          'circle-radius': 6,
          'circle-opacity': 0.8
        }
      });



    });
  </script>
</body>