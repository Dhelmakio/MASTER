<?php

class Schedule extends DbCon {
    private $clientID;
    public $amortFrequency;
    public $duration;
    public $startDate;
    public $addDate;
    public $amortAmount;
    public $principal;
    public $notarial;
    public $interestPer;
    public $interestVal;
    public $loanType;
    public $applicationDate;
    public $mop;
    public $applicantCode;
    public $salaryPeriod;
    public $date;
    public $ciRemarks;
    public $monthlyInterest;
    public $cashOut;
    public $effectiveDate;
    


    public function __construct(String $id){
        //get emp status, income sources, monthly net salary
        $sql = "SELECT *  FROM loan_applications WHERE contract_no= ? AND paid=0";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();

        $defaultMsg = "Successfully Reviewed by CI";

        $this->clientID = $id;
        $this->amortFrequency = $result['mop']??null;
        $this->duration = $result['loan_duration']??null;
        // $this->startDate = $result['date_flagged']??$result['ci_date']??null;
        $this->amortAmount = $result['monthly_amortization']??null;
        $this->principal = $result['loan_amount']??null;
        $this->notarial = $result['other_fee']??null;
        $this->interestPer = $result['udi_percentage']??null;
        $this->interestVal = $result['udi_value']??null;
        $this->loanType = $result['loan_type']??null;
        $this->mop = $result['mop']??null;
        $this->applicantCode = $result['client_id']??null;
        $this->applicationDate = $result['application_date']??null;
        $this->applicationDate = date_format(new DateTime($this->applicationDate), "F d, Y ");
        $this->ciRemarks = $result['ci_remarks']??$defaultMsg;
        $this->monthlyInterest = $result['udi_percentage']??null;
        $this->cashOut = $result['total_cashout']??null;
        $this->effectiveDate = $result['effective_date']??null;

        
        $this->mop();
        //$this->getSalaryPeriod();
        $this->loadTable();
        $this->loanType();
    }

    public function loadTable(){
        $content = "<div class='table-responsive'>
        <table class='table table-striped table-bordered table-hover'
            id='dataTables-example'>
            <thead>
                <tr>
                    <th>Payment No.</th>
                    <th>DATE</th>
                    <th>AMOUNT</th>
                </tr>
            </thead>
            <tbody>
                ".$this->loadTableRow()."
            </tbody>
        </table>
        </div>";
        return $content;
    }

    private function loadTableRow(){

        $content = "";

        //$date = new DateTime(date('Y-m-d'));
        $date = new DateTime($this->startDate);

        $newDuration;
        if($this->mop == 1){
            $newDuration = $this->duration;
        }else if($this->mop == 2){
            $newDuration = $this->duration * 2;
        }else if($this->mop == 3){
            $newDuration = $this->duration * 4;
        }

        for($index = 0; $index < $newDuration; $index++){

            //will add days for payment schedule based on mop
            date_add($date, date_interval_create_from_date_string($this->addDate." days"));

            $content .= "<tr>
                <td>".($index+1)."</td>
                <td>".date_format($date, "F d, Y")."</td>
                <td class='text-right'><strong>₱ ".number_format($this->amortAmount, 2)."</strong></td>
            </tr>";
        }
        $content .= "<tr>
        <td></td>
        <td class='text-right'><strong>TOTAL</strong></td>
        <td class='text-right' style='color:red'><strong>₱ ".number_format($this->principal, 2)."</strong></td>
        </tr>";

        return $content;
    }
    
    private function mop(){

        if ($this->salaryPeriod == "Every") {

        }else if ($this->salaryPeriod == "Weekly") {

        }else{
            $expSP = explode('/', $this->salaryPeriod);
        }

        if($this->amortFrequency == 1){
            $this->amortFrequency = "MONTH";
            $this->addDate = 30;
        }else if($this->amortFrequency == 2){
            $this->amortFrequency = "SEMI-MONTH";

            // $baseDate = new DateTime($a);
            // date_add($baseDate, date_interval_create_from_date_string("15 days"));
            
            // $this->date = date_format($baseDate, 'Y-m-d');
            // $this->addDate = 15;
            $this->addDate = 15;

        }else if($this->amortFrequency == 3){
            $this->amortFrequency = "WEEK";
            $this->addDate = 7;
        }

    }

    private function loanType(){
        if($this->loanType == 1){
            $this->loanType = "NEW";
        }else if($this->loanType == 2){
            $this->loanType = "RENEWAL";
        }else if($this->loanType == 3){
            $this->loanType = "RELOAN";
        }else if($this->loanType == 4){
            $this->loanType = "ADDITIONAL";
        }
    }
    
    // private function getSalaryPeriod(){
    //     $sql = "SELECT salary_period FROM applicants_work WHERE applicant_code = ?";
    //     $stmt = $this->connect()->prepare($sql);
    //     $stmt->execute([$this->applicantCode]);
    //     $result = $stmt->fetchColumn();
    //     $this->salaryPeriod = $result;
    // }

    public function setStartDate($date) {

        $sql = "UPDATE loan_applications SET effective_date = ?
        WHERE contract_no = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$date, $this->clientID]); 

        $this->startDate = $date;

    }

    public function setProcessStatus($status) {

        $sql = "UPDATE loan_applications SET process_status = ?
        WHERE contract_no = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$status, $this->clientID]); 

    }

    public function updateLoanDetails($terms, $lamt, $cashout, $amortAmount, $udiValue){
        $sql = "UPDATE loan_applications SET loan_duration = ?, loan_amount = ?, total_cashout = ?, monthly_amortization = ?, udi_value = ?
        WHERE contract_no = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$terms, $lamt, $cashout, $amortAmount, $udiValue, $this->clientID]); 
    }

    public function loadDataApproval($name, $clientEmpStatus, $incomeEarning, $borrowingHistCount, $collectionFee, $processingFee, $clientSukli, $outStandingBalance, $netLoanPerMonth){
        $content = '
        <div class="row">
        <div class="col-lg-12">
            <center>
                <h3><b>Loan Details</b></h3>
            </center>
            <hr>
        </div>
        <div class="col-lg-11">

            <div class="col-lg-3">
                <h4>Name of Borrower:</h4>
            </div>
            <div class="col-lg-6">
                <h4>
                    <b>'.$name.'</b>
                </h4>
            </div>

            <div class="col-lg-3" align="right">
                <h4>Date of Application:
                    <b>'.$this->applicationDate.'</b>
                </h4>
            </div>
            <div class="col-lg-3">
                <h4>Contract No.:</h4>
            </div>
            <div class="col-lg-3">
                <h4><b>'.$this->clientID.'</b></h4>
            </div>
        </div>
        <br><br>
        <div class="col-lg-11" style="font-size:15px;"><br>
            <div class="col-lg-3">Employment Status: </div>
            <div class="col-lg-3"><label>
                    '.$clientEmpStatus.'</label></div>
            <div class="col-lg-3">Promissory Note (PN): </div>
            <div class="col-lg-3"><label id="promissory_note">₱
                    '.number_format(floatval($this->principal), 2).'</label>
            </div>
            <div class="col-lg-3">Source of Income: </div>
            <div class="col-lg-3"><label>
                    '.strtoupper($incomeEarning).'</label>
            </div>
            <div class="col-lg-3">Interest (<label
                    id="interest_percent">'.$this->interestPer.'</label>%):
            </div>
            <div class="col-lg-3"><label id="udi_value">₱
                    '.number_format(floatval($this->interestVal), 2).'
            </div>
            <div class="col-lg-3">Borrowing History: </div>
            <div class="col-lg-3"><label>
                    '.$borrowingHistCount.'</label></div>
            <div class="col-lg-3">Notarial Fee: </div>
            <div class="col-lg-3"><label>₱
                    '.number_format(floatval($this->notarial), 2).'</label>
            </div>
            <div class="col-lg-3">Loan Type: </div>
            <div class="col-lg-3"><label>
                    '.$this->loanType.'</label>
            </div>
            <div class="col-lg-3">Collection Fee: </div>
            <div class="col-lg-3"><label id="collection_fee">₱
                    '. number_format((floatval($collectionFee)/100 * floatval($this->principal)), 2).'</label>
            </div>
            <div class="col-lg-3">Amortization Frequency: </div>
            <div class="col-lg-3"><label>
                    '.$this->amortFrequency.'LY </label>
            </div>
            <div class="col-lg-3">Processing Fee: </div>
            <div class="col-lg-3"><label id="processing_fee">₱
                    '.number_format((floatval($processingFee)/100 * floatval($this->principal)), 2).'</label>
            </div>
            <div class="col-lg-3">Loan Terms: </div>
            <div class="col-lg-3"><label
                    id="loan_terms">'.$this->duration.' MONTHS</label>
            </div>
            <div class="col-lg-3">Amortization Amount: </div>
            <div class="col-lg-3"><label id="amortization_amount">₱
                    '.number_format(floatval($this->amortAmount), 2).'</label>
            </div>
            <div class="col-lg-3">Minimum Sukli: </div>
            <div class="col-lg-3"><label>₱
                    '.number_format(floatval($clientSukli), 2).'
            </div>';

            $content .=  ($this->loanType == "RENEWAL") ? '<div class="col-lg-3">Outstanding Balance: </div>
            <div class="col-lg-3"><label id="outstanding_balance">₱
                    '.number_format(floatval($outStandingBalance), 2).'</label>
            </div>' : '';
           
            $content .= '
            <div class="col-lg-3">Net Loanable per month: </div>
            <div class="col-lg-3"><label>₱
                    '.number_format(floatval($netLoanPerMonth), 2).'</label>
            </div>
            <div class="col-lg-3">Total Cash Out: </div>
            <div class="col-lg-3"><label id="cash_out">₱
                    '.number_format(floatval($this->cashOut), 2).'</label>
            </div>
        </div>
        <div class="col-lg-12">
            <hr>
        </div>
        <center>
            <div class="orbit"
                style="display:none;top:50%;left:50%;position:absolute;"
                id="orbit">
            </div>
        </center>
        <div class="col-lg-12" align="left"><b><i style="color:green;">NOTE:
                    '.$this->ciRemarks.'</i></b><br><br>
        </div>

    </div>
        ';

    $this->setStartDate($this->effectiveDate);

    $content .= '
    <div class="row">
        <div class="col-lg-12">
            <center>
                <h3><b>Payment Schedules</b></h3>
            </center>
            <hr>
        </div>
        <div class="col-lg-12">
        '.$this->loadTable().'
        </div>
    </div>';
        return $content;
    }

}