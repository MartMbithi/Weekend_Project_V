<?php require_once('../app/partials/head.php'); ?>

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
                                    <b> iAfya <br> Healthcare Information Management System </b>
                                </h4>
                                <hr>
                                <div class="auth-form ">
                                    <h4 class="text-center mb-4">
                                        Sign In
                                    </h4>
                                    <form method="POST">
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input type="email" required class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" required class="form-control">
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