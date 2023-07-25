<?php

class ClientData extends DbCon {
    private $clientID;
    public $amortFrequency;
    private $duration;
    private $startDate;
    private $addDate;
    private $amortAmount;
    public $principal;
    public $notarial;
    public $interestPer;
    public $interestVal;
    public $loanType;
    public $applicationDate;


    public function __construct(String $id){
        //get emp status, income sources, monthly net salary
        $sql = "SELECT * FROM loan_applications 
        INNER JOIN applicants_personal 
        ON applicants_personal.applicant_code = loan_applications.client_id
        INNER JOIN applicants_work 
        ON applicants_work.applicant_code = loan_applications.client_id
        INNER JOIN applicants_spouse 
        ON applicants_spouse.applicant_code = loan_applications.client_id
        INNER JOIN applicants_relative 
        ON applicants_relative.applicant_code = loan_applications.client_id
        INNER JOIN applicants_reference 
        ON applicants_reference.applicant_code = loan_applications.client_id
        WHERE loan_applications.client_id = ? AND loan_applications.paid = 0";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();

        $this->clientID = $id;

        //personal info
        $this->clientName = $result['lastname'].' '.$result['firstname'].' '.$result['middlename']??null.' '.$result['suffix']??null;
        $this->clientAddress = $result['province1'].', '.$result['city1'].', '.$result['brgy1'].', '.$result['street1'];
        $this->gender = $result['gender'];
        $this->dateBirth = date_format(new DateTime($result['dob1']), 'F d, Y');
        $this->placeBirth = $result['pob1'];
        $this->mstatus = $result['mstatus'];
        $this->contact = $result['contact1'];

        //family background
        $this->motherName = $result['mothername'];
        $this->motherContact = $result['mothercon'];
        $this->fatherName = $result['fathername'];
        $this->fatherContact = $result['fathercon'];
        $this->lw = $result['lwith1'];

        //spouse info
        $this->spouseName = $result['spouse_name'];
        $this->spouseContact = $result['contact'];
        $this->spouseBirth = $result['s_dob'];
        $this->spouseBirthAddress = $result['s_pob'];
        $this->spouseAddress = $result['s_address'];
        $this->spouseOccupation = $result['s_occupation'];

        //employment info
        $this->agency = $result['employer'];
        $this->sector = $result['sector_type'];
        $this->top = $result['tob'];
        $this->companyAddress = $result['com_address'];
        $this->location = $result['a_location'];
        $this->supervisorName = $result['sup_name'];
        $this->supervisorContact = $result['hr_number'];
        $this->dateHired = $result['date_hired'];
        $this->estatus = $result['e_status'];
        $this->mos = $result['m_salary'];
        $this->bank = $result['bank_name'];
        $this->toac = $result['atm_card'];
        $this->loan = $result['loan'];
        $this->gross = $result['monthly_salary'];
        $this->osi = $result['other_source'];
        $this->specify = $result['specify'];




        // $this->amortFrequency = $result['mop']??null;
        // $this->duration = $result['loan_duration']??null;
        // $this->startDate = $result['date_flagged']??$result['ci_date']??null;
        // $this->amortAmount = $result['monthly_amortization']??null;
        // $this->principal = $result['loan_amount']??null;
        // $this->notarial = $result['other_fee']??null;
        // $this->interestPer = $result['udi_percentage']??null;
        // $this->interestVal = $result['udi_value']??null;
        // $this->loanType = $result['loan_type']??null;
        // $this->applicationDate = $result['application_date']??null;
        // $this->applicationDate = date_format(new DateTime($this->applicationDate), "F d, Y ");

        $this->mop();
        $this->loadTable();
        $this->loanType();

    }

    public function loadTable(){
        $content = "<div class='table-responsive'>
        <table class='table table-striped table-bordered table-hover'
            id='dataTables-example'>
            <thead>
                <tr>
                    <th>".$this->amortFrequency."</th>
                    <th>DATE</th>
                    <th>AMOUNT</th>
                    <th>STATUS</th>
                    <th>DATE PAID</th>
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
        $date = new DateTime($this->startDate);
        for($index = 0; $index < $this->duration; $index++){

            //will add days for payment schedule based on mop
            date_add($date, date_interval_create_from_date_string($this->addDate." days"));

            $content .= "<tr>
                <td>".($index+1)."</td>
                <td>".date_format($date, "F d, Y ")."</td>
                <td>₱ ".number_format($this->amortAmount, 2)."</td>
                <td><span class='btn-sm btn-warning'>PENDING</span></td>
                <td>-- -- ----</td>
            </tr>";
        }
        $content .= "<tr>
        <td></td>
        <td></td>
        <td></td>
        <td class='text-right'>TOTAL</td>
        <td>₱ ".number_format($this->principal, 2)."</td>
        </tr>";

        return $content;
    }
    
    private function mop(){
        if($this->amortFrequency == 1){
            $this->amortFrequency = "MONTH";
            $this->addDate = 30;
        }else if($this->amortFrequency == 2){
            $this->amortFrequency = "SEMI-MONTH";
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

    
}