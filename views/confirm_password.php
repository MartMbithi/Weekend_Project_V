<?php require_once('../app/partials/head.php'); ?>

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
                                    <b> iAfya <br> Healthcare Information Management System </b>
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