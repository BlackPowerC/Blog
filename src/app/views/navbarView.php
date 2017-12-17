<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <span class="navbar-brand">BLOG</span>
        </div>
        <ul class="nav navbar-nav">
            <li><a class="active" href="index.php"><i class="glyphicon glyphicon-home"></i> Accueil</a></li>
            <li><a href="be_user.php"><i class="glyphicon glyphicon-user"></i> Espace Utilisateur</a></li>
            <li><a href="../backend/index.php"> Espace Administrateur</a></li>';
        </ul>
        <form class="navbar-form navbar-left" method="GET" action="index.php">
            <div class="input-group">
                <input class="form-control" type="text" name="keyword" placeholder="Recherche" required=""/>
                <div class="input-group-btn">
                    <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
        </form>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="connexion.php"><i class="glyphicon glyphicon-log-in"></i> Connexion</a></li>
            <li><a href="inscription.php?msg=good_action"><i class="glyphicon glyphicon-user"></i> Inscription</a></li>
        </ul>
    </div>
</nav>