<?php

require_once('../controller/generate.php');
require_once('../controller/reg_app.php');



$applicant = new Registry();
$generate = new Generate();
$code = $generate->generateId("AMG", "001", "applicants_personal", "applicant_code");
//$tor = $applicant->getRadioVal($_POST['tor']??null, $_POST['tor_spec']??null);
//$lw = $applicant->getRadioVal($_POST['l_with']??null, $_POST['lw_spec']??null);
//$tor2 = $applicant->getRadioVal($_POST['tor2']??null, $_POST['tor_spec2']??null);
//$lw2 = $applicant->getRadioVal($_POST['l_with2']??null, $_POST['lw_spec2']??null);
$tor = (($_POST['tor'] == "Others") ? strtoupper($_POST['tor_spec']) : $_POST['tor']);
$lw = (($_POST['l_with'] == "Others") ? strtoupper($_POST['lw_spec']) : $_POST['l_with']);
$tor2 = ((($_POST['tor2']??null) == "Others") ? strtoupper($_POST['tor_spec2']??null) : $_POST['tor2']??null);
$lw2 = ((($_POST['l_with2']??null) == "Others") ? strtoupper($_POST['lw_spec2']??null) : $_POST['l_with2']??null);
$purposeLoan = (($_POST['loan_purpose'] == "Others") ? strtoupper($_POST['specPurp']) : $_POST['loan_purpose']);
$sources = (($_POST['source'] == "Others") ? strtoupper($_POST['specSource']) : $_POST['source']);
$spouse_pob = (($_POST['spob_province']??null).', '.($_POST['spob_city']??null));
$spouse_address = (($_POST['spouse_province']??null).', '.($_POST['spouse_city']??null).', '.($_POST['spouse_brgy']??null));

$l = $_POST['loan']??null; 
$o = $_POST['loan_spec']??null;
$a = $_POST['sma']??null;

$loan = $l.'-'.$o.'-'.$a;

//personal tab 1
$applicant->personal_add($code, strtoupper($_POST['fname']??null), strtoupper($_POST['mname']??null),strtoupper($_POST['lname']??null) , strtoupper($_POST['suffix']??null),strtoupper($_POST['nname']??null),$_POST['gender']??null,
$_POST['contact_num']??null,$_POST['m_status']??null,$_POST['dob']??null, (($_POST['pob_province']??null).', '.($_POST['pob_city']??null)),strtoupper($_POST['blk'])??null,strtoupper($_POST['street']??null),strtoupper($_POST['phase']??null),strtoupper($_POST['brgy']??null),
$_POST['city']??null,$_POST['province']??null,$_POST['coordinates']??null,$tor, $lw,((($_POST['blk2']??null) == null) ? strtoupper($_POST['blk']??null) : strtoupper($_POST['blk2']??null)),((($_POST['street2']??null) == null) ? strtoupper($_POST['street']??null) : strtoupper($_POST['street2']??null)),((($_POST['phase2']??null) == null) ? strtoupper($_POST['phase']??null) : strtoupper($_POST['phase2']??null)),
((($_POST['brgy2']??null) == null) ? strtoupper($_POST['brgy']??null) : strtoupper($_POST['brgy2']??null)), ((($_POST['city2']??null) == null) ? $_POST['city'] : $_POST['city2']??null), ((($_POST['province2']??null) == null) ? $_POST['province'] : $_POST['province2']??null),$tor2??$tor, $lw2??$lw,strtoupper($_POST['mother_name']??null),$_POST['mother_contact']??null,
strtoupper($_POST['father_name']??null),$_POST['father_contact']??null, $_POST['myFile']??null);

if(!file_exists("../assets/docs")){
    mkdir("../assets/docs");
}

$attach1 = addslashes($_FILES['myFile']['tmp_name']);
if(mkdir("../assets/docs/".$code."/",0777)){
                    
    $attach1=addslashes($_FILES['myFile']['name']);
    $file_tmp1= $_FILES['myFile']['tmp_name'];
    $info = pathinfo($_FILES['myFile']['name']);
    $ext1 = $info['extension']; 
    $newname = $code.".".$ext1;
    $target = '../assets/docs/'.$code.'/'.$newname;

    $folderPath = '../assets/docs/'.$code.'/';

    $image_parts = explode(";base64,", $_POST['signature_image']);
 
    $image_type_aux = explode("image/", $image_parts[0]);
    
    $image_type = $image_type_aux[1];
    
    $image_base64 = base64_decode($image_parts[1]);
    
    $file = $folderPath . $code . '.'.$image_type;

    if(file_exists('../assets/docs/'.$code.'/'.$newname)){
        unlink('../assets/docs/'.$code.'/'.$newname);
        rmdir('../assets/docs/'.$code);
        move_uploaded_file($file_tmp1, $target);
        file_put_contents($file, $image_base64);
    }else{
        move_uploaded_file($file_tmp1, $target);
        file_put_contents($file, $image_base64);
    }
}

//spouse tab 2
if($_POST['spouse_name'] != null){
    $applicant->spouse_add($code, strtoupper($_POST['spouse_name']??null),$_POST['spouse_contact']??null,$_POST['spouse_dob']??null ,$spouse_pob, $spouse_address,
    strtoupper($_POST['spouse_occupation']??null),strtoupper($_POST['spouse_company']??null));
}

//work tab 3
if($_POST['agency'] != null){
$applicant->work_add($code, strtoupper($_POST['agency'])??null,$_POST['sector']??null,$_POST['business']??null ,strtoupper($_POST['ca_company']??null),strtoupper($_POST['location']??null),strtoupper($_POST['supervisor']??null),
$_POST['hr_number']??null,$_POST['date_hired']??null,$_POST['e_status']??null,$_POST['m_salary']??null,strtoupper($_POST['bank']??null),strtoupper($_POST['t_card']??null), (($_POST['loan'] != "No") ? $loan : $_POST['loan'])??null, $_POST['ms_salary']??null,
$_POST['s_period']??null,$_POST['os_income']??null,$_POST['s_specify']??null);
}

// //work tab 4
if($sources!= null){
$applicant->reference_add($code, $purposeLoan, $sources, $_POST['facebook']);
}

//child
$child = $_POST['dep_child']??null;
$relative = $_POST['dep_relative']??null;

if($child != null){
    $applicant->addChiRef($code, 2, $child, $_POST['dep_dob']??null, null, null, null); 
}
//reference
if($relative != null){
    $applicant->addChiRef($code, 4, $relative, null, $_POST['dep_rcontact']??null, $_POST['dep_relationship']??null, $_POST['dep_ta']??null);
}

echo json_encode(array("message" => "Successfully Registered.", "code" => $code));


?>