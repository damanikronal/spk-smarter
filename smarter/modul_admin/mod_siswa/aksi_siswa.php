<?php
session_start();
include "../../config/koneksi.php";

$modul=$_GET[modul];
$act=$_GET[act];
$jlhkriteria = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM kriteria"),0); // Jumlah Kriteria

// Hapus section
if ($modul=='siswa' AND $act=='hapus'){
  mysql_query("DELETE FROM siswa WHERE username='$_GET[id]'");
  mysql_query("DELETE FROM hasil WHERE username='$_GET[id]'");
  mysql_query("DELETE FROM pengguna WHERE username='$_GET[id]'");
  mysql_query("DELETE FROM nilai_siswa WHERE username='$_GET[id]'");
  header('location:../../indexs.php?modul='.$modul);
}

// Update kriteria
elseif ($modul=='siswa' AND $act=='update'){
	//Update nilai siswa bila ada perubahan
  	for($i=1;$i<=$jlhkriteria;$i++){
		$s_awal = mysql_result(mysql_query("SELECT MIN(id_subkriteria) as Num FROM subkriteria WHERE id_kriteria='$i'"),0); // indeks awal sub kriteria
		$s_akhir = mysql_result(mysql_query("SELECT MAX(id_subkriteria) as Num FROM subkriteria WHERE id_kriteria='$i'"),0); // indeks akhir sub kriteria
		for($j=$s_awal;$j<=$s_akhir;$j++){
			$nilai = $_POST['nilai'.$i.$j];
			mysql_query("INSERT INTO nilai_siswa(username, n_idk, n_ids, nilai)	VALUES('$username', '$i', '$j', '$nilai')");
		}
	}
	//Input nilai siswa dikali bobot roc
	mysql_query("DELETE FROM hasil WHERE username='$_POST[id]'");
	for($i=1;$i<=$jlhkriteria;$i++){
		$s_awal = mysql_result(mysql_query("SELECT MIN(id_subkriteria) as Num FROM subkriteria WHERE id_kriteria='$i'"),0); // indeks awal sub kriteria
		$s_akhir = mysql_result(mysql_query("SELECT MAX(id_subkriteria) as Num FROM subkriteria WHERE id_kriteria='$i'"),0); // indeks akhir sub kriteria
		for($j=$s_awal;$j<=$s_akhir;$j++){
			$s_k = mysql_query("SELECT SUM( n.nilai * ( s.bobot_subkriteria * k.bobot_kriteria ) ) AS nilai
			FROM subkriteria s, nilai_siswa n, kriteria k
			WHERE s.id_kriteria='$i' AND s.id_subkriteria='$j' AND s.id_kriteria=n.n_idk AND s.id_subkriteria=n.n_ids AND s.id_kriteria=k.id_kriteria
			AND n.username = '$_POST[id]'
			ORDER BY s.id_kriteria,s.id_subkriteria ASC");
			$s_r = mysql_fetch_array($s_k);
			$tot += $s_r[nilai];
		}
		
	}
	mysql_query("INSERT INTO hasil(username, bobot_hasil)	VALUES('$_POST[id]', '$tot')");
  	header('location:../../indexs.php?modul='.$modul);
  
}
?>
