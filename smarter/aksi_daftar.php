<?php
include "config/koneksi.php";

$id_siswa = $_POST[id_siswa];
$nm_siswa = $_POST[nm_siswa];
$sekolah_asal = $_POST[sekolah_asal];
$username = $_POST[username];
$password = md5($_POST[password]);
$level = 'user';
$jlhkriteria=$_POST[jlhkriteria];

// INPUT TABEL SISWA
	mysql_query("INSERT INTO siswa(id_siswa, username, nm_siswa, sekolah_asal) 
	VALUES('$id_siswa', '$username', '$nm_siswa', '$sekolah_asal')");
	
	// INPUT TABEL PENGGUNA
	mysql_query("INSERT INTO pengguna(username, password, level) 
	VALUES('$username', '$password', '$level')");
	

for($i=1;$i<=$jlhkriteria;$i++){
	$s_awal = mysql_result(mysql_query("SELECT MIN(id_subkriteria) as Num FROM subkriteria WHERE id_kriteria='$i'"),0); // indeks awal sub kriteria
	$s_akhir = mysql_result(mysql_query("SELECT MAX(id_subkriteria) as Num FROM subkriteria WHERE id_kriteria='$i'"),0); // indeks akhir sub kriteria
	for($j=$s_awal;$j<=$s_akhir;$j++){
		$nilai = $_POST['nilai'.$i.$j];
		mysql_query("INSERT INTO nilai_siswa(username, n_idk, n_ids, nilai)	VALUES('$username', '$i', '$j', '$nilai')");
	}
}
header('location:index.php');
?>

