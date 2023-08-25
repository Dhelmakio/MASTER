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


}