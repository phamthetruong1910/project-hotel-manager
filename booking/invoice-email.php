<?php
session_start();
error_reporting(0);
include('../includes/config.php');

$id = $_GET['id'];
$sql = "SELECT * FROM invoice WHERE id=:id AND status != 'DELETED' ";
$query = $dbh->prepare($sql);
$query->bindParam(':id', $id);
$query->execute();
$invoice = $query->fetch();

$sqlUser = "SELECT * FROM users WHERE id=:id AND status != 'DELETED'";
$queryUser = $dbh->prepare($sqlUser);
$queryUser->bindParam(':id', $invoice['userId']);
$queryUser->execute();
$user = $queryUser->fetch();

$sqlHotel = "SELECT * FROM hotels WHERE id=:id AND status != 'DELETED'";
$queryHotel = $dbh->prepare($sqlHotel);
$queryHotel->bindParam(':id', $invoice['hotelId']);
$queryHotel->execute();
$hotel = $queryHotel->fetch();

$sqlPayment = "SELECT * FROM paymentmethod WHERE id=:id";
$queryPayment = $dbh->prepare($sqlPayment);
$queryPayment->bindParam(':id', $invoice['paymentId']);
$queryPayment->execute();
$payment = $queryPayment->fetch();

?>
<link rel="stylesheet" href="../css/invoice-email.css">
<body>
<div id="invoiceholder">
    <div id="invoice" class="effect2">

        <div id="invoice-top">
            <div class="logo"></div>
            <div class="title">
                <h1 style="padding-bottom: 5px">Mã #<span class="invoiceVal invoice_num"><?php echo $invoice['id'] ?></span></h1>
                <p>Hóa đơn tạo ngày : <span id="invoice_date"><?php echo $invoice['createdAt'] ?></span>
                </p>
            </div><!--End Title-->
        </div><!--End InvoiceTop-->



        <div id="invoice-mid">
            <div id="message">
                <h2>Hello <?php echo $user['fullName']; ?>,</h2>
                <p>Hóa đơn có số #<span id="invoice_num"><?php echo $invoice['id']; ?></span> được tạo bởi <span id="supplier_name"> TMS chúng tôi.</p>
            </div>
            <div class="cta-group mobile-btn-group">
                <a href="javascript:void(0);" class="btn-primary">Approve</a>
                <a href="javascript:void(0);" class="btn-default">Reject</a>
            </div>
            <div class="clearfix">
                <div class="col-left">
                    <div class="clientlogo"><img src="https://cdn3.iconfinder.com/data/icons/daily-sales/512/Sale-card-address-512.png" alt="Sup" /></div>
                    <div class="clientinfo">
                        <h2 id="supplier"><?php echo $hotel['name'] ?></h2>
                        <p><span id="address"><?php echo $hotel['location'] ?></span><br><span id="tax_num"><?php echo $hotel['hotline'] ?></span><br></p>
                    </div>
                </div>
                <div class="col-right">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td><span>Tổng tiên hóa đơn</span><label id="invoice_total"><?php echo number_format($invoice['price'], 0, ',', '.') . '' ?></label></td>
                            <td><span>Đơn vị tiền tệ</span><label id="currency">VND</label></td>
                        </tr>
                        <tr>
                            <td><span>Hình thức thanh toán</span><label id="payment_term"><?php echo $payment['name'] ?></label></td>
                            <td><span>Loại hóa đơn</span><label id="invoice_type">ONLINE</label></td>
                        </tr>
                        <tr><td colspan="2"><span>Note</span>#<label id="note"><?php echo $invoice['comment'] ?></label></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--End Invoice Mid-->

        <div id="invoice-bot">

            <div id="table">
                <table class="table-main">
                    <thead>
                    <tr class="tabletitle">
                        <th></th>
                        <th>Tên phòng</th>
                        <th>Số lượng phòng</th>
                        <th>Giá phòng</th>
                        <th>Tổng giá từng phòng</th>
                    </tr>
                    </thead>
                    <?php
                    $sqlInvoiceDetails = "SELECT * FROM invoicedetails WHERE invoiceId=:id AND status != 'DELETED' ";
                    $queryInvoiceDetail = $dbh->prepare($sqlInvoiceDetails);
                    $queryInvoiceDetail->bindParam(':id', $invoice['id']);
                    $queryInvoiceDetail->execute();
                    $invoiceDetails = $queryInvoiceDetail->fetchAll();

                    if ($queryInvoiceDetail->rowCount() > 0) {
                        foreach ($invoiceDetails as $invoiceDetail) {
                            $sqlRoomType = "SELECT * FROM roomtype WHERE id=:id";
                            $queryRoomType = $dbh->prepare($sqlRoomType);
                            $queryRoomType->bindParam(':id', $invoiceDetail['roomTypeId']);
                            $queryRoomType->execute();
                            $roomType = $queryRoomType->fetch();
                            ?>
                            <tr class="list-item">
                                <td data-label="Type" class="tableitem"><?php echo $invoiceDetail['id'] ?></td>
                                <td data-label="Description" class="tableitem"><?php echo $roomType['name']; ?></td>
                                <td data-label="Quantity" class="tableitem"><?php echo $invoiceDetail['quantity'] ?></td>
                                <td data-label="Taxable Amount" class="tableitem"><?php echo number_format($roomType['price'], 0, ',', '.') . ' VNĐ/phòng/đêm' ?></td>
                                <td data-label="Total" class="tableitem"><?php echo number_format($invoiceDetail['price'], 0, ',', '.') . 'VNĐ' ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                    <tr class="list-item total-row">
                        <th colspan="9" class="tableitem">Tổng tiền</th>
                        <td data-label="Grand Total" class="tableitem"><?php echo number_format($invoice['price'], 0, ',', '.') . 'VNĐ' ?></td>
                    </tr>
                </table>
            </div><!--End Table-->
            <div class="cta-group">
            </div>

        </div><!--End InvoiceBot-->
        <footer>
            <div id="legalcopy" class="clearfix">
                <p class="col-right">Địa chỉ email chúng tôi:
                    <span class="email"><a href="mailto:bookingkhachsan321@gmail.com">bookingkhachsan321@gmail.com</a></span>
                </p>
            </div>
        </footer>
    </div><!--End Invoice-->
</div><!-- End Invoice Holder-->



</body>