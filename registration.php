<?php 
$servername = "localhost";
$admname = "root";
$admpassword = "";
$dbname = "accounts";

$conn = new mysqli($servername, $admname, $admpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$incorrectusername = "";
$incorrectpassword = "";

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if(!preg_match('/^[a-zA-Z0-9]{5,}$/', $username)) {

        $incorrectusername = "Incorrect Username, only use letters and numbers. (A-Z, 0-9)";
        echo $incorrectusername;
        exit();
    }
    elseif (!preg_match('/^[a-zA-Z0-9]{5,}$/', $password)) {

        $incorrectpassword = "Incorrect password, try again.";
        echo $incorrectpassword;
        exit();
    }
    else {

        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Successful registration, thank you.";
        }

        else {
            echo "Error.";
        }

        $conn->close();
        exit();

    }

    }


?>