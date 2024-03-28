<?php
require_once("../config.php");
header('Content-Type: application/json');
$id = $_POST['id'];

$sqlusers = "SELECT * FROM users WHERE id=:id AND status = 'ENABLE'";
$queryusers = $dbh->prepare($sqlusers);
$queryusers->bindParam(':id', $id, PDO::PARAM_STR);
$queryusers->execute();

$sqlinvoice = "SELECT * FROM invoice WHERE userId=:id AND status != 'DELETED'";
$queryinvoice = $dbh->prepare($sqlinvoice);
$queryinvoice->bindParam(':id', $id, PDO::PARAM_STR);
$queryinvoice->execute();

$response = array();
if ($queryinvoice->rowCount() > 0) {
    $response['key'] = false;
    $response['message'] = 'Người dùng này đang sử dụng đặt phòng';
} else if ($queryusers->rowCount() > 0) {
    $status = 'DELETED';
    $dateTimeNow = date("Y-m-d H:i:s");
    try {
        $sqlUsers = "UPDATE users SET status =:status, updatedAt=:updatedAt WHERE id = :id";
        $queryUsers = $dbh->prepare($sqlUsers);

        $queryUsers->bindParam(':id', $id, PDO::PARAM_INT);
        $queryUsers->bindParam(':status', $status, PDO::PARAM_STR);
        $queryUsers->bindParam(':updatedAt', $dateTimeNow, PDO::PARAM_STR);
        $queryUsers->execute();

        $response['key'] = true;
        $response['message'] = 'Xoá thành công';
    } catch (Exception $exception){
        $response['key'] = false;
        $response['message'] = 'Có lỗi trong quá trình cập nhật dữ liệu ';
    }
} else {
    $response['key'] = false;
    $response['message'] = 'Dữ liệu đã bị xoá';
}
echo json_encode($response);
