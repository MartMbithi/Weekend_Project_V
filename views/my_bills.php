<?php
session_start();
require_once '../app/settings/config.php';
require_once('../app/settings/checklogin.php');
check_login();
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
                        <h3 class="text-black font-w600">Payment Records</h3>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="table-responsive ">
                            <table class="table shadow-hover mb-4 dataTablesCard fs-14">
                                <thead>
                                    <tr>
                                        <th>Payment Details</th>
                                        <th>Diagnosis Details</th>
                                        <th>Patient Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $user_id = $_SESSION['user_id'];
                                    $ret = "SELECT * FROM bills b 
                                    INNER JOIN diagonisis d ON d.diag_id = b.bill_diag_id
                                    INNER JOIN users u ON u.user_id = d.diag_patient_id
                                    WHERE u.user_id = '$user_id'";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($row = $res->fetch_object()) {
                                    ?>
                                        <tr>
                                            <td>
                                                REF #: <?php echo $row->bill_ref_code; ?><br>
                                                Amount: Ksh <?php echo number_format($row->bill_amount, 2); ?><br>
                                                Date: <?php echo $row->bill_date_added; ?>
                                            </td>
                                            <td>
                                                REF #: <?php echo $row->diad_ref; ?> <br>
                                                Title: <?php echo $row->diag_title; ?><br>
                                                Date: <?php echo date('d M Y', strtotime($row->diag_date_created)); ?>
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