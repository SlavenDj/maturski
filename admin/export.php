<?php
include "../admin_files/conn.php";
include "../admin_files/funs.php";
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename=svi_ucenici.xls');
prikaziTabeluPregledanihUcenika($mydb);
