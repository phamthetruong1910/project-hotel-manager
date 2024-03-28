<?php
require_once("../config.php");
header('Content-Type: application/json');
$id = $_POST['id'];

$sqlratehotelst = "SELECT * FROM ratehotels WHERE id=:id AND status != 'DELETED'";
$queryratehotels = $dbh->prepare($sqlratehotelst);
$queryratehotels->bindParam(':id', $id, PDO::PARAM_STR);
$queryratehotels->execute();

$response = array();
if ($queryratehotels->rowCount() == 0) {
    $response['key'] = false;
    $response['message'] = 'Dữ liệu đã được Xoá';
}else if ($queryratehotels->rowCount() > 0) {
    $status = 'ENABLE';
    $dateTimeNow = date("Y-m-d H:i:s");

    $sqlAdd= "UPDATE ratehotels SET status = :status, updatedAt=:updatedAt WHERE id = :id";
    $queryAdd = $dbh->prepare($sqlAdd);
    $queryAdd->bindParam(':id', $id, PDO::PARAM_INT);
    $queryAdd->bindParam(':status', $status, PDO::PARAM_STR);
    $queryAdd->bindParam(':updatedAt', $dateTimeNow, PDO::PARAM_STR);

    $queryAdd->execute();
    $response['key'] = true;
    $response['message'] = 'Duyệt thành công';
} else {
    $response['key'] = false;
    $response['message'] = 'Dữ liệu đã bị xoá';
}
echo json_encode($response);