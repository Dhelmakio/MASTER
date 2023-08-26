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
                $loan_spec = $_POST['loan_spec']??null;
                $tempLoan = "";
                $tempBusiness= "";
                $tempSource="";
                if($loan_spec == "Salary"){
                        $tempLoan = $loan_spec." Loan";
                }else if($loan_spec == "Personal"){
                        $tempLoan = $loan_spec." Loan";
                }else if($loan_spec == "Calamity"){
                        $tempLoan = $loan_spec." Loan";
                }else if($loan_spec == "Maternity"){
                        $tempLoan = $loan_spec." Loan";
                }else if($loan_spec == "Paternity"){
                        $tempLoan = $loan_spec." Loan";
                }else if($loan_spec == "Business"){
                        $tempLoan = $loan_spec." Loan";
                }else if($loan_spec == "Application/Gadget"){
                        $tempLoan = $loan_spec." Loan";
                }else if($loan_spec == "Vehicle"){
                        $tempLoan = $loan_spec." Loan";
                }else if($loan_spec == "Home"){
                        $tempLoan = $loan_spec." Loan";
                }else if($loan_spec == "Travel"){
                        $tempLoan = $loan_spec." Loan";
                }else if($loan_spec == "Credit"){
                        $tempLoan = $loan_spec." Card";
                }else if($loan_spec == "OFW"){
                        $tempLoan = $loan_spec." Loan";
                }else{
                        $tempLoan = $loan_spec;
                }

                if($_POST['business'] == "Firms"){
                        $tempBusiness = $_POST['business']." which offer professional services, such as accounting, legal, engineering, business consulting, customer service and architecture";
                }else if($_POST['business'] == "Transportation"){
                        $tempBusiness = $_POST['business']." companies, such as airlines, shipping, land tours and forwarder";
                }else if($_POST['business'] == "Entertainment,"){
                        $tempBusiness = $_POST['business']." such as artists and movie houses";
                }else if($_POST['business'] == "Hotels"){
                        $tempBusiness = $_POST['business']." & Restaurants";
                }else if($_POST['business'] == "Apartments"){
                        $tempBusiness = $_POST['business'];
                }else if($_POST['business'] == "Banks,"){
                        $tempBusiness = $_POST['business']." lending companies and other financial institutions";
                }else if($_POST['business'] == "Telecommunication"){
                        $tempBusiness = $_POST['business']." companies";
                }else if($_POST['business'] == "Event"){
                        $tempBusiness = $_POST['business']." planners";
                }else if($_POST['business'] == "Security"){
                        $tempBusiness = $_POST['business']." and janitorial services";
                }else if($_POST['business'] == "Media,"){
                        $tempBusiness = $_POST['business']." blogging and advertising";
                }else if($_POST['business'] == "Website"){
                        $tempBusiness = $_POST['business']." developers";
                }else if($_POST['business'] == "Graphic"){
                        $tempBusiness = $_POST['business']." designers";
                }else if($_POST['business'] == "Business"){
                        $tempBusiness = $_POST['business']." process outsourcing (BPO) companies";
                }else if($_POST['business'] == "Department"){
                        $tempBusiness = $_POST['business']." Store";
                }else if($_POST['business'] == "Distributor"){
                        $tempBusiness = $_POST['business'];
                }else if($_POST['business'] == "Real"){
                        $tempBusiness = $_POST['business']." Estate Dealer";
                }else if($_POST['business'] == "Car"){
                        $tempBusiness = $_POST['business']." Dealer";
                }else if($_POST['business'] == "Grocery"){
                        $tempBusiness = $_POST['business']." Store";
                }else if($_POST['business'] == "Car"){
                        $tempBusiness = $_POST['business']." Manufacturer";
                }else if($_POST['business'] == "Wine"){
                        $tempBusiness = $_POST['business']." and Softdrinks Producer";
                }else if($_POST['business'] == "Electronic"){
                        $tempBusiness = $_POST['business']." Parts Manufacturer";
                }else if($_POST['business'] == "Producer"){
                        $tempBusiness = $_POST['business']." of drugs and other medical products";
                }else if($_POST['business'] == "Agriculture"){
                        $tempBusiness = $_POST['business'];     
                }else if($_POST['business'] == "Mining"){
                        $tempBusiness = $_POST['business']." Company";
                }

                if($_POST['s_specify'] == "Business"){
                        $tempSource = $_POST['s_specify'];
                }else if($_POST['s_specify'] == "Allowance"){
                        $tempSource = $_POST['s_specify'];
                }else if($_POST['s_specify'] == "Pension,"){
                        $tempSource = $_POST['s_specify'];
                }else if($_POST['s_specify'] == "Commission"){
                        $tempSource = $_POST['s_specify'];
                }else if($_POST['s_specify'] == "Part"){
                        $tempSource = $_POST['s_specify']." time Job";
                }else if($_POST['s_specify'] == "Allotment"){
                        $tempSource = $_POST['s_specify'];
                }else if($_POST['s_specify'] == "Family"){
                        $tempSource = $_POST['s_specify']." Financial Support";
                }
                
                //personal tab 1
                $applicant->personal_update($_POST['id'], $_POST['fname']??null,$_POST['mname']??null,$_POST['lname']??null,$_POST['suffix']??null,$_POST['nname']??null,$_POST['gender']??null,
                $_POST['contact_num']??null,$_POST['m_status']??null,$_POST['dob']??null,(($_POST['pob_province']??null).', '.($_POST['pob_city']??null)), $_POST['blk']??null,$_POST['street']??null,$_POST['phase']??null,$_POST['brgy']??null,
                $_POST['city']??null,$_POST['province']??null,$_POST['coordinates']??null,$tor, $lw,$_POST['blk2']??null,$_POST['street2']??null,$_POST['phase2']??null,
                $_POST['brgy2']??null,$_POST['city2']??null,$_POST['province2']??null,$tor2, $lw2,$_POST['mother_name']??null,$_POST['mother_contact']??null,
                $_POST['father_name']??null,$_POST['father_contact']??null);
                //spouse tab 2
                $applicant->spouse_update($_POST['id'], $_POST['spouse_name']??null,$_POST['spouse_contact']??null,$_POST['spouse_dob']??null ,$spouse_pob, $spouse_address,
                $_POST['spouse_occupation']??null,$_POST['spouse_company']??null);
                //work tab 3
                $applicant->work_update($_POST['id'], $_POST['agency']??null,$_POST['sector']." Sector"??null, $tempBusiness ,$_POST['ca_company']??null,$_POST['location']??null,$_POST['supervisor']??null,
                $_POST['hr_number']??null,$_POST['date_hired']??null,$_POST['e_status']??null,$_POST['m_salary']??null,$_POST['bank']??null,$_POST['t_card']??null,(($loan != "None") ? $loan.'-'.$tempLoan.'-'.$_POST['sma']: $loan) ,$_POST['grosspay']??null,
                $_POST['netpay']??null,$_POST['os_income']??null, $tempSource??null);
                // //work tab 4
                $applicant->reference_update($_POST['id'], $tempPurp, $sources, $_POST['facebook']);
                
                //child
                $applicant->updateChiRef($_POST['id'], 2, $_POST['dep_child']??null, $_POST['dep_dob']??null, null, null, null);
                
                //reference
                $applicant->updateChiRef($_POST['id'], 4, $_POST['dep_relative']??null, null,$_POST['dep_rcontact']??null,$_POST['dep_relationship']??null, $_POST['dep_ta']??null);
       }
       echo json_encode(array("message" => "Successfully Updated.", "code" => $_POST['id']));
?>