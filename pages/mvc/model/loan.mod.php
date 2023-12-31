<?php

class Loan extends DbCon {
    private $clientID;
    public $clientEmpStatus;
    public $borrowingHistCount;
    private $incomeSourceFlag;
    public $monthlyNetSal;
    private $semiMonthlySal;
    public $clientSukli;
    public $netLoanPerMonth;
    public $incomeEarning;
    public $moInterest;
    public $outStandingBalance;
    public $contractNo;
    public $recLoanAmount;
    public $notarialFee;
    public $checkIfExistInLoanApplicaiton;
    public $monthlyLoanAmortization;
    public $otherMonthlyAmortization;
    public $collectionFee;
    public $processingFee;
    public $base; 

    public function __construct(String $id){
        //get emp status, income sources, monthly net salary
        $sql = "SELECT e_status, other_source, monthly_salary, loan FROM applicants_work WHERE applicant_code= ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();

        $this->clientID = $id;
        $this->clientEmpStatus = $result['e_status']??null;
        $this->incomeSourceFlag = $result['other_source']??null;
        $this->monthlyNetSal = $result['monthly_salary']??null;
        // $this->clientID = $id;

        if($this->incomeSourceFlag > 0 ){
            // $this->clientSukli = Statics::$ATWOAFOURSUKLI;
            $this->incomeEarning = 'Multiple';
            // $this->moInterest = ;
        }else{
            // $this->clientSukli = Statics::$AONEATHREESUKLI;
            $this->incomeEarning = 'Single';
        }
        
        ($this->incomeEarning == 'Single') ?  $this->clientSukli = $this->sukli('single') : $this->clientSukli = $this->sukli('multiple');

       
        

            
        $this->tempExp = $result['loan']??null;

        $this->tempExp = explode('-', $this->tempExp);

        $this->otherMonthlyAmortization = $this->tempExp[2]??0;


        //$this->getSemiMonthly();
        //$this->getBorrowingCount();
        $this->getBorrowHistoryBase();
        $this->getBorrowingCount();
        $this->getBorrowingSum();
        $this->getSukli();
        $this->getBorrowCount();
        $this->getRenewalBasesInfo();
        $this->getOutstandingBalance();
        $this->getNotarialFee();
        $this->getCollectionFee();
        $this->getProcessingFee();
        $this->checkIfExistInLoanApp();
        $this->getActiveLoanAmortization();

        
        if ($this->borrowingHistCount > $this->base){
            $this->netLoanPerMonth = 8000;
        } else {
            $this->netLoanPerMonth = $this->monthlyNetSal - $this->clientSukli - $this->otherMonthlyAmortization;
        }

    }

    public function getSemiMonthly(){
        $this->semiMonthlySal = ($this->monthlyNetSal / 2);
    }

    public function getSukli(){
        $sql = "SELECT SUM(monthly_amortization) FROM loan_applications WHERE paid=0 AND client_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->clientID]);
        $result = $stmt->fetchColumn();

        $this->monthlyAmortSum = $result;
    }

    public function getBorrowingCount(){
        
        $sql = "SELECT COUNT(client_id) FROM loan_applications WHERE paid=1 AND client_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->clientID]);
        $result = $stmt->fetchColumn();

        $this->borrowingHistCount = $result;
        //$this->borrowingHistCount = 6;
    }

    public function getActiveLoanAmortization(){
        $sql = "SELECT monthly_amortization FROM loan_applications WHERE paid=0 AND client_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->clientID]);

        $result = $stmt->fetchColumn();

        $this->monthlyLoanAmortization = $result;
    }

    public function getBorrowCount(){
        $sql = "SELECT COUNT(client_id) FROM loan_applications WHERE client_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->clientID]);
        $result = $stmt->fetchColumn();

        $this->borrowingCount = $result;
    }

    public function getBorrowHistoryBase(){
        $sql = "SELECT base FROM borrowing_history WHERE bh_id =?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([1]);
        $result = $stmt->fetchColumn();

        $this->base = $result;
    }
    

    public function getBorrowingSum(){
        $sql = "SELECT SUM(monthly_amortization) FROM loan_applications WHERE paid=0 AND client_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->clientID]);
        $result = $stmt->fetchColumn();

        $this->borrowingSum = $result;
    }

    public function getInterestRate(){
        if(strtoupper($this->clientEmpStatus) == 'REGULAR'){
            if($this->borrowingHistCount < 5){
                $this->moInterest = Statics::$AONEATWOINTERESTRATEREG;
                return Statics::$AONEATWOINTERESTRATEREG;
            }else{
                $this->moInterest = Statics::$AMORETHANFIVEBORROWINGHISTORY;
                return Statics::$AMORETHANFIVEBORROWINGHISTORY;
            }
        } elseif (strtoupper($this->clientEmpStatus) == 'CASUAL' || strtoupper($this->clientEmpStatus) == 'PROBATIONARY' || strtoupper($this->clientEmpStatus) == 'TRAINEE'){
            if($this->borrowingHistCount > 1){
                $this->moInterest = Statics::$ATHREEAFOURINTERESTRATECAS;
                return Statics::$ATHREEAFOURINTERESTRATECAS;
            }else{
                $this->moInterest = Statics::$AONEATWOINTERESTRATECAS;
                return Statics::$AONEATWOINTERESTRATECAS;
            }
        }
    }


    public function checkIfExistInLoanApp() {

        $sql = "SELECT client_id FROM loan_applications WHERE client_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->clientID]);
        $result = $stmt->fetchColumn();
        
        $this->checkIfExistInLoanApplicaiton = $result;
    }

    public function getNotarialFee(){
        $sql = "SELECT notarial_fee FROM fees WHERE notarial_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([1]);
        $result = $stmt->fetchColumn();
        
        $this->notarialFee = $result;
    }

    public function getCollectionFee(){
        $sql = "SELECT collection_percentage FROM `collection` WHERE collection_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([1]);
        $result = $stmt->fetchColumn();
        
        $this->collectionFee = $result;
    }

    public function getProcessingFee(){
        $sql = "SELECT processing_percentage FROM processing WHERE processing_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([1]);
        $result = $stmt->fetchColumn();
        
        $this->processingFee = $result;
    }

    public function sukli($sukli){
        $sql = "SELECT sukli_amount FROM sukli WHERE sukli_name = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$sukli]);
        $result = $stmt->fetchColumn();
        
        return $result;
    }

    //functions below are for renewal
    public function getRenewalBasesInfo(){
        $sql = "SELECT contract_no, loan_amount FROM loan_applications WHERE paid=0 AND client_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->clientID]);
        $result = $stmt->fetch();
        $this->contractNo = $result['contract_no']??null;
        $this->recLoanAmount = $result['loan_amount']??null;
    }

    public function getOutstandingBalance(){

        $sql = "SELECT SUM(amount) FROM payments WHERE contract_no = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->contractNo]);
        $result = $stmt->fetchColumn();
        
        //paras tinood na data
        $this->outStandingBalance = floatval($this->recLoanAmount) - floatval($result);

        //static data //dummy 
        // $this->outStandingBalance = floatval($this->recLoanAmount) - 3000;
    }

    // public function checkEligible(String $id){
    //     $sql = "Select employment_status, other_source, gross_monthly from employer where client_id= ?";
    //     $stmt = $this->connect()->prepare($sql);
    //     $stmt->execute([$id]);
    //     $result = $stmt->fetch();
    // }

}