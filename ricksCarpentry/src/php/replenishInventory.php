<?php

require_once "config.php";


$id = $_POST["productID"];
$qnty = $_POST["productQuantity"];

$conn = new mysqli($hn,$un,$pw,$db);

if($conn->connect_error) {
    $res["status"] = "error";
    $res["status_message"] = "MySQL connection error";
} else {
    $stmt = $conn->prepare("UPDATE products SET productQty= productQty+$qnty WHERE productID=?");

    $stmt->bind_param("s",$id);

    if($stmt->execute()) {
        $result = $stmt->get_result();

        $res["status"] = "success";

    } else {
        $res["status"] = "error";
        $res["status_message"] = "No item found";
    }
}

echo json_encode($res);

?>