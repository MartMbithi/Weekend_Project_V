<?php
session_start();
require_once '../app/settings/config.php';
require_once('../app/settings/checklogin.php');
check_login();
require_once('../app/settings/codeGen.php');
/* Add Appointment */
if (isset($_POST['add_appointment'])) {
    $app_ref_code = $a . $b;
    $app_doc_id = $_POST['app_doc_id'];
    $app_user_id = $_POST['app_user_id'];
    $app_status = 'Pending';
    $app_date = $_POST['app_date'];
    $app_details = $_POST['app_details'];

    /* Persist */
    $sql = "INSERT INTO appointments (app_ref_code, app_doc_id, app_user_id, app_status, app_date, app_details) VALUES(?,?,?,?,?,?)";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param(
        'ssssss',
        $app_ref_code,
        $app_doc_id,
        $app_user_id,
        $app_status,
        $app_date,
        $app_details
    );
    $prepare->execute();
    if ($prepare) {
        $success = "Appointment Submitted";
    } else {
        $err = "Failed!, Please Try Again";
    }
}

/* Update Appointment */
if (isset($_POST['update_appointment'])) {
    $app_id = $_POST['app_id'];
    $app_date = $_POST['app_date'];
    $app_details = $_POST['app_details'];

    /* Persist */
    $sql = "UPDATE appointments SET  app_date =?, app_details =? WHERE app_id = '$app_id'";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param(
        'ss',
        $app_date,
        $app_details,
    );
    $prepare->execute();
    if ($prepare) {
        $success = "Appointment Updated";
    } else {
        $err = "Failed!, Please Try Again";
    }
}
/* Delete Appointment */
if (isset($_POST['delete_appointment'])) {
    $app_id = $_POST['app_id'];

    /* Delete */
    $sql = "DELETE FROM appointments WHERE app_id = ?";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param('s', $app_id);
    $prepare->execute();
    if ($prepare) {
        $success = "Deleted";
    } else {
        $err = "Failed!, Please Try Again Later";
    }
}

/* Approve */
if (isset($_POST['approve'])) {
    $app_id = $_POST['app_id'];

    /* persist */
    $sql = "UPDATE appointments SET app_status = 'Approved' WHERE app_id = ?";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param('s', $app_id);
    $prepare->execute();
    if ($prepare) {
        $success = "Appointment Approved";
    } else {
        $err = "Failed!, Please Try Again Later";
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
                        <h3 class="text-black font-w600">Appointments</h3>
                    </div>
                </div>
                <div class="text-right">
                    <button type="button" data-toggle="modal" data-target="#add_modal" class="btn btn-primary btn-roundedu"><i class="fas fa-calendar"></i> Add New Appointment</button>
                </div>
                <!-- Register Modal -->
                <div class="modal fade fixed-right" id="add_modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog  modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header align-items-center">
                                <div class="text-center">
                                    <h6 class="mb-0 text-bold">Register New Appoinement</h6>
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
                                            <select type="text" required name="app_doc_id" class="form-control">
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
                                            <select type="text" required name="app_user_id" class="form-control">
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
                                            <label for="">Appointment Date</label>
                                            <input type="date" id="date-format" required name="app_date" class="form-control">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="">Appointment Details</label>
                                            <textarea type="text" required name="app_details" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" name="add_appointment" class="btn btn-success btn-roundedu">Submit Appointment</button>
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
                        <table class="table shadow-hover mb-4 dataTablesCard fs-14">
                            <thead>
                                <tr>
                                    <th>Appointment Details</th>
                                    <th>Patient Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret = "SELECT * FROM  appointments a
                                INNER JOIN users u ON u.user_id = a.app_user_id";
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
                                                        <a class="dropdown-item" href="appointment?view=<?php echo $row->app_id; ?>">View Detail</a>
                                                        <a data-toggle="modal" class="dropdown-item" href="#update_<?php echo $row->app_id; ?>">Edit</a>
                                                        <a data-toggle="modal" class="dropdown-item" href="#approve_<?php echo $row->app_id; ?>">Approve</a>
                                                        <a data-toggle="modal" class="dropdown-item text-danger" href="#delete_<?php echo $row->app_id; ?>">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Update Modal -->
                                    <div class="modal fade fixed-right" id="update_<?php echo $row->app_id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog  modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header align-items-center">
                                                    <div class="text-bold">
                                                        <h6 class="text-bold">Update Appointment Details</h6>
                                                    </div>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" enctype="multipart/form-data" role="form">
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label for="">Appointment Date</label>
                                                                <!-- Hide This -->
                                                                <input type="hidden" value="<?php echo $row->app_id; ?>" required name="app_id" class="form-control">
                                                                <input type="date" value="<?php echo $row->app_date; ?>" id="date-format" required name="app_date" class="form-control">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="">Appointment Details</label>
                                                                <textarea type="text" required name="app_details" rows="5" class="form-control"><?php echo $row->app_details; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="text-right">
                                                            <button type="submit" name="update_appointment" class="btn btn-success btn-roundedu">Update Appointment</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="delete_<?php echo $row->app_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        <h4>Delete <?php echo $row->app_ref_code; ?> Details? </h4>
                                                        <br>
                                                        <!-- Hide This -->
                                                        <input type="hidden" name="app_id" value="<?php echo $row->app_id; ?>">
                                                        <button type="button" class="text-center btn btn-success btn-roundedu" data-dismiss="modal">No</button>
                                                        <input type="submit" name="delete_appointment" value="Delete" class="text-center btn btn-danger btn-roundedu">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->

                                    <!-- Approve Modal -->
                                    <div class="modal fade" id="approve_<?php echo $row->app_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">CONFIRM APPROVAL</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST">
                                                    <div class="modal-body text-center text-danger">
                                                        <h4>Apprve <?php echo $row->app_ref_code; ?>? </h4>
                                                        <br>
                                                        <!-- Hide This -->
                                                        <input type="hidden" name="app_id" value="<?php echo $row->app_id; ?>">
                                                        <button type="button" class="text-center btn btn-success btn-roundedu" data-dismiss="modal">No</button>
                                                        <input type="submit" name="approve" value="Approve" class="text-center btn btn-danger btn-roundedu">
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