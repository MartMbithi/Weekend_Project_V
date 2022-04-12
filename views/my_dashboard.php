<?php
session_start();
require_once '../app/settings/config.php';
require_once('../app/settings/checklogin.php');
check_login();
require_once('../app/helpers/analytics.php');
require_once('../app/partials/head.php');
$user_id = $_SESSION['user_id'];
?>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php require_once('../app/partials/header.php'); ?>

        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php require_once('../app/partials/sidebar.php'); ?>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <?php
                $ret = "SELECT * FROM  settings";
                $stmt = $mysqli->prepare($ret);
                $stmt->execute(); //ok
                $res = $stmt->get_result();
                while ($settings = $res->fetch_object()) {
                    /* Payment Module Enabled? */
                    if ($settings->payment_module_status == 'active') { ?>
                        <div class="form-head d-flex mb-3 mb-md-4 align-items-start">
                            <div class="mr-auto d-none d-lg-block">
                                <h3 class="text-black font-w600">Welcome to <?php echo $settings->sys_name; ?>!</h3>
                                <p class="mb-0 fs-18"><?php echo $settings->sys_tagline; ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <a href="my_appointments">
                                    <div class="card gradient-bx text-white bg-info rounded">
                                        <div class="card-body">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <p class="mb-1">Appointments</p>
                                                    <div class="d-flex flex-wrap">
                                                        <h2 class="fs-40 font-w600 text-white mb-0 mr-3"><?php echo $appointments; ?></h2>
                                                    </div>
                                                </div>
                                                <span class="border rounded-circle p-4">
                                                    <svg width="34" height="34" viewBox="0 0 40 40" fill="none" xmlns="../../www.w3.org/2000/svg.html">
                                                        <g clip-path="url(#clip0)">
                                                            <path d="M35 5H33.3333C33.3333 3.67392 32.8065 2.40215 31.8689 1.46447C30.9312 0.526784 29.6594 0 28.3333 0C27.0072 0 25.7355 0.526784 24.7978 1.46447C23.8601 2.40215 23.3333 3.67392 23.3333 5H16.6667C16.6667 3.67392 16.1399 2.40215 15.2022 1.46447C14.2645 0.526784 12.9927 7.45058e-08 11.6667 7.45058e-08C10.3406 7.45058e-08 9.06881 0.526784 8.13113 1.46447C7.19345 2.40215 6.66667 3.67392 6.66667 5H5C3.67392 5 2.40215 5.52678 1.46447 6.46447C0.526784 7.40215 0 8.67392 0 10L0 35C0 36.3261 0.526784 37.5979 1.46447 38.5355C2.40215 39.4732 3.67392 40 5 40H35C36.3261 40 37.5979 39.4732 38.5355 38.5355C39.4732 37.5979 40 36.3261 40 35V10C40 8.67392 39.4732 7.40215 38.5355 6.46447C37.5979 5.52678 36.3261 5 35 5ZM5 8.33333H6.66667C6.66667 9.65942 7.19345 10.9312 8.13113 11.8689C9.06881 12.8065 10.3406 13.3333 11.6667 13.3333C12.1087 13.3333 12.5326 13.1577 12.8452 12.8452C13.1577 12.5326 13.3333 12.1087 13.3333 11.6667C13.3333 11.2246 13.1577 10.8007 12.8452 10.4882C12.5326 10.1756 12.1087 10 11.6667 10C11.2246 10 10.8007 9.8244 10.4882 9.51184C10.1756 9.19928 10 8.77536 10 8.33333V5C10 4.55797 10.1756 4.13405 10.4882 3.82149C10.8007 3.50893 11.2246 3.33333 11.6667 3.33333C12.1087 3.33333 12.5326 3.50893 12.8452 3.82149C13.1577 4.13405 13.3333 4.55797 13.3333 5V6.66667C13.3333 7.10869 13.5089 7.53262 13.8215 7.84518C14.134 8.15774 14.558 8.33333 15 8.33333H23.3333C23.3333 9.65942 23.8601 10.9312 24.7978 11.8689C25.7355 12.8065 27.0072 13.3333 28.3333 13.3333C28.7754 13.3333 29.1993 13.1577 29.5118 12.8452C29.8244 12.5326 30 12.1087 30 11.6667C30 11.2246 29.8244 10.8007 29.5118 10.4882C29.1993 10.1756 28.7754 10 28.3333 10C27.8913 10 27.4674 9.8244 27.1548 9.51184C26.8423 9.19928 26.6667 8.77536 26.6667 8.33333V5C26.6667 4.55797 26.8423 4.13405 27.1548 3.82149C27.4674 3.50893 27.8913 3.33333 28.3333 3.33333C28.7754 3.33333 29.1993 3.50893 29.5118 3.82149C29.8244 4.13405 30 4.55797 30 5V6.66667C30 7.10869 30.1756 7.53262 30.4882 7.84518C30.8007 8.15774 31.2246 8.33333 31.6667 8.33333H35C35.442 8.33333 35.866 8.50893 36.1785 8.82149C36.4911 9.13405 36.6667 9.55797 36.6667 10V16.6667H3.33333V10C3.33333 9.55797 3.50893 9.13405 3.82149 8.82149C4.13405 8.50893 4.55797 8.33333 5 8.33333ZM35 36.6667H5C4.55797 36.6667 4.13405 36.4911 3.82149 36.1785C3.50893 35.866 3.33333 35.442 3.33333 35V20H36.6667V35C36.6667 35.442 36.4911 35.866 36.1785 36.1785C35.866 36.4911 35.442 36.6667 35 36.6667Z" fill="white" />
                                                            <path d="M20 26.6667C20.9205 26.6667 21.6667 25.9205 21.6667 25C21.6667 24.0795 20.9205 23.3333 20 23.3333C19.0795 23.3333 18.3333 24.0795 18.3333 25C18.3333 25.9205 19.0795 26.6667 20 26.6667Z" fill="white" />
                                                            <path d="M30 26.6667C30.9205 26.6667 31.6667 25.9205 31.6667 25C31.6667 24.0795 30.9205 23.3333 30 23.3333C29.0796 23.3333 28.3334 24.0795 28.3334 25C28.3334 25.9205 29.0796 26.6667 30 26.6667Z" fill="white" />
                                                            <path d="M9.99995 26.6667C10.9204 26.6667 11.6666 25.9205 11.6666 25C11.6666 24.0795 10.9204 23.3333 9.99995 23.3333C9.07947 23.3333 8.33328 24.0795 8.33328 25C8.33328 25.9205 9.07947 26.6667 9.99995 26.6667Z" fill="white" />
                                                            <path d="M20 33.3334C20.9205 33.3334 21.6667 32.5872 21.6667 31.6667C21.6667 30.7462 20.9205 30 20 30C19.0795 30 18.3333 30.7462 18.3333 31.6667C18.3333 32.5872 19.0795 33.3334 20 33.3334Z" fill="white" />
                                                            <path d="M30 33.3334C30.9205 33.3334 31.6667 32.5872 31.6667 31.6667C31.6667 30.7462 30.9205 30 30 30C29.0796 30 28.3334 30.7462 28.3334 31.6667C28.3334 32.5872 29.0796 33.3334 30 33.3334Z" fill="white" />
                                                            <path d="M9.99995 33.3334C10.9204 33.3334 11.6666 32.5872 11.6666 31.6667C11.6666 30.7462 10.9204 30 9.99995 30C9.07947 30 8.33328 30.7462 8.33328 31.6667C8.33328 32.5872 9.07947 33.3334 9.99995 33.3334Z" fill="white" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0">
                                                                <rect width="40" height="40" fill="white" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="my_bills">
                                    <div class="card gradient-bx text-white bg-danger rounded">
                                        <div class="card-body">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <p class="mb-1">Pending Payments</p>
                                                    <div class="d-flex flex-wrap">
                                                        <h2 class="fs-40 font-w600 text-white mb-0 mr-3">Ksh <?php echo  number_format($pending_bills, 2); ?></h2>
                                                    </div>
                                                </div>
                                                <span class="border rounded-circle p-4">
                                                    <svg width="34" height="34" viewBox="0 0 21 35" fill="none" xmlns="../../www.w3.org/2000/svg.html">
                                                        <path d="M9.21864 35H11.6667V31.7747C17.7104 31.496 21.0001 27.7133 21.0001 23.413C21.0001 17.2412 15.7596 16.0865 11.6667 14.8919V8.72014C12.7378 9.11832 13.4645 10.0341 13.6175 11.5074H20.6175C20.2733 6.45051 16.9072 3.66325 11.6667 3.22526V0H9.21864V3.22526C4.01645 3.58362 6.10352e-05 6.53015 6.10352e-05 11.5074C6.10352e-05 17.7588 5.12574 18.9534 9.21864 20.0683V26.3595C7.91809 25.9215 7.15307 24.9261 7.00006 23.2935H0.0383124C0.229569 28.43 4.01645 31.2571 9.21864 31.7349V35ZM14.1531 23.6519C14.1531 25.1251 13.1968 26.2002 11.6667 26.479V20.8248C13.1585 21.4221 14.1531 22.2184 14.1531 23.6519ZM6.92356 11.1889C6.92356 9.63595 7.80334 8.75995 9.21864 8.52105V14.0557C7.84159 13.4187 6.92356 12.5825 6.92356 11.1889Z" fill="white" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="my_bills">
                                    <div class="card gradient-bx text-white bg-success rounded">
                                        <div class="card-body">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <p class="mb-1">Payments</p>
                                                    <div class="d-flex flex-wrap">
                                                        <h2 class="fs-40 font-w600 text-white mb-0 mr-3">Kes <?php echo number_format($paid_bills, 2); ?></h2>
                                                    </div>
                                                </div>
                                                <span class="border rounded-circle p-4">
                                                    <svg width="34" height="34" viewBox="0 0 21 35" fill="none" xmlns="../../www.w3.org/2000/svg.html">
                                                        <path d="M9.21864 35H11.6667V31.7747C17.7104 31.496 21.0001 27.7133 21.0001 23.413C21.0001 17.2412 15.7596 16.0865 11.6667 14.8919V8.72014C12.7378 9.11832 13.4645 10.0341 13.6175 11.5074H20.6175C20.2733 6.45051 16.9072 3.66325 11.6667 3.22526V0H9.21864V3.22526C4.01645 3.58362 6.10352e-05 6.53015 6.10352e-05 11.5074C6.10352e-05 17.7588 5.12574 18.9534 9.21864 20.0683V26.3595C7.91809 25.9215 7.15307 24.9261 7.00006 23.2935H0.0383124C0.229569 28.43 4.01645 31.2571 9.21864 31.7349V35ZM14.1531 23.6519C14.1531 25.1251 13.1968 26.2002 11.6667 26.479V20.8248C13.1585 21.4221 14.1531 22.2184 14.1531 23.6519ZM6.92356 11.1889C6.92356 9.63595 7.80334 8.75995 9.21864 8.52105V14.0557C7.84159 13.4187 6.92356 12.5825 6.92356 11.1889Z" fill="white" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-9 col-xxl-8 col-lg-7">
                                <div class="card">
                                    <div class="card-header border-0 pb-0">
                                        <h3 class="fs-20 mb-0 text-black">My Recent Appointments</h3>
                                        <a href="my_appointments" class="text-primary font-w500">View More</a>
                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <table class="table shadow-hover mb-4 dataTablesCard fs-14">
                                            <thead>
                                                <tr>
                                                    <th>Appointment Details</th>
                                                    <th>Doctor Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $ret = "SELECT * FROM  appointments a
                                        INNER JOIN users u ON u.user_id = a.app_doc_id
                                        WHERE a.app_user_id = '$user_id'";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($row = $res->fetch_object()) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            REF #: <?php echo $row->app_ref_code; ?> <br>
                                                            Status:
                                                            <?php if ($row->app_status == 'Pending') { ?>
                                                                <span class="text-danger">Pending</span><br>
                                                            <?php } elseif ($row->app_status == 'Approved') { ?>
                                                                <span class="text-success">Approved</span><br>
                                                            <?php } ?>
                                                            Date: <?php echo date('d M Y', strtotime($row->app_date)); ?>
                                                        </td>
                                                        <td>
                                                            Number: <?php echo $row->user_number; ?><br>
                                                            Name: <?php echo $row->user_name; ?><br>
                                                            Contacts: <?php echo $row->user_phone; ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-xxl-4 col-lg-5">
                                <div class="card border-0 pb-0">
                                    <div class="card-header flex-wrap border-0 pb-0">
                                        <h3 class="fs-20 mb-0 text-black">Bills Payment Logs</h3>
                                        <a href="my_bills" class="text-primary font-w500">View more</a>
                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <div id="DZ_W_TimeLine" class="widget-timeline dz-scroll height370">
                                            <ul class="timeline">
                                                <?php
                                                $ret = "SELECT * FROM bills b
                                        INNER JOIN diagonisis d ON d.diag_id = b.bill_diag_id
                                        INNER JOIN users u ON u.user_id = d.diag_patient_id
                                        WHERE u.user_id = '$user_id'
                                        ORDER BY bill_date_added ASC ";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($bills = $res->fetch_object()) {
                                                ?>
                                                    <li>
                                                        <div class="timeline-badge primary"></div>
                                                        <a class="timeline-panel text-muted" href="reports_bills">
                                                            <span><?php echo date('d M Y', strtotime($bills->bill_date_added)); ?></span>
                                                            <h6 class="mb-0"><?php echo $bills->user_number . ' ' . $bills->user_name; ?> Has Paid
                                                                <strong class="text-primary">Ksh <?php echo number_format($bills->bill_amount, 2); ?></strong>.<br>
                                                                REF No: <strong class="text-primary"><?php echo $bills->bill_ref_code; ?></strong>.
                                                            </h6>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="form-head d-flex mb-3 mb-md-4 align-items-start">
                            <div class="mr-auto d-none d-lg-block">
                                <h3 class="text-black font-w600">Welcome to <?php echo $settings->sys_name; ?>!</h3>
                                <p class="mb-0 fs-18"><?php echo $settings->sys_tagline; ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <a href="my_appointments">
                                    <div class="card gradient-bx text-white bg-info rounded">
                                        <div class="card-body">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <p class="mb-1">Appointments</p>
                                                    <div class="d-flex flex-wrap">
                                                        <h2 class="fs-40 font-w600 text-white mb-0 mr-3"><?php echo $appointments; ?></h2>
                                                    </div>
                                                </div>
                                                <span class="border rounded-circle p-4">
                                                    <svg width="34" height="34" viewBox="0 0 40 40" fill="none" xmlns="../../www.w3.org/2000/svg.html">
                                                        <g clip-path="url(#clip0)">
                                                            <path d="M35 5H33.3333C33.3333 3.67392 32.8065 2.40215 31.8689 1.46447C30.9312 0.526784 29.6594 0 28.3333 0C27.0072 0 25.7355 0.526784 24.7978 1.46447C23.8601 2.40215 23.3333 3.67392 23.3333 5H16.6667C16.6667 3.67392 16.1399 2.40215 15.2022 1.46447C14.2645 0.526784 12.9927 7.45058e-08 11.6667 7.45058e-08C10.3406 7.45058e-08 9.06881 0.526784 8.13113 1.46447C7.19345 2.40215 6.66667 3.67392 6.66667 5H5C3.67392 5 2.40215 5.52678 1.46447 6.46447C0.526784 7.40215 0 8.67392 0 10L0 35C0 36.3261 0.526784 37.5979 1.46447 38.5355C2.40215 39.4732 3.67392 40 5 40H35C36.3261 40 37.5979 39.4732 38.5355 38.5355C39.4732 37.5979 40 36.3261 40 35V10C40 8.67392 39.4732 7.40215 38.5355 6.46447C37.5979 5.52678 36.3261 5 35 5ZM5 8.33333H6.66667C6.66667 9.65942 7.19345 10.9312 8.13113 11.8689C9.06881 12.8065 10.3406 13.3333 11.6667 13.3333C12.1087 13.3333 12.5326 13.1577 12.8452 12.8452C13.1577 12.5326 13.3333 12.1087 13.3333 11.6667C13.3333 11.2246 13.1577 10.8007 12.8452 10.4882C12.5326 10.1756 12.1087 10 11.6667 10C11.2246 10 10.8007 9.8244 10.4882 9.51184C10.1756 9.19928 10 8.77536 10 8.33333V5C10 4.55797 10.1756 4.13405 10.4882 3.82149C10.8007 3.50893 11.2246 3.33333 11.6667 3.33333C12.1087 3.33333 12.5326 3.50893 12.8452 3.82149C13.1577 4.13405 13.3333 4.55797 13.3333 5V6.66667C13.3333 7.10869 13.5089 7.53262 13.8215 7.84518C14.134 8.15774 14.558 8.33333 15 8.33333H23.3333C23.3333 9.65942 23.8601 10.9312 24.7978 11.8689C25.7355 12.8065 27.0072 13.3333 28.3333 13.3333C28.7754 13.3333 29.1993 13.1577 29.5118 12.8452C29.8244 12.5326 30 12.1087 30 11.6667C30 11.2246 29.8244 10.8007 29.5118 10.4882C29.1993 10.1756 28.7754 10 28.3333 10C27.8913 10 27.4674 9.8244 27.1548 9.51184C26.8423 9.19928 26.6667 8.77536 26.6667 8.33333V5C26.6667 4.55797 26.8423 4.13405 27.1548 3.82149C27.4674 3.50893 27.8913 3.33333 28.3333 3.33333C28.7754 3.33333 29.1993 3.50893 29.5118 3.82149C29.8244 4.13405 30 4.55797 30 5V6.66667C30 7.10869 30.1756 7.53262 30.4882 7.84518C30.8007 8.15774 31.2246 8.33333 31.6667 8.33333H35C35.442 8.33333 35.866 8.50893 36.1785 8.82149C36.4911 9.13405 36.6667 9.55797 36.6667 10V16.6667H3.33333V10C3.33333 9.55797 3.50893 9.13405 3.82149 8.82149C4.13405 8.50893 4.55797 8.33333 5 8.33333ZM35 36.6667H5C4.55797 36.6667 4.13405 36.4911 3.82149 36.1785C3.50893 35.866 3.33333 35.442 3.33333 35V20H36.6667V35C36.6667 35.442 36.4911 35.866 36.1785 36.1785C35.866 36.4911 35.442 36.6667 35 36.6667Z" fill="white" />
                                                            <path d="M20 26.6667C20.9205 26.6667 21.6667 25.9205 21.6667 25C21.6667 24.0795 20.9205 23.3333 20 23.3333C19.0795 23.3333 18.3333 24.0795 18.3333 25C18.3333 25.9205 19.0795 26.6667 20 26.6667Z" fill="white" />
                                                            <path d="M30 26.6667C30.9205 26.6667 31.6667 25.9205 31.6667 25C31.6667 24.0795 30.9205 23.3333 30 23.3333C29.0796 23.3333 28.3334 24.0795 28.3334 25C28.3334 25.9205 29.0796 26.6667 30 26.6667Z" fill="white" />
                                                            <path d="M9.99995 26.6667C10.9204 26.6667 11.6666 25.9205 11.6666 25C11.6666 24.0795 10.9204 23.3333 9.99995 23.3333C9.07947 23.3333 8.33328 24.0795 8.33328 25C8.33328 25.9205 9.07947 26.6667 9.99995 26.6667Z" fill="white" />
                                                            <path d="M20 33.3334C20.9205 33.3334 21.6667 32.5872 21.6667 31.6667C21.6667 30.7462 20.9205 30 20 30C19.0795 30 18.3333 30.7462 18.3333 31.6667C18.3333 32.5872 19.0795 33.3334 20 33.3334Z" fill="white" />
                                                            <path d="M30 33.3334C30.9205 33.3334 31.6667 32.5872 31.6667 31.6667C31.6667 30.7462 30.9205 30 30 30C29.0796 30 28.3334 30.7462 28.3334 31.6667C28.3334 32.5872 29.0796 33.3334 30 33.3334Z" fill="white" />
                                                            <path d="M9.99995 33.3334C10.9204 33.3334 11.6666 32.5872 11.6666 31.6667C11.6666 30.7462 10.9204 30 9.99995 30C9.07947 30 8.33328 30.7462 8.33328 31.6667C8.33328 32.5872 9.07947 33.3334 9.99995 33.3334Z" fill="white" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0">
                                                                <rect width="40" height="40" fill="white" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="my_bills">
                                    <div class="card gradient-bx text-white bg-danger rounded">
                                        <div class="card-body">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <p class="mb-1">My Prescriptions</p>
                                                    <div class="d-flex flex-wrap">
                                                        <h2 class="fs-40 font-w600 text-white mb-0 mr-3"> <?php echo  $prescriptions; ?></h2>
                                                    </div>
                                                </div>
                                                <span class="border rounded-circle p-4">
                                                    <svg width="34" height="34" viewBox="0 0 40 40" fill="none" xmlns="../../www.w3.org/2000/svg.html">
                                                        <g clip-path="url(#clip0)">
                                                            <path d="M35 5H33.3333C33.3333 3.67392 32.8065 2.40215 31.8689 1.46447C30.9312 0.526784 29.6594 0 28.3333 0C27.0072 0 25.7355 0.526784 24.7978 1.46447C23.8601 2.40215 23.3333 3.67392 23.3333 5H16.6667C16.6667 3.67392 16.1399 2.40215 15.2022 1.46447C14.2645 0.526784 12.9927 7.45058e-08 11.6667 7.45058e-08C10.3406 7.45058e-08 9.06881 0.526784 8.13113 1.46447C7.19345 2.40215 6.66667 3.67392 6.66667 5H5C3.67392 5 2.40215 5.52678 1.46447 6.46447C0.526784 7.40215 0 8.67392 0 10L0 35C0 36.3261 0.526784 37.5979 1.46447 38.5355C2.40215 39.4732 3.67392 40 5 40H35C36.3261 40 37.5979 39.4732 38.5355 38.5355C39.4732 37.5979 40 36.3261 40 35V10C40 8.67392 39.4732 7.40215 38.5355 6.46447C37.5979 5.52678 36.3261 5 35 5ZM5 8.33333H6.66667C6.66667 9.65942 7.19345 10.9312 8.13113 11.8689C9.06881 12.8065 10.3406 13.3333 11.6667 13.3333C12.1087 13.3333 12.5326 13.1577 12.8452 12.8452C13.1577 12.5326 13.3333 12.1087 13.3333 11.6667C13.3333 11.2246 13.1577 10.8007 12.8452 10.4882C12.5326 10.1756 12.1087 10 11.6667 10C11.2246 10 10.8007 9.8244 10.4882 9.51184C10.1756 9.19928 10 8.77536 10 8.33333V5C10 4.55797 10.1756 4.13405 10.4882 3.82149C10.8007 3.50893 11.2246 3.33333 11.6667 3.33333C12.1087 3.33333 12.5326 3.50893 12.8452 3.82149C13.1577 4.13405 13.3333 4.55797 13.3333 5V6.66667C13.3333 7.10869 13.5089 7.53262 13.8215 7.84518C14.134 8.15774 14.558 8.33333 15 8.33333H23.3333C23.3333 9.65942 23.8601 10.9312 24.7978 11.8689C25.7355 12.8065 27.0072 13.3333 28.3333 13.3333C28.7754 13.3333 29.1993 13.1577 29.5118 12.8452C29.8244 12.5326 30 12.1087 30 11.6667C30 11.2246 29.8244 10.8007 29.5118 10.4882C29.1993 10.1756 28.7754 10 28.3333 10C27.8913 10 27.4674 9.8244 27.1548 9.51184C26.8423 9.19928 26.6667 8.77536 26.6667 8.33333V5C26.6667 4.55797 26.8423 4.13405 27.1548 3.82149C27.4674 3.50893 27.8913 3.33333 28.3333 3.33333C28.7754 3.33333 29.1993 3.50893 29.5118 3.82149C29.8244 4.13405 30 4.55797 30 5V6.66667C30 7.10869 30.1756 7.53262 30.4882 7.84518C30.8007 8.15774 31.2246 8.33333 31.6667 8.33333H35C35.442 8.33333 35.866 8.50893 36.1785 8.82149C36.4911 9.13405 36.6667 9.55797 36.6667 10V16.6667H3.33333V10C3.33333 9.55797 3.50893 9.13405 3.82149 8.82149C4.13405 8.50893 4.55797 8.33333 5 8.33333ZM35 36.6667H5C4.55797 36.6667 4.13405 36.4911 3.82149 36.1785C3.50893 35.866 3.33333 35.442 3.33333 35V20H36.6667V35C36.6667 35.442 36.4911 35.866 36.1785 36.1785C35.866 36.4911 35.442 36.6667 35 36.6667Z" fill="white" />
                                                            <path d="M20 26.6667C20.9205 26.6667 21.6667 25.9205 21.6667 25C21.6667 24.0795 20.9205 23.3333 20 23.3333C19.0795 23.3333 18.3333 24.0795 18.3333 25C18.3333 25.9205 19.0795 26.6667 20 26.6667Z" fill="white" />
                                                            <path d="M30 26.6667C30.9205 26.6667 31.6667 25.9205 31.6667 25C31.6667 24.0795 30.9205 23.3333 30 23.3333C29.0796 23.3333 28.3334 24.0795 28.3334 25C28.3334 25.9205 29.0796 26.6667 30 26.6667Z" fill="white" />
                                                            <path d="M9.99995 26.6667C10.9204 26.6667 11.6666 25.9205 11.6666 25C11.6666 24.0795 10.9204 23.3333 9.99995 23.3333C9.07947 23.3333 8.33328 24.0795 8.33328 25C8.33328 25.9205 9.07947 26.6667 9.99995 26.6667Z" fill="white" />
                                                            <path d="M20 33.3334C20.9205 33.3334 21.6667 32.5872 21.6667 31.6667C21.6667 30.7462 20.9205 30 20 30C19.0795 30 18.3333 30.7462 18.3333 31.6667C18.3333 32.5872 19.0795 33.3334 20 33.3334Z" fill="white" />
                                                            <path d="M30 33.3334C30.9205 33.3334 31.6667 32.5872 31.6667 31.6667C31.6667 30.7462 30.9205 30 30 30C29.0796 30 28.3334 30.7462 28.3334 31.6667C28.3334 32.5872 29.0796 33.3334 30 33.3334Z" fill="white" />
                                                            <path d="M9.99995 33.3334C10.9204 33.3334 11.6666 32.5872 11.6666 31.6667C11.6666 30.7462 10.9204 30 9.99995 30C9.07947 30 8.33328 30.7462 8.33328 31.6667C8.33328 32.5872 9.07947 33.3334 9.99995 33.3334Z" fill="white" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0">
                                                                <rect width="40" height="40" fill="white" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-12 col-xxl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header border-0 pb-0">
                                        <h3 class="fs-20 mb-0 text-black">My Recent Appointments</h3>
                                        <a href="my_appointments" class="text-primary font-w500">View More</a>
                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <table class="table shadow-hover mb-4 dataTablesCard fs-14">
                                            <thead>
                                                <tr>
                                                    <th>Appointment Details</th>
                                                    <th>Doctor Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $ret = "SELECT * FROM  appointments a
                                        INNER JOIN users u ON u.user_id = a.app_doc_id
                                        WHERE a.app_user_id = '$user_id'";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($row = $res->fetch_object()) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            REF #: <?php echo $row->app_ref_code; ?> <br>
                                                            Status:
                                                            <?php if ($row->app_status == 'Pending') { ?>
                                                                <span class="text-danger">Pending</span><br>
                                                            <?php } elseif ($row->app_status == 'Approved') { ?>
                                                                <span class="text-success">Approved</span><br>
                                                            <?php } ?>
                                                            Date: <?php echo date('d M Y', strtotime($row->app_date)); ?>
                                                        </td>
                                                        <td>
                                                            Number: <?php echo $row->user_number; ?><br>
                                                            Name: <?php echo $row->user_name; ?><br>
                                                            Contacts: <?php echo $row->user_phone; ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <?php require_once('../app/partials/footer.php'); ?>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <?php require_once('../app/partials/scripts.php'); ?>
</body>

</html>