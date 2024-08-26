<?php
require_once 'functAdmin.php';
modele('update', 'update.css');
$conn = connect();

$id = $_GET['id'];

$idk = $conn->prepare("SELECT * FROM recettes WHERE id = ?");
$idk->execute([$id]);
$result = $idk->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $continent = $_POST['continent'];
    $instructions = $_POST['instructions'];
    $ingredients = $_POST['ingredients'];
    $image = $_POST['image'];

    $res = $conn->prepare("UPDATE recettes SET titre = ?, description = ?, continent = ? , instructions= ? , ingredients=? , image=? WHERE id = ?");
    $res->execute([$titre, $description, $continent, $instructions, $ingredients, $image, $id]);



}
?>

<section>
    <div class="container d-flex justify-content-between flex-column align-items-center w-100">
        <div>
            <h1>Modifier un ingredient</h1>
        </div>
        <div class="d-flex ">
            <div class=" d-flex flex-column  justify-content-center align-items-center  w-100">
                <form action="" method="post" class="mt-4 gap-3 d-flex bg-white p-4 rounded-4" id="form">
                    <div class="  d-flex flex-column gap-4">
                        <div class=" ">
                            <label for="Nom" class=" form-label ">Titre</label>
                            <input type="text" id="Nom" name="titre" class="form-control"
                                value="<?php echo $result['titre']; ?>" required>
                        </div>
                        <div class=" ">
                            <label for="Nom" class=" form-label ">Description</label>
                            <textarea name="description" id="" cols="20" rows="5"
                                class="form-control"><?php echo $result['description']; ?></textarea>
                        </div>
                        <div class=" ">
                            <label for="Nom" class=" form-label ">Continent</label>
                            <input type="text" id="Nom" name="continent" class="form-control"
                                value="<?php echo $result['continent']; ?>" required>
                        </div>
                        <div class=" d-flex justify-content-center align-items-center mt-3">
                            <input type="submit" value="Modifier" class="btn btn-outline-success" id="btn">
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-3">
                        <div class=" ">
                            <label for="Nom" class=" form-label ">Instructions</label>
                            <textarea name="instructions" id="instructions" cols="20" rows="5"
                                class="form-control"><?php echo $result['instructions']; ?></textarea>
                        </div>
                        <div class=" ">
                            <label for="Nom" class=" form-label ">Ingredients</label>
                            <textarea name="ingredients" id="ingredients" cols="20" rows="5"
                                class="form-control"><?php echo $result['ingredients']; ?></textarea>
                        </div>
                        <div class="  ">
                            <label for="Nom" class=" form-label ">Image</label>
                            <input type="text" id="Nom" name="image" class="form-control"
                                value="<?php echo $result['image']; ?>" required>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</section>
<script>



</script>