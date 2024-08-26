<?php
require_once 'functAdmin.php';
modele('Politique');
$ddb = connect();

$req = $ddb->prepare("SELECT * FROM politique");
$req->execute();
$politiques = $req->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $requ = $ddb->prepare("INSERT INTO politique (titre, text) VALUES (?, ?)");
    $requ->execute([isset($_POST['titre']) ? $_POST['titre'] : '', isset($_POST['text']) ? $_POST['text'] : '']);
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

    #btn1 {
        display: none;
    }
</style>
<section class="w-100">
    <div class="w-100">
        <div class="d-flex justify-content-around ">
            <h1>Politiques</h1>
            <button onclick="Formulaire()" id="addBlog" class="btn btn-dark m-2">Ajouter un article</button>
        </div>
        <div id='btn1'>
            <form action="" method="post" class="mt-3 d-flex justify-content-around" id="form">
                <div>
                    <label for="newblog">titre</label>
                    <input type="text" name="titre" placeholder="titre">
                </div>
                <div>
                    <label for="newblog">Votre text</label>
                    <input type="text" name="text" placeholder="text">
                </div>
                <button type="submit" class="btn btn-warning  m-2">Envoyer</button>
            </form>
        </div>
        <div class="row">
            <?php foreach ($politiques as $politique): ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= isset($politique['titre']) ? $politique['titre'] : '' ?></h5>
                            <p class="card-text"><?= isset($politique['text']) ? $politique['text'] : '' ?></p>
                        </div>
                        <a href="updatePloitique.php?id=<?php echo $politique['id'] ?>" class="btn btn-outline-success ">Update</a>
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