<?php
$aksi="modul_admin/mod_bobot/aksi_matrik.php";
switch($_GET[act]){
  // Tampil Matrik Perbandingan Kriteria
  default:
  	$tampil1=mysql_query("SELECT SUM(bobot_kriteria) AS bobot FROM kriteria ORDER BY id_kriteria");
	$r1=mysql_fetch_array($tampil1);
	if ($r1[bobot] == 1){
    	echo "<h2>Bobot Kriteria</h2>";
		echo "
			<table>
          <tr><th>kriteria</th><th>bobot</th><th>sub kriteria</th></tr>"; 
		$tampil2=mysql_query("SELECT k.nama_kriteria, k.bobot_kriteria, k.id_kriteria
		 FROM kriteria k
		 ORDER BY k.id_kriteria");
		while ($r2=mysql_fetch_array($tampil2)){
		   echo "<tr>
		   		<td>$r2[nama_kriteria]</td>
				 <td>$r2[bobot_kriteria]</td>";
			$tampil3=mysql_query("SELECT SUM(bobot_subkriteria) AS bobot FROM subkriteria WHERE id_kriteria = '$r2[id_kriteria]' ORDER BY id_kriteria,id_subkriteria ASC");
			$r3=mysql_fetch_array($tampil3);
			if ($r3[bobot] == 1){
				echo "<td>Status : Bobot ROC sub kriteria ($r2[nama_kriteria]) sudah ada</td>";
			}else{
				echo "<td>Status : Bobot ROC sub kriteria ($r2[nama_kriteria]) belum ada. <a href='$aksi?modul=bobot&act=roc&id=$r2[id_kriteria]'>Generate Bobot ROC</a></td>";
			}
		   echo "</tr>";
		}
		echo "</table>";
	}
	else{
		echo "<h2>Bobot Kriteria</h2>";
		echo "Belum dilakukan normalisasi bobot kriteria. 
		<br><a href=?modul=kriteria&act=roc>Generate Bobot ROC untuk Kriteria</a>";
	}
	// BOBOT SUB KRITERIA
	echo "<h2>Bobot Sub Kriteria</h2>";
	echo "
		<table>
          <tr><th>kriteria</th><th>sub kriteria</th><th>bobot</th></tr>"; 
		$tampil4=mysql_query("SELECT k.nama_kriteria, k.bobot_kriteria, k.id_kriteria, s.id_kriteria, s.nm_subkriteria,s.bobot_subkriteria
		 FROM kriteria k, subkriteria s
		 WHERE k.id_kriteria=s.id_kriteria
		 ORDER BY k.id_kriteria,s.id_subkriteria ASC");
	while ($r4=mysql_fetch_array($tampil4)){
	   echo "<tr>
	   		<td>$r4[nama_kriteria]</td>
			<td>$r4[nm_subkriteria]</td>
			<td>$r4[bobot_subkriteria]</td>
			";
	   echo "</tr>";
	}
	echo "</table>";
    break;
  
  // Matrik Perbandingan
  case "normalisasi":
    echo "<h2>Normalisasi Bobot Kriteria</h2>";
    echo "<form method='post' action='$aksi?modul=bobot&act=normalisasi'>
		  <table>
          <tr><th>kriteria</th><th>nilai (bobot kriteria)</th></tr>"; 
    $jlhkriteria = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM kriteria"),0); // Jumlah Kriteria
	for ($i=1; $i<=$jlhkriteria; $i++){
		$queri2=mysql_query("SELECT * FROM kriteria WHERE id_kriteria='$i' ORDER BY id_kriteria ASC");
		$kriteria2=mysql_fetch_array($queri2);
		echo "<tr>";
		echo "
			<td>$kriteria2[nama_kriteria]<input type=hidden name='id_kriteria".$i."' value='$kriteria2[id_kriteria]'>
			<input type=hidden name='nama_kriteria".$i."' value='$kriteria2[nama_kriteria]'></td>
			<td><input type=text name='bobot".$i."'></td>
		";
		echo "</tr>";
	}
    echo "</table>
	<input type='submit' name='Submit' value='Submit'><input type=button value=Batal onclick=self.history.back()></form>";
	break;
}
?>