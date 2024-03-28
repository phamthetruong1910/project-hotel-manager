<?php
require_once("../config.php");
header('Content-Type: application/json');
$id = $_POST['id'];

$sqlHotel = "SELECT * FROM roomtype WHERE id=:id AND status = 'ENABLE'";
$queryHotel = $dbh->prepare($sqlHotel);
$queryHotel->bindParam(':id', $id, PDO::PARAM_STR);
$queryHotel->execute();
$response = array();

$dateNow = date("Y-m-d H:i:s");
$sqlInvoice = "SELECT * FROM invoice INNER JOIN invoicedetails ON invoice.id = invoicedetails.invoiceId WHERE invoice.toDate >= :DateNow AND status != 'DELETED' AND invoicedetails.roomTypeId = :roomTypeId AND invoicedetails.status != 'DELETED'";
$queryInvoice = $dbh->prepare($sqlInvoice);
$queryInvoice->bindParam(':DateNow', $dateNow, PDO::PARAM_STR);
$queryInvoice->bindParam(':roomTypeId', $id, PDO::PARAM_STR);

$queryInvoice->execute();

if ($queryInvoice->rowCount() > 0) {
    $response['key'] = false;
    $response['message'] = 'Dữ liệu đã bị được dùng!';
} else if ($queryHotel->rowCount() > 0) {
    $status = 'DELETED';
    $sqlDelete = "UPDATE roomtype SET status = :status WHERE id = :id";
    $queryDelete = $dbh->prepare($sqlDelete);
    $queryDelete->bindParam(':id', $id, PDO::PARAM_INT);
    $queryDelete->bindParam(':status', $status, PDO::PARAM_STR);

    $queryDelete->execute();
    $response['key'] = true;
    $response['message'] = 'Xoá thành công';
} else {
    $response['key'] = false;
    $response['message'] = 'Dữ liệu đã bị xoá';
}
echo json_encode($response);
