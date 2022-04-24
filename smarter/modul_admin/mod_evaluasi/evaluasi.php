<?php
	
	// Laporan
	echo "<h2>Hasil Evaluasi Penerimaan Siswa Baru </h2>";
    echo "<table>
          <tr><th>id siswa</th><th>nama</th><th>sekolah asal</th><th>nilai</th></tr>"; 
	// Paging
  	$hal = $_GET[hal];
	if(!isset($_GET['hal'])){ 
		$page = 1; 
		$hal = 1;
	} else { 
		$page = $_GET['hal']; 
	}
	$jmlperhalaman = 10;  // jumlah record per halaman
	$offset = (($page * $jmlperhalaman) - $jmlperhalaman);
	$querialt=mysql_query("SELECT s.id_siswa,s.nm_siswa,s.sekolah_asal,h.bobot_hasil 
	FROM siswa s, hasil h
	WHERE h.username=s.username ORDER BY h.bobot_hasil DESC LIMIT $offset, $jmlperhalaman");
    while ($alth=mysql_fetch_array($querialt)){
		echo "<tr>
		<td>$idsiswa-$alth[id_siswa]</td>
		<td>$alth[nm_siswa]</td>
		<td>$alth[sekolah_asal]</td>
		<td>$alth[bobot_hasil]</td>
		</tr>";
	}
    echo "</table>";
	
// membuat nomor halaman
	$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM hasil"),0);
	$total_halaman = ceil($total_record / $jmlperhalaman);
	echo "<center>Halaman :<br/>"; 
	$perhal=4;
	if($hal > 1){ 
		$prev = ($page - 1); 
		echo "<a href=indexs.php?modul=evaluasi&hal=$prev> << </a> "; 
	}
	if($total_halaman<=10){
	$hal1=1;
	$hal2=$total_halaman;
	}else{
	$hal1=$hal-$perhal;
	$hal2=$hal+$perhal;
	}
	if($hal<=5){
	$hal1=1;
	}
	if($hal<$total_halaman){
	$hal2=$hal+$perhal;
	}else{
	$hal2=$hal;
	}
	for($i = $hal1; $i <= $hal2; $i++){ 
		if(($hal) == $i){ 
			echo "[<b>$i</b>] "; 
			} else { 
		if($i<=$total_halaman){
				echo "<a href=indexs.php?modul=evaluasi&hal=$i>$i</a> "; 
		}
		} 
	}
	if($hal < $total_halaman){ 
		$next = ($page + 1); 
		echo "<a href=indexs.php?modul=evaluasi&hal=$next>>></a>"; 
	} 
	echo "</center><br/>";
		  ?> 
		  
	<?php
	echo "<h2>Cetak Hasil Keputusan</h2>
          <form method='POST' action='config/cetak.php'>
          <table>
		  ";
	echo "
		  <tr><td colspan=2><input type=submit name=submit value=Cetak></td></tr>
          </table></form>"; 

?>
