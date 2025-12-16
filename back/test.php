<?php
include_once('Modeles/ModeleEtape.php');
include_once('Modeles/ModeleCategorieExcursion.php');
include_once('Modeles/ModeleExcursion.php');
include_once('Modeles/ModeleHebergement.php');
include_once('Modeles/ModeleLieu.php');
include_once('Modeles/ModeleTypeLieu.php');
include_once('Modeles/ModeleTypeTransport.php');
print_r (ModeleEtape::SelectAll());
print_r (ModeleCategorieExcursion::SelectAll());
print_r (ModeleExcursion::SelectAll());
print_r (ModeleHebergement::SelectAll());
print_r (ModeleLieu::SelectAll());
print_r (ModeleTypeLieu::SelectAll());
print_r (ModeleTypeTransport::SelectAll());
?>