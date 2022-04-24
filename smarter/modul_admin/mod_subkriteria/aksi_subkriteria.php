<?php
session_start();
include "../../config/koneksi.php";

$modul=$_GET[modul];
$act=$_GET[act];

// Hapus subkriteria
if ($modul=='subkriteria' AND $act=='hapus'){
  mysql_query("DELETE FROM subkriteria WHERE id_subkriteria='$_GET[id]' AND id_kriteria='$_GET[kriteria]'");
  header('location:../../indexs.php?modul='.$modul);
}

// Input subkriteria
elseif ($modul=='subkriteria' AND $act=='input'){
  mysql_query("INSERT INTO subkriteria(id_subkriteria, nm_subkriteria, prioritas_s,id_kriteria) VALUES('$_POST[id_subkriteria]', '$_POST[nm_subkriteria]', '$_POST[prioritas_s]','$_POST[id_kriteria]')");
  header('location:../../indexs.php?modul='.$modul);
}

// Update subkriteria
elseif ($modul=='subkriteria' AND $act=='update'){
  mysql_query("UPDATE subkriteria SET id_subkriteria = '$_POST[id_subkriteria]', 
  nm_subkriteria = '$_POST[nm_subkriteria]', prioritas_s = '$_POST[prioritas_s]', 
  id_kriteria = '$_POST[id_kriteria]' WHERE id_subkriteria = '$_POST[id]' AND id_kriteria='$_POST[id_kriteria]'");
  header('location:../../indexs.php?modul='.$modul);
}
?>
