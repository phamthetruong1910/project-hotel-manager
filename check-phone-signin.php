<?php
require_once("includes/config.php");
// code admin email availablity
if (!empty($_POST["phone"])) {
    $mobileNumber = $_POST["phone"];
    if (preg_match('/[^0-9]/', $mobileNumber)) {
        print_r("<span style='color:red'> Số điện thoại không được có kí tự .</span>");
        print_r("<script>$('#submit').prop('disabled',true);</script>");die();
    } else {
        $sql = "SELECT * FROM users WHERE mobileNumber=:mobileNumber AND status != 'DELETED'";
        $query = $dbh->prepare($sql);
        $query->bindParam(':mobileNumber', $mobileNumber);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
            print_r("<span style='color:red'> Số điện thoại đã tồn tại trong hệ thống .</span>");
            print_r("<script>$('#submit').prop('disabled',true);</script>");die();
        } else {
            print_r ("<span style='color:green'> Số điện thoại hợp lệ .</span>");
            print_r ("<script>$('#submit').prop('disabled',false);</script>");die();
        }
    }
}

?>
