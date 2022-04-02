<?php
session_start();
require_once '../app/settings/config.php';
require_once('../app/settings/checklogin.php');
check_login();
require_once('../app/settings/codeGen.php');
/* Update System Settings */
if (isset($_POST['update_settings'])) {
    $sys_name = $_POST['sys_name'];
    $sys_tagline = $_POST['sys_tagline'];
    $sys_contacts = $_POST['sys_contacts'];
    $sys_postal_addr = $_POST['sys_postal_addr'];
    $sys_email = $_POST['sys_email'];

    /* Persist */
    $sql = "UPDATE settings SET sys_name =?, sys_tagline =?, sys_contacts =?, sys_postal_addr =?, sys_email =?";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param(
        'sssss',
        $sys_name,
        $sys_taagline,
        $sys_contacts,
        $sys_postal_addr,
        $sys_email
    );
    $prepare->execute();
    if($prepare){
        $success = "System Data Updated";
    }else{
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
                        <h3 class="text-black font-w600">
                            System Settings
                        </h3>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="table-responsive">
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
                                    <div class="form-group col-md-3">
                                        <label for="">Email</label>
                                        <input type="email" required name="user_email" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Login Password</label>
                                        <input type="password" required name="user_password" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Contacts</label>
                                        <input type="text" required name="user_phone" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Age</label>
                                        <input type="number" required name="user_age" class="form-control">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="">Address</label>
                                        <textarea type="text" required name="user_address" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" name="add_patient" class="btn btn-success btn-roundedu">Register Patient</button>
                                </div>
                            </form>
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