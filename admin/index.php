<?php
session_start();
include "../admin_files/conn.php";
include "../admin_files/funs.php";
if (isset($_POST["username"])) 
    verifyLogInInfo($mydb, $_POST["username"], $_POST["password"]);

if (isset($_SESSION["userID"])) 
    header("Location: admin.php");
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