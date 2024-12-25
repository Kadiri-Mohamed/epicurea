<?php
require_once 'functions.php';
modele('blog details', '');
$conn = connect();

$blog_id = isset($_GET['id']) ? $_GET['id'] : null;
if ($blog_id === null) {
    exit("ID du blog non fourni");
}

$req = $conn->prepare("SELECT * FROM blogs WHERE id = ?");
$req->execute([$blog_id]);
$blog = $req->fetch();

$req_comments = $conn->prepare("SELECT utilisateur, commentaire FROM commentaires WHERE id_blog = ?");
$req_comments->execute([$blog_id]);
$comments = $req_comments->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['newcomment'])) {
    $comment = $_POST['newcomment'];
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    $req = $conn->prepare("INSERT INTO commentaires (id_blog, utilisateur, commentaire) VALUES (?, ?, ?)");
    $req->execute([$blog_id, $username, $comment]);
    
}

?>
<div class="container mt-3">
    <h1><?= $blog['title'] ?></h1>
    <div>
        <img src="assets/<?= $blog['image'] ?>" class="img-fluid" style="height: 200px;width:30%">
    </div>
    <p><?= $blog['blog'] ?></p>
</div>
<div class="container">
    <h3>Ajouter un commentaire</h3>
    <form method="POST">
        <div class="form-group">
            <textarea class="form-control" name="newcomment" placeholder="Votre commentaire"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter commentaire</button>
    </form>
</div>

<div class="container mb-5">
    <h3>Commentaires</h3>
    <?php foreach ($comments as $comment): ?>
        <div class="card">
            <div class="card-body">
                <h6 class="card-title mb-2 text-muted"><?= isset($comment['utilisateur']) ? $comment['utilisateur'] : 'Inconnu' ?></h6>
                <p class="card-text"><?= isset($comment['commentaire']) ? $comment['commentaire'] : '' ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<?php footer() ?>
