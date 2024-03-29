<?php
$ret = "SELECT * FROM  settings";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($settings = $res->fetch_object()) { ?>
    <!DOCTYPE html>
    <html lang="en" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title><?php echo $settings->sys_name; ?> - Healthcare Information Management System</title>
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
        <link href="../assets/css/style.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../assets/vendor/fontawesome-free/css/all.min.css">
        <?php
        /* Alert Sesion Via Alerts */
        if (isset($_SESSION['success'])) {
            $success = $_SESSION['success'];
            unset($_SESSION['success']);
        }
        ?>
        <!-- Data Tables CDN-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" />
        <!-- Toastr -->
        <link rel="stylesheet" href="../assets/vendor/toastr/toastr.min.css">
        <link href="../assets/vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
        <link href="../assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
        <!-- Pick date -->
        <link rel="stylesheet" href="../assets/vendor/pickadate/themes/default.css">
        <link rel="stylesheet" href="../assets/vendor/pickadate/themes/default.date.css">
        <!-- Select 2 -->
        <link href="../assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    </head>
<?php } ?>