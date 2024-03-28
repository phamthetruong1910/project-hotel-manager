<?php
session_start();
error_reporting(0);
include('../includes/config.php');

if (isset($_POST['submit'])) {
    $email = $_SESSION['login'];

    $sqlUser = "SELECT id,fullName FROM users WHERE email=:email";
    $queryUser = $dbh->prepare($sqlUser);
    $queryUser->bindParam(':email', $email, PDO::PARAM_STR);
    $queryUser->debugDumpParams();
    $queryUser->execute();
    $user = $queryUser->fetch(PDO::FETCH_OBJ);
    $cnt = 1;

    if ($queryUser->rowCount() == 0) {
        $_SESSION['msg'] = "Tài khoản Bạn đã bị xóa";
        header('location: ../invoice-history.php');
    }

    $emailContact = $_POST['emailContact'];
    $mobileContact = $_POST['mobileContact'];
    $totalNumberRoom = $_POST['totalNumberRoom'];
    $createdBy = $email;
    $hotelId = $_POST['hotelId'];
    $comment = $_POST['comment'];
    $status = 'ENABLE';
    $dateTimeNow = date("Y-m-d H:i:s");
    $paymentId = $_POST['paymentId'];
    $price = $_POST['price'];
    $fromDate = date("Y-m-d H:i:s", strtotime($_POST['fromDate'] . " 12:00:00"));
    $toDate = date("Y-m-d H:i:s", strtotime($_POST['toDate'] . " 12:00:00"));
    $numberDay = $_POST['numberDay'];

    try {

        $sql = "INSERT INTO invoice(emailContact,mobileContact,createdBy,comment,status,createdAt,paymentId,fromDate,toDate,numberDay,userId,price,hotelId) 
                    VALUES(:emailContact,:mobileContact,:createdBy,:comment,:status,:createdAt,:paymentId,:fromDate,:toDate,:numberDay,:userId,:price,:hotelId)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':emailContact', $emailContact);
        $query->bindParam(':mobileContact', $mobileContact);
        $query->bindParam(':createdBy', $createdBy);
        $query->bindParam(':comment', $comment);
        $query->bindParam(':status', $status);
        $query->bindParam(':createdAt', $dateTimeNow);
        $query->bindParam(':paymentId', $paymentId);
        $query->bindParam(':fromDate', $fromDate);
        $query->bindParam(':toDate', $toDate);
        $query->bindParam(':numberDay', $numberDay);
        $query->bindParam(':userId', $user->id);
        $query->bindParam(':price', $totalNumberRoom);
        $query->bindParam(':hotelId', $hotelId);

        $query->execute();
        $lastInsertId = $dbh->lastInsertId();


        $roomType = array();
        $invoiceDetails = $_POST;
        $hotelId = $invoiceDetails['hotelId'];
        $numberDay = $invoiceDetails['numberDay'];

        $sqlInvoicePayment = "INSERT INTO invoicepayment (invoiceId, cardNumber, cardHolder, expirationDate, cvv, eWalletId, eWalletPassword, bankName, atmNumber, atmPin, paymentId)
                                    VALUES (:invoiceId, :cardNumber,:cardHolder,:expirationDate,:cvv,:eWalletId,:eWalletPassword,:bankName,:atmNumber,:atmPin,:paymentId)";

        $queryInvoicePayment = $dbh->prepare($sqlInvoicePayment);
        $queryInvoicePayment->bindParam(':invoiceId', $lastInsertId);
        $queryInvoicePayment->bindParam(':cardNumber', $invoiceDetails['cardNumber']);
        $queryInvoicePayment->bindParam(':cardHolder', $invoiceDetails['cardHolder']);
        $queryInvoicePayment->bindParam(':expirationDate', $invoiceDetails['expirationDate']);
        $queryInvoicePayment->bindParam(':cvv', $invoiceDetails['cvv']);
        $queryInvoicePayment->bindParam(':eWalletId', $invoiceDetails['eWalletId']);
        $queryInvoicePayment->bindParam(':eWalletPassword', $invoiceDetails['eWalletPassword']);
        $queryInvoicePayment->bindParam(':bankName', $invoiceDetails['bankName']);
        $queryInvoicePayment->bindParam(':atmNumber', $invoiceDetails['atmNumber']);
        $queryInvoicePayment->bindParam(':atmPin', $invoiceDetails['atmPin']);
        $queryInvoicePayment->bindParam(':paymentId', $invoiceDetails['paymentId']);
        $queryInvoicePayment->execute();

        unset(
            $invoiceDetails['emailContact'],
            $invoiceDetails['createdBy'],
            $invoiceDetails['comment'],
            $invoiceDetails['status'],
            $invoiceDetails['createdAt'],
            $invoiceDetails['status'],
            $invoiceDetails['fromDate'],
            $invoiceDetails['toDate'],
            $invoiceDetails['hotelId'],
            $invoiceDetails['submit'],
            $invoiceDetails['fromDate'],
            $invoiceDetails['toDate'],
            $invoiceDetails['numberDay'],
            $invoiceDetails['roomTypeIdPrice'],
            $invoiceDetails['quantity'],
            $invoiceDetails['mobileContact'],
            $invoiceDetails['roomTypeIdPrice'],
            $invoiceDetails['totalNumberRoom'],
            $invoiceDetails['hotelId'],

            $invoiceDetails['paymentId'],
            $invoiceDetails['cardNumber'],
            $invoiceDetails['cardHolder'],
            $invoiceDetails['expirationDate'],
            $invoiceDetails['cvv'],
            $invoiceDetails['eWalletId'],
            $invoiceDetails['eWalletPassword'],
            $invoiceDetails['bankName'],
            $invoiceDetails['atmNumber'],
            $invoiceDetails['atmPin'],
        );

        $sqlroomtype = "SELECT * FROM roomtype WHERE hotelId =:hotelId";
        $queryRoomType = $dbh->prepare($sqlroomtype);
        $queryRoomType->bindParam(':hotelId', $hotelId);
        $queryRoomType->execute();

        $roomsTypeGet = $queryRoomType->fetchAll();

        foreach ($invoiceDetails as $key => $value) {
            $index = substr($key, strpos($key, "-") + 1);

            if (strpos($key, "-") != 0) {

                if (!isset($roomType[$index])) {
                    $roomType[$index] = array();
                }

                if (preg_replace('/-\d+$/', '', $key) === 'roomTypeIdPrice') {
                    $roomTypeIdPrice = explode('-', $value);

                    $roomType[$index]['roomTypeId'] = $roomTypeIdPrice[0];
                        if ($roomTypeIdPrice[2] === '1') {
                            $roomType[$index]['price'] = ((($roomTypeIdPrice[1] * $roomTypeIdPrice[3]) / 100) * $numberDay) * $invoiceDetails["quantity-" . $index];
                        } else {
                            $roomType[$index]['price'] = ($roomTypeIdPrice[1] * $numberDay) * $invoiceDetails["quantity-" . $index];
                        }

                } else {
                    $roomType[$index][preg_replace('/-\d+$/', '', $key)] = $value;
                }
            }
        }
        $roomType = array_values($roomType);

        $sqlRoomType = "INSERT INTO invoiceDetails(invoiceId,roomTypeId,quantity,price,isUseDeposit,depositPercent)  VALUES(?, ?, ?, ?, ?, ?)";

        foreach ($roomType as $values) {
            $values['invoiceId'] = $lastInsertId;
            $stmt = $dbh->prepare($sqlRoomType);
            $sqlRoomTypeGet = 'SELECT * FROM roomtype WHERE id =:id';
            $queryRoomTypeGet = $dbh->prepare($sqlRoomTypeGet);
            $queryRoomTypeGet->bindParam(':id', $values['roomTypeId']);
            $queryRoomTypeGet->execute();
            $getRoomType = $queryRoomTypeGet->fetch();

            $stmt->execute([
                $values['invoiceId'],
                $values['roomTypeId'],
                $values['quantity'],
                $values['price'],
                $getRoomType['isUseDeposit'],
                $getRoomType['depositPercent']
            ]);
        }

        if (SETTING_EMAIL && $lastInsertId) {
            $sqlCurrentInvoice = "SELECT * FROM invoice WHERE id=:id AND status != 'DELETED' ";
            $queryCurrentInvoice = $dbh->prepare($sqlCurrentInvoice);
            $queryCurrentInvoice->bindParam(':id', $lastInsertId);
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

            $to_email = $emailContact;
            $subject = 'Cảm ơn Khách hàng '. $userCurrentUser['fullName'] .'  đã đặt phòng khách sạn '. $hotelHotelCurrent['name'];
            $body = 'Hẹn gặp bạn tại khách sạn - Hóa đơn bạn: http://localhost/BookingHotelResort/booking/invoice-email.php?id=' . $lastInsertId;
            $headers = "From: bookingkhachsan321@gmail.com";

            mail($to_email, $subject, $body, $headers);
        }

        if ($lastInsertId) {
            $_SESSION['msg'] = "Hóa đơn đã được gửi thành công";
            header('location: ../invoice-history.php');
        } else {
            $_SESSION['msg'] = "Hóa đơn đã chưa gửi thành công";
            header('location: ../invoice-history.php');
        }
    } catch (Exception $exception) {
        echo $exception->getMessage();
    }

}