<?php
require_once 'functAdmin.php';
modele('FAQ');
$ddb = connect();

$req = $ddb->prepare("SELECT * FROM faq");
$req->execute();
$faqs = $req->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $requ = $ddb->prepare("INSERT INTO faq (Question, Reponse) VALUES (?, ?)");
    $requ->execute([isset($_POST['Question']) ? $_POST['Question'] : '', isset($_POST['Reponse']) ? $_POST['Reponse'] : '']);
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
            <h1>FAQ</h1>
            <button onclick="Formulaire()" id="addBlog" class="btn btn-dark m-2">Ajouter FAQ</button>
        </div>
        <div id='btn1'>
            <form action="" method="post" class="mt-3 d-flex justify-content-around" id="form">
                <div>
                    <label for="newblog">Question</label>
                    <input type="text" name="Question" placeholder="Question">
                </div>
                <div>
                    <label for="newblog">Reponse</label>
                    <input type="text" name="Reponse" placeholder="Reponse">
                </div>
                <button type="submit" class="btn btn-outline-warning  m-2">Ajouter</button>
            </form>
        </div>
    </div>
    <div class="row">
        <?php foreach ($faqs as $faq): ?>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= isset($faq['Question']) ? $faq['Question'] : '' ?></h5>
                        <p class="card-text"><?= isset($faq['Reponse']) ? $faq['Reponse'] : '' ?></p>
                    </div>
                    <a href="deletefaq.php?id=<?php echo $faq['id'] ?>" class="btn btn-danger">Supprimer</a>
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