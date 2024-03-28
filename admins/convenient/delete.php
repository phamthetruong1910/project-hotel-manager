<?php
require_once("../config.php");
header('Content-Type: application/json');
$id = $_POST['id'];

$sqlConvenient = "SELECT * FROM convenient WHERE id=:id AND status = 'ENABLE'";
$queryConvenient = $dbh->prepare($sqlConvenient);
$queryConvenient->bindParam(':id', $id, PDO::PARAM_STR);
$queryConvenient->execute();

$sqlroomtypeconvenient = "SELECT * FROM roomtypeconvenient WHERE convenientId=:id";
$queryroomtypeconvenient = $dbh->prepare($sqlroomtypeconvenient);
$queryroomtypeconvenient->bindParam(':id', $id, PDO::PARAM_STR);
$queryroomtypeconvenient->execute();

$response = array();
if ($queryroomtypeconvenient->rowCount() > 0) {
    $response['key'] = false;
    $response['message'] = 'Dữ liệu đã được dùng';
}else if ($queryConvenient->rowCount() > 0) {
    $status = 'DELETED';
    $dateTimeNow = date("Y-m-d H:i:s");

    $sqlDelete = "UPDATE convenient SET status = :status, updatedAt=:updatedAt WHERE id = :id";
    $queryDelete = $dbh->prepare($sqlDelete);
    $queryDelete->bindParam(':id', $id, PDO::PARAM_INT);
    $queryDelete->bindParam(':status', $status, PDO::PARAM_STR);
    $queryDelete->bindParam(':updatedAt', $dateTimeNow, PDO::PARAM_STR);

    $queryDelete->execute();
    $response['key'] = true;
    $response['message'] = 'Xoá thành công';
} else {
    $response['key'] = false;
    $response['message'] = 'Dữ liệu đã bị xoá';
}
echo json_encode($response);
