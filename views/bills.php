<?php
session_start();
require_once '../app/settings/config.php';
require_once('../app/settings/checklogin.php');
check_login();
require_once('../app/settings/codeGen.php');
/* Update Payment */
if (isset($_POST['update'])) {
    $bill_id = $_POST['bill_id'];
    $bill_amount = $_POST['bill_amount'];
    $bill_date_added = $_POST['bill_date_added'];

    /* Persist */
    $sql = "UPDATE bills SET bill_amount =?, bill_date_added =? WHERE bill_id = ?";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param(
        'sss',
        $bill_amount,
        $bill_date_added,
        $bill_id
    );
    $prepare->execute();
    if ($prepare) {
        $success = "Bill Updated";
    } else {
        $err = "Failed!, Please Try Again";
    }
}
/* Delete Payment Log */
if (isset($_POST['delete'])) {
    $bill_id = $_POST['bill_id'];

    /* Delete */
    $sql = "DELETE FROM bills WHERE bill_id = '$bill_id'";
    $prepare = $mysqli->prepare($sql);
    $prepare->execute();
    if ($prepare) {
        $success = "Bill Deleted";
    } else {
        $err  = "Failed!, Please Try Again";
    }
}
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
                <div class="text-right">
                    <button type="button" data-toggle="modal" data-target="#add_modal" class="btn btn-primary btn-roundedu"><i class="fas fa-file-medical-alt"></i> Add Medical Record</button>
                </div>
                <!-- Register Modal -->
                <div class="modal fade fixed-right" id="add_modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog  modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header align-items-center">
                                <div class="text-center">
                                    <h6 class="mb-0 text-bold">Register New Medical Record</h6>
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" enctype="multipart/form-data" role="form">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="">Doctor Full Names</label>
                                            <select type="text" required name="diag_doctor_id" class="form-control">
                                                <?php
                                                $ret = "SELECT * FROM users
                                                WHERE user_access_level  = 'admin' || user_access_level = 'doctor' ";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($user = $res->fetch_object()) {
                                                ?>
                                                    <option value="<?php echo $user->user_id; ?>"><?php echo $user->user_number . ' - ' . $user->user_name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label for="">Patient Full Names</label>
                                            <select type="text" required name="diag_patient_id" class="form-control">
                                                <?php
                                                $ret = "SELECT * FROM users
                                                WHERE user_access_level  = 'patient'";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($patient = $res->fetch_object()) {
                                                ?>
                                                    <option value="<?php echo $patient->user_id; ?>"><?php echo $patient->user_number . ' ' . $patient->user_name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Diagnosis Date</label>
                                            <input type="date" id="date-format" required name="diag_date_created" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Cost (Ksh)</label>
                                            <input type="number" required name="diag_cost" class="form-control">
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label for="">Title</label>
                                            <input type="text" required name="diag_title" class="form-control">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="">Diagnosis Details & Treatments</label>
                                            <textarea type="text" required name="diag_details" rows="10" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" name="add_medical_record" class="btn btn-success btn-roundedu">Submit Medical Record</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
                <hr>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="table-responsive ">
                            <table class="table shadow-hover mb-4 dataTablesCard fs-14">
                                <thead>
                                    <tr>
                                        <th>Patient Details</th>
                                        <th>Medical Record Details</th>
                                        <th>Payment Status</th>
                                        <th>Diagnosis & Prescriptions</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = "SELECT * FROM  diagonisis d
                                    INNER JOIN users u ON u.user_id = d.diag_patient_id";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($row = $res->fetch_object()) {
                                    ?>
                                        <tr>
                                            <td>
                                                Number: <?php echo $row->user_number; ?><br>
                                                Name: <?php echo $row->user_name; ?><br>
                                                Contacts: <?php echo $row->user_phone; ?>
                                            </td>
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
                                                            <a class="dropdown-item" href="medical_record?view=<?php echo $row->diag_id; ?>">View Detail</a>
                                                            <?php if ($row->diag_payment_status == 'Pending') { ?>
                                                                <a data-toggle="modal" class="dropdown-item" href="#pay_<?php echo $row->diag_id; ?>">Add Payment</a>
                                                            <?php } ?>
                                                            <a data-toggle="modal" class="dropdown-item" href="#update_<?php echo $row->diag_id; ?>">Edit</a>
                                                            <a data-toggle="modal" class="dropdown-item text-danger" href="#delete_<?php echo $row->diag_id; ?>">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Update Modal -->
                                        <div class="modal fade fixed-right" id="update_<?php echo $row->diag_id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog  modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header align-items-center">
                                                        <div class="text-bold">
                                                            <h6 class="text-bold">Update #<?php echo $row->diad_ref; ?></h6>
                                                        </div>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" enctype="multipart/form-data" role="form">
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="">Title</label>
                                                                    <input type="text" required value="<?php echo $row->diag_title; ?>" name="diag_title" class="form-control">
                                                                    <input type="hidden" required value="<?php echo $row->diag_id; ?>" name="diag_id" class="form-control">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="">Diagnosis Date</label>
                                                                    <input type="date" id="date-format" value="<?php echo $row->diag_date_created; ?>" required name="diag_date_created" class="form-control">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="">Cost (Ksh)</label>
                                                                    <input type="number" value="<?php echo $row->diag_cost; ?>" required name="diag_cost" class="form-control">
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label for="">Diagnosis Details & Treatments</label>
                                                                    <textarea type="text" required name="diag_details" rows="10" class="form-control"><?php echo $row->diag_details; ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="text-right">
                                                                <button type="submit" name="update_medical_record" class="btn btn-success btn-roundedu">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal -->

                                        <!-- Add Payment Modal -->
                                        <div class="modal fade fixed-right" id="pay_<?php echo $row->diag_id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog  modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header align-items-center">
                                                        <div class="text-bold">
                                                            <h6 class="text-bold">Pay #<?php echo $row->diad_ref; ?></h6>
                                                        </div>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" enctype="multipart/form-data" role="form">
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="">Payment(Ksh)</label>
                                                                    <input type="text" readonly required value="<?php echo $row->diag_cost; ?>" name="bill_amount" class="form-control">
                                                                    <input type="hidden" required value="<?php echo $row->diag_id; ?>" name="bill_diag_id" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="text-right">
                                                                <button type="submit" name="pay_bill" class="btn btn-success btn-roundedu">Pay</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal -->

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="delete_<?php echo $row->diag_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETE</h5>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST">
                                                        <div class="modal-body text-center text-danger">
                                                            <h4>Delete <?php echo $row->diad_ref; ?> Details? </h4>
                                                            <br>
                                                            <!-- Hide This -->
                                                            <input type="hidden" name="diag_id" value="<?php echo $row->diag_id; ?>">
                                                            <button type="button" class="text-center btn btn-success btn-roundedu" data-dismiss="modal">No</button>
                                                            <input type="submit" name="delete_medical_record" value="Delete" class="text-center btn btn-danger btn-roundedu">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
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