<?php
require_once 'functAdmin.php';
modele('delete user');

$conn = connect();

$id = $_GET['id'];

$res = $conn->prepare("DELETE FROM utilisateurs WHERE id=?");
$res->execute([$id]);

?>

<section>
    <h2>Supprime avec seccess !</h2>
    <a href="utilisateursAdmin.php" class="btn btn-success ">Retoure a la page</a>
</section>