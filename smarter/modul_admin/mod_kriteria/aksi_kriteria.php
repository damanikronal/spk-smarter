<?php
session_start();
include "../../config/koneksi.php";

$modul=$_GET[modul];
$act=$_GET[act];

// Hapus kriteria
if ($modul=='kriteria' AND $act=='hapus'){
  mysql_query("DELETE FROM kriteria WHERE id_kriteria='$_GET[id]'");
  header('location:../../indexs.php?modul='.$modul);
}

// Input kriteria
elseif ($modul=='kriteria' AND $act=='input'){
  mysql_query("INSERT INTO kriteria(id_kriteria, nama_kriteria, prioritas_k)
  VALUES('$_POST[id_kriteria]', '$_POST[nama_kriteria]', '$_POST[prioritas_k]')");
  header('location:../../indexs.php?modul='.$modul);
}

// Update kriteria
elseif ($modul=='kriteria' AND $act=='update'){
  mysql_query("UPDATE kriteria SET id_kriteria = '$_POST[id_kriteria]', nama_kriteria = '$_POST[nama_kriteria]', prioritas_k = '$_POST[prioritas_k]' WHERE id_kriteria = '$_POST[id]'");
  mysql_query("UPDATE bobot_kriteria SET id_kriteria = '$_POST[id_kriteria]' WHERE id_kriteria = '$_POST[id]'");
  header('location:../../indexs.php?modul='.$modul);
}

// Update kriteria
elseif ($modul=='kriteria' AND $act=='roc'){
  $jlhkriteria = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM kriteria"),0); // Jumlah Kriteria
  // BOBOT KRITERIA
	for($i=1;$i<=$jlhkriteria;$i++){
		for($k=$i;$k<=$jlhkriteria;$k++){
			$sql_pri = mysql_query("SELECT prioritas_k FROM kriteria WHERE id_kriteria = '$k' order by id_kriteria ASC");
			$pri = mysql_fetch_row($sql_pri);
			$bobotkr += round((1/$pri[0]),3);
		}
		$bobotk[$i] = round(($bobotkr / $jlhkriteria),3);
		mysql_query("UPDATE kriteria SET bobot_kriteria = '$bobotk[$i]' WHERE id_kriteria = '$i'");
		$bobotkr = 0;
	}
	header('location:../../indexs.php?modul='.$modul);
}
?>
