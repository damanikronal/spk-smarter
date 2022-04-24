<?php
session_start();

if (empty($_SESSION[username]) AND empty($_SESSION[passuser])){
  echo "<link href='main.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else{
?>
<?php
include "config/setting.php";
include "config/koneksi.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
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
			<li><a href="?modul=beranda">Home</a></li>
			<?php include "menu.php"; ?>
			<li><a href=?modul=bantuan>Bantuan</a></li>
			  <li><a href=?modul=tentang>Tentang</a></li>
		</ul>
	</div>
	<div id="content-container">
		<div id="content">
			<?php
include "content.php";
?> 
		</div>
		<div id="aside">
			<h3>PROFIL USER </h3><a href=logout.php>Logout</a>
<ul>
  <?php 
  if ($_SESSION[leveluser] == 'admin'){
  	$user = mysql_query("SELECT * FROM pengguna WHERE username = '$_SESSION[namauser]' and level = '$_SESSION[leveluser]'");
	$usr = mysql_fetch_array($user);
	echo "  
	  <li>Username : $usr[username]</li>
	  <li>Level : $usr[level]</li>
	  ";
  }
  elseif ($_SESSION[leveluser] == 'user'){
  	$user = mysql_query("SELECT s.id_siswa,s.nm_siswa,s.sekolah_asal,p.username,p.level 
	FROM siswa s, pengguna p
	WHERE s.username=p.username AND p.username = '$_SESSION[namauser]'");
	$usr = mysql_fetch_array($user);
	echo "  
	  <li>Username : $usr[username]</li>
	  <li>Level : $usr[level]</li>
	  <li>Id : SMARTER-$usr[id_siswa]</li>
	  <li>Nama : $usr[nm_siswa]</li>
	  <li>Sekolah Asal : $usr[sekolah_asal]</li>
	  ";
  }
  ?>
</ul>
		</div>
		<div id="footer">
			<a href="http://kroseva.wordpress.com/"><font color="#FFFFFF"><?php echo "$footer"; ?></font></a>
		</div>
	</div>
</div>
</body>
</html>
<?php
}
?>
