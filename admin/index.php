<?php
session_start();
include "../admin_files/conn.php";
if (isset($_POST["username"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $query = "SELECT `id`, `password` FROM `admin` where `username`='$username'";
    if (isset(($mydb->query($query))->fetch_array()["id"])) {
        $user = ($mydb->query($query))->fetch_array();
        if (password_verify($password, $user["password"])) {
            $_SESSION["userID"] = $user["id"];
            $_SESSION["username"] = $username;
        }
    }
}
if (isset($_SESSION["userID"])) {
    header("Location: admin.php");
}
?>

<html>

<body>
    <div id="login">
        <form method="POST">
            <input type="text" name="username">
            <input type="password" name="password">
            <button>Prijavi se</button>
        </form>
    </div>
</body>

</html>