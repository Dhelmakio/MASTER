<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}else{
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

    <style>

    </style>
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/startmin.css" rel="stylesheet">
    <link href="../css/multi-step.css" rel="stylesheet">
    <link href="../css/toast/beautyToast.css" rel="stylesheet">
    <!-- <link href="../css/validate.css" rel="stylesheet"> -->

    <!-- Custom Fonts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    <link href="../css/loader.css" rel="stylesheet">
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include('nav.php');?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Applicant Information Registry</h1>
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
                                                                            <fieldset id="set1" class="text-left">
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Last Name</label>
                                                                                        <input
                                                                                            class="form-control input-set-1"
                                                                                            name="lname"
                                                                                            placeholder="Last Name"
                                                                                            required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Middle Name</label>
                                                                                        <input
                                                                                            class="form-control"
                                                                                            name="mname"
                                                                                            placeholder="Middle Name">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>First Name</label>
                                                                                        <input type="text"
                                                                                            class="form-control input-set-1"
                                                                                            name="fname"
                                                                                            placeholder="First Name"
                                                                                            required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Suffix</label>
                                                                                        <input class="form-control"
                                                                                            name="suffix"
                                                                                            placeholder="Suffix">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Nickname</label>
                                                                                        <input class="form-control"
                                                                                            name="nname"
                                                                                            placeholder="Nickname">
                                                                                    </div>
                                                                                </div>
                                                                                <!-- <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Age</label>
                                                                                        <input class="form-control input-set-1"
                                                                                            name="age" maxlength="3"
                                                                                            onkeypress="return onlyNumberKey(event)"
                                                                                            placeholder="Age" required
                                                                                            >
                                                                                    </div>
                                                                                </div> -->
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Gender</label>
                                                                                        <select class="form-control input-set-1" required
                                                                                            name="gender">
                                                                                            <option value="" disabled
                                                                                                selected=1>
                                                                                                SELECT
                                                                                            </option>
                                                                                            <option value="Male">Male
                                                                                            </option>
                                                                                            <option value="Female">
                                                                                                Female
                                                                                            </option>
                                                                                            <option value="Others">
                                                                                                Others
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Marital
                                                                                            Status</label>
                                                                                        <select class="form-control input-set-1"
                                                                                            name="m_status" required
                                                                                            id="m_status" 
                                                                                            onchange="showSpouse(this.value)">
                                                                                            <option value="" disabled
                                                                                                selected>
                                                                                                SELECT
                                                                                            </option>
                                                                                            <option value="Single">
                                                                                                Single</option>
                                                                                            <option value="Married">
                                                                                                Married</option>
                                                                                            <option value="Widowed">
                                                                                                Widowed</option>
                                                                                            <option value="Separated">
                                                                                                Separated</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Date of birth</label>
                                                                                        <input type="date" name="dob"
                                                                                            class="form-control input-set-1"
                                                                                            placeholder="Date of birth" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Place of
                                                                                            birth ( Province )</label>
                                                                                        <select name="pob_province"
                                                                                            id="pob_province" required
                                                                                            class="form-control input-set-1"
                                                                                            onchange="populate('pob_city', '', this.value)">
                                                                                            <option selected disabled>
                                                                                                SELECT</option>
                                                                                            <select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
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
                                                                                </div>

                                                                                <div class="col-lg-12">
                                                                                    <hr>
                                                                                </div>
                                                                                <!--All goods-->
                                                                                <div class="col-lg-12">
                                                                                    <h3><b>Present Address</b></h3><br>
                                                                                </div>

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
                                                                                </div>

                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Street</label>
                                                                                        <input name="street"
                                                                                            class="form-control"
                                                                                            placeholder="Street">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Blk / Lot No. /
                                                                                            House No.</label>
                                                                                        <input name="blk"
                                                                                            class="form-control"
                                                                                            placeholder="Block/ Lot No./ House">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Phase/Zone</label>
                                                                                        <input name="phase"
                                                                                            class="form-control"
                                                                                            placeholder="Phase/Zone">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label>Provide Map URL</label>
                                                                                        <input name="coordinates"
                                                                                            id="map_url" required
                                                                                            class="form-control input-set-1"
                                                                                            placeholder="Provide Map URL"
                                                                                            onchange="viewMap('map_url')">

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <label for="">Google Map
                                                                                        Preview</label>
                                                                                    <iframe class="form-control"
                                                                                        style="height: 300px"
                                                                                        id="gmap_canvas"
                                                                                        src="https://maps.google.com/maps?q=Ormoc&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                                                                        frameborder="0" scrolling="no"
                                                                                        marginheight="0"
                                                                                        marginwidth="0"></iframe>
                                                                                </div>
                                                                                <div class="col-lg-12"><br></div>
                                                                                <!-- <div class="col-lg-12">
                                                                                    <div class="form-group">
                                                                                        <label>Type of
                                                                                            Residency:</label>
                                                                                        <div class="radio">
                                                                                            <label>
                                                                                                <input type="radio"
                                                                                                    name="tor"
                                                                                                    id="owned"
                                                                                                    value="Owned"
                                                                                                    onclick="enableField('owned', 'specific')">Owned
                                                                                                &nbsp;
                                                                                            </label>
                                                                                            <label>
                                                                                                <input type="radio"
                                                                                                    name="tor"
                                                                                                    id="renting"
                                                                                                    value="Renting/Leasing"
                                                                                                    onclick="enableField('renting', 'specific')">Renting/Leasing
                                                                                                &nbsp;
                                                                                            </label>
                                                                                            <label>
                                                                                                <input type="radio"
                                                                                                    name="tor"
                                                                                                    id="specify"
                                                                                                    value="Specify"
                                                                                                    onclick="enableField('specify', 'specific')">Others
                                                                                                (Specify):
                                                                                            </label>
                                                                                            <input type="text"
                                                                                                name="tor_spec"
                                                                                                id="specific"
                                                                                                class="form-group"
                                                                                                disabled="true">
                                                                                        </div>
                                                                                    </div>
                                                                                </div> -->
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Type of
                                                                                            Residency:</label>
                                                                                        <select name="tor" class="form-control input-set-1" required
                                                                                            onchange="lwChange(this, 'tor_spec')">
                                                                                            <option value="" selected
                                                                                                disabled>SELECT</option>
                                                                                            <option value="Owned">
                                                                                                Owned
                                                                                            </option>
                                                                                            <option value="Renting">
                                                                                                Renting
                                                                                            </option>
                                                                                            <option value="Others">
                                                                                                Others
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <label for="">Others (Specify):
                                                                                    </label>
                                                                                    <input type="text" name="tor_spec"
                                                                                        id="tor_spec"
                                                                                        class="form-control input-set-1" 
                                                                                        disabled="true">
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Living With:</label>
                                                                                        <select class="form-control input-set-1" required
                                                                                            onchange="lwChange(this, 'spec')"
                                                                                            name="l_with" id="lw1">
                                                                                            <option value="" selected
                                                                                                disabled>SELECT</option>
                                                                                            <option value="Parents">
                                                                                                Parents
                                                                                            </option>
                                                                                            <option value="Relatives">
                                                                                                Relatives
                                                                                            </option>
                                                                                            <option
                                                                                                value="Wife/Husband/Live-in Partner">
                                                                                                Wife/Husband/Live-in
                                                                                                Partner</option>
                                                                                            <option value="Co-Worker">
                                                                                                Co-Worker
                                                                                            </option>
                                                                                            <option value="Others">
                                                                                                Others
                                                                                            </option>
                                                                                        </select>

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <label for="">Others (Specify):
                                                                                    </label>
                                                                                    <input type="text" name="lw_spec" 
                                                                                        id="spec" class="form-control input-set-1"
                                                                                        disabled="true">
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <hr>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <h3><b>Permanent Address</b>
                                                                                    </h3>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <label style="color: red;"> <i>Use
                                                                                            present address?</i>
                                                                                    </label>
                                                                                    <input type="checkbox"
                                                                                        onclick="$('#perAddress').is(':checked') ? $('#permanent').fadeToggle('200') : $('#permanent').fadeToggle('300');"
                                                                                        style="transform: scale(1.3);transform: translate(1px, 2px);"
                                                                                        id="perAddress"><br><br>
                                                                                </div>
                                                                                <div id="permanent">
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Province</label>
                                                                                            <select name="province2"
                                                                                                class="form-control input-set-1"
                                                                                                id="province2" required
                                                                                                onchange="populate('city2', '', this.value)">
                                                                                                <option value=""
                                                                                                    selected disabled>
                                                                                                    SELECT</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>City /
                                                                                                Municipality</label>
                                                                                            <select name="city2"
                                                                                                class="form-control input-set-1"
                                                                                                id="city2" required
                                                                                                onchange="populate('brgy2', 'province2', this.value)">
                                                                                                <option value=""
                                                                                                    selected disabled>
                                                                                                    SELECT</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Barangay</label>
                                                                                            <select name="brgy2"
                                                                                                id="brgy2" required
                                                                                                class="form-control input-set-1">
                                                                                                <option value=""
                                                                                                    selected disabled>
                                                                                                    SELECT</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Blk / Lot No. /
                                                                                                House No.</label>
                                                                                            <input name="blk2" id="blk2"
                                                                                                class="form-control"
                                                                                                placeholder="Block/ Lot No./ House">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Street</label>
                                                                                            <input name="street2"
                                                                                                class="form-control"
                                                                                                placeholder="Street">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Phase/Zone</label>
                                                                                            <input name="phase2"
                                                                                                class="form-control"
                                                                                                placeholder="Phase/Zone">
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- 

                                                                                    <div class="col-lg-12">
                                                                                        <div class="form-group">
                                                                                            <label>Type of
                                                                                                Residency:</label>
                                                                                            <div class="radio">
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        name="tor2"
                                                                                                        id="owned1"
                                                                                                        value="Owned"
                                                                                                        onclick="enableField('owned1', 'specific1')">Owned
                                                                                                    &nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        name="tor2"
                                                                                                        id="renting1"
                                                                                                        value="Renting/leasing"
                                                                                                        onclick="enableField('renting1', 'specific1')">Renting/Leasing
                                                                                                    &nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        name="tor2"
                                                                                                        id="specify1"
                                                                                                        value="Specify"
                                                                                                        onclick="enableField('specify1', 'specific1')">Others
                                                                                                    (Specify):
                                                                                                </label>
                                                                                                <input type="text"
                                                                                                    name="tor_spec2"
                                                                                                    id="specific1"
                                                                                                    class="form-group"
                                                                                                    disabled="true">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div> -->
                                                                                    <div class="col-lg-3">
                                                                                        <div class="form-group">
                                                                                            <label>Type of
                                                                                                Residency:</label>
                                                                                            <select class="form-control input-set-1" required
                                                                                                onchange="lwChange(this, 'tor_spec2')"
                                                                                                name="tor2">
                                                                                                <option value=""
                                                                                                    selected disabled>
                                                                                                    SELECT</option>
                                                                                                <option value="Owned">
                                                                                                    Owned
                                                                                                </option>
                                                                                                <option value="Renting">
                                                                                                    Renting
                                                                                                </option>
                                                                                                <option value="Others">
                                                                                                    Others
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-3">
                                                                                        <label for="">Others (Specify):
                                                                                        </label>
                                                                                        <input type="text"
                                                                                            name="tor_spec2"
                                                                                            id="tor_spec2"
                                                                                            class="form-control input-set-1" 
                                                                                            disabled="true">
                                                                                    </div>
                                                                                    <div class="col-lg-3">
                                                                                        <div class="form-group">
                                                                                            <label>Living With:</label>
                                                                                            <select class="form-control input-set-1" required
                                                                                                onchange="lwChange(this, 'spec2')"
                                                                                                name="l_with" id="lw1">
                                                                                                <option value=""
                                                                                                    selected disabled>
                                                                                                    SELECT</option>
                                                                                                <option value="Parents">
                                                                                                    Parents
                                                                                                </option>
                                                                                                <option
                                                                                                    value="Relatives">
                                                                                                    Relatives</option>
                                                                                                <option
                                                                                                    value="Wife/Husband/Live-in Partner">
                                                                                                    Wife/Husband/Live-in
                                                                                                    Partner</option>
                                                                                                <option
                                                                                                    value="Co-Worker">
                                                                                                    Co-Worker</option>
                                                                                                <option value="Others">
                                                                                                    Others
                                                                                                </option>
                                                                                            </select>

                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-lg-3">
                                                                                        <label for="">Others (Specify):
                                                                                        </label>
                                                                                        <input type="text"
                                                                                            name="lw_spec" id="spec2"
                                                                                            class="form-control input-set-1"
                                                                                            disabled="true">
                                                                                    </div>

                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <hr>
                                                                                </div>
                                                                                <div class="col-lg-8">
                                                                                    <div class="form-group">
                                                                                        <label>Mother's
                                                                                            Name:</label>
                                                                                        <input name="mother_name"
                                                                                            class="form-control input-set-1" required
                                                                                            onclick="console.log('block: '+document.getElementById('blk2').value)"
                                                                                            placeholder="Mother's name">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Contact No.</label>
                                                                                        <input type="text"
                                                                                            name="mother_contact"
                                                                                            class="form-control input-set-1" required
                                                                                            minlength="11"
                                                                                            maxlength="11"
                                                                                            onkeypress="return onlyNumberKey(event)"
                                                                                            placeholder="Mobile number (e.g. 09123456789)">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-8">
                                                                                    <div class="form-group">
                                                                                        <label>Father's
                                                                                            Name:</label>
                                                                                        <input name="father_name"
                                                                                            class="form-control input-set-1" required
                                                                                            placeholder="Father's name">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Contact No.</label>
                                                                                        <input type="text"
                                                                                            name="father_contact"
                                                                                            class="form-control input-set-1" required
                                                                                            minlength="11"
                                                                                            maxlength="11"
                                                                                            onkeypress="return onlyNumberKey(event)"
                                                                                            placeholder="Mobile number (e.g. 09123456789)">
                                                                                    </div>
                                                                                </div>
                                                                                <!-- separator -->
                                                                                <div class="col-lg-12">
                                                                                    <hr>
                                                                                </div><button type="button" name="next"
                                                                                    disabled id="first_next"
                                                                                    class=" btn btn-primary pull-right"
                                                                                    style="margin-left: 10px;">
                                                                                    Next <i
                                                                                        class="fa fa-arrow-right"></i></button>
                                                                                <a href="registry_applicant.php">
                                                                                    <button type="button"
                                                                                        class="btn btn-default pull-right"
                                                                                        data-toggle="tooltip"
                                                                                        data-placement="top"
                                                                                        title="Edit"><i
                                                                                            class="fa fa-arrow-left"></i>
                                                                                        Prev
                                                                                    </button>
                                                                                </a>
                                                                            </fieldset>
                                                                            <fieldset id="set2">
                                                                                <div id="div_spouse" class="text-left">
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label>Name of
                                                                                                Spouse/Live-in</label>
                                                                                            <input
                                                                                                name="spouse_name"
                                                                                                type="text"
                                                                                                class="form-control input-set-2"
                                                                                                placeholder="Name of spouse"
                                                                                                required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label>Contact
                                                                                                No.</label>
                                                                                            <input name="spouse_contact"
                                                                                                type="text"
                                                                                                class="form-control input-set-2"
                                                                                                onkeypress="return onlyNumberKey(event)"
                                                                                                maxlength="11"
                                                                                                placeholder="Mobile number (e.g. 09123456789)"
                                                                                                required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Date of
                                                                                                birth</label>
                                                                                            <input type="date"
                                                                                                name="spouse_dob"
                                                                                                class="form-control input-set-2" required
                                                                                                placeholder="Date of birth" >
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label>Place of
                                                                                                birth</label>
                                                                                            <input name="spouse_pob"
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                placeholder="Place of birth">
                                                                                        </div>
                                                                                    </div> -->
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Place of birth
                                                                                                (Province)</label>
                                                                                            <select name="spob_province"
                                                                                                class="form-control input-set-2" required
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
                                                                                                class="form-control input-set-2" required
                                                                                                id="spob_city">
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
                                                                                                placeholder="Present Address">
                                                                                        </div>
                                                                                    </div> -->
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Present Address
                                                                                                (Province)</label>
                                                                                            <select
                                                                                                name="spouse_province"
                                                                                                class="form-control input-set-2" required
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
                                                                                            class="form-control input-set-2" required
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
                                                                                                class="form-control input-set-2"  >
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
                                                                                                class="form-control input-set-2" 
                                                                                                placeholder="Occupation">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label>Company Name</label>
                                                                                            <input name="spouse_company"
                                                                                            class="form-control input-set-2" 
                                                                                                type="text"
                                                                                                placeholder="Company">
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
                                                                                            Add Dependents
                                                                                        </button></br></br>
                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <div id="div_dep">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <button type="button" name="next"
                                                                                     id="second_next" disabled
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
                                                                            <fieldset id="set3">
                                                                                <div class="text-left">
                                                                                    <div class="col-lg-8">
                                                                                        <div class="form-group">
                                                                                            <label>Employer/Agency
                                                                                                Name</label>
                                                                                            <input name="agency"
                                                                                                class="form-control input-set-3"
                                                                                                placeholder="Employer/Agency Name"
                                                                                                required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label>Choose
                                                                                                Sector:</label>
                                                                                            <div class="radio">
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        value="Private Sector"
                                                                                                        name="sector">Private
                                                                                                    Sector
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        value="Government Sector"
                                                                                                        name="sector">Government
                                                                                                    Sector
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div> -->
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Choose Sector:
                                                                                            </label>
                                                                                            <select class="form-control input-set-3" required
                                                                                                name="sector">
                                                                                                <option value=""
                                                                                                    disabled selected>
                                                                                                    SELECT
                                                                                                </option>
                                                                                                <option
                                                                                                    value="Private Sector">
                                                                                                    Private Sector
                                                                                                </option>
                                                                                                <option
                                                                                                    value="Government Sector">
                                                                                                    Government Sector
                                                                                                </option>
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
                                                                                                class="form-control input-set-3" required
                                                                                                placeholder="Type of Business">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Complete Address of
                                                                                                Company</label>
                                                                                            <input type="text"
                                                                                                name="ca_company"
                                                                                                class="form-control input-set-3" required
                                                                                                placeholder="Complete Address of Company">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Assigned
                                                                                                Location</label>
                                                                                            <input name="location"
                                                                                                type="text"
                                                                                                class="form-control input-set-3" required
                                                                                                placeholder="Assigned Location">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Name of
                                                                                                Supervisor/COOR/Supervisor</label>
                                                                                            <input name="supervisor"
                                                                                                class="form-control input-set-3" required
                                                                                                type="text"
                                                                                                placeholder="Name of Supervisor/COOR/Supervisor">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Contact Number of
                                                                                                HR/COOR/Supervisor</label>
                                                                                            <input type="text"
                                                                                                name="hr_number"
                                                                                                class="form-control input-set-3" required
                                                                                                onkeypress="return onlyNumberKey(event)"
                                                                                                maxlength="11"
                                                                                                placeholder="Mobile number (e.g. 09123456789)">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Date Hired</label>
                                                                                            <input name="date_hired"
                                                                                                type="date"
                                                                                                class="form-control input-set-3" required
                                                                                                placeholder="Date Hired">
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- <div class="col-lg-12">
                                                                                        <div class="form-group">
                                                                                            <label>Employment
                                                                                                Status:</label>
                                                                                            <div class="radio">
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        value="Regular"
                                                                                                        name="e_status">Regular
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        value="Probationary"
                                                                                                        name="e_status">Probationary
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        value="Contractuary"
                                                                                                        name="e_status">Contractuary
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        value="Trainee"
                                                                                                        name="e_status">Trainee
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12"></div> -->
                                                                                    <div class="col-lg-3">
                                                                                        <div class="form-group">
                                                                                            <label>Employment Status:
                                                                                            </label>
                                                                                            <select  class="form-control input-set-3" required
                                                                                                name="e_status">
                                                                                                <option value=""
                                                                                                    disabled selected>
                                                                                                    SELECT
                                                                                                </option>
                                                                                                <option value="REGULAR">
                                                                                                    Regular
                                                                                                </option>
                                                                                                <option
                                                                                                    value="PROBATIONARY">
                                                                                                    Probationary
                                                                                                </option>
                                                                                                <option
                                                                                                    value="CASUAL">
                                                                                                    Casual
                                                                                                </option>
                                                                                                <option value="TRAINEE">
                                                                                                    Trainee
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- <div class="col-lg-12">
                                                                                        <div class="form-group">
                                                                                            <label>Mode of
                                                                                                Salary:</label>
                                                                                            <div class="radio">
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        value="Cash"
                                                                                                        name="m_salary">Cash
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        value="ATM"
                                                                                                        name="m_salary">ATM
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        value="Check"
                                                                                                        name="m_salary">Check
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div> -->
                                                                                    <div class="col-lg-3">
                                                                                        <div class="form-group">
                                                                                            <label>Mode of Salary:
                                                                                            </label>
                                                                                            <select  class="form-control input-set-3" required
                                                                                                name="m_salary">
                                                                                                <option value=""
                                                                                                    disabled selected>
                                                                                                    SELECT
                                                                                                </option>
                                                                                                <option value="ATM">
                                                                                                    ATM
                                                                                                </option>
                                                                                                <option value="Cash">
                                                                                                    Cash
                                                                                                </option>
                                                                                                <option value="Check">
                                                                                                    Check
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-3">
                                                                                        <div class="form-group">
                                                                                            <label>Bank Name</label>
                                                                                            <input type="text"
                                                                                                name="bank"
                                                                                                class="form-control input-set-3" required
                                                                                                placeholder="Bank Name">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-3">
                                                                                        <div class="form-group">
                                                                                            <label>Type of ATM
                                                                                                Card</label>
                                                                                            <input name="t_card"
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                placeholder="Type of ATM Card">
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label>Do you have other
                                                                                                loan?</label>
                                                                                            <div class="radio">
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        name="loan"
                                                                                                        id="Yes"
                                                                                                        value="Specify"
                                                                                                        onclick="enableField('Yes', 'yes')">Yes
                                                                                                    (Specify):
                                                                                                </label>
                                                                                                <input type="text"
                                                                                                    name="loan_spec"
                                                                                                    id="yes"
                                                                                                    class="form-group"
                                                                                                    disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        name="loan"
                                                                                                        id="No"
                                                                                                        value="No"
                                                                                                        onclick="enableField('No', 'yes')">No

                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div> -->
                                                                                    <div class="col-lg-3">
                                                                                        <div class="form-group">
                                                                                            <label>Do you have other
                                                                                                loan?</label>
                                                                                            <select class="form-control input-set-3" required
                                                                                                onchange="lwChange(this, 'loan_spec')"
                                                                                                name="loan">
                                                                                                <option value=""
                                                                                                    selected disabled>
                                                                                                    SELECT</option>
                                                                                                <option value="Yes">
                                                                                                    Yes
                                                                                                </option>
                                                                                                <option value="No">
                                                                                                    No
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-3">
                                                                                        <label for="">Specify:
                                                                                        </label>
                                                                                        <input type="text"
                                                                                            name="loan_spec"
                                                                                            id="loan_spec"
                                                                                            class="form-control input-set-3"
                                                                                            disabled="true">
                                                                                    </div>
                                                                                    <div class="col-lg-3">
                                                                                        <div class="form-group">
                                                                                            <label>Monthly Salary
                                                                                                (Net/Gross)</label>
                                                                                            <input name="ms_salary"
                                                                                                type="text"
                                                                                                class="form-control text-right input-set-3" required
                                                                                                maxlength="10"
                                                                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                                                                placeholder="₱">
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- <div class="col-lg-12">
                                                                                        <div class="form-group">
                                                                                            <label>Salary
                                                                                                Period:</label>
                                                                                            <div class="radio">
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        value="5/20"
                                                                                                        name="s_period">5/20
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        value="6/21"
                                                                                                        name="s_period">6/21
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        value="7/22"
                                                                                                        name="s_period">7/22
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        value="8/23"
                                                                                                        name="s_period">8/23
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        value="10/25"
                                                                                                        name="s_period">10/25
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        value="15/30"
                                                                                                        name="s_period">15/30
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        name="s_period">Weekly
                                                                                                    (every Friday)
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                                <label>
                                                                                                    <input type="radio"
                                                                                                        name="s_period">Every 2nd Saturday
                                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div> -->
                                                                                    <div class="col-lg-3">
                                                                                        <div class="form-group">
                                                                                            <label>Salary Period:
                                                                                            </label>
                                                                                            <select class="form-control"
                                                                                                name="s_period">
                                                                                                <option value=""
                                                                                                    disabled selected>
                                                                                                    SELECT
                                                                                                </option>
                                                                                                <option value="5/20">
                                                                                                    5/20
                                                                                                </option>
                                                                                                <option value="6/21">
                                                                                                    6/21
                                                                                                </option>
                                                                                                <option value="7/22">
                                                                                                    7/22
                                                                                                </option>
                                                                                                <option value="8/23">
                                                                                                    8/23
                                                                                                </option>
                                                                                                <option value="10/25">
                                                                                                    10/25
                                                                                                </option>
                                                                                                <option value="15/30">
                                                                                                    15/30
                                                                                                </option>
                                                                                                <option
                                                                                                    value="Weekly">
                                                                                                    Weekly (Every
                                                                                                    Friday)
                                                                                                </option>
                                                                                                <option
                                                                                                    value="Every 2nd Saturday">
                                                                                                    Every 2nd Saturday
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12"></div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label>Other Source of
                                                                                                Income</label>
                                                                                            <input name="os_income"
                                                                                                type="text"
                                                                                                 class="form-control input-set-3" required
                                                                                                placeholder="Other Source of Income">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label>(Specify)</label>
                                                                                            <input name="s_specify"
                                                                                                type="text"
                                                                                                 class="form-control input-set-3" required
                                                                                                placeholder="Specify">
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- separator -->
                                                                                    <div class="col-lg-12">
                                                                                        <hr>
                                                                                    </div>
                                                                                </div>
                                                                                <button type="button" name="next"
                                                                                     id="third_next" disabled
                                                                                    class="next btn  btn-primary text-center pull-right"
                                                                                    style="margin-left: 10px;">
                                                                                    Next <i
                                                                                        class="fa fa-arrow-right"></i></button>
                                                                                <button type="button" name="previous"
                                                                                    id="second_previous"
                                                                                    class=" btn btn-default text-center pull-right"
                                                                                    value="Previous"> <i
                                                                                        class="fa fa-arrow-left"></i>
                                                                                    Prev</button>
                                                                            </fieldset>
                                                                            <fieldset id="set4">
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
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Loan Purpose:</label>
                                                                                            <select  class="form-control input-set-4" required
                                                                                                onchange="lwChange(this, 'specPurp')"
                                                                                                name="loan_purpose">
                                                                                                <option value=""
                                                                                                    selected disabled>
                                                                                                    SELECT</option>
                                                                                                <option value="Medical">
                                                                                                    Medical
                                                                                                </option>
                                                                                                <option
                                                                                                    value="Educational">
                                                                                                    Educational</option>
                                                                                                <option
                                                                                                    value="Pay Bills">
                                                                                                    Pay Bills
                                                                                                </option>
                                                                                                <option
                                                                                                    value="Vehicle maintenance and fees">
                                                                                                    Vehicle maintenance
                                                                                                    and fees</option>
                                                                                                <option
                                                                                                    value="Special Occassion">
                                                                                                    Special Occassion
                                                                                                </option>
                                                                                                <option
                                                                                                    value="Business">
                                                                                                    Business
                                                                                                </option>
                                                                                                <option value="Travel">
                                                                                                    Travel</option>
                                                                                                <option
                                                                                                    value="Debt Consolodation">
                                                                                                    Debt Consolodation
                                                                                                </option>
                                                                                                <option
                                                                                                    value="General Expenses">
                                                                                                    General Expenses
                                                                                                </option>
                                                                                                <option value="Others">
                                                                                                    Others
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <label for="">Others (Specify):
                                                                                        </label>
                                                                                        <input type="text"
                                                                                            name="specPurp"
                                                                                            id="specPurp"
                                                                                             class="form-control"
                                                                                            disabled="true">
                                                                                    </div>

                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Contact No.</label>
                                                                                            <input name="contact_num"
                                                                                                maxlength="11"
                                                                                                onkeypress="return onlyNumberKey(event)"
                                                                                                class="form-control input-set-4" required
                                                                                                placeholder="Mobile number (e.g. 09123456789)">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Source:</label>
                                                                                            <select class="form-control input-set-4" required
                                                                                                onchange="lwChange(this, 'specSource')"
                                                                                                name="source">
                                                                                                <option value=""
                                                                                                    selected disabled>
                                                                                                    SELECT</option>
                                                                                                <option
                                                                                                    value="Facebook">
                                                                                                    Facebook
                                                                                                </option>
                                                                                                <option
                                                                                                    value="Leaflets">
                                                                                                    Leaflets</option>
                                                                                                <option
                                                                                                    value="Signage/Posters">
                                                                                                    Signage/Posters
                                                                                                </option>
                                                                                                <option
                                                                                                    value="Referral">
                                                                                                    Referral</option>
                                                                                                <option value="Banners">
                                                                                                    Banners</option>
                                                                                                <option value="Flyers">
                                                                                                    Flyers
                                                                                                </option>
                                                                                                <option value=" ">Word
                                                                                                    of Mouth</option>
                                                                                                <option value="Others">
                                                                                                    Others
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <label for="">Others (Specify):
                                                                                        </label>
                                                                                        <input type="text"
                                                                                            name="specSource"
                                                                                            id="specSource"
                                                                                            class="form-control"
                                                                                            disabled="true">
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Facebook:</label>
                                                                                            <input name="facebook"
                                                                                                type="text"
                                                                                                class="form-control input-set-4"
                                                                                                placeholder="Facebook Account">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label>Select file to upload</label>
                                                                                           
                                                                                            <input type="file" name="myFile" class="form-control input-set-4" id="fileToUpload" accept="application/pdf" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <br><br><br><br>
                                                                                    <div class="col-lg-12">
                                                                                        <hr>
                                                                                    </div><br><br><br>
                                                                                    <div class="col-lg-12">
                                                                                        <span>
                                                                                            I hereby certify that the
                                                                                            information provided in
                                                                                            this
                                                                                            form is complete, true
                                                                                            and
                                                                                            correct to the best of
                                                                                            my
                                                                                            knowledge.<b>I hold Una
                                                                                                Amigo
                                                                                                Lending
                                                                                                Corporation</b> free
                                                                                            from
                                                                                            liability from any law
                                                                                            particularly the Data
                                                                                            Privacy Act CRA 10173. I
                                                                                            also confirm that <b>Una
                                                                                                Amigo
                                                                                                Lending
                                                                                                Corporation</b>
                                                                                            fully
                                                                                            explained to me the
                                                                                            contents
                                                                                            of my loan application
                                                                                            including its terms,
                                                                                            rates
                                                                                            and other important
                                                                                            details
                                                                                            in a language known and
                                                                                            understood by me. <b>I
                                                                                                agree</b>
                                                                                            <input name="agree"
                                                                                                id="agree" disabled
                                                                                                onclick="enableButton()"
                                                                                                value="disagree"
                                                                                                style="transform: scale(1.3);transform: translate(1px, 2px);"
                                                                                                type="checkbox">
                                                                                            <br><br>
                                                                                        </span>
                                                                                    </div>

                                                                                </div><br><br>
                                                                                <button type="button" name="submit_add"
                                                                                    id="submit_add" disabled
                                                                                    class="next btn  btn-primary text-center pull-right"
                                                                                    style="margin-left: 10px;">
                                                                                    Save <i
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
                                </div>
                            </div>
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
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
    <script src="../css/toast/beautyToast.js"></script>
    <!-- <script src="../js/validate.js"></script> -->
    <script>
    function showSpouse(val) {
        // var x = document.getElementById("div_spouse").value;
        if (val == "Married") {
            // alert("hello");
            document.getElementById('div_spouse').style.display = "block";
            populate("spob_province",  "", "");
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
            '"><div class="col-lg-3"><div class="form-group"><label>Name of Children</label><input name="dep_child[]" type="text" class="form-control" placeholder="Name of Children"></div></div><div class="col-lg-2"><div class="form-group"><label>Date of birth</label><input type="date" name="dep_dob[]" class="form-control" placeholder="Date of birth"></div></div><div class="col-lg-1"><button type="button" class="btn btn-danger btn-circle" onclick="removeDependent(' +
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
            '"><div class="col-lg-3"><div class="form-group"><label>Name of Relative</label><input name="dep_relative[]" class="form-control" placeholder="Name of Relative"></div></div><div class="col-lg-3"><div class="form-group"><label>Contact No.</label><input onkeypress="return onlyNumberKey(event)" type="text" name="dep_rcontact[]" maxlength="11" class="form-control" placeholder="Mobile number (e.g. 09123456789)"></div></div><div class="col-lg-3"><div class="form-group"><label>Relationship</label><input name="dep_relationship[]" class="form-control" placeholder="Relationship"></div></div><div class="col-lg-2"><div class="form-group"><label>Time Available</label><input name="dep_ta[]" class="form-control" type="time"></div></div><div class="col-lg-1"><button type="button" class="btn btn-danger btn-circle" onclick="removeDependentChar(' +
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

    function enableButton() {
        if ($('#agree').val() == "disagree") {
            $('#agree').val("agree")
            $('#submit_add').attr('disabled', false);
        } else if ($('#agree').val() == "agree") {
            $('#agree').val("disagree")
            $('#submit_add').attr('disabled', true);
        };
    }


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

    function viewMap(url) {
        $("#gmap_canvas").attr("src", "https://maps.google.com/maps?q=" + $('#' + url).val() +
            "&t=&z=13&ie=UTF8&iwloc=&output=embed");
    }
    </script>
    <script src="../js/multi-step.js"></script>

    <script>
    $(document).ready(() => {
        $('.input-set-1').on("input", () => {
            controlStep('#set1', '#first_next');
        });

        $('.input-set-1').change(() => {
            controlStep('#set1', '#first_next');
        });


        $('.input-set-2').on("input", () => {
            controlStep('#set2', '#second_next');
        });

        $('.input-set-2').change(() => {
            controlStep('#set2', '#second_next');
        });


        $('.input-set-3').on("input", () => {
            controlStep('#set3', '#third_next');
        });

        $('.input-set-3').change(() => {
            controlStep('#set3', '#third_next');
        });

        $('.input-set-4').on("input", () => {
            controlStep('#set4', '#agree');
        });
        
        $('.input-set-4').change(() => {
            controlStep('#set4', '#agree');
        });

        


        // $('#first_next').click(() => {
        //     $('input').on("input", () => {
        //         if($('#m_status').val() != "Married"){
        //             controlStep('#set2', '#second_next');
        //         }else{
        //             controlStep('#set2', '#third_next');
        //         }
        //     });  
        // });
        // $('#second_next').click(() => {
        //     $('input').on("input", () => {
        //         controlStep('#set2', '#third_next');
        //     });  
        // });
    });

    function controlStep(id, button) {

        $(id).find('input, select').each(function() {
            if (!$(this).prop('required')) {
                var required = $('input').filter('[required]:visible');
                var allRequired = true;
                required.each(function() {
                    if ($(this).val() == '') {
                        allRequired = false;
                    }
                });

                if (!allRequired) {
                    $(button).attr('disabled', true);
                } else {
                    $(button).attr('disabled', false);
                }
            } else {

            }
        });
    }
    </script>

    <script>
    
    populate("pob_province", "", "");
    populate("province", "", "");
    populate("province2", "", "");


    function populate(select, prevVal, val) {

        let mainSelect = document.getElementById(select);

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
                
                let compare = (a, b) => {
                    if(a.province_list < b.province_list){
                        return -1;
                    }
                    if(a.province_list > b.province_list){
                        return 1;
                    }
                    return 0;
                }

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
                //         for (key in Object.keys(data[region].province_list)) {
                //             elOption = frag.appendChild(document.createElement('option'));
                //             elOption.value = Object.keys(data[region].province_list)[key];
                //             elOption.text = `${Object.keys(data[region].province_list)[key]}`;
                //         }
                //     } else if (select === "city" || select === "city2" || select === "pob_city" || select ===
                //         "spob_city" || select === "spouse_city") {
                //         for (key in Object.keys(data[region].province_list[val].municipality_list)) {
                //             elOption = frag.appendChild(document.createElement('option'));
                //             elOption.value = Object.keys(data[region].province_list[val].municipality_list)[key];
                //             elOption.text =
                //                 `${Object.keys(data[region].province_list[val].municipality_list)[key]}`;
                //         }

                //     } else if (select === "brgy" || select === "brgy2" || select === "spouse_brgy") {

                //         for (key in Object.keys(data[region].province_list[document.getElementById(prevVal).value]
                //                 .municipality_list[val].barangay_list)) {
                //             elOption = frag.appendChild(document.createElement('option'));
                //             elOption.value = data[region].province_list[document.getElementById(prevVal).value]
                //                 .municipality_list[val].barangay_list[key];
                //             elOption.text =
                //                 `${data[region].province_list[document.getElementById(prevVal).value].municipality_list[val].barangay_list[key]}`;
                //         }
                //     }

                // }
                    if (select !== "province" || select !== "province2" || select != "spob_province" || select !=
                        "spouse_province" || select !== "pob_province") {
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
                        }
                    } else if (select === "city" || select === "city2" || select === "pob_city" || select ===
                        "spob_city" || select === "spouse_city") {
                        for (key in Object.keys(data.province_list[val].municipality_list)) {
                            elOption = frag.appendChild(document.createElement('option'));
                            elOption.value = Object.keys(data.province_list[val].municipality_list)[key];
                            elOption.text =
                                `${Object.keys(data.province_list[val].municipality_list)[key]}`;
                        }
                        

                    } else if (select === "brgy" || select === "brgy2" || select === "spouse_brgy") {

                        for (key in Object.keys(data.province_list[document.getElementById(prevVal).value]
                                .municipality_list[val].barangay_list)) {
                            elOption = frag.appendChild(document.createElement('option'));
                            elOption.value = data.province_list[document.getElementById(prevVal).value]
                                .municipality_list[val].barangay_list[key];
                            elOption.text =
                                `${data.province_list[document.getElementById(prevVal).value].municipality_list[val].barangay_list[key]}`;
                        }
                    }
                mainSelect.appendChild(frag);

                // mainSelect.html(mainSelect.find('option').sort(function(option1, option2){
                //     return $(option1).text() < $(option2) ? -1 : 1;
                // }));
            }
        };
        xhr.open(method, url, true);
        xhr.send();
    }
    </script>

    <script>
    $("#submit_add").click(function() {
        $('#progressbar').css('display', 'none');
        $('#p-label').css('display', 'none');

        var form = $('#msform')[0];
        // Create an FormData object 

        var _data = new FormData(form);

        $.ajax({
            type: 'POST',
            url: '../request/reg_add.php',
            enctype: 'multipart/form-data',
            data: _data,
            processData: false,
            contentType: false,
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
                        window.location.replace(`loan_application_1.php?id=${response.code}`);
                    }, 2500);
                }, 2000);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });
    </script>

</body>

</html>
<?php
//}else{
 //   header('location: index.php');
}
?>