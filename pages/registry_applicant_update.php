<?php
session_start();

include('../config/conn.php');
require "../controller/reg_app.php";
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}
    
$edit = new Registry();
$id;
if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    header('location:reg_applicantion.php');
}

if($_SESSION['user_id']){
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lending System - Applicant Information Registry</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/startmin.css" rel="stylesheet">
    <link href="../css/multi-step.css" rel="stylesheet">
    <link href="../css/toast/beautyToast.css" rel="stylesheet">
    <link href="../css/loader.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->


</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include('nav.php');?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Update Applicant Information Registry</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel tabbed-panel panel-default">
                            <div class="panel-body">
                                <div class="tab-content">
                                    <!-- Page 1 -->
                                    <div class="tab-pane fade in active" id="tab-default-1">
                                        <!-- <h3>STEP 1: Personal Information I</h3> -->
                                        <div class="panel panel-primary">
                                            <!-- <div class="panel-heading">
                                                Personal Information
                                            </div> -->
                                            <div class="panel-body">
                                                <!-- MultiStep Form -->
                                                <div class="container-fluid" id="grad1">
                                                    <div class="row justify-content-center mt-0">
                                                        <div class="col-12">
                                                            <div class="card">
                                                                <p class="pull-left" id="p-label">Fill all form field to
                                                                    go to next
                                                                    step</p>
                                                                <div class="row">
                                                                    <div class="col-lg-12 mx-0">
                                                                        <form id="msform">

                                                                            <!-- progressbar -->
                                                                            <input type="hidden" name="id" id=""
                                                                                value="<?= $_GET['id']; ?>">
                                                                            <input type="hidden" name="action"
                                                                                id="action" value="<?= $_GET['id']; ?>">
                                                                            <ul id="progressbar">
                                                                                <li class="active" id="personal">
                                                                                    <strong>Personal
                                                                                        Information</strong>
                                                                                </li>
                                                                                <li id="account">
                                                                                    <strong>Spouse Information</strong>
                                                                                </li>
                                                                                <li id="payment">
                                                                                    <strong>Work Information</strong>
                                                                                </li>
                                                                                <li id="confirm"><strong>Character
                                                                                        Reference<br><i>
                                                                                            <h6>3 Relatives & 2
                                                                                                Co-workers</h6>
                                                                                        </i>
                                                                                    </strong>
                                                                                </li>
                                                                            </ul>
                                                                            <!-- fieldsets -->
                                                                            <fieldset class="text-left">
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Last Name</label>
                                                                                        <input class="form-control"
                                                                                            name="lname" id="lname"
                                                                                            placeholder="Last Name"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'lastname')??null ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Middle Name</label>
                                                                                        <input class="form-control"
                                                                                            name="mname"
                                                                                            placeholder="Middle Name"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'middlename')??null ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>First Name</label>
                                                                                        <input class="form-control"
                                                                                            name="fname"
                                                                                            placeholder="First Name"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'firstname')??null ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Suffix</label>

                                                                                        <select class="form-control"
                                                                                            name="suffix">
                                                                                            <option value="" disabled
                                                                                                selected>
                                                                                                SELECT
                                                                                            </option>
                                                                                            <?php 
                                                                                            $suffix = $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'suffix')??null;
                                                                                            $suffixSet = ['SR', 'JR', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X'];

                                                                                            foreach($suffixSet as $key => $val){
                                                                                                $op = ($suffix == $val) ? '<option selected value='.$suffix.'>'.$val.'</option>' : '<option value='.$val.'>'.$val.'</option>';
                                                                                             echo $op;
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Nickname</label>
                                                                                        <input class="form-control"
                                                                                            name="nname"
                                                                                            placeholder="Nickname"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'nickname')??null ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Gender</label>
                                                                                        <select class="form-control"
                                                                                            name="gender">
                                                                                            <option value="" disabled
                                                                                                selected>
                                                                                                SELECT
                                                                                            </option>
                                                                                            <?php 
                                                                                            $gender = $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'gender')??null;
                                                                                            $genderSet = ['Male', 'Female', 'Others'];

                                                                                            foreach($genderSet as $key => $val){
                                                                                                $op = ($gender == $val) ? '<option selected value='.$gender.'>'.$val.'</option>' : '<option value='.$val.'>'.$val.'</option>';
                                                                                             echo $op;
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Date of birth</label>
                                                                                        <input type="date" name="dob"
                                                                                            class="form-control"
                                                                                            placeholder="Date of birth"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'dob1')??null; ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Marital
                                                                                            Status</label>
                                                                                        <select class="form-control"
                                                                                            name="m_status"
                                                                                            id="m_status"
                                                                                            onchange="showSpouse(this.value)">
                                                                                            <option value="" disabled
                                                                                                selected=1>
                                                                                                SELECT
                                                                                            </option>
                                                                                            <?php 
                                                                                            $mstatus = $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'mstatus')??null;
                                                                                            $statusSet = ['Single', 'Married', 'Widowed', 'Separated'];
                                                                                            foreach($statusSet as $key => $val){
                                                                                                $op = ($mstatus == $val) ? '<option selected value='.$mstatus.'>'.$mstatus.'</option>' : '<option value='.$val.'>'.$val.'</option>';
                                                                                            echo $op;
                                                                                            }

                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Mobile -->
                                                                                <!-- <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Contact No.</label>
                                                                                        <input name="contact_num"
                                                                                            maxlength="11"
                                                                                            class="form-control"
                                                                                            placeholder="Mobile No."
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'contact1')??null ?>">
                                                                                    </div>
                                                                                </div> -->

                                                                                <!-- <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Place of
                                                                                            birth ( Province )</label>
                                                                                        <input name="pob"
                                                                                            class="form-control"
                                                                                            placeholder="Place of birth"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'pob1')??null; ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Place of
                                                                                            birth ( City )</label>
                                                                                        <input name="pob"
                                                                                            class="form-control"
                                                                                            placeholder="Place of birth"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'pob1')??null; ?>">
                                                                                    </div>
                                                                                </div>-->
                                                                                <input type="hidden" id="db_pob1"
                                                                                    value="<?php  $pob1 = $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'pob1')??null;
                                                                                $res =  explode(", ", $pob1); echo $res[0]; ?>">
                                                                                <input type="hidden" id="db_pobcity"
                                                                                    value="<?php echo $res[1]; ?>">
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Place of
                                                                                            birth ( Province )</label>
                                                                                        <select name="pob_province"
                                                                                            id="pob_province" required
                                                                                            class="form-control input-set-1"
                                                                                            onchange="populate('pob_city', '', this.value, '')">

                                                                                            <select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label> Place of
                                                                                            birth ( City ) </label>
                                                                                        <select name="pob_city"
                                                                                            id="pob_city" required
                                                                                            class="form-control input-set-1">
                                                                                            <option selected disabled>
                                                                                                SELECT</option>
                                                                                            <select>
                                                                                    </div>
                                                                                </div><br>
                                                                                <!--All goods-->
                                                                                <div class="col-lg-12">
                                                                                    <h3><b>Present Address</b></h3>
                                                                                </div>
                                                                                <!-- <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Province</label>
                                                                                        <input name="province"
                                                                                            class="form-control"
                                                                                            placeholder="Province"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'province1')??null; ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>City /
                                                                                            Municipality</label>
                                                                                        <input name="city"
                                                                                            class="form-control"
                                                                                            placeholder="City/Municipality"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'city1')??null; ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Barangay</label>
                                                                                        <input name="brgy"
                                                                                            class="form-control"
                                                                                            placeholder="Barangay"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'brgy1')??null; ?>">
                                                                                    </div>
                                                                                </div> -->
                                                                                <input type="hidden" id="db_province"
                                                                                    value="<?php echo $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'province1')??null;?>">
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Province</label>
                                                                                        <select name="province"
                                                                                            class="form-control input-set-1"
                                                                                            id="province" required
                                                                                            onchange="populate('city', '', this.value)">
                                                                                            <option value="" selected
                                                                                                disabled>SELECT</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="hidden" id="db_city"
                                                                                    value="<?php echo $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'city1')??null;?>">
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>City /
                                                                                            Municipality</label>
                                                                                        <select name="city"
                                                                                            class="form-control input-set-1"
                                                                                            id="city" required
                                                                                            onchange="populate('brgy', 'province', this.value)">
                                                                                            <option value="" selected
                                                                                                disabled>SELECT</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="hidden" id="db_brgy"
                                                                                    value="<?php echo $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'brgy1')??null;?>">
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Barangay</label>
                                                                                        <select name="brgy"
                                                                                            class="form-control input-set-1"
                                                                                            required id="brgy">
                                                                                            <option value="" selected
                                                                                                disabled>SELECT</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Blk / Lot No. /
                                                                                            House No.</label>
                                                                                        <input name="blk"
                                                                                            class="form-control"
                                                                                            placeholder="Block/ Lot No./ House"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'block1')??null; ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Street</label>
                                                                                        <input name="street"
                                                                                            class="form-control"
                                                                                            placeholder="Street"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'street1')??null; ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Phase/Zone</label>
                                                                                        <input name="phase"
                                                                                            class="form-control"
                                                                                            placeholder="Phase/Zone"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'phase1')??null; ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group">
                                                                                        <label>*Provide Map URL</label>
                                                                                        <a href="https://www.google.com/maps/place/San+Fernando,+Pampanga/@15.0650161,120.6456575,12073m/data=!3m1!1e3!4m15!1m8!3m7!1s0x3396f79f47a8aadb:0x2c4be1dddb81922a!2sSan+Fernando,+Pampanga!3b1!8m2!3d15.0593937!4d120.6567054!16zL20vMDZwZ3pu!3m5!1s0x3396f79f47a8aadb:0x2c4be1dddb81922a!8m2!3d15.0593937!4d120.6567054!16zL20vMDZwZ3pu?hl=en-US&entry=ttu"
                                                                                            target="_blank">
                                                                                            <label for="">
                                                                                                ( Open Google Map <i
                                                                                                    class="fa fa-map"></i>
                                                                                                )
                                                                                            </label>
                                                                                        </a>
                                                                                        <input name="coordinates"
                                                                                            id="map_url" required
                                                                                            class="form-control input-set-1"
                                                                                            placeholder="Provide Map URL"
                                                                                            onchange="viewMap('map_url')"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'map_url')??null; ?>">

                                                                                    </div>
                                                                                </div>
                                                                                <!--type of residence and living with-->
                                                                                <!-- <div class="col-lg-12">
                                                                                    <div class="form-group">
                                                                                        <label>Type of
                                                                                            Residency:</label>
                                                                                        <div class="radio">
                                                                                            <?php $tor = $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'residence1')??null; ?>
                                                                                            <label>
                                                                                                <input type="radio"
                                                                                                    name="tor"
                                                                                                    id="owned"
                                                                                                    value="Owned"
                                                                                                    <?= ($tor == "Owned") ? 'checked' : '' ?>
                                                                                                    onclick="enableField('owned', 'specific')">Owned
                                                                                                &nbsp;
                                                                                            </label>
                                                                                            <label>
                                                                                                <input type="radio"
                                                                                                    name="tor"
                                                                                                    id="renting"
                                                                                                    value="Renting"
                                                                                                    <?= ($tor == "Renting") ? 'checked' : '' ?>
                                                                                                    onclick="enableField('renting', 'specific')">Renting/Leasing
                                                                                                &nbsp;
                                                                                            </label>
                                                                                            <label>
                                                                                                <input type="radio"
                                                                                                    name="tor"
                                                                                                    id="specify"
                                                                                                    value="Specify"
                                                                                                    <?= ($tor != "Owned" || $tor != "Renting") ? '' : 'checked' ?>
                                                                                                    onclick="enableField('specify', 'specific')">Others
                                                                                                (Specify):
                                                                                            </label>
                                                                                            <input type="text"
                                                                                                name="tor_spec"
                                                                                                id="specific"
                                                                                                class="form-group"
                                                                                                disabled="true"
                                                                                                <?= ($tor != "Owned" || $tor != "Renting") ? $tor : '' ?>>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group">
                                                                                        <label>Living With:</label>
                                                                                        <div class="radio">
                                                                                            <?php $lwith1 = $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'lwith1')??null; ?>
                                                                                            <label>
                                                                                                <input type="radio"
                                                                                                    name="l_with"
                                                                                                    id="parent"
                                                                                                    value="Parents"
                                                                                                    <?= ($lwith1 == "Parents") ? 'checked' : '' ; ?>
                                                                                                    onclick="enableField('parent', 'spec')">Parents
                                                                                                &nbsp;
                                                                                            </label>
                                                                                            <label>
                                                                                                <input type="radio"
                                                                                                    name="l_with"
                                                                                                    id="relative"
                                                                                                    value="Relatives"
                                                                                                    <?= ($lwith1 == "Relatives") ? 'checked' : '' ; ?>
                                                                                                    onclick="enableField('relative', 'spec')">Relatives
                                                                                                &nbsp;
                                                                                            </label>
                                                                                            <label>
                                                                                                <input type="radio"
                                                                                                    name="l_with"
                                                                                                    id="wife"
                                                                                                    value="Wife/Husband"
                                                                                                    <?= ($lwith1 == "Wife/Husband") ? 'checked' : '' ; ?>
                                                                                                    onclick="enableField('wife', 'spec')">Wife/Husband/Live-in
                                                                                                Partner
                                                                                                &nbsp;
                                                                                            </label>
                                                                                            <label>
                                                                                                <input type="radio"
                                                                                                    name="l_with"
                                                                                                    id="coworker"
                                                                                                    value="Co-Worker"
                                                                                                    <?= ($lwith1 == "Co-Worker") ? 'checked' : '' ; ?>
                                                                                                    onclick="enableField('coworker', 'spec')">Co-Worker
                                                                                                &nbsp;
                                                                                            </label>
                                                                                            <label>
                                                                                                <input type="radio"
                                                                                                    name="l_with"
                                                                                                    id="others"
                                                                                                    value="Others"
                                                                                                    <?= ($lwith1 != "Parents" || $lwith1 != "Relatives" || $lwith1 != "Wife/Husband" || $lwith1 != "Co-Worker" ) ? '' : 'checked' ; ?>
                                                                                                    onclick="enableField('others', 'spec')">Others
                                                                                                (Specify):
                                                                                            </label>
                                                                                            <input type="text"
                                                                                                name="lw_spec" id="spec"
                                                                                                class="form-group"
                                                                                                disabled="true"
                                                                                                value="<?= ($lwith1 != "Parents" || $lwith1 != "Relatives" || $lwith1 != "Wife/Husband" || $lwith1 != "Co-Worker" ) ? '' : $lwith1 ; ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                </div> -->
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Type of
                                                                                            Residency:</label>
                                                                                        <select
                                                                                            class="form-control input-set-1"
                                                                                            required id="tor1"
                                                                                            onchange="lwChange(this, 'tor_spec')"
                                                                                            name="tor">
                                                                                            <option value="" selected
                                                                                                disabled>SELECT</option>
                                                                                            <?php 

                                                                                                $tor = $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'residence1')??null;
                                                                                                $torSet = ['Owned', 'Renting', 'Others'];
                                                                                                foreach($torSet as $key => $val){
                                                                                                    $op1 = ($tor == $val) ? '<option selected value='.$tor.'>'.$tor.'</option>' : '<option value='.$val.'>'.$val.'</option>';
                                                                                                echo $op1;
                                                                                                }

                                                                                                ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <label for="">Others (Specify):
                                                                                    </label>
                                                                                    <input type="text" name="tor_spec"
                                                                                        id="tor_spec"
                                                                                        class="form-control input-set-1" <?php 
                                                                                            if($tor == "Owned"){
                                                                                                echo "disabled";
                                                                                            }else if($tor == "Renting"){
                                                                                                echo "disabled";
                                                                                            }else{
                                                                                                echo 'value="'.$tor.'"';
                                                                                            }
                                                                                        ?>>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Living With:</label>
                                                                                        <select
                                                                                            class="form-control input-set-1"
                                                                                            required
                                                                                            onchange="lwChange(this, 'spec')"
                                                                                            name="l_with" id="lw1">
                                                                                            <option value="" selected
                                                                                                disabled>SELECT</option>

                                                                                            <?php 

                                                                                                $lw = $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'lwith1')??null;
                                                                                                $lwSet = ['Parents', 'Relatives', 'Wife/Husband/Live-in Partner', 'Co-Worker', 'Others'];
                                                                                                foreach($lwSet as $key => $val){
                                                                                                    $op2 = ($lw == $val) ? '<option selected value='.$lw.'>'.$lw.'</option>' : '<option value='.$val.'>'.$val.'</option>';
                                                                                                echo $op2;
                                                                                                }

                                                                                                ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <label for="">Others (Specify):
                                                                                    </label>
                                                                                    <input type="text" name="lw_spec"
                                                                                        id="spec"
                                                                                        class="form-control input-set-1" <?php 
                                                                                            if($lw == "Parents"){
                                                                                                echo "disabled";
                                                                                            }else if($lw == "Relatives"){
                                                                                                echo "disabled";
                                                                                            }else if($lw == "Wife/Husband/Live-in Partner"){
                                                                                                echo "disabled";
                                                                                            }else if($lw == "Co-Worker"){
                                                                                                echo "disabled";
                                                                                            }else{
                                                                                                echo 'value="'.$lw.'"';
                                                                                            }
                                                                                        ?>>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <h3><b>Permanent Address</b>
                                                                                    </h3>
                                                                                </div>
                                                                                <!-- <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Province</label>
                                                                                        <select name="province"
                                                                                            class="form-control input-set-1"
                                                                                            id="province" required
                                                                                            onchange="populate('city', '', this.value)">
                                                                                            <option value="" selected
                                                                                                disabled>SELECT</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>City /
                                                                                            Municipality</label>
                                                                                        <select name="city"
                                                                                            class="form-control input-set-1"
                                                                                            id="city" required
                                                                                            onchange="populate('brgy', 'province', this.value)">
                                                                                            <option value="" selected
                                                                                                disabled>SELECT</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Barangay</label>
                                                                                        <select name="brgy"
                                                                                            class="form-control input-set-1" required
                                                                                            id="brgy">
                                                                                            <option value="" selected
                                                                                                disabled>SELECT</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div> -->
                                                                                <input type="hidden" id="db_province2"
                                                                                    value="<?php echo $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'province2')??null;?>">
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Province</label>
                                                                                        <select name="province2"
                                                                                            class="form-control input-set-1"
                                                                                            id="province2" required
                                                                                            onchange="populate('city2', '', this.value)">
                                                                                            <option value="" selected
                                                                                                disabled>
                                                                                                SELECT</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="hidden" id="db_city2"
                                                                                    value="<?php echo $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'city2')??null;?>">
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>City /
                                                                                            Municipality</label>
                                                                                        <select name="city2"
                                                                                            class="form-control input-set-1"
                                                                                            id="city2" required
                                                                                            onchange="populate('brgy2', 'province2', this.value)">
                                                                                            <option value="" selected
                                                                                                disabled>
                                                                                                SELECT</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="hidden" id="db_brgy2"
                                                                                    value="<?php echo $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'brgy2')??null;?>">
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Barangay</label>
                                                                                        <select name="brgy2" id="brgy2"
                                                                                            required
                                                                                            class="form-control input-set-1">
                                                                                            <option value="" selected
                                                                                                disabled>
                                                                                                SELECT</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Blk / Lot No. /
                                                                                            House No.</label>
                                                                                        <input name="blk2"
                                                                                            class="form-control"
                                                                                            placeholder="Block/ Lot No./ House"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'block2')??null ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Street</label>
                                                                                        <input name="street2"
                                                                                            class="form-control"
                                                                                            placeholder="Street"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'street2')??null ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Phase/Zone</label>
                                                                                        <input name="phase2"
                                                                                            class="form-control"
                                                                                            placeholder="Phase/Zone"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'phase2')??null ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <!-- <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Barangay</label>
                                                                                        <input name="brgy2"
                                                                                            class="form-control"
                                                                                            placeholder="Barangay"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'brgy2')??null ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>City /
                                                                                            Municipality</label>
                                                                                        <input name="city2"
                                                                                            class="form-control"
                                                                                            placeholder="City/Municipality"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'city2')??null ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Province</label>
                                                                                        <input name="province2"
                                                                                            class="form-control"
                                                                                            placeholder="Province"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'province2')??null ?>">
                                                                                    </div>
                                                                                </div> -->

                                                                                <!-- <div class="col-lg-12">
                                                                                    <div class="form-group">
                                                                                        <label>Type of
                                                                                            Residency:</label>
                                                                                        <?php $tor2 = $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'residence2')??null ?>
                                                                                        <div class="radio">
                                                                                            <label>
                                                                                                <input type="radio"
                                                                                                    name="tor2"
                                                                                                    id="owned1"
                                                                                                    value="Owned"
                                                                                                    <?= ($tor2 == "Owned") ? 'checked' : '' ?>
                                                                                                    onclick="enableField('owned1', 'specific1')">Owned
                                                                                                &nbsp;
                                                                                            </label>
                                                                                            <label>
                                                                                                <input type="radio"
                                                                                                    name="tor2"
                                                                                                    id="renting1"
                                                                                                    value="Renting/leasing"
                                                                                                    <?= ($tor2 == "Renting") ? 'checked' : '' ?>
                                                                                                    onclick="enableField('renting1', 'specific1')">Renting/Leasing
                                                                                                &nbsp;
                                                                                            </label>
                                                                                            <label>
                                                                                                <input type="radio"
                                                                                                    name="tor2"
                                                                                                    id="specify1"
                                                                                                    value="Specify"
                                                                                                    <?= ($tor2 != "Owned" || $tor != "Renting") ? '' : 'checked' ?>
                                                                                                    onclick="enableField('specify1', 'specific1')">Others
                                                                                                (Specify):
                                                                                            </label>
                                                                                            <input type="text"
                                                                                                name="tor_spec2"
                                                                                                id="specific1"
                                                                                                class="form-group"
                                                                                                disabled="true"
                                                                                                value="<?= ($tor2 != "Owned" || $tor != "Renting") ? '' : $tor2 ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group">
                                                                                        <label>Living With:</label>
                                                                                        <?php $lwith2 = $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'lwith2')??null ?>
                                                                                        <div class="radio">
                                                                                            <label>
                                                                                                <input type="radio"
                                                                                                    name="l_with2"
                                                                                                    id="parent1"
                                                                                                    value="Parents"
                                                                                                    <?= ($lwith2 == "Parents") ? 'checked' : '' ?>
                                                                                                    onclick="enableField('parent1', 'spec1')">Parents
                                                                                                &nbsp;
                                                                                            </label>
                                                                                            <label>
                                                                                                <input type="radio"
                                                                                                    name="l_with2"
                                                                                                    id="relative1"
                                                                                                    value="Relatives"
                                                                                                    <?= ($lwith2 == "Relatives") ? 'checked' : '' ?>
                                                                                                    onclick="enableField('relative1', 'spec1')">Relatives
                                                                                                &nbsp;
                                                                                            </label>
                                                                                            <label>
                                                                                                <input type="radio"
                                                                                                    name="l_with2"
                                                                                                    id="wife1"
                                                                                                    value="Wife/Husband"
                                                                                                    <?= ($lwith2 == "Wife/Husband") ? 'checked' : '' ?>
                                                                                                    onclick="enableField('wife1', 'spec1')">Wife/Husband/Live-in
                                                                                                Partner
                                                                                                &nbsp;
                                                                                            </label>
                                                                                            <label>
                                                                                                <input type="radio"
                                                                                                    name="l_with2"
                                                                                                    id="coworker1"
                                                                                                    value="Co-Worker"
                                                                                                    <?= ($lwith2 == "Co-Worker") ? 'checked' : '' ?>
                                                                                                    onclick="enableField('coworker1', 'spec1')">Co-Worker
                                                                                                &nbsp;
                                                                                            </label>
                                                                                            <label>
                                                                                                <input type="radio"
                                                                                                    name="l_with2"
                                                                                                    id="others1"
                                                                                                    value="Others"
                                                                                                    <?= ($lwith2 != "Parents" || $lwith2 != "Relatives" || $lwith2 != "Wife/Husbands" || $lwith2 != "Co-Worker") ? '' : 'checked' ?>
                                                                                                    onclick="enableField('others1', 'spec1')">Others
                                                                                                (Specify):
                                                                                            </label>
                                                                                            <input type="text"
                                                                                                name="lw_spec2"
                                                                                                id="spec1"
                                                                                                class="form-group"
                                                                                                disabled="true"
                                                                                                value="<?= ($lwith2 != "Parents" || $lwith2 != "Relatives" || $lwith2 != "Wife/Husbands" || $lwith2 != "Co-Worker") ? '' : 'checked' ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                </div> -->
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Type of
                                                                                            Residency:</label>
                                                                                        <select
                                                                                            class="form-control input-set-1"
                                                                                            required id="tor2"
                                                                                            onchange="lwChange(this, 'tor_spec2')"
                                                                                            name="tor2">
                                                                                            <option value="" selected
                                                                                                disabled>
                                                                                                SELECT</option>
                                                                                            <?php 

                                                                                                $tor = $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'residence2')??null;
                                                                                                $torSet = ['Owned', 'Renting', 'Others'];
                                                                                                foreach($torSet as $key => $val){
                                                                                                    $op1 = ($tor == $val) ? '<option selected value='.$tor.'>'.$tor.'</option>' : '<option value='.$val.'>'.$val.'</option>';
                                                                                                echo $op1;
                                                                                                }

                                                                                                ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <label for="">Others (Specify):
                                                                                    </label>
                                                                                    <input type="text" name="tor_spec2"
                                                                                        id="tor_spec2"
                                                                                        class="form-control input-set-1" <?php 
                                                                                            if($tor == "Owned"){
                                                                                                echo "disabled";
                                                                                            }else if($tor == "Renting"){
                                                                                                echo "disabled";
                                                                                            }else{
                                                                                                echo 'value="'.$tor.'"';
                                                                                            }
                                                                                        ?>>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Living With:</label>
                                                                                        <select
                                                                                            class="form-control input-set-1"
                                                                                            required
                                                                                            onchange="lwChange(this, 'spec2')"
                                                                                            name="l_with" id="lw2">
                                                                                            <option value="" selected
                                                                                                disabled>
                                                                                                SELECT</option>
                                                                                            <?php 

                                                                                                $lw = $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'lwith1')??null;
                                                                                                $lwSet = ['Parents', 'Relatives', 'Wife/Husband/Live-in Partner', 'Co-Worker', 'Others'];
                                                                                                foreach($lwSet as $key => $val){
                                                                                                    $op2 = ($lw == $val) ? '<option selected value='.$lw.'>'.$lw.'</option>' : '<option value='.$val.'>'.$val.'</option>';
                                                                                                echo $op2;
                                                                                                }

                                                                                                ?>
                                                                                        </select>

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <label for="">Others (Specify):
                                                                                    </label>
                                                                                    <input type="text" name="lw_spec"
                                                                                        id="spec2"
                                                                                        class="form-control input-set-1" <?php 
                                                                                            if($lw == "Parents"){
                                                                                                echo "disabled";
                                                                                            }else if($lw == "Relatives"){
                                                                                                echo "disabled";
                                                                                            }else if($lw == "Wife/Husband/Live-in Partner"){
                                                                                                echo "disabled";
                                                                                            }else if($lw == "Co-Worker"){
                                                                                                echo "disabled";
                                                                                            }else{
                                                                                                echo 'value="'.$lw.'"';
                                                                                            }
                                                                                        ?>>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <hr>
                                                                                </div>
                                                                                <div class="col-lg-8">
                                                                                    <div class="form-group">
                                                                                        <label>Mother's
                                                                                            Name:</label>
                                                                                        <input name="mother_name"
                                                                                            class="form-control"
                                                                                            placeholder="Mother's name"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'mothername')??null ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Contact No.</label>
                                                                                        <input type="text"
                                                                                            name="mother_contact"
                                                                                            class="form-control"
                                                                                            minlength="11"
                                                                                            maxlength="11"
                                                                                            placeholder="Mobile number (e.g. 09123456789)"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'mothercon')??null ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-8">
                                                                                    <div class="form-group">
                                                                                        <label>Father's
                                                                                            Name:</label>
                                                                                        <input name="father_name"
                                                                                            class="form-control"
                                                                                            placeholder="Father's name"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'fathername')??null ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Contact No.</label>
                                                                                        <input type="text"
                                                                                            name="father_contact"
                                                                                            class="form-control"
                                                                                            minlength="11"
                                                                                            maxlength="11"
                                                                                            placeholder="Mobile number (e.g. 09123456789)"
                                                                                            value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'fathercon')??null ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <!-- separator -->
                                                                                <div class="col-lg-12">
                                                                                    <hr>
                                                                                </div><button type="button" name="next"
                                                                                    class="next btn btn-primary pull-right">
                                                                                    Next <i
                                                                                        class="fa fa-arrow-right"></i></button>
                                                                            </fieldset>
                                                                            <fieldset>
                                                                                <div id="div_spouse" class="text-left">
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label>Name of
                                                                                                Spouse/Live-in</label>
                                                                                            <input name="spouse_name"
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                placeholder="Name of spouse"
                                                                                                value="<?= $edit->getClientData($id, 'applicants_spouse', 'applicant_code', 'spouse_name')??null ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label>Contact
                                                                                                No.</label>
                                                                                            <input name="spouse_contact"
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                placeholder="Contact No."
                                                                                                value="<?= $edit->getClientData($id, 'applicants_spouse', 'applicant_code', 'contact')??null ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Date of
                                                                                                birth</label>
                                                                                            <input type="date"
                                                                                                name="spouse_dob"
                                                                                                class="form-control"
                                                                                                placeholder="Date of birth"
                                                                                                value="<?= $edit->getClientData($id, 'applicants_spouse', 'applicant_code', 's_dob')??null ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Place of
                                                                                                birth</label>
                                                                                            <input name="spouse_pob"
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                placeholder="Place of birth"
                                                                                                value="<?= $edit->getClientData($id, 'applicants_spouse', 'applicant_code', 's_pob')??null ?>">
                                                                                        </div>
                                                                                    </div> -->
                                                                                    <input type="hidden" id="db_spob1"
                                                                                        value="<?php  $pob2 = $edit->getClientData($id, 'applicants_spouse', 'applicant_code', 's_pob')??null;
                                                                                    $res2 =  explode(", ", $pob2); echo $res2[0]; ?>">
                                                                                    <input type="hidden" id="db_spob2"
                                                                                        value="<?php echo $res2[1]; ?>">
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Place of birth
                                                                                                (Province)</label>
                                                                                            <select name="spob_province"
                                                                                                class="form-control input-set-2"
                                                                                                required
                                                                                                id="spob_province"
                                                                                                onchange="populate('spob_city', '', this.value)"
                                                                                                required>
                                                                                                <option value=""
                                                                                                    selected disabled>
                                                                                                    SELECT</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Place of birth (City
                                                                                                /
                                                                                                Municipality)</label>
                                                                                            <select name="spob_city"
                                                                                                class="form-control input-set-2"
                                                                                                required id="spob_city">
                                                                                                <option value=""
                                                                                                    selected disabled>
                                                                                                    SELECT</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label>Present
                                                                                                Address</label>
                                                                                            <input name="spouse_address"
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                placeholder="Present Address"
                                                                                                value="<?= $edit->getClientData($id, 'applicants_spouse', 'applicant_code', 's_address')??null ?>">
                                                                                        </div>
                                                                                    </div> -->
                                                                                    <input type="hidden"
                                                                                        id="db_sprovince"
                                                                                        value="<?php  $province = $edit->getClientData($id, 'applicants_spouse', 'applicant_code', 's_address')??null;
                                                                                    $res3 =  explode(", ", $province); echo $res3[0]; ?>">
                                                                                    <input type="hidden" id="db_scity"
                                                                                        value="<?php echo $res3[1]; ?>">
                                                                                    <input type="hidden" id="db_sbrgy"
                                                                                        value="<?php echo $res3[2]; ?>">
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Present Address
                                                                                                (Province)</label>
                                                                                            <select
                                                                                                name="spouse_province"
                                                                                                class="form-control input-set-2"
                                                                                                required
                                                                                                id="spouse_province"
                                                                                                onchange="populate('spouse_city', '', this.value)">
                                                                                                <option value=""
                                                                                                    selected disabled>
                                                                                                    SELECT</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Present Address (City
                                                                                                /
                                                                                                Municipality)</label>
                                                                                            <select name="spouse_city"
                                                                                                class="form-control input-set-2"
                                                                                                required
                                                                                                id="spouse_city"
                                                                                                onchange="populate('spouse_brgy', 'spouse_province', this.value)">
                                                                                                <option value=""
                                                                                                    selected disabled>
                                                                                                    SELECT</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Present Address
                                                                                                (Barangay)</label>
                                                                                            <select name="spouse_brgy"
                                                                                                id="spouse_brgy"
                                                                                                class="form-control input-set-2">
                                                                                                <option value=""
                                                                                                    selected disabled>
                                                                                                    SELECT</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label>Occupation</label>
                                                                                            <input type="text"
                                                                                                name="spouse_occupation"
                                                                                                class="form-control"
                                                                                                placeholder="Occupation"
                                                                                                value="<?= $edit->getClientData($id, 'applicants_spouse', 'applicant_code', 's_occupation')??null ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label>Company Name</label>
                                                                                            <input name="spouse_company"
                                                                                                class="form-control"
                                                                                                type="text"
                                                                                                placeholder="Company"
                                                                                                value="<?= $edit->getClientData($id, 'applicants_spouse', 'applicant_code', 's_company')??null ?>">
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- separator -->
                                                                                    <div class="col-lg-12">
                                                                                        <hr>
                                                                                    </div>
                                                                                    <div class="col-lg-12"
                                                                                        align="right">
                                                                                        <button type="button"
                                                                                            class="btn btn-success"
                                                                                            onclick="addDependent()">
                                                                                            <i class="fa fa-fw"
                                                                                                aria-hidden="true"
                                                                                                title="Copy to use user-plus">&#xf234</i>
                                                                                            Add Children Names
                                                                                        </button></br></br>
                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <div id="div_dep">
                                                                                            <?php $cs =  $edit->getChildData($id, 'applicants_child', 'applicant_code');
                                                                                             foreach ($cs as $key => $val){
                                                                                                echo '<div style="margin-left:16px" id="'.($key+1).'"><div class="col-lg-3"><div class="form-group"><label>Name of Children</label><input name="dep_child[]" type="text" value="'.$val['child_name'].'" class="form-control" placeholder="Name of Children"></div></div><div class="col-lg-2"><div class="form-group"><label>Age</label><input type="date" name="dep_dob[]" value="'.$val['child_dob'].'" class="form-control" placeholder="Age"></div></div><div class="col-lg-1"><button type="button" class="btn btn-danger btn-circle" onclick="removeDependent('.($key+1).')"><i class="fa fa-trash-o"></i></button></div></div>';
                                                                                            }
                                                                                            ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <button type="button" name="next"
                                                                                    class="next btn  btn-primary text-center pull-right"
                                                                                    style="margin-left: 10px;">
                                                                                    Next <i
                                                                                        class="fa fa-arrow-right"></i></button>
                                                                                <button type="button" name="previous"
                                                                                    class="previous btn btn-default text-center pull-right"
                                                                                    value="Previous"> <i
                                                                                        class="fa fa-arrow-left"></i>
                                                                                    Prev</button>

                                                                            </fieldset>
                                                                            <fieldset>
                                                                                <div class="text-left">
                                                                                    <div class="col-lg-8">
                                                                                        <div class="form-group">
                                                                                            <label>Employer/Agency
                                                                                                Name</label>
                                                                                            <input name="agency"
                                                                                                class="form-control"
                                                                                                placeholder="Employer/Agency Name"
                                                                                                value="<?= $edit->getClientData($id, 'applicants_work', 'applicant_code', 'employer')??null ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label>Choose
                                                                                                Sector:</label>
                                                                                            <div class="radio">
                                                                                                <label>
                                                                                                    <?php $sector = $edit->getClientData($id, 'applicants_work', 'applicant_code', 'sector_type')??null; ?>
                                                                                                    <input type="radio"
                                                                                                        <?= ($sector == "Private Sector") ? 'checked' : '' ; ?>
                                                                                                        name="sector"
                                                                                                        value="<?= $sector; ?>">Private
                                                                                                    Sector
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        name="sector"
                                                                                                        <?= ($sector == "Government Sector") ? 'checked' : '' ; ?>
                                                                                                        value="<?= $sector; ?>">Government
                                                                                                    Sector
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div> -->
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Choose Sector</label>
                                                                                            <select class="form-control"
                                                                                                name="sector">
                                                                                                <option value=""
                                                                                                    disabled selected>
                                                                                                    SELECT
                                                                                                </option>
                                                                                                <?php 
                                                                                            $sector = $edit->getClientData($id, 'applicants_work', 'applicant_code', 'sector_type')??null;
                                                                                            $sectorSet = ["Private Sector", "Government Sector"];

                                                                                            foreach($sectorSet as $key => $val){
                                                                                                $sec = ($sector == $val) ? '<option selected value='.$sector.'>'.$val.'</option>' : '<option value='.$val.'>'.$val.'</option>';
                                                                                             echo $sec;
                                                                                            }
                                                                                            ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12"></div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Type of
                                                                                                Business</label>
                                                                                            <input name="business"
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                placeholder="Type of Business"
                                                                                                value="<?= $edit->getClientData($id, 'applicants_work', 'applicant_code', 'tob')??null ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Complete Address of
                                                                                                Company</label>
                                                                                            <input type="text"
                                                                                                name="ca_company"
                                                                                                class="form-control"
                                                                                                placeholder="Complete Address of Company"
                                                                                                value="<?= $edit->getClientData($id, 'applicants_work', 'applicant_code', 'com_address')??null ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Assigned
                                                                                                Location</label>
                                                                                            <input name="location"
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                placeholder="Assigned Location"
                                                                                                value="<?= $edit->getClientData($id, 'applicants_work', 'applicant_code', 'a_location')??null ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Name of
                                                                                                Supervisor/COOR/Supervisor</label>
                                                                                            <input name="supervisor"
                                                                                                class="form-control"
                                                                                                type="text"
                                                                                                placeholder="Name of Supervisor/COOR/Supervisor"
                                                                                                value="<?= $edit->getClientData($id, 'applicants_work', 'applicant_code', 'sup_name')??null ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Contact Number of
                                                                                                HR/COOR/Supervisor</label>
                                                                                            <input type="text"
                                                                                                name="hr_number"
                                                                                                class="form-control"
                                                                                                placeholder="Contact Number of HR/COOR/Supervisor"
                                                                                                value="<?= $edit->getClientData($id, 'applicants_work', 'applicant_code', 'hr_number')??null ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Date Hired</label>
                                                                                            <input name="date_hired"
                                                                                                type="date"
                                                                                                class="form-control"
                                                                                                placeholder="Date Hired"
                                                                                                value="<?= $edit->getClientData($id, 'applicants_work', 'applicant_code', 'date_hired')??null ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- <div class="col-lg-12">
                                                                                        <div class="form-group">
                                                                                            <label>Employment
                                                                                                Status:</label>
                                                                                            <div class="radio">
                                                                                                <?php $status = $edit->getClientData($id, 'applicants_work', 'applicant_code', 'e_status')??null; ?>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        name="e_status"
                                                                                                        <?= ($status == "Regular")?'checked':''; ?>
                                                                                                        value="Regular">Regular
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        name="e_status"
                                                                                                        <?= ($status == "Probationary")?'checked':''; ?>
                                                                                                        value="Probationary">Probationary
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        name="e_status"
                                                                                                        <?= ($status == "Contractuary")?'checked':''; ?>
                                                                                                        value="Contractuary">Contractuary
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        name="e_status"
                                                                                                        <?= ($status == "Trainee")?'checked':''; ?>
                                                                                                        value="Trainee">Trainee
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div> -->
                                                                                    <div class="col-lg-3">
                                                                                        <div class="form-group">
                                                                                            <label>Employment
                                                                                                Status</label>
                                                                                            <select class="form-control"
                                                                                                name="e_status">
                                                                                                <option value=""
                                                                                                    disabled selected>
                                                                                                    SELECT
                                                                                                </option>
                                                                                                <?php 
                                                                                            $employ = $edit->getClientData($id, 'applicants_work', 'applicant_code', 'e_status')??null;
                                                                                            $employSet = ['REGULAR', 'PROBATIONARY', 'CASUAL', 'TRAINEE'];

                                                                                            foreach($employSet as $key => $val){
                                                                                              $emp = ($employ == $val) ? '<option selected value='.$employ.'>'.$val.'</option>' : '<option value='.$val.'>'.$val.'</option>';
                                                                                             echo $emp;
                                                                                            }
                                                                                            ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- <div class="col-lg-12">
                                                                                        <div class="form-group">
                                                                                            <label>Mode of
                                                                                                Salary:</label>
                                                                                            <div class="radio">
                                                                                                <?php $msalary = $edit->getClientData($id, 'applicants_work', 'applicant_code', 'm_salary')??null; ?>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        name="m_salary"
                                                                                                        <?= ($msalary == "Cash")?'checked':''; ?>
                                                                                                        value="Cash">Cash
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        name="m_salary"
                                                                                                        <?= ($msalary == "ATM")?'checked':''; ?>
                                                                                                        value="ATM">ATM
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        name="m_salary"
                                                                                                        <?= ($msalary == "Check")?'checked':''; ?>
                                                                                                        value="Check">Check
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div> -->
                                                                                    <div class="col-lg-3">
                                                                                        <div class="form-group">
                                                                                            <label>Mode of
                                                                                                Salary</label>
                                                                                            <select class="form-control"
                                                                                                name="m_salary">
                                                                                                <option value=""
                                                                                                    disabled selected>
                                                                                                    SELECT
                                                                                                </option>
                                                                                                <?php 
                                                                                            $msalary = $edit->getClientData($id, 'applicants_work', 'applicant_code', 'm_salary')??null;
                                                                                            $modeSet = ['Cash', 'ATM', 'Check'];

                                                                                            foreach($modeSet as $key => $val){
                                                                                              $ms = ($msalary == $val) ? '<option selected value='.$msalary.'>'.$val.'</option>' : '<option value='.$val.'>'.$val.'</option>';
                                                                                             echo $ms;
                                                                                            }
                                                                                            ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-3">
                                                                                        <div class="form-group">
                                                                                            <label>Bank Name</label>
                                                                                            <input type="text"
                                                                                                name="bank"
                                                                                                class="form-control"
                                                                                                placeholder="Bank Name"
                                                                                                value="<?= $edit->getClientData($id, 'applicants_work', 'applicant_code', 'bank_name')??null; ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-3">
                                                                                        <div class="form-group">
                                                                                            <label>Type of ATM
                                                                                                Card</label>
                                                                                            <input name="t_card"
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                placeholder="Type of ATM Card"
                                                                                                value="<?= $edit->getClientData($id, 'applicants_work', 'applicant_code', 'atm_card')??null; ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-3">
                                                                                        <div class="form-group">
                                                                                            <label>Do you have other
                                                                                                loan?</label>
                                                                                            <select
                                                                                                class="form-control input-set-3"
                                                                                                required
                                                                                                onchange="existLoanChange(this, 'loan_spec')"
                                                                                                name="loan" id="loan">
                                                                                                <option value=""
                                                                                                    selected disabled>
                                                                                                    SELECT</option>
                                                                                                <?php 

                                                                                                $loan = $edit->getClientData($id, 'applicants_work', 'applicant_code', 'loan')??null;
                                                                                                $exploan =  explode("-", $loan);
                                                                                                $loanSet = ['Salary Loan', 'Personal Loan', 'Calamity Loan', 'Maternity Loan', 'Paternity Loan','Business Loan', 'Appliance/Gadget Loan', 'Vehicle Loan', 'Home Loan', 'Travel Loan', 'Credit Card', 'OFW Loan', 'None'];
                                                                                                foreach($loanSet as $key => $val){
                                                                                                    $op1 = ($exploan[0] == $val) ? '<option selected value='.$exploan[0].'>'.$exploan[0].'</option>' : '<option value='.$val.'>'.$val.'</option>';
                                                                                                echo $op1;
                                                                                                }
                                                                                                ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-3">
                                                                                        <label for="">Specify:
                                                                                        </label>
                                                                                        <input type="text"
                                                                                            name="loan_spec"
                                                                                            id="loan_spec"
                                                                                            class="form-control input-set-3" <?php 
                                                                                            if($exploan[0] == "None"){
                                                                                                echo "disabled";
                                                                                            }else{
                                                                                                echo 'value="'.$exploan[1].'"';
                                                                                            }
                                                                                        ?>>
                                                                                    </div>
                                                                                    <!--MASTERRRRRRRRRRRRRRRRRRRRRRRRRR-->
                                                                                    <div class="col-lg-3">
                                                                                        <div class="form-group">
                                                                                            <label>Specify Monthly
                                                                                                Amortization</label>
                                                                                            <input name="sma" id="sma"
                                                                                                type="text"
                                                                                                class="form-control text-right input-set-3" 
                                                                                                maxlength="10"
                                                                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                                                                placeholder="₱"
                                                                                                <?php 
                                                                                                    if($exploan[1] == "Salary Loan"){
                                                                                                        echo 'value="'.$exploan[2].'"';
                                                                                                    }else if($exploan[1] == "Personal Loan"){
                                                                                                        echo 'value="'.$exploan[2].'"';
                                                                                                    }else if($exploan[1] == "Calamity Loan"){
                                                                                                        echo 'value="'.$exploan[2].'"';
                                                                                                    }else if($exploan[1] == "Maternity Loan"){
                                                                                                        echo 'value="'.$exploan[2].'"';
                                                                                                    }else if($exploan[1] == "Paternity Loan"){
                                                                                                        echo 'value="'.$exploan[2].'"';
                                                                                                    }else if($exploan[1] == "Business Loan"){
                                                                                                        echo 'value="'.$exploan[2].'"';
                                                                                                    }else if($exploan[1] == "Appliance/Gadget Loan"){
                                                                                                        echo 'value="'.$exploan[2].'"';
                                                                                                    }else if($exploan[1] == "Vehicle Loan"){
                                                                                                        echo 'value="'.$exploan[2].'"';
                                                                                                    }else if($exploan[1] == "Home Loan"){
                                                                                                        echo 'value="'.$exploan[2].'"';
                                                                                                    }else if($exploan[1] == "Travel Loan"){
                                                                                                        echo 'value="'.$exploan[2].'"';
                                                                                                    }else if($exploan[1] == "Credit Card"){
                                                                                                        echo 'value="'.$exploan[2].'"';
                                                                                                    }else if($exploan[1] == "OFW Loan"){
                                                                                                        echo 'value="'.$exploan[2].'"';
                                                                                                    }else{
                                                                                                        echo "disabled";
                                                                                                    }
                                                                                                ?>
                                                                                                >
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-3">
                                                                                        <div class="form-group">
                                                                                            <label>Monthly Salary
                                                                                                (Net/Gross)</label>
                                                                                            <input name="ms_salary"
                                                                                                type="text"
                                                                                                class="form-control text-right"
                                                                                                placeholder="Monthly Salary"
                                                                                                value="<?= $edit->getClientData($id, 'applicants_work', 'applicant_code', 'monthly_salary')??null; ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- <div class="col-lg-3">
                                                                                        <div class="form-group">
                                                                                            <label>Salary Period</label>
                                                                                            <select class="form-control"
                                                                                                name="s_period">
                                                                                                <option value=""
                                                                                                    disabled selected>
                                                                                                    SELECT
                                                                                                </option>
                                                                                                <?php 
                                                                                            $msalary = $edit->getClientData($id, 'applicants_work', 'applicant_code', 's_period')??null;
                                                                                            $modeSet = ['5/20', '6/21', '7/22', '8/23','10/25','15/30','Weekly','Every 2nd Saturday'];

                                                                                            foreach($modeSet as $key => $val){
                                                                                              $ms = ($msalary == $val) ? '<option selected value='.$msalary.'>'.$val.'</option>' : '<option value='.$val.'>'.$val.'</option>';
                                                                                             echo $ms;
                                                                                            }
                                                                                            ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div> -->
                                                                                    <div class="col-lg-12"></div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label>Other Source of
                                                                                                Income</label>

                                                                                            <input name="os_income"
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                placeholder="Other Source of Income"
                                                                                                value="<?= $edit->getClientData($id, 'applicants_work', 'applicant_code', 'other_source')??null; ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label>(Specify)</label>
                                                                                            <input name="s_specify"
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                placeholder="Specify"
                                                                                                value="<?= $edit->getClientData($id, 'applicants_work', 'applicant_code', 'specify')??null ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- separator -->
                                                                                    <div class="col-lg-12">
                                                                                        <hr>
                                                                                    </div>
                                                                                </div>
                                                                                <button type="button" name="next"
                                                                                    class="next btn  btn-primary text-center pull-right"
                                                                                    style="margin-left: 10px;">
                                                                                    Next <i
                                                                                        class="fa fa-arrow-right"></i></button>
                                                                                <button type="button" name="previous"
                                                                                    class="previous btn btn-default text-center pull-right"
                                                                                    value="Previous"> <i
                                                                                        class="fa fa-arrow-left"></i>
                                                                                    Prev</button>
                                                                            </fieldset>
                                                                            <fieldset>
                                                                                <div id="div_spouse" class="text-left">
                                                                                    <div class="col-lg-12"
                                                                                        align="right">
                                                                                        <button type="button"
                                                                                            class="btn btn-success"
                                                                                            onclick="addCharacter()">
                                                                                            <i class="fa fa-fw"
                                                                                                aria-hidden="true"
                                                                                                title="Copy to use user-plus">&#xf234</i>
                                                                                            Add Character Reference
                                                                                        </button></br></br>
                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <div id="div_depChar">
                                                                                            <?php $relatives =  $edit->getChildData($id, 'applicants_relative', 'applicant_code');
                                                                                             foreach ($relatives as $key => $val){
                                                                                                echo '<div style="margin-left:15px" id="'.($key+1).
                                                                                                '"><div class="col-lg-3"><div class="form-group"><label>Name of Relative</label><input name="dep_relative[]" class="form-control" value="'.$val['relative_name'].'" placeholder="Name of Relative"></div></div><div class="col-lg-3"><div class="form-group"><label>Contact No.</label><input type="text" value="'.$val['r_contact'].'"name="dep_rcontact[]" class="form-control" placeholder="Contact No."></div></div><div class="col-lg-3"><div class="form-group"><label>Relationship</label><input name="dep_relationship[]" value="'.$val['r_relationship'].'" class="form-control" placeholder="Relationship"></div></div><div class="col-lg-2"><div class="form-group"><label>Time Available</label><input name="dep_ta[]" value="'.$val['r_ta'].'" class="form-control" type="time"></div></div><div class="col-lg-1"><button type="button" class="btn btn-danger btn-circle" onclick="removeDependentChar('.($key+1).')"><i class="fa fa-trash-o"></i></button></div></div>';
                                                                                            }
                                                                                            ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- <div class="col-lg-12">
                                                                                        <div class="form-group">
                                                                                            <label>Source:</label>
                                                                                            <div class="radio">
                                                                                                <?php $src = $edit->getClientData($id, 'applicants_reference', 'applicant_code', 'source'); ?>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        name="source"
                                                                                                        value="Facebook"
                                                                                                        <?= ($src == "Facebook")?'checked':''; ?>>Facebook
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        name="source"
                                                                                                        value="Signage/Tarpaulin"
                                                                                                        <?= ($src == "Signage/Tarpaulin")?'checked':''; ?>>Signage/Tarpaulin
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        name="source"
                                                                                                        value="Banners"
                                                                                                        <?= ($src == "Banners")?'checked':''; ?>>Banners
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        name="source"
                                                                                                        value="Flyers"
                                                                                                        <?= ($src == "Flyers")?'checked':''; ?>>Flyers
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        name="source"
                                                                                                        value="Referrals"
                                                                                                        <?= ($src == "Referrals")?'checked':''; ?>>Referrals
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        name="source"
                                                                                                        value="Word of Mouth"
                                                                                                        <?= ($src == "Word of Mouth")?'checked':''; ?>>Word
                                                                                                    of Mouth
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div> -->
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Loan Purpose</label>
                                                                                            <select
                                                                                                class="form-control input-set-4"
                                                                                                required
                                                                                                onchange="lwChange(this, 'specPurp')"
                                                                                                name="purposeLoan"
                                                                                                id="purposeLoan">
                                                                                                <option value=""
                                                                                                    selected disabled>
                                                                                                    SELECT</option>
                                                                                                <?php 
                                                                                                $purposeLoan = $edit->getClientData($id, 'applicants_reference', 'applicant_code', 'loan_purpose')??null;
                                                                                                $purposeSet = ["Medical", "Educational","Pay Bills","Vehicle maintenance and fees","Special Occassion", "Business", "Travel",
                                                                                                "Debt Consolodation", "General Expenses", "Others"];
                                                                                                foreach($purposeSet as $key => $val){
                                                                                                    $op1 = ($purposeLoan == $val) ? '<option selected value="'.$purposeLoan.'">'.$purposeLoan.'</option>' : '<option value='.$val.'>'.$val.'</option>';
                                                                                                echo $op1;
                                                                                                }

                                                                                                ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <label for="">Others (Specify):
                                                                                        </label>
                                                                                        <input type="text"
                                                                                            name="specPurp"
                                                                                            id="specPurp"
                                                                                            class="form-control input-set-4" <?php 
                                                                                            if($purposeLoan == "Medical"){
                                                                                                echo "disabled";
                                                                                            }else if($purposeLoan == "Educational"){
                                                                                                echo "disabled";
                                                                                            }else if($purposeLoan == "Pay Bills"){
                                                                                                echo "disabled";
                                                                                            }else if($purposeLoan == "Vehicle maintenance and fees"){
                                                                                                echo "disabled";
                                                                                            }else if($purposeLoan == "Special Occassion"){
                                                                                                echo "disabled";
                                                                                            }else if($purposeLoan == "Business"){
                                                                                                echo "disabled";
                                                                                            }else if($purposeLoan == "Travel"){
                                                                                                echo "disabled";
                                                                                            }else if($purposeLoan == "Debt Consolodation"){
                                                                                                echo "disabled";
                                                                                            }else if($purposeLoan == "General Expenses"){
                                                                                                echo "disabled";
                                                                                            }else{
                                                                                                echo 'value="'.$purposeLoan.'"';
                                                                                            }
                                                                                        ?>>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Contact No.</label>
                                                                                            <input name="contact_num"
                                                                                                maxlength="11"
                                                                                                class="form-control"
                                                                                                placeholder="Mobile No."
                                                                                                value="<?= $edit->getClientData($id, 'applicants_personal', 'applicant_code', 'contact1')??null ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Source</label>
                                                                                            <select
                                                                                                class="form-control input-set-4"
                                                                                                required
                                                                                                onchange="lwChange(this, 'specSource')"
                                                                                                name="source"
                                                                                                id="sources">
                                                                                                <option value=""
                                                                                                    selected disabled>
                                                                                                    SELECT</option>
                                                                                                <?php 
                                                                                                $source = $edit->getClientData($id, 'applicants_reference', 'applicant_code', 'source')??null;
                                                                                                $sourceSet = ['Facebook', 'Leaflets','Signage/Posters','Referral', 'Banners','Flyers', 'Others'];
                                                                                                foreach($sourceSet as $key => $val){
                                                                                                    $op1 = ($source == $val) ? '<option selected value='.$source.'>'.$source.'</option>' : '<option value='.$val.'>'.$val.'</option>';
                                                                                                echo $op1;
                                                                                                }

                                                                                                ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <label for="">Others (Specify):
                                                                                        </label>
                                                                                        <input type="text"
                                                                                            name="specSource"
                                                                                            id="specSource"
                                                                                            class="form-control input-set-4" <?php 
                                                                                            if($source == "Medical"){
                                                                                                echo "disabled";
                                                                                            }else if($source == "Facebook"){
                                                                                                echo "disabled";
                                                                                            }else if($source == "Leaflets"){
                                                                                                echo "disabled";
                                                                                            }else if($source == "Signage/Posters"){
                                                                                                echo "disabled";
                                                                                            }else if($source == "Referral"){
                                                                                                echo "disabled";
                                                                                            }else if($source == "Banners"){
                                                                                                echo "disabled";
                                                                                            }else if($source == "Flyers"){
                                                                                                echo "disabled";
                                                                                            }else{
                                                                                                echo 'value="'.$source.'"';
                                                                                            }
                                                                                        ?>>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Facebook</label>
                                                                                            <input name="facebook"
                                                                                                class="form-control input-set-4"
                                                                                                placeholder="Facebook Account"
                                                                                                value="<?= $edit->getClientData($id, 'applicants_reference', 'applicant_code', 'fb_acct')??null ?>">
                                                                                        </div>

                                                                                    </div>
                                                                                    <!-- <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Select file to
                                                                                                upload</label>
                                                                                            <input type="file"
                                                                                                name="myFile"
                                                                                                class="form-control input-set-4"
                                                                                                id="fileToUpload"
                                                                                                accept="application/pdf"
                                                                                                required>
                                                                                        </div>
                                                                                    </div> -->
                                                                                </div>
                                                                                <br>
                                                                                <button type="button" name="submit"
                                                                                    id="submit"
                                                                                    class="next btn  btn-primary text-center pull-right"
                                                                                    style="margin-left: 10px;">
                                                                                    Save Changes <i
                                                                                        class="fa fa-save"></i></button>
                                                                                <button type="button" name="previous"
                                                                                    class="previous btn btn-default text-center pull-right"
                                                                                    value="Previous"> <i
                                                                                        class="fa fa-arrow-left"></i>
                                                                                    Prev</button>
                                                                            </fieldset>
                                                                            <fieldset style="height: 300px">
                                                                                <center>
                                                                                    <div class="orbit"></div>
                                                                                </center>
                                                                            </fieldset>

                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.row (nested) -->
                                            </div>
                                            <!-- /.panel-body -->
                                        </div>
                                        <!-- /.panel -->

                                    </div>

                                    <!-- <div class="tab-pane fade" id="tab-default-3">Page 3</div>
                                        <div class="tab-pane fade" id="tab-default-4">Page 4</div>
                                        <div class="tab-pane fade" id="tab-default-5">Page 5</div> -->
                                </div>
                            </div>
                        </div>
                        <!-- /.panel -->
                    </div>
                    <div class="col-lg-12">

                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <div class="modal fade text-left" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>
                        <center><i class="fa fa-fw fa-5x" style="color:#d9534f;" aria-hidden="true"
                                title="Copy to use archive">&#xf187</i>
                        </center>
                        <center>
                            <h5>Save to archive?</h5>
                        </center>

                    </p>
                </div>
                <div class="modal-footer" style="padding: 5px;">
                    <button type="button" class="btn btn-default text-small" name="update" id="update">No</button>
                    <!-- <input type="hidden" name="id"
                                                                                                    value="<?=  $display['applicant_code'] ?>"> -->
                    <button type="button" name="archive" id="archive" class="btn btn-danger text-small">Yes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

    <div class="modal fade text-left" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <iframe width="870px" height="500px" id="gmap_canvas"
                        src="https://maps.google.com/maps?q=Ormoc&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
                        scrolling="no" marginheight="0" marginwidth="0"></iframe>
                </div>
                <div class="modal-footer" style="padding: 5px;">
                    <form action="#" method="post">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Okay</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/startmin.js"></script>
    <script>
    function showSpouse(val) {
        // var x = document.getElementById("div_spouse").value;
        if (val == "Married") {
            // alert("hello");
            document.getElementById('div_spouse').style.display = "block";
            populate("spob_province", "", "");
            populate("spouse_province", "", "");
        } else {
            document.getElementById('div_spouse').style.display = "none";
        }
    }

    function onlyNumberKey(evt) {

        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }

    var dep = 0;

    function addDependent() {
        dep++;
        var objTo = document.getElementById('div_dep');
        var divtest = document.createElement("div");
        divtest.innerHTML = '<div style="margin-left:16px" id="' + dep +
            '"><div class="col-lg-3"><div class="form-group"><label>Name of Children</label><input name="dep_child[]" type="text" class="form-control" placeholder="Name of Children"></div></div><div class="col-lg-2"><div class="form-group"><label>Age</label><input type="text" name="dep_age[]" class="form-control" placeholder="Age"></div></div><div class="col-lg-1"><button type="button" class="btn btn-danger btn-circle" onclick="removeDependent(' +
            dep + ')"><i class="fa fa-trash-o"></i></button></div></div>';
        objTo.appendChild(divtest);
    }

    function removeDependent(dval) {
        dep--;
        // var element = document.getElementById(dval);
        // element.remove();
        // var element = dval;
        // element.parentNode.removeChild(dval);
        var element = document.getElementById(dval);
        element.remove();
    }


    function addCharacter() {
        dep++;
        var objTo = document.getElementById('div_depChar');
        var divtest = document.createElement("div");
        divtest.innerHTML = '<div style="margin-left:15px" id="' + dep +
            '"><div class="col-lg-3"><div class="form-group"><label>Name of Relative</label><input name="dep_relative[]" class="form-control" placeholder="Name of Relative"></div></div><div class="col-lg-3"><div class="form-group"><label>Contact No.</label><input type="text" name="dep_rcontact[]" class="form-control" placeholder="Contact No."></div></div><div class="col-lg-3"><div class="form-group"><label>Relationship</label><input name="dep_relationship[]" class="form-control" placeholder="Relationship"></div></div><div class="col-lg-2"><div class="form-group"><label>Time Available</label><input name="dep_ta[]" class="form-control" type="time"></div></div><div class="col-lg-1"><button type="button" class="btn btn-danger btn-circle" onclick="removeDependentChar(' +
            dep + ')"><i class="fa fa-trash-o"></i></button></div></div>';
        objTo.appendChild(divtest);
    }

    function removeDependentChar(dval) {
        dep--;
        // var element = document.getElementById(dval);
        // element.remove();
        // var element = dval;
        // element.parentNode.removeChild(dval);
        var element = document.getElementById(dval);
        element.remove();
    }


    // function enableField(){
    //     var others = document.getElementByID("rlw_others");
    //     var spec = document.getElementByID("rlw_spec");
    //     spec.disabled = others.checked ? false : true;
    //         if (!spec.disabled) {
    //             spec.focus();
    //         }
    // }
    function enableField(radio, input) {
        var radio = document.getElementById(radio);
        var input = document.getElementById(input);
        if (radio.checked == true) {
            if (radio.value == "Specify" || radio.value == "Others") {
                input.disabled = false;
                input.focus();
            } else {
                input.disabled = true;
            }
        }
    }

    function lwChange(val, spec) {
        var spec = document.getElementById(spec);
        if (val.value == "Others" || val.value == "Yes") {
            spec.disabled = false;
            spec.required = true;
        } else {
            spec.disabled = true;
            spec.required = false;
        }

    }

    function existLoanChange(val, spec) {
        var spec = document.getElementById(spec);
        if (val.value != "None") {
            spec.disabled = false;
            spec.required = true;
        } else {
            spec.disabled = true;
            spec.required = false;
        }

    }


    function viewMap(url) {
        $("#gmap_canvas").attr("src", "https://maps.google.com/maps?q=" + $('#' + url).val() +
            "&t=&z=13&ie=UTF8&iwloc=&output=embed");
    }
    </script>
    <script>
    //  populate("spob_province", "", "");
    //  populate("spouse_province", "", "");

    populate("pob_province", "", '', document.getElementById('db_pob1').value);
    populate("province", "", "", document.getElementById('db_province').value);
    populate("province2", "", "", document.getElementById('db_province2').value);
    populate("spob_province", "", "", document.getElementById('db_spob1').value);
    populate("spouse_province", "", "", document.getElementById('db_sprovince').value);




    if (document.getElementById('tor_spec').value != "") {
        document.getElementById('tor1').value = "Others";
    }

    if (document.getElementById('tor_spec2').value != "") {
        document.getElementById('tor2').value = "Others";
    }

    if (document.getElementById('spec').value != "") {
        document.getElementById('lw1').value = "Others";
    }

    if (document.getElementById('spec2').value != "") {
        document.getElementById('lw2').value = "Others";
    }

    if (document.getElementById('loan_spec').value == "") {
        document.getElementById('loan').value = "None";
    }

    if (document.getElementById('specPurp').value != "") {
        document.getElementById('purposeLoan').value = "Others";
    }

    if (document.getElementById('specSource').value != "") {
        document.getElementById('sources').value = "Others";
    }



    function populate(select, prevVal, val, db) {
        let mainSelect = document.getElementById(select);
        let tempArray = [];

        var xhr = new XMLHttpRequest(),
            method = 'GET',
            overrideMimeType = 'application/json',
            url =
            '../ph_provinces.json'; // ADD THE URL OF THE FILE.

        let frag = document.createDocumentFragment(),
            elOption = null;

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {

                // PARSE JSON DATA.
                let data = JSON.parse(xhr.responseText);

                // if (data.hasOwnProperty(region)) {



                //     if (select !== "province" || select !== "province2" || select != "spob_province" || select !=
                //         "spouse_province") {
                //         let index = mainSelect.options.length;
                //         while (index > 0) {
                //             mainSelect.remove(index);
                //             index--;
                //         }
                //     }

                //     if (select === "province" || select === "province2" || select === "pob_province" || select ===
                //         "spouse_province" || select === "spob_province") {

                //         for (key in Object.keys(data.province_list)) {
                //             elOption = frag.appendChild(document.createElement('option'));
                //             elOption.value = Object.keys(data.province_list)[key];
                //             elOption.text = `${Object.keys(data.province_list)[key]}`;
                //             tempArray.push(Object.keys(data.province_list)[key]);
                //         }
                //         mainSelect.appendChild(frag);
                //         if (tempArray.includes(db)) {
                //             mainSelect.value = tempArray[tempArray.indexOf(db)];
                //         }

                //         if (select == "pob_province") {
                //             populate("pob_city", "", document.getElementById('pob_province').value, document
                //                 .getElementById('db_pobcity').value);
                //         } else if (select == "province") {
                //             populate("city", document.getElementById('province').value, document
                //                 .getElementById('province').value, document.getElementById('db_city').value);
                //         } else if (select == "province2") {
                //             populate("city2", document.getElementById('province2').value, document
                //                 .getElementById('province2').value, document.getElementById('db_city2').value);
                //         } else if (select == "spob_province") {
                //             populate("spob_city", document.getElementById('spob_province').value, document
                //                 .getElementById('spob_province').value, document.getElementById('db_spob2')
                //                 .value);
                //         } else if (select == "spouse_province") {
                //             populate("spouse_city", document.getElementById('spouse_province').value, document
                //                 .getElementById('spouse_province').value, document.getElementById('db_scity')
                //                 .value);
                //         }

                //         tempArray = [];
                //     } else if (select === "city" || select === "city2" || select === "spob_city" || select ===
                //         "pob_city" || select === "spouse_city") {
                //         document.getElementById('db_pob1').value = "";
                //         for (key in Object.keys(data.province_list[val].municipality_list)) {
                //             elOption = frag.appendChild(document.createElement('option'));
                //             elOption.value = Object.keys(data.province_list[val].municipality_list)[key];
                //             elOption.text =
                //                 `${Object.keys(data.province_list[val].municipality_list)[key]}`;
                //             tempArray.push(Object.keys(data.province_list[val].municipality_list)[key]);
                //         }
                //         mainSelect.appendChild(frag);
                //         if (tempArray.includes(db)) {
                //             mainSelect.value = tempArray[tempArray.indexOf(db)];
                //         }

                //         if (select == "city") {
                //             populate("brgy", 'province', document.getElementById('city').value, document
                //                 .getElementById('db_brgy').value);
                //         } else if (select == "city2") {
                //             populate("brgy2", 'province2', document.getElementById('city2').value, document
                //                 .getElementById('db_brgy2').value);
                //         } else if (select == "spouse_city") {
                //             populate("spouse_brgy", 'spouse_province', document.getElementById('spouse_city')
                //                 .value, document.getElementById('db_sbrgy').value);
                //         }

                //         tempArray = [];

                //     } else if (select === "brgy" || select === "brgy2" || select === "spouse_brgy") {
                //         for (key in Object.keys(data.province_list[document.getElementById(prevVal).value]
                //                 .municipality_list[val].barangay_list)) {
                //             elOption = frag.appendChild(document.createElement('option'));
                //             elOption.value = data.province_list[document.getElementById(prevVal).value]
                //                 .municipality_list[val].barangay_list[key];
                //             elOption.text =
                //                 `${data.province_list[document.getElementById(prevVal).value].municipality_list[val].barangay_list[key]}`;
                //             tempArray.push(data.province_list[document.getElementById(prevVal).value]
                //                 .municipality_list[val].barangay_list[key])
                //         }
                //         mainSelect.appendChild(frag);
                //         if (tempArray.includes(db)) {
                //             mainSelect.value = tempArray[tempArray.indexOf(db)];
                //         }

                //     }

                // }

                if (select !== "province" || select !== "province2" || select != "spob_province" || select !=
                    "spouse_province" || select === "pob_province") {
                    let index = mainSelect.options.length;
                    while (index > 0) {
                        mainSelect.remove(index);
                        index--;
                    }
                }

                if (select === "province" || select === "province2" || select === "pob_province" || select ===
                    "spouse_province" || select === "spob_province") {

                    for (key in Object.keys(data.province_list)) {
                        elOption = frag.appendChild(document.createElement('option'));
                        elOption.value = Object.keys(data.province_list)[key];
                        elOption.text = `${Object.keys(data.province_list)[key]}`;
                        tempArray.push(Object.keys(data.province_list)[key]);
                    }
                    mainSelect.appendChild(frag);
                    if (tempArray.includes(db)) {
                        mainSelect.value = tempArray[tempArray.indexOf(db)];
                    }

                    if (select == "pob_province") {
                        populate("pob_city", "", document.getElementById('pob_province').value, document
                            .getElementById('db_pobcity').value);
                    } else if (select == "province") {
                        populate("city", document.getElementById('province').value, document
                            .getElementById('province').value, document.getElementById('db_city').value);
                    } else if (select == "province2") {
                        populate("city2", document.getElementById('province2').value, document
                            .getElementById('province2').value, document.getElementById('db_city2').value);
                    } else if (select == "spob_province") {
                        populate("spob_city", document.getElementById('spob_province').value, document
                            .getElementById('spob_province').value, document.getElementById('db_spob2')
                            .value);
                    } else if (select == "spouse_province") {
                        populate("spouse_city", document.getElementById('spouse_province').value, document
                            .getElementById('spouse_province').value, document.getElementById('db_scity')
                            .value);
                    }

                    tempArray = [];
                } else if (select === "city" || select === "city2" || select === "spob_city" || select ===
                    "pob_city" || select === "spouse_city") {
                    document.getElementById('db_pob1').value = "";
                    for (key in Object.keys(data.province_list[val].municipality_list)) {
                        elOption = frag.appendChild(document.createElement('option'));
                        elOption.value = Object.keys(data.province_list[val].municipality_list)[key];
                        elOption.text =
                            `${Object.keys(data.province_list[val].municipality_list)[key]}`;
                        tempArray.push(Object.keys(data.province_list[val].municipality_list)[key]);
                    }
                    mainSelect.appendChild(frag);
                    if (tempArray.includes(db)) {
                        mainSelect.value = tempArray[tempArray.indexOf(db)];
                    }

                    if (select == "city") {
                        populate("brgy", 'province', document.getElementById('city').value, document
                            .getElementById('db_brgy').value);
                    } else if (select == "city2") {
                        populate("brgy2", 'province2', document.getElementById('city2').value, document
                            .getElementById('db_brgy2').value);
                    } else if (select == "spouse_city") {
                        populate("spouse_brgy", 'spouse_province', document.getElementById('spouse_city')
                            .value, document.getElementById('db_sbrgy').value);
                    }

                    tempArray = [];

                } else if (select === "brgy" || select === "brgy2" || select === "spouse_brgy") {
                    for (key in Object.keys(data.province_list[document.getElementById(prevVal).value]
                            .municipality_list[val].barangay_list)) {
                        elOption = frag.appendChild(document.createElement('option'));
                        elOption.value = data.province_list[document.getElementById(prevVal).value]
                            .municipality_list[val].barangay_list[key];
                        elOption.text =
                            `${data.province_list[document.getElementById(prevVal).value].municipality_list[val].barangay_list[key]}`;
                        tempArray.push(data.province_list[document.getElementById(prevVal).value]
                            .municipality_list[val].barangay_list[key])
                    }
                    mainSelect.appendChild(frag);
                    if (tempArray.includes(db)) {
                        mainSelect.value = tempArray[tempArray.indexOf(db)];
                    }

                }
            }
        };
        xhr.open(method, url, true);
        xhr.send();
    }
    </script>
    <script src="../js/multi-step.js"></script>
    <script src="../css/toast/beautyToast.js"></script>
    <script>
    $("#submit").click(function() {
        $('#modal').modal('show');
    });
    $('#update').click(() => {
        $('#action').val('update');
        $('#progressbar').css('display', 'none');
        $('#p-label').css('display', 'none');
        $('#modal').modal('hide');
        submit();
    });
    $('#archive').click(() => {
        $('#action').val('archive');
        $('#progressbar').css('display', 'none');
        $('#p-label').css('display', 'none');
        $('#modal').modal('hide');
        submit();
    });

    function submit() {
        $.ajax({
            type: 'POST',
            url: '../request/reg_update.php',
            data: $('form').serialize(),
            dataType: 'json',
            success: function(response) {

                setTimeout(() => {

                    beautyToast.success({
                        title: '',
                        message: response.message,
                        darkTheme: false,
                        iconColor: 'green',
                        iconWidth: 24,
                        iconHeight: 24,
                        animationTime: 100,
                    });

                    setTimeout(() => {
                        window.location.replace(
                            `loan_application_1.php?id=${response.code}`);
                    }, 2500);
                }, 2000);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    }
    </script>

</body>

</html>
<?php
}else{
    header('location: index.php');
}
?>