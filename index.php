<?php
    session_start();
    if(empty($_SESSION['name'])):
        header('Location:login.php');
    endif;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DreamHome</title>
    <!-- OWN SCRIPTS -->
    <link rel="stylesheet" type="text/css" href="CSS/index.css" />
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <!-- FONT AWESOME --> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <div id="navigation-bar" class="p-3">
            <div id="navigation-menu-btn" class="navigation-menu-btn">
                <i class="fas fa-bars fa-2x"></i>
            </div>
            <div class="m-2 navigation-elements">
                <nav id="navigation-main" class="navigation-main">
                    <!-- Brand -->
                    <a href="index.php"><img src="IMG/dream-home.png" alt="DreamHome Logo" class="iconImg invert"></a>
                    <!-- Left Nav -->
                    <ul class="navigation-menu mt-2">
                        <li>
                            <a href="#">Branch</a>
                        </li>
                        <li>
                            <a href="#">More</a>
                        </li>
                    </ul>
                    <ul class="navigation-menu-user mt-2">
                        <li>
                            <a href="logout_action.php">                                
                                <i class="far fa-user"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </nav>                
            </div>
        </div>
    </header>
    <section>
        <div class="container">
            <h1>Welcome <?=$_SESSION['name']?></h1>
        </div>
    </section>
    <footer>
        <div class="footer">
            &copy; 2021 David Santomé & Raixa Madueño
        </div>
    </footer>
    <!-- JAVASCRIPT -->
    <script src="JS/index.js"></script>
</body>
</html>