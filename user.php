<?php
require_once "functions.php";
modele('user', 'user.css');
$bdd = connect();
$req = $bdd->prepare("SELECT * FROM utilisateurs WHERE username = ?");
$req->execute([$_SESSION['username']]);
$user = $req->fetch();

function select_fav()
{
    $bdd = connect();
    $req = $bdd->prepare("SELECT * FROM favorites LEFT JOIN recettes ON favorites.recette = recettes.id WHERE username = ?");
    $req->execute([$_SESSION['username']]);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach (select_fav() as $recette) {
        if (isset($_POST['delete_' . $recette['id']])) {
            $res = $bdd->prepare("DELETE FROM favorites WHERE recette = ?");
            $res->execute([$recette['id']]);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Profil</title>
    <link rel="stylesheet" href="user.css">
    <style>
        .cards {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .cards img {
            width: 200px !important;
            height: 200px !important;
        }

        .card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: start;
            justify-content: center;
            padding: 5px;
        }

        .btn-deco {
            color: #fff;
            background: #f44a40;
            border: 1px solid transparent;
            border-radius: 20px;
            padding: 10px 30px;
            text-align: center;
            text-decoration: none;
        }

        .btn-deco:hover {
            background: #f44a40;
            color: #fff;
        }

        .btn-modif {
            color: #fff;
            background: #f4e700;
            border: 1px solid transparent;
            border-radius: 20px;
            padding: 10px 30px;
            text-align: center;
            text-decoration: none;
        }

        .btn-modif:hover {
            background: #f4e700;
            color: #fff;
        }

        .pic {
            width: 200px !important;
            height: 200px !important;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <main class="container pt-2">
        <section class="d-flex justify-content-around  w-100">
            <div class="pic"
                style="background-image: url(./assets/<?php echo isset($user['pic']) ? $user['pic'] : 'OIP-removebg-preview (2).png' ?>);background-position: center;
background-size: cover;
background-repeat: no-repeat;">
            </div>
            <div class="d-flex flex-column justify-content-center ps-5 w-50">
                <h2 class="fw-bold ">Chef <?php echo $user['username'] ?></h2>
                <h2 class="fw-light "><strong>Username
                        :</strong><?php echo isset($user['username']) ? $user['username'] : 'Inconnu'; ?></h2>
                <h2 class="fw-light"><strong>Email :</strong><?php echo isset($user['email']) ? $user['email'] : ''; ?>
                </h2>
                <h2 class="fw-light"><strong>Joined
                        :</strong><?php echo isset($user['date_inscription']) ? $user['date_inscription'] : ''; ?></h2>
            </div>
            <div class="d-flex flex-column justify-content-around">
                <a href="updateuser.php?id=<?php echo $user['id'] ?>" class="btn-modif ">Modifier les données</a>
                <a href="authentification.html" class="btn-deco">Déconnexion</a>
            </div>
        </section>
        <hr>

        <section class="p-3">
            <h3>Tes recettes préférées &hearts;</h3>
            <div class="recepie_area">
                <div class="row">
                    <?php foreach (select_fav() as $recette) { ?>
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="single_recepie text-center">
                                <div class="recepie_thumb"
                                    style="background-image: url(assets/<?php echo $recette['image'] ?>); background-position: center;background-size: cover;background-repeat: no-repeat; height:150px ; width:150px;">
                                </div>
                                <h3><?php echo $recette['titre'] ?></h3>
                                <span></span>
                                <p><?php echo $recette['continent'] ?></p>
                                <form action="" method="post">
                                    <input type="hidden" name="delete_<?php echo $recette['id']; ?>" value="1">
                                    <button type="submit" class=" bg-transparent border-0 "><i class="fa-solid fa-trash"
                                            style="color: #ff0000;"></i></button>
                                </form>
                                <a href="recette.php?id=<?php echo $recette['id'] ?>" class="line_btn">Voir la recette
                                    complète</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    </main>
</body>

</html>