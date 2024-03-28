<?php
session_start();
include('config.php');

if (empty($_SESSION['alogin'])) {
    header("Location: authentication/login.php");
}
?>
<!DOCTYPE html>
<html>
<?php
include('structure/header.php');
include ('structure/menu.php');

?>

<body class="theme-red">
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
            </h2>
        </div>
        <!-- Counter Examples -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <div class="icon bg-red">
                        <i class="material-icons">shopping_cart</i>
                    </div>
                    <div class="content">
                        <div class="text">HÓA ĐƠN</div>
                        <?php
                        $sqlInvoice = "SELECT * FROM invoice WHERE status != 'DELETED'";
                        $queryInvoice = $dbh->prepare($sqlInvoice);
                        $queryInvoice->execute();
                        $invoice = $queryInvoice->rowCount();
                        ?>
                        <div class="number count-to" data-from="0" data-to="<?php echo $invoice ?>" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <div class="icon bg-indigo">
                        <i class="material-icons">face</i>
                    </div>
                    <div class="content">
                        <div class="text">KHÁCH HÀNG</div>
                        <?php
                        $sqlUser = "SELECT * FROM users WHERE status != 'DELETED'";
                        $queryUser= $dbh->prepare($sqlUser);
                        $queryUser->execute();
                        $user = $queryUser->rowCount();
                        ?>
                        <div class="number count-to" data-from="0" data-to="<?php echo $user ?>" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <div class="icon bg-purple">
                        <i class="material-icons">bookmark</i>
                    </div>
                    <div class="content">
                        <div class="text">ĐÁNH GIÁ</div>
                        <?php
                        $sqlRate = "SELECT * FROM ratehotels WHERE status != 'DELETED'";
                        $queryRate= $dbh->prepare($sqlRate);
                        $queryRate->execute();
                        $rate = $queryRate->rowCount();
                        ?>
                        <div class="number count-to" data-from="0" data-to="<?php echo $rate ?>" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <div class="icon bg-deep-purple">
                        <i class="material-icons">favorite</i>
                    </div>
                    <div class="content">
                        <?php
                        $sqlHotel = "SELECT * FROM hotels WHERE status != 'DELETED'";
                        $queryHotels= $dbh->prepare($sqlHotel);
                        $queryHotels->execute();
                        $sumHotel = $queryHotels->rowCount();
                        ?>
                        <div class="text">KHÁCH SẠN</div>
                        <div class="number count-to" data-from="0" data-to="<?php echo $sumHotel ?>" data-speed="1500" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Counter Examples -->
        <!-- Hover Zoom Effect -->
        <div class="block-header">
            </div>
        <div class="row clearfix">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box hover-expand-effect">
                <div class="icon bg-teal">
                    <i class="material-icons">equalizer</i>
                </div>
                <div class="content">
                    <?php

                    $sqlInvoiceToTalCount = "SELECT * FROM invoice WHERE status != 'DELETED'";
                    $queryInvoiceToTalCount = $dbh->prepare($sqlInvoiceToTalCount);
                    $queryInvoiceToTalCount->execute();

                    $userInvoiceToTalCount = $queryInvoiceToTalCount->rowCount();
                    ?>
                    <div class="text">TỔNG HÓA ĐƠN</div>
                    <div class="number"><?php echo $userInvoiceToTalCount; ?></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box hover-expand-effect">
                <div class="icon bg-green">
                    <i class="material-icons">equalizer</i>
                </div>
                <div class="content">
                    <?php
                    $sqlInvoicePriceTotal = "SELECT SUM(price) as price FROM invoice WHERE status != 'DELETED'";
                    $queryInvoicePriceTotal = $dbh->prepare($sqlInvoicePriceTotal);
                    $queryInvoicePriceTotal->execute();

                    $userInvoicePriceTotal = $queryInvoicePriceTotal->fetch();

                    ?>
                    <div class="text">TỔNG DOANH THU</div>
                    <div class="number"><?php echo number_format($userInvoicePriceTotal['price'], 0, ',', '.') . ' VND'; ?></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box hover-expand-effect">
                <div class="icon bg-light-green">
                    <i class="material-icons">equalizer</i>
                </div>
                <div class="content">
                    <?php
                    $sqlIssue = "SELECT * FROM issues WHERE status != 'DELETED'";
                    $queryIssue = $dbh->prepare($sqlIssue);
                    $queryIssue->execute();

                    $userIssue = $queryIssue->rowCount();

                    ?>
                    <div class="text">TỔNG YỀU CẦU</div>
                    <div class="number"><?php echo $userIssue; ?></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box hover-expand-effect">
                <div class="icon bg-lime">
                    <i class="material-icons">equalizer</i>
                </div>
                <div class="content">
                    <?php
                    $sqlRates = "SELECT * FROM ratehotels WHERE status != 'DELETED'";
                    $queryRates = $dbh->prepare($sqlRates);
                    $queryRates->execute();

                    $userRates = $queryRates->rowCount();

                    ?>
                    <div class="text">TỔNG ĐÁNH GIÁ</div>
                    <div class="number"><?php echo $userRates; ?></div>
                </div>
            </div>
        </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box-3 bg-purple">
                    <div class="icon">
                        <i class="material-icons">bookmark</i>
                    </div>
                    <div class="content">
                        <?php
                        $dateTimeNowDate = date("Y-m-d");

                        $sqlInvoiceToday = "SELECT * FROM invoice WHERE status != 'DELETED' AND DATE(createdAt) = :createdAt";
                        $queryInvoiceToday = $dbh->prepare($sqlInvoiceToday);
                        $queryInvoiceToday->bindParam(':createdAt', $dateTimeNowDate);
                        $queryInvoiceToday->execute();

                        $userInvoiceToday = $queryInvoiceToday->rowCount();
                        ?>
                        <div class="text">HÓA ĐƠN MỚI HÔM NAY </div>
                        <div class="number count-to" data-from="0" data-to="<?php echo $userInvoiceToday ?>" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box-3 bg-amber">
                    <div class="icon">
                    </div>
                    <div class="content">
                        <?php

                        $dateTimeNowDate = date("Y-m-d");

                        $sqlInvoiceTodayPrice = "SELECT SUM(price) as price FROM invoice WHERE status != 'DELETED' AND DATE(createdAt) = :createdAt";
                        $queryInvoiceTodayPrice = $dbh->prepare($sqlInvoiceTodayPrice);
                        $queryInvoiceTodayPrice->bindParam(':createdAt', $dateTimeNowDate);
                        $queryInvoiceTodayPrice->execute();

                        $userInvoiceTodayPRice = $queryInvoiceTodayPrice->fetch();

                        ?>
                        <div class="text">DOANH THU HÔM NAY</div>
                        <div class="number"><?php echo number_format($userInvoiceTodayPRice['price'], 0, ',', '.') . ' VND'; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box-3 bg-indigo">
                    <div class="icon">
                        <i class="material-icons">face</i>
                    </div>
                    <div class="content">
                        <?php
                        $dateTimeNowDate = date("Y-m-d");

                        $sqlUserToday = "SELECT * FROM users WHERE status != 'DELETED' AND DATE(createdAt) = :createdAt";
                        $queryUserToday = $dbh->prepare($sqlUserToday);
                        $queryUserToday->bindParam(':createdAt', $dateTimeNowDate);
                        $queryUserToday->execute();

                        $userCountUserToday = $queryUserToday->rowCount();
                        ?>
                        <div class="text">KHÁCH HÀNG MỚI HÔM NAY</div>
                        <div class="number count-to" data-from="0" data-to="<?php echo $userCountUserToday ?>" data-speed="1000" data-fresh-interval="20">257</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box-3 bg-blue-grey">
                    <div class="icon">
                    </div>
                    <div class="content">
                        <?php
                        $dateTimeNowDate = date("Y-m-d");

                        $sqlRateCustomerToday = "SELECT * FROM ratehotels WHERE status != 'DELETED' AND DATE(createdAt) = :createdAt";
                        $queryRateCustomerToday= $dbh->prepare($sqlRateCustomerToday);
                        $queryRateCustomerToday->bindParam(':createdAt', $dateTimeNowDate);

                        $queryRateCustomerToday->execute();
                        $rateRateCustomerToday = $queryRateCustomerToday->rowCount();
                        ?>
                        <div class="text">KHÁCH HÀNG ĐÁNH GIÁ HÔM NAY</div>
                        <div class="number"><?php echo $rateRateCustomerToday; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box-3 bg-blue hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">devices</i>
                    </div>
                    <div class="content">
                        <?php
                        $dateTimeNowMonth = date("m");

                        $sqlInvoiceMonth = "SELECT * FROM invoice WHERE status != 'DELETED' AND MONTH(createdAt) = :createdAt";
                        $queryInvoiceMonth = $dbh->prepare($sqlInvoiceMonth);
                        $queryInvoiceMonth->bindParam(':createdAt', $dateTimeNowMonth);
                        $queryInvoiceMonth->execute();

                        $userInvoiceMonth = $queryInvoiceMonth->rowCount();
                        ?>
                        <div class="text">HÓA ĐƠN THÁNG NÀY</div>
                        <div class="number"><?php echo $userInvoiceMonth; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box-3 bg-grey">
                    <div class="icon">
                    </div>
                    <div class="content">
                        <?php

                        $dateTimeNowMonth = date("m");

                        $sqlInvoiceTodayPriceMonth = "SELECT SUM(price) as price FROM invoice WHERE status != 'DELETED' AND MONTH(createdAt) = :createdAt";
                        $queryInvoiceTodayPriceMonth = $dbh->prepare($sqlInvoiceTodayPriceMonth);
                        $queryInvoiceTodayPriceMonth->bindParam(':createdAt', $dateTimeNowMonth);
                        $queryInvoiceTodayPriceMonth->execute();

                        $userInvoiceTodayPRiceMonth = $queryInvoiceTodayPriceMonth->fetch();

                        ?>
                        <div class="text">DOANH THU THÁNG NÀY</div>
                        <div class="number"><?php echo number_format($userInvoiceTodayPRiceMonth['price'], 0, ',', '.') . ' VND'; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box-3 bg-deep-purple">
                    <div class="icon">
                        <i class="material-icons">favorite</i>
                    </div>
                    <div class="content">
                        <?php
                        $dateTimeNowMonth = date("m");

                        $sqlUserMonth = "SELECT * FROM users WHERE status != 'DELETED' AND MONTH(createdAt) = :createdAt";
                        $queryUserMonth = $dbh->prepare($sqlUserMonth);
                        $queryUserMonth->bindParam(':createdAt', $dateTimeNowMonth);
                        $queryUserMonth->execute();

                        $userCountUserMonth = $queryUserMonth->rowCount();
                        ?>
                        <div class="text">KHÁCH HÀNG MỚI THÁNG NÀY</div>
                        <div class="number count-to" data-from="0" data-to="<?php echo $userCountUserMonth; ?>" data-speed="1500" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box-3 bg-brown">
                    <div class="icon">
                    </div>
                    <div class="content">
                        <?php
                        $dateTimeNowMonth = date("m");

                        $sqlRateCustomerMonth = "SELECT * FROM ratehotels WHERE status != 'DELETED' AND MONTH(createdAt) = :createdAt";
                        $queryRateCustomerMonth= $dbh->prepare($sqlRateCustomerMonth);
                        $queryRateCustomerMonth->bindParam(':createdAt', $dateTimeNowMonth);
                        $queryRateCustomerMonth->execute();
                        $rateRateCustomerMonth = $queryRateCustomerMonth->rowCount();
                        ?>
                        <div class="text">KHÁCH HÀNG ĐÁNH GIÁ THÁNG NÀY</div>
                        <div class="number"><?php echo $rateRateCustomerMonth; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box-3 bg-red">
                    <div class="icon">
                        <i class="material-icons">shopping_cart</i>
                    </div>
                    <div class="content">
                        <?php
                        $dateTimeNowYear = date("Y");

                        $sqlInvoiceYear = "SELECT * FROM invoice WHERE status != 'DELETED' AND YEAR(createdAt) = :createdAt";
                        $queryInvoiceYear = $dbh->prepare($sqlInvoiceYear);
                        $queryInvoiceYear->bindParam(':createdAt', $dateTimeNowYear);
                        $queryInvoiceYear->execute();

                        $userInvoiceYear = $queryInvoiceYear->rowCount();
                        ?>
                        <div class="text">HÓA ĐƠN NĂM NAY</div>
                        <div class="number count-to" data-from="0" data-to="<?php echo $userInvoiceYear; ?>" data-speed="1000" data-fresh-interval="20">125</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box-3 bg-light-blue hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">access_alarm</i>
                    </div>
                    <div class="content">
                        <?php

                        $dateTimeNowYear = date("Y");

                        $sqlInvoiceTodayPriceYear = "SELECT SUM(price) as price FROM invoice WHERE status != 'DELETED' AND YEAR(createdAt) = :createdAt";
                        $queryInvoiceTodayPriceYear = $dbh->prepare($sqlInvoiceTodayPriceYear);
                        $queryInvoiceTodayPriceYear->bindParam(':createdAt', $dateTimeNowYear);
                        $queryInvoiceTodayPriceYear->execute();

                        $userInvoiceTodayPriceYear = $queryInvoiceTodayPriceYear->fetch();

                        ?>
                        <div class="text">DOANH THU NĂM NAY</div>
                        <div class="number"><?php echo number_format($userInvoiceTodayPriceYear['price'], 0, ',', '.') . ' VND'; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box-3 bg-black">
                    <div class="icon">
                    </div>
                    <div class="content">
                        <?php
                        $dateTimeNowYear = date("Y");

                        $sqlUserYear = "SELECT * FROM users WHERE status != 'DELETED' AND YEAR(createdAt) = :createdAt";
                        $queryUserYear = $dbh->prepare($sqlUserYear);
                        $queryUserYear->bindParam(':createdAt', $dateTimeNowYear);
                        $queryUserYear->execute();

                        $userCountUserYear = $queryUserYear->rowCount();
                        ?>
                        <div class="text">KHÁCH HÀNG NĂM NAY</div>
                        <div class="number"><?php echo $userCountUserYear; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box-3 bg-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">flight_takeoff</i>
                    </div>
                    <div class="content">
                        <?php
                        $dateTimeNowYear = date("Y");

                        $sqlRateCustomerYear = "SELECT * FROM ratehotels WHERE status != 'DELETED' AND YEAR(createdAt) = :createdAt";
                        $queryRateCustomerYear= $dbh->prepare($sqlRateCustomerYear);
                        $queryRateCustomerYear->bindParam(':createdAt', $dateTimeNowYear);
                        $queryRateCustomerYear->execute();
                        $rateRateCustomerYear = $queryRateCustomerYear->rowCount();
                        ?>

                        <div class="text">KHÁCH HÀNG ĐÁNH GIÁ NĂM NAY</div>
                        <div class="number"><?php echo $rateRateCustomerYear; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Hover Zoom Effect -->
    </div>
</section>
</body>

<?php include('structure/footer.php') ?>
</html>
