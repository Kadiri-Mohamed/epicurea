<?php
require_once "functions.php";
$conn = connect();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username1']) ? $_POST['username1'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $pic = isset($_FILES['image']['name'])?$_FILES['image']['name']:'OIP-removebg-preview (2).png';
    $pasword = isset($_POST['password1']) ? $_POST['password1'] : '';
    $hashed_password = password_hash($pasword, PASSWORD_DEFAULT);
    $res = $conn->prepare('INSERT INTO utilisateurs (username, email, mot_de_passe, pic) VALUES (?, ?, ?, ?)');
    $res->execute([$username, $email, $hashed_password, $pic]);
    header('location:authentification.html');
    
    echo '<div class="alert alert-success alert-dismissible fade show position-absolute bottom-0 start-50 translate-middle-x" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
        Successfuly</div>';
    }

?>