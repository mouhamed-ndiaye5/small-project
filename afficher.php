<?php
$conn = mysqli_connect("localhost", "mouhamed", "wampserver!", "db_contact");
if (isset($_GET['supprimer'])){
    $id = (int)$_GET['supprimer'];
    if ($id > 0) {
        $req = "DELETE FROM contacts WHERE id = $id";
        mysqli_query($conn, $req);
        
    }
}
header("Location: liste.php");
        exit;
?>
