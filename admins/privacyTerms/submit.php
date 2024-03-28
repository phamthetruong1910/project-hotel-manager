<?php
require_once("../config.php");
header('Content-Type: application/json');
$title = $_POST['title'];
$description = $_POST['description'];
$type = 'PRIVACY_TERMS';
$dateTimeNow = date("Y-m-d H:i:s");
$status = 'ENABLE';

$sqlratehotelst = "SELECT * FROM pages WHERE type =:type AND status != 'DELETED'";
$queryratehotels = $dbh->prepare($sqlratehotelst);
$queryratehotels->bindParam(':type', $type, PDO::PARAM_STR);
$queryratehotels->execute();

$response = array();
if ($queryratehotels->rowCount() == 0) {

    $sqlPageInserts = "INSERT INTO pages(title,description,type,createdAt,status) VALUES(:title, :description, :type, :createdAt, :status)";
    $queryPageInsert = $dbh->prepare($sqlPageInserts);
    $queryPageInsert->bindParam(':title', $title, PDO::PARAM_STR);
    $queryPageInsert->bindParam(':description', $description, PDO::PARAM_STR);
    $queryPageInsert->bindParam(':type', $type, PDO::PARAM_STR);
    $queryPageInsert->bindParam(':createdAt', $dateTimeNow, PDO::PARAM_STR);
    $queryPageInsert->bindParam(':status', $status, PDO::PARAM_STR);
    $queryPageInsert->execute();

    $response['key'] = true;
    $response['message'] = 'Cập nhật thành công';
} else if ($queryratehotels->rowCount() > 0) {
    $status = 'DELETED';
    $dateTimeNow = date("Y-m-d H:i:s");

    $sqlUpdate= "UPDATE pages SET updatedAt=:updatedAt,title = :title,description = :description WHERE type = 'PRIVACY_TERMS'";
    $queryUpdate = $dbh->prepare($sqlUpdate);
    $queryUpdate->bindParam(':updatedAt', $dateTimeNow, PDO::PARAM_STR);
    $queryUpdate->bindParam(':title', $title, PDO::PARAM_STR);
    $queryUpdate->bindParam(':description', $description, PDO::PARAM_STR);
    $queryUpdate->execute();

    $response['key'] = true;
    $response['message'] = 'Cập nhật thành công';
} else {
    $response['key'] = false;
    $response['message'] = 'Lỗi trong quá trình cập nhật dữ liệu';
}
echo json_encode($response);
