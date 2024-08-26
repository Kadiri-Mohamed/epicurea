<?php
require_once 'functions.php';
modele('update', 'update');
$conn = connect();

$id = isset($_GET['id']) ? $_GET['id'] : null;
if ($id === null) {
    exit("ID is not provided");
}

$idk = $conn->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$idk->execute([$id]);
$result = $idk->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pic = $_FILES['image']['name'];
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password1']) ? $_POST['password1'] : '';
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $res = $conn->prepare("UPDATE utilisateurs SET username = ?, email = ?, mot_de_passe = ?, pic = ? WHERE id = ?");
    $res->execute([$username, $email, $hashed_password, $pic, $id]);
}
?>

<div class="container">
    <h2>Modifier les informations</h2>
</div>
<div class="container d-flex justify-content-center">
<form method="POST" action="updateuser.php?id=<?= $id ?>" class="w-25" enctype="multipart/form-data">
        <input type="text" name="username" placeholder="Nom d'utilisateur" class="form-control" value="<?= $result['username'] ?>" required>
        <input type="email" name="email" placeholder="Email" class="form-control" value="<?= $result['email'] ?>" required>
        <input type="text" name="password1" class="form-control" value="<?= $result['mot_de_passe'] ?>" disabled>
        <input type="file" name="image" class="form-control" required>
        <div class="d-flex justify-content-center ">

            <input type="submit" value="Modifier" class="button button-contactForm btn_5 boxed-btn">
        </div>
    </form>
</div>
