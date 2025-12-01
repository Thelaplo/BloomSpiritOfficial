<?php

    class ModeleTypeTransport
    {

    public function SelectAllTypeTransport()
    {
        	include_once('../connexpdo.inc.php');
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM TypeTransport";
        $requete=$cnx->prepare($reqChaine);
        $result=$requete->execute();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
            {
			echo "<tr>";
			foreach($uneLigne as $valeur)
			{
				echo "<td> $valeur </td>";
			}
			echo "</tr>";
        }
                echo "</table>";
                
        $requete->closeCursor();
        $cnx=null;
    }

}

?>