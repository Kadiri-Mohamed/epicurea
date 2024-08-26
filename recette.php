<?php
require_once "functions.php";
modele('recette', 'recette.css');
$id = $_GET['id'];
$ddb = connect();

$req = $ddb->prepare("SELECT * FROM recettes WHERE id = ?");
$req->execute(array($id));
$recette = $req->fetch();

$requ = $ddb->prepare("SELECT c.* FROM commentaires_recette c LEFT JOIN recettes r ON r.id = c.id_recette WHERE r.id = ? limit 3");
$requ->execute([$id]);
$comments = $requ->fetchAll(PDO::FETCH_ASSOC);


function numb_fav($id)
{
    $bdd = connect();
    $req = $bdd->prepare("SELECT COUNT(favorites.recette) AS fav_count FROM favorites LEFT JOIN recettes ON favorites.recette = recettes.id WHERE recettes.id = ?");
    $req->execute([$id]);
    $result = $req->fetch(PDO::FETCH_ASSOC);
    return $result['fav_count'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['newcomment'])) {
    $comment = $_POST['newcomment'];
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    $recette_id = $_POST['recette_id'];
    
    // Ajout du commentaire dans la table commentaires_recette
    $req = $ddb->prepare("INSERT INTO commentaires_recette (id_recette, utilisateur, commentaire) VALUES (?, ?, ?)");
    $req->execute([$recette_id, $username, $comment]);
}

// Traitement de l'ajout aux favoris
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['recette'])) {
    $recette_id = $_POST['recette'];
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    
    // Vérification de l'existence de la recette avant de l'ajouter aux favoris
    $req_check = $ddb->prepare("SELECT * FROM recettes WHERE id = ?");
    $req_check->execute([$recette_id]);
    $recette_exists = $req_check->fetch(PDO::FETCH_ASSOC);
    
    if ($recette_exists) {
        // Ajout aux favoris seulement si la recette existe
        $requ = $ddb->prepare("INSERT INTO favorites (recette, username) VALUES (?, ?)");
        $requ->execute([$recette_id, $username]);
    }
}
?>

<main class="container pt-2">

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row  ">
                        <div class="col d-flex justify-content-center">
                            <h1><?php echo $recette['titre'] ?></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-center">
                            <img src="assets/<?php echo $recette['image'] ?>" class="img-fluid">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-center align-items-md-center flex-column  mt-2 ">
                            <form action="" method="post">
                                <input type="hidden" name="recette" value="<?php echo $recette['id'] ?>">
                                <button type="submit" class=" bg-transparent border-0"><i class="fa-regular fa-heart" style="color: #ff0000;"></i></button>
                            </form>
                            
                            <div>
                                <h6>Nombre des personnes aiment cette recette: <?php echo numb_fav($recette['id']) ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                <div class="row">
                        <div class="col d-flex justify-content-center flex-column ">
                            <h3>Categorie</h3>
                            <p><?php echo $recette['categorie'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-center flex-column ">
                            <h3>Description</h3>
                            <p><?php echo $recette['description'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-center flex-column ">
                            <h3>Ingrédients</h3>
                            <p><?php echo $recette['ingredients'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-center flex-column ">
                            <h3>Instructions</h3>
                            <p><?php echo $recette['instructions'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <form method="POST">
                        <div class="form-group contact_form">
                            <input type="hidden" name="recette_id" value="<?= $recette['id'] ?>">
                            <textarea class="form-control" name="newcomment" placeholder="Votre commentaire" rows="6"></textarea>
                        </div>
                        <button type="submit" class="button button-contactForm btn_4 boxed-btn">Ajouter commentaire</button>
                    </form>
                </div>
                <div class="col-md-4">
                            <h3>Commentaires</h3>
                            <?php foreach ($comments as $comment): ?>
                                <div class="row">
                                    <div class="col d-flex justify-content-center flex-column ">
                                        <h4><strong><?php echo $comment['utilisateur'] ?></strong></h4>
                                        <p><?php echo $comment['commentaire'] ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                </div>
            </div>

        </div>
    </section>