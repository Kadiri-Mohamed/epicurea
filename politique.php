<?php
require_once 'functions.php';
modele('politique', 'politique.css');
$ddb = connect();
$req = $ddb->prepare("SELECT * FROM politique");
$req->execute();
$politique= $req->fetchAll(PDO::FETCH_ASSOC);

?>
<style>
    footer{
        position: fixed;
        bottom: 0;
        width: 100%;
    }
</style><main class="container pt-2">

<h1>Politique de confidentialité et Mentions légales</h1>
<?php 
    foreach ($politique as $pol) {  

 ?>
<section>
    <h2>
        <?php echo $pol['titre'] ?>
    </h2>
    <p>
        <?php echo $pol['text'] ?>
    </p>
</section>
<?php } ?>
</main>

</body>
<?php
    footer()
        ?>

</html>

