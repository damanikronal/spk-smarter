<?php
session_start();
include "../../config/koneksi.php";

$modul=$_GET[modul];
$act=$_GET[act];

// Hapus Siswa
if ($modul=='pengguna' AND $act=='hapus'){
  mysql_query("DELETE FROM pengguna WHERE username='$_GET[id]'");
  mysql_query("DELETE FROM siswa WHERE username='$_GET[id]'");
  mysql_query("DELETE FROM nilai_siswa WHERE username='$_GET[id]'");
  header('location:../../indexs.php?modul='.$modul);
}

// Input Siswa
elseif ($modul=='pengguna' AND $act=='input'){
  $pass=md5($_POST[password]);
  mysql_query("INSERT INTO pengguna(
  								 username,
								 password
								 ) 
	                       VALUES(
                                '$_POST[username]',
								'$pass'
								)");
  header('location:../../indexs.php?modul='.$modul);
}

// Update Siswa
elseif ($modul=='pengguna' AND $act=='update'){
  if (empty($_POST[password])) {
     mysql_query("UPDATE pengguna SET level = '$_POST[level]' 
                           WHERE  username       = '$_POST[id]'");
  }
  // Apabila password diubah
  else{
    $pass=md5($_POST[password]);
    mysql_query("UPDATE pengguna SET password = '$pass', level = '$_POST[level]' 
                           WHERE  username       = '$_POST[id]'");
  }
  header('location:../../indexs.php?modul='.$modul);
}
?>

