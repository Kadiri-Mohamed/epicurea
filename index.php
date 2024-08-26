<?php
require_once "functions.php";
modele('acceuil', 'accueil.css');
function select_continent($var1)
{
    $bdd = connect();
    $req = $bdd->prepare("SELECT * FROM recettes where continent = ? limit 4");
    $req->execute([$var1]);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
function select_last()
{
    $bdd = connect();
    $req = $bdd->prepare("SELECT * FROM recettes ORDER BY time DESC LIMIT 3");
    $req->execute([]);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function select_random()
{
    $bdd = connect();
    $req = $bdd->prepare("SELECT * FROM recettes ORDER BY RAND() LIMIT 6");
    $req->execute([]);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function select_fav()
{
    $bdd = connect();
    $req = $bdd->prepare("SELECT recettes.*, COUNT(favorites.recette) AS fav_count FROM recettes right JOIN favorites ON favorites.recette = recettes.id GROUP BY recettes.id ORDER BY fav_count DESC limit 4;
    ");
    $req->execute();
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function numb_fav($id)
{
    $bdd = connect();
    $req = $bdd->prepare("SELECT COUNT(favorites.recette) AS fav_count FROM favorites LEFT JOIN recettes ON favorites.recette = recettes.id WHERE recettes.id = ?");
    $req->execute([$id]);
    $result = $req->fetch(PDO::FETCH_ASSOC);
    return $result['fav_count'];
}


?>
<style>
    .header-area {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
    }

    .header-area .main-header-area {
        background: #fff;
        background: transparent;
    }
</style>
<div class="slider_area">
    <div class="single_slider  d-flex align-items-center slider_bg_1">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-8 ">
                    <div class="slider_text text-center">
                        <div class="text">
                            <h3>
                                Vous pouvez touver les meuillieurs recettes ici
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider_area_end -->
</section>
<main class="container pt-2">

    <section class=' container section2 gap-3'>
        <div class="row mb-4">
            <div class="col d-flex align-items-center justify-content-center  ">
                <h2 class="text-center ">
                    Recettees suggerees :
                </h2>

            </div>
        </div>
        <div class="row hidden ">
            <div class="col d-flex justify-content-center">
                <div class="slider-container ">
                    <div class="slider-content ">
                        <?php

                        foreach (select_random() as $recette) {
                            ?>
                            <div class="slider-single">
                                <a href="recette.php?id=<?php echo $recette['id'] ?>">
                                    <img class="slider-single-image" src="assets/<?php echo $recette['image'] ?>" alt="1" />
                                    <h1 class="slider-single-title"><?php echo $recette['titre'] ?></h1>
                                    <a class="slider-single-likes" href="javascript:void(0);">
                                        <i class="fa fa-heart"></i>
                                        <p><?php echo numb_fav($recette['id']) ?></p>
                                    </a>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="container mt-5 ">
        <div class="row">
            <div class="col">
                <h2 class="text-center mt-5">Les nouvelles recettes</h2>
            </div>
        </div>
        <div class="recepie_area hidden">
            <div class="row">
                <?php

                foreach (select_last() as $recette) {
                    ?>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-12">
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
            </div>
        </div>
    </section>

    <section class="container ">
        <div class="row">
            <div class="col">
                <h2 class="text-center mt-5">Les meilleurs recettes</h2>
            </div>
        </div>
        <div class="recepie_area">
            <div class="row hidden">
                <?php
                foreach (select_fav() as $recette) {
                    ?>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                        <div class="single_recepie text-center">
                            <div class="recepie_thumb"
                                style="background-image: url(assets/<?php echo $recette['image'] ?>);height:150px ; width:150px; background-position: center;background-size: cover;background-repeat: no-repeat;">
                            </div>
                            <h3><?php echo $recette['titre'] ?></h3>
                            <span></span>
                            <p><?php echo $recette['continent'] ?></p>
                            <a href="recette.php?id=<?php echo $recette['id'] ?>" class="line_btn">View Full Recipe</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <section class="container ">
        <div class="row">
            <div class="col">
                <h2 class="text-center mt-5">Les recettes par continents</h2>
            </div>
        </div>
        <div class="row mt-3 ">
            <div class="row">
                <div class="col">
                    <h3>Afriqua</h3>
                </div>
            </div>
            <div class="recepie_area row hidden">
                    <?php
                    foreach (select_continent('afriqua') as $recette) {
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
                    <a href="continent.php?continent=<?php echo $recette['continent'] ?>" class="float-end more">more
                        &rightarrow;</a>
            </div>
        </div>
        <div class="row mt-3 ">
            <div class="row">
                <div class="col">
                    <h3>Europe</h3>
                </div>
            </div>
            <div class="recepie_area">
                <div class="row hidden">
                    <?php
                    foreach (select_continent('europe') as $recette) {
                        ?>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                            <div class="single_recepie text-center">
                                <div class="recepie_thumb"
                                    style="background-image: url(assets/<?php echo $recette['image'] ?>); height:150px; background-position: center;background-size: cover;background-repeat: no-repeat; ">
                                </div>
                                <h3><?php echo $recette['titre'] ?></h3>
                                <span></span>
                                <p><?php echo $recette['continent'] ?></p>
                                <a href="recette.php?id=<?php echo $recette['id'] ?>" class="line_btn">View Full Recipe</a>
                            </div>
                        </div>
                    <?php } ?>
                    <a href="continent.php?continent=<?php echo $recette['continent'] ?>" class="float-end more">more
                        &rightarrow;</a>
                </div>
            </div>
        </div>
        <div class="row mt-3 ">
            <div class="row">
                <div class="col">
                    <h3>Asia</h3>
                </div>
            </div>
            <div class="recepie_area">
                <div class="row hidden">
                    <?php
                    foreach (select_continent('asia') as $recette) {
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
                    <a href="continent.php?continent=<?php echo $recette['continent'] ?>" class="float-end more">more
                        &rightarrow;</a>
                </div>
            </div>
        </div>

        <div class="row mt-3 ">
            <div class="row">
                <div class="col">
                    <h3>America</h3>
                </div>
            </div>
            <div class="recepie_area">
                <div class="row hidden">    
                    <?php
                    foreach (select_continent('america') as $recette) {
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
                    <a href="continent.php?continent=<?php echo $recette['continent'] ?>" class="float-end more">more
                        &rightarrow;</a>
                </div>
            </div>
        </div>
        <div class="row mt-3 ">
            <div class="row">
                <div class="col">
                    <h3>Australia</h3>
                </div>
            </div>
            <div class="recepie_area">
                <div class="row hidden">
                    <?php
                    foreach (select_continent('Australia') as $recette) {
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
                    <a href="continent.php?continent=<?php echo $recette['continent'] ?>" class="float-end more">more
                        &rightarrow;</a>
                </div>
            </div>
        </div>
    </section>
    <button onclick="scrollToTop()" class="fortop">&UpArrow;</button>

    <script>
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        window.addEventListener('scroll',reveal);

        function reveal(){
            var reveals =document.querySelectorAll('.hidden');

            for(var i=0; i<reveals.length; i++){
                var wndowheight =window.innerHeight;
                var revealtop = reveals[i].getBoundingClientRect().top;
                var revealpoint = 150;

                if(revealtop < wndowheight - revealpoint){
                    reveals[i].classList.add('show');
                } else{
                    reveals[i].classList.remove('show');
                }
            }
        }

    </script>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="./js/accueil.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <?php
    footer()
        ?>