<html>
    <?php
    Page::getHead();
    ?>
    <body>
        <header id="header">
            <?php include_once '../views/navbar.inc.php'; ?>
        </header>
        <div class="container container-fluid">		
            <div class="row">
                <div class ="side_content col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <?php
                    (isset($_SESSION['id'])) ? Page::getConnecteddiv($_SESSION['pseudo']) : Page::getLoginform();
                    ?>
                    <div class="panel panel-default">
                        <div class="panel panel-heading">Etiquettes: </div>
                        <div class="panel panel-body">
                            <?php
                            foreach($tags as $t)
                            {
                            ?>
                            <a href="home.php?tag=<?php echo $t->getTag(); ?>" class="well well-sm"><?php echo $t->getTag(); ?></a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="main_content col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <!-- end login_content -->
                    <?php
                    if (isset($_GET['keyword']) or isset($_GET['tag']))
                    {
                        ?>
                        <div class="alert alert-info">
                            Résultats de la recherche: <span class="badge"><?php echo $pages->getNItem(); ?> article(s)</span>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if ($data)
                    {
                        foreach ($data as $datas)
                        {
                            $article = new Article();
                            $article->setDate($datas["date"])
                                    ->setId($datas["id"])
                                    ->setText($datas["text"])
                                    ->setTitre($datas["titre"]) ;
                            ?>
                            <div class="card article_content">
                                <div class="article_header_content">
                                    <h2><?php echo $article->getTitre(); ?></h2>                                    
                                    Publié le <?php echo substr($article->getDate(), 0, 10); ?>
                                    à <?php echo substr($article->getDate(), 10); ?>
                                </div>
                                <hr/>
                                <!-- end article_header_content -->
                                <div class="article_text_content">
                                    <?php echo strip_tags(html_entity_decode(substr($article->getText(), 0, 300))) . '<br/>'; ?>
                                    <div style="margin-top: 10px">
                                        <a class="btn btn-primary" href="post.php?id_article=<?php echo $article->getId() ?>">Lire la suite --></a>
                                        <span style="float: right"> Commentaire <i class="badge"><?php echo $datas['nbre_comment']; ?></i></span>
                                    </div>
                                </div>

                                <!-- end article_comment_content -->
                            </div>
                            <!-- end article_content -->
                            <?php
                        }
                        $pages->getPagination($_SERVER['SCRIPT_NAME'] . '?page=');
                    } else
                    {
                        ?>
                        Aucun article n'a encore été rédigé sur ce Blog !
                        <?php
                    }
                    //$requete->closeCursor();
                    ?>	
                </div>
                <!-- end main_content -->
            </div>
        </div>
    </body>
</html>