<?php

require_once('../controller/reg_app.php');
        
        $applicant = new Registry();
        // $tor = $applicant->getRadioVal($_POST['tor']??null, $_POST['tor_spec']??null);
        // $lw = $applicant->getRadioVal($_POST['l_with']??null, $_POST['lw_spec']??null);
        // $tor2 = $applicant->getRadioVal($_POST['tor2']??null, $_POST['tor_spec2']??null);
        // $lw2 = $applicant->getRadioVal($_POST['l_with2']??null, $_POST['lw_spec2']??null);
       if($_POST['action'] == "update"){
                //if for update lang
                update($applicant);
       }else if($_POST['action'] == "archive"){

                //if for update pero e archive ang old info

                //e archive usa niya ang old info 
                $applicant->deletePer($_POST['id'], "update");
                // dapat after archiving dili e delete ang iyang info/row sa original table
                //after archiving sa old info ang recent nga ge pang input sa form is maoy e update ddto sa iyang row sa table
                update($applicant);
       }

       function update($applicant){

        $tor = (($_POST['tor'] == "Others") ? $_POST['tor_spec'] : $_POST['tor']);
                $lw = (($_POST['l_with'] == "Others") ? $_POST['lw_spec'] : $_POST['l_with']);
                $tor2 = ((($_POST['tor2']??null) == "Others") ? $_POST['tor_spec2']??null : $_POST['tor2']??null);
                $lw2 = ((($_POST['l_with2']??null) == "Others") ? $_POST['lw_spec2']??null : $_POST['l_with2']??null);
                $purposeLoan = (($_POST['purposeLoan'] == "Others") ? $_POST['specPurp'] : $_POST['purposeLoan']);
                $tempPurp = "";
                $sources = (($_POST['source'] == "Others") ? $_POST['specSource'] : $_POST['source']);
                if($purposeLoan == "Pay"){
                        $tempPurp = $purposeLoan." Bills";
                }else if($purposeLoan == "Vehicle"){
                        $tempPurp = $purposeLoan." maintenance and fees";
                }else if($purposeLoan == "Special"){
                        $tempPurp = $purposeLoan." Occassion";
                }else if($purposeLoan == "Debt"){
                        $tempPurp = $purposeLoan." Consolodation";
                }else if($purposeLoan == "General"){
                        $tempPurp = $purposeLoan." Expenses"; 
                }else{
                        $tempPurp = $purposeLoan; 
                }
                $spouse_pob = (($_POST['spob_province']??null).', '.($_POST['spob_city']??null));
                $spouse_address = (($_POST['spouse_province']??null).', '.($_POST['spouse_city']??null).', '.($_POST['spouse_brgy']??null));
                
                $loan = $_POST['loan'];
                $tempLoan = "";
                if($loan == "Salary"){
                        $tempLoan = $loan." Loan";
                }else if($loan == "Personal"){
                        $tempLoan = $loan." Loan";
                }else if($loan == "Calamity"){
                        $tempLoan = $loan." Loan";
                }else if($loan == "Maternity"){
                        $tempLoan = $loan." Loan";
                }else if($loan == "Paternity"){
                        $tempLoan = $loan." Loan";
                }else if($loan == "Business"){
                        $tempLoan = $loan." Loan";
                }else if($loan == "Application/Gadget"){
                        $tempLoan = $loan." Loan";
                }else if($loan == "Vehicle"){
                        $tempLoan = $loan." Loan";
                }else if($loan == "Home"){
                        $tempLoan = $loan." Loan";
                }else if($loan == "Travel"){
                        $tempLoan = $loan." Loan";
                }else if($loan == "Credit"){
                        $tempLoan = $loan." Card";
                }else if($loan == "OFW"){
                        $tempLoan = $loan." Loan";
                }else{
                        $tempLoan = $loan;
                }

                
                //personal tab 1
                $applicant->personal_update($_POST['id'], $_POST['fname']??null,$_POST['mname']??null,$_POST['lname']??null,$_POST['suffix']??null,$_POST['nname']??null,$_POST['age']??null,$_POST['gender']??null,
                $_POST['contact_num']??null,$_POST['m_status']??null,$_POST['dob']??null,(($_POST['pob_province']??null).', '.($_POST['pob_city']??null)), $_POST['blk']??null,$_POST['street']??null,$_POST['phase']??null,$_POST['brgy']??null,
                $_POST['city']??null,$_POST['province']??null,$_POST['coordinates']??null,$tor, $lw,$_POST['blk2']??null,$_POST['street2']??null,$_POST['phase2']??null,
                $_POST['brgy2']??null,$_POST['city2']??null,$_POST['province2']??null,$tor2, $lw2,$_POST['mother_name']??null,$_POST['mother_contact']??null,
                $_POST['father_name']??null,$_POST['father_contact']??null);
                //spouse tab 2
                $applicant->spouse_update($_POST['id'], $_POST['spouse_name']??null,$_POST['spouse_contact']??null,$_POST['spouse_dob']??null ,$spouse_pob, $spouse_address,
                $_POST['spouse_occupation']??null,$_POST['spouse_company']??null);
                //work tab 3
                $applicant->work_update($_POST['id'], $_POST['agency']??null,$_POST['sector']." Sector"??null,$_POST['business']??null ,$_POST['ca_company']??null,$_POST['location']??null,$_POST['supervisor']??null,
                $_POST['hr_number']??null,$_POST['date_hired']??null,$_POST['e_status']??null,$_POST['m_salary']??null,$_POST['bank']??null,$_POST['t_card']??null,(($tempLoan != "None") ? $tempLoan.'-'.$_POST['loan_spec'] : $tempLoan)??null,$_POST['ms_salary']??null,
                $_POST['s_period']??null,$_POST['os_income']??null,$_POST['s_specify']??null);
                // //work tab 4
                $applicant->reference_update($_POST['id'], $tempPurp, $sources, $_POST['facebook']);
                
                //child
                $applicant->updateChiRef($_POST['id'], 2, $_POST['dep_child']??null, $_POST['dep_dob']??null, null, null, null);
                
                //reference
                $applicant->updateChiRef($_POST['id'], 4, $_POST['dep_relative']??null, null,$_POST['dep_rcontact']??null,$_POST['dep_relationship']??null, $_POST['dep_ta']??null);
       }
       echo json_encode(array("message" => "Successfully Updated.", "code" => $_POST['id']));
?>