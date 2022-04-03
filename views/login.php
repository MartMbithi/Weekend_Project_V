<?php
session_start();
require_once '../app/settings/config.php';

/* Handle Login  */
if (isset($_POST['login'])) {
    $user_email = $_POST['user_email'];
    $user_password = sha1(md5($_POST['user_password']));

    $stmt = $mysqli->prepare("SELECT user_name, user_password, user_email, user_access_level, user_id FROM users WHERE user_email =? AND user_password =?");
    $stmt->bind_param('ss', $user_email, $user_password);
    $stmt->execute();
    $stmt->bind_result($user_name, $user_password, $user_email, $user_access_level, $user_id);
    $rs = $stmt->fetch();

    /* Session Variables */
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_access_level'] = $user_access_level;
    $_SESSION['user_name'] = $user_name;

    if (($rs && $user_access_level == "admin") || ($rs && $user_access_level == "doctor")) {
        /* Pass This Alert Via Session */
        $_SESSION['success'] = 'You Have Successfully Logged In';
        header('Location: dashboard');
        exit;
    } elseif ($rs && $user_access_level == "patient") {
        $_SESSION['success'] = 'You Have Successfully Logged In To Landlord Dashboard';
        header('Location: my_dashboard');
        exit;
    } else {
        $err = "Access Denied Please Check Your Email Or Password";
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
                    <div class="col-md-6 ">
                        <div class="authincation-content border border-success">
                            <div class="row no-gutters">
                                <div class="col-xl-12"><br>
                                    <h4 class="text-center mb-4">
                                        <img src="../assets/images/logo.png">
                                        <b> <?php echo $settings->sys_name; ?> <br> Healthcare Information Management System </b>
                                    </h4>
                                    <hr>
                                    <div class="auth-form ">
                                        <h4 class="text-center mb-4">
                                            Sign In
                                        </h4>
                                        <form method="POST">
                                            <div class="form-group">
                                                <label class="mb-1"><strong>Email</strong></label>
                                                <input type="email" name="user_email" required class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="mb-1"><strong>Password</strong></label>
                                                <input type="password" name="user_password" required class="form-control">
                                            </div>
                                            <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox ml-1">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <a href="reset_password">Forgot Password?</a>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" name="login" class="btn btn-primary btn-block">Sign Me In</button>
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