<?php
include('../includes/config.php');

header('Content-Type: application/json');

$id = $_POST['id'];
$detailId = $_POST['detailId'];
$sqlInvoice = "SELECT * FROM invoice WHERE id=:id AND status='ENABLE'";
$queryInvoice = $dbh->prepare($sqlInvoice);
$queryInvoice->bindParam(':id', $id);
$queryInvoice->execute();
$invoice = $queryInvoice->fetch();

if ($queryInvoice->rowCount() > 0) {

    try {
        $now = time();
        $target = new DateTime($invoice['fromDate']);
        $targetTimestamp = $target->getTimestamp();
        $secondsLeft = $targetTimestamp - $now;
        $daysLeft = floor($secondsLeft / 86400);

        $sqlInvoiceDetailQuantity = "SELECT * FROM invoiceDetails WHERE id !=:id AND invoiceId=:invoiceId AND status='ENABLE'";
        $queryInvoiceDetailQ = $dbh->prepare($sqlInvoiceDetailQuantity);
        $queryInvoiceDetailQ->bindParam(':id', $detailId);
        $queryInvoiceDetailQ->bindParam(':invoiceId', $id);
        $queryInvoiceDetailQ->execute();

        if ($queryInvoiceDetailQ->rowCount() === 0) {
            $response = array('key' => false, 'message' => 'Hoá đơn phải còn ít nhất 1 phòng');
        } else if ($daysLeft <= 3) {
            $response = array('key' => false, 'message' => 'Bạn không được huỷ phòng trước 3 ngày');
        } else {
            $sqlInvoiceDetail = "SELECT * FROM invoiceDetails WHERE id=:id AND invoiceId=:invoiceId AND status='ENABLE'";
            $queryInvoiceDetail = $dbh->prepare($sqlInvoiceDetail);
            $queryInvoiceDetail->bindParam(':id', $detailId);
            $queryInvoiceDetail->bindParam(':invoiceId', $id);
            $queryInvoiceDetail->execute();
            $invoiceDetail = $queryInvoiceDetail->fetch();

            if ($queryInvoiceDetail->rowCount() > 0) {
                $status = 'DELETED';
                $dateTimeNow = date("Y-m-d H:i:s");

                $sqlCancelInvoice = "UPDATE invoiceDetails SET status=:status WHERE id=:id";
                $queryCancelInvoice = $dbh->prepare($sqlCancelInvoice);
                $queryCancelInvoice->bindParam(':status', $status);
                $queryCancelInvoice->bindParam(':id', $detailId);
                $queryCancelInvoice->execute();

                $priceRoot = $invoice->price - $invoiceDetail->price;
                $sqlInvoicePrice = "UPDATE invoice SET price=:price WHERE id=:id";
                $queryInvoicePrice = $dbh->prepare($sqlInvoicePrice);
                $queryInvoicePrice->bindParam(':price', $priceRoot);
                $queryInvoicePrice->bindParam(':id', $id);
                $queryInvoicePrice->execute();

                $response = array('key' => true, 'message' => 'Bạn đã huỷ phòng thành công');
            } else {
                $response = array('key' => true, 'message' => 'Bạn không thể huỷ phòng');
            }
        }

    } catch (Exception $exception) {
        var_dump($exception); die();
    }
} else {
    $response = array('key' => false, 'message' => 'Bạn không thể huỷ phòng');
}

echo json_encode($response);
