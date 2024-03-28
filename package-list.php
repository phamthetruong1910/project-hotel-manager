<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Danh sách</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!--animate-->
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();

    </script>
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

    </style>
</head>
<body>
<?php include('includes/header.php'); ?>
<!--- banner ---->
<div class="banner-3">
    <div class="container">
        <h1 class="wow zoomIn animated animated" data-wow-delay=".5s"
            style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"> Danh sách</h1>
    </div>
</div>
<!--- /banner ---->
<!--- rooms ---->
<div class="rooms">
    <div class="container">
        <div class="room-bottom">
            <div class="row" style="padding-bottom: 20px">
                <div class="rom-btm">
                    <div class="banner-dashboard container-fluid px-1 py-5 mx-auto   justify-content-center wow fadeInUp animated">
                            <div class="row">
                                <img src="admins/images/illustration-of-travel-using-as-business-web-template-agency-free-vector.webp" width="100%" height="400px" alt="">
                            </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <h3>Tìm Kiếm</h3>
                    <div class="rom-btm">
                        <div class="form-group room-right wow fadeInRight animated" data-wow-delay=".5s">
                            <form  method="post" onsubmit="getSearchResult(event)" action="" id="myForm">
                                <button type="submit" class="view form-control" style="width: 100%; text-align: center;font-weight: 700;margin-bottom: 10px;background-color: #34ad00;color: white" value="search">Tìm khách sạn</button>
                                <input type="button" class="view form-control" style="width: 100%; text-align: center; font-weight: 700; margin-bottom: 10px; background-color: #ad3434; color: white" value="Đặt lại" onclick="resetForm()">

                                <input type="text" name="searchName" id="name" class="form-control" style="margin-bottom: 10px"
                                       placeholder="Tên khách sạn">
                                <select class="form-control show-tick" name="price" id="price"
                                        style="margin-bottom: 10px">
                                    <option value="" selected disabled>Giá thành</option>
                                    <option style="color: black" value="max">Giá cao nhất</option>
                                    <option style="color: black" value="min">Giá thấp nhất</option>
                                </select>
                                <input type="number" name="ranking" id="ranking" class="form-control" style="margin-bottom: 10px" min="0"
                                       placeholder="Hạng sao">
                                <select class="form-control show-tick" name="type" id="type"
                                        style="margin-bottom: 10px">
                                    <option value="" selected disabled>Loại hình</option>
                                    <option style="color: black" value="Khách sạn">Khách sạn</option>
                                    <option style="color: black" value="Resort">Resort</option>
                                </select>
                                <select class="form-control show-tick" name="district" id="district"
                                        style="margin-bottom: 10px">
                                    <option value="" selected disabled>Khu vực</option>
                                    <option value="Quận Hải Châu">Quận Hải Châu</option>
                                    <option value="Quận Thanh Khê">Quận Thanh Khê</option>
                                    <option value="Quận Sơn Trà">Quận Sơn Trà</option>
                                    <option value="Quận Ngũ Hành Sơn">Quận Ngũ Hành Sơn</option>
                                    <option value="Quận Liên Chiểu">Quận Liên Chiểu</option>
                                    <option value="Quận Cẩm Lệ">Quận Cẩm Lệ</option>
                                    <option value="Huyện Hòa Vang">Huyện Hòa Vang</option>
                                </select>
<!--                                --><?php
//                                $sqlCon = "SELECT * from convenient where status != 'DELETED'";
//                                $queryCon = $dbh->prepare($sqlCon);
//                                $queryCon->execute();
//                                $cons = $queryCon->fetchAll(PDO::FETCH_OBJ);
//                                if ($queryCon->rowCount() > 0) {
//                                    foreach ($cons as $value) {
//                                        ?>
<!--                                        <div class="form-control" style="display: inline-block;font-size: 10px; border: 0;margin-bottom: 10px">-->
<!--                                            <input type="checkbox" id="md_checkbox_21"-->
<!--                                                   name="convenient--><?php //echo $value->id ?><!--"-->
<!--                                                   class="filled-in chk-col-green"-->
<!--                                                   value="--><?php //echo $value->id ?><!--" style="height: 14px;width: 14px;font-size: 10px; float: left;margin-right: 10px "/>-->
<!--                                            <label for="md_checkbox_21" style="display: flex; font-size: 14px">--><?php //echo $value->name ?><!--</label>-->
<!--                                        </div>-->
<!--                                        --><?php
//                                    }
//                                }
//                                ?>
                                <div class="demo-checkbox">
                                    <div class="form-control"
                                         style="display: inline-block;font-size: 10px; border: 0;margin-bottom: 10px">

                                        <input type="checkbox" id="md_checkbox_21" name="convenient[]" style="height: 14px;width: 14px;font-size: 10px; float: left;margin-right: 10px "
                                               class="filled-in chk-col-red"  value="Máy lạnh"/>
                                        <label for="md_checkbox_21" style="display: flex; font-size: 14px">Máy lạnh</label>
                                    </div>
                                    <div class="form-control"
                                         style="display: inline-block;font-size: 10px; border: 0;margin-bottom: 10px">

                                        <input type="checkbox" id="md_checkbox_22" name="convenient[]" style="height: 14px;width: 14px;font-size: 10px; float: left;margin-right: 10px "
                                               class="filled-in chk-col-pink"  value="Nhà hàng"/>
                                        <label for="md_checkbox_22" style="display: flex; font-size: 14px">Nhà hàng</label>
                                    </div>
                                    <div class="form-control"
                                         style="display: inline-block;font-size: 10px; border: 0;margin-bottom: 10px">

                                        <input type="checkbox" id="md_checkbox_23" name="convenient[]" style="height: 14px;width: 14px;font-size: 10px; float: left;margin-right: 10px "
                                               class="filled-in chk-col-purple"  value="Hồ bơi"/>
                                        <label for="md_checkbox_23" style="display: flex; font-size: 14px">Hồ bơi</label>
                                    </div>
                                    <div class="form-control"
                                         style="display: inline-block;font-size: 10px; border: 0;margin-bottom: 10px">

                                        <input type="checkbox" id="md_checkbox_24" name="convenient[]" style="height: 14px;width: 14px;font-size: 10px; float: left;margin-right: 10px "
                                               class="filled-in chk-col-deep-purple"  value="Lễ tân 24h"/>
                                        <label for="md_checkbox_24" style="display: flex; font-size: 14px">Lễ tân 24h</label>
                                    </div>
                                    <div class="form-control"
                                         style="display: inline-block;font-size: 10px; border: 0;margin-bottom: 10px">

                                        <input type="checkbox" id="md_checkbox_25" name="convenient[]" style="height: 14px;width: 14px;font-size: 10px; float: left;margin-right: 10px "
                                               class="filled-in chk-col-indigo"  value="Chỗ đậu xe"/>
                                        <label for="md_checkbox_25" style="display: flex; font-size: 14px">Chỗ đậu xe</label>
                                    </div>
                                    <div class="form-control"
                                         style="display: inline-block;font-size: 10px; border: 0;margin-bottom: 10px">

                                        <input type="checkbox" id="md_checkbox_26" name="convenient[]" style="height: 14px;width: 14px;font-size: 10px; float: left;margin-right: 10px "
                                               class="filled-in chk-col-blue"  value="Thang máy"/>
                                        <label for="md_checkbox_26" style="display: flex; font-size: 14px">Thang máy</label>
                                    </div>
                                    <div class="form-control"
                                         style="display: inline-block;font-size: 10px; border: 0;margin-bottom: 10px">

                                        <input type="checkbox" id="md_checkbox_27" name="convenient[]" style="height: 14px;width: 14px;font-size: 10px; float: left;margin-right: 10px "
                                               class="filled-in chk-col-light-blue"  value="Wifi"/>
                                        <label for="md_checkbox_27" style="display: flex; font-size: 14px">Wifi</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="rom-btm">
                        <img src="admins/images/images%20(1).jpg" width="100%"
                             height="100%" alt="">
                    </div>
                    <div class="rom-btm">
                        <img src="admins/images/pngtree-travel-time-vertical-banner-poster-png-image_7709149.png" width="100%" height="100%" alt="">
                    </div>
                    <div class="rom-btm">
                        <img src="admins/images/travel-destination-concept-with-buildings-vertical-banner-vector.jpg" width="100%"
                             height="100%" alt="">
                    </div>
                </div>
                <div class="col-md-9">
                    <h3>Danh sách</h3>

                    <div class="display-search" id="table-body">
                        <?php
                        $sql = "SELECT * from hotels where status = 'ENABLE' order by createdAt desc";
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
                                    $queryImages->bindParam(':objectId',$result->id,PDO::PARAM_STR);
                                    $queryImages->execute();
                                    $imagesTitle = $queryImages->fetch(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($imagesTitle->name) {
                                        ?>
                                        <div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s" style="padding: 10px">
                                            <a href="admins/images/products/<?php echo $imagesTitle->name ?>" data-lightbox="example">
                                                <img src="admins/images/products/<?php echo $imagesTitle->name ?>"
                                                     class="img-thumbnail" alt="">
                                            </a>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s" style="padding: 10px">
                                            <a href="admins/images/pngtree-now-booking-business-text-background-png-image_691369.jpeg" data-lightbox="example">
                                                <img src="admins/images/pngtree-now-booking-business-text-background-png-image_691369.jpeg"
                                                     class="img-thumbnail" alt="">
                                            </a>
                                        </div>
                                            <?php } ?>
                                    <div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">
                                        <h4><i class="fas fa-hotel" style="font-size: 20px">&nbsp;</i><?php echo htmlentities($result->name); ?></h4>
                                        <h6><?php echo htmlentities($result->type); ?></h6>
                                        <p><i class="fa fa-map-marker" style="font-size: 1em;">&nbsp;</i><?php echo htmlentities($result->location); ?></p>
                                        <div class="star-rating">
                                            <ul class="list-inline">
                                                <?php
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if ($i > $result->ranking) {
                                                        ?>
                                                        <li style="color: gold" class="list-inline-item"><i
                                                                    class="far fa-star"></i>
                                                        </li>
                                                    <?php } else { ?>
                                                        <li style="color: gold" class="list-inline-item"><i
                                                                    class="fa fa-star"></i></li>

                                                    <?php }
                                                } ?>
                                            </ul>
                                        </div>
                                        <div class="ul-container">
                                            <?php
                                            $Convenient = $result->convenient;
                                            if (isset($Convenient)) {
                                                $resultsConvenient = explode(' - ', $Convenient);
                                                $n = 4;
                                                $numResults = count($resultsConvenient);
                                                for ($i = 0; $i < $numResults; $i += $n) {
                                                    echo '<ul>';
                                                    for ($j = $i; $j < min($i + $n, $numResults); $j++) {
                                                        echo '<li> <i class="fas fa-angle-double-right" style="color: #00a0dc;"></i> &nbsp;<b style="font-size: 12px">' . $resultsConvenient[$j] . '</b></li>';
                                                    }
                                                    echo '</ul>';
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3 room-right wow fadeInRight animated" data-wow-delay=".5s">
                                        <?php
                                        $sqlPrice = "SELECT min(price) as min_price FROM roomtype WHERE hotelId=:hotelId AND status = 'ENABLE'";
                                        $queryPrice = $dbh->prepare($sqlPrice);
                                        $queryPrice->bindParam(':hotelId', $result->id, PDO::PARAM_INT);
                                        $queryPrice->execute();
                                        $price = $queryPrice->fetch();
                                        ?>
                                        <div class="grand">
                                            <h6><b>Giá chỉ từ: </b></h6>
                                            <h3 style="color: red"><?php echo number_format($price['min_price'], 0, ',', '.') . ' ' ?></h3>
                                            <p style="margin: 0">VND/Phòng/Đêm</p>
                                        </div>
                                        <a href="package-details.php?pkgid=<?php echo htmlentities($result->id); ?>"
                                           class="view">Chi Tiết</a>
                                    </div>

                                    <br>
                                    <div class="clearfix"></div>
                                </div>

                            <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--- /rooms ---->
<script>
    function resetForm() {
        document.getElementById("myForm").reset();
        getSearchResult(event);
    }

    function getSearchResult (event) {
        event.preventDefault();
        var searchName = $('#name').val();
        var ranking = $('#ranking').val();
        var type = $('#type').val();
        var price = $('#price').val();
        var convenient = document.getElementsByName('convenient[]');
        var conveniences = [];
        var district = $('#district').val();

        for (var i = 0; i < convenient.length; i++) {
            if (convenient[i].checked) {
                console.log(convenient[i].value)
                conveniences.push(convenient[i].value);
            }
        }
        $.ajax({
            type: 'POST',
            url: 'search-list.php',
            data: {
                searchName: searchName,
                ranking: ranking,
                type: type,
                conveniences: conveniences,
                price: price,
                district: district
            },
            success: function(data) {
                $('#table-body').html("");
                var hotels = data.hotels;

                if (hotels.length === 0) {
                    var html = '<div class="text-center rom-btm"><h3 style="color: black">Không tìm thấy dữ liệu</h3></div>';
                    $('#table-body').html(html);
                } else {
                    $.each(hotels, function(index, hotel) {
                        var price = hotel.price;
                        var formatter = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' });
                        var parts = formatter.formatToParts(price);
                        var formattedPrice = "";
                        for (var i = 0; i < parts.length; i++) {
                            if (parts[i].type !== "currency") {
                                formattedPrice += parts[i].value;
                            }
                        }

                        var html = '<div class="rom-btm">';
                        if (hotel.image) {
                            html += '<div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s" style="padding: 10px">';
                            html += '<a href="' + hotel.image + '" data-lightbox="example">';
                            html += '<img src="' + hotel.image + '" class="img-thumbnail" alt=""></a></div>';
                        } else {
                            html += '<div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s" style="padding: 10px">';
                            html += '<a href="admins/images/pngtree-now-booking-business-text-background-png-image_691369.jpeg" data-lightbox="example">';
                            html += '<img src="admins/images/pngtree-now-booking-business-text-background-png-image_691369.jpeg" class="img-thumbnail" alt="">';
                            html += '</a></div>';
                        }
                        html += '<div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">';
                        html += '<h4><i class="fas fa-hotel" style="font-size: 20px">&nbsp;</i>' + hotel.name + '</h4>';
                        html += '<h6>' + hotel.type + '</h6>';
                        html += '<p><i class="fa fa-map-marker" style="font-size: 1em;">&nbsp;</i>' + hotel.location + '</p>';
                        html += '<div class="star-rating"><ul class="list-inline">';
                        for (let i = 1; i <= 5; i++) {
                            if (i > hotel.ranking) {
                                html += '<li style="color: gold" class="list-inline-item"><i class="far fa-star"></i></li>';
                            } else {
                                html += '<li style="color: gold" class="list-inline-item"><i class="fa fa-star"></i></li>';
                            }
                        }
                        html += '</ul></div>';
                        html += '<div class="ul-container">';
                        $.each(hotel.convenient, function(index, convenientGroup) {
                            html += '<ul>';
                            $.each(convenientGroup, function(index, convenient) {
                                html += '<li> <i class="fas fa-angle-double-right" style="color: #00a0dc;"></i> &nbsp;<b style="font-size: 12px">' + convenient + '</b></li>';
                            });
                            html += '</ul>';
                        });
                        html += '</div></div>';
                        html += '<div class="col-md-3 room-right wow fadeInRight animated" data-wow-delay=".5s">';
                        html += '<div class="grand"> <h6><b>Giá chỉ từ: </b></h6>'
                        html += '<h3 style="color: red">' + formattedPrice + '</h3>'
                        html += '<p style="margin: 0">VND/Phòng/Đêm</p></div>'
                        html += '<a href="package-details.php?pkgid=' + hotel.id + '" class="view">Chi Tiết</a></div>';
                        html += '<br><div class="clearfix"></div></div>';
                        $('#table-body').append(html);
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseText); // Log the error response from the server
            }

        });
    }

</script>
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
<!-- //write us -->
</body>
</html>