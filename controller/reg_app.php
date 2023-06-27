<?php
require_once('../config/conn.php');
require_once('../controller/generate.php');

class Registry extends DatabaseConnection {

    //Personal Information
    function personal_add($code, $fname,$mname,$lname,$suffix,$nname,$age,$gender,$contact1,$mstatus,$dob1,$pob1,
    $block1,$street1,$phase1,$brgy1,$city1,$province1,$url,$residence1,$lwith1,
    $block2,$street2,$phase2,$brgy2,$city2,$province2,$residence2,$lwith2,$mothername,$mothercon,$fathername,$fathercon, $file){
        $sql = "INSERT INTO applicants_personal
        (applicant_code, firstname, middlename, lastname, suffix, nickname, age, gender, contact1, mstatus, dob1, pob1, 
        block1,street1,phase1,brgy1, city1,province1,map_url,residence1,lwith1,
        block2,street2,phase2,brgy2, city2,province2,residence2,lwith2,mothername,mothercon,fathername,fathercon,`file`,
        date_encoded) 
        VALUES
        ('$code', '$fname','$mname','$lname','$suffix','$nname','$age','$gender','$contact1','$mstatus','$dob1','$pob1',
        '$block1','$street1','$phase1','$brgy1','$city1','$province1','$url','$residence1','$lwith1',
        '$block2','$street2','$phase2','$brgy2','$city2','$province2','$residence2','$lwith2',
        '$mothername','$mothercon', '$fathername','$fathercon', '$file', CURRENT_DATE());";
        return mysqli_query($this->connect(), $sql);
    }

    function spouse_add($code, $sname,$scontact,$sdob,$spob,$saddress,$soccupation,$scompany){
        $sql = "INSERT INTO applicants_spouse
        (applicant_code, spouse_name, contact, s_dob, s_pob, s_address, s_occupation, s_company, date_encoded) 
        VALUES
        ('$code', '$sname','$scontact','$sdob','$spob','$saddress','$soccupation','$scompany', CURRENT_DATE())";
        return mysqli_query($this->connect(), $sql); 
    }
    //Work Information
    function work_add($code, $employer,$stype,$tob,$caddress,$alocation,$supname,$hrname,$dhired,$estatus,$msalary,$bname,$atmcard,
    $loan,$monthlysalary,$speriod,$osource,$specify){
        $esc_loan = $this->connect()->real_escape_string($loan);
        $sql = "INSERT INTO applicants_work
        (applicant_code, employer, sector_type, tob, com_address, a_location, sup_name, hr_number, date_hired, e_status, m_salary,
        bank_name, atm_card, loan, monthly_salary, s_period, other_source, specify, max_loanable_amt, date_encoded) 
        VALUES
        ('$code', '$employer','$stype','$tob','$caddress','$alocation','$supname','$hrname','$dhired','$estatus','$msalary',
        '$bname','$atmcard','$esc_loan','$monthlysalary','$speriod','$osource','$specify', 0, CURRENT_DATE())";
        return mysqli_query($this->connect(), $sql);
    }
     //Character Reference Information
    function reference_add($code,$purpose, $source, $fb){
        $sql = "INSERT INTO applicants_reference
        (applicant_code, loan_purpose, source,  fb_acct, date_encoded) 
        VALUES
        ('$code', '$purpose', '$source', '$fb', CURRENT_DATE())";
        return mysqli_query($this->connect(), $sql);
    }

    function getRadioVal($radio, $input){
        $val = "";
        if($radio == "Others" || $radio == "Yes")
            $val = $input;  
        else
            $val = $radio;
        return $val;
    }
    function addChiRef($code, $field, $name, $dob, $contact, $relation, $ta){
        if(intval($field) == 2){
            foreach($name as $key => $val){
                $n = $name[$key];
                $a = $dob[$key];
                $sql = "INSERT INTO applicants_child
                (applicant_code, child_name, child_dob, date_encoded) 
                VALUES
                ('$code','$n','$a', CURRENT_DATE())";
                mysqli_query($this->connect(), $sql);
            }
            return true;
        }else if(intval($field) == 4){
            foreach($name as $key => $val){
                $n = $name[$key];
                $c = $contact[$key];
                $r = $relation[$key];
                $t = $ta[$key];
                $sql = "INSERT INTO applicants_relative
                (applicant_code, relative_name, r_contact, r_relationship,r_ta) 
                VALUES
                ('$code','$n','$c', '$r', '$t')";
                mysqli_query($this->connect(), $sql);
            }
            return true;
        }
    }
    //View Client Data
    // function viewClient($id){
    //     $sql = "SELECT * FROM applicants_personal 
    //     INNER JOIN applicants_spouse ON applicants_personal.applicant_code = applicants_spouse.applicant_code
    //     INNER JOIN applicants_work ON applicants_spouse.applicant_code = applicants_work.applicant_code
    //     WHERE applicants_personal.applicant_id = '$id'";
    //     $result = mysqli_query($this->connect(),$sql);
    //     $fetch = $result->fetch_assoc();
    //     return $fetch;
    // }
   //Subquery SELECT * FROM tbl_rider WHERE Rider_ID IN (SELECT DISTINCT Rider_ID From tbl_worder WHERE Status = 3)
    function display($table){
        $sql = "SELECT * FROM $table";
        $result = mysqli_query($this->connect(), $sql);
        return $result;
    }
    //Dashboard
    function display_dashboard($dash){
        $sql = "SELECT COUNT(*) AS date_encoded FROM $dash WHERE date_encoded = CURRENT_DATE()";
        $result = mysqli_query($this->connect(), $sql);
        $fetch = $result->fetch_assoc();
        return $fetch; 
    }
    function getChildData($code, $table, $colName){
        $sql = "SELECT * FROM $table WHERE $colName = '$code'";
        return mysqli_query($this->connect(), $sql);
    }

    function getClientData($code, $table, $codeCol ,$colName){
        $sql = "SELECT $colName FROM $table WHERE $codeCol = '$code'";
        $result = mysqli_query($this->connect(), $sql);
        $row = $result->fetch_assoc();
        return  $row[$colName];
    }
        //Edit or Update
        //Personal Information
        function personal_update($code, $fname,$mname,$lname,$suffix,$nname,$age,$gender,$contact1,$mstatus,$dob1,$pob1,
        $block1,$street1,$phase1,$brgy1,$city1,$province1,$url,$residence1,$lwith1,
        $block2,$street2,$phase2,$brgy2,$city2,$province2,$residence2,$lwith2,$mothername,$mothercon,$fathername,$fathercon){
            $sql = "UPDATE applicants_personal SET 
            firstname = '$fname', middlename = '$mname', lastname = '$lname', 
            suffix = '$suffix', nickname = '$nname', age = '$age', gender = '$gender', 
            contact1 = '$contact1', mstatus = '$mstatus', dob1 = '$dob1', pob1 = '$pob1', 
            block1 = '$block1', street1 = '$street1', phase1 = '$phase1', brgy1 = '$brgy1', city1 = '$city1', 
            province1 = '$province1', map_url = '$url', residence1 = '$residence1', lwith1 = '$lwith1',
            block2 = '$block2', street2 = '$street2', phase2 = '$phase2', brgy2 = '$brgy2', city2 = '$city2', 
            province2 = '$province2', residence2 = '$residence2', lwith2 = '$lwith2', 
            mothername = '$mothername', mothercon = '$mothercon', fathername = '$fathername', fathercon = '$fathercon'
            WHERE applicant_code = '$code'";
            return mysqli_query($this->connect(), $sql);         
        }
       function spouse_update($code, $sname,$scontact,$sdob,$spob,$saddress,$soccupation,$scompany){
           $sql = "UPDATE applicants_spouse SET 
           spouse_name = '$sname', contact = '$scontact', s_dob = '$sdob', s_pob = '$spob', 
           s_address = '$saddress', s_occupation = '$soccupation', s_company = '$scompany'
           WHERE applicant_code = '$code'";
           return mysqli_query($this->connect(), $sql); 
       }
   
       function work_update($code, $employer,$stype,$tob,$caddress,$alocation,$supname,$hrname,$dhired,$estatus,$msalary,$bname,$atmcard,
       $loan,$monthlysalary,$speriod,$osource,$specify){
        $esc_loan = $this->connect()->real_escape_string($loan);
           $sql = "UPDATE applicants_work SET employer = '$employer', sector_type = '$stype', 
           tob = '$tob', com_address = '$caddress', a_location = '$alocation', sup_name = '$supname', 
           hr_number = '$hrname', date_hired = '$dhired', e_status = '$estatus', m_salary = '$msalary',
           bank_name = '$bname', atm_card = '$atmcard', loan = '$esc_loan', monthly_salary = '$monthlysalary', 
           s_period = '$speriod', other_source = '$osource', specify = '$specify' WHERE applicant_code = '$code'";
           return mysqli_query($this->connect(), $sql);
       }
       function reference_update($code, $purpose, $source, $fb){
        $sql = "UPDATE applicants_reference SET loan_purpose = '$purpose', source = '$source', fb_acct = '$fb'
        WHERE applicant_code = '$code'";
        return mysqli_query($this->connect(), $sql);
       }
       //Update
       function updateChiRef($code, $field, $name, $dob, $contact, $relation, $ta){
        if(intval($field) == 2){
            $sqlchild = "SELECT child_id FROM applicants_child WHERE applicant_code = '$code'";
            $results = mysqli_query($this->connect(), $sqlchild);

            foreach($results as $key => $val){
                $id = $val['child_id'];
                $sql = "UPDATE applicants_personal
                INNER JOIN applicants_child
                ON
                applicants_personal.applicant_code = applicants_child.applicant_code
                SET applicants_child.child_name = '$name[$key]', 
                applicants_child.child_dob = '$dob[$key]',
                applicants_child.date_encoded = CURRENT_DATE()
                WHERE applicants_child.applicant_code = '$code' 
                AND applicants_child.child_id = '$id'";
               // $sql = "UPDATE applicants_child SET child_name = '$name[$key]', child_dob = '$dob[$key]' WHERE child_id applicant_code = '$code'";
               mysqli_query($this->connect(), $sql);
            }
            return true;
        }else if(intval($field) == 4){
            $sqlrelative= "SELECT relative_id FROM applicants_relative WHERE applicant_code = '$code'";
            $results = mysqli_query($this->connect(), $sqlrelative);

            foreach($results as $key => $val){
                $id = $val['relative_id'];
                $n = $name[$key];
                $c = $contact[$key];
                $r = $relation[$key];
                $t = $ta[$key];
                $sql = "UPDATE applicants_relative SET relative_name = '$n', 
                r_contact = '$c', r_relationship = '$r', r_ta = '$t' WHERE applicant_code = '$code' AND relative_id = '$id' ";
                mysqli_query($this->connect(), $sql);
                }
                return true;
            }
        }  

        function checkId($id, $table){
            $sql ="SELECT * FROM $table WHERE applicant_code = '$id'";
            $result = mysqli_query($this->connect(), $sql);
                while($row = mysqli_fetch_assoc($result)){
                    return 1;
                }
            return 0;
        }
       //DELETE
        function deletePer($id){
           
            unlink('../assets/docs/'.$id.'/'.$id.'.pdf');
            rmdir('../assets/docs/'.$id);
            if(($this->checkId($id, 'applicants_personal') == 1) && ($this->checkId($id, 'applicants_spouse') == 1)
            && ($this->checkId($id, 'applicants_work') == 1) && ($this->checkId($id, 'applicants_reference') == 1)
            && ($this->checkId($id, 'applicants_child') == 1) && ($this->checkId($id, 'applicants_relative') == 1)){
                $sql = "DELETE applicants_personal, applicants_spouse, applicants_work, applicants_reference, applicants_child, applicants_relative
                FROM applicants_personal
                INNER JOIN applicants_spouse ON applicants_personal.applicant_code = applicants_spouse.applicant_code
                INNER JOIN applicants_work ON applicants_personal.applicant_code = applicants_work.applicant_code
                INNER JOIN applicants_reference ON applicants_personal.applicant_code = applicants_reference.applicant_code
                INNER JOIN applicants_child ON applicants_personal.applicant_code = applicants_child.applicant_code
                INNER JOIN applicants_relative ON applicants_personal.applicant_code = applicants_relative.applicant_code
                WHERE applicants_personal.applicant_code = '$id'";
                 return mysqli_query($this->connect(), $sql);
            }else{
                if(($this->checkId($id, 'applicants_spouse') == 0) && ($this->checkId($id, 'applicants_child') == 0) && ($this->checkId($id, 'applicants_relative') == 0)){
                    $sql = "DELETE applicants_personal, applicants_work, applicants_reference
                     FROM applicants_personal
                     INNER JOIN applicants_work ON applicants_personal.applicant_code = applicants_work.applicant_code
                     INNER JOIN applicants_reference ON applicants_personal.applicant_code = applicants_reference.applicant_code
                     WHERE applicants_personal.applicant_code = '$id'";
                      return mysqli_query($this->connect(), $sql);
                }else if(($this->checkId($id, 'applicants_child') == 0) && ($this->checkId($id, 'applicants_relative') == 0)){
                    $sql = "DELETE applicants_personal, applicants_work, applicants_spouse, applicants_reference
                     FROM applicants_personal
                     INNER JOIN applicants_work ON applicants_personal.applicant_code = applicants_work.applicant_code
                     INNER JOIN applicants_spouse ON applicants_personal.applicant_code = applicants_spouse.applicant_code
                     INNER JOIN applicants_reference ON applicants_personal.applicant_code = applicants_reference.applicant_code
                     WHERE applicants_personal.applicant_code = '$id'";
                      return mysqli_query($this->connect(), $sql);
                }else if(($this->checkId($id, 'applicants_spouse') == 0) && ($this->checkId($id, 'applicants_child') == 0)){
                    $sql = "DELETE applicants_personal, applicants_work, applicants_reference, applicants_relative
                     FROM applicants_personal
                     INNER JOIN applicants_work ON applicants_personal.applicant_code = applicants_work.applicant_code
                     INNER JOIN applicants_reference ON applicants_personal.applicant_code = applicants_reference.applicant_code
                     INNER JOIN applicants_relative ON applicants_personal.applicant_code = applicants_relative.applicant_code
                     WHERE applicants_personal.applicant_code = '$id'";
                      return mysqli_query($this->connect(), $sql);
                }else if(($this->checkId($id, 'applicants_spouse') == 0) && ($this->checkId($id, 'applicants_relative') == 0)){
                    $sql = "DELETE applicants_personal, applicants_work, applicants_reference, applicants_child
                     FROM applicants_personal
                     INNER JOIN applicants_work ON applicants_personal.applicant_code = applicants_work.applicant_code
                     INNER JOIN applicants_reference ON applicants_personal.applicant_code = applicants_reference.applicant_code
                     INNER JOIN applicants_child ON applicants_personal.applicant_code = applicants_child.applicant_code
                     WHERE applicants_personal.applicant_code = '$id'";
                      return mysqli_query($this->connect(), $sql);
                }else if($this->checkId($id, 'applicants_child') == 0){
                    $sql = "DELETE applicants_personal, applicants_spouse, applicants_work, applicants_reference, applicants_relative
                    FROM applicants_personal
                    INNER JOIN applicants_spouse ON applicants_personal.applicant_code = applicants_spouse.applicant_code
                    INNER JOIN applicants_work ON applicants_personal.applicant_code = applicants_work.applicant_code
                    INNER JOIN applicants_reference ON applicants_personal.applicant_code = applicants_reference.applicant_code
                    INNER JOIN applicants_relative ON applicants_personal.applicant_code = applicants_relative.applicant_code
                    WHERE applicants_personal.applicant_code = '$id'";
                    return mysqli_query($this->connect(), $sql);
                }else if(($this->checkId($id, 'applicants_reference') == 0) && ($this->checkId($id, 'applicants_relative') == 0)){
                    $sql = "DELETE applicants_personal, applicants_work, applicants_spouse, applicants_child
                    FROM applicants_personal
                    INNER JOIN applicants_work ON applicants_personal.applicant_code = applicants_work.applicant_code
                    INNER JOIN applicants_spouse ON applicants_personal.applicant_code = applicants_spouse.applicant_code
                    INNER JOIN applicants_child ON applicants_personal.applicant_code = applicants_child.applicant_code
                    WHERE applicants_personal.applicant_code = '$id'";
                    return mysqli_query($this->connect(), $sql);
                }
            }                 
        } 
        function displayData($id){
            $spouse = $this->checkId($id, 'applicants_spouse');
            if($spouse == 1){
                $sql ="SELECT * FROM applicants_personal 
                INNER JOIN applicants_work ON applicants_personal.applicant_code = applicants_work.applicant_code
                INNER JOIN applicants_spouse ON applicants_personal.applicant_code = applicants_spouse.applicant_code
                WHERE applicants_personal.applicant_code = '$id'";
                return mysqli_query($this->connect(), $sql);  
            }else{
                $sql ="SELECT * FROM applicants_personal
                INNER JOIN applicants_work ON applicants_personal.applicant_code = applicants_work.applicant_code
                WHERE applicants_personal.applicant_code = '$id'";
                return mysqli_query($this->connect(), $sql);  
            }
        }

       
    }
  
   
?>