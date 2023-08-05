<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.php">LOAN MANAGEMENT SYSTEM</a>
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
                <li>
                    <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="registry_applicant.php"><i class="fa fa-users fa-fw"></i> Registry</a>
                <li>
                    <a href="#"><i class="fa fa-bar-chart fa-fw"></i> Loan Application<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="loan_application_new.php">New</a>
                        </li>
                        <li>
                            <a href="loan_application_reloan.php">Reloan</a>
                        </li>
                        <li>
                            <a href="loan_application_additional.php">Additional</a>
                        </li>
                        <li>
                            <a href="loan_application_renewal.php">Renewal</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="loan_credit_investigation.php"><i class="fa fa-user-secret fa-fw"></i> Credit
                        Investigate</a>
                </li>
                <li>
                    <a href="process_loan.php"><i class="fa fa-spinner"></i> Process Loan</a>
                </li>
                <li>
                    <a href="loan_approval.php"><i class="fa fa-check fa-fw"></i> Loan Approval</a>
                <!-- </li>
                <li>
                    <a href="setting_notarial.php"><i class="fa fa-money fa-fw"></i> Notarial Fee</a>
                </li> -->
                <li>
                    <a href="#"><i class="fa fa-cogs fa-fw"></i> Settings<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="setting_notarial.php"> Notarial Fee</a>
                        </li>
                        <li>
                            <a href="setting_sukli.php"> Sukli</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>