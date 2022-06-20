


<?php
session_start();
include "../admin_files/funs.php";
include '../admin_files/conn.php';
include '../admin_files/querys.php';
include "../admin_files/add_erase.php";

adminChechingVariables($mydb);?>
<!DOCTYPE html>
<html lang='sr'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Admin</title>
    <link rel="shortcut icon" href="../imgs/folder-admin.svg" type="image/x-icon">
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body class="admin">

    

    <?php
    nav();
    include '../admin_files/sections/predmeti.php';

    predmetiU(6);
    predmetiU(7);
    predmetiU(8);
    predmetiU(9);

    include '../admin_files/sections/smerovi.php';
    ?>

    <form id="change" method="POST">
        <input type="text" id="new-order-nuber" name="new-order-nuber" hidden>
    </form>
    <script src="../admin_files/main.js"></script>
</body>

</html>
<?php $mydb->close() ?>