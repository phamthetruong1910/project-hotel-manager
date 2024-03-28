<?php
session_start();
error_reporting(0);

include("config.php");
header('Content-Type: application/json');
$email = $_POST['email'];
$password = md5($_POST['password']);


$sql = "SELECT email,password FROM users WHERE email=:email and password=:password";
$query = $dbh->prepare($sql);
$query->bindParam(':email', $email, PDO::PARAM_STR);
$query->bindParam(':password', $password, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

if ($query->rowCount() > 0) {
    $_SESSION['login'] = $_POST['email'];
    $response['key'] = true;
    $response['message'] = 'Đăng nhập thành công';
} else {
    $response['key'] = false;
    $response['message'] = 'Email hoặc mật khâu không đúng';
}

echo json_encode($response);
