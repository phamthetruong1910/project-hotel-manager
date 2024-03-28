<?php
require_once("includes/config.php");
header('Content-Type: application/json');
$email= $_POST['email'];

$sqlHotel = "SELECT * FROM users WHERE email=:email AND status = 'ENABLE'";
$queryHotel = $dbh->prepare($sqlHotel);
$queryHotel->bindParam(':email', $email, PDO::PARAM_STR);
$queryHotel->execute();


if ($queryHotel->rowCount() === 0) {
    $response['key'] = false;
    $response['message'] = 'Email không tồn tại trong hệ thống!';
} else {
    $response['key'] = true;
    $response['message'] = 'Email tồn tại';
}
echo json_encode($response);
