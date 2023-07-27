<?php

include('../config/conn.php');
include 'mvc/controller/class-autoload.cont.php';
include 'mvc/model/loaddata2pdf.mod.php';

session_start();

define('id', $_GET['id']);

$load = new ClientData($_GET['id']);

define('load', $load);

// Include the main TCPDF library (search for installation path).
require_once('../lib/TCPDF-main/tcpdf.php');

// extend TCPF with custom functions
class MYPDF extends TCPDF {

    // Load table data from file
    // public function LoadData() {
     
    //     include 'connection.php';
    //    if(isset($_POST['from_date']) && isset($_POST['to_date'])){
           
    //         $from_date = $_POST['from_date'];
    //         $to_date = $_POST['to_date'];
    //         $query ="SELECT tbl_supplyinformation.SupplyName,tbl_suppliesrecieved.id,tbl_suppliesrecieved.AllocationID,tbl_suppliesrecieved.Quantity,tbl_suppliesrecieved.ExpirationDate,tbl_suppliesrecieved.status,tbl_supplyinformation.SupplyID
    //                  FROM tbl_suppliesrecieved,tbl_supplyinformation
    //                 WHERE tbl_supplyinformation.SupplyID = tbl_suppliesrecieved.SupplyID AND ExpirationDate BETWEEN '$from_date' AND '$to_date'ORDER BY AllocationID ASC";
    //         $query_run = mysqli_query($con,$query);
    //             return $query_run;
    //     }
        
        
    // }

    public function loadHTML(){
        $content = '<style>'.file_get_contents('../css/bootstrap.min.css').'</style>     
        <div class="container-fluid">
              <div class="row">
              <button class="btn btn-primary">SAVE</button>
              </div>
        </div>';
        return $content;
    }

    // Colored table
    public function ColoredTable($header,$data) {
        // Colors, line width and bold font
        $this->SetFillColor(209, 28, 28);
        $this->SetTextColor(255);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(45, 36, 35, 36, 30);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        foreach($data as $row) {
            $this->Cell($w[0], 6, $row["AllocationID"], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row["SupplyName"], 'LR', 0, 'L', $fill);    
            $this->Cell($w[2], 6, $row["Quantity"].' pcs', 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, $row["ExpirationDate"], 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 6, $row["status"], 'LR', 0, 'L', $fill);           
            $this->Ln();
            $fill=!$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);



// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('AMIGO');
$pdf->SetTitle('Contract');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');



// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 12);
$date_val = date("Y-m-d");
// add a page
$pdf->AddPage();
// $pdf->WriteHtml($pdf->loadHTML());
$pdf->Ln(2);
$pdf->SetFont('pdfahelvetica','B','12');
$pdf->cell(0,0,'Personal Information',0,5,'L');
$pdf->SetFont('courier','','10');
$pdf->MultiCell(0,1,'
Full Name: '.load->clientName.'
Address: '.load->clientAddress.'
Gender: '.load->gender.'
Date of Birth: '.load->dateBirth.'
Place of Birth: '.load->placeBirth.'
Marital Status: '.strtoupper(load->mstatus).'
Contact No.: '.load->contact.'
',0,'J',false);
$pdf->SetFont('pdfahelvetica','B','12');
$pdf->Write($h=0, $label, $link='', $fill=0, $align='C', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
$pdf->cell(0,0,'Family Background',0,5,'L');
$pdf->SetFont('courier','','10');
$pdf->MultiCell(0,1,"
Mother's Name: ".load->motherName."
Conctact: ".load->motherContact."
Father's Name: ".load->fatherName."
Contact: ".load->fatherContact."
Living With: ".load->lw."
",0,'J',false);
$pdf->Write($h=0, $label, $link='', $fill=0, $align='C', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
if(load->mstatus == "Married"){
    $pdf->SetFont('pdfahelvetica','B','12');
    $pdf->cell(0,0,'Spouse Information',0,5,'L');
    $pdf->SetFont('courier','','10');
    $pdf->MultiCell(0,1,"
Name: ".load->spouseName."
Conctact: ".load->spouseContact."
Date of Birth: ".load->spouseBirth."
Place of Birth: ".load->spouseBirthAddress."
Address: ".load->spouseAddress."
Occupation: ".load->spouseOccupation."
    ",0,'J',false);
}
$pdf->SetFont('pdfahelvetica','B','12');
$pdf->cell(0,0,'Employment Inforation',0,5,'L');
$pdf->SetFont('courier','','10');
$pdf->MultiCell(0,1,"
Employer / Agency Name: ".load->agency."
Sector Type: ".load->sector."
Type of Business: ".load->top."
Completes Address of Company: ".load->companyAddress."
Assigned Location: ".load->location."
Name of Supervisor/COOR/Supervisor: ".load->supervisorName."
Contact Number of HR/COOR/Supervisor: ".load->supervisorContact."
Date Hired: ".load->dateHired."
Employment Status: ".load->estatus."
Mode of Salary: ".load->mos."
Bank Name: ".load->bank."
Do you have other loan? ".load->loan."
Gross (Monthly): ".load->gross."
Other Source of Income: ".load->osi."
Specify: ".load->specify."
",0,'J',false);
$pdf->Ln(3);
//Type of ATM Card: ".load->toac."
$pdf->Write($h=0, $label, $link='', $fill=0, $align='C', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
$pdf->SetFont('courier','','10');
$pdf->MultiCell(0,5,'I HEREBY CERTIFY that the information provided in this form is complete, true and correct to the best of my knowledge. FURTHER, I HEREBY ACKNOWLEDGE that I have read and understood the UNA AMIGO LENDING CORPORATION Privacy Notice and agree there to as well. I give my consent to UNA AMIGO LENDING CORPORATION to collect, use and process my personal information. I understand that my consent does not preclude the existence of other criteria for lawful processing of personal data, and does not waive any of my rights under the Data Privacy Act of 2012 and other applicable laws. 

Signature Over Printed Name of Borrower : '.load->clientName.'
Date: '.date_format(new DateTime(date('Y-m-d')), 'F d, Y').'
',0,'J',false);
// $pdf->Ln(8);
// $pdf->SetFont('helvetica','','12');
// $pdf->cell(189,5,'Contract',0,1,'C');
// $pdf->Ln(8);
// $pdf->cell(0, 5,'Full Name: DHEL MARK SALIDAGA  BAYLON', 0, 1,'L');
// $pdf->Ln(5);
// $pdf->SetFont('helvetica','','11');
// $pdf->cell(0,3,'Contract Number:                                                                                      Principal Value: P 2,000,000.00',0,1,'L');
// $pdf->Ln(5);
// $pdf->cell(0,3,'Start Date:                                                                                                  Duration in Months: 4 MONTHS',0,1,'L');
// $pdf->Ln(8);
// $pdf->cell(0,3,'Loan Rate:                                                                                                 Amortization Frequency: MONTHLY ',0,1,'L');
// $pdf->Ln(8);


// $pdf->Ln(8);
// column titles
// $header = array('Month','Amort Date', 'Amount', 'Status', 'Date Paid');

// data loading
// $data = $pdf->LoadData();

// print colored table
// $pdf->ColoredTable($header, $data);

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('Contract.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>