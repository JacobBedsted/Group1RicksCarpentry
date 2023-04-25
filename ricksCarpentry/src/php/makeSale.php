<?php

require_once "config.php";


$productId = $_POST["productID"];
$customerId = $_POST["customerId"];
$salesDate = $_POST["salesDate"];
$salesQty = $_POST["salesQty"];

$conn = new mysqli($hn,$un,$pw,$db);

if($conn->connect_error) {
    $res["status"] = "error";
    $res["status_message"] = "MySQL connection error";
} else {
    $stmt = $conn->prepare("INSERT INTO sales VALUES(?,?,?,?)");
    $stmt->bind_param("iisi",$productId,$customerId,$salesDate,$salesQty);

    if($stmt->execute()) {
        $res["status"] = "success";
    } else {
        $res["status"] = "error";
        $res["status_message"] = $stmt->error;
    }
}

echo json_encode($res);

?>