<?php
session_start();
require_once '../app/settings/config.php';
require_once('../app/settings/checklogin.php');
check_login();
require_once('../app/settings/codeGen.php');
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
                        <h3 class="text-black font-w600">COVID 19 Surveys Reports</h3>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="table-responsive ">
                            <table class="report_table shadow-hover mb-4 dataTablesCard fs-14">
                                <thead>
                                    <tr>
                                        <th>Demographics</th>
                                        <th>Symptoms</th>
                                        <th>Chronic Ailments</th>
                                        <th>Travel Histories</th>
                                        <th>Contacts & Family Members</th>
                                        <th>Tests & Vaccinations</th>
                                        <th>Survey Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = "SELECT * FROM surveys s
                                    INNER JOIN users u ON u.user_id = s.survey_user_id";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($row = $res->fetch_object()) {
                                    ?>
                                        <tr>
                                            <td>
                                                Number: <?php echo $row->user_number; ?><br>
                                                Name: <?php echo $row->user_name; ?><br>
                                                Contacts: <?php echo $row->user_phone; ?><br>
                                                Age: <?php echo $row->survey_user_dob; ?><br>
                                                Gender: <?php echo $row->survey_user_gender; ?>
                                            </td>
                                            <td>
                                                Symptoms: <?php echo $row->survey_syptoms; ?><br>
                                                Others: <?php echo $row->survey_other_difficulties; ?>
                                            </td>
                                            <td>
                                                Ailments: <?php echo $row->survey_user_ailments; ?><br>
                                            </td>
                                            <td>
                                                Recent Travels: <?php echo $row->survey_user_travel; ?> <br>
                                                Place Traveled: <?php echo $row->survey_travel_history; ?>
                                            </td>
                                            <td>
                                                Recent Contacts: <?php echo $row->survey_user_people_contacted; ?> Peoples <br>
                                                Family Members: <?php echo $row->survey_user_fam_members; ?> Members <br>
                                            </td>
                                            <td>
                                                Tested: <?php echo $row->survey_user_tests; ?> <br>
                                                Vaccinated: <?php echo $row->survey_user_vaccination; ?>
                                            </td>
                                            <td>
                                                Survey REF #: <?php echo $row->survey_ref; ?>
                                                Survey Date: <?php echo date('d M Y, g:ia', strtotime($row->survey_date_added)); ?>
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