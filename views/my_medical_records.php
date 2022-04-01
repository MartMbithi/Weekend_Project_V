<?php
session_start();
require_once '../app/settings/config.php';
require_once('../app/settings/checklogin.php');
check_login();
require_once('../app/settings/codeGen.php');
require_once('../app/partials/head.php');
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

        <?php require_once('../app/partials/header.php');
        require_once('../app/partials/sidebar.php'); ?>
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="form-head d-flex mb-3 mb-md-4 align-items-start">
                    <div class="mr-auto d-none d-lg-block">
                        <h3 class="text-black font-w600">Medical Records</h3>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="table-responsive ">
                            <table class="table shadow-hover mb-4 dataTablesCard fs-14">
                                <thead>
                                    <tr>
                                        <th>Medical Record Details</th>
                                        <th>Payment Status</th>
                                        <th>Diagnosis & Prescriptions</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $user_id = $_SESSION['user_id'];
                                    $ret = "SELECT * FROM  diagonisis d
                                    INNER JOIN users u ON u.user_id = d.diag_patient_id
                                    WHERE u.user_id = '$user_id'";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($row = $res->fetch_object()) {
                                    ?>
                                        <tr>
                                            <td>
                                                REF #: <?php echo $row->diad_ref; ?> <br>
                                                Title: <?php echo $row->diag_title; ?><br>
                                                Cost: Ksh <?php echo number_format($row->diag_cost, 2); ?><br>
                                                Date: <?php echo date('d M Y', strtotime($row->diag_date_created)); ?>
                                            </td>
                                            <td>
                                                <?php if ($row->diag_payment_status == 'Pending') { ?>
                                                    <button type="button" class="btn btn-outline-danger btn-rounded  font-w600" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="las la-funnel-dollar scale5 mr-3"></i>Pending
                                                    </button>
                                                <?php } else { ?>
                                                    <button type="button" class="btn btn-outline-success btn-rounded  font-w600" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="las la-hand-holding-usd scale5 mr-3"></i> Paid
                                                    </button>
                                                <?php } ?>
                                            </td>
                                            <td><?php echo substr($row->diag_details, 0, 150); ?>...</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="dropdown text-center">
                                                        <div class="btn-link" data-toggle="dropdown">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="../../www.w3.org/2000/svg.html">
                                                                <path d="M12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </div>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="my_medical_record?view=<?php echo $row->diag_id; ?>">View Detail</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                     
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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