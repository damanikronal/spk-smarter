<?php
$aksi="modul_admin/mod_subkriteria/aksi_subkriteria.php";
switch($_GET[act]){
  // Tampil subkriteria
  default:
    echo "<h2>Manajemen Data subkriteria Penilaian</h2>
		<form method=POST action='?modul=subkriteria&act=tambah'>";
	$edit3=mysql_query("SELECT * FROM kriteria ORDER BY id_kriteria ASC");
	$jum=mysql_num_rows($edit3);
	if ($jum>=1){
		echo "<tr><td>kriteria</td><td> : <select name='id_kriteria'>";
		while ($r3=mysql_fetch_array($edit3)){
			echo "<option value='$r3[id_kriteria]'>$r3[nama_kriteria]</option>";
		}
		echo "</select>";
		echo "&nbsp;<input type=submit value='Tambah subkriteria'>";
	echo "	
		</form>
          <table>
          <tr><th>id</th><th>subkriteria</th><th>prioritas</th><th>kriteria</th><th>aksi</th></tr>"; 
	// Paging
  	$hal = $_GET[hal];
	if(!isset($_GET['hal'])){ 
		$page = 1; 
		$hal = 1;
	} else { 
		$page = $_GET['hal']; 
	}
	$jmlperhalaman = 12;  // jumlah record per halaman
	$offset = (($page * $jmlperhalaman) - $jmlperhalaman);
    $tampil=mysql_query("SELECT s.id_subkriteria,s.nm_subkriteria,a.nama_kriteria,s.id_kriteria,s.prioritas_s
	FROM subkriteria s,kriteria a 
	WHERE s.id_kriteria=a.id_kriteria
	ORDER BY s.id_kriteria,s.id_subkriteria ASC LIMIT $offset, $jmlperhalaman");
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$r[id_subkriteria]</td>
             <td>$r[nm_subkriteria]</td>
			 <td>$r[prioritas_s]</td>
			 <td>$r[nama_kriteria]</td>
             <td><a href=?modul=subkriteria&act=edit&id=$r[id_subkriteria]&kriteria=$r[id_kriteria]>Edit</a> |"; 
	               ?>
	
				<a href="modul_admin/mod_subkriteria/aksi_subkriteria.php?modul=subkriteria&act=hapus&id=<?php echo "$r[id_subkriteria]"; ?>&kriteria=<?php echo "$r[id_kriteria]"; ?>" target="_self" 
						 onClick="return confirm('Apakah Anda yakin menghapus data ini ?' +  '\n' 
												+ ' <?php echo "- Kode subkriteria  = $r[id_subkriteria]"; ?> ' +  '\n' 
												+ ' <?php echo "- subkriteria = $r[nm_subkriteria]"; ?> ' +  '\n \n'
											+ ' Jika YA silahkan klik OK, Jika TIDAK klik BATAL.')">Hapus</a></td>
<?php
	   echo "</td></tr>";
    }
    echo "</table>";
	// membuat nomor halaman
	$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM subkriteria"),0);
	$total_halaman = ceil($total_record / $jmlperhalaman);
	echo "<center>Halaman :<br/>"; 
	$perhal=4;
	if($hal > 1){ 
		$prev = ($page - 1); 
		echo "<a href=indexs.php?modul=subkriteria&hal=$prev> << </a> "; 
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
				echo "<a href=indexs.php?modul=subkriteria&hal=$i>$i</a> "; 
		}
		} 
	}
	if($hal < $total_halaman){ 
		$next = ($page + 1); 
		echo "<a href=indexs.php?modul=subkriteria&hal=$next>>></a>"; 
	} 
	echo "</center><br/>";
	}
	else { echo "Belum ada kriteria. Buat kriteria dahulu"; }
    break;
  
  // Form Tambah subkriteria
  case "tambah":
	include "config/otomasi.php";
		echo "<h2>Tambah subkriteria</h2>
			  <form method=POST action='$aksi?modul=subkriteria&act=input'>
			  <table>";
		echo "<tr><td>Id</td><td> : <input readonly type=text name='id_subkriteria' value='$val_otoscri'></td></tr>";
		echo "<tr><td>subkriteria</td><td> : <input type=text name='nm_subkriteria'></td></tr>";
		echo "<tr><td>Prioritas</td><td> : <input type=text name='prioritas_s'></td></tr>";
		echo " 
			  <tr><td colspan=2><input type=submit name=submit value=Simpan>
								<input type=button value=Batal onclick=self.history.back()>
								<input type=hidden name='id_kriteria' value='$_POST[id_kriteria]'></td></tr>
			  </table></form>";
     break;
  
  // Form Edit subkriteria  
  case "edit":
    $edit=mysql_query("SELECT s.id_subkriteria,s.nm_subkriteria,s.prioritas_s,a.nama_kriteria,s.id_subkriteria ,s.id_kriteria
	FROM subkriteria s,kriteria a
	WHERE s.id_subkriteria='$_GET[id]' AND s.id_kriteria='$_GET[kriteria]' AND s.id_kriteria=a.id_kriteria");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit subkriteria</h2>
          <form method=POST action=$aksi?modul=subkriteria&act=update>
          <input type=hidden name=id value='$r[id_subkriteria]'>
          <table>
          <tr><td>Id</td><td> : <input type=text readonly name='id_subkriteria' value='$r[id_subkriteria]'></td></tr>
		  <tr><td>subkriteria</td><td> : <input type=text name='nm_subkriteria' value='$r[nm_subkriteria]'></td></tr>";
	echo "<tr><td>Prioritas</td><td> : <input readonly='readonly' type=text name='prioritas_s' value='$r[prioritas_s]'></td></tr>";
	$edit2=mysql_query("SELECT * FROM kriteria ORDER BY id_kriteria ASC");
	echo "<tr><td>kriteria</td><td> : <select name='id_kriteria'>";
			while ($r2=mysql_fetch_array($edit2)){
				if ($r2[id_kriteria]==$r[id_kriteria]){
					echo "<option value='$r2[id_kriteria]' selected>$r2[nama_kriteria]</option>";
				}
			}
	echo "</select></td></tr>";
	echo "<tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
?>

