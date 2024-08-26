<?php
require_once 'functAdmin.php';
modele('blog');
$ddb = connect();
$req = $ddb->prepare("SELECT * FROM blogs");
$req->execute();
$blogs = $req->fetchAll(PDO::FETCH_ASSOC);

$requ = $ddb->prepare("SELECT * FROM recettes");
$requ->execute();
$recettes = $requ->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['newcomment'])) {
    $comment = $_POST['newcomment'];
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    $blog_id = $_POST['blog_id']; 
    $req = $ddb->prepare("INSERT INTO commentaires (id_blog, utilisateur, commentaire) VALUES (?, ?, ?)");
    $req->execute([$blog_id, $username, $comment]);
}
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
    .hidden {
  opacity: 0;
  filter:  blur(5px);
  transform: translateY(150px);
  transition: all 1s;
}
.show {
  opacity: 1;
  filter:  blur(0);
  transform: translateY(0);}
</style>

<section class="w-100">

    <div class="w-100">
        <div class="d-flex justify-content-around">
            <h1>Gestion des commentaires des Blog</h1>
        </div>

        <h3>Pour blogs</h3>
        <div class="row">
            <?php $count = 0; ?>
            <?php foreach ($blogs as $blog): ?>
                <div class="col-md-3">
                    <div class="card blog-card">
                        <div>
                            <img src="assets/<?= $blog['image'] ?>" class="img-fluid" style="height: 100px;width:100%">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $blog['title'] ?></h5>
                            <p class="card-text"><?= $blog['blog'] ?></p>
                            <?php
                            $req = $ddb->prepare("SELECT * FROM commentaires WHERE id_blog = ?");
                            $req->execute([$blog['id']]);
                            $comments = $req->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <button onclick="afficher(<?= $blog['id'] ?>)" class="btn btn-secondary"
                                id="btn<?= $blog['id'] ?>">Afficher</button>
                            <div class="mt-3 Commentaires" id="Commentaires<?= $blog['id'] ?>">
                                <h5>Commentaires</h5>
                                <?php
                                foreach ($comments as $comment):
                                    ?>
                                    <div class="card mt-2">
                                        <div class="card-body">
                                            <h6 class="card-title mb-2 text-muted">
                                                <?= isset($comment['utilisateur']) ? $comment['utilisateur'] : 'inconnu' ?>
                                            </h6>
                                            <p class="card-text">
                                                <?= isset($comment['commentaire']) ? $comment['commentaire'] : '' ?>
                                            </p>
                                        </div>
                                        <a href="deleteComment.php?id=<?php echo $comment['id'] ?>"
                                            class="btn btn-danger">Supprimer</a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $count++; ?>
                <?php if ($count % 4 == 0): ?>
                </div>
                <div class="row">
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <h3>Pour recettes</h3>
    <div class="row ">
        <?php foreach ($recettes as $recette): ?>
            <div class="col-md-3 hidden">
                <div class="card blog-card">
                    <div class="card-body">
                        <div class="w-50">
                            <img src="assets/<?php echo $recette['image'] ?>" class="img-fluid"
                                style="width: 80px; height: 80px;">
                        </div>
                        <h5 class="card-title"><?= $recette['titre'] ?></h5>
                        <p class="card-text"><?= $recette['continent'] ?></p>
                        <?php
                        $req = $ddb->prepare("SELECT * FROM commentaires_recette WHERE id_recette = ?");
                        $req->execute([$recette['id']]);
                        $comments = $req->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <button onclick="afficher1(<?= $recette['id'] ?>)" class="btn btn-secondary"
                            id="btn<?= $recette['id'] ?>">Afficher</button>
                        <div class="mt-3 Commentaires" id="Commentaires<?= $recette['id'] ?>">
                            <h5>Commentaires</h5>
                            <?php foreach ($comments as $comment): ?>
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <h6 class="card-title mb-2 text-muted">
                                            <?= isset($comment['utilisateur']) ? $comment['utilisateur'] : 'inconnu' ?>
                                        </h6>
                                        <p class="card-text">
                                            <?= isset($comment['commentaire']) ? $comment['commentaire'] : '' ?>
                                        </p>
                                    </div>
                                    <a href="deleteComment.php?id=<?php echo $comment['id'] ?>"
                                        class="btn btn-danger">Supprimer</a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</section>

<script>
    function afficher(blogId) {
        const Commentaires = document.getElementById("Commentaires" + blogId);
        Commentaires.style.display = Commentaires.style.display === "block" ? "none" : "block";
    }
    function afficher1(recetteId) {
        const Commentaires = document.getElementById("Commentaires" + recetteId); 
        Commentaires.style.display = Commentaires.style.display === "block" ? "none" : "block";
    }
    window.addEventListener('scroll', reveal);

    function reveal() {
        var reveals = document.querySelectorAll('.hidden');

        for (var i = 0; i < reveals.length; i++) {
            var wndowheight = window.innerHeight;
            var revealtop = reveals[i].getBoundingClientRect().top;
            var revealpoint = 150;

            if (revealtop < wndowheight - revealpoint) {
                reveals[i].classList.add('show');
            } else {
                reveals[i].classList.remove('show');
            }
        }
    }

</script>