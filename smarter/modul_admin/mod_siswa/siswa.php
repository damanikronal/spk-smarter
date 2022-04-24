<?php
$aksi="modul_admin/mod_siswa/aksi_siswa.php";
$jlhkriteria = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM kriteria"),0); // Jumlah Kriteria

switch($_GET[act]){
  // Tampil Kriteria
  default:
    echo "<h2>Verifikasi Siswa Baru</h2>
          <table>
          <tr><th>nama siswa</th><th>sekolah asal</th><th>status</th><th>aksi</th></tr>"; 
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
    $tampil=mysql_query("SELECT * FROM siswa ORDER BY id_siswa ASC LIMIT $offset, $jmlperhalaman");
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$r[nm_siswa]</td>
             <td>$r[sekolah_asal]</td>";
		$cek = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM hasil WHERE username='$r[username]'"),0);
		echo "<td>";
		 if($cek>0){ echo "Sudah diverifikasi"; }else{ echo "Belum diverifikasi"; }
		echo "</td>";
       echo "<td><a href=?modul=siswa&act=edit&id=$r[username]>Verifikasi</a> | ";
?>
	   <a href="modul_admin/mod_siswa/aksi_siswa.php?modul=siswa&act=hapus&id=<?php echo "$r[username]"; ?>" target="_self" 
	 onClick="return confirm('Apakah Anda yakin menghapus data ini ?' +  '\n' 
							+ ' <?php echo "- siswa  = $r[nm_siswa]"; ?> ' +  '\n' 
							+ ' <?php echo "- sekolah asal = $r[sekolah_asal]"; ?> ' +  '\n \n' 
						+ ' Jika YA silahkan klik OK, Jika TIDAK klik BATAL.')">Hapus</a></td>            
<?php	   
	   echo "</tr>";
    }
    echo "</table>";
	// membuat nomor halaman
	$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM siswa"),0);
	$total_halaman = ceil($total_record / $jmlperhalaman);
	echo "<center>Halaman :<br/>"; 
	$perhal=4;
	if($hal > 1){ 
		$prev = ($page - 1); 
		echo "<a href=indexs.php?modul=siswa&hal=$prev> << </a> "; 
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
				echo "<a href=indexs.php?modul=siswa&hal=$i>$i</a> "; 
		}
		} 
	}
	if($hal < $total_halaman){ 
		$next = ($page + 1); 
		echo "<a href=indexs.php?modul=siswa&hal=$next>>></a>"; 
	} 
	echo "</center><br/>";
    break;
  
  // Form Tambah Kategori
  case "tambah":
  include "config/otomasi.php";
    echo "<h2>Tambah siswa</h2>
          <form method=POST action='$aksi?modul=siswa&act=input'>
          <table>
          <tr><td>Id siswa</td><td> : <input readonly type=text name='id_siswa' value='$val_otoalt'></td></tr>
		  <tr><td>Nama siswa</td><td> : <input type=text name='nm_siswa'></td></tr>";
	for ($i=1; $i<=$jlhkriteria; $i++){
			$queri2=mysql_query("SELECT * FROM kriteria WHERE id_kriteria='$i' ORDER BY id_kriteria ASC");
			$kriteria2=mysql_fetch_array($queri2);
			echo "<tr>";
			echo "
			<td>
			$kriteria2[nama_kriteria]<input type=hidden name='id_kriteria".$i."' value='$kriteria2[id_kriteria]'>
			</td>
			<td> : <input type=text name='nilai".$i."'></td>
				 ";
			echo "</tr>";
	}
	echo "<tr><td colspan=2><input type=submit name=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit Kategori  
  case "edit":
    $edit=mysql_query("SELECT * FROM siswa s, nilai_siswa n WHERE s.username='$_GET[id]' AND s.username=n.username");
    $r=mysql_fetch_array($edit);
    echo "<h2>Verifikasi siswa</h2>
          <form method=POST action=$aksi?modul=siswa&act=update>
          <input type=hidden name=id value='$r[username]'><input type=hidden name='id_siswa' value='$r[id_siswa]'>
          <table>
		  <tr><td>Nama siswa</td><td> : <input readonly=readonly type=text name='nm_siswa' value='$r[nm_siswa]'></td></tr>
		  <tr><td>Sekolah asal</td><td> : <input readonly=readonly type=text name='sekolah_asal' value='$r[sekolah_asal]'></td></tr>
		  ";
	$num_k = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM kriteria"),0); // Jumlah Kriteria
	for($i=1;$i<=$num_k;$i++){
		$s_awal = mysql_result(mysql_query("SELECT MIN(id_subkriteria) as Num FROM subkriteria WHERE id_kriteria='$i'"),0); // indeks awal sub kriteria
		$s_akhir = mysql_result(mysql_query("SELECT MAX(id_subkriteria) as Num FROM subkriteria WHERE id_kriteria='$i'"),0); // indeks akhir sub kriteria
		for($j=$s_awal;$j<=$s_akhir;$j++){
			$s_k = mysql_query("SELECT s.nm_subkriteria, n.nilai FROM subkriteria s, nilai_siswa n
			WHERE s.id_kriteria='$i' AND s.id_subkriteria='$j' AND s.id_kriteria=n.n_idk AND s.id_subkriteria=n.n_ids ORDER BY s.id_kriteria,s.id_subkriteria ASC");
			$s_r = mysql_fetch_array($s_k);
			echo "  
			  <tr>
				<td>$s_r[nm_subkriteria]</td>
				<td>: <input type='text' name='nilai".$i.$j."' value='$s_r[nilai]'></td>
			  </tr>";
		}
	}
	echo "<tr><td colspan=2><input type=submit value=Verifikasi>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
	
}
?>

