<?php
require_once("../config.php");
header('Content-Type: application/json');
$id = $_POST['id'];

$sqlInvoice = "SELECT * FROM invoice WHERE id=:id AND status != 'DELETED'";
$queryInvoice = $dbh->prepare($sqlInvoice);
$queryInvoice->bindParam(':id', $id, PDO::PARAM_STR);
$queryInvoice->execute();
$data = $queryInvoice->fetch();

$response = array();
if ($queryInvoice->rowCount() === 0) {
    $response['key'] = false;
    $response['message'] = 'Sản phẩm đã bị xoá';
} elseif ($data['fromDate'] < date("Y-m-d H:i:s")) {
    $response['key'] = false;
    $response['message'] = 'Sản phẩm đã đã hết hạn không thể huỷ!';
}
else {
    $status = 'CANCEL';
    $dateTimeNow = date("Y-m-d H:i:s");

    $sqlDelete = "UPDATE invoice SET status = :status, updatedAt=:updatedAt WHERE id = :id";
    $queryDelete = $dbh->prepare($sqlDelete);
    $queryDelete->bindParam(':id', $id, PDO::PARAM_INT);
    $queryDelete->bindParam(':status', $status, PDO::PARAM_STR);
    $queryDelete->bindParam(':updatedAt', $dateTimeNow, PDO::PARAM_STR);

    $queryDelete->execute();
    $response['key'] = true;
    $response['message'] = 'Huỷ thành công';
}
echo json_encode($response);
