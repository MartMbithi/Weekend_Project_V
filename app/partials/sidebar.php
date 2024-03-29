<?php
/* Load System Settings */
$ret = "SELECT * FROM  settings";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($settings = $res->fetch_object()) {
    /* System Settings */
    $payment_module = $settings->payment_module_status;
    /* User ID */
    $user_id = $_SESSION['user_id'];
    /* User Access Level */
    $access_level = $_SESSION['user_access_level'];

    if ($access_level == 'admin' || $access_level == 'doctor') {
        /* Doctor / Admin Analytics */
?>
        <div class="deznav">
            <div class="deznav-scroll">
                <ul class="metismenu" id="menu">
                    <li><a href="dashboard" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-home"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li><a href="doctors" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-heart"></i>
                            <span class="nav-text">Doctors</span>
                        </a>
                    </li>
                    <li><a href="patients" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-user"></i>
                            <span class="nav-text">Patients</span>
                        </a>
                    </li>
                    <li><a href="appointments" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-calendar"></i>
                            <span class="nav-text">Appointments</span>
                        </a>
                    </li>
                    <li><a href="medical_records" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-notepad"></i>
                            <span class="nav-text">Diagnosis</span>
                        </a>
                    </li>
                    <?php if ($payment_module == 'active') { ?>
                        <li><a href="bills" class="ai-icon" aria-expanded="false">
                                <i class="flaticon-381-diploma"></i>
                                <span class="nav-text">Bills</span>
                            </a>
                        </li>
                    <?php } ?>
                    <li><a href="settings" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-settings"></i>
                            <span class="nav-text">Settings</span>
                        </a>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-381-layer"></i>
                            <span class="nav-text">Reports</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="reports_doctors">Doctors</a></li>
                            <li><a href="reports_patients">Patients</a></li>
                            <li><a href="reports_apponitments">Appointments</a></li>
                            <?php if ($payment_module == 'active') { ?>
                                <li><a href="reports_bills">Bills</a></li>
                            <?php } ?>
                            <li><a href="reports_surveys">Surveys</a></li>
                        </ul>
                    </li>
                    <li><a href="logout" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-exit"></i>
                            <span class="nav-text">Log Out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    <?php } else { ?>
        <div class="deznav">
            <div class="deznav-scroll">
                <ul class="metismenu" id="menu">
                    <li><a href="my_dashboard" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-home"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li><a href="my_profile" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-user"></i>
                            <span class="nav-text">My Profile</span>
                        </a>
                    </li>
                    <li><a href="my_appointments" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-calendar"></i>
                            <span class="nav-text">Appointments</span>
                        </a>
                    </li>
                    <li><a href="my_medical_records" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-notepad"></i>
                            <span class="nav-text">Diagnosis</span>
                        </a>
                    </li>
                    <?php if ($payment_module == 'active') { ?>
                        <li><a href="my_bills" class="ai-icon" aria-expanded="false">
                                <i class="flaticon-381-diploma"></i>
                                <span class="nav-text">Bills</span>
                            </a>
                        </li>
                    <?php } ?>
                    <li><a href="my_survey" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-file"></i>
                            <span class="nav-text">Surveys</span>
                        </a>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-381-layer"></i>
                            <span class="nav-text">Reports</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="my_reports_apponitments">Appointments</a></li>
                            <?php if ($payment_module == 'active') { ?>
                                <li><a href="my_reports_bills">Bills</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li><a href="logout" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-exit"></i>
                            <span class="nav-text">Log Out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
<?php }
} ?>