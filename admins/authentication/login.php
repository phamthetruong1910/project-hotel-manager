<?php
session_start();
include('../config.php');
if (isset($_SESSION['alogin'])) {
    echo "<script type='text/javascript'> document.location = '../index.php'; </script>";
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM admin WHERE userName=:userName and password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':userName', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);

    $query->execute();

    if ($query->rowCount() > 0) {
        $_SESSION['alogin'] = $username;

        echo "<script type='text/javascript'> document.location = '../index.php'; </script>";
    } else {

        echo "<script>alert('Invalid Details');</script>";

    }

}
?>
<!DOCTYPE html>
<html>
<?php
include('structure/header.php');

?>
<body class="login-page">
<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0);">Quản trị viên<b>TMS</b></a>
        <small>Admin Booking</small>
    </div>
    <div class="card">
        <div class="body">
            <form id="sign_in" method="POST">
                <div class="msg">Quản trị viên</div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="username" placeholder="Tài khoản" required autofocus>
                    </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password" placeholder="mật khẩu" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <a class="btn btn-block bg-pink waves-effect" href="../../index.php" >Trở lại trang chủ</a>
                    </div>
                    <div class="col-xs-2">
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" name="submit" type="submit">Đăng nhập</button>
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-6">
                    </div>
                    <div class="col-xs-6 align-right">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

<?php include('structure/footer.php') ?>
</html>
