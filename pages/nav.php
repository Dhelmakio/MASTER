<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">LOAN MANAGEMENT SYSTEM</a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-nav navbar-left navbar-top-links">
                    <!-- <li><a href="#"><i class="fa fa-home fa-fw"></i> Website</a></li> -->
                </ul>

                <ul class="nav navbar-right navbar-top-links">
                    
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['name'];?> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <!-- <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li> -->
                            <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                            </li>
                            <!-- <?php 
                               // if($_SESSION['access'] == 1 || $_SESSION['access'] == 2){
                                    ?> -->
                            <li>
                                <a href="index.php" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            <?php
                                //}
                            ?>
                            <?php 
                               // if($_SESSION['access'] != 4 && $_SESSION['access'] != 2){ //CI
                            ?>
                            <li>
                                <a href="registry_applicant.php"><i class="fa fa-users fa-fw"></i> Registry</a>
                            </li>
                            
                            <li>
                                <a href="#"><i class="fa fa-bar-chart fa-fw"></i> Loan Application<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="registry_application.php">New</a>
                                    </li>
                                    <li>
                                        <a href="loan_application_renewal.php">Renewal</a>
                                    </li>
                                    <li>
                                        <a href="loan_application_reloan.php">Reloan</a>
                                    </li>
                                    <li>
                                        <a href="loan_application_additional.php">Additional</a>
                                    </li>
                                    <!-- <li>
                                        <a href="util_interest.php">Interest</a>
                                    </li> -->
                                    <!-- <li>
                                        <a href="login.html">Discount</a>
                                    </li> -->
                                    
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <?php
                             //   }
                            ?>
                            <?php 
                             //   if($_SESSION['access'] == 1 || $_SESSION['access'] == 4){ //CI
                                    ?>
                            <li>
                                <a href="loan_credit_investigation.php" class="active"><i class="fa fa-user-secret fa-fw"></i>Credit Investigate</a>
                            </li>
                            <?php
                              //  }
                            ?>

                            <?php 
                               // if($_SESSION['access'] == 1 || $_SESSION['access'] == 2){ // approver
                            ?>
                                <li>
                                <a href="loan_approval.php" class="active"><i class="fa fa-check fa-fw"></i>Loan Approval</a>
                                </li>
                            <?php
                              //  }
                            ?>

                                    <!-- <li>
                                        <a href="#"><i class="fa fa-address-card fa-fw"></i> Loan Approval & Validation<span class="fa arrow"></span></a>
                                        <ul class="nav nav-second-level">
                                            <li>
                                                <a href="loan_credit_investigation.php">Credit Investigation</a>
                                            </li>
                                            <li>
                                                <a href="loan_approval.php">Approval</a>
                                            </li>
                                            
                                        </ul>
                                    </li> -->
                            
                           
                            

                            
                            
                            
                        </ul>
                    </div>
                </div>
            </nav>