<?php
require_once 'functAdmin.php';
modele('Users administration');
$bdd = connect();
$req = $bdd->prepare("SELECT * FROM utilisateurs");
$req->execute([]);
$users = $req->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = isset($_POST['id']) ? $_POST['id'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';

  $res = $bdd->prepare("UPDATE utilisateurs SET mot_de_passe = ? WHERE id = ?");
  $res->execute([$password, $id]);
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
</style>
<h1>Users</h1>
<section class="section1 p-3 ">
  <div class="row">
    <div class="col-md d-flex flex-column justify-content-center align-items-center ">
      <table class="table table-striped">
        <tr>
          <th>profile</th>
          <th>Username</th>
          <th>Email</th>
          <th>Date inscreption</th>
          <th>update password</th>
          <th>action</th>
        </tr>
        <?php foreach ($users as $user) { ?>
          <tr>
            <td>
              <div style=" width: 50px; height: 50px; border-radius: 50%; background-image: url(./assets/<?php echo isset($user['pic']) ? $user['pic'] : 'OIP-removebg-preview (2).png' ?>);background-position: center;
background-size: cover;
background-repeat: no-repeat;">
              </div>
            </td>
            <td><?php echo $user['username'] ?></td>
            <td><?php echo $user['email'] ?></td>
            <td><?php echo $user['date_inscription'] ?></td>
            <td><form action="" method="post"><input type="hidden" value="<?php echo $user['id'] ?>" name="id"> <input type="text" name="password"> </form></td>
            <td><a href="deleteuser.php?id=<?php echo $user['id'] ?>" class="button-69">delete</a></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>
</section>