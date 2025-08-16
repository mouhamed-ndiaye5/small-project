<?php
if (isset($_GET['modifier'])) {
    $id = (int) $_GET['modifier'];

    // Quand le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['nom1']) && !empty($_POST['prenom1']) && !empty($_POST['phone1']) && !empty($_POST['email1'])) {
            $nom = mysqli_real_escape_string($connect, $_POST['nom1']);
            $prenom = mysqli_real_escape_string($connect, $_POST['prenom1']);
            $phone = mysqli_real_escape_string($connect, $_POST['phone1']);
            $email = mysqli_real_escape_string($connect, $_POST['email1']);

            $R = "UPDATE contacts 
                  SET nom = '$nom', prenom = '$prenom', telephone = '$phone', email = '$email' 
                  WHERE id = $id";
            mysqli_query($connect, $R);

            // Redirection vers la liste pour voir directement la mise à jour
            header("Location: liste.php");
            exit;
        } else {
            echo "Veuillez remplir tous les champs.";
        }
    }

    // Affichage du formulaire (pré-rempli avec les anciennes données)
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
mysqli_close($connect);
?>
