
<?php
require_once ("../src/DBConnection.php");
require('fpdf.php');

class PDF extends FPDF
{

    function Header()
    {
        global $title;
        $title = utf8_decode($title);
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
        $label = utf8_decode($label);
        $title = utf8_decode($title);
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
        $this->MultiCell(0,5,utf8_decode($txt));
        // Line break
        $this->Ln(1);
    }


    function Table($header, $data)
    {
        // Colors, line width and bold font
        $this->SetFillColor(255,48,48);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        // Header
        $w = array(35, 35, 100, 100);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,utf8_decode($header[$i]),1,0,'C',true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        foreach($data as $row)
        {
            $this->Cell($w[0],6,utf8_decode($row[0]),'LR',0,'C',$fill);
            $this->Cell($w[1],6,utf8_decode($row[1]),'LR',0,'C',$fill);
            $this->Cell($w[2],6,utf8_decode($row[2]),'LR',0,'L',$fill);
            $this->Cell($w[3],6,utf8_decode($row[3]),'LR',0,'L',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w),0,'','T');
    }
}



require_once ("DBConnection.php");

function booksReport($pdf) {
    $link = DBConnection::getConnection();

// Comprovar la connexió, si no pot connectar-se donara error
    if ($link === false) die("Die");

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
        $pdf->SectionTitle('Llibre', $row1['titol'].' ('.$row1['prestecs'].' préstecs)');
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

    $link->close();
}

function userReport($pdf) {
    $link = DBConnection::getConnection();

// Comprovar la connexió, si no pot connectar-se donara error
    if ($link === false) die("Die");

    $sql1 = ' SELECT prestecs.idusuari, usuari.nom, usuari.cognom, count(*) "prestecs"
              FROM usuari, prestecs
                RIGHT JOIN cataleg
                  ON prestecs.idCataleg = cataleg.id
                RIGHT JOIN llibre
                  ON llibre.id = cataleg.idLlibre
              WHERE prestecs.idUsuari = usuari.id
              GROUP BY prestecs.idUsuari';

    $resultsTitle = mysqli_query($link, $sql1);
    while ($row1 = $resultsTitle->fetch_array()) {
        $pdf->SectionTitle('Usuari', $row1['nom'].' '.$row1['cognom'].' ('.$row1['prestecs'].' préstecs)');
        $sql2 ='SELECT prestecs.idusuari, usuari.nom, usuari.cognom, llibre.id, llibre.titol, count(*) "prestecs"
                FROM usuari, prestecs
                  RIGHT JOIN cataleg
                    ON prestecs.idCataleg = cataleg.id
                  RIGHT JOIN llibre
                    ON llibre.id = cataleg.idLlibre
                WHERE prestecs.idUsuari = usuari.id AND usuari.id = '.$row1['idusuari'].' 
                GROUP BY prestecs.idUsuari, llibre.id';
        $resultsSection =  mysqli_query($link, $sql2);
        while ($row2 = $resultsSection->fetch_array()) {
            $pdf->SectionBody($row2['titol'].' ('.$row2['prestecs'].')');
        }
    }

    $link->close();
}

function periodReport($pdf) {
    $link = DBConnection::getConnection();

// Comprovar la connexió, si no pot connectar-se donara error
    if ($link === false) die("Die");

    $dateSince = $_POST['dateSince'];
    $dateTo = $_POST['dateTo'];

    $sql1 ="SELECT count(*) 'prestecs'
            FROM prestecs, usuari, cataleg, llibre
            WHERE prestecs.idUsuari = usuari.id AND
                  prestecs.idCataleg = cataleg.id AND
                  cataleg.idLlibre = llibre.id AND
                  prestecs.dataPrestec >= DATE('".$dateSince."') AND
                  prestecs.dataPrestec < DATE_ADD(DATE('".$dateTo."'), INTERVAL 1 DAY)
            ORDER BY dataMaxDevolucio";

    $resultsTitle = mysqli_query($link, $sql1);
    while ($row1 = $resultsTitle->fetch_array()) {
        $pdf->SectionTitle('Periode', 'Del '.$dateSince.' al '.$dateTo.' ('.$row1['prestecs'].' préstecs)');
        $sql2 ="SELECT
                    DATE(prestecs.dataPrestec) 'dateSince',
                    DATE(prestecs.dataMaxDevolucio) 'dateTo',
                    LPAD(prestecs.idUsuari,5,'0') 'idUsuari',
                    usuari.nom,
                    usuari.cognom,
                    LPAD(prestecs.idCataleg,5,'0') 'idCataleg',
                    llibre.titol
                FROM prestecs, usuari, cataleg, llibre
                WHERE prestecs.idUsuari = usuari.id AND
                      prestecs.idCataleg = cataleg.id AND
                      cataleg.idLlibre = llibre.id AND
                      prestecs.dataPrestec >= DATE('".$dateSince."') AND
                      prestecs.dataPrestec < DATE_ADD(DATE('".$dateTo."'), INTERVAL 1 DAY)
                ORDER BY dataMaxDevolucio";
        $resultsSection =  mysqli_query($link, $sql2);
        while ($row2 = $resultsSection->fetch_array()) {
            $pdf->SectionBody($row2['dateSince'].' - '.$row2['dateTo'].'  '.
                              $row2['idUsuari'].' '.$row2['nom'].' '.$row2['cognom'].'  '.
                              $row2['idCataleg'].' '.$row2['titol']);
        }
    }

    $link->close();
}

function periodReportTable($pdf) {
    $link = DBConnection::getConnection();

// Comprovar la connexió, si no pot connectar-se donara error
    if ($link === false) die("Die");

    $dateSince = $_POST['dateSince'];
    $dateTo = $_POST['dateTo'];

    $sql1 ="SELECT count(*) 'prestecs'
            FROM prestecs, usuari, cataleg, llibre
            WHERE prestecs.idUsuari = usuari.id AND
                  prestecs.idCataleg = cataleg.id AND
                  cataleg.idLlibre = llibre.id AND
                  prestecs.dataPrestec >= DATE('".$dateSince."') AND
                  prestecs.dataPrestec < DATE_ADD(DATE('".$dateTo."'), INTERVAL 1 DAY)
            ORDER BY dataMaxDevolucio";

    $header = ["Préstec", "Max. Devolució", "Usuari", "Llibre"];

    $resultsTitle = mysqli_query($link, $sql1);
    while ($row1 = $resultsTitle->fetch_array()) {
        $pdf->SectionTitle('Període', 'Del '.$dateSince.' al '.$dateTo.' ('.$row1['prestecs'].' préstecs)');
        $sql2 ="SELECT
                    DATE(prestecs.dataPrestec) 'dateSince',
                    DATE(prestecs.dataMaxDevolucio) 'dateTo',
                    LPAD(prestecs.idUsuari,5,'0') 'idUsuari',
                    usuari.nom,
                    usuari.cognom,
                    LPAD(prestecs.idCataleg,5,'0') 'idCataleg',
                    llibre.titol
                FROM prestecs, usuari, cataleg, llibre
                WHERE prestecs.idUsuari = usuari.id AND
                      prestecs.idCataleg = cataleg.id AND
                      cataleg.idLlibre = llibre.id AND
                      prestecs.dataPrestec >= DATE('".$dateSince."') AND
                      prestecs.dataPrestec < DATE_ADD(DATE('".$dateTo."'), INTERVAL 1 DAY)
                ORDER BY dataMaxDevolucio";
        $resultsSection =  mysqli_query($link, $sql2);
        $data = [];
        while ($row2 = $resultsSection->fetch_array()) {
            $data[] = [$row2['dateSince'], $row2['dateTo'], $row2['nom'].' '.$row2['cognom'], $row2['titol']];
        }
        $pdf->Table($header,$data);
    }

    $link->close();
}



if ($_POST['reportType'] == 'llibre')
    $pdf = new PDF('P', 'mm', 'A4');
elseif ($_POST['reportType'] == 'usuari')
    $pdf = new PDF('P', 'mm', 'A4');
elseif ($_POST['reportType'] == 'periode')
    $pdf = new PDF('L', 'mm', 'A4');


$pdf->AliasNbPages();
$title = 'Biblioteca Aaron & Oscar';
$pdf->SetTitle(utf8_decode($title));
$pdf->SetAuthor('Aaron Castells & Oscar Oliver');
$pdf->AddPage();

if ($_POST['reportType'] == 'llibre')
    booksReport($pdf);
elseif ($_POST['reportType'] == 'usuari')
    userReport($pdf);
elseif ($_POST['reportType'] == 'periode')
    periodReportTable($pdf);

$pdf->Output();

?>

