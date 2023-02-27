<?php
include "koneksi.php";
$username = $_POST['username'];
$pass1 = md5($_POST['password']);
$pass2 = md5($_POST['repass']);


if($pass2==$pass1){
$sql="INSERT INTO tb_user(username,password) VALUES('".$username."','".$pass1."')";
$a=$koneksi->query($sql);
if($a==true){
echo "<script>alert('Anda berhasil registrasi');history.go(-1);</script>";
}else{
	echo "<script>alert('Anda gagal registrasi');history.go(-1);</script>";
}
}else {
	echo "<script>alert('Password yang anda ulangi salah');history.go(-1);</script>";
}