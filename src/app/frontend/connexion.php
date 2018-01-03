<?php
session_start();
if (isset($_SESSION["id"]) &&isset($_SESSION["pseudo"]) && isset($_SESSION["email"]))
{
    header("Location: index.php");
    exit();
}

require_once '../core/Autoloader.php';
Autoloader::getInstance()->load_helper('form_helper') ;
Autoloader::getInstance()->load_class('pages') ;
?>
<html>
    <?php
    Page::getHead("Connexion");
    ?>
    <body>
        <header>
            <?php include_once '../views/navbar.inc.php'; ?>
        </header>
        <div class="main_content container container-fluid">
            <div class="text-center">
                <h1>Connexion</h1>
            </div>
            <div class="row" style="margin-bottom: 25px;">
                <?php
                if (isset($_GET["msg"]))
                {
                    $msg = strip_tags($_GET["msg"]);
                    switch ($msg)
                    {
                        case 'bad_action':
                            ?>
                            <div class="alert alert-danger">
                                Vous êtes déjà inscrit, veuillez vous connecter !
                            </div>
                            <?php
                            break;
                        case 'good_action':
                            ?>
                            <div class="alert alert-info">
                                Connecte-toi sur cette page !
                            </div>	
                            <?php
                            break;
                    }
                }
                ?>
            </div>
            <div class="row">
            <?php
                $action="../post/post_connexion.php?action=login&uri=".$_SERVER["REQUEST_URI"] ;
                include_once '../views/form.inc.php';
            ?>
            </div>
        </div>
    </body>
</html>	