<?php
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
        echo 'error ' . $e->getMessage();
    }
}

function modele($title)
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
        <link rel="stylesheet" href="css/admin.css">

        <style>
            body {
                background-color: black;
                height: 100vh;
                position: relative;
            }

            main {
                position: absolute;
                left: 15%;
                top: 1%;
                width: 84%;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 35px;
                background-color: #F2F3F5;

            }

            .nav-left {
                width: 13%;
                height: 100vh;
                position: fixed;
                height: 100%;
                background-color: white;
                left: 0;
            }

            li {
                margin: 15px 0px;
            }

            .liens {
                padding: 5px;

                width: 100%;
                display: flex;
                justify-content: space-around;

            }

            .liens a {
                text-decoration: none;
                width: 75%;
                color: black;
                font-weight: bold;
                position: relative;
                display: block;
                cursor: pointer;
            }

            .liens a:hover {

                text-decoration: none;
            }

            .liens a:before,
            .liens a:after {
                content: '';
                position: absolute;
                width: 0%;
                height: 2px;
                bottom: -8px;
                background: #799669;
            }

            .liens a:before {
                left: 0;
            }

            .liens a:after {
                right: 0;
                background: #799669;
                transition: width 0.8s cubic-bezier(0.22, 0.61, 0.36, 1);
            }

            .liens a:hover:before {
                background: #799669;
                width: 100%;
                transition: width 0.5s cubic-bezier(0.22, 0.61, 0.36, 1);
            }

            .liens a:hover:after {
                background: transparent;
                width: 100%;
                transition: 0s;
            }

            .nav-top {
                width: 88%;
                position: fixed;
                height: 12%;
                right: 0;
                z-index: 99;
                background-color: rgb(208, 230, 169);

            }

            .user {
                padding: 10px;
                width: 100%;
                background-color: rgb(75, 75, 75);
            }

            .user img {
                width: 70%;
            }

            .nav-left svg,
            .nav-left .contact {
                width: 30px;
                height: 25px;
            }

            .add {
                width: 10%;
            }

            @media screen and (max-width:1300px) {
                body main {
                    overflow-x: hidden !important;
                    margin: auto;
                }
                
                main {
                    margin: auto;
                    padding: auto;
                }

                .nav-left ul {
                    display: flex;
                    flex-wrap:wwrap ;
                    flex-direction: row;
                }
                .nav-left{
                    position: relative;
                    flex-direction: row;
                    width: 100%;
                }

                main {
                    width: 100%;
                    margin-left: 0% !important;
                    left:0 !important;
                    position: relative;
                }

                .portfolio img {
                    display: none;
                }

                .row {
                    flex-direction: column;
                    justify-content: center;
                }

                .mainDescription .selfPicture {
                    display: none;
                }

                .blog img {
                    display: none;
                }

                .pricesSection .priceCart {
                    margin-top: 5px;
                }

                .selfDescription {
                    width: 100%;
                }

            }
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    </head>

    <body>
        <section class="nav-left ">
            <div class="d-flex flex-column justify-content-between h-100">
                <div class="d-flex justify-content-center ">
                    <a href="recettesAdmin.php"><img src="assets/epicurea.png" alt="" class="img-fluid " width="100">
                    </a>
                </div>
                <div>
                    <ul class="list-unstyled ">
                        <li class="liens"><svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M14 2.2C22.5-1.7 32.5-.3 39.6 5.8L80 40.4 120.4 5.8c9-7.7 22.3-7.7 31.2 0L192 40.4 232.4 5.8c9-7.7 22.3-7.7 31.2 0L304 40.4 344.4 5.8c7.1-6.1 17.1-7.5 25.6-3.6s14 12.4 14 21.8V488c0 9.4-5.5 17.9-14 21.8s-18.5 2.5-25.6-3.6L304 471.6l-40.4 34.6c-9 7.7-22.3 7.7-31.2 0L192 471.6l-40.4 34.6c-9 7.7-22.3 7.7-31.2 0L80 471.6 39.6 506.2c-7.1 6.1-17.1 7.5-25.6 3.6S0 497.4 0 488V24C0 14.6 5.5 6.1 14 2.2zM96 144c-8.8 0-16 7.2-16 16s7.2 16 16 16H288c8.8 0 16-7.2 16-16s-7.2-16-16-16H96zM80 352c0 8.8 7.2 16 16 16H288c8.8 0 16-7.2 16-16s-7.2-16-16-16H96c-8.8 0-16 7.2-16 16zM96 240c-8.8 0-16 7.2-16 16s7.2 16 16 16H288c8.8 0 16-7.2 16-16s-7.2-16-16-16H96z" />
                            </svg><a href="recettesAdmin.php" title="recettes"> recettes</a></li>
                        <li class="liens"><svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M211.2 96a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zM32 256c0 17.7 14.3 32 32 32h85.6c10.1-39.4 38.6-71.5 75.8-86.6c-9.7-6-21.2-9.4-33.4-9.4H96c-35.3 0-64 28.7-64 64zm461.6 32H576c17.7 0 32-14.3 32-32c0-35.3-28.7-64-64-64H448c-11.7 0-22.7 3.1-32.1 8.6c38.1 14.8 67.4 47.3 77.7 87.4zM391.2 226.4c-6.9-1.6-14.2-2.4-21.6-2.4h-96c-8.5 0-16.7 1.1-24.5 3.1c-30.8 8.1-55.6 31.1-66.1 60.9c-3.5 10-5.5 20.8-5.5 32c0 17.7 14.3 32 32 32h224c17.7 0 32-14.3 32-32c0-11.2-1.9-22-5.5-32c-10.8-30.7-36.8-54.2-68.9-61.6zM563.2 96a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zM321.6 192a80 80 0 1 0 0-160 80 80 0 1 0 0 160zM32 416c-17.7 0-32 14.3-32 32s14.3 32 32 32H608c17.7 0 32-14.3 32-32s-14.3-32-32-32H32z" />
                            </svg><a href="utilisateursAdmin.php" title="utilisateurs"> utilisateurs</a></li>
                            <li class="liens"><svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M211.2 96a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zM32 256c0 17.7 14.3 32 32 32h85.6c10.1-39.4 38.6-71.5 75.8-86.6c-9.7-6-21.2-9.4-33.4-9.4H96c-35.3 0-64 28.7-64 64zm461.6 32H576c17.7 0 32-14.3 32-32c0-35.3-28.7-64-64-64H448c-11.7 0-22.7 3.1-32.1 8.6c38.1 14.8 67.4 47.3 77.7 87.4zM391.2 226.4c-6.9-1.6-14.2-2.4-21.6-2.4h-96c-8.5 0-16.7 1.1-24.5 3.1c-30.8 8.1-55.6 31.1-66.1 60.9c-3.5 10-5.5 20.8-5.5 32c0 17.7 14.3 32 32 32h224c17.7 0 32-14.3 32-32c0-11.2-1.9-22-5.5-32c-10.8-30.7-36.8-54.2-68.9-61.6zM563.2 96a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zM321.6 192a80 80 0 1 0 0-160 80 80 0 1 0 0 160zM32 416c-17.7 0-32 14.3-32 32s14.3 32 32 32H608c17.7 0 32-14.3 32-32s-14.3-32-32-32H32z" />
                            </svg><a href="Admins.php" title="utilisateurs"> Admins</a></li>
                        <li class="liens"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path
                                    d="M80 160c0-35.3 28.7-64 64-64h32c35.3 0 64 28.7 64 64v3.6c0 21.8-11.1 42.1-29.4 53.8l-42.2 27.1c-25.2 16.2-40.4 44.1-40.4 74V320c0 17.7 14.3 32 32 32s32-14.3 32-32v-1.4c0-8.2 4.2-15.8 11-20.2l42.2-27.1c36.6-23.6 58.8-64.1 58.8-107.7V160c0-70.7-57.3-128-128-128H144C73.3 32 16 89.3 16 160c0 17.7 14.3 32 32 32s32-14.3 32-32zm80 320a40 40 0 1 0 0-80 40 40 0 1 0 0 80z" />
                            </svg><a href="commentairesAdmin.php" title="commentaires"> commentaires</a></li>

                        <li class="liens"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100"
                                viewBox="0 0 64 64">
                                <path
                                    d="M 17 2 C 15.351563 2 14 3.351563 14 5 L 14 10 L 10 10 C 6.691406 10 4 12.691406 4 16 L 4 48 C 4 51.308594 6.691406 54 10 54 L 14 54 L 14 60.871094 C 14 61.648438 14.441406 62.339844 15.152344 62.679688 C 15.429688 62.800781 15.71875 62.871094 16 62.871094 C 16.460938 62.871094 16.910156 62.710938 17.28125 62.402344 L 26.53125 54.699219 C 27.070313 54.25 27.75 54 28.449219 54 L 54 54 C 57.308594 54 60 51.308594 60 48 L 60 16 C 60 12.691406 57.308594 10 54 10 L 32 10 L 32 5 C 32 3.351563 30.648438 2 29 2 Z M 17 4 L 29 4 C 29.550781 4 30 4.449219 30 5 L 30 28.71875 L 24 27.21875 L 24 15 C 24 14.445313 23.550781 14 23 14 C 22.449219 14 22 14.445313 22 15 L 22 27.21875 L 16 28.71875 L 16 5 C 16 4.449219 16.449219 4 17 4 Z M 23 6 C 22.449219 6 22 6.445313 22 7 L 22 11 C 22 11.554688 22.449219 12 23 12 C 23.550781 12 24 11.554688 24 11 L 24 7 C 24 6.445313 23.550781 6 23 6 Z M 10 12 L 14 12 L 14 30.800781 C 14 31.039063 14.089844 31.28125 14.25 31.460938 L 18.871094 36.65625 C 18.875 36.660156 18.871094 36.660156 18.875 36.664063 L 22.253906 40.464844 C 22.296875 40.511719 22.355469 40.539063 22.40625 40.578125 C 22.578125 40.710938 22.777344 40.800781 23 40.800781 C 23.222656 40.800781 23.421875 40.710938 23.59375 40.578125 C 23.644531 40.539063 23.703125 40.511719 23.75 40.464844 L 27.125 36.664063 C 27.128906 36.660156 27.128906 36.660156 27.128906 36.65625 L 31.75 31.460938 C 31.910156 31.28125 32 31.039063 32 30.800781 L 32 12 L 54 12 C 56.210938 12 58 13.789063 58 16 L 58 42 L 25 42 C 24.628906 42 24.285156 42.207031 24.113281 42.535156 C 23.941406 42.867188 23.96875 43.265625 24.183594 43.574219 L 30.078125 52 L 28.449219 52 C 27.277344 52 26.140625 52.410156 25.25 53.160156 L 16 60.871094 L 16 54 C 16 52.898438 15.101563 52 14 52 L 10 52 C 7.789063 52 6 50.210938 6 48 L 6 16 C 6 13.789063 7.789063 12 10 12 Z M 23 29.03125 L 29.738281 30.714844 L 25.925781 35 L 20.074219 35 L 16.261719 30.714844 Z M 26.921875 44 L 58 44 L 58 48 C 58 50.207031 56.207031 52 54 52 L 32.519531 52 L 29.9375 48.3125 C 29.96875 48.210938 30 48.109375 30 48 L 30 47 C 30 46.445313 29.550781 46 29 46 C 28.792969 46 28.609375 46.078125 28.453125 46.1875 Z M 34 46 C 33.449219 46 33 46.445313 33 47 L 33 49 C 33 49.554688 33.449219 50 34 50 C 34.550781 50 35 49.554688 35 49 L 35 47 C 35 46.445313 34.550781 46 34 46 Z M 39 46 C 38.449219 46 38 46.445313 38 47 L 38 49 C 38 49.554688 38.449219 50 39 50 C 39.550781 50 40 49.554688 40 49 L 40 47 C 40 46.445313 39.550781 46 39 46 Z M 44 46 C 43.449219 46 43 46.445313 43 47 L 43 49 C 43 49.554688 43.449219 50 44 50 C 44.550781 50 45 49.554688 45 49 L 45 47 C 45 46.445313 44.550781 46 44 46 Z M 49 46 C 48.449219 46 48 46.445313 48 47 L 48 49 C 48 49.554688 48.449219 50 49 50 C 49.550781 50 50 49.554688 50 49 L 50 47 C 50 46.445313 49.550781 46 49 46 Z M 54 46 C 53.449219 46 53 46.445313 53 47 L 53 49 C 53 49.554688 53.449219 50 54 50 C 54.550781 50 55 49.554688 55 49 L 55 47 C 55 46.445313 54.550781 46 54 46 Z">
                                </path>
                            </svg><a href="blogAdmin.php" title="blog">

                                blog
                            </a></li>
                        <li class="liens"><img class="w-25 contact"
                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAD9klEQVR4nO2ZW2gVVxSGv3hJiyIGG2s1ESGCT4oRBW/0oaL2QVIQUUGRmKBYUOujiPok+tKKolgV2pf2zYrRtmiLiMGAt4AX0FL1wQtRBG+tFxKvIxv+gcXhzMyeMzmTBPLBQMisvfbsM3ut/a810E8/Pco3QDvQBVwFZtLHqAT2AUHB9QyooY8wHDilB+8E1gHVwDH977inn0HAVuBukR8kzXUH2AIMTLOIL4ArcnAfmFpw77HuNXv42ppxAUHBtdl3EVWKAzfoH2BcEZvluv8fUJvg745s55GNr+Xnto/xJ8AZDbgGfBZj2+K5xcJfsjsIfH1tl+Fdj1/abbEnsm/sjsk98Pb1VIZf+RgDK2Tvxo3OOrkH3r66ZOjixJc/NaYl6+QeePu6JcOJ+FOroHfjlmaZ3ANvX2EAu6yUhtUadyPL5B54+1onw19IR7XGvQMqSp3cA29f44EPwHNgGP6s1ATtWSb3IJWvUJZ862n/qTn0GnvTQpaY/e50UhKbZH8ZGJB18gRS+XIP/68GrEmwHQX8L9s5ETb3db+ebEyRn440gxZp0ANgSIzdQdk5RRzFjgjx16b7Ts22phCN29MsxGWeCxr4fUxsvJDNqoSaZod5M+HlxjqWeS6gQ4tw/lIxDXirlDorwuY7I1GKqeRifKkxl4BJwCPgvf5fNraZwB8S8eb+kM3FhG2I7p8whdIr/b2bMlNpahNX8hajSnWLszmaUMG1FdkyBzyzY2bqVeq6SZtiDtJHsjlY5HQPOanD9jrwEzCdnGnSQ3bGTD7TBP8uejF7TEqO6qDMMW9vJ72UwcBpPeTZmMBuAN6UkvPzZKSK/0DZJyqnLzaL2RUTMz3KBOChHvJQTJZqMNvsQNp+VF5MVrcxUPapiImZFyY1F9uOA5VMnOh0B+NNCdfccKf9S4/AnmFSc3uBAphrzqnC67BEaS7MB16bxUS9mTpzaD5VaRwqgkBx52qZat0LFfVjabFcWGgW83NMLDgF8HvBr+4eeKMEqGWskTJhh8b10XJ5M+E2+y0mm7k3tl5xsx/4PMFvs4nFJ+qjlZ3ZZtK/EgSka836UmN6Z4G25Bhy0GVhaj4X030shUbTCX2Wh06bYJoRHd084WiTJFy6zkUBhOVrV4xqLoUR8utqmdy02V6zt3/0KLx82GD0Xq40meb4TSWFUplhUv0CeoB6c4I7GfIDMDSljzqTSMpeGsdRqR7AW1PXrPEsc0eaXtvf2rY9jvuwet7Ezg21Z6N6zWONvLmUsidddirUBAx/5UC1/K/6pDFRn8eder5n0m1uIjItg/Rx6JS+AgQRV6sW1idwwbwWOKLs1in1uy2lpOmnH7qRj/1HkOKlz9sVAAAAAElFTkSuQmCC">

                            <a href="FAQAdmin.php" title="FAQ"> FAQ
                            </a>
                        </li>
                        <li class="liens"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path
                                    d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                            </svg><a href="messageAdmin.php" title="ajouter une recette">Messages</a></li>
                        <li class="liens"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path
                                    d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                            </svg><a href="politiqueAdmin.php" title="Politique">politique</a></li>
                    </ul>
                </div>
                <div class="d-flex  justify-content-center align-items-center  user">
                    <div>
                        <a href="recettesAdmin.php" class="text-decoration-none  text-white "><img src="./assets/admin.png"
                                class="img-fluid" alt="">
                            Admin</a>
                    </div>
                    <div>
                        <a href="authentification.html" class="btn btn-danger">
                            Déconnexion</a>
                    </div>
                </div>
            </div>
        </section>

        <main>
        </main>

        <?php }

?>