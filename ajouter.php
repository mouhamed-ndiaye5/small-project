<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <form action="" method="post">
NOM : <input type="text" name="nom"> <br><br>
PRENOM : <input type="text" name="prenom"> <br><br>
TELEPHONE : <input type="number" name="telephone"><br><br> 
EMAIL : <input type="email" name="email"> <br><br>
 <button type="submit">Ajouter aux contacts</button>
     </form>
     <?php
     $connect= mysqli_connect("localhost", "mouhamed", "wampserver!", "db_contact");
    if (!empty($_POST['nom'])||!empty($_POST['prenom'])||!empty($_POST['telephone'])||!empty($_POST['email'])){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];
        $sql = "SELECT * FROM contacts WHERE email = ? ";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
       $result= $stmt->get_result();
        if ($result->num_rows > 0){
        echo "Desolé l'email que vous avez entrez a déja été enregisté";
        }
        $req = "INSERT INTO contacts(nom, prenom, telephone, email) VALUES ('$nom','$prenom','$telephone','$email')";
     mysqli_query($connect, $req);
    }
    if (empty($_POST['nom'])||empty($_POST['prenom'])||empty($_POST['telephone'])||empty($_POST['email'])){
        echo "Veuillez remplir tous les champs svp";
    }
     
     ?>
</body>
</html>