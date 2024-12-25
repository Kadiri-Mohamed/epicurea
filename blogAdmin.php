<?php
require_once 'functAdmin.php';
modele('blog');
$ddb = connect();

$req = $ddb->prepare("SELECT * FROM blogs");
$req->execute();
$blogs = $req->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['newblog']) && !empty($_POST['title'])) {
        $image = $_FILES['image']['name'];
        $requ = $ddb->prepare("INSERT INTO blogs (blog, title, image) VALUES (?, ?, ?)");
        $requ->execute([isset($_POST['newblog']) ? $_POST['newblog'] : '', isset($_POST['title']) ? $_POST['title'] : '', $image]);
    }else {
        echo "All fields are required!";
    }
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
    input[type='file'] {
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

#btn1 {
        display: none;
    }
</style>


<section class="w-100">
    <div class="w-100">
        <div class="d-flex justify-content-around ">
            <h1>Blog</h1>
            <button onclick="Formulaire()" id="addBlog" class="btn btn-dark m-2">Ajouter blog</button>
        </div>
        <div id='btn1'>
            <form action="" method="post" class="mt-3 d-flex justify-content-around" id="form" >
                <div>
                    <label for="newblog">Titre</label>
                    <input type="text" name="title" placeholder="Titre de blog">
                </div>
                <div>
                    <label for="newblog">Blog</label>
                    <input type="text" name="newblog" placeholder="Blog">
                </div>
                <div>
                    <label for="image">image</label>
                    <input type="file" name="image" >
                </div>
                <button type="submit" class="btn btn-warning  m-2">Ajouter</button>
            </form>
        </div>
        <div class="row mb-4 ">
            <?php foreach ($blogs as $blog): ?>
                <div class="col-md-3">
                    <div class="card">
                        <div>
                            <img src="assets/<?= $blog['image'] ?>" class="img-fluid" style="height: 150px;width:100%">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= isset($blog['title']) ? $blog['title'] : '' ?></h5>
                            <p class="card-text"><?= isset($blog['blog']) ? $blog['blog'] : '' ?></p>
                        </div>
                        <a href="deleteBlog.php?id=<?php echo $blog['id'] ?>" class="btn btn-danger">Supprimer</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
    function Formulaire() {
        const ajoutForm = document.getElementById("btn1");
        ajoutForm.style.display = ajoutForm.style.display === "block" ? "none" : "block";
    }
</script>

</body>

</html>