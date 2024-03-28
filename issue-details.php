<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {

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
        <link href="css/product-list.css" rel='stylesheet' type='text/css'/>

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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <script>
            new WOW().init();
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
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

            td {
                text-align: center; /* canh giữa nội dung trong ô */
                vertical-align: middle; /* canh giữa ô theo chiều dọc */
            }

            table {
                border-collapse: collapse; /* xóa khoảng cách giữa các ô */
                border: 1px solid black; /* đường viền bảng */
                box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.25);
                font-family: 'Oswald', sans-serif;
            }

            th, td {
                border: 1px solid black; /* đường viền các ô */
                padding: 8px; /* khoảng cách giữa nội dung và viền */
                text-align: center; /* canh giữa nội dung trong ô */
            }
            .text-container {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
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
                    style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">TMS-HỆ THỐNG ĐẶT KHÁCH SẠN</h1>
            </div>
        </div>
        <!--- /banner-1 ---->
        <!--- privacy ---->
        <div class="privacy">
            <div class="container">
                <h3 class="wow fadeInDown animated animated" data-wow-delay=".5s"
                    style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">Yêu cầu của bạn</h3>
                <button class="btn btn-success" onclick="SubmitIssue(<?php echo $_REQUEST['invoiceId']; ?>)" >Thêm Yêu cầu</button>

                <form name="chngpwd" method="post" onSubmit="return valid();">
                    <?php if ($error) { ?>
                        <div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?>
                        </div><?php } else if ($msg) { ?>
                        <div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
                        </div><?php } ?>
                    <p>
                    <table>
                        <?php

                        $id = $_REQUEST['invoiceId'];
                        $email = $_SESSION['login'];;
                        $sql = "SELECT * FROM issues 
                                    WHERE invoiceId=:invoiceId AND status != 'DELETED' ORDER BY createdAt DESC";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':invoiceId', $id, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll();
                        $cnt = 1;

                        if ($query->rowCount() > 0) { ?>
                        <tr align="center" style="background: #4CB320">
                            <td>#</td>
                            <td>Tiêu đề</td>
                            <td>Mô tả</td>
                            <td>Ngày tạo</td>
                            <td>Admin trả lời</td>
                            <td>Trạng thái</td>
                        </tr>
                        <?php
                            $i = 1;
                            foreach ($results as $result) {
                                ?>
                                <tr align="center" id="record-">
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo htmlentities($result['Issue']); ?></td>
                                    <td><?php echo htmlentities($result['description']); ?></td>
                                    <td><?php echo htmlentities($result['createdAt']); ?></td>
                                    <td><?php echo htmlentities($result['adminRemark']); ?></td>
                                    <td>
                                    <?php if ($result['type'] === 'WAITING') { ?>
                                        <tag style="color: chocolate">Đang chờ</tag>
                                    <?php } else if ($result['type'] === 'FINISHED') { ?>
                                        <tag style="color: #0f9d58">Đã đáp ứng</tag>
                                    <?php } else if($result['type'] === 'CANCEL') { ?>
                                        <tag style="color: red">Không thể đáp ứng</tag>
                                    <?php } else { ?>
                                        <tag style="color: #0f9d58">Đã trả lời</tag>
                                    <?php } ?>
                                    </td>
                                </tr>
                                <?php $cnt = $cnt + 1;
                            }
                        } else { ?>
                            <tag style="color: black">Không có dữ liệu</tag>
                    <?php } ?>
                    </table>
                    </p>
                </form>


            </div>
        </div>
        <div class="container">
            <div class="roomHotel">
                <div class="row">
                    <div class="col-md-12 wow fadeInLeft animated">
                        <h2><b>CÓ thể BẠN QUAN TÂM</b></h2>
                        <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
                            <!-- Carousel indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                            </ol>
                            <!-- Wrapper for carousel items -->
                            <div class="carousel-inner">
                                <div class="item carousel-item active">
                                    <div class="row" style="height: 400px">
                                        <?php
                                        $sql = "SELECT * from hotels where status = 'ENABLE' order by createdAt desc limit 4 OFFSET 0";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) { ?>
                                                <div class="col-sm-3">
                                                    <div class="thumb-wrapper">
                                                        <span class="wish-icon"><i class="fa fa-heart"></i></span>
                                                        <div class="img-box">
                                                            <?php
                                                            $sqlImages = "SELECT * from images where code = 'HOTEL' AND objectId=:objectId limit 1";
                                                            $queryImages = $dbh->prepare($sqlImages);
                                                            $queryImages->bindParam(':objectId', $result->id, PDO::PARAM_STR);
                                                            $queryImages->execute();
                                                            $imagesTitle = $queryImages->fetch(PDO::FETCH_OBJ);
                                                            $cnt = 1;
                                                            if ($imagesTitle) {
                                                                ?>
                                                                <img src="admins/images/products/<?php echo $imagesTitle->name ?>"
                                                                     class="img-fluid" alt="">
                                                            <?php } ?>
                                                        </div>
                                                        <div class="thumb-content">
                                                            <h4 class="text-container"><?php echo $result->name ?></h4>
                                                            <p class="text-container">
                                                                <span><?php echo $result->location ?></span></p>
                                                            <p class="text-container"><span><?php echo $result->type ?></span>
                                                            </p>
                                                            <div class="star-rating">
                                                                <ul class="list-inline">
                                                                    <?php
                                                                    for ($i = 1; $i <= 5; $i++) {
                                                                        if ($i > $result->ranking) {
                                                                            ?>
                                                                            <li class="list-inline-item"><i
                                                                                    class="far fa-star"></i>
                                                                            </li>
                                                                        <?php } else { ?>
                                                                            <li class="list-inline-item"><i class="fa fa-star"></i>
                                                                            </li>

                                                                        <?php }
                                                                    } ?>
                                                                </ul>
                                                            </div>
                                                            <div style="padding-bottom: 10px">
                                                                <?php
                                                                $sqlPrice = "SELECT min(price) as min_price FROM roomtype WHERE hotelId=:hotelId AND status = 'ENABLE'";
                                                                $queryPrice = $dbh->prepare($sqlPrice);
                                                                $queryPrice->bindParam(':hotelId', $result->id, PDO::PARAM_INT);
                                                                $queryPrice->execute();
                                                                $price = $queryPrice->fetch();
                                                                ?>
                                                                <div class="grand">
                                                                    <h3 style="float: left; font-size: 15px"><b>Giá chỉ từ: </b></h3>
                                                                    <h3 style="color: red; font-size: 15px"><b><?php echo number_format($price['min_price'], 0, ',', '.') . ' VND/Đêm' ?></b></h3>
                                                                </div>
                                                            </div>
                                                            <a href="package-details.php?pkgid=<?php echo htmlentities($result->id); ?>"
                                                               class="btn btn-primary">Chi tiết</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        } ?>
                                    </div>
                                </div>
                                <div class="item carousel-item">
                                    <div class="row" style="height: 400px">
                                        <?php
                                        $sql = "SELECT * from hotels where status = 'ENABLE' order by createdAt desc limit 4 OFFSET 4";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) { ?>
                                                <div class="col-sm-3">
                                                    <div class="thumb-wrapper">
                                                        <span class="wish-icon"><i class="fa fa-heart"></i></span>
                                                        <div class="img-box">
                                                            <?php
                                                            $sqlImages = "SELECT * from images where code = 'HOTEL' AND objectId=:objectId limit 1";
                                                            $queryImages = $dbh->prepare($sqlImages);
                                                            $queryImages->bindParam(':objectId', $result->id, PDO::PARAM_STR);
                                                            $queryImages->execute();
                                                            $imagesTitle = $queryImages->fetch(PDO::FETCH_OBJ);
                                                            $cnt = 1;
                                                            if ($imagesTitle) {
                                                                ?>
                                                                <img src="admins/images/products/<?php echo $imagesTitle->name ?>"
                                                                     class="img-fluid" alt="">
                                                            <?php } ?>
                                                        </div>
                                                        <div class="thumb-content">
                                                            <h4 class="text-container"><?php echo $result->name ?></h4>
                                                            <p class="text-container">
                                                                <span><?php echo $result->location ?></span></p>
                                                            <p class="text-container"><span><?php echo $result->type ?></span>
                                                            </p>
                                                            <div class="star-rating">
                                                                <ul class="list-inline">
                                                                    <?php
                                                                    for ($i = 1; $i <= 5; $i++) {
                                                                        if ($i > $result->ranking) {
                                                                            ?>
                                                                            <li class="list-inline-item"><i
                                                                                    class="far fa-star"></i>
                                                                            </li>
                                                                        <?php } else { ?>
                                                                            <li class="list-inline-item"><i
                                                                                    class="fa fa-star"></i></li>

                                                                        <?php }
                                                                    } ?>
                                                                </ul>
                                                            </div>
                                                            <div style="padding-bottom: 10px">
                                                                <?php
                                                                $sqlPrice = "SELECT min(price) as min_price FROM roomtype WHERE hotelId=:hotelId AND status = 'ENABLE'";
                                                                $queryPrice = $dbh->prepare($sqlPrice);
                                                                $queryPrice->bindParam(':hotelId', $result->id, PDO::PARAM_INT);
                                                                $queryPrice->execute();
                                                                $price = $queryPrice->fetch();
                                                                ?>
                                                                <div class="grand">
                                                                    <h3 style="float: left; font-size: 15px"><b>Giá chỉ từ: </b></h3>
                                                                    <h3 style="color: red; font-size: 15px"><b><?php echo number_format($price['min_price'], 0, ',', '.') . ' VND/Đêm' ?></b></h3>
                                                                </div>
                                                            </div>
                                                            <a href="package-details.php?pkgid=<?php echo htmlentities($result->id); ?>"
                                                               class="btn btn-primary">Chi tiết</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        } ?>
                                    </div>
                                </div>
                                <div class="item carousel-item" style="height: 400px">
                                    <div class="row">
                                        <?php
                                        $sql = "SELECT * from hotels where status = 'ENABLE' order by createdAt desc limit 4 OFFSET 8";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) { ?>
                                                <div class="col-sm-3">
                                                    <div class="thumb-wrapper">
                                                        <span class="wish-icon"><i class="fa fa-heart"></i></span>
                                                        <div class="img-box">
                                                            <?php
                                                            $sqlImages = "SELECT * from images where code = 'HOTEL' AND objectId=:objectId limit 1";
                                                            $queryImages = $dbh->prepare($sqlImages);
                                                            $queryImages->bindParam(':objectId', $result->id, PDO::PARAM_STR);
                                                            $queryImages->execute();
                                                            $imagesTitle = $queryImages->fetch(PDO::FETCH_OBJ);
                                                            $cnt = 1;
                                                            if ($imagesTitle) {
                                                                ?>
                                                                <img src="admins/images/products/<?php echo $imagesTitle->name ?>"
                                                                     class="img-fluid" alt="">
                                                            <?php } ?>
                                                        </div>
                                                        <div class="thumb-content">
                                                            <h4 class="text-container"><?php echo $result->name ?></h4>
                                                            <p class="text-container">
                                                                <span><?php echo $result->location ?></span></p>
                                                            <p class="text-container"><span><?php echo $result->type ?></span>
                                                            </p>
                                                            <div class="star-rating">
                                                                <ul class="list-inline">
                                                                    <?php
                                                                    for ($i = 1; $i <= 5; $i++) {
                                                                        if ($i > $result->ranking) {
                                                                            ?>
                                                                            <li class="list-inline-item"><i
                                                                                    class="far fa-star"></i>
                                                                            </li>
                                                                        <?php } else { ?>
                                                                            <li class="list-inline-item"><i
                                                                                    class="fa fa-star"></i></li>

                                                                        <?php }
                                                                    } ?>
                                                                </ul>
                                                            </div>
                                                            <div style="padding-bottom: 10px">
                                                                <?php
                                                                $sqlPrice = "SELECT min(price) as min_price FROM roomtype WHERE hotelId=:hotelId AND status = 'ENABLE'";
                                                                $queryPrice = $dbh->prepare($sqlPrice);
                                                                $queryPrice->bindParam(':hotelId', $result->id, PDO::PARAM_INT);
                                                                $queryPrice->execute();
                                                                $price = $queryPrice->fetch();
                                                                ?>
                                                                <div class="grand">
                                                                    <h3 style="float: left; font-size: 15px"><b>Giá chỉ từ: </b></h3>
                                                                    <h3 style="color: red; font-size: 15px"><b><?php echo number_format($price['min_price'], 0, ',', '.') . ' VND/Đêm' ?></b></h3>
                                                                </div>
                                                            </div>
                                                            <a href="package-details.php?pkgid=<?php echo htmlentities($result->id); ?>"
                                                               class="btn btn-primary">Chi tiết</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        } ?>
                                    </div>

                                </div>
                            </div>
                            <!-- Carousel controls -->
                            <a class="carousel-control-prev" href="#myCarousel" data-slide="prev" style="display: none;">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="carousel-control-next" href="#myCarousel" data-slide="next" style="display: none;">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <script>
            function SubmitCancelRoom(id, detailId) {
                event.preventDefault();
                Swal.fire({
                    title: 'Bạn có muốn đổi hay muốn cập nhập hay không ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xác nhận',
                    cancelButtonText: 'Huỷ'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "booking/cancel-room.php",
                            method: "POST",
                            data: {
                                id: id,
                                detailId: detailId
                            },
                            success: function (response) {
                                if (response.key) {
                                    $("#record-" + detailId).remove();

                                    $("#table-id").load(location.href + " #table-id>*", "");
                                    Swal.fire(response.message, "", "success");
                                } else {
                                    Swal.fire(response.message, "", "error");
                                }
                            },
                            error: function (xhr, status, error) {
                                console.log(xhr.responseText);
                                console.log(status);
                                console.log(error);
                                Swal.fire("Lỗi trong quá trình xử lý dữ liệu!", "", "error");
                            }
                        });
                    }
                })
            }
            async function SubmitIssue(id) {
                event.preventDefault();

                const { value: { inputText, textareaText } } = await Swal.fire({
                    title: 'Thêm yêu cầu ',
                    html:
                        `<div>
      <input id="input-text" class="swal2-input" placeholder="Tiêu đề ...">
    </div>
    <div>
      <textarea id="textarea-text" class="swal2-textarea" placeholder="Mô tả ..."></textarea>
    </div>`,
                    focusConfirm: false,
                    preConfirm: () => {
                        return {
                            inputText: document.getElementById('input-text').value,
                            textareaText: document.getElementById('textarea-text').value
                        }
                    },
                    showCancelButton: true,
                    customClass: {
                        input: 'swal2-input-custom',
                        textarea: 'swal2-textarea-custom'
                    }
                })

                if (inputText && textareaText) {
                    $.ajax({
                        url: "booking/add-issue.php",
                        method: "POST",
                        data: {
                            id: id,
                            inputText: inputText,
                            textareaText: textareaText
                        },
                        success: function (response) {
                            if (response.key) {
                                Swal.fire(response.message, "", "success");
                            } else {
                                Swal.fire(response.message, "", "error");
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log(xhr.responseText);
                            console.log(status);
                            console.log(error);
                            Swal.fire("Lỗi trong quá trình xử lý dữ liệu!", "", "error");
                        }
                    });
                }
            }

        </script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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