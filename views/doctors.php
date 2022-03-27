<?php
session_start();
require_once '../app/settings/config.php';
require_once('../app/settings/codeGen.php');

/* Add Doctor */
/* Update Doctor */
/* Delete Doctor */
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
                        <h3 class="text-black font-w600">Doctors</h3>
                    </div>
                </div>
                <div class="text-right">
                    <button type="button" data-toggle="modal" data-target="#add_modal" class="btn btn-primary btn-roundedu"><i class="fas fa-user-md"></i> Add New Doctor</button>
                </div>
                <!-- Register Modal -->
                <div class="modal fade fixed-right" id="add_modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog  modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header align-items-center">
                                <div class="text-center">
                                    <h6 class="mb-0 text-bold">Register New Doctor</h6>
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" enctype="multipart/form-data" role="form">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="">Number</label>
                                            <input type="text" readonly required name="user_number" value="<?php echo $a . $b; ?>" readonly class="form-control">
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label for="">Full Names</label>
                                            <input type="text" required name="user_name" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Email</label>
                                            <input type="email" required name="user_email" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Login Password</label>
                                            <input type="password" required name="user_password" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Contacts</label>
                                            <input type="text" required name="user_phone" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Age</label>
                                            <input type="number" required name="user_age" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Access Level</label>
                                            <select required name="user_access_level" class="form-control">
                                                <option value="doctor">Doctor</option>
                                                <option value="doctor">Administrator</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="">Address</label>
                                            <textarea type="text" required name="user_address" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" name="add_doctor" class="btn btn-success btn-roundedu">Register Doctor</button>
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
                        <table class="table shadow-hover  table-bordered mb-4 dataTablesCard fs-14">
                            <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Full Names</th>
                                    <th>Age</th>
                                    <th>Contacts</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Date Registered</th>
                                    <th>Access Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret = "SELECT * FROM users
                                WHERE user_access_level  = 'doctor' ||  user_access_level  = 'admin'  ";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($user = $res->fetch_object()) {
                                ?>
                                    <tr>
                                        <td><?php echo $user->user_number; ?></td>
                                        <td><?php echo $user->user_name; ?></td>
                                        <td><?php echo $user->user_age; ?> Years</td>
                                        <td><?php echo $users->user_phone; ?></td>
                                        <td><?php echo $users->user_address; ?></td>
                                        <td><?php echo date('d M Y', strtotime($user->user_date_added)); ?></td>
                                        <td>
                                            <?php if ($user->user_access_level == 'admin') { ?>
                                                <span class="btn btn-primary light btn-rounded btn-sm text-nowrap">Administrator</span>
                                            <?php } elseif ($user->user_access_level == 'doctor') { ?>
                                                <span class="btn btn-primary light btn-rounded btn-sm text-nowrap">Doctor</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="dropdown ml-auto text-right">
                                                    <div class="btn-link" data-toggle="dropdown">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="../../www.w3.org/2000/svg.html">
                                                            <path d="M12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </div>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="doctor?view=<?php echo $user->user_id; ?>">View Detail</a>
                                                        <a data-toggle="modal" class="dropdown-item" href="#update_<?php echo $user->user_id; ?>">Edit</a>
                                                        <a data-toggle="modal" class="dropdown-item" href="#delete_<?php echo $user->user_id; ?>">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Update Modal -->
                                    <div class="modal fade fixed-right" id="update_<?php echo $exp->expense_id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog  modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header align-items-center">
                                                    <div class="text-bold">
                                                        <h6 class="text-bold">Update Expense Ref #<?php echo $exp->expense_ref; ?></h6>
                                                    </div>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="delete_<?php echo $user->user_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        <h4>Delete <?php echo $user->user_name; ?> Details? </h4>
                                                        <br>
                                                        <!-- Hide This -->
                                                        <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
                                                        <button type="button" class="text-center btn btn-success btn-roundedu" data-dismiss="modal">No</button>
                                                        <input type="submit" name="delete" value="Delete" class="text-center btn btn-danger btn-roundedu">
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