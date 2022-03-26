<?php
session_start();
require_once '../app/settings/config.php';
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

        <!--**********************************
            Nav header start
        ***********************************-->
        <?php require_once('../app/partials/header.php'); ?>
        <!--**********************************
            Nav header end
        ***********************************-->


        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php require_once('../app/partials/sidebar.php');
        $user_id = $_SESSION['user_id'];
        $ret = "SELECT * FROM users WHERE user_id = '$user_id'";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($user = $res->fetch_object()) {
        ?>
            <!--**********************************
            Sidebar end
        ***********************************-->

            <!--**********************************
            Content body start
        ***********************************-->
            <div class="content-body">
                <div class="container-fluid">
                    <div class="page-titles">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)"><?php echo $user->user_name; ?> Profile</a></li>
                        </ol>
                    </div>
                    <!-- row -->
                    <div class="row">
                        <div class="col-lg-12 ">
                            <div class="profile card card-body px-3 pt-3 pb-0 border border-success">
                                <div class="profile-head">
                                    <div class="photo-content">
                                        <div class="cover-photo"></div>
                                    </div>
                                    <div class="profile-info">
                                        <div class="profile-photo">
                                            <img src="../assets/images/no-profile.png" class="img-fluid rounded-circle" alt="">
                                        </div>
                                        <div class="profile-details">
                                            <div class="profile-name px-3 pt-2">
                                                <h4 class="text-primary mb-0"><?php echo $user->user_name; ?></h4>
                                                <p><?php echo ucwords($user->user_access_level); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card border border-success">
                                <div class="card-body">
                                    <div class="text-left">
                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <b><i class="fas fa-tag text-success"></i> Staff No: </b> <a class="float-right"><?php echo $user->user_number; ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b><i class="fas fa-envelope text-success"></i> Email: </b> <a class="float-right"><?php echo $user->user_email; ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b><i class="fas fa-phone text-success"></i> Phone No: </b> <a class="float-right"><?php echo $user->user_phone; ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b><i class="fas fa-map-pin text-success"></i> Address: </b> <a class="float-right"><?php echo $user->user_address; ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b><i class="fas fa-user-tag text-success"></i> Age: </b> <a class="float-right"><?php echo $user->user_age; ?> Years</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-8">
                            <div class="card border border-success">
                                <div class="card-body">
                                    <div class="profile-tab">
                                        <div class="custom-tab-1">
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item"><a href="#my-posts" data-toggle="tab" class="nav-link active show">Personal Information</a>
                                                </li>
                                                <li class="nav-item"><a href="#about-me" data-toggle="tab" class="nav-link">Change Password</a>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="my-posts" class="tab-pane fade active show">

                                                </div>

                                                <div id="about-me" class="tab-pane fade">

                                                </div>
                                            </div>
                                        </div>
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
        <?php }
        require_once('../app/partials/footer.php'); ?>
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

    <!--removeIf(production)-->

    <!--**********************************
        Scripts
    ***********************************-->
    <?php require_once('../app/partials/scripts.php'); ?>

</body>

</html>