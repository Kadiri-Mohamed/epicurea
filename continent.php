<?php
require_once 'functions.php';
$continent = $_GET['continent'];
modele('continents', '');

$bdd = connect();
$req = $bdd->prepare("SELECT * FROM recettes where continent = ?");
$req->execute([$continent]);
$result = $req->fetchAll(PDO::FETCH_ASSOC);

?>
<style>
    .section1 img {
        width: 900px;
        height: 80px;
    }
</style>
<main class="container pt-2">

    <h1>Recettes de <?php echo $continent ?></h1>
    <section class="section1 p-3 ">
        <div class="recepie_area row hidden">
            <?php
            foreach ($result as $recette) {
                ?>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="single_recepie text-center">
                        <div class="recepie_thumb"
                            style="background-image: url(assets/<?php echo $recette['image'] ?>);height:150px ; background-position: center;background-size: cover;background-repeat: no-repeat;">
                        </div>
                        <h3><?php echo $recette['titre'] ?></h3>
                        <span></span>
                        <p><?php echo $recette['continent'] ?></p>
                        <a href="recette.php?id=<?php echo $recette['id'] ?>" class="line_btn">View Full Recipe</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <?php
    footer()
        ?>