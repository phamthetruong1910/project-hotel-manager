<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['submit6'])) {
        $name = $_POST['name'];
        $mobileNumber = $_POST['mobileNumber'];
        $email = $_SESSION['login'];

        $sql = "update users set fullName=:name,mobileNumber=:mobileNumber where email=:email";
        $query = $dbh->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':mobileNumber', $mobileNumber, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $msg = "Profile Updated Successfully";
    }

    ?>
    <!DOCTYPE HTML>
    <html>
    <head>
        <title>TMS | Hệ Thống Đặt Phòng Khách Sạn</title>
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
                    style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">TMS-HỆ THỐNG ĐẶT PHÒNG KHÁCH SẠN</h1>
            </div>
        </div>
        <!--- /banner-1 ---->
        <!--- privacy ---->
        <div class="privacy">
            <div class="container">
                <h3 class="wow fadeInDown animated animated" data-wow-delay=".5s"
                    style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">Thông tin cá nhân</h3>
                <form name="chngpwd" method="post">
                    <?php if ($error) { ?>
                        <div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?>
                        </div><?php } else if ($msg) { ?>
                        <div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
                        </div><?php } ?>

                    <?php
                    $userEmail = $_SESSION['login'];
                    $sql = "SELECT * from users where email=:email";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':email', $userEmail, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) { ?>

                            <p style="width: 350px;">

                                <b>Họ và tên</b> <input type="text" name="name"
                                                   value="<?php echo htmlentities($result->fullName); ?>"
                                                   class="form-control" id="name" required="">
                            </p>

                            <p style="width: 350px;">
                                <b>Số điện thoại</b>
                                <input type="text" class="form-control" name="mobileNumber" maxlength="10"
                                       value="<?php echo htmlentities($result->mobileNumber); ?>" id="mobileNumber"
                                       required="">
                            </p>

                            <p style="width: 350px;">
                                <b>email</b>
                                <input type="email" class="form-control" name="email"
                                       value="<?php echo htmlentities($result->email); ?>" id="email" readonly>
                            </p>
                            <p style="width: 350px;">
                                <b>Lần cập nhật cuối : </b>
                                <?php echo htmlentities($result->updatedAt); ?>
                            </p>

                            <p style="width: 350px;">
                                <b>Ngày đăng ký:</b>
                                <?php echo htmlentities($result->createdAt); ?>
                            </p>
                        <?php }
                    } ?>

                    <p style="width: 350px;">
                        <button type="submit" name="submit6" class="btn-primary btn">Cập nhật</button>
                    </p>
                </form>


            </div>
        </div>
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
<?php } ?>