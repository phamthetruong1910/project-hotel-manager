<?php
require_once("../config.php");
header('Content-Type: application/json');
$hotelId = $_POST['id'];

$sqlHotel = "SELECT * FROM hotels WHERE id=:id AND status = 'ENABLE'";
$queryHotel = $dbh->prepare($sqlHotel);
$queryHotel->bindParam(':id', $hotelId, PDO::PARAM_STR);
$queryHotel->execute();
$response = array();

$sqlInvoice = "SELECT * FROM invoice WHERE hotelId=:id AND status != 'DELETED'";
$queryInvoice = $dbh->prepare($sqlInvoice);
$queryInvoice->bindParam(':id', $hotelId, PDO::PARAM_STR);
$queryInvoice->execute();

if ($queryInvoice->rowCount() > 0) {
    $response['key'] = false;
    $response['message'] = 'Dữ liệu đã bị được dùng!';
} else if ($queryHotel->rowCount() > 0) {
    $status = 'DELETED';
    $sqlDelete = "UPDATE hotels SET status = :status WHERE id = :id";
    $queryDelete = $dbh->prepare($sqlDelete);
    $queryDelete->bindParam(':id', $hotelId, PDO::PARAM_INT);
    $queryDelete->bindParam(':status', $status, PDO::PARAM_STR);

    $queryDelete->execute();
    $response['key'] = true;
    $response['message'] = 'Xoá thành công';
} else {
    $response['key'] = false;
    $response['message'] = 'Dữ liệu đã bị xoá';
}
echo json_encode($response);
