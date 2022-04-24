<?php
include "config/koneksi.php";
include "config/setting.php";
include "config/otomasi.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="style1.css" />
<title><?php echo "$title"; ?></title>
</head>

<body>
<div id="container">
	<div id="header">
		<h1><a href="http://kroseva.wordpress.com"><?php echo "$header"; ?></a></h1>
	</div>
	<div id="navigation">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="?modul=daftar">Registrasi Calon Siswa</a></li>
		</ul>
	</div>
	<div id="content-container">
		<div id="content">
		<?php
		if ($_GET[modul] == 'daftar'){
			include "daftar.php";
		}
		else{?>
			<h2>Definisi Sistem</h2>

<p>Sistem Pendukung Keputusan Penerimaan Siswa Baru adalah sebuah sistem informasi yang dipakai untuk mendukung pengambilan keputusan dalam hal penerimaan siswa baru. 
Adapun sistem ini dibangun menggunakan bahasa pemrograman PHP dan memakai MySQl dalam hal pengolahan database.</p> 

<p>Pemilihan siswa baru dikategorikan sebagai permasalahan Multi Attribut Decision Making (MADM).
Dengan kriteria penilaian yang ditinjau adalah Nilai Akademik (Matematika, Bahasa Indonesia, Bahasa Inggris) dan Prestasi (Akademik dan Non Akademik).
Untuk membantu dalam menentukan pilihan yang tepat, dipakai algoritma 
Simple Multi-Attribute Rating Technique Exploiting Rank (SMARTER).</p>
		<?php }?>
		</div>
		<div id="aside">
			<h3>User Account </h3>
<?php include "login.php"; ?>
		</div>
		<div id="footer">
			<a href="http://kroseva.wordpress.com/"><font color="#FFFFFF"><?php echo "$footer"; ?></font></a>
		</div>
	</div>
</div>
</body>
</html>
