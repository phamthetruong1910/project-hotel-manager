<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>TMS | Hệ Thống Đặt Phòng Khách sạn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

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
    <!--//end-animate-->
    <style>
        .ul-container {
            display: flex;
        }

        .ul-container ul {
            display: inline-block;
            padding: 0;
            list-style-type: none;
            margin: 10px 10px 0 0;
        }

        .text-container {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body>
<?php include('includes/header.php'); ?>
<div class="banner">
    <div class="container">
        <h1 class="wow zoomIn animated animated" data-wow-delay=".5s"
            style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">NKN - HỆ THỐNG ĐẶT PHÒNG KHÁCH
            SẠN</h1>
    </div>
</div>


<!--- rupes ---->
<div class="container" style="padding-bottom: 2em">
    <div class="rupes" style="border-bottom: none">
        <div class="col-md-4 rupes-left wow fadeInDown animated animated" data-wow-delay=".5s"
             style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">
            <div class="rup-left">
                <a href="offers.html"><i class="fa fa-usd"></i></a>
            </div>
            <div class="rup-rgt">
                <h3>GIẢM GIÁ 10%</h3>
                <h4><a href="offers.html">DU LỊCH THÔNG MINH</a></h4>

            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-4 rupes-left wow fadeInDown animated animated" data-wow-delay=".5s"
             style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">
            <div class="rup-left">
                <a href="offers.html"><i class="fa fa-h-square"></i></a>
            </div>
            <div class="rup-rgt">
                <h3>GIẢM TỚI 70%</h3>
                <h4><a href="offers.html">KHÁCH SẠN TOÀN THẾ GIỚI</a></h4>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-4 rupes-left wow fadeInDown animated animated" data-wow-delay=".5s"
             style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">
            <div class="rup-left">
                <a href="offers.html"><i class="fa fa-mobile"></i></a>
            </div>
            <div class="rup-rgt">
                <h3>GIẢM 20% </h3>
                <h4><a href="offers.html">KHI ĐẶT QUA APP</a></h4>

            </div>
            <div class="clearfix"></div>
        </div>

    </div>
</div>
<!--- /rupes ---->


<!---holiday---->
<div class="container">
    <div class="roomHotel">
        <div class="row">
            <div class="col-md-12 wow fadeInLeft animated">
                <h2><b>ĐIỂM ĐẾN HOT NHẤT</b></h2>
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
                                                    <?php } else { ?>
                                                        <img src="admins/images/pngtree-now-booking-business-text-background-png-image_691369.jpeg"
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
                                                    <?php } else { ?>
                                                        <img src="admins/images/pngtree-now-booking-business-text-background-png-image_691369.jpeg"
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
                                                    <?php } else { ?>
                                                        <img src="admins/images/pngtree-now-booking-business-text-background-png-image_691369.jpeg"
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

    <div class="holiday" style="padding: 0">
        <h3 style="color: black">KHÁCH SẠN, RESORT MỚI</h3>

        <div class="row">
            <div class="col-md-3">
                <div class="rom-btm">
                    <img src="admins/images/1000_F_206433847_U0OxpYNkDZn3On8YChiCOu5ER3E6Am9V.jpg" width="100%"
                         height="100%" alt="">
                </div>
                <div class="rom-btm">
                    <img src="admins/images/FWKCLM-XoAIDx_l.jpg" width="100%" height="100%" alt="">
                </div>
            </div>
            <div class="col-md-9">
                <?php
                $sql = "SELECT * from hotels where status = 'ENABLE' order by createdAt desc limit 3";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) { ?>
                        <div class="rom-btm">
                            <?php
                            $sqlImages = "SELECT * from images where code = 'HOTEL' AND objectId=:objectId limit 1";
                            $queryImages = $dbh->prepare($sqlImages);
                            $queryImages->bindParam(':objectId', $result->id, PDO::PARAM_STR);
                            $queryImages->execute();
                            $imagesTitle = $queryImages->fetch(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($imagesTitle) {
                                ?>
                                <div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s"
                                     style="padding: 10px">
                                    <a href="admins/images/products/<?php echo $imagesTitle->name ?>"
                                       data-lightbox="example">
                                        <img src="admins/images/products/<?php echo $imagesTitle->name ?>"
                                             class="img-thumbnail" alt="">
                                    </a>
                                </div>
                            <?php } else { ?>
                                <div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s"
                                     style="padding: 10px">
                                    <a href="admins/images/pngtree-now-booking-business-text-background-png-image_691369.jpeg"
                                       data-lightbox="example">
                                        <img src="admins/images/pngtree-now-booking-business-text-background-png-image_691369.jpeg"
                                             class="img-thumbnail" alt="">
                                    </a>
                                </div>
                                    <?php } ?>
                            <div class="col-md-5 room-midle wow fadeInUp animated" data-wow-delay=".5s">
                                <h4 class="text-container"><i class="fas fa-hotel"
                                                              style="font-size: 20px">&nbsp;</i> <?php echo htmlentities($result->name); ?>
                                </h4>
                                <h6 class="text-container"><i
                                            class="fas fa-sharp fa-light fa-arrow-right">&nbsp;</i><?php echo htmlentities($result->type); ?>
                                </h6>
                                <p class="text-container"><i class="fa fa-map-marker"
                                                             style="font-size: 1em;"></i> <?php echo htmlentities($result->location); ?>
                                </p>
                                <div class="star-ratings" style="font-size: 2em;">
                                    <?php
                                    $num_stars = intval($result->ranking);
                                    for ($i = 0; $i < $num_stars; $i++) {
                                        echo '<span class="star" style="color: gold">&#9733;</span>';
                                    }
                                    for ($i = $num_stars; $i < 5; $i++) {
                                        echo '<span class="star" style="color: gold">&#9734;</span>';
                                    }
                                    echo '&nbsp;<span style="font-size: 27px;text-align: center"><b>' . $num_stars . '</b></span>'
                                    ?>
                                </div>
                                <div class="ul-container">
                                    <?php
                                    $sqlRateHotel = "SELECT * FROM ratehotels WHERE hotelId=:hotelId AND status = 'ENABLE'";
                                    $queryRateHotel = $dbh->prepare($sqlRateHotel);
                                    $queryRateHotel->bindParam(':hotelId', $result->id, PDO::PARAM_INT);
                                    $queryRateHotel->execute();
                                    $rateHotels = $queryRateHotel->fetchAll();
                                    $totalRated = $queryRateHotel->rowCount();

                                    $numberFiveStarRated = 0;
                                    foreach ($rateHotels as $rate) {
                                        if ($rate['rate'] === '5') {
                                            $numberFiveStarRated++;
                                        }
                                    }

                                    $rating = ($totalRated !== 0) ? round(($numberFiveStarRated / $totalRated) * 10) : 0;
                                    ?>
                                    <ul>
                                        <li><i class="fab fa-twitter" style="color: #00a0dc;"></i> &nbsp;<b style="font-size: 15px; color: #00A6C7">Ấn tượng - <?php echo $rating ?>/10 <b style="color: black;">(<?php echo $totalRated ?>)</b></b></li>
                                    </ul>
                                </div>

                            </div>
                            <div class="col-md-4 room-right wow fadeInRight animated" data-wow-delay=".5s">
                                <?php
                                $sqlPrice = "SELECT min(price) as min_price FROM roomtype WHERE hotelId=:hotelId AND status = 'ENABLE'";
                                $queryPrice = $dbh->prepare($sqlPrice);
                                $queryPrice->bindParam(':hotelId', $result->id, PDO::PARAM_INT);
                                $queryPrice->execute();
                                $price = $queryPrice->fetch();
                                ?>
                                <div class="grand">
                                    <h6><b>Giá chỉ từ: </b></h6>
                                    <h3 style="color: red"><?php echo number_format($price['min_price'], 0, ',', '.') . ' VNĐ' ?></h3>
                                    <p style="margin: 0">/Phòng/Đêm</p>
                                </div>
                                <a href="package-details.php?pkgid=<?php echo htmlentities($result->id); ?>"
                                   class="view">Chi Tiết</a>
                            </div>

                            <div class="col-md-3 wow fadeInLeft animated" data-wow-delay=".5s"
                                 style="display: flex; flex-wrap: nowrap; padding-bottom: 10px;">
                                <?php
                                $sqlImagesSub = "SELECT * from images where code = 'HOTEL' AND objectId=:objectId limit 4";
                                $queryImagesSub = $dbh->prepare($sqlImagesSub);
                                $queryImagesSub->bindParam(':objectId', $result->id, PDO::PARAM_STR);
                                $queryImagesSub->execute();
                                $imagesTitleSubs = $queryImagesSub->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($queryImagesSub->rowCount() > 0) {
                                    foreach ($imagesTitleSubs as $imagesTitleSub) {
                                        ?>
                                        <a href="admins/images/products/<?php echo $imagesTitleSub->name ?>"
                                           data-lightbox="example" style="<?php if ($queryImagesSub->rowCount() === 1) {
                                            echo 'max-width: 40%';
                                        } else {
                                            echo '';
                                        } ?>">
                                            <img src="admins/images/products/<?php echo $imagesTitleSub->name ?>"
                                                 class="img-thumbnail" alt="">
                                        </a>
                                    <?php }
                                } ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    <?php }
                } ?>
                <div>
                    <a href="package-list.php" class="view" style="float: right">Xem Chi Tiết</a>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="roomHotel" style="padding: 5em 0 5em 0">
        <div class="banner-dashboard container-fluid px-1 py-5 mx-auto   justify-content-center wow fadeInUp animated">
            <div class="card pl-4 pl-md-5 pr-3" style="padding: 20px">
                <div class="row">
                    <div class="left-side col-md-6">
                        <p class="pt-5 mb-0">
                            Chuẩn 6 sao <i style="color: gold">* * * * * *</i>
                        </p>
                        <h3 class="pb-3" style="padding-bottom: 5px">Giá phòng mùa lễ đang tăng nhanh, giật ngay giá
                            tốt! </h3>
                        <a href="package-list.php" class="btn btn-pink">Chi tiết</a>
                    </div>
                    <div class="right-side col-md-6">
                        <img class="shoe-img pl-5 pl-md-0"
                             src="admins/images/depositphotos_81012980-stock-illustration-colorful-flat-vector-travel-banner.jpg">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="roomHotel">
        <div class="row">
            <div class="col-md-12 wow fadeInLeft animated">
                <h2><b>TOP KHÁCH SẠN, RESORT CHUẨN 5 SAO</b></h2>
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
                                                    <?php } else { ?>
                                                        <img src="admins/images/pngtree-now-booking-business-text-background-png-image_691369.jpeg"
                                                             class="img-fluid" alt="">
                                                            <?php } ?>
                                                </div>
                                                <div class="thumb-content">
                                                    <h4 class="text-container"><b><?php echo $result->name ?></b></h4>
                                                    <p class="text-container"><span><?php echo $result->type ?></span>
                                                    </p>
                                                    <p class="text-container">
                                                        <span><?php echo $result->location ?></span></p>
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
                                                    <?php } else { ?>
                                                        <img src="admins/images/pngtree-now-booking-business-text-background-png-image_691369.jpeg"
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
                                                    <?php } else { ?>
                                                        <img src="admins/images/pngtree-now-booking-business-text-background-png-image_691369.jpeg"
                                                             class="img-fluid" alt="">
                                                            <?php } ?>
                                                </div>
                                                <div class="thumb-content">
                                                    <h4><?php echo $result->name ?></h4>
                                                    <p class="item-price"><span><?php echo $result->type ?></span></p>
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
    <div class="roomHotel" style="padding: 5em 0 5em 0">
        <div class="banner-dashboard container-fluid px-1 py-5 mx-auto   justify-content-center wow fadeInUp animated">
            <div class="card pl-4 pl-md-5 pr-3" style="padding: 20px">
                <div class="row">
                    <div class="left-side col-md-6">
                        <p class="pt-5 mb-0">
                            Chuẩn 6 sao <i style="color: gold">* * * * * *</i>
                        </p>
                        <h3 class="pb-3" style="padding-bottom: 5px">Giá phòng mùa lễ đang tăng nhanh, giật ngay giá
                            tốt! </h3>
                        <a href="package-list.php" class="btn btn-pink">Chi tiết</a>
                    </div>
                    <div class="right-side col-md-6">
                        <img class="shoe-img pl-5 pl-md-0" src="admins/images/images.jpg">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="roomHotel">
        <div class="row">
            <div class="col-md-12 wow fadeInLeft animated">
                <h2><b>ĐIỂM ĐẾN ẤN TƯỢNG NHẤT</b></h2>
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
                                                    <?php } else { ?>
                                                        <img src="admins/images/pngtree-now-booking-business-text-background-png-image_691369.jpeg"
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
                                                    <?php } else { ?>
                                                        <img src="admins/images/pngtree-now-booking-business-text-background-png-image_691369.jpeg"
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
                                                    <?php } else { ?>
                                                        <img src="admins/images/pngtree-now-booking-business-text-background-png-image_691369.jpeg"
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
</div>


<!--- routes ---->
<div class="routes">
    <div class="container">
        <div class="col-md-4 routes-left wow fadeInRight animated" data-wow-delay=".5s">
            <div class="rou-left">
                <a href="#"><i class="glyphicon glyphicon-list-alt"></i></a>
            </div>
            <div class="rou-rgt wow fadeInDown animated" data-wow-delay=".5s">
                <h3>80000</h3>
                <p>ĐẶT YÊU CẦU</p>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-4 routes-left">
            <div class="rou-left">
                <a href="#"><i class="fa fa-user"></i></a>
            </div>
            <div class="rou-rgt">
                <h3>1900</h3>
                <p>NGƯỜI ĐÃ ĐĂNG KÝ</p>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-4 routes-left wow fadeInRight animated" data-wow-delay=".5s">
            <div class="rou-left">
                <a href="#"><i class="fa fa-ticket"></i></a>
            </div>
            <div class="rou-rgt">
                <h3>7,00,00,000+</h3>
                <p>Booking</p>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<script>
    new WOW().init();

    // Khởi tạo Lightbox
    window.lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true
    })

    $(document).ready(function () {
        // tự động chuyển đổi carousel mỗi 3 giây
        $('#myCarousel').carousel({
            interval: 5000
        });

        // cập nhật active class cho indicators
        var slideIndex = 0;
        $('.carousel-indicators li').each(function () {
            $(this).attr('data-slide-to', slideIndex);
            slideIndex++;
        });

        // cập nhật active class cho indicators khi carousel được chuyển đổi
        $('#myCarousel').on('slide.bs.carousel', function () {
            var currentIndex = $('div.active').index() + 1;
            $('.carousel-indicators li').removeClass('active');
            $('.carousel-indicators li:nth-child(' + currentIndex + ')').addClass('active');
        });
    });

    $(document).ready(function () {
        // tự động chuyển đổi carousel mỗi 3 giây
        $('#myCarousel1').carousel({
            interval: 6000
        });

        // cập nhật active class cho indicators
        var slideIndex = $('.carousel-indicators li').length - 1; // đảo ngược thứ tự indicators
        $('.carousel-indicators li').each(function () {
            $(this).attr('data-slide-to', slideIndex);
            slideIndex--;
        });

        // cập nhật active class cho indicators khi carousel được chuyển đổi
        $('#myCarousel1').on('slide.bs.carousel', function () {
            var currentIndex = $('div.active').index() - ($('.carousel-item').length - 1); // đảo ngược chỉ số slide
            $('.carousel-indicators li').removeClass('active');
            $('.carousel-indicators li:nth-child(' + currentIndex + ')').addClass('active');
        });
    });

    const textContainers = document.querySelectorAll('.text-ellipsis');

    textContainers.forEach(textContainer => {
        const text = textContainer.innerText;

        if (text.length > 200) {
            const shortenedText = text.slice(0, 200) + '...';
            textContainer.innerText = shortenedText;
        }
    });


</script>
<?php include('includes/footer.php'); ?>
<!-- signup -->
<?php include('includes/signup.php'); ?>
<!-- //signu -->
<!-- signin -->
<?php include('includes/signin.php'); ?>
<!-- //signin -->
<!-- write us -->
<?php include('includes/write-us.php'); ?>
<!-- //write us -->
</body>
</html>