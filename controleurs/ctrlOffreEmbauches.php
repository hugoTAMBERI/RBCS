<?php
/**
 * Created by PhpStorm.
 * User: nico
 * Date: 18/12/18
 * Time: 08:38
 */

include 'modele/modele.php';
include 'modele/fonctions.php';
$lesOffres = listeDesOffresDembauches($bdd);

include 'vues/vueTopMenu2.php';
echo "<div style='padding-top: 10vh;padding-bottom: 10vh'>";
include "vues/vueOffreEmbauches.php";
echo "</div>";
include 'vues/vueBottomMenu.php';
