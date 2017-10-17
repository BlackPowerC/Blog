<?php
session_start();
if (isset($_SESSION["token"]))
{
    header("Location: index.php");
}

require_once '../classe/Pages.php';
?>
<html>
    <?php
    Page::getHead("Connexion");
    Page::getNavbar();
    ?>
    <header class="text-center">
        <h1>Page de connexion</h1>
    </header>
    <body>
        <?php Page::getLoginForm(); ?>
    </body>
</html>