<?php
function connexpdo($base, $param) {
    // On inclut le fichier qui contient les constantes HOST, USER, PASS
    include_once($param.".inc.php");
    
    $dsn = "mysql:host=".HOST.";dbname=".$base.";charset=UTF8";
    
    try {
        $cnx = new PDO($dsn, USER, PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $cnx;
    } catch(PDOException $except) {
        // En prod, on évite le die() qui peut casser le JSON, on préfère une exception
        throw new Exception('Echec de la connexion : ' . $except->getMessage());
    }
}
?>