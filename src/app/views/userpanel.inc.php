<html>
    <?php
    Page::getHead();

    function LastConnextion($time)
    {
        $tmp = 0;
        $i = 0;
        $timestr = "";
        $_timestr = ["Jour(s)", "Heure(s)", "Minute(s)", "Seconde(s)"];
        $_time = [86400, 3600, 60, 1];
        while ($time) {
            $tmp = (int) ($time / $_time[$i]);
            if ($tmp)
            {

                $timestr = $timestr . ' ' . $tmp . ' ' . $_timestr[$i];
            }
            $time = (int) $time % $_time[$i];
            $i++;
        }
        return $timestr;
    }
    ?>
    <body>
        <!-- En-tete -->
        <header>
            <?php include_once 'navbarView.php'; ?>
        </header>
        <div id="page" class="container container-fluid">
            <!-- Entete avec nom de l'utilisateur et Photo de profil -->
            <div class="row">
                <!-- Colonne pour la pp -->
                <div class="side_content col-lg-4 col-md-4 col-xs-4">
                    <img class="img-thumbnail" alt="<?php echo $_SESSION['pseudo']; ?>" src="../../../ressource/img/600628_515012425217344_1213649186_n.jpg"/>
                </div>
                <div class="main_content col-lg-8 col-md-8 col-xs-8">
                    <h1 class="text-center">Informations personnelles</h1>
                    <div class="well">
                        <span><?php echo $_SESSION['pseudo']; ?></span>
                        <span style="float: right">Dernière Connexion : il y a <?php echo LastConnextion(time() - $_SESSION["time"]); ?></span>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#info">Information Personnelles</a></li>
                        <li><a data-toggle="tab" href="#mod">Modifier</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="info" class="tab-pan fade in active">
                            <ul>
                                <li>Pseudo : <?php echo $_SESSION['pseudo']; ?></li>
                                <li>Email : <?php echo $_SESSION['email']; ?></li>
                            </ul>
                        </div>
                        <div id="mod" class="tab-pan fade">
                            <?php echo form("../post/post_connexion.php?action=update&uri={$_SERVER["REQUEST_URI"]}",
                                    "POST") ?>
                                <div class="form-group">
                                    <label for="pseudo">Pseudo</label>
                                    <?php echo form_input([
                                        "required"=>"",
                                        "name"=>"pseudo",
                                        "type"=>"text",
                                        "class"=>"form-control",
                                        "placeholder"=>$_SESSION['pseudo']]); ?>
                                </div>
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <?php echo form_input([
                                        "required"=>"",
                                        "name"=>"email",
                                        "type"=>"email",
                                        "class"=>"form-control",
                                        "placeholder"=>$_SESSION['email']]); ?>
                                </div>
                                <div class="form_control_content" style="width: 200px; margin: auto">
                                <?php
                                    echo form_input(["type" => "submit", "class" => "btn btn-primary"]);
                                    echo form_input(["type" => "reset", "class" => "btn btn-primary"]);
                                ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
//        var_dump($_SESSION) ;
        ?>
    </body>
</html>