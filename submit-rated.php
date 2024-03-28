<?php
session_start();
include('includes/config.php');
header('Content-Type: application/json');

$id = $_POST['id'];
$rank = $_POST['rank'];
$description = $_POST['description'];
if(isset($_SESSION['login'])){
    $email=$_SESSION['login'];
} else {
    $email = null;
}

if ($_POST['rank'] === null) {
    $response['key'] = false;
    $response['message'] = 'Vui lòng chọn sao!';
} else {
    $status = 'WAITING';
    $dateTimeNow = date("Y-m-d H:i:s");
    if ($email) {
        $sqlUser = "SELECT * FROM users WHERE status='ENABLE' AND email =:email";
        $queryUser = $dbh->prepare($sqlUser);
        $queryUser->bindParam(':email', $email);
        $user = $queryUser->fetch();

        $sql = "INSERT INTO ratehotels(userId,hotelId,rate,description,status,createdAt) 
                    VALUES(:userId,:hotelId,:rate,:description,:status,:createdAt)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':userId', $user['id'], PDO::PARAM_INT);

    } else {
        $sql = "INSERT INTO ratehotels(hotelId,rate,description,status,createdAt) 
                    VALUES(:hotelId,:rate,:description,:status,:createdAt)";
        $query = $dbh->prepare($sql);
    }

    $query->bindParam(':hotelId', $id, PDO::PARAM_INT);
    $query->bindParam(':rate', $rank, PDO::PARAM_INT);
    $query->bindParam(':description', $description, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':createdAt', $dateTimeNow, PDO::PARAM_STR);

    $query->execute();
    $response['key'] = true;
    $response['message'] = 'Ban đã đánh giá thành công! Hãy chờ xét duyệt!';
}

echo json_encode($response);
