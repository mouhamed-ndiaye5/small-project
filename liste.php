<?php
// Connexion à la base de données
$host = "localhost";
$user = "mouhamed";
$password = "wampserver!";
$database = "db_contact";
$connect = mysqli_connect($host, $user, $password, $database);
$sql="SELECT * FROM contacts ORDER BY date_ajout ASC";
$resultat= mysqli_query($connect,$sql);
?>
<table>
    
<tr>
    <th>ID</th>
    <th>nom</th>
    <th>prenom</th>
    <th>telephone</th>
    <th>email</th>
    <th>date d'ajout</th>
     <th>action</th>
</tr>
<tr>
    
        <?php while ($line = mysqli_fetch_assoc($resultat)) :?>
    <td><?=$line['id']?></td>
    <td><?=$line['nom']?></td>
    <td><?=$line['prenom']?></td>
    <td><?=$line['telephone']?></td>
    <td><?=$line['email']?></td>
    <td><?=$line['date_ajout']?></td>
  
    <td><a href="afficher.php?supprimer=<?=$line['id']?>"> <button type="submit" name="supprimer" style = "background-color: red;padding: 5px 10px;border: none;color: white;" classe="supprimer">Supprimer</button></a>
    <a href="liste.php?modifier=<?=$line['id']?>"> <button type="submit" name="modifier" style = "background-color: green;padding: 5px 10px;border: none;color: white;" classe="modifier">Modifier</button></a></td>
</tr>
<?php endwhile;
;?>
 
</table>
<style>
        th, td{border: 2px solid; padding: 10px; text-align: center;}
        table{border-collapse: collapse;} .supprimer:hover{background-color: darkred; padding: 5px 10px; border: none; color: white;}
    </style>
   
  <?php if (isset($_GET['modifier'])): $id = (int)$_GET['modifier'];  
 ?> 
   
    <?php  if ($id > 0) { if ((!empty($_POST['nom1'])) && (!empty($_POST['prenom1'])) && (!empty($_POST['phone1']))&& (!empty($_POST['email1']))){
        $R = "UPDATE contacts SET nom = '$_POST[nom1]' , prenom= '$_POST[prenom1]' , telephone= '$_POST[phone1]' , email= '$_POST[email1]' WHERE id = $id "; mysqli_query($connect, $R);
        header("Location: liste.php");
        exit;
    }  else {echo "Entrez des valeurs pour modifier les donneés de la table"; } 
     $result = mysqli_query($connect, "SELECT * FROM contacts WHERE id = $id");
    $contact = mysqli_fetch_assoc($result);
    ?>

    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $contact['id'] ?>">
        NOM : <input type="text" name="nom1" value="<?= htmlspecialchars($contact['nom']) ?>"> <br><br>
        PRENOM : <input type="text" name="prenom1" value="<?= htmlspecialchars($contact['prenom']) ?>"> <br><br>
        TELEPHONE : <input type="number" name="phone1" value="<?= htmlspecialchars($contact['telephone']) ?>"><br><br>
        EMAIL : <input type="email" name="email1" value="<?= htmlspecialchars($contact['email']) ?>"> <br><br>
        <button type="submit">Modifier le contact</button>
    </form>
     <?php
    } 
endif;

 mysqli_close($connect); ?>