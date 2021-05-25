<?php
require("Mysql.class.php"); //on inclue ici la class
$sql = new Mysql("localhost", "root", "", "ensat", "1", "désolé un problème est survenu"); //creation de l'objet mysql
$sql->requete("SELECT * FROM eleve", "0"); //on execute une requete simple
echo "<center><h1>Liste des élèves de GINF1</h1></center>";
echo "<table border=1 align=center>";
while($info = $sql->resultat(0)) //afin d'affiche les résultats de cette requete on utlise une boucle while
{
echo "<tr>";
echo "<td>".$info['CodeAppogé']."</td>"; 
echo "<td>".$info['Nom']."</td>"; ; //on affiche les donnée du champ log de mysql
echo "<td>".$info['Prenom']."</td>"; ;
echo "</tr>"; 
}
echo "</table>";
$nb = $sql->nb_resultat(0); //on assigne a nb le nombre de résultat trouvé
echo $nb; //on affiche le nombre de résultat trouvé
echo $sql->nb_requete ."<br/>"; //on affiche le nombre de requetes utilisées, dans notre cas une seul donc 1
?>