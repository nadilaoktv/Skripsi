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
<!--[ if lt IE 9 ]>
<script src = 'https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js'></script>
<script src = 'https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js'></script>
<![ endif ]-->
</head>
<body>

<div id = 'wrapper'>

<!-- Navigation -->
<nav class = 'navbar navbar-inverse navbar-fixed-top' role = 'navigation'>
<div class = 'navbar-header'>
<a class = 'navbar-brand' href = 'index.php'>Algoritma K-Means</a>
</div>

<button type = 'button' class = 'navbar-toggle' data-toggle = 'collapse' data-target = '.navbar-collapse'>
<span class = 'sr-only'>Toggle navigation</span>
<span class = 'icon-bar'></span>
<span class = 'icon-bar'></span>
<span class = 'icon-bar'></span>
</button>

<ul class = 'nav navbar-right navbar-top-links'>
<li class = 'dropdown'>
<a class = 'dropdown-toggle' data-toggle = 'dropdown' href = '#'>
<i class = 'fa fa-user fa-fw'></i> User <b class = 'caret'></b>
</a>
<ul class = 'dropdown-menu dropdown-user'>
<li><a href = 'login.html'><i class = 'fa fa-sign-out fa-fw'></i> Logout</a>
</li>
</ul>
</li>
</ul>
<!-- /.navbar-top-links -->

<div class = 'navbar-default sidebar' role = 'navigation'>
<div class = 'sidebar-nav navbar-collapse'>
<ul class = 'nav' id = 'side-menu'>
<li class = 'sidebar-search'>
<div class = 'input-group custom-search-form'>
<input type = 'text' class = 'form-control' placeholder = 'Search...'>
<span class = 'input-group-btn'>
<button class = 'btn btn-primary' type = 'button'>
<i class = 'fa fa-search'></i>
</button>
</span>
</div>
<!-- /input-group -->
</li>
<li>
<a href = 'dashboard.php' class = 'active'><i class = 'fa fa-dashboard fa-fw'></i> Dashboard</a>
</li>
<li>
<a href = 'daftar_user.php'><i class = 'fa fa-user' aria-hidden = 'true'></i> Data User</a>
</li>
<li>
<a href = 'data_covid.php'><i class = 'fa fa-map' aria-hidden = 'true'></i> Data Covid-19</a>
</li>
<li>
<a href = 'data_marker.php'><i class = 'fa fa-map' aria-hidden = 'true'></i> Data lokasi</a>
</li>
<li>
<a href = 'data_clusterawal.php'><i class = 'fa fa-area-chart' aria-hidden = 'true'></i> Pusat Cluster Awal</a>
</li>
<li>
<a href = ''><i class = 'fa fa-area-chart' aria-hidden = 'true'></i> Perhitungan</a>
</li>
<li>
<a href = ''><i class = 'fa fa-table' aria-hidden = 'true'></i> Hasil Iterasi</a>
</li>
<li>
<a href = ''><i class = 'fa fa-table' aria-hidden = 'true'></i> Hasil Cluster</a>
</li>
</ul>
</div>
</div>
</nav>

<div id = 'page-wrapper'>
<div class = 'container-fluid'>
<div class = 'row'>
<div class = 'col-lg-12'>
<h1 class = 'page-header'>Dashboard</h1>
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class = 'row'>
<div class = 'col-lg-3 col-md-6'>
<div class = 'panel panel-primary'>
<div class = 'panel-heading'>
<div class = 'row'>
<div class = 'col-xs-3'>
<i class = 'fa fa-users fa-5x'></i>
</div>
<div class = 'col-xs-9 text-right'>
<?php
$query = 'SELECT COUNT( * ) FROM tb_user';
$sql = mysqli_query( $koneksi, $query );
$row = mysqli_fetch_array( $sql );

?>
<div class = 'huge'><?php echo $row[ 0 ];
?></div>
<div>Jumlah User</div>
</div>
</div>
</div>
<a href = 'daftar_user.php'>
<div class = 'panel-footer'>
<span class = 'pull-left'>View Details</span>
<span class = 'pull-right'><i class = 'fa fa-arrow-circle-right'></i></span>

<div class = 'clearfix'></div>
</div>
</a>
</div>
</div>

<div class = 'col-lg-3 col-md-6'>
<div class = 'panel panel-red'>
<div class = 'panel-heading'>
<div class = 'row'>
<div class = 'col-xs-3'>
<i class = 'fa fa-tasks fa-5x'></i>
</div>
<div class = 'col-xs-9 text-right'>
<?php
$query = 'SELECT COUNT( * ) FROM covid';
$sql = mysqli_query( $koneksi, $query );
$row = mysqli_fetch_array( $sql );

?>
<div class = 'huge'><?php echo $row[ 0 ];
?></div>
<div>Jumlah Data Covid</div>
</div>
</div>
</div>
<a href = 'data_covid.php'>
<div class = 'panel-footer'>
<span class = 'pull-left'>View Details</span>
<span class = 'pull-right'><i class = 'fa fa-arrow-circle-right'></i></span>

<div class = 'clearfix'></div>
</div>
</a>
</div>
</div>

<div class = 'col-lg-3 col-md-6'>
<div class = 'panel panel-yellow'>
<div class = 'panel-heading'>
<div class = 'row'>
<div class = 'col-xs-3'>
<i class = 'fa fa-tasks fa-5x'></i>
</div>
<div class = 'col-xs-9 text-right'>
<?php
$query = 'SELECT COUNT( * ) FROM marker';
$sql = mysqli_query( $koneksi, $query );
$row = mysqli_fetch_array( $sql );

?>
<div class = 'huge'><?php echo $row[ 0 ];
?></div>
<div>Jumlah Data Lokasi</div>
</div>
</div>
</div>
<a href = 'data_marker.php'>
<div class = 'panel-footer'>
<span class = 'pull-left'>View Details</span>
<span class = 'pull-right'><i class = 'fa fa-arrow-circle-right'></i></span>

<div class = 'clearfix'></div>
</div>
</a>
</div>
</div>

<div class = 'col-lg-3 col-md-6'>
<div class = 'panel panel-green'>
<div class = 'panel-heading'>
<div class = 'row'>
<div class = 'col-xs-3'>
<i class = 'fa fa-tasks fa-5x'></i>
</div>
<div class = 'col-xs-9 text-right'>
<?php
$query = 'SELECT COUNT( * ) FROM cluster';
$sql = mysqli_query( $koneksi, $query );
$row = mysqli_fetch_array( $sql );

?>
<div class = 'huge'><?php echo $row[ 0 ];
?></div>
<div>3 Iterasi</div>
</div>
</div>
</div>
<a href = 'data_clusterawal.php'>
<div class = 'panel-footer'>
<span class = 'pull-left'>View Details</span>
<span class = 'pull-right'><i class = 'fa fa-arrow-circle-right'></i></span>

<div class = 'clearfix'></div>
</div>
</a>
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
<script src = '../js/jquery.min.js'></script>

<!-- Bootstrap Core JavaScript -->
<script src = '../js/bootstrap.min.js'></script>

<!-- Metis Menu Plugin JavaScript -->
<script src = '../js/metisMenu.min.js'></script>

<!-- Morris Charts JavaScript -->
<script src = '../js/raphael.min.js'></script>
<script src = '../js/morris.min.js'></script>
<script src = '../js/morris-data.js'></script>

<!-- Custom Theme JavaScript -->
<script src = '../js/startmin.js'></script>

</body>
</html>
