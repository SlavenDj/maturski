<?php
session_start();
include "../admin_files/funs.php";


// * Log Out
if (isset($_GET["logout"])) 
    logOut();

include '../admin_files/conn.php';
include '../admin_files/querys.php';
include "../admin_files/add_erase.php";

if (isset($_POST["query"])) {
    $mydb->query($_POST["query"]);
}
?>
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
    function addNewUserQuery($usename, $password)
    {
        return 
            "INSERT INTO `admin` (`username`, `password`) 
                VALUE (
                    '$usename',
                    '$password')";
    }
    function addNewUser($db, $username, $password)
    {
        $db->query(addNewUserQuery($username, password_hash($password, PASSWORD_DEFAULT)));
    }
    if (isset($_POST["new-admin-username"]) && isset($_POST["new-admin-password"])) {
        addNewUser($mydb, $_POST["new-admin-username"], $_POST["new-admin-password"]);
    }

    function updatePasswordQuery($userId, $password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        return
            "UPDATE `admin` 
                SET `password`='$password' 
            WHERE id=$userId";
    }
    if (isset($_POST["new-pwrd-1"])) {
        $mydb->query(updatePasswordQuery($_SESSION["userID"], $_POST["new-pwrd-1"]));
    }
    if (isset($_POST["new-username"])) {
        $mydb->query("UPDATE `admin` set `username`='" . $_GET["new-username"] . "'");
    }
    ?>


    <div id="menu">

        
        <form>
            <input type="text" value="true" hidden name="logout">
            <button>Odjavi se sa <?php
                                    if (!isset($_SESSION["username"]))
                                        header("Location: index.php");
                                    echo $_SESSION["username"] ?></button>
        </form>
        <form method="post">
            <input type="text" name="new-admin-username" id="new-admin-username" hidden required>
            <input type="password" name="new-admin-password" id="new-admin-password" hidden minlength="8" required>
            <button id="dodaj-admina">
                Dodaj novog admina
            </button>
        </form>
        <form method="post" id="change-pass">
            <input type="text" name="new-pwrd-1" id="new-pwrd-1" hidden>
            <button id="promeni-pass">
                Promeni šifru
            </button>
        </form>

        <form action="noviUcenikSuzeno.php">
            <button>
                Dodaj novog učenika
            </button>
        </form>

        <form action="../ucenikSuzbijen.php" method="post" id="find-ucenik-form">
            <label for="jmbg">Unesi JMBG učenika kojeg tražite</label>
            <input type="text" name="jmbg" id="find-jmbg" placeholder="JMBG učenika">
            <button id="pronadi-me">Pronađi učenika</button>
        </form>
    </div>

   
    <?php
    include '../admin_files/sections/predmeti.php';

    predmetiU(6);
    predmetiU(7);
    predmetiU(8);
    predmetiU(9);
    ?>


    <?php
    include '../admin_files/sections/smerovi.php';

    ?>


    <form id="change" method="POST">
        <input type="text" id="query" name="query" hidden>
    </form>
    <script src="../admin_files/main.js"></script>

    <script>
        const jmbgFiledForFinding = document.querySelector("#find-jmbg")
        const btnFindMe = document.querySelector("#pronadi-me");
        jmbgFiledForFinding.addEventListener("input", () => {
            
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let message = this.responseText

                    if (message === "false") {
                        btnFindMe.innerText = "Nema takvog JMBG kod nas";
                        btnFindMe.toggleAttribute("disabled", true)
                    
                        btnFindMe.classList.toggle("ok-jmbg", false);

                        document.getElementById("find-form").toggleAttribute("onSubmit='return'", false)

                    } else {
                        btnFindMe.innerText = message;
                        btnFindMe.toggleAttribute("disabled", false)

                        
                        btnFindMe.classList.toggle("ok-jmbg", true);

                        document.getElementById("find-form").toggleAttribute("onSubmit='return'", true)

                    }

                }
            };
            xmlhttp.open("GET", "../searchJMBG.php?q=" + jmbgFiledForFinding.value, true);
            xmlhttp.send();
           
        })

        document.getElementById("dodaj-admina").addEventListener("click", () => {
            document.getElementById("new-admin-username").value = prompt("Korisničko ime novog admina");

            document.getElementById("new-admin-password").value = prompt("Šifra novog admina");
        })


        document.getElementById("promeni-pass").addEventListener("click", (e) => {
                let tryAgain = true;
                while (tryAgain) {
                    document.getElementById("new-pwrd-1").value = prompt("Unesi novu šifru");
                    tryAgain = false;
                }
            }

        )
    </script>
    <?php
    ?>
</body>

</html>

<?php $mydb->close()?>