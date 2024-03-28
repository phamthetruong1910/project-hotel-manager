<?php
require_once("includes/config.php");
// code admin email availablity
if (!empty($_POST["emailid"])) {
    $email = $_POST["emailid"];
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        print_r("error : You did not enter a valid email.");die();
    } else {
        $sql = "SELECT email FROM users WHERE email=:email AND status != 'DELETED'";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
            print_r("<span style='color:red'> Email đã tồn tại trong hệ thống .</span>");
            print_r("<script>$('#submit').prop('disabled',true);</script>");die();
        } else {
            print_r ("<span style='color:green'> Email hợp lệ .</span>");
            print_r ("<script>$('#submit').prop('disabled',false);</script>");die();
        }
    }
}


?>
