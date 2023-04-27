<?php

require_once "config.php";


$id = $_POST["productID"];
$qnty = $_POST["productQty"];



$conn = new mysqli($hn,$un,$pw,$db);

if($conn->connect_error) {
    $res["status"] = "error";
    $res["status_message"] = "MySQL connection error";
} else {
    $stmt = $conn->prepare("UPDATE products SET productQty=productQty+? WHERE productID=?");

    $stmt->bind_param("ii",$qnty,$id);

    if($stmt->execute()) {

        $res["status"] = "success";
        $res["status_message"] = $id;

    } else {
        $res["status"] = "error";
        $res["status_message"] = "No item found";
    }
}

echo json_encode($res);

?>