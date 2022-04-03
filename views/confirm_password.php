<?php
session_start();
require_once '../app/settings/config.php';
require_once '../app/settings/codeGen.php';
/* Handle Password Reset */
if (isset($_POST['reset_password'])) {
    $user_email = $_SESSION['user_email'];
    $new_password = sha1(md5($_POST['new_password']));
    $confirm_password = sha1(md5($_POST['confirm_password']));

    /* Check If They Match */
    if ($new_password != $confirm_password) {
        $err = "Passwords Does Not Match";
    } else {
        $sql = "UPDATE users SET user_password =? WHERE user_email = ?";
        $prepare = $mysqli->prepare($sql);
        $bind  = $prepare->bind_param(
            'ss',
            $confirm_password,
            $user_email
        );
        $prepare->execute();
        if ($prepare) {
            /* Pass This Alert Via Session */
            $_SESSION['success'] = 'Your Password Has Been Reset Proceed To Login';
            header('Location: login');
            exit;
        } else {
            $err = "Failed!, Please Try Again";
        }
    }
}
require_once('../app/partials/head.php');
/* Loads Settings */
$ret = "SELECT * FROM  settings";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($settings = $res->fetch_object()) {
?>

    <body class="h-100">
        <div class="authincation h-100">
            <div class="container h-100">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-md-6">
                        <div class="authincation-content border border-success">
                            <div class="row no-gutters">
                                <div class="col-xl-12"><br>
                                    <h4 class="text-center mb-4">
                                        <img src="../assets/images/logo.png">
                                        <b> <?php echo $settings->sys_name; ?> <br> Healthcare Information Management System </b>
                                    </h4>
                                    <hr>
                                    <div class="auth-form">
                                        <h4 class="text-center mb-4">
                                            Confirm Password
                                        </h4>
                                        <form method="POST">
                                            <div class="form-group">
                                                <label class="mb-1"><strong> New Password</strong></label>
                                                <input type="password" name="new_password" required class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="mb-1"><strong> Confirm New Password</strong></label>
                                                <input type="password" name="confirm_password" required class="form-control">
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" name="reset_password" class="btn btn-primary btn-block">Confirm Password</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--**********************************
        Scripts
    ***********************************-->
        <?php require_once('../app/partials/scripts.php'); ?>

    </body>

    </html>
<?php } ?>