<?php
require_once 'functions.php';
modele('FAQ', 'blog.css');
$ddb = connect();
$req = $ddb->prepare("SELECT * FROM faq");
$req->execute();
$faqs = $req->fetchAll(PDO::FETCH_ASSOC);

?>

<style>
    input[type='text'] {
        margin: 10px;
        border-radius: 10px;
        border: none;
        padding: 10px;
        font-family: 'Rubik', sans-serif;
    }

    input[type='submit'] {
        margin: 10px;
        background-color: #87A922;
        color: white;
        border-radius: 10px;
        border: none;
        padding: 10px;
        font-family: 'Rubik', sans-serif;
    }

    .blog-card {
        margin-bottom: 20px;
    }

    .Commentaires {
        display: none;

    }
</style>
<main class="container pt-2">

    <section class="w-100">

        <div class="w-100">
            <div class="d-flex justify-content-between">
                <h1>FAQ</h1>
            </div>
            <div class="row">
                <?php $count = 0; ?>
                <?php foreach ($faqs as $faq): ?>
                    <div class="col-md-12 col-12">
                        <h3><?= $faq['Question'] ?></h5>
                        <p ><Strong><?= $faq['Reponse'] ?></Strong></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </section>

    <?php
    footer()
        ?>