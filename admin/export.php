<?php  
//export.php  
include "../admin_files/conn.php";
$output = '';

    
function oceneIz($db, $id, $razred, $ucenik)
{
    $predmet = $db->query("SELECT ocena FROM ocena WHERE predmet=$id AND razred=$razred AND ucenik=$ucenik");
    $predmet = $predmet->fetch_array();
    return $predmet["ocena"];
}
$idijeviPredmetaZaRacunanje = array(1, 2, 14, 20, 16);
// $output .= "<h1 > Svi učenici u ".date("Y").". godini </h1>";
$output .= "<table class='export'> ";
$output .= '


<thead>
<tr>
<td rowspan="3">Rd. br.</td>
<td rowspan="3">Prezime i ime</td>
<td rowspan="3">Ime oca</td>
<td colspan="5" rowspan="2">Bodovi po uspjehu</td>
<td colspan="11">Bodovi po predmetima</td>
<td rowspan="3">Svega</td>
</tr>
<tr>
<td colspan="2">Srpski</td>
<td colspan="2">Strani j.</td>
<td colspan="2">Matem.</td>
<td colspan="2">Fizika</td>
<td colspan="2">Inform.</td>
<td rowspan="2">Ukupno</td>
</tr>
<tr>
<td>VI</td>
<td>VII</td>
<td>VIII</td>
<td>IX</td>
<td>Ukupno</td>
<td>VIII</td>
<td>IX</td>
<td>VIII</td>
<td>IX</td>
<td>VIII</td>
<td>IX</td>
<td>VIII</td>
<td>IX</td>
<td>VIII</td>
<td>IX</td>
</tr>
</thead>';
$res = $mydb->query("SELECT * FROM ucenik WHERE pregledano=0");
$redniBroj = 0;
while ($row = $res->fetch_array()) {
    $redniBroj++;
    $output .= "<tr>
    <td>
        $redniBroj. 
    </td>
    
    <td>
        {$row["prezime"]} {$row["ime"]} 
    </td>
    <td>
        {$row["ime_oca"]} 
    </td>
    
    ";
    $opstiUpseh = 0;
    $predmeti = 0;
    for ($i = 6; $i <= 9; $i++) {
        $ocene = $mydb->query("SELECT * FROM ocena WHERE ucenik={$row["ID"]} AND razred=$i");
        $prosek = 0;
        $brojPredmeta = 0;
        while ($jednaOcena = $ocene->fetch_array()) {
            $prosek += $jednaOcena["ocena"];
            $brojPredmeta++;

            if (in_array($jednaOcena["predmet"], $idijeviPredmetaZaRacunanje)) {
                // $output .= $idPredmeta. " ";
                if ($i >= 8) {
                    $predmeti += $jednaOcena["ocena"] / 5.0 * 2;
                }
            }
        }
        if ($brojPredmeta) {

            $output .= " <td>" . round($prosek / $brojPredmeta, 2) . "</td>";

            if ($i <= 7)
                $opstiUpseh += $prosek / $brojPredmeta  * 2;
            else
                $opstiUpseh += $prosek / $brojPredmeta  * 3;
        }
    }
    $output .= " <td>" . round($opstiUpseh, 2) . "</td>";



    $output .= "<td>" . oceneIz($mydb, 14, 8, $row["ID"]) . "</td>"; //srpski 
    $output .= "<td>" . oceneIz($mydb, 14, 9, $row["ID"]) . "</td>"; //srpski 

    $output .= "<td>" . oceneIz($mydb, 16, 8, $row["ID"]) . "</td>"; //eng 
    $output .= "<td>" . oceneIz($mydb, 16, 9, $row["ID"]) . "</td>"; //eng 
    
    $output .= "<td>" . oceneIz($mydb, 1, 8, $row["ID"]) . "</td>"; //matematika 
    $output .= "<td>" . oceneIz($mydb, 1, 9, $row["ID"]) . "</td>"; //matematika 

    $output .= "<td>" . oceneIz($mydb, 2, 8, $row["ID"]) . "</td>"; //fizika 
    $output .= "<td>" . oceneIz($mydb, 2, 9, $row["ID"]) . "</td>"; 

    $output .= "<td>" . oceneIz($mydb, 20, 8, $row["ID"]) . "</td>"; //informatika 
    $output .= "<td>" . oceneIz($mydb, 20, 9, $row["ID"]) . "</td>";  
    

    $output .= " <td>" . round($predmeti, 2) . "</td>";
    
    $output .= " <td>" . round($predmeti + $opstiUpseh, 2) . "</td>";


}


$output .= "</table> ";
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
 echo $output;
