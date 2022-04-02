<?php
session_start();
require_once '../app/settings/config.php';
require_once('../app/settings/checklogin.php');
check_login();
require_once('../app/settings/codeGen.php');
require_once('../vendor/autoload.php');

/* Load Dom PDF */

use Dompdf\Dompdf;
/* Load Barcode */

$dompdf = new Dompdf();

/* Convert Logo To Base64 Image */
$path = '../assets/images/logo.png';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$app_logo = 'data:image/' . $type . ';base64,' . base64_encode($data);

/* Convert Watermark TO Base64 Image */
$watermark_path = '../assets/images/background.jpg';
$watermark_type = pathinfo($watermark_path, PATHINFO_EXTENSION);
$watermark_data = file_get_contents($watermark_path);
$app_watermark = 'data:image/' . $watermark_type . ';base64,' . base64_encode($watermark_data);

/* Convert Barcode Generator  */

/* Appointment Code */
$id = $_GET['id'];
$ret = "SELECT * FROM  settings s 
JOIN appointments WHERE app_ref_code  = '$id'";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($row = $res->fetch_object()) {

    /* Load Partials from helpers */
    require_once('../app/helpers/appointment_dump.php');
}
$dompdf->load_html($html);
$dompdf->set_paper('A4');
$dompdf->set_option('isHtml5ParserEnabled', true);
$dompdf->render();
$dompdf->stream($id . '-Appointment', array("Attachment" => 1));
$options = $dompdf->getOptions();
$options->setDefaultFont('');
$dompdf->setOptions($options);
