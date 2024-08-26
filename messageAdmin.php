<?php
require_once 'functAdmin.php';
modele('Message');
$ddb = connect();

$req = $ddb->prepare("SELECT * FROM messages ");
$req->execute();
$messages = $req->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $requ = $ddb->prepare("UPDATE messages SET Reponse = ? WHERE id = ?");
    $requ->execute([$_POST['Reponse'], isset($_POST['message_id']) ? $_POST['message_id'] : '']);
}
$requ = $ddb->prepare("SELECT * FROM oublier ");
$requ->execute();
$oubliers = $requ->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="w-100">

    <div class="w-100">
        <div class="d-flex justify-content-between">
            <h1>Messages</h1>
        </div>

        <div class="row d-flex">
            <?php $count = 0; ?>
            <?php foreach ($messages as $message): ?>
                <div class="col-md-3">
                    <div class="card blog-card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $message['Objet'] ?></h5>
                            <p class="card-text"><?= $message['Qusetion'] ?></p>
                            <p class="card-text"><?= $message['email'] ?></p>
                            <form method="POST">
                                <div class="form-group">
                                    <input type="hidden" name="message_id" value="<?= $message['id'] ?>">
                                    <textarea class="form-control" name="Reponse" placeholder="La reponse"></textarea>
                                </div>
                                <button type="submit" class="genric-btn primary ">Ajouter une reponse</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php $count++; ?>
            <?php if ($count % 4 == 0): ?>
            </div>
            <div class="row">
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    </div>
</section>
<section class="w-100">

    <div class="w-100">
        <div class="d-flex justify-content-between">
            <h1>Messages des personnes avec mot de passe oublier</h1>
        </div>

        <div class="row d-flex">
            <?php $count = 0; ?>
            <?php foreach ($oubliers as $message): ?>
                <div class="col-md-3">
                    <div class="card blog-card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $message['email'] ?></h5>
                            <p class="card-text"><?= $message['message'] ?></p>
                        </div>
                    </div>
                </div>
            <?php $count++; ?>
            <?php if ($count % 4 == 0): ?>
            </div>
            <div class="row">
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    </div>
</section>