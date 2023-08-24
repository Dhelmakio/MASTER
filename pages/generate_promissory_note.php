
<?php

include('../config/conn.php');
include 'mvc/controller/class-autoload.cont.php';
include 'mvc/model/sched.mod.php';

$id = $_GET['id'];

$sql = "SELECT *  FROM loan_applications WHERE client_id = '$id' AND paid=0";
$res = mysqli_query($con,$sql);
if(mysqli_num_rows($res) > 0){
    while($row = mysqli_fetch_assoc($res)) {
      $contract = $row['contract_no'];
    }
}

$startDate = $_GET['start'];

$sql = "UPDATE loan_applications SET effective_date='$startDate' WHERE client_id = '$id' AND contract_no = '$contract' AND paid=0";
$resUp = mysqli_query($con,$sql);

$sched = new Schedule($contract);

define('sched', $sched);

define('start', $_GET['start']);

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
        $w = array(60,60,60);

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
        $date = new DateTime(start);
        if(sched->mop == 1){
            $newDuration = sched->duration;
        }else if(sched->mop == 2){
            $newDuration = sched->duration * 2;
        }else if(sched->mop == 3){
            $newDuration = sched->duration * 4;
        }
        for($index = 0; $index < $newDuration; $index++){
            
            date_add($date, date_interval_create_from_date_string(sched->addDate." days"));

            // if ( date_format($date, 't') == 31 ) {

            //     date_add($date, date_interval_create_from_date_string(sched->addDate." days"));

            //     if (sched->salaryPeriod == "Weekly (every Friday)") {

            //     }else if (sched->salaryPeriod == "Every 2nd Saturday") {
        
            //     }else{

            //         $expSP = explode('/', sched->salaryPeriod);
        
            //         if(date_format($date, 'd') < $expSP[0]) {
            //             date_add($date, date_interval_create_from_date_string("1 days"));
            //         }else if(date_format($date, 'd') < $expSP[1]){
            //             date_add($date, date_interval_create_from_date_string("1 days"));
            //         }

            //     }
              
            // } else {

            //     date_add($date, date_interval_create_from_date_string(sched->addDate." days"));

            // }
            
            $this->Cell($w[0], 6, ($index+1), 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, date_format($date, 'F d, Y'), 'LR', 0, 'C', $fill);    
            $this->Cell($w[2], 6, number_format(sched->amortAmount, 2), 'LR', 0, 'C', $fill);
            $this->Ln();
            $fill=!$fill;
        }
            $this->Cell($w[0], 6, '', 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, 'TOTAL:', 'LR', 0, 'C', $fill);
            $this->Cell($w[2], 6, number_format(sched->principal, 2), 'LR', 0, 'C', $fill);        
        $this->Ln();
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);



// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('AMIGO');
$pdf->SetTitle('Promissory Note');
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
$pdf->cell(189,5,'PROMISSORY NOTE',0,1,'C');

$pdf->Ln(3);
$pdf->SetFont('courier','','10');
$pdf->MultiCell(0,5,'FOR VALUE RECEIVED, I/We jointly and severally promise to pay to the order of the sum of '.strtoupper($pdf->convertNumber(sched->principal)).' (₱ '.number_format(sched->principal, 2).')  PESOS, Philippine Currency, according to the following payment schedule:
',0,'J',false);
$pdf->Ln(8);

//column titles
$pdf->SetFont('courier','B','12');
$pdf->cell(189,5,'PAYMENT SCHEDULE',0,1,'C');
$pdf->SetFont('courier','','10');
$header = array('PAYMENT NO.','DATE', 'AMOUNT');

//data loading
// $data = $pdf->LoadData();

//print colored table
$pdf->ColoredTable($header);
$pdf->Ln(3);
$pdf->SetFont('courier','','10');
$pdf->MultiCell(0,5,"It is a special condition of this contract that the parties here-in agree that the amount of peso-obligation under this agreement is based on the present value of peso, and if there be any change in the value thereof due to extraordinary inflation or deflation, or any other cause or reason, then the peso-obligation herein con-tracted shall be adjusted in accordance with the value of the peso then prevailing  at the time of the complete fulfillment of the obligation. This note is defaulted, and the total unpaid balance thereof (and a penalty in a sum equivalent to 4.% for each	month or part hereof) becomes immediately due and payable, SANSDEMAND, in anyone/all of the following instances:			

a)  the Special Power of Attorney, Deed of Assignment, or other security  
    document excuted with this note is revoked or made ineffective;			
b)  maker's paycheck is suspended or terminated			
c)  maker defaults in his other obligations;			
d)  any statement in maker's Application of Loan is found to be false or incorrect.
		
In case of legal collection of this note, the obligator shall be liable for 20% of attorney's fees (but not less than	₱ 1,000 ), plus litigation expenses and court costs. Venue of all suits shall be in Quezon City. In case of execution, right conferred under Rule 39, Sec. 12, of the Rules of Court is hereby waived.			
Holder may accept partial payment, reserving right of recourse against obligator(s) hereunder who hereby  waive 							
demand, presentment, and notice. This Note is assignable and any such assignment is deeded made with obligator(s)							
consent. No concession or liberality of Holder or this note shall be deemed a waived unless the same way be explicitly							
stated in writing and signed by the said Holder.							

Holder's duly authorized officer(s) shall have the sole right to a bi-monthly payroll deduction of ".$pdf->convertNumber((sched->amortAmount/2))."	(₱ ".number_format((sched->amortAmount/2), 2)." ) PESOS commencing	".date('Y')."	 for  a  period  of  ".sched->duration." Months.				
THIS PROMISSORY NOTE was signed and executed this ".date('d')."th day of ".date('F, Y').".

Co-Maker Right         
Thumbmark:       _________________________              ________________________      
                          CO-MAKER                               BORROWER             

    NOTE:	In case of a pre-termination of amount due, a twenty-five percent (25%) surcharge based on the total amount

                 _________________________              ________________________      
                    CO-MAKER'S CONSENT                           BORROWER

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
$pdf->Output('Promissory Note.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>




