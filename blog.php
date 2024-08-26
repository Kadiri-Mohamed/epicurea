<?php
require_once 'functions.php';
modele('blog', 'update');
$conn = connect();

$req = $conn->prepare("SELECT * FROM blogs");
$req->execute();
$blogs = $req->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container pt-2 mb-5">
    <section class="w-100">
        <div class="w-100">
            <div class="d-flex justify-content-between">
                <h1>Blog</h1>
            </div>
            <div class="row">
                <?php foreach ($blogs as $blog): ?>
                    <div class="col-md-3">
                        <div class="card blog-card">
                            <div class="card-body">
                                <h5 class="card-title"><a href="blog_details.php?id=<?= $blog['id'] ?>"><?= $blog['title'] ?></a></h5>
                                <div>
                                    <img src="assets/<?= $blog['image'] ?>" class="img-fluid" style="height: 100px;width:100%">
                                </div>
                                <p class="card-text"><?= $blog['blog'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php footer() ?>
