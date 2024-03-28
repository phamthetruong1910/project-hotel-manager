<?php
include('../config.php');

header('Content-Type: application/json');
$id = $_POST['id'];
$email = $_POST['email'];
$name = $_POST['name'];
$password = md5($_POST['password']);
$mobileNumber = $_POST['mobileNumber'];
$dateTimeNow = date("Y-m-d H:i:s");

$sqlratehotelst = "SELECT * FROM users WHERE id =:id AND status != 'DELETED'";
$queryratehotels = $dbh->prepare($sqlratehotelst);
$queryratehotels->bindParam(':id', $id, PDO::PARAM_STR);
$queryratehotels->execute();

$response = array();
if ($queryratehotels->rowCount() == 0) {
    $response['key'] = false;
    $response['message'] = 'Lỗi trong quá trình cập nhật dữ liệu';
} else if ($queryratehotels->rowCount() > 0) {
    if ($_POST['password'] != null) {
        $sqlUpdate= "UPDATE users SET updatedAt=:updatedAt,email = :email,password = :password,fullName = :fullName,mobileNumber = :mobileNumber WHERE status != 'DELETED' AND id =:id";
        $queryUpdate = $dbh->prepare($sqlUpdate);
        $queryUpdate->bindParam(':updatedAt', $dateTimeNow, PDO::PARAM_STR);
        $queryUpdate->bindParam(':email', $email, PDO::PARAM_STR);
        $queryUpdate->bindParam(':password', $password, PDO::PARAM_STR);
        $queryUpdate->bindParam(':fullName', $name, PDO::PARAM_STR);
        $queryUpdate->bindParam(':mobileNumber', $mobileNumber, PDO::PARAM_STR);
        $queryUpdate->bindParam(':id', $id, PDO::PARAM_STR);

        $queryUpdate->execute();
    } else {
        $sqlUpdate= "UPDATE users SET updatedAt=:updatedAt,email = :email,fullName = :fullName,mobileNumber = :mobileNumber WHERE status != 'DELETED' AND id =:id";
        $queryUpdate = $dbh->prepare($sqlUpdate);
        $queryUpdate->bindParam(':updatedAt', $dateTimeNow, PDO::PARAM_STR);
        $queryUpdate->bindParam(':email', $email, PDO::PARAM_STR);
        $queryUpdate->bindParam(':fullName', $name, PDO::PARAM_STR);
        $queryUpdate->bindParam(':mobileNumber', $mobileNumber, PDO::PARAM_STR);
        $queryUpdate->bindParam(':id', $id, PDO::PARAM_STR);

        $queryUpdate->execute();
    }

    $response['key'] = true;
    $response['message'] = 'Cập nhật thành công ';
} else {
    $response['key'] = false;
    $response['message'] = 'Lỗi trong quá trình cập nhật dữ liệu';
}
echo json_encode($response);
