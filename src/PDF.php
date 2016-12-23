
<?php
require('fpdf.php');

class PDF extends FPDF
{

    function Header()
    {
        global $title;
        // Logo
        $this->Image('../public/img/logo.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Calculate width of title and position
        $w = $this->GetStringWidth($title)+6;
        $this->SetX((210-$w)/2);
        // Color of text
        $this->SetTextColor(255,48,48);
        // Title
        $this->Cell($w,9,$title,0,1,'C');
        // Line break
        $this->Ln(25);
    }

    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','',9);
        // Text color in gray
        $this->SetTextColor(128);
        // Page number
        $this->Cell(0,10,$this->PageNo().'/{nb}',0,0,'C');
    }

    function ChapterTitle($num, $label)
    {
        // Arial 12
        $this->SetFont('Arial','',12);
        // Background color
        $this->SetFillColor(200,220,255);
        // Title
        $this->Cell(0,6,"Chapter $num : $label",0,1,'L',true);
        // Line break
        $this->Ln(4);
    }

    function ChapterBody($file)
    {
        // Read text file
        $txt = file_get_contents($file);
        // Times 12
        $this->SetFont('Times','',12);
        // Output justified text
        $this->MultiCell(0,5,$txt);
        // Line break
        $this->Ln();
        // Mention in italics
        $this->SetFont('','I');
        $this->Cell(0,5,'(end of excerpt)');
    }

    function PrintChapter($num, $title, $file)
    {
        $this->AddPage();
        $this->ChapterTitle($num,$title);
        $this->ChapterBody($file);
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$title = 'Biblioteca Aaron & Oscar';
$pdf->SetTitle($title);
$pdf->SetAuthor('Jules Verne');
$pdf->PrintChapter(1,'A RUNAWAY REEF','../public/index.php');
$pdf->PrintChapter(2,'THE PROS AND CONS','../public/index.php');
$pdf->Output();
?>

