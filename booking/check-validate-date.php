<?php
include('../includes/config.php');

    header('Content-Type: application/json');

    $hotelId = $_POST['hotelId'];
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $roomData = $_POST['roomData'];
    $dateNow = date("Y-m-d");
    $dateTimeNow = date("Y-m-d H:i:s");
    $dateTimePast = date("Y-m-d 12:00:00");

    if ($fromDate === $dateNow && $dateTimeNow > $dateTimePast) {
        $response = array('key' => false, 'message' => 'Thời gian đặt phòng hôm nay đã quá 12 giờ');
    } else if ($fromDate === $toDate) {
        $response = array('key' => false, 'message' => 'Phải cách nhau ít nhất 1 ngày');
    } else {
        foreach ($roomData as $value) {
            $sqlRoomType = "SELECT * FROM roomType WHERE id=:roomTypeId";
            $queryRoomType = $dbh->prepare($sqlRoomType);
            $queryRoomType->bindParam(':roomTypeId', $value['roomTypeId'], PDO::PARAM_STR);
            $queryRoomType->execute();
            $totalNumber = $queryRoomType->fetch();


            $sqlIds = "SELECT id FROM invoice WHERE hotelId=:hotelId AND DATE(fromDate) <= '" . $fromDate . "' AND '". $toDate ."' <= DATE(toDate) AND status = 'ENABLE'";
            $queryIds = $dbh->prepare($sqlIds);
            $queryIds->bindParam(':hotelId', $hotelId, PDO::PARAM_STR);
            $queryIds->execute();
            $invoicesFromTo = $queryIds->fetchAll();

            if ($totalNumber['totalNumber'] < $value['quantity']) {
                $response = array('key' => false, 'message' => 'Bạn đã vượt quá số lượng phòng '. $totalNumber['name'] .' này');
                break;
            } else if ($queryIds->rowCount() > 0) {
                $invoicesFromToIds = array();
                foreach ($invoicesFromTo as $row) {
                    $invoicesFromToIds[] = $row['id'];
                }

                $sqlInvoiceInput = "SELECT sum(quantity) as sum_quantity FROM invoiceDetails WHERE invoiceId IN (" . implode(',', $invoicesFromToIds) . ") AND roomTypeId=:roomTypeId AND invoiceDetails.status != 'DELETED'";

                $queryInvoiceDetailsInput = $dbh->prepare($sqlInvoiceInput);
                $queryInvoiceDetailsInput->bindParam(':roomTypeId', $value['roomTypeId'], PDO::PARAM_STR);
                $queryInvoiceDetailsInput->execute();
                $quantityRemaining = $queryInvoiceDetailsInput->fetch();

                $isNumberOfRoomsLeft = ($totalNumber['totalNumber'] - $quantityRemaining['sum_quantity']) >= $value['quantity'];

                if ($isNumberOfRoomsLeft) {
                    $response = array('key' => true, 'message' => 'Bạn được phép đặt loại phòng '. $totalNumber['name'] .' này');
                } else {
                    $response = array('key' => false, 'message' => 'Khung giờ loại phòng: '. $totalNumber['name'] .' này chỉ còn '. ($totalNumber['totalNumber'] - $quantityRemaining['sum_quantity']) .' phòng!',);
                    break;
                }
            } else {
                $response = array('key' => true, 'message' => 'Bạn được phép đặt phòng');
            }
        }
    }

// Return the JSON response
echo json_encode($response);
