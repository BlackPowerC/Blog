<html>
    <?php
    Page::getHead();
    include_once 'beuserView.php';
    function LastConnextion($time)
    {
        $tmp = 0;
        $i = 0;
        $timestr = "" ;
        $_timestr = ["Jour(s)","Heure(s)", "Minute(s)", "Seconde(s)"] ;
        $_time = [86400, 3600, 60, 1] ;
        while($time)
        {
            $tmp = (int) ($time / $_time[$i]) ;
            if($tmp)
            {
                
                $timestr = $timestr.' '.$tmp.' '.$_timestr[$i] ;
            }
            $time = (int) $time % $_time[$i] ;
            $i++ ;
        }
        return $timestr ;
    }
    ?>
    <body>
        <div id="page" class="container container-fluid">
            <!-- Entete avec nom de l'utilisateur et Photo de profil -->
            <div class="row">
                <!-- Colonne pour la pp -->
                <div class="side_content col-lg-4 col-md-4 col-xs-4">
                    <img class="img-thumbnail" alt="<?php echo $_SESSION['pseudo']; ?>" src="bb.jpg"/>
                </div>
                <div class="main_content col-lg-8 col-md-8 col-xs-8">
                    <h1 class="text-center">Informations personnelles</h1>
                    <div class="well">
                        <span><?php echo $_SESSION['pseudo']; ?></span>
                        <span style="float: right">Dernière Connexion : il y a <?php echo LastConnextion(time() -  $_SESSION["time"]); ?></span>
                    </div>
                    <div class="user_content">
                        <ul>
                            <li></li>
                            <li>Pseudo : <?php echo $_SESSION['pseudo']; ?></li>
                            <li>Statut : <?php echo $_type[$_SESSION['id_type']]; ?></li>
                            <li>Sexe : <?php echo $_sexe[$_SESSION['sexe']]; ?></li>
                            <li>Age : <?php echo $_SESSION['age']; ?></li>
                            <li>Pays : <?php echo $_SESSION['pays']; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php
        var_dump($_SESSION) ;
        ?>
    </body>
</html>