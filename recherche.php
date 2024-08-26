<?php
require_once 'functions.php';
modele('recherche', 'recherche.css');

$conn = connect();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = isset($_REQUEST['titre']) ? $_REQUEST['titre'] : '';
    $result = $conn->prepare("SELECT * FROM recettes WHERE titre LIKE CONCAT('%', ?, '%') OR ingredients LIKE CONCAT('%', ?, '%') OR categorie LIKE CONCAT('%', ?, '%')");
    $result->execute([$titre, $titre ,$titre]);
    $recettes = $result->fetchAll(PDO::FETCH_ASSOC);
}



?>
<style>
    input[type='text']{
        margin: 10px;
        border-radius: 10px;
        border: none;
        padding: 10px;
        font-family: 'Rubik', sans-serif;
    }
    input[type='submit']{
        margin: 10px;
        background-color: #87A922;
        color: white;
        border-radius: 10px;
        border: none;
        padding: 10px;
        font-family: 'Rubik', sans-serif;
    }
</style><main class="container pt-2">

<section class="container">
    <form action="" method="POST" class=" d-flex justify-content-center ">
        <input type="text" name="titre" placeholder="Titre de recette">
        <input type="submit">
    </form>
        <div class="recepie_area">
            <div class="row">
                <?php
                foreach (isset($recettes)?$recettes:[] as $recette) {
                    ?>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="single_recepie text-center">
                            <div class="recepie_thumb"
                                style="background-image: url(assets/<?php echo $recette['image'] ?>); background-position: center;background-size: cover;background-repeat: no-repeat; height:150px ; width:150px;">
                            </div>
                            <h3><?php echo $recette['titre'] ?></h3>
                            <span></span>
                            <p><?php echo $recette['continent'] ?></p>
                            <a href="recette.php?id=<?php echo $recette['id'] ?>" class="line_btn">View Full Recipe</a>
                        </div>
                    </div>
                <?php } ?>
</section>
