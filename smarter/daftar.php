<form action="aksi_daftar.php" method="post">
<h3>Registrasi Calon Siswa Baru</h3>
<table width="424" border="1">
  <tr>
    <td colspan="3"><strong>Data Siswa </strong></td>
    </tr>
  <tr>
    <td>Id Siswa </td>
    <td>:</td>
    <td><?php echo "$idsiswa-$val_otoalt";?><input type="hidden" name="id_siswa" size="3" maxlength="3" value="<?php echo $val_otoalt ?>"></td>
  </tr>
  <tr>
    <td>Nama Siswa </td>
    <td>:</td>
    <td><input type="text" name="nm_siswa"></td>
  </tr>
  <tr>
    <td>Sekolah Asal </td>
    <td>:</td>
    <td><input type="text" name="sekolah_asal"></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="3"><strong>Data User </strong></td>
    </tr>
  <tr>
    <td>Username</td>
    <td>:</td>
    <td><input type="text" name="username" maxlength="10">
      <em>max length 10 char </em></td>
  </tr>
  <tr>
    <td>Password</td>
    <td>&nbsp;</td>
    <td><input type="password" name="password" maxlength="6">
      <em>max length 6 char </em></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="3"><strong>PENILAIAN</strong></td>
    </tr>
	<?php
	$num_k = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM kriteria"),0); // Jumlah Kriteria
	for($i=1;$i<=$num_k;$i++){
		$s_awal = mysql_result(mysql_query("SELECT MIN(id_subkriteria) as Num FROM subkriteria WHERE id_kriteria='$i'"),0); // indeks awal sub kriteria
		$s_akhir = mysql_result(mysql_query("SELECT MAX(id_subkriteria) as Num FROM subkriteria WHERE id_kriteria='$i'"),0); // indeks akhir sub kriteria
		for($j=$s_awal;$j<=$s_akhir;$j++){
			$s_k = mysql_query("SELECT * FROM subkriteria WHERE id_kriteria='$i' AND id_subkriteria='$j' ORDER BY id_kriteria,id_subkriteria ASC");
			$s_r = mysql_fetch_array($s_k);
			echo "  
			  <tr>
				<td>$s_r[nm_subkriteria]</td>
				<td>:</td>
				<td><input type='text' name='nilai".$i.$j."'></td>
			  </tr>";
		}
	}
	?>
  
  <tr>
    <td colspan="3"><input type="submit" name="Submit" value="Submit"><input type='hidden' name='jlhkriteria' value='<?php echo $num_k ?>'>
      <input type="reset" name="Reset" value="Reset"></td>
    </tr>
</table>
</form>