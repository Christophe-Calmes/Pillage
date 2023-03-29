<?php
  require 'functions/functionPagination.php';
  require 'functions/functionDateTime.php';
?>
<section>
<?php
// Paramètre de pagination
if(isset($_GET['page']) && (!empty($_GET['page']))) {
  $currentPage = filter($_GET['page']);
} else {
$currentPage = 1;
}
$parPage = 25;
// Déclaration de paramètre vide :
$param = [];
// Recherche des connexions aux sites
$requetteSQL = "SELECT COUNT(`idConnexion`) AS `nbrConnexion` FROM `journaux`";
$nrbC = new RCUD($requetteSQL, $param);
$dataNbrC = $nrbC->READ();
$nbrArticle = $dataNbrC[0]['nbrConnexion'];
// nombre de page total arrondit au chiffre suppérieur.
$pages = ceil($nbrArticle/$parPage);
// Calcul du premier article dans la page.
$premier = ($currentPage * $parPage) - $parPage;
$requetteSQL = "SELECT *
FROM `journaux`
ORDER BY `idConnexion` DESC LIMIT {$premier}, {$parPage}";
$traitement = new RCUD($requetteSQL, $param);
$dataTraiter = $traitement->READ();
$yes = ['Non', 'Oui'];
//print_r($dataTraiter);
 ?>
 <form class="flex-colonne" action="<?php echo encodeRoutage(19); ?>" method="post">
   <button class="buttonForm" type="submit" name="idNav" value="<?=$idNav?>">Vider Journeaux</button>
 </form>
    <table>
      <caption>
        Journaux de connexion des utilisateurs et des visiteurs.
      </caption>
   <tr>
     <th>IdConnexion</th>
     <th>Id User</th>
     <th>login</th>
     <th>Mot de passe hacker</th>
     <th>IP de connexion</th>
     <th>date et heure de connexion</th>
     <th>Connexion réussit ?</th>
   </tr>
   <?php
   foreach ($dataTraiter as $key => $value) {
     $date = $value['dateHeure'];
     echo '<tr>
            <td>'.$value['idConnexion'].'</td>
            <td>'.$value['idUser'].'</td>
            <td>'.$value['login'].'</td>
            <td>'.$value['mdpHacker'].'</td>
            <td>'.$value['ipUser'].'</td>
            <td>'.brassageDate($date).' - heure = '.substr($date,10,6).'</td>
            <td>'.$yes[$value['okConnexion']].'</td>
          </tr>';
   }
    ?>
  </table>
  <br />
  <?php
  for ($page=1; $page <= $pages ; $page++ ) {
    echo '<a class="lienNav" href="index.php?idNav='.$idNav.'&page='.$page.'">'.$page.'</a>';
  }
   ?>

 </section>
