<?php
require_once 'functAdmin.php';
modele('delete FAQ');

$conn = connect();

$id = $_GET['id'];

$res = $conn->prepare("DELETE FROM faq WHERE id=?");
$res->execute([$id]);

?>

<section>
    <h2>Supprime avec seccess !</h2>
    <a href="FAQAdmin.php" class="btn btn-success ">Retoure a la page</a>
</section>