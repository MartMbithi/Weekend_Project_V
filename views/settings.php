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
    $sys_id = $_POST['sys_id'];
    $payment_module_status = $_POST['payment_module_status'];

    /* Persist */
    $sql = "UPDATE settings SET sys_name =?, sys_tagline =?, sys_contacts =?, sys_postal_addr =?, sys_email =?, payment_module_status=? WHERE sys_id = '$sys_id'";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param(
        'ssssss',
        $sys_name,
        $sys_tagline,
        $sys_contacts,
        $sys_postal_addr,
        $sys_email,
        $payment_module_status
    );
    $prepare->execute();
    if ($prepare) {
        $success = "System Data Updated";
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
                        <h3 class="text-black font-w600">
                            System Settings
                        </h3>
                        <small class="text-danger">Customize Your Report Heads Information</small>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                $ret = "SELECT * FROM  settings";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($row = $res->fetch_object()) {
                                ?>
                                    <form method="post" enctype="multipart/form-data" role="form">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="">Company Name</label>
                                                <input type="text" required name="sys_name" value="<?php echo $row->sys_name; ?>" class="form-control">
                                                <input type="hidden" required name="sys_id" value="<?php echo $row->sys_id; ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">Payments Module</label>
                                                <select required name="payment_module_status" class="form-control">
                                                    <?php if ($row->payment_module_status == 'active') { ?>
                                                        <option value="active">Enable Module</option>
                                                        <option value="inactive">Disable Module</option>
                                                    <?php } else { ?>
                                                        <option value="active">Enable Module</option>
                                                        <option value="inactive">Disable Module</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">Company Website</label>
                                                <input type="text" required name="sys_website" value="<?php echo $row->sys_website; ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Company Contacts</label>
                                                <input type="text" required name="sys_contacts" value="<?php echo $row->sys_contacts; ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Company Email Address</label>
                                                <input type="text" required name="sys_email" value="<?php echo $row->sys_email; ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="">Company Postal Address</label>
                                                <textarea type="text" name="sys_postal_addr" required class="form-control"><?php echo $row->sys_postal_addr; ?></textarea>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="">Company Tagline</label>
                                                <textarea type="text" name="sys_tagline" required class="form-control"><?php echo $row->sys_tagline; ?></textarea>
                                            </div>

                                        </div>
                                        <div class="text-right">
                                            <button type="submit" name="update_settings" class="btn btn-success btn-roundedu">Update</button>
                                        </div>
                                    </form>
                                <?php } ?>
                            </div>
                        </div>
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