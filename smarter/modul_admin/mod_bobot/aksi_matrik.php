<?php
session_start();
include "../../config/koneksi.php";

$modul=$_GET[modul];
$id=$_GET[id];
$act=$_GET[act];
$jlhkriteria = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM kriteria"),0); // Jumlah Kriteria

// Hitung bobot dengan ROC
if ($modul=='bobot' AND $act=='roc'){
$jlhsubkriteria = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM subkriteria WHERE id_kriteria='$id'"),0); // Jumlah Sub Kriteria
$kecil = mysql_result(mysql_query("SELECT MIN(id_subkriteria) as kecil FROM subkriteria WHERE id_kriteria='$id'"),0); // id terkecil Sub Kriteria
$besar = mysql_result(mysql_query("SELECT MAX(id_subkriteria) as besar FROM subkriteria WHERE id_kriteria='$id'"),0); // id terbesar Sub Kriteria

	// BOBOT SUBKRITERIA
	for($i=$kecil;$i<=$besar;$i++){
		for($k=$i;$k<=$besar;$k++){
			$sql_pris = mysql_query("SELECT s.prioritas_s,s.id_subkriteria,s.id_kriteria,k.bobot_kriteria FROM subkriteria s,kriteria k
			WHERE id_subkriteria = '$k' AND k.id_kriteria = '$id' AND s.id_kriteria = k.id_kriteria order by s.id_kriteria, s.id_subkriteria ASC");
			$pris = mysql_fetch_row($sql_pris);
			$bobotskr += round((1/$pris[0]),3);
		}
		$bobotsk[$i] = round(($bobotskr / $jlhsubkriteria),3);
		$bobotskr = 0;
		mysql_query("UPDATE subkriteria SET bobot_subkriteria = '$bobotsk[$i]' WHERE id_subkriteria = '$i' AND id_kriteria = '$id'");
	}
	
  header('location:../../indexs.php?modul='.$modul);
}
elseif ($modul=='bobot' AND $act=='hitungulang'){
  mysql_query("DELETE FROM bobot_kriteria");
  header('location:../../indexs.php?modul='.$modul);
}

?>

