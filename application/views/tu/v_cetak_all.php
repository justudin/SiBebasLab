<?php

function Terbilang($satuan)
{
$huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
if ($satuan < 12)
return " " . $huruf[$satuan];
elseif ($satuan < 20)
return Terbilang($satuan - 10) . "Belas";
elseif ($satuan < 100)
return Terbilang($satuan / 10) . " Puluh" . Terbilang($satuan % 10);
elseif ($satuan < 200)
return " Seratus" . Terbilang($satuan - 100);
elseif ($satuan < 1000)
return Terbilang($satuan / 100) . " Ratus" . Terbilang($satuan % 100);
elseif ($satuan < 2000)
return " Seribu" . Terbilang($satuan - 1000);
elseif ($satuan < 1000000)
return Terbilang($satuan / 1000) . " Ribu" . Terbilang($satuan % 1000);
elseif ($satuan < 1000000000)
return Terbilang($satuan / 1000000) . " Juta" . Terbilang($satuan % 1000000);
elseif ($satuan <= 1000000000)
echo "Maaf Tidak Dapat di Prose Karena Jumlah Uang Terlalu Besar ";
}

//deklarasi FPDF
//deklarasi FPDF
class PDF extends FPDF {

    //inisialisasi Header DOkumen PDF
    function Header1() {
        //load image logo
        $this->Image('./assets/images/kop-lab.png', 1.5, 1);
        //setting format font
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 1, 'KEMENTERIAN AGAMA', 0, 0, 'C');
        $this->Ln(0.8);
        $this->Cell(0, 1, 'UNIVERSITAS ISLAM NEGERI SUNAN KALIJAGA', 0, 0, 'C');
        $this->Ln(0.8);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 1, 'LABORATORIUM TERPADU', 0, 0, 'C');
        $this->Ln(0.8);
        $this->SetFont('Arial', '', 9);
        $this->Cell(2);
        $this->Cell(0, 1, 'JL. Marsda Adisucipto, Telp. (0274) 550694, Fax (0274) 556764 YOGYAKARTA 55281', 0, 0, 'C');
        $this->Line(1.5, 4.5, 20, 4.5, 1.5);
        $this->Line(1.5, 4.55, 20, 4.55, 1.5);
        $this->Image('./assets/images/kopuin-kuitansi.jpg', 18, 1);
        //ganti baris
        //$this->Ln();
        //setting format font
    }
    function Header2()
    {
        //load image logo
        $this->Image('./assets/images/kopuin.jpg', 1.5, 1);
        //setting format font
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 1, 'KEMENTERIAN AGAMA', 0, 0, 'C');
        $this->Cell(0, 1, 'FM-LT-SD-01-05', 0, 0, 'R');
        $this->Ln(0.8);
        $this->Cell(0, 1, 'UNIVERSITAS ISLAM NEGERI SUNAN KALIJAGA', 0, 0, 'C');
        $this->Ln(0.8);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 1, 'LABORATORIUM TERPADU', 0, 0, 'C');
        $this->Ln(0.8);
        $this->SetFont('Arial', '', 10);
        $this->Cell(2);
        $this->Cell(0, 1, 'JL. Marsda Adisucipto, Telp. (0274) 550694, Fax (0274) 556764 YOGYAKARTA 55281', 0, 0, 'C');
        $this->Line(1.5, 4.5, 20, 4.5, 1.5);
        $this->Line(1.5, 4.55, 20, 4.55, 1.5);
        //ganti baris
        //$this->Ln();
        //setting format font   
    }

}

//deklarasi format kertas 
$pdf = new PDF('P', 'cm', 'A4');
$pdf->Open();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Header1();
//setting margin kertas
$pdf->SetMargins(1.5, 1, 1.5);
$pdf->SetFont('Arial', 'B', 12);

//membuat kop tabel
$x = $pdf->GetY();
$pdf->SetY($x + 1);

// Untuk membuat tanggal dalam format indonesia
$angkaBln = date("n");
switch ($angkaBln) {
    case 1 : $namaBln = "Januari";
        break;
    case 2 : $namaBln = "Februari";
        break;
    case 3 : $namaBln = "Maret";
        break;
    case 4 : $namaBln = "April";
        break;
    case 5 : $namaBln = "Mei";
        break;
    case 6 : $namaBln = "Juni";
        break;
    case 7 : $namaBln = "Juli";
        break;
    case 8 : $namaBln = "Agustus";
        break;
    case 9 : $namaBln = "September";
        break;
    case 10: $namaBln = "Oktober";
        break;
    case 11: $namaBln = "Nopember";
        break;
    case 12: $namaBln = "Desember";
        break;
}

$isi = "Biaya Administrasi Surat Bebas Laboratorium.";

// menuliskan datanya
$pdf->Ln(0.5);
$pdf->SetFont('Arial', 'UB', 12);
$pdf->Cell(0, 1, 'KWITANSI / BUKTI PEMBAYARAN', 0, 0, 'C');
$pdf->Ln(0.8);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 1, 'Nomor : ............................................', 0, 0, 'C');
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(0.5);
foreach ($datamhs->result() as $mhs) {
    $nim = $mhs->NIM;
    $nama = $mhs->NAMA;
    $prodi = $mhs->NM_PRODI;
}
$pdf->Cell(5, 1, 'Sudah Diterima Dari', 0, 0, 'L');
$pdf->Cell(5, 0.8, ': ' . $nama .' ('.$nim.')', 0, 1, 'L');
$pdf->Cell(5, 0.8, 'Jumlah Uang', 0, 0, 'L');
$pdf->Cell(5, 0.8, ': Rp. '.number_format($harga,0,',','.').',-', 0, 1, 'L');
$pdf->Cell(5, 0.8, 'Terbilang', 0, 0, 'L');
$pdf->Cell(5, 0.8, ':'.Terbilang($harga).'Rupiah', 0, 1, 'L');
$pdf->Cell(5, 0.8, 'Untuk Pembayaran', 0, 0, 'L');
$pdf->Cell(5, 0.8, ': '.$isi, 0, 1, 'L');
$pdf->Ln();
$pdf->Cell(18, 1, 'Yogyakarta, ' . date('d') . ' ' . $namaBln . ' ' . date('Y'), 0, 0, 'R');
$pdf->Ln(1);
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(7, 1, '', 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(6.5, 1, 'Konsumen', 0, 0, 'L');
$pdf->Cell(8, 1, 'Keuangan', 0, 0, 'L');
$pdf->SetFont('Arial', 'I', 10);
$pdf->Ln();
$pdf->Cell(5, 0.5, 'Ket:', 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(7, 0.5, '- Lembar 1 : Keuangan', 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(7, 0.5, '- Lembar 2 : Konsumen', 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(7, 0.5, '- Lembar 3 : Arsip', 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
foreach ($pegawaitu->result() as $tu) {
    $nmtu = $tu->NM_PEG;
    $niptu = $tu->NIP;
}
$pdf->SetFont('Arial', 'U', 12);
$pdf->Cell(6, 0.5, $nama, 0, 0, 'L');
$pdf->Cell(7, 0.5, $nmtu, 0, 0, 'L');
//Menjadikan dalam bentuk PDF
$pdf->AddPage();
$pdf->Header2();
$pdf->SetMargins(1.5, 1, 1.5);
$pdf->SetFont('Arial', 'B', 14);

//membuat kop tabel
$x = $pdf->GetY();
$pdf->SetY($x + 1);

// Untuk membuat tanggal dalam format indonesia
$angkaBln = date("n");
switch ($angkaBln) {
    case 1 : $namaBln = "Januari";
        break;
    case 2 : $namaBln = "Februari";
        break;
    case 3 : $namaBln = "Maret";
        break;
    case 4 : $namaBln = "April";
        break;
    case 5 : $namaBln = "Mei";
        break;
    case 6 : $namaBln = "Juni";
        break;
    case 7 : $namaBln = "Juli";
        break;
    case 8 : $namaBln = "Agustus";
        break;
    case 9 : $namaBln = "September";
        break;
    case 10: $namaBln = "Oktober";
        break;
    case 11: $namaBln = "Nopember";
        break;
    case 12: $namaBln = "Desember";
        break;
}

$isi = "Laboratorium Terpadu UIN Sunan Kalijaga Yogyakarta dengan ini menerangkan bahwa mahasiswa yang tersebut dibawah ini :";
$isi2 = "telah menyelesaikan segala bentuk administrasi yang terkait aktivitas yang bersangkutan di Laboratorium Terpadu. Oleh karena itu, mahasiswa tersebut dinyatakan telah BEBAS TANGGUNGAN LABORATORIUM.";
$isi3 = "Telah diverifikasi oleh Pranata Laboratorium Pendidikan (PLP) :";
$isi4 = "Surat Keterangan Bebas Laboratorium ini dibuat untuk digunakan sebagaimana mestinya.";
// menuliskan datanya
$pdf->Ln(0.5);
$pdf->Cell(0, 1, 'SURAT KETERANGAN BEBAS LABORATORIUM', 0, 0, 'C');
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 0.9, $isi, 0, 'J');
foreach ($datamhs->result() as $mhs) {
    $nim = $mhs->NIM;
    $nama = $mhs->NAMA;
    $prodi = $mhs->NM_PRODI;
}
$pdf->Cell(5, 1, 'NAMA', 0, 0, 'L');
$pdf->Cell(5, 0.8, ': ' . $nama, 0, 1, 'L');
$pdf->Cell(5, 0.8, 'NIM', 0, 0, 'L');
$pdf->Cell(5, 0.8, ': ' . $nim, 0, 1, 'L');
$pdf->Cell(5, 0.8, 'PRODI', 0, 0, 'L');
$pdf->Cell(5, 0.8, ': ' . $prodi, 0, 1, 'L');
$pdf->MultiCell(0,0.9, $isi2, 0, 'J');
$pdf->Write(0.8, $isi3, 'J');
$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(5, 0.8, 'Nama PLP', 0, 0, 'L');
$pdf->Cell(6, 0.8, 'Tanda Tangan', 0, 1, 'R');
$pdf->SetFont('Arial', '', 12);

foreach ($datappl->result() as $ppl) {
    //print data PLP tiap prodi
    $pdf->Cell(5, 1, $ppl->NM_PEG, 0, 0, 'L');
    $pdf->Cell(6, 1, '____________', 0, 1, 'R');
}
$pdf->Ln();
$pdf->Write(0.8, $isi4, 'J');
$pdf->Ln(1);
$pdf->Cell(16, 1, 'Yogyakarta, ' . date('d') . ' ' . $namaBln . ' ' . date('Y'), 0, 0, 'R');
$pdf->Ln(0.8);
$pdf->Cell(16.4, 1, 'Ketua Laboratorium Terpadu,', 0, 0, 'R');
$pdf->Ln(3.5);
foreach ($dirutlab->result() as $dirut) {
    $nmdirut = $dirut->NM_PEG;
    $nipdirut = $dirut->NIP;
}
$pdf->SetFont('Arial', 'U', 12);
$pdf->Cell(16.5, 0.8, $nmdirut, 0, 0, 'R');
$pdf->Ln(0.7);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(16.3,0.9, 'NIP. ' . $nipdirut, 0, 0, 'R');
//$pdf->Output();
$pdf->Output('Kuitansi dan Surat Bebas Lab - ' . $nim . ' - ' . $nama . '.pdf', 'I');