<?php
// Otomasi Kode Kriteria
$oto_cri=mysql_query("SELECT id_kriteria FROM kriteria ORDER BY id_kriteria DESC LIMIT 1");
$rows=mysql_num_rows($oto_cri);
if ($rows >= 1) {
	$temcri=mysql_fetch_row($oto_cri);
	$val_otocri = $temcri[0] + 1;
}
else{
	$val_otocri=1;
}

// Otomasi Kode Kriteria
$oto_scri=mysql_query("SELECT id_subkriteria FROM subkriteria ORDER BY id_subkriteria DESC LIMIT 1");
$rowss=mysql_num_rows($oto_scri);
if ($rowss >= 1) {
	$temscri=mysql_fetch_row($oto_scri);
	$val_otoscri = $temscri[0] + 1;
}
else{
	$val_otoscri=1;
}

// Otomasi Kode Siswa
$oto_alt=mysql_query("SELECT id_siswa FROM siswa ORDER BY id_siswa DESC LIMIT 1");
$rowalt=mysql_num_rows($oto_alt);
if ($rowalt >= 1) {
	$temalt=mysql_fetch_row($oto_alt);
	$val_otoalt = $temalt[0] + 1;
}
else{
	$val_otoalt=1;
}
?>