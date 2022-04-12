<?php
session_start();
require_once '../app/settings/config.php';
require_once('../app/settings/checklogin.php');
check_login();
require_once('../app/settings/codeGen.php');
/* Add User Survey */
if (isset($_POST['add_survey'])) {
    $survey_ref  = $a . $b;
    $survey_user_id = $_SESSION['user_id'];
    $survey_user_dob = $_POST['survey_user_dob'];
    $survey_user_gender = $_POST['survey_user_gender'];
    $survey_syptoms = implode(',', $_POST['survey_syptoms']);
    $survey_other_difficulties = $_POST['survey_other_difficulties'];
    $survey_user_ailments = implode(',', $_POST['survey_user_ailments']);
    $survey_travel_history = $_POST['survey_travel_history'];
    $survey_user_travel = $_POST['survey_user_travel'];
    $survey_user_people_contacted = $_POST['survey_user_people_contacted'];
    $survey_user_fam_members = $_POST['survey_user_fam_members'];
    $survey_user_tests = $_POST['survey_user_tests'];
    $survey_user_vaccination = $_POST['survey_user_vaccination'];

    /* Persist Survey */
    $sql = "INSERT INTO surveys(survey_ref, survey_user_id, survey_user_dob, survey_user_gender, survey_syptoms, survey_other_difficulties,
    survey_user_ailments, survey_travel_history, survey_user_travel, survey_user_people_contacted, survey_user_fam_members, survey_user_tests,
    survey_user_vaccination) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $prepare = $mysqli->prepare($sql);
    $bind  = $prepare->bind_param(
        'sssssssssssss',
        $survey_ref,
        $survey_user_id,
        $survey_user_dob,
        $survey_user_gender,
        $survey_syptoms,
        $survey_other_difficulties,
        $survey_user_ailments,
        $survey_travel_history,
        $survey_user_travel,
        $survey_user_people_contacted,
        $survey_user_fam_members,
        $survey_user_tests,
        $survey_user_vaccination
    );
    $prepare->execute();
    if ($prepare) {
        $success = "Response Submitted";
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
                        <h3 class="text-black font-w600">COVID 19 Survey</h3>
                        <small class="text-danger">All the information shared here is kept confidential</small>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-12 ">
                        <div class="card">
                            <div class="card-body">
                                <form method="post">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <fieldset class="border border-primary p-2">
                                                <legend class="w-auto text-primary pull-center">Personal Information</legend>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Age
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" required class="form-control" name="survey_user_dob">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label">Gender
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" name="survey_user_gender">
                                                            <option>Male</option>
                                                            <option>Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-6">
                                            <fieldset class="border border-primary p-2">
                                                <legend class="w-auto text-primary pull-center">Symptoms</legend>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label">Symptoms
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="multi-select" name="survey_syptoms[]" multiple="multiple">
                                                            <option>Colds</option>
                                                            <option>Fever</option>
                                                            <option>Headache</option>
                                                            <option>Fatigue</option>
                                                            <option>Sore Throat</option>
                                                            <option>Muscle Pain</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Any Other Symptoms
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control" name="survey_other_difficulties"></textarea>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-6">
                                            <fieldset class="border border-primary p-2">
                                                <legend class="w-auto text-primary pull-center">Chronic Ailments</legend>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label">Any Other Ailments
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="multi-select" name="survey_user_ailments[]" multiple="multiple">
                                                            <option>Asthma</option>
                                                            <option>Cancer</option>
                                                            <option>Diabetes</option>
                                                            <option>Bronchitis</option>
                                                            <option>None</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Any Other Chronic Ailments
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control" name="survey_other_difficulties"></textarea>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <hr>
                                        <div class="col-xl-6">
                                            <fieldset class="border border-primary p-2">
                                                <legend class="w-auto text-primary pull-center">Travels</legend>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label">Any Recent Travels
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" name="survey_user_travel">
                                                            <option>No</option>
                                                            <option>Yes</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">If Yes, Where
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control" name="survey_travel_history"></textarea>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-6">
                                            <fieldset class="border border-primary p-2">
                                                <legend class="w-auto text-primary pull-center">Contacts </legend>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label">How Many People You Came Into Contact With In Past 15 Days?
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" name="survey_user_people_contacted">
                                                            <option>0-100</option>
                                                            <option>100-200</option>
                                                            <option>200-300</option>
                                                            <option>Over 300</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label">How Many Senior Family Members Do You Have
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" name="survey_user_fam_members">
                                                            <option>0-2</option>
                                                            <option>2-4</option>
                                                            <option>4-6</option>
                                                            <option>Over 6</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-6">
                                            <fieldset class="border border-primary p-2">
                                                <legend class="w-auto text-primary pull-center">Tests & Vaccinations </legend>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label">Have You Been Tested At Airport Or Hospital?
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" name="survey_user_tests">
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label">Have You Been Vaccinated?
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" name="survey_user_vaccination">
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" name="add_survey" class="btn btn-success btn-roundedu">Submit Survey</button>
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