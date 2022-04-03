<?php
session_start();
require_once '../app/settings/config.php';
require_once('../app/settings/checklogin.php');
check_login();
require_once('../app/settings/codeGen.php');
require_once('../vendor/autoload.php');
$id = $_GET['id'];

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$barcode = new \Com\Tecnick\Barcode\Barcode();

/* Convert Logo To Base64 Image */
$path = '../assets/images/logo.png';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$app_logo = 'data:image/' . $type . ';base64,' . base64_encode($data);

/* Generate QR Code */
$targetPath = "../assets/images/barcodes/";
if (!is_dir($targetPath)) {
    mkdir($targetPath, 0777, true);
}
$code = $id;
$qrcodedata = "$code - Valid Record";
$bobj = $barcode->getBarcodeObj(
    'QRCODE,H',
    "{$qrcodedata}",
    -4,
    -4,
    'black',
    array(-2, -2, -2, -2)
)->setBackgroundColor('white');
$imageData = $bobj->getPngData();
$timestamp = time();
file_put_contents($targetPath . $timestamp . '.png', $imageData);

/* Convert This QR Code To Base 64 Image */
$qrpath = $targetPath . $timestamp . '.png';
$qrtype = pathinfo($path, PATHINFO_EXTENSION);
$qrdata = file_get_contents($qrpath);
$qrbase64 = 'data:image/' . $qrtype . ';base64,' . base64_encode($qrdata);


/* Appointment Code */
$ret = "SELECT * FROM  settings 
JOIN bills b INNER JOIN diagonisis d ON d.diag_id = b.bill_diag_id
INNER JOIN users u ON u.user_id = d.diag_patient_id 
WHERE b.bill_ref_code  = '$id'";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($row = $res->fetch_object()) {
    /* Load Partials from helpers */
    require_once('../app/helpers/payment_dump.php');
}
$dompdf->load_html($html);
$canvas = $dompdf->getCanvas();
$w = $canvas->get_width();
$h = $canvas->get_height();
$imageURL = '../assets/images/background.jpg';
$imgWidth = 500;
$imgHeight = 500;
$canvas->set_opacity(.3);
$x = (($w - $imgWidth) / 2);
$y = (($h - $imgHeight) / 2);
$canvas->image($imageURL, $x, $y, $imgWidth, $imgHeight);
$dompdf->render();
$dompdf->stream($id . '-Payment-Receipt', array("Attachment" => 1));
$options = $dompdf->getOptions();
$dompdf->set_paper('A4');
$dompdf->set_option('isHtml5ParserEnabled', true);
$options->setDefaultFont('');
$dompdf->setOptions($options);
