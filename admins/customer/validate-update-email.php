<?php
include('../config.php');

header('Content-Type: application/json');

$email= $_POST['email'];
$id = $_POST['id'];
$sqlHotel = "SELECT * FROM users WHERE email=:email AND id != :id";
$queryHotel = $dbh->prepare($sqlHotel);
$queryHotel->bindParam(':email', $email, PDO::PARAM_STR);
$queryHotel->bindParam(':id', $id);
$queryHotel->execute();

if ($queryHotel->rowCount() > 0) {
    $response['key'] = false;
    $response['message'] = 'Email đã tồn tại trong hệ thống!';
} else {
    $response['key'] = true;
    $response['message'] = 'Email có thể cập nhật';
}
echo json_encode($response);
