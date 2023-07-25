
<?php

include('../config/conn.php');
include 'mvc/controller/class-autoload.cont.php';
include 'mvc/model/loaddata2pdf.mod.php';
include 'mvc/model/sched.mod.php';

$id = $_GET['id'];
$sql = "SELECT *  FROM loan_applications WHERE client_id = '$id' AND paid=0";
$res = mysqli_query($con,$sql);
if(mysqli_num_rows($res) > 0){
    while($row = mysqli_fetch_assoc($res)) {
      $contract = $row['contract_no'];
    }
}

$sched = new Schedule($contract);

$load = new ClientData($_GET['id']);

define('sched', $sched);

define('load', $load);

session_start();



// Include the main TCPDF library (search for installation path).
require_once('../lib/TCPDF-main/tcpdf.php');

// extend TCPF with custom functions
class MYPDF extends TCPDF {

    // // Load table data from file
    // public function LoadData() {
     
      
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

  //convert numbers into words
  public function convertNumber($num = false)
  {
    $num = str_replace(array(',', ''), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven',
        'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'
    );
    $list2 = array('', 'Ten', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety', 'Hundred');
    $list3 = array('', 'Thousand', 'Million', 'Billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
    );
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ( $hundreds == 1 ? '' : '' ) . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' and ' . $list1[$tens] . ' ' : '' );
        } elseif ($tens >= 20) {
            $tens = (int)($tens / 10);
            $tens = ' and ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    $words = implode(' ',  $words);
    $words = preg_replace('/^\s\b(and)/', '', $words );
    $words = trim($words);
    $words = ucfirst($words);
    $words = $words  . " ";
    return $words;
}

    // Colored table
    // sample  public function ColoredTable($header,$data)
    public function ColoredTable($header) {
        // Colors, line width and bold font
        $this->SetFillColor(209, 28, 28);
        $this->SetTextColor(255);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(30,30,30);
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
        $date = new DateTime(sched->startDate);

        for($index = 0; $index < sched->duration; $index++){
            date_add($date, date_interval_create_from_date_string(sched->addDate." days"));
            $this->Cell($w[0], 6, '', 'LR', 0, 'C', $fill);    
            $this->Cell($w[1], 6, '', 'LR', 0, 'C', $fill);
            $this->Cell($w[2], 6, '', 'LR', 0, 'C', $fill);
            $this->Ln();
            $fill=!$fill;
        }
            $this->Cell($w[0], 6, '', 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, '', 'LR', 0, 'C', $fill);
            $this->Cell($w[2], 6, '', 'LR', 0, 'C', $fill);        
        $this->Ln();
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);



// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('AMIGO');
$pdf->SetTitle('Disclosure');
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
$pdf->Ln(2);
$pdf->SetFont('courier','B','12');
$pdf->cell(189,5,'DISCLOSURE STATEMENT OF LOAN/CREDIT TRANSACTION',0,1,'C');

$pdf->Ln(4);
$pdf->SetFont('courier','','10');
$pdf->cell(189,5,'Borrower: '.load->clientName,0,1,'L');
$pdf->cell(189,5,'Address: '.load->clientAddress,0,1,'L');
$pdf->Ln(4);
$pdf->MultiCell(0,5,"1.  Cash/Purchase Price ________________ Or Net Proceeds of Loan . . . 					
(Items Purchased)					
2.  Less:   Down Payment and/or Trade-in Value						
(Not Applicable for Loan Transaction)					
3.  Unpaid Balance of Cash/Purchase Price or Net Proceeds of Loan						
4.  Non-Finance Charges  (Advance by seller/creditor)						
      a) Insurance Premium						
      b) Taxes						
      c) Registration Fees						
      d) Documentary/Science Stamps						
      e) Notarial Fees						
      f) Others (specify)						
                    
TOTAL NON-FINANCE CHARGES					
5.  Amount to be Financed (Items 3 & 4)						
6.  Finance Charges						
      a)  Interest  ......….........% per annum,						
            from   ___-___, 2023   To   ___-___, 2023						
      b)  Discounts						
      c)  Service/Handling Charges						
      d)  Collection Charges						
      e)  Credit Investigation Fees						
      f)  Attorney's/Legal Fees						
      g)  Other Charges Incidental to the						
            Extension of Credit   (specify)						
                    
TOTAL FINANCE CHARGES					
7.  Percentage of Finance Charges to Total Amount Financed						
   (Computed in accordance with Sec. 2 (i) of CB circular 158)						
8.  Effective Interest Rate (method of computation attached)						
9.  Payment						
      a)  Single Payment due  …............................ (Date)						
      b)  Total Installment Payments						
        (……..,2023)  Payments @ ₱ ….......)						
10.  Additional Charges in case certain stipulations in the contract						
   are not met by the debtor:						
",0,'J',false);
$pdf->Ln(5);

// column titles
$pdf->SetFont('courier','','10');
$header = array('NATURE','RATE', 'AMOUNT');

// //data loading
// // $data = $pdf->LoadData();

// //print colored table
$pdf->ColoredTable($header);

$pdf->cell(189,5,'',0,1,'C');
$pdf->cell(189,5,'',0,1,'C');
$pdf->cell(189,5,'',0,1,'C');
$pdf->cell(189,5,'',0,1,'C');
$pdf->cell(189,5,'',0,1,'C');
$pdf->cell(189,5,'',0,1,'C');
$pdf->cell(189,5,'',0,1,'C');
$pdf->cell(189,5,'',0,1,'C');
$pdf->cell(189,5,'',0,1,'C');
$pdf->cell(189,5,'',0,1,'C');

$pdf->MultiCell(0,5,"		                              Certified Correct :				
                                                    CHERRY MAE C. EULA			
I acknowledge receipt of copy                     _______________________ 
of this statement prior to                           MARKETING MANAGER
the consumption as of the 
credit transacrion and that I
under-stand and fully agree to
the terms and conditions thereof.				  __________________________________________
Date: ".date_format(new DateTime(date('Y-m-d')), 'F d, Y')."	            		      (Borrower's Signature Over Printed Name)			
                
",0,'J',false);
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
$pdf->Output('Disclosure.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>




