<?php

require_once "config.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
$id = null;

$conn = new mysqli($hn,$un,$pw,$db);

if($conn->connect_error) {
    $res["status"] = "error";
    $res["status_message"] = "MySQL connection error";
} else {
    $stmt = $conn->prepare("INSERT INTO users VALUES(?,?,?,?,?)");
    $stmt->bind_param("issss",$id,$fname,$lname,$email,$password);

    if($stmt->execute()) {
        $newUser = $conn->insert_id;

        session_start();
        $_SESSION["fname"] = $fname;
        $_SESSION["lname"] = $lname;
        $_SESSION["email"] = $email;
        $_SESSION["id"] = $newUser;
        $_SESSION["auth"] = true;

        $res["status"] = "success";
        $res["fname"] = $fname;
        $res["lname"] = $lname;
        $res["email"] = $email;
        $res["id"] = $newUser;
        $res["session"] = session_id();
        $res["auth"] = true;
    } else {
        $res["status"] = "error";
        $res["status_message"] = $stmt->error;
    }
}

echo json_encode($res);

?>