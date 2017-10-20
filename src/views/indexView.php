<html>
    <?php
    Page::getHead();
    ?>
    <body>
        <header>
            <?php include_once '../views/navbarView.php'; ?>
        </header>
        <div class="container container-fluid">		
            <div class="row">
                <div class ="side_content col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <?php
                    (isset($_SESSION['token'])) ? Page::getConnecteddiv($_SESSION['pseudo']) : Page::getLoginform();
                    ?>
                </div>
                <div class="main_content col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <!-- end login_content -->
                    <?php
                    if ($data)
                    {
                        foreach ($data as $datas)
                        {
                            $article = new Article($datas);
                            $HTMLView = $article->toHTML();
                            ?>
                            <div class="card article_content">
                                <div class="article_header_content">
                                    <?php
                                    echo $HTMLView['titre'];
                                    echo $HTMLView['date'];
                                    ?>
                                </div>
                                <!-- end article_header_content -->
                                <div class="article_text_content">
                                    <?php echo strip_tags(html_entity_decode(substr($HTMLView['text'], 0, 300))) . '<br/>'; ?>
                                    <div style="margin-top: 10px">
                                        <a href="read_more.php?id_article=<?php echo $article->getId() ?>">Lire la suite --></a>
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
<?php
//var_dump($_SERVER);
?>