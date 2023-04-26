<?php
require_once "config.php";

$products = [];

$conn = new mysqli($hn,$un,$pw,$db);

if($conn->connect_error) {
    $res["status"] = "error";
    $res["status_message"] = "MySQL connection error";
} else {
    $stmt = $conn ->prepare("SELECT * FROM products");
    if($stmt->execute()) {
        $result = $stmt->get_result();
        $rows = $result->num_rows;

        foreach($result as $product) {
            $products[] = $product;

            $res["status"] = "success";
            $res["products"] = $products;
        }

    } else {
    $res["status"] = "error";
    $res["status_message"] = "No products found";
    }
}

echo json_encode($res);

?>