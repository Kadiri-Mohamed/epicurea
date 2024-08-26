<?php
require_once 'functAdmin.php';
modele('Admins');
$bdd = connect();
$req = $bdd->prepare("SELECT * FROM admin");
$req->execute([]);
$users = $req->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['Admin']) ? $_POST['Admin'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : '';
    $res = $bdd->prepare('INSERT INTO admin (username, email, mot_de_passe) VALUES (?, ?, ?)');
    $res->execute([$username, $email, $password]);

    echo '<div class="alert alert-success alert-dismissible fade show position-absolute bottom-0 start-50 translate-middle-x" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
        Successfuly</div>';
}
?>
<style>
    .button-68 {
        appearance: none;
        backface-visibility: hidden;
        background-color: #27ae60;
        border-radius: 8px;
        border-style: none;
        box-shadow: rgba(39, 174, 96, .15) 0 4px 9px;
        box-sizing: border-box;
        color: #fff;
        cursor: pointer;
        display: inline-block;
        font-family: Inter, -apple-system, system-ui, "Segoe UI", Helvetica, Arial, sans-serif;
        font-size: 16px;
        font-weight: 600;
        letter-spacing: normal;
        line-height: 1.5;
        outline: none;
        overflow: hidden;
        padding: 13px 20px;
        position: relative;
        text-align: center;
        text-decoration: none;
        transform: translate3d(0, 0, 0);
        transition: all .3s;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        vertical-align: top;
        white-space: nowrap;
    }

    .button-68:hover {
        background-color: #1e8449;
        opacity: 1;
        transform: translateY(0);
        transition-duration: .35s;
    }

    .button-68:active {
        transform: translateY(2px);
        transition-duration: .35s;
    }

    .button-68:hover {
        box-shadow: rgba(39, 174, 96, .2) 0 6px 12px;
    }

    .button-69 {
        appearance: none;
        backface-visibility: hidden;
        background-color: #ae2732;
        border-radius: 8px;
        border-style: none;
        box-shadow: rgba(39, 174, 96, .15) 0 4px 9px;
        box-sizing: border-box;
        color: #fff;
        cursor: pointer;
        display: inline-block;
        font-family: Inter, -apple-system, system-ui, "Segoe UI", Helvetica, Arial, sans-serif;
        font-size: 16px;
        font-weight: 600;
        letter-spacing: normal;
        line-height: 1.5;
        outline: none;
        overflow: hidden;
        padding: 13px 20px;
        position: relative;
        text-align: center;
        text-decoration: none;
        transform: translate3d(0, 0, 0);
        transition: all .3s;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        vertical-align: top;
        white-space: nowrap;
    }

    .button-69:hover {
        background-color: #d23643;
        opacity: 1;
        transform: translateY(0);
        transition-duration: .35s;
    }

    .button-69:active {
        transform: translateY(2px);
        transition-duration: .35s;
    }

    .button-69:hover {
        box-shadow: rgba(39, 174, 96, .2) 0 6px 12px;
    }

    input[type='text'] {
        margin: 10px;
        border-radius: 10px;
        border: none;
        padding: 10px;
        font-family: 'Rubik', sans-serif;
    }

    input[type='email'] {
        margin: 10px;
        border-radius: 10px;
        border: none;
        padding: 10px;
        font-family: 'Rubik', sans-serif;
    }

    input[type='submit'] {
        margin: 10px;
        background-color: #87A922;
        color: white;
        border-radius: 10px;
        border: none;
        padding: 10px;
        font-family: 'Rubik', sans-serif;
    }

    #btn1 {
        display: none;
    }
</style>

<section class="w-100">
    <div class="w-100"></div>
    <div class="d-flex justify-content-around ">
        <h1>Admins</h1>
        <button onclick="Formulaire()" id="addBlog" class="btn btn-dark m-2">Ajouter un admin</button>
    </div>
    <div id='btn1'>
        <form action="" method="post" class="mt-3 d-flex justify-content-around" id="form">
            <div>
                <label for="Admin">Adminname</label>
                <input type="text" name="Admin" placeholder="Nome d'admin">
            </div>
            <div>
                <label for="email">email</label>
                <input type="email" name="email" placeholder="email">
            </div>
            <div>
                <label for="mot de passe">mot de passe</label>
                <input type="text" name="mot_de_passe" placeholder="mot de passe">
            </div>
            <button type="submit" class="btn btn-warning  m-2">Ajouter</button>
        </form>
    </div>
    </section>
    <section class="section1 p-3 ">
        <div class="row">
            <div class="col-md d-flex flex-column justify-content-center align-items-center ">
                <table class="table table-striped">
                    <tr>
                        <th>Admin</th>
                        <th>Email</th>
                        <th>password</th>
                        <th>action</th>
                    </tr>
                    <?php foreach ($users as $user) { ?>
                        <tr>

                            <td><?php echo $user['username'] ?></td>
                            <td><?php echo $user['email'] ?></td>
                            <td><?php echo $user['mot_de_passe'] ?></td>
                            <td><a href="deleteAdmin.php?id=<?php echo $user['id'] ?>" class="button-69">delete</a></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </section>
    <script>
        function Formulaire() {
            const ajoutForm = document.getElementById("btn1");
            ajoutForm.style.display = ajoutForm.style.display === "block" ? "none" : "block";
        }
    </script>