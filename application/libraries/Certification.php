<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'third_party/fpdf.php');

class Certification extends FPDF
{
    // En-tête
    function Header()
    {
        $backgroundImage = APPPATH . 'third_party/bold.jpg';
        $this->Image($backgroundImage, 0, 0, 297, 170); 
        $this->SetY(10);
        $this->SetFont('Arial', 'B', 20);
        $this->SetFillColor(255, 245, 163);
        $this->Cell(0, 20, utf8_decode('UTLTIME TEAM RACE'), 0, 1, 'C', true);
        $this->Ln(10);
    }

    // Pied de page
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Page ') . $this->PageNo(), 0, 0, 'C');
    }

    // Corps du certificat
    function CertificateBody($name, $course, $date , $points)
    {
        $name = utf8_decode($name);
        $course = utf8_decode($course);
        $date = utf8_decode($date);
        
        $this->SetFont('Arial', 'I', 12);
        $this->Cell(0, 10, utf8_decode('Ce document certifie que'), 0, 1, 'C');
        
        $this->SetFont('Arial', 'B', 40);
        $this->Cell(0, 10, $name, 0, 1, 'C');
        
        $this->SetFont('Arial', 'I', 12);
        $this->Cell(0, 10, utf8_decode('a gagné avec succès durant'), 0, 1, 'C');
        
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, $course, 0, 1, 'C');
        
        $this->Ln(10);
        
        $this->SetFont('Arial', '', 12);
        $details = utf8_decode("Délivré le: ") . $date . "\n\n" . utf8_decode("Points:".$points);
        $this->MultiCell(0, 10, $details, 0, 'C');
    }
}


?>
