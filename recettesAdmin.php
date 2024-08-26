<?php
require_once 'functAdmin.php';
modele('Admin');

$bdd = connect();
$req = $bdd->prepare("SELECT * FROM recettes");
$req->execute([]);
$result = $req->fetchAll(PDO::FETCH_ASSOC);

?>
<style>
  .section1 img {
    width: 900px;
    height: 80px;
  }

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
    padding: 13px 13px;
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
    padding: 13px 13px;
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
  .hidden {
  opacity: 0;
  filter:  blur(5px);
  transform: translateY(150px);
  transition: all 1s;
}
.show {
  opacity: 1;
  filter:  blur(0);
  transform: translateY(0);}
</style>
<h1>Recettes</h1>
<a href="create.php" class="button button-contactForm btn_4 boxed-btn">Cree une nouvelle recette</a>
<section class="section1 p-3 ">
  <div class="row">
    <div class="col-md d-flex flex-column justify-content-center align-items-center ">
      <table class="table table-striped">
        <tr>
          <th>Image</th>
          <th>Titre</th>
          <th>Description</th>
          <th>Ingredients</th>
          <th>Instructions</th>
          <th colspan="2">action</th>
        </tr>
        <?php foreach ($result as $recette) { ?>
          <tr class="hidden">
            <td><img src="./assets/<?php echo $recette['image'] ?>" class="img-fluid" alt="<?php echo $recette['image'] ?>">
            </td>
            <td><?php echo $recette['titre'] ?></td>
            <td><?php echo $recette['description'] ?></td>
            <td><?php echo $recette['ingredients'] ?></td>
            <td><?php echo $recette['instructions'] ?></td>
            <td><a href="deleteRecette.php?id=<?php echo $recette['id'] ?>" class="button-69">delete</a></td>
            <td><a href="updateRecette.php?id=<?php echo $recette['id'] ?>" class="button-68">update</a></td>
          </tr>
        <?php } ?>

      </table>
    </div>
  </div>
</section>
  <script>
                window.addEventListener('scroll',reveal);

        function reveal(){
            var reveals =document.querySelectorAll('.hidden');

            for(var i=0; i<reveals.length; i++){
                var wndowheight =window.innerHeight;
                var revealtop = reveals[i].getBoundingClientRect().top;
                var revealpoint = 150;

                if(revealtop < wndowheight - revealpoint){
                    reveals[i].classList.add('show');
                } else{
                    reveals[i].classList.remove('show');
                }
            }
        }

            </script>
