<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_POST['submit50'])) {
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $sql = "SELECT * FROM users WHERE email=:email and mobileNumber=:mobile";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetch(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        if (SETTING_EMAIL === true) {
            $password = md5('12345678');
            $sqlusers = "UPDATE users SET password=:password WHERE email=:email and mobileNumber=:mobile";
            $queryusers = $dbh->prepare($sqlusers);
            $queryusers->bindParam(':email', $email, PDO::PARAM_STR);
            $queryusers->bindParam(':mobile', $mobile, PDO::PARAM_STR);
            $queryusers->bindParam(':password', $password, PDO::PARAM_STR);
            $queryusers->execute();

            $to_email = $email;
            $subject = 'Cảm ơn Khách hàng '. $results->fullname .' đã sử dụng dịch vụ của chúng tôi ';
            $body = 'Mật khẩu khôi phục của bạn là : 12345678 ';
            $headers = "From: bookingkhachsan321@gmail.com";

            mail($to_email, $subject, $body, $headers);
            $msg = "Mật khẩu của bạn đã gởi qua email";

        } else {
            $msg = "Hệ thống gửi email đang tạm dừng";
        }
    } else {
        $error = "Có lỗi";
    }
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>NKN | HỆ THỐNG ĐẶT PHÒNG KHÁCH SẠN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="Tourism Management System In PHP"/>
    <script type="applijewelleryion/x-javascript">
         addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
    </script>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css'/>
    <link href="css/style.css" rel='stylesheet' type='text/css'/>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- Custom Theme files -->
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--animate-->
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <style>
        .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }

        .succWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }
    </style>
</head>
<body>
<!-- top-header -->
<div class="top-header">
    <?php include('includes/header.php'); ?>
    <div class="banner-1 ">
        <div class="container">
            <h1 class="wow zoomIn animated animated" data-wow-delay=".5s"
                style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">NKN-HỆ THỐNG ĐẶT PHÒNG KHÁCH SẠN</h1>
        </div>
    </div>
    <!--- /banner-1 ---->
    <!--- privacy ---->
    <div class="privacy">
        <div class="container">
            <h3 class="wow fadeInDown animated animated" data-wow-delay=".5s"
                style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">Khôi phục mật khẩu</h3>
            <form name="chngpwd" method="post">
                <?php if ($error) { ?>
                    <div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?>
                    </div><?php } else if ($msg) { ?>
                    <div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                <p style="width: 350px;">

                    <b>Email</b> <input type="email" name="email" class="form-control" id="email" oninput="validateEmail(this)" required>
                </p>

                <p style="width: 350px;">

                    <b>Số điện thoại</b> <input type="text" name="mobile" class="form-control" id="mobile"
                                            placeholder="" required="">
                </p>

                <p style="width: 350px;">
                    <button type="submit" name="submit50" class="btn-primary btn">Gửi mật khẩu qua email</button>
                </p>
            </form>


        </div>
    </div>
    <script>
        function validateEmail(input) {
            $.ajax({
                url: "validate-email-forgot-password.php",
                method: "POST",
                data: {email: input.value},
                success: function (response) {
                    if (response.key) {
                        console.log(response.key)
                        input.setCustomValidity("");
                    } else {
                        console.log(response.key)

                        input.setCustomValidity(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert(error)
                    alert(status)
                    alert(xhr)
                    // Handle the error here
                }
            });
        }
    </script>
    <!--- /privacy ---->
    <!--- footer-top ---->
    <!--- /footer-top ---->
    <?php include('includes/footer.php'); ?>
    <!-- signup -->
    <?php include('includes/signup.php'); ?>
    <!-- //signu -->
    <!-- signin -->
    <?php include('includes/signin.php'); ?>
    <!-- //signin -->
    <!-- write us -->
    <?php include('includes/write-us.php'); ?>
</body>
</html>