<?php

require_once "config.php";

$email = $_POST["email"];
$password = $_POST ["password"];

$conn = new mysqli($hn,$un,$pw,$db);

if($conn->connect_error) {
    $res["status"] = "error";
    $res["status_message"] = "MySQL connection error";
} else {
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");

    $stmt->bind_param("s",$email);

    if($stmt->execute()) {
        $result = $stmt->get_result();

        $rows = $result->num_rows;

        if($rows >= 1) {
            foreach($result as $item) {
                if(password_verify($password, $item["password"])) {
                    session_start();
                    $_SESSION["fname"] = $item["fname"];
                    $_SESSION["lname"] = $item["lname"];
                    $_SESSION["email"] = $item["email"];
                    $_SESSION["id"] = $item["id"];
                    $_SESSION["auth"] = true;

                    $res["status"] = "success";
                    $res["fname"] = $item["fname"];
                    $res["lname"] = $item["lname"];
                    $res["email"] = $item["email"];
                    $res["id"] = $item["id"];
                    $res["session"] = session_id();
                    $res["auth"] = true;
                } else {
                    $res["status"] = "error";
                    $res["status_message"] = "Incorrect password";
                }
            }
        } else {
            $res["status"] = "error";
            $res["status_message"] = "No user found";
        }
    } else {
        $res["status"] = "error";
        $res["status_message"] = $stmt->error;
    }
}

echo json_encode($res);

?>