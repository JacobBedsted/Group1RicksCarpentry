<?php

require_once "config.php";


$productId = $_POST["productID"];
$customerName = $_POST["customerName"];
$salesDate = $_POST["salesDate"];
$salesQty = $_POST["salesQty"];
$id = null;

$conn = new mysqli($hn,$un,$pw,$db);

if($conn->connect_error) {
    $res["status"] = "error";
    $res["status_message"] = "MySQL connection error";
} else {
    $stmt = $conn->prepare("INSERT INTO sales VALUES(?,?,?,?,?)");
    $stmt->bind_param("iissi",$id,$productId,$customerName,$salesDate,$salesQty);

    if($stmt->execute()) {
        $stmt = $conn->prepare("UPDATE products SET productQty=productQty-? WHERE productID=?");
        $stmt->bind_param("ii",$salesQty,$productId);

        if($stmt->execute()) {
            $res["status"] = "success";
        } else {
            $res["status"] = "error";
            $res["status_message"] = $stmt->error;
        }
    } else {
        $res["status"] = "error";
        $res["status_message"] = $stmt->error;
    }
}

echo json_encode($res);

?>