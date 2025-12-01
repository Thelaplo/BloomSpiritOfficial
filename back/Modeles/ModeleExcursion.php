<?php

    class ModeleExcursion
    {

    public function SelectAllExcursion()
    {
        	include_once('../connexpdo.inc.php');
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM Excursion";
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