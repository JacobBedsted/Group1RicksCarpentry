<?php

require_once "config.php";

$sales = [];
$firstDay = $_POST["firstDay"];
$secondDay = $_POST["secondDay"];

$conn = new mysqli($hn,$un,$pw,$db);

if($conn->connect_error) {
    $res["status"] = "error";
    $res["status_message"] = "MySQL connection error";
} else {
    $stmt = $conn ->prepare("SELECT * FROM sales WHERE salesDate BETWEEN ? AND ?;");
    $stmt->bind_param("ss",$firstDay,$secondDay);

    if($stmt->execute()) {
        $result = $stmt->get_result();
        $rows = $result->num_rows;

        $product0 = null;
        $product1 = null;
        $product2 = null;
        $product3 = null;
        $product4 = null;
        $product5 = null;

        foreach($result as $sale) {
            $id = $sale["productID"];

            if($id == 0)
            {
                $product0 = $product0 + $sale["salesQty"];
            } elseif ($id == 1) {
                $product1 = $product1 + $sale["salesQty"];
            } elseif ($id == 2) {
                $product2 = $product2 + $sale["salesQty"];
            } elseif ($id == 2) {
                $product3 = $product3 + $sale["salesQty"];
            } elseif ($id == 2) {
                $product4 = $product4 + $sale["salesQty"];
            } elseif ($id == 2) {
                $product5 = $product5 + $sale["salesQty"];
            }
        }
        $sales[] = $product0;
        $sales[] = $product1;
        $sales[] = $product2;
        $sales[] = $product3;
        $sales[] = $product4;
        $sales[] = $product5;

        $res["status"] = "success";
        $res["sales"] = $sales;

    } else {
        $res["status"] = "error";
        $res["status_message"] = $stmt->error;
    }
}

echo json_encode($res);

?>