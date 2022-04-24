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
  if ($_POST[n_math] !='' AND $_POST[n_ind] !='' AND $_POST[n_eng] !='' AND $_POST[pre_akd] !='' AND $_POST[pre_nonakd] !=''){
	//Update nilai siswa bila ada perubahan
  	mysql_query("UPDATE nilai_siswa SET n_math = '$_POST[n_math]', n_ind = '$_POST[n_ind]', n_eng = '$_POST[n_eng]'
	, pre_akd = '$_POST[pre_akd]', pre_nonakd = '$_POST[pre_nonakd]'
	WHERE username = '$_POST[id]'");
  	
	//HITUNG SKOR AKHIR tabel hasil
	// 1. Hitung bobot akhir kriteria -> bobot kriteria * bobot sub kriteria
	
	$b_math = 
	$b_ind = 
	$b_eng =
	$b_preakd =
	$b_prenonakd = 
  	header('location:../../indexs.php?modul='.$modul);
  }
  else{
  	echo "
  		<script>
		alert('! Maaf Seluruh Field Harus Diisi')
		location = '../../indexs.php?modul=siswa&act=edit&id=$_POST[id]';
		</script>
	";
  }
}
?>
