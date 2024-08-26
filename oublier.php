<?php
require_once 'functions.php';
$ddb = connect();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $requ = $ddb->prepare("INSERT INTO oublier (email,message) VALUES (?, ?)");
    $requ->execute([ isset($_POST['email']) ? $_POST['email'] : '',isset($_POST['message']) ? $_POST['message'] : '']);
    header('Location: index.html');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- Formulaire de mot de passe oublier -->
    <div class="container">
        <form action="" method="post" class="w-25">
        <div class="mb-3">
            <label for="email" class="form-label">Adresse Email </label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Le message</label>
            <textarea name="message" id="" placeholder="Donner les infos de votre compte" rows="7" cols="60">
Username:
Message:
            </textarea>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    </div>
    
</body>
</html>