<?php
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
        header("location: login.php");
        exit;
    }
    include "../connection.php";


    require_once('../TCPDF-main/tcpdf.php');

    // Get user's name
    $name =  isset($_SESSION['full_name']) ? "Name:".$_SESSION['full_name'] : 'Guest';
    $emp_id =isset($_SESSION['employee_id']) ?"ID: " . $_SESSION['employee_id'] : 'Guest_id';
    
    // Certificate template image path
    $templateImagePath = '../assets/img/certificate_templete.png';

    // PDF output path
    $outputPath = __DIR__ . '/certificates/' . $_SESSION['username'] . '_certificate.pdf';

    // Create instance of TCPDF
    $pdf = new TCPDF('L', 'mm', 'A5', true, 'UTF-8', True);
    

    // removing apce for header and footer

    $pdf -> setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // Add a page (optional)
    $pdf->AddPage();

    // Set font kozminproregular pdfahelvetica,pdfacourier dejavuserifcondensedb, dejavuserifcondensed,
    $pdf->SetFont('dejavuserifcondensed', '', 16);

    // Add the certificate template as a background image
    $pdf->Image($templateImagePath, 20,10, $pdf->getPageWidth(), $pdf->getPageHeight());

    // Add user's name to the certificate
    $pdf->Text(80, 60, $name);
    $pdf->Text(80, 70, $emp_id);

    // Output the PDF and force download
    
    $pdf->Output($outputPath, 'D');
?>
