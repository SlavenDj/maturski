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

    <nav id="menu">

        <a href="admin.php">
            <button>Spisak učenika</button>
        </a>

        <form action="noviUcenikSuzeno.php">
            <button title="Dodaj novog učenika">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" class='plus-color'>
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                </svg>
            </button>
        </form>

        <form action="../ucenikSuzbijen.php" method="POST" id="find-ucenik-form">
            <input type="text" name="jmbg" id="find-jmbg" placeholder="Unesi JMBG učenika">
            <button id="pronadi-me">Pronađi učenika</button>
        </form>

        <form method="POST">
            <input type="text" name="new-admin-username" id="new-admin-username" hidden required>
            <input type="password" name="new-admin-password" id="new-admin-password" hidden minlength="8" required>
            <button id="dodaj-admina">Dodaj novog admina</button>
        </form>

        <form method="POST" id="change-pass">
            <input type="text" name="new-pwrd-1" id="new-pwrd-1" hidden>
            <button id="promeni-pass">Promeni šifru</button>
        </form>

        <form>
            <input type="text" value="true" hidden name="logout">
            <button>Odjavi se sa <?php echo $_SESSION["username"] ?></button>
        </form>

    </nav>

    <?php prikaziTabeluPregledanihUcenika($mydb) ?>
    <form action="export.php">
        <button>Export in Excel file</button>
    </form>
    <?php
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