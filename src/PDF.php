
<?php
require_once ("../src/DBConnection.php");
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
        // Arial 9
        $this->SetFont('Arial','',9);
        // Text color in gray
        $this->SetTextColor(128);
        // Page number
        $this->Cell(0,10,$this->PageNo().'/{nb}',0,0,'C');
    }

    function SectionTitle($label, $title)
    {
        // Line break
        $this->Ln(8);
        // Text format
        $this->SetFont('Arial','',12);
        $this->SetTextColor(255,48,48);
        // Background color
        $this->SetFillColor(220);
        // Title
        $this->Cell(0,6,"$label: $title",0,1,'L',true);
        // Line break
        $this->Ln(3);
    }

    function SectionBody($txt)
    {
        // Arial 11
        $this->SetFont('Arial','',11);
        $this->SetTextColor(0);
        // Output justified text
        $this->MultiCell(0,5,$txt);
        // Line break
        $this->Ln(1);
    }

    function PrintSection($label, $title, $content)
    {
        $this->SectionTitle($label, $title);
        $this->SectionBody($content);
    }
}


require_once ("DBConnection.php");
$link = DBConnection::getConnection();

// Comprovar la connexió, si no pot connectar-se donara error
if ($link === false) die("Die");

$pdf = new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages();
$title = 'Biblioteca Aaron & Oscar';
$pdf->SetTitle($title);
$pdf->SetAuthor('Aaron Castells & Oscar Oliver');
$pdf->AddPage();

if ($_POST['reportType'] == 'llibre') {
    $sql1 = 'SELECT C.idLlibre, L.titol, count(*) "prestecs"
             FROM cataleg C, prestecs P, llibre L, usuari U
             WHERE C.id IN (SELECT idCataleg FROM prestecs) AND
                   C.id = P.idCataleg AND
                   C.idLlibre = L.id AND
                   P.idUsuari = U.id
             GROUP BY C.idLlibre
             ORDER BY L.titol';

    $resultsTitle = mysqli_query($link, $sql1);
    while ($row1 = $resultsTitle->fetch_array()) {
        $pdf->SectionTitle('Llibre', $row1['titol'].' ('.$row1['prestecs'].' prestecs)');
        $sql2 = 'SELECT C.idLlibre, L.titol ,P.idUsuari , U.Nom, U.cognom, count(*) "prestecs"
                 FROM cataleg C, prestecs P, llibre L, usuari U
                 WHERE C.id IN (SELECT idCataleg FROM prestecs) AND
                       C.id = P.idCataleg AND
                       C.idLlibre = L.id AND
                       L.id = '.$row1["idLlibre"].' AND
                       P.idUsuari = U.id
                 GROUP BY C.idLlibre, P.idUsuari
                 ORDER BY U.Nom';
        $resultsSection =  mysqli_query($link, $sql2);
        while ($row2 = $resultsSection->fetch_array()) {
            $pdf->SectionBody($row2['Nom'].' '.$row2['cognom'].' ('.$row2['prestecs'].')');
        }
    }
}


$pdf->Output();

$link->close();

?>

