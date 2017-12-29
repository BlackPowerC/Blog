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
            <?php include_once '../views/navbarView.php'; ?>
        </header>
        <div class="main_content container container-fluid">
            <div class="text-center">
                <h1>Connexion</h1>
            </div>
            <div class="row">
                <?php echo form("../post/post_connexion.php?action=login&uri={$_SERVER["REQUEST_URI"]}", "POST") ?>
                <div class="form-group">
                    <?php
                    echo form_label("Pseudo", "pseudo");
                    echo form_input([
                        "type" => "text",
                        "class" => "form-control",
                        "placeholder" => "Saisir pseudo",
                        "name" => "pseudo",
                        "required" => ""
                    ]);
                    ?>
                </div>
                <!-- Email -->
                <div class="form-group">
                    <?php
                    echo form_label("Email", "email");
                    echo form_input([
                        "type" => "e-mail",
                        "class" => "form-control",
                        "placeholder" => "Saisir adresse électonique",
                        "name" => "email",
                        "required" => ""
                    ]);?>
                </div>
                <div class="checkbox">
                    <label for="remind"><?php echo form_input([
                        "class"=>"checkbox",
                        "name"=>"remind",
                        "type"=>"checkbox"
                        ])?>Se souvenir de moi</label>
                </div>'
                <div class="form_control_content" style="width: 200px; margin: auto">
                    <?php
                    echo form_input(["type" => "submit", "class" => "btn btn-primary"]);
                    echo form_input(["type" => "reset", "class" => "btn btn-primary"]);
                    ?>
                </div>
                </form>
            </div>
        </div>
    </body>
</html>	