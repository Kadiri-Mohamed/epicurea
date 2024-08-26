<?php
require_once 'functAdmin.php';
modele('delete Blog');

$conn = connect();

$id = $_GET['id'];

$res = $conn->prepare("DELETE FROM blogs WHERE id=?");
$res->execute([$id]);

?>

<section>
    <h2>Supprime avec seccess !</h2>
    <a href="blogAdmin.php" class="btn btn-success ">Retoure a la page</a>
</section>