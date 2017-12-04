<?php

class Page
{

    public static function getTinymce()
    {
        echo '<script src="http://localhost/js_text_editor/tinymce/tinymce.min.js"></script>';
        echo "<script>tinymce.init({ selector:'textarea' });</script>";
    }

    public static function getHead($title = "Frontend")
    {
        echo '<head>';
        echo '<meta charset="utf-8"/>';
        echo '<title>' . $title . '</title>';
        echo '<link rel="stylesheet" href="http://localhost/css_framework/bootstrap/css/bootstrap.min.css"/>';
        echo '<link rel="stylesheet" href="http://localhost/css_framework/font-awesome/css/font-awesome.min.css"/>';
        echo '<link rel="stylesheet" type="text/css" href="../../css/style.css"/>';
        echo '<script src="http://localhost/css_framework/bootstrap/js/bootstrap.min.js"></script>';
        echo '<script src="http://localhost/js_framework/jquery/3.2.1/jquery.min.js"></script>';
        echo '<script src="http://localhost/css_framework/bootstrap/js/bootstrap.js"></script>';
        echo '</head>';
    }

    public static function getNavbar($home = "index")
    {
        
    }

    public static function getLoginform()
    {
        echo '<div style="width: 80%; margin: auto; margin-top: 70px;" class="login_content">';
        echo '<form action="../post/post_connexion.php?action=login&uri=' . $_SERVER["REQUEST_URI"] . '" method="POST">';
        echo '<div class="form-group">';
        echo '<label for="pseudo">Pseudo</label>';
        echo '<input class="form-control" name="pseudo" type="text" required="required"/>';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label for="passe">Mot de passe</label>';
        echo '<input class="form-control" name="passe" type="password" required="required"/>';
        echo '</div>';
        echo '<div class="checkbox">';
        echo '<label for="remind"><input class="checkbox" name="remind" type="checkbox"/>Se souvenir de moi</label>';
        echo '</div>';
        echo '<div style="width: 80%; margin: auto" class="form-group submit_content">';
        echo '<input class="btn btn-sm btn-primary" type="submit">';
        echo '<input class="btn btn-sm btn-primary" type="reset"/>';
        echo '</div>';
        echo '</form>';
        echo '</div>';
    }

    public static function getConnecteddiv($user)
    {
        echo '<div style="margin-top: 70px;" class="logged_content">';
        echo '	<span>Utilisateur connecté</span>';
        echo '	<p>';
        echo '		<button class="btn btn-primary btn-sm" title="' . $user . '"><span class="glyphicon glyphicon-user"></span></button>';
        echo '		<span>' . $user . '</span><br/>';
        echo '		<a href="../post/post_connexion.php?action=logout&uri=' . $_SERVER["REQUEST_URI"] . '">Se deconnecter</a>';
        echo '	</p>';
        echo '</div>';
    }

}
