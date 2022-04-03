<?php
session_start();
require_once '../app/settings/config.php';
require_once '../app/settings/codeGen.php';

/* Handle Password Reset */
if (isset($_POST['reset_password'])) {
    $user_email = $_POST['user_email'];
    /* Check If User Exists */
    $sql = "SELECT * FROM  users WHERE user_email = '$user_email'";
    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        /* Redirect User To Confirm Password */
        $_SESSION['success'] = 'Password Reset Token Generated, Proceed To Confirm Password';
        $_SESSION['user_email'] = $user_email;
        header('Location: confirm_password');
        exit;
    } else {
        $err = "Email Address Does Not Exist";
    }
}
require_once('../app/partials/head.php');
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
                                        <b> <?php echo $s->sys_name; ?> <br> Healthcare Information Management System </b>
                                    </h4>
                                    <hr>
                                    <div class="auth-form ">
                                        <h4 class="text-center mb-4">
                                            Reset Password
                                        </h4>
                                        <form method="POST">
                                            <div class="form-group">
                                                <label class="mb-1"><strong>Email</strong></label>
                                                <input type="email" name="user_email" required class="form-control">
                                            </div>
                                            <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox ml-1">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <a href="login">Remember Password?</a>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" name="reset_password" class="btn btn-primary btn-block">Reset Password</button>
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