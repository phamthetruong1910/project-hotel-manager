<?php
session_start();

include('../includes/config.php');

header('Content-Type: application/json');

$id = $_POST['id'];
$reasonCancel = $_POST['reason'];
$sqlInvoice = "SELECT * FROM invoice WHERE id=:id AND status='ENABLE'";
$queryInvoice = $dbh->prepare($sqlInvoice);
$queryInvoice->bindParam(':id', $id);
$queryInvoice->execute();
$invoice = $queryInvoice->fetch();

if ($queryInvoice->rowCount() > 0) {

    try {
        $now = new DateTime();
        $target = new DateTime($invoice['fromDate']);

        $interval = $now->diff($target);
        $daysRemaining = $interval->days;

        if ($daysRemaining < 3) {
            $response = array('key' => false, 'message' => 'Bạn không được huỷ phòng trước 3 ngày' . $daysRemaining);
        } else {
            $status = 'CANCEL';
            $dateTimeNow = date("Y-m-d H:i:s");

            $sqlCancelInvoice = "UPDATE invoice SET status=:status, reasonCancel=:reasonCancel, cancelAt=:cancelAt, cancelBy=:cancelBy WHERE id=:id";
            $queryCancelInvoice = $dbh->prepare($sqlCancelInvoice);
            $queryCancelInvoice->bindParam(':status', $status);
            $queryCancelInvoice->bindParam(':reasonCancel', $reasonCancel);
            $queryCancelInvoice->bindParam(':cancelAt', $dateTimeNow);
            $queryCancelInvoice->bindParam(':cancelBy', $_SESSION['login']);
            $queryCancelInvoice->bindParam(':id', $id);

            $queryCancelInvoice->execute();

            $response = array('key' => true, 'message' => 'Bạn đã huỷ phòng thành công');
        }

    } catch (Exception $exception) {
        var_dump($exception); die();
    }
} else {
    $response = array('key' => false, 'message' => 'Bạn không thể huỷ phòng');
}

echo json_encode($response);
