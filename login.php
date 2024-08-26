<?php
require_once "functions.php";
$conn = connect();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stm = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stm->execute([$user]);
    $admin = $stm->fetch();
    $user = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    if ($user == 'admin' && $password == 'admin' || $user == $admin['username'] && $password == $admin['mot_de_passe']) {
        header('Location:recettesAdmin.php');
        session_start();
        $_SESSION["username"] = $user;
    } else {

        $stmt = $conn->prepare("SELECT mot_de_passe FROM utilisateurs WHERE username = ?");
        $stmt->execute([$user]);
        $hashed_password = $stmt->fetchColumn();

        if (password_verify($password, $hashed_password)) {
            session_start();
            if ($user == 'admin' && $password == 'admin') {
                header('Location: recettesAdmin.php');
            } else {
                header('Location: index.php');
                $_SESSION["username"] = $user;
            }
            exit();
        } else {
            header('Location: wrong.html');
        }
    }
}
?>