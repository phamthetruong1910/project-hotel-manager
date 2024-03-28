<?php
include('../config.php');

header('Content-Type: application/json');

$id = $_POST['id'];
$des = $_POST['textareaText'];
$type = $_POST['radioValue'];

$sqlInvoice = "SELECT * FROM issues WHERE id=:id AND status='ENABLE'";
$queryInvoice = $dbh->prepare($sqlInvoice);
$queryInvoice->bindParam(':id', $id);
$queryInvoice->execute();
$invoice = $queryInvoice->fetch();

if ($queryInvoice->rowCount() > 0) {
    try {
        $dateTimeNow = date("Y-m-d H:i:s");
        $sqlInsertIssue = "UPDATE issues SET adminRemark=:adminRemark, type=:type, adminremarkDate=:adminremarkDate WHERE id=:id";
        $queryInsertIssue = $dbh->prepare($sqlInsertIssue);
        $queryInsertIssue->bindParam(':adminRemark', $des);
        $queryInsertIssue->bindParam(':type', $type);
        $queryInsertIssue->bindParam(':adminremarkDate', $dateTimeNow);
        $queryInsertIssue->bindParam(':id', $id);

        $queryInsertIssue->execute();

        $response = array('key' => true, 'message' => 'Bạn đã trả lời thành công');
    } catch (Exception $exception) {
        $response = array('key' => false, 'message' => 'Lỗi trong quá trình cập nhật dữ liệu!');
    }
} else {
    $response = array('key' => false, 'message' => 'Bạn không thể thêm yêu cầu');
}

echo json_encode($response);
