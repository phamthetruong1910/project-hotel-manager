<?php
include('../config.php');

header('Content-Type: application/json');

$id = $_POST['id'];
$mobileNumber= $_POST['mobileNumber'];

$sqlHotel = "SELECT * FROM users WHERE  mobileNumber=:mobileNumber AND id != :id";
$queryHotel = $dbh->prepare($sqlHotel);
$queryHotel->bindParam(':mobileNumber', $mobileNumber);
$queryHotel->bindParam(':id', $id);
$queryHotel->execute();

if ($queryHotel->rowCount() > 0) {
    $response['key'] = false;
    $response['message'] = 'Số điện đã tồn tại trong hệ thống!';
} else {
    $response['key'] = true;
    $response['message'] = 'Email có thể cập nhật';
}
echo json_encode($response);
