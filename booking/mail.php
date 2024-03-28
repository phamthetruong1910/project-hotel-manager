<?php
include('../includes/config.php');

$sqlCurrentInvoice = "SELECT * FROM invoice WHERE id=:id AND status != 'DELETED' ";
$queryCurrentInvoice = $dbh->prepare($sqlCurrentInvoice);
$id = 48;
$queryCurrentInvoice->bindParam(':id', $id);
$queryCurrentInvoice->execute();
$invoiceCurrentInvoice = $queryCurrentInvoice->fetch();

$sqlCurrentUser = "SELECT * FROM users WHERE id=:id AND status != 'DELETED'";
$queryCurrentUser = $dbh->prepare($sqlCurrentUser);
$queryCurrentUser->bindParam(':id', $invoiceCurrentInvoice['userId']);
$queryCurrentUser->execute();
$userCurrentUser = $queryCurrentUser->fetch();

$sqlHotelCurrent = "SELECT * FROM hotels WHERE id=:id AND status != 'DELETED'";
$queryHotelCurrent = $dbh->prepare($sqlHotelCurrent);
$queryHotelCurrent->bindParam(':id', $invoiceCurrentInvoice['hotelId']);
$queryHotelCurrent->execute();
$hotelHotelCurrent = $queryHotelCurrent->fetch();

$to_email = 'ngminhngoc123@gmail.com';
$subject = 'Cảm ơn Khách hàng '. $userCurrentUser['fullName'] .'  đã đặt phòng khách sạn '. $hotelHotelCurrent['name'];
$body = 'Hẹn gặp bạn tại khách sạn - Hóa đơn bạn: http://localhost/BookingHotelResort/booking/invoice-email.php?id=' . $id;
$headers = "From: bookingkhachsan321@gmail.com";

mail($to_email, $subject, $body, $headers);
