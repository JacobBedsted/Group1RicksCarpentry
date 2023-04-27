<?php

require_once "config.php";

$sales = [];
$revenue = [];
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

        $product0 = 0;
        $product1 = 0;
        $product2 = 0;
        $product3 = 0;
        $product4 = 0;
        $product5 = 0;

        $revenue0 = 0;
        $revenue1 = 0;
        $revenue2 = 0;
        $revenue3 = 0;
        $revenue4 = 0;
        $revenue5 = 0;

        foreach($result as $sale) {
            $id = $sale["productID"];

            if($id == 0)
            {
                $product0 = $product0 + $sale["salesQty"];
                $revenue0 = $revenue0 + 3.35 * $sale["salesQty"];
            } elseif ($id == 1) {
                $product1 = $product1 + $sale["salesQty"];
                $revenue1 = $revenue1 + 5.38 * $sale["salesQty"];
            } elseif ($id == 2) {
                $product2 = $product2 + $sale["salesQty"];
                $revenue2 = $revenue2 + 1.65 * $sale["salesQty"];
            } elseif ($id == 3) {
                $product3 = $product3 + $sale["salesQty"];
                $revenue3 = $revenue3 + 229.88 * $sale["salesQty"];
            } elseif ($id == 4) {
                $product4 = $product4 + $sale["salesQty"];
                $revenue4 = $revenue4 + 1.78 * $sale["salesQty"];
            } elseif ($id == 5) {
                $product5 = $product5 + $sale["salesQty"];
                $revenue5 = $revenue5 + 9.98 * $sale["salesQty"];
            }
        }
        $sales[] = $product0;
        $sales[] = $product1;
        $sales[] = $product2;
        $sales[] = $product3;
        $sales[] = $product4;
        $sales[] = $product5;

        $revenue[] = $revenue0;
        $revenue[] = $revenue1;
        $revenue[] = $revenue2;
        $revenue[] = $revenue3;
        $revenue[] = $revenue4;
        $revenue[] = $revenue5;

        $res["status"] = "success";
        $res["sales"] = $sales;
        $res["revenue"] = $revenue;

    } else {
        $res["status"] = "error";
        $res["status_message"] = $stmt->error;
    }
}

echo json_encode($res);

?>