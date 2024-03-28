<?php
require_once("includes/config.php");

if (!empty($_POST["id"])) {
    $id = $_POST["id"];
    $sql = "SELECT price FROM roomType WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetch(PDO::FETCH_OBJ);
    $cnt = 1;
    if ($query->rowCount() > 0) {
        echo $results['price'];
    } else {
        print_r(0);
    }
}
?>
