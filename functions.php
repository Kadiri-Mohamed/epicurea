<?php
session_start();
function connect()
{
    $host = "localhost";
    $dbname = 'cc4';
    $username = 'root';
    $pass = '';
    $port = '3306';

    try {
        return new PDO("mysql:host=$host; port=$port;dbname=$dbname", $username, $pass);
    } catch (PDOException $e) {
        echo 'Erreur ' . $e->getMessage();
    }
}
function user()
{
    $bdd = connect();
    $req = $bdd->prepare("SELECT * FROM utilisateurs WHERE username = ?");
    $req->execute([$_SESSION['username']]);
    return $req->fetch();
     
}


function modele($title, $style)
{
    ?>
    <!doctype html>
    <html class="no-js" lang="zxx">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo $title ?> </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link rel="stylesheet" href="css/<?php echo $style ?>">
        <link rel="stylesheet" href="css/index.css">
    </head>

    <body class=" overflow-hidden ">

        <header>
            <div class="header-area">
                <div id="sticky-header" class="main-header-area ">
                    <div class="container">
                        <div class="row d-flex align-items-center yourmenu  ">
                            <div class="col-xl-3  col-md-2 col-sm-2 w-25">
                                <div class="logo">
                                    <a href="index.php">
                                        <img src="assets/epicurea1.png" alt="" class=" img-fluid ">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 none">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="index.php">home</a></li>
                                            <li><a href="FAQ.php">FAQ</a></li>
                                            <li><a href="blog.php">blog </a></li>
                                            <li><a href="Politique.php">Politique </a></li>
                                            <li><a href="contact.php">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-2  d-none d-lg-block none">
                                <div class="search_icon">
                                    <a href="recherche.php">
                                        <i class="ti-search"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-2 col-3 d-none d-lg-block none">
                                <div class="d-flex justify-content-center user">
                                    <a href="user.php" class="text-decoration-none text-white ">
                                        <div style=" width: 50px; height: 50px; border-radius: 50%;  background-image: url(./assets/<?php echo isset(user()['pic']) ? user()['pic'] : 'OIP-removebg-preview (2).png' ?>);background-position: center;
background-size: cover;
background-repeat: no-repeat;">
                                        </div>
                                        <?php if (isset($_SESSION["username"])) {
                                            echo $_SESSION["username"];
                                        } ?>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-1 col-xl-1 col-sm-2 col-2 mymenu d-lg-none ">
                                <button onclick="afficher()"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <g data-name="1">
                                            <path
                                                d="M441.13 166.52h-372a15 15 0 1 1 0-30h372a15 15 0 0 1 0 30ZM441.13 279.72h-372a15 15 0 1 1 0-30h372a15 15 0 0 1 0 30ZM441.13 392.92h-372a15 15 0 1 1 0-30h372a15 15 0 0 1 0 30Z"
                                                fill="#ffff00" class="fill-000000" />
                                        </g>
                                    </svg></button>
                                <div id="mymenu">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </header>

    <?php }




function footer()
{
    ?>
        </main>
        <footer class="footer">
            <div class="footer_top">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-2 col-md-6 col-lg-2">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                    Top Products
                                </h3>
                                <ul>
                                    <li><a href="#">Managed Website</a></li>
                                    <li><a href="#"> Manage Reputation</a></li>
                                    <li><a href="#">Power Tools</a></li>
                                    <li><a href="#">Marketing Service</a></li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 col-lg-2">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                    Quick Links
                                </h3>
                                <ul>
                                    <li><a href="#">Jobs</a></li>
                                    <li><a href="#">Brand Assets</a></li>
                                    <li><a href="#">Investor Relations</a></li>
                                    <li><a href="#">Terms of Service</a></li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 col-lg-2">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                    Features
                                </h3>
                                <ul>
                                    <li><a href="#">Jobs</a></li>
                                    <li><a href="#">Brand Assets</a></li>
                                    <li><a href="#">Investor Relations</a></li>
                                    <li><a href="#">Terms of Service</a></li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 col-lg-2">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                    Resources
                                </h3>
                                <ul>
                                    <li><a href="#">Guides</a></li>
                                    <li><a href="#">Research</a></li>
                                    <li><a href="#">Experts</a></li>
                                    <li><a href="#">Agencies</a></li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-lg-4">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                    Subscribe
                                </h3>
                                <p class="newsletter_text">You can trust us. we only send promo offers,</p>
                                <form action="#" class="newsletter_form">
                                    <input type="text" placeholder="Enter your mail">
                                    <button type="submit"> <i class="ti-arrow-right"></i> </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copy-right_text">
                <div class="container">
                    <div class="footer_border"></div>
                    <div class="row align-items-center">
                        <div class="col-xl-8 col-md-8">
                            <p class="copy_right">
                                Copyright &copy;
                                <script>document.write(new Date().getFullYear());</script> All rights reserved | This
                                template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a
                                    href="https://colorlib.com" target="_blank">Kadiri</a>
                            </p>
                        </div>
                        <div class="col-xl-4 col-md-4">
                            <div class="socail_links">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="ti-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-twitter-alt"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-dribbble"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-behance"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <script src="js/contact.js"></script>
    </body>

    </html>


    <?php
} ?>

<script>
    function afficher() {
        var mymenu = document.getElementById("mymenu")
        mymenu.innerHTML = " <ul> <li><a href='index.php'>home</a></li><li><a href='FAQ.php'>FAQ</a></li><li><a href='recherche.php'>Recherce</a></li><li><a href='blog.php'>blog</a></li><li><a href='Politique.php'>Politique</a></li><li><a href='contact.php'>Contact</a></li></ul>";
        mymenu.style.display = mymenu.style.display === "block" ? "none" : "block";
    };
</script>