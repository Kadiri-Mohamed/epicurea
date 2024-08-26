<?php
require_once 'functAdmin.php';
modele('creat');
$conn = connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = !empty($_POST['nom']) ? $_POST['nom'] : '';
    $description = !empty($_POST['description']) ? $_POST['description'] : '';
    $instructions = !empty($_POST['instructions']) ? $_POST['instructions'] : '';
    $ingredients = !empty($_POST['ingredients']) ? $_POST['ingredients'] : '';
    $continent = !empty($_POST['continent']) ? $_POST['continent'] : '';
    $categorie = !empty($_POST['categorie']) ? $_POST['categorie'] : '';

    if (!empty($nom) && !empty($description) && !empty($instructions) && !empty($ingredients) && !empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name']; 
        $res = $conn->prepare('INSERT INTO recettes (titre, description, instructions, ingredients, image, continent,categorie) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $res->execute([$nom, $description, $instructions, $ingredients, $image, $continent,$categorie]);
    } else {
        echo "All fields are required!";
    }
}
?>

<section class="p-4">
    <h1 class="text-center">Cree une recette</h1>
    <form action="" method="post" class="bg-white p-4 rounded-4 d-flex gap-5" enctype="multipart/form-data">
        <div>
            <div class="d-flex flex-column">
                <label for="titre" class="form-label">Nom de la recette</label>
                <input type="text" placeholder="Nom" name="nom" id="titre" class="form-control">
            </div>
            <div class="d-flex flex-column">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" cols="20" rows="5" class="form-control"
                    placeholder="description"></textarea>
            </div>
            <div class="d-flex flex-column">
                <label for="ingredients" class="form-label">Ingredients</label>
                <textarea name="ingredients" id="ingredients" cols="20" rows="5" class="form-control" placeholder="ingredients 
1- 
..."></textarea>
            </div>
        </div>
        <div>
            <div class="d-flex flex-column">
                <label for="instructions" class="form-label">Instructions</label>
                <textarea name="instructions" id="instructions" cols="20" rows="5" class="form-control" placeholder="instructions 
1- 
..."></textarea>
            </div>
            <div>
                <label for="continent" class=" form-label">Continent</label>
                <select name="continent" id="continent" class=" form-select">
                    <option value="asia">Asia</option>
                    <option value="afriqua">Afriqua</option>
                    <option value="europe">Europe</option>
                    <option value="australia">Australia</option>
                    <option value="america">America</option>
                </select>
            </div>
            <div>
                <label for="categorie" class=" form-label">categorie</label>
                <select name="categorie" id="categorie" class="form-select">
                    <option value="Cakes">Cakes</option>
                    <option value="Salade">Salade</option>
                    <option value="Plats">Plats</option>
                    <option value="desserts">desserts</option>
                    <option value="Accompagnements">Accompagnements</option>

                </select>
            </div>
            <div class="d-flex flex-column">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <input type="submit" class="btn btn-success form-control mt-4" value="Create" name="submit">
        </div>
    </form>
</section>