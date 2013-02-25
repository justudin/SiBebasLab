<?php

//deklarasi FPDF
//deklarasi FPDF
class PDF extends FPDF {

    //inisialisasi Header DOkumen PDF
    function Header() {
        //load image logo
        $this->Image('./assets/images/kopuin.jpg', 1.5, 1);
        //setting format font
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 1, 'KEMENTERIAN AGAMA', 0, 0, 'C');
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
        $this->Ln(1.5);
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
//setting margin kertas
$pdf->SetMargins(1.5, 1, 1.5);
$pdf->SetFont('Arial', '', 11);

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

// menuliskan datanya
$pdf->Cell(18.5, 1, 'Yogyakarta, ' . date('d') . ' ' . $namaBln . ' ' . date('Y'), 0, 0, 'R');
$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(0, 1, 'DATA LAPORAN PEMASUKAN UANG ADMINISTRASI BEBAS LAB', 0, 0, 'C');
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 12);

$pdf->Ln(0.5);
$pdf->Cell(1, 1, 'NO', 1, 0, 'C');
$pdf->Cell(2.5, 1, 'NIM', 1, 0, 'C');
$pdf->Cell(9, 1, 'NAMA', 1, 0, 'C');
$pdf->Cell(3, 1, 'TGL BAYAR', 1, 0, 'C');
$pdf->Cell(3.5, 1, 'JUMLAH', 1, 0, 'C');
$no = 1;
$total=0;
foreach ($datatransaksi->result_array() as $dt) {
    $pdf->Ln(1);
    $pdf->Cell(1, 1, $no, 1, 0, 'C');
    $pdf->Cell(2.5, 1, $dt['NIM'], 1, 0, 'C');
    $pdf->Cell(9, 1, $dt['NAMA'], 1, 0, 'L');
    $pdf->Cell(3, 1, $dt['TGL_BAYAR'], 1, 0, 'C');
    $pdf->Cell(3.5, 1, number_format($dt['JUMLAH'],0,',','.').",-", 1, 0, 'C');
    
    $total=$total+$dt['JUMLAH'];
    $no++;
}

$pdf->Ln(1);
$pdf->Cell(8, 1, 'Total Pemasukan : Rp '.number_format($dt['JUMLAH'],0,',','.').",-", 0, 0, 'L');



//Menjadikan dalam bentuk PDF
$pdf->Output('LAPORAN KEUANGAN.pdf', 'I');