<?php
include "setting.php";
include "koneksi.php";
require("fpdf.php");

	//Variabel untuk iterasi
$i = 0;
$querialt=mysql_query("SELECT s.id_siswa,s.nm_siswa,s.sekolah_asal,h.bobot_hasil 
	FROM siswa s, hasil h
	WHERE h.username=s.username ORDER BY h.bobot_hasil DESC");
while ($data=mysql_fetch_row($querialt)){
	$id = "$idsiswa-$data[0]";
	$cell[$i][0] = $id;
	$cell[$i][1] = $data[1];
	$cell[$i][2] = $data[2];
	$cell[$i][3] = $data[3];
	$i++;
}
//memulai pengaturan output PDF
class PDF extends FPDF
{
//untuk pengaturan header halaman
function Header()
{
//Pengaturan Font Header
$this->SetFont('Times','B',12); //jenis font : Times New Romans, Bold, ukuran 12

//Logo
$this->Image('img/head.png',2,1,26);

//untuk warna background Header
$this->SetFillColor(255,255,255);

//untuk warna text
$this->SetTextColor(0,0,0);
	
//Menampilkan tulisan di halaman
//$this->Cell(10,1,'Laporan Penerimaan Siswa Baru','0',0,'C'); //TBLR (untuk garis)=> B = Bottom,
// L = Left, R = Right
//untuk garis, C = center
}
}

//pengaturan ukuran kertas P = Portrait
$pdf = new PDF('L','cm','A4');
$pdf->SetMargins(2,2,1.5,1.5); //membuat margin (kiri,atas,kanan)
$pdf->Open();
$pdf->AddPage();

//Ln() = untuk pindah baris
$pdf->Ln(3);
$pdf->Cell(7.6,1,'Penerimaan Siswa Baru SMA Smarter',0,0,'L');
$pdf->Ln(0.5);
$pdf->Cell(8.5,1,$total,0,0,'L');
$pdf->Ln(1.5);
//bagian untuk memasukkan keterangan tabel
$pdf->SetFont('Times','',11); //set font untuk keterangan tabel
$pdf->Cell(3,1,'Id Siswa',1,0,'C');
$pdf->Cell(6,1,'Nama',1,0,'C');
$pdf->Cell(6,1,'Sekolah Asal',1,0,'C');
$pdf->Cell(3,1,'Nilai',1,0,'C');	//(lebar ruangan,tinggi tulisan,teks,border,posisi baris			
												//berikutnya,align cell)

$pdf->Ln();
	
//bagian untuk memasukkan isi tabel
for ($j=0;$j<$i;$j++)
{
	$pdf->SetFont('Times','',10);
	$pdf->Cell(3,0.7,$cell[$j][0],1,0,'L');
	$pdf->Cell(6,0.7,$cell[$j][1],1,0,'L');
	$pdf->Cell(6,0.7,$cell[$j][2],1,0,'L');
	$pdf->Cell(3,0.7,$cell[$j][3],1,0,'R');
	$pdf->Ln();
}

$pdf->Output();

?>