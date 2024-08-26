<?php
require_once 'functions.php';
modele('conatct', './styles/contact.css');
$ddb = connect();
$req = $ddb->prepare("SELECT * FROM utilisateurs WHERE username =?");
$req->execute([$_SESSION['username']]);
$user = $req->fetch();

$req = $ddb->prepare("SELECT * FROM messages INNER JOIN utilisateurs ON messages.email = utilisateurs.email WHERE utilisateurs.email = ?");
$req->execute([$user['email']]);
$messages = $req->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $requ = $ddb->prepare("INSERT INTO messages (objet, Qusetion, email) VALUES (?, ?, ?)");
    $requ->execute([isset($_POST['object']) ? $_POST['object'] : '', isset($_POST['question']) ? $_POST['question'] : '', isset($user['email']) ? $user['email'] : '']);
}

?>
<style>

</style>
<main class="container pt-2">

    <div class="row">
        <div class="col-12">
            <h2 class="contact-title">Get in Touch</h2>
        </div>
        <div class="col-lg-8">
            <form class="form-contact contact_form" action="" method="post" id="contactForm" novalidate="novalidate">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea class="form-control w-100" name="question" id="message" cols="30" rows="9"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'"
                                placeholder='Enter Message'></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <input class="form-control" name="object" id="subject" type="text"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'"
                                placeholder='Enter Subject'>
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <button type="submit" class="button button-contactForm btn_4 boxed-btn">Send Message</button>
                </div>
            </form>
        </div>
        <div class="col-lg-4">
            <div class="media contact-info">
                <span class="contact-info__icon"><i class="ti-home"></i></span>
                <div class="media-body">
                    <h3>Tamessna</h3>
                    <p>Ennassim</p>
                </div>
            </div>
            <div class="media contact-info">
                <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                <div class="media-body">
                    <h3>+212644404756</h3>
                    <p>Mon to Fri 9am to 6pm</p>
                </div>
            </div>
            <div class="media contact-info">
                <span class="contact-info__icon"><i class="ti-email"></i></span>
                <div class="media-body">
                    <h3>Med2004kad@gmail.com</h3>
                    <p>Send us your query anytime!</p>
                </div>
            </div>
        </div>
    </div>
    </div>
    </section>
    <div >
        <div class="row mb-3">
        <div class="col-12">
            <h2 class="contact-title">Reponses</h2>
        </div>
            <?php foreach ($messages as $message): ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $message['Objet'] ?></h5>
                            <p class="card-text"><?= $message['Qusetion'] ?></p>
                            <h6>Reponses :</h6>
                            <p class="card-text p-2  text-bg-secondary ">
                                <?= isset($message['reponse']) ? $message['reponse'] : 'Aucun reponse' ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <?php
    footer()
        ?>