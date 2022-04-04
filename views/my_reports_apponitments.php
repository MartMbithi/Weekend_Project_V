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
                        <h3 class="text-black font-w600">Appointments</h3>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-12">
                        <table class="report_table shadow-hover mb-4 dataTablesCard fs-14">
                            <thead>
                                <tr>
                                    <th>Appointment Details</th>
                                    <th>Doctor Details</th>
                                    <th>Appointment Desc</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $user_id = $_SESSION['user_id'];
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
                                        <td><?php echo $row->app_details;?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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