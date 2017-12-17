<?php
session_start();
if (isset($_SESSION["token"]))
{
    header("Location: index.php");
}

require_once '../classe/Pages.php';
?>
<html>
    <?php Page::getHead("Connexion"); ?>
    <body>
        <header>
            <?php include_once '../views/navbarView.php'; ?>
        </header>
        <div class="text-center">
            <h1>Inscription</h1>
        </div>
        <?php Page::getLoginForm(); ?>
    </body>
</html>