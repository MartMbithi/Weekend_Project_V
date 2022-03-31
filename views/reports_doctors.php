<?php
session_start();
require_once '../app/settings/config.php';
require_once('../app/settings/checklogin.php');
check_login();
require_once('../app/settings/codeGen.php');
/* Add Doctor */
if (isset($_POST['add_doctor'])) {
    $user_number = $_POST['user_number'];
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_phone = $_POST['user_phone'];
    $user_age = $_POST['user_age'];
    $user_address = $_POST['user_address'];
    $user_date_joined = date('d M Y');
    $user_password = sha1(md5($_POST['user_password']));
    $user_access_level = $_POST['user_access_level'];

    /* Persist */
    $sql = "INSERT INTO users(user_number, user_name, user_email, user_phone, user_age, user_address, user_date_added, user_password, user_access_level)
    VALUES(?,?,?,?,?,?,?,?,?)";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param(
        'sssssssss',
        $user_number,
        $user_name,
        $user_email,
        $user_phone,
        $user_age,
        $user_address,
        $user_date_joined,
        $user_password,
        $user_access_level
    );
    $prepare->execute();
    if ($prepare) {
        $success = "$user_number - $user_name, Added";
    } else {
        $err  = "Failed!, Please Try Again";
    }
}

/* Update Doctor */
if (isset($_POST['update_doctor'])) {
    $user_number = $_POST['user_number'];
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_phone = $_POST['user_phone'];
    $user_age = $_POST['user_age'];
    $user_address = $_POST['user_address'];

    /* Persist */
    $sql = "UPDATE users SET user_name =?, user_email =?, user_phone =?, user_age =?, user_address =? 
    WHERE user_number =?";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param(
        'ssssss',
        $user_name,
        $user_email,
        $user_phone,
        $user_age,
        $user_address,
        $user_number
    );
    $prepare->execute();
    if ($prepare) {
        $success = "$user_number - $user_name Updated";
    } else {
        $err = "Failed!, Please Try Again";
    }
}

/* Delete Doctor */
if (isset($_POST['delete'])) {
    $user_id  = $_POST['user_id'];

    /* Persist */
    $sql = "DELETE FROM users WHERE user_id = ?";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param('s', $user_id);
    $prepare->execute();
    if ($prepare) {
        $success = "Deleted";
    } else {
        $err = "Failed!, Please Try Again";
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
                        <h3 class="text-black font-w600">Doctors</h3>
                    </div>
                </div>
                <div class="text-right">
                    <button type="button" data-toggle="modal" data-target="#add_modal" class="btn btn-primary btn-roundedu"><i class="fas fa-user-md"></i> Add New Doctor</button>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-12 ">
                        <div class="table-responsive">
                            <table class="report_table shadow-hover mb-4 dataTablesCard fs-14">
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
                                            <td><?php echo $user->user_phone; ?></td>
                                            <td><?php echo $user->user_email; ?></td>
                                            <td><?php echo $user->user_address; ?></td>
                                            <td><?php echo date('d M Y', strtotime($user->user_date_added)); ?></td>
                                            <td>
                                                <?php if ($user->user_access_level == 'admin') { ?>
                                                    <span class="btn btn-primary light btn-rounded btn-sm text-nowrap">Administrator</span>
                                                <?php } elseif ($user->user_access_level == 'doctor') { ?>
                                                    <span class="btn btn-primary light btn-rounded btn-sm text-nowrap">Doctor</span>
                                                <?php } ?>
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