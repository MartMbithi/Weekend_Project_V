<?php
session_start();
require_once '../app/settings/config.php';
require_once('../app/settings/codeGen.php');

/* Update Access Levels */
if (isset($_POST['update_access_levels'])) {
    $user_id = $_GET['view'];
    $user_access_level  = $_POST['user_access_level'];

    /* Persist */
    $sql = "UPDATE users SET user_access_level  = ? WHERE user_id =?";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param(
        'ss',
        $user_id,
        $user_access_level
    );
    $prepare->execute();
    if ($prepare) {
        $success = "Access Levels Updated";
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
        require_once('../app/partials/sidebar.php');
        $view = $_GET['view'];
        $ret = "SELECT * FROM users
        WHERE user_id  = '$view'";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($user = $res->fetch_object()) {
        ?>
            <!--**********************************
            Content body start
        ***********************************-->
            <div class="content-body">
                <!-- row -->
                <div class="container-fluid">
                    <div class="page-titles">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item"><a href="doctors">Doctors</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo $user->user_name; ?></a></li>

                        </ol>
                    </div>
                    <div class="d-block d-sm-flex mb-3 mb-md-4">
                        <div class="dropdown ml-auto mr-1 d-inline-block">
                            <button type="button" class="btn btn-primary btn-rounded  light font-w600  mb-2" data-toggle="dropdown" aria-expanded="false">
                                <i class="las la-check-circle scale5 mr-3"></i>Available
                            </button>
                        </div>

                        <a data-toggle="modal" href="#update" class="btn btn-primary btn-rounded mb-2"><i class="las scale5 la-pencil-alt mr-2"></i> Edit Access Level</a>
                    </div>
                    <!-- Update Access Level Modal -->
                    <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">CONFIRM UPDATE ACCESS LEVEL</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" enctype="multipart/form-data" role="form">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="">Access Level</label>
                                                <select required name="user_access_level" class="form-control">
                                                    <?php if ($user->user_access_level == 'doctor') { ?>
                                                        <option value="doctor">Doctor</option>
                                                        <option value="admin">Administrator</option>
                                                    <?php } elseif ($user->user_access_level == 'admin') { ?>
                                                        <option value="admin">Administrator</option>
                                                        <option value="doctor">Doctor</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" name="update_access_levels" class="btn btn-success btn-roundedu">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-xxl-4">
                            <div class="card">
                                <div class="card-header border-0 pb-0">
                                    <h4 class="fs-20 font-w600 mb-0">Appointments</h4>
                                </div>
                                <hr>
                                <div class="card-body pt-4">
                                    <div id="DZ_W_Todo2" class="widget-media dz-scroll ps ps--active-y height370">
                                        <ul class="timeline">
                                            <?php
                                            $ret = "SELECT * FROM appointments a
                                            INNER JOIN users u ON u.user_id = a.app_user_id
                                            WHERE a.app_doc_id  = '$view'";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($appts = $res->fetch_object()) {
                                            ?>
                                                <li>
                                                    <div class="timeline-panel bgl-dark flex-wrap border-0 p-3 rounded">
                                                        <div class="media bg-transparent mr-2">
                                                            <img class="rounded-circle" alt="image" width="48" src="../assets/images/no-profile.png">
                                                        </div>
                                                        <div class="media-body">
                                                            <h5 class="mb-1 fs-18"><?php echo $appts->user_name; ?></h5>
                                                            <span><?php echo $appts->app_details; ?></span>
                                                        </div>
                                                        <ul class="mt-3 d-flex flex-wrap text-primary font-w600">
                                                            <li class="mr-2"><?php echo date('d M Y', strtotime($appts->app_date)); ?></li>
                                                            <li>REF #: <?php echo $appts->app_ref_code; ?></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-xxl-8 col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media d-sm-flex d-block text-center text-sm-left pb-4 mb-4 border-bottom">
                                        <img alt="image" class="rounded mr-sm-4 mr-0" width="130" src="../assets/images/no-profile.png">
                                        <div class="media-body align-items-center">
                                            <div class="d-sm-flex d-block justify-content-between my-3 my-sm-0">
                                                <div>
                                                    <h3 class="fs-22 text-black font-w600 mb-0"><?php echo $user->user_name; ?></h3>
                                                    <p class="mb-2 mb-sm-2">Registered On <?php echo $user->user_date_added; ?></p>
                                                </div>
                                                <span>#<?php echo $user->user_number; ?></span>
                                            </div>
                                            <a href="javascript:void(0);" class="btn bgl-primary btn-rounded text-black mb-2 mr-2">
                                                <svg class="mr-2 scale5" width="14" height="14" viewBox="0 0 26 26" fill="none" xmlns="../../www.w3.org/2000/svg.html">
                                                    <path d="M18 0.500061V3.00006H21.25L16.625 7.62506C15 6.25006 12.875 5.50006 10.5 5.50006C5 5.50006 0.5 10.0001 0.5 15.5001C0.5 21.0001 5 25.5001 10.5 25.5001C16 25.5001 20.5 21.0001 20.5 15.5001C20.5 13.1251 19.75 11.0001 18.375 9.37506L23 4.75006V8.00006H25.5V0.500061H18ZM10.5 23.0001C6.375 23.0001 3 19.6251 3 15.5001C3 11.3751 6.375 8.00006 10.5 8.00006C14.625 8.00006 18 11.3751 18 15.5001C18 19.6251 14.625 23.0001 10.5 23.0001Z" fill="#2BC155"></path>
                                                </svg>
                                                <?php echo $user->user_age; ?> Years
                                            </a>
                                            <a href="javascript:void(0);" class="btn bgl-primary btn-rounded mb-2 text-black">
                                                <svg class="mr-2 scale5" width="14" height="14" viewBox="0 0 28 28" fill="none" xmlns="../../www.w3.org/2000/svg.html">
                                                    <path d="M27.75 11.5C27.7538 10.8116 27.568 10.1355 27.213 9.54575C26.8581 8.95597 26.3476 8.47527 25.7376 8.15632C25.1276 7.83737 24.4415 7.69248 23.7547 7.73752C23.0678 7.78257 22.4065 8.01581 21.8434 8.4117C21.2803 8.80758 20.837 9.35083 20.5621 9.98192C20.2872 10.613 20.1913 11.3076 20.2849 11.9896C20.3785 12.6715 20.6581 13.3146 21.0929 13.8482C21.5277 14.3819 22.101 14.7855 22.75 15.015V19C22.75 20.6576 22.0915 22.2473 20.9194 23.4194C19.7473 24.5915 18.1576 25.25 16.5 25.25C14.8424 25.25 13.2527 24.5915 12.0806 23.4194C10.9085 22.2473 10.25 20.6576 10.25 19V17.65C12.3301 17.3482 14.2323 16.3083 15.6092 14.7203C16.9861 13.1322 17.746 11.1019 17.75 9V1.5C17.75 1.16848 17.6183 0.850537 17.3839 0.616116C17.1495 0.381696 16.8315 0.25 16.5 0.25H12.75C12.4185 0.25 12.1005 0.381696 11.8661 0.616116C11.6317 0.850537 11.5 1.16848 11.5 1.5C11.5 1.83152 11.6317 2.14946 11.8661 2.38388C12.1005 2.6183 12.4185 2.75 12.75 2.75H15.25V9C15.25 10.6576 14.5915 12.2473 13.4194 13.4194C12.2473 14.5915 10.6576 15.25 9 15.25C7.34239 15.25 5.75268 14.5915 4.58058 13.4194C3.40848 12.2473 2.75 10.6576 2.75 9V2.75H5.25C5.58152 2.75 5.89946 2.6183 6.13388 2.38388C6.3683 2.14946 6.5 1.83152 6.5 1.5C6.5 1.16848 6.3683 0.850537 6.13388 0.616116C5.89946 0.381696 5.58152 0.25 5.25 0.25H1.5C1.16848 0.25 0.850537 0.381696 0.616116 0.616116C0.381696 0.850537 0.25 1.16848 0.25 1.5V9C0.25402 11.1019 1.01386 13.1322 2.3908 14.7203C3.76773 16.3083 5.6699 17.3482 7.75 17.65V19C7.75 21.3206 8.67187 23.5462 10.3128 25.1872C11.9538 26.8281 14.1794 27.75 16.5 27.75C18.8206 27.75 21.0462 26.8281 22.6872 25.1872C24.3281 23.5462 25.25 21.3206 25.25 19V15.015C25.9792 14.7599 26.6114 14.2848 27.0591 13.6552C27.5069 13.0256 27.7483 12.2726 27.75 11.5Z" fill="#2BC155"></path>
                                                </svg>
                                                <?php if ($user->user_access_level == 'admin') { ?>
                                                    Administrator
                                                <?php } elseif ($user->user_access_level == 'doctor') { ?>
                                                    Doctor
                                                <?php } ?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <div class="media">
                                                <span class="p-3 border border-primary-light rounded-circle mr-3">
                                                    <svg width="22" height="22" viewBox="0 0 32 32" fill="none" xmlns="../../www.w3.org/2000/svg.html">
                                                        <g clip-path="url(#clip0)">
                                                            <path d="M27.5716 13.4285C27.5716 22.4285 16.0001 30.1428 16.0001 30.1428C16.0001 30.1428 4.42871 22.4285 4.42871 13.4285C4.42871 10.3596 5.64784 7.41637 7.8179 5.24631C9.98797 3.07625 12.9312 1.85712 16.0001 1.85712C19.0691 1.85712 22.0123 3.07625 24.1824 5.24631C26.3524 7.41637 27.5716 10.3596 27.5716 13.4285Z" stroke="#2BC155" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M16.0002 17.2857C18.1305 17.2857 19.8574 15.5588 19.8574 13.4286C19.8574 11.2983 18.1305 9.57141 16.0002 9.57141C13.87 9.57141 12.1431 11.2983 12.1431 13.4286C12.1431 15.5588 13.87 17.2857 16.0002 17.2857Z" stroke="#2BC155" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0">
                                                                <rect width="30.8571" height="30.8571" fill="white" transform="translate(0.571533 0.571411)"></rect>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </span>
                                                <div class="media-body">
                                                    <span class="d-block text-light mb-2">Address</span>
                                                    <p class="fs-18 text-dark"><?php echo $user->user_address; ?></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-lg-0 mb-3">
                                            <div class="media">
                                                <span class="p-3 border border-primary-light rounded-circle mr-3">
                                                    <svg width="22" height="22" viewBox="0 0 31 31" fill="none" xmlns="../../www.w3.org/2000/svg.html">
                                                        <path d="M28.2884 21.7563V25.6138C28.2898 25.9719 28.2165 26.3264 28.073 26.6545C27.9296 26.9826 27.7191 27.2771 27.4553 27.5192C27.1914 27.7613 26.8798 27.9456 26.5406 28.0604C26.2014 28.1751 25.8419 28.2177 25.4853 28.1855C21.5285 27.7555 17.7278 26.4035 14.3885 24.238C11.2817 22.2638 8.64771 19.6297 6.67352 16.523C4.50043 13.1685 3.14808 9.34928 2.72601 5.37477C2.69388 5.0192 2.73614 4.66083 2.8501 4.32248C2.96405 3.98413 3.14721 3.67322 3.38792 3.40953C3.62862 3.14585 3.92159 2.93517 4.24817 2.79092C4.57475 2.64667 4.9278 2.57199 5.28482 2.57166H9.14232C9.76634 2.56552 10.3713 2.78649 10.8445 3.1934C11.3176 3.60031 11.6267 4.16538 11.714 4.78329C11.8768 6.01778 12.1788 7.22988 12.6141 8.39648C12.7871 8.85671 12.8245 9.35689 12.722 9.83775C12.6194 10.3186 12.3812 10.76 12.0354 11.1096L10.4024 12.7426C12.2329 15.9617 14.8983 18.6271 18.1174 20.4576L19.7504 18.8246C20.1001 18.4789 20.5414 18.2406 21.0223 18.1381C21.5031 18.0355 22.0033 18.073 22.4636 18.246C23.6302 18.6813 24.8423 18.9832 26.0767 19.1461C26.7014 19.2342 27.2718 19.5488 27.6796 20.0301C28.0874 20.5113 28.304 21.1257 28.2884 21.7563Z" stroke="#2BC155" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </span>
                                                <div class="media-body">
                                                    <span class="d-block text-light mb-2">Phone</span>
                                                    <p class="fs-18 text-dark font-w600 mb-0"><?php echo $user->user_phone; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="media">
                                                <span class="p-3 border border-primary-light rounded-circle mr-3">
                                                    <svg width="22" height="22" viewBox="0 0 31 31" fill="none" xmlns="../../www.w3.org/2000/svg.html">
                                                        <path d="M5.14344 5.14331H25.7168C27.1312 5.14331 28.2884 6.30056 28.2884 7.71498V23.145C28.2884 24.5594 27.1312 25.7166 25.7168 25.7166H5.14344C3.72903 25.7166 2.57178 24.5594 2.57178 23.145V7.71498C2.57178 6.30056 3.72903 5.14331 5.14344 5.14331Z" stroke="#2BC155" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M28.2884 7.71503L15.4301 16.7159L2.57178 7.71503" stroke="#2BC155" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </span>
                                                <div class="media-body">
                                                    <span class="d-block text-light mb-2">Email</span>
                                                    <p class="fs-18 text-dark font-w600 mb-0"><?php echo $user->user_email; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-xxl-12">
                            <div class="card abilities-chart">
                                <div class="card-header border-0 pb-0">
                                    <h4 class="fs-20 font-w600">Update Password</h4>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <form method="post" enctype="multipart/form-data" role="form">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="">Login Password</label>
                                                <input type="password" required name="new_password" class="form-control">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="">Confirm Login Password</label>
                                                <input type="password" required name="confirm_password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" name="update_password" class="btn btn-success btn-roundedu">Submit</button>
                                        </div>
                                    </form>
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

    <!--**********************************
        Scripts
    ***********************************-->
    <?php require_once('../app/partials/scripts.php'); ?>
</body>


</html>