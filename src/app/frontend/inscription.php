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
    Page::getHead("Inscription");
    ?>
    <body>
        <header>
            <?php include_once '../views/navbarView.php'; ?>
        </header>
        <div class="main_content container container-fluid">
            <div class="text-center">
                <h1>Inscription</h1>
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
                                Veuillez vous inscrire pour accéder aux fonctionnalités du blog ! Ou <a href="connexion.php" title="Connexion">Connectez-vous </a> !
                            </div>
                            <?php
                            break;
                        case 'good_action':
                            ?>
                            <div class="alert alert-info">
                                Inscris-toi sur cette page !
                            </div>	
                            <?php
                            break;
                    }
                }
                ?>
            </div>
            <div class="row">
                <?php echo form("../post/post_inscription.php", "POST") ?>
                    <fieldset>
                        <legend>Informations</legend>
                        <!-- Pseudo -->
                        <div class="form-group">
                            <?php
                            echo form_label("Pseudo", "pseudo") ;
                            echo form_input([
                                "type"=>"text",
                                "class"=>"form-control",
                                "placeholder"=>"Saisir pseudo",
                                "name"=>"pseudo",
                                "required"=>""
                                ]);
                            ?>
                        </div>
                        <!-- Email -->
                        <div class="form-group">
                            <?php
                            echo form_label("Email", "email") ;
                            echo form_input([
                                "type"=>"e-mail",
                                "class"=>"form-control",
                                "placeholder"=>"Saisir adresse électonique",
                                "name"=>"email",
                                "required"=>""
                                ]);
                            ?>
                        </div>
                    </fieldset>
                    <div class="form_control_content" style="width: 200px; margin: auto">
                        <?php
                        echo form_input(["type"=>"submit","class"=>"btn btn-primary"]);
                        echo form_input(["type"=>"reset","class"=>"btn btn-primary"]);
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>	