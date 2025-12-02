<?php
include_once('Modeles/ModeleEtape.php');
include_once('Modeles/ModeleCategorieExcursion.php');
include_once('Modeles/ModeleExcursion.php');
include_once('Modeles/ModeleHebergement.php');
include_once('Modeles/ModeleLieu.php');
include_once('Modeles/ModeleTypeLieu.php');
include_once('Modeles/ModeleTypeTransport.php');
ModeleEtape::SelectAllEtape();
ModeleCategorieExcursion::SelectAllCategorieExcursion();
ModeleExcursion::SelectAllExcursion();
ModeleHebergement::SelectAllHebergement();
ModeleLieu::SelectAllLieu();
ModeleTypeLieu::SelectAllTypeLieu();
ModeleTypeTransport::SelectAllTypeTransport();
ModeleCategorieExcursion::UpdateCategorieExcursion('1', 'AHHHHHHHHHHHHHHHHHHHH');
?>