<?php
include('../includes/config.php');

header('Content-Type: application/json');

$id = $_POST['id'];
$title = $_POST['inputText'];
$des = $_POST['textareaText'];
$sqlInvoice = "SELECT * FROM invoice WHERE id=:id AND status='ENABLE'";
$queryInvoice = $dbh->prepare($sqlInvoice);
$queryInvoice->bindParam(':id', $id);
$queryInvoice->execute();
$invoice = $queryInvoice->fetch();

if ($queryInvoice->rowCount() > 0) {

    try {
        $now = time();
        $target = new DateTime($invoice['fromDate']);
        $targetTimestamp = $target->getTimestamp();
        $secondsLeft = $targetTimestamp - $now;
        $daysLeft = floor($secondsLeft / 86400);

        if ($daysLeft < 1) {
            $response = array('key' => false, 'message' => 'Bạn không được thêm yêu cầu phòng trước 1 ngày' . $daysLeft);
        } else {
            $status = 'ENABLE';
            $dateTimeNow = date("Y-m-d H:i:s");
            $type = 'WAITING';
            $sqlInsertIssue= "INSERT INTO issues(Issue,description,createdAt,status,invoiceId,type) VALUES (:Issue,:description,:createdAt,:status,:invoiceId,:type)";
            $queryInsertIssue = $dbh->prepare($sqlInsertIssue);
            $queryInsertIssue->bindParam(':Issue', $title);
            $queryInsertIssue->bindParam(':description', $des);
            $queryInsertIssue->bindParam(':createdAt', $dateTimeNow);
            $queryInsertIssue->bindParam(':status', $status);
            $queryInsertIssue->bindParam(':invoiceId', $id);
            $queryInsertIssue->bindParam(':type', $type);

            $queryInsertIssue->execute();

            $response = array('key' => true, 'message' => 'Bạn đã thêm yêu cầu thành công');
        }

    } catch (Exception $exception) {
        $response = array('key' => false, 'message' => 'Bạn không thể thêm yêu cầu');
    }
} else {
    $response = array('key' => false, 'message' => 'Bạn không thể thêm yêu cầu');
}

echo json_encode($response);
