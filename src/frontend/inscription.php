<?php
session_start();
if (isset($_SESSION["token"]))
{
    header("Location: index.php");
    exit() ;
}

require_once '../classe/Pages.php';
?>
<html>
    <?php
    Page::getHead("Inscription");
    Page::getNavbar();
    ?>
    <body>
        <header class="text-center">
            <h1>Inscription</h1>
        </header>
        <div class="main_content container container-fluid">
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
                <form action="../post/post_inscription.php" method="POST">
                    <!-- Nom, prénom, pays, age -->
                    <fieldset>
                        <legend>Civilité</legend>
                        <!-- Nom -->
                        <div class="form-group">
                            <label for="pseudo">Pseudo</label>
                            <input class="form-control" type="text" name="pseudo" placeholder="Pseudo" required="required"/>
                        </div>
                        <!-- Prénom -->
                        <div class="form-group">
                            <label for="passe">Mot de passe</label>
                            <input class="form-control" type="password" name="passe" placeholder="Mot de passe" required="required"/>
                        </div>
                        <!-- Age -->
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input class="form-control" type="number" name="age" placeholder="age" required="required"/>
                        </div>
                        <!-- Sexe -->
                        <div class="form-group">
                            <label for="sexe">Sexe</label>
                            <label>Homme <input class="form-control checkbox" type="radio" name="sexe" value="H"/></label>
                            <label>Femme <input class="form-control checkbox" type="radio" name="sexe" value="F"/></label>
                        </div>
                    </fieldset>
                    <!-- Pays -->
                    <fieldset>
                        <legend>Nationalité</legend>
                        <div class="form-group">
                            <label for="pays">Pays</label>
                            <select name="pays">
                                <?php
                                $europe = array("France", "Espagne", "Allemagne", "Pologne", "Russie", "Italie", "Danemark", "Finlande", "Roumanie", "Grèce");
                                $afrique = array("Togo", "Bénin", "Libye", "Mali", "Tchad", "Congo", "Egypte", "Maroc", "Afrique du Sud", "Somalie");
                                $amerique = array("USA", "Canada", "Bolivie", "Brésil", "Vénézuela", "Chilie", "Argentine", "Pérou", "Colombie", "Brésil");
                                $asie = array("Irak", "Turquie", "Kazakhstan", "Chine", "Thaîlande", "Birmanie", "Ouzbékistan", "Cambodge", "Vietnam");
                                $oceanie = array("Australie", "Papouasie Nouvelle-Guinnée", "Nouvelle Zélande", "Martinique", "Saint-Domingue");
                                $pays = array("Europe" => $europe, "Afrique" => $afrique, "Amerique" => $amerique, "Asie" => $asie, "Oceanie" => $oceanie);
                                foreach ($pays as $key => $value)
                                {
                                    ?>
                                    <optgroup label="<?php echo $key; ?>">
                                        <?php
                                        foreach ($value as $lili)
                                        {
                                            ?>
                                            <option value="<?php echo $lili ?>"><?php echo $lili ?></option>
                                            <?php
                                        }
                                        ?>
                                    </optgroup>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </fieldset>
                    <div class="form_control_content" style="width: 200px; margin: auto">
                        <input class="btn btn-primary" type="submit"/>
                        <input class="btn btn-primary" type="reset"/>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>	