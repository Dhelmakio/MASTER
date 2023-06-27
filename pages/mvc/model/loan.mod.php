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


    public function __construct(String $id){
        //get emp status, income sources, monthly net salary
        $sql = "SELECT e_status, max_loanable_amt, monthly_salary FROM applicants_work WHERE applicant_code= ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();

        $this->clientID = $id;
        $this->clientEmpStatus = $result['e_status'];
        $this->incomeSourceFlag = $result['max_loanable_amt'];
        $this->monthlyNetSal = $result['monthly_salary'];
        // $this->clientID = $id;

        if($this->incomeSourceFlag > 0 ){
            $this->clientSukli = Statics::$ATWOAFOURSUKLI;
            $this->incomeEarning = 'Multiple';
            // $this->moInterest = ;
        }else{
            $this->clientSukli = Statics::$AONEATHREESUKLI;
            $this->incomeEarning = 'Single';
        }

        $this->netLoanPerMonth = $this->monthlyNetSal - $this->clientSukli;

        $this->getSemiMonthly();
        $this->getBorrowingCount();
        $this->getBorrowingCount();
        $this->getBorrowingSum();
        $this->getSukli();
        $this->getBorrowCount();
    }

    public function getSemiMonthly(){
        $this->semiMonthlySal = $this->monthlyNetSal / 2;
    }

    public function getSukli(){
        $sql = "Select sum(monthly_amortization) from loan_applications where paid=0 and client_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->clientID]);
        $result = $stmt->fetchColumn();

        $this->monthlyAmortSum = $result;
    }

    public function getBorrowingCount(){
        $sql = "Select Count(client_id) from loan_applications where paid=1 and client_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->clientID]);
        $result = $stmt->fetchColumn();

        $this->borrowingHistCount = $result;
    }

    public function getBorrowCount(){
        $sql = "Select Count(client_id) from loan_applications where client_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->clientID]);
        $result = $stmt->fetchColumn();

        $this->borrowingCount = $result;
    }
    

    public function getBorrowingSum(){
        $sql = "Select Sum(monthly_amortization) from loan_applications where paid=0 and client_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->clientID]);
        $result = $stmt->fetchColumn();

        $this->borrowingSum = $result;
    }

    public function getInterestRate(){
        if(strtoupper($this->clientEmpStatus) == 'REGULAR'){
            if($this->borrowingHistCount > 1){
                $this->moInterest = Statics::$ATHREEAFOURINTERESTRATEREG;
                return Statics::$ATHREEAFOURINTERESTRATEREG;
            }else{
                $this->moInterest = Statics::$AONEATWOINTERESTRATEREG;
                return Statics::$AONEATWOINTERESTRATEREG;
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
    // public function checkEligible(String $id){
    //     $sql = "Select employment_status, max_loanable_amt, gross_monthly from employer where client_id= ?";
    //     $stmt = $this->connect()->prepare($sql);
    //     $stmt->execute([$id]);
    //     $result = $stmt->fetch();
    // }
}