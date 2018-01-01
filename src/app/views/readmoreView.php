<!DOCTYPE html>
<html>
    <?php
    Page::getHead($article->getTitre());
    ?>
    <body>
        <header>
            <?php include_once '../views/navbarView.php'; ?>
        </header>
        <div class="container container-fluid">
            <div class="row">
                <div class ="side_content col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <?php
                    (isset($_SESSION['id'])) ? Page::getConnecteddiv($_SESSION['pseudo']) : Page::getLoginform();
                    ?>
                </div>
                <div class="main_content col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <div class="article_content">
                        <!-- Zone de l'article -->
                        <div class="article_header_content">
                            <?php echo $article->getTitre(); ?>
                            <?php echo $article->getDate(); ?>
                        </div>
                        <!-- end article_header_content -->

                        <div class="article_text_content">
                            <?php
                            echo html_entity_decode($article->getText());
                            ?>
                            <div class="container container-fluid">
                                Etiquettes:  
                                <?php
                                foreach ($tags as $tag)
                                {
                                    ?>
                                    <a href="index.php?tag=<?php echo $tag->getTag(); ?>" class="well well-sm"><?php echo $tag->getTag(); ?></a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <!-- Media sharing frontend -->
                        <div class="media-sharing">
                            <h4>Partager sur les réseaux sociaux</h4>
                            <?php
                            $social = new MediaSharing('http://' . $_SERVER['SERVER_ADDR'] . $_SERVER['REQUEST_URI']);
                            $_ = $social->getSharedButton();
                            ?>
                            <span class="facebook">
                                <?php
                                $fb = $_['facebook'];
                                echo $fb;
                                ?>
                            </span>
                            <span class="twitter">
                                <?php
                                $tw = $_['twitter'];
                                echo $tw;
                                ?>
                            </span>
                        </div>
                        <!-- Frontend du système de vote -->
                        <div class="vote">
                            <div style="width:<?php echo $vote_results["percent"]["like"] ?>%;" class="vote_progress">
                                <div style="width:<?php echo $vote_results["percent"]["dislike"] ?>%;" class="vote_bar"></div>
                            </div>
                            <div class="vote_btns">
                                <!-- Like -->
                                <form style="display: inline-block;" action="../post/post_vote.php?uri=<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST">
                                    <button type="submit" class="vote_btn like"><i class="fa fa-thumbs-up"><?php echo $vote_results["count"]["like"] ?></i></button>
                                    <?php 
                                    echo form_input([
                                        "type"=>"number",
                                        "hidden"=>"",
                                        "name"=>"id_article",
                                        "value"=>(int) strip_tags($_GET['id_article'])
                                    ]);
                                    echo form_input([
                                        "type"=>"number",
                                        "hidden"=>"",
                                        "name"=>"vote",
                                        "value"=>1
                                    ]); 
                                    ?>
                                </form>
                                <!-- dislike -->
                                <form style="display: inline-block;" action="../post/post_vote.php?uri=<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST">
                                    <button type="submit" class="vote_btn dislike"><i class="fa fa-thumbs-down"> <?php echo $vote_results["count"]["dislike"] ?></i></button>
                                    <?php 
                                    echo form_input([
                                        "type"=>"number",
                                        "hidden"=>"",
                                        "name"=>"id_article",
                                        "value"=>(int) strip_tags($_GET['id_article'])
                                    ]);
                                    echo form_input([
                                        "type"=>"number",
                                        "hidden"=>"",
                                        "name"=>"vote",
                                        "value"=>0
                                    ]); 
                                    ?>
                                </form>
                            </div>
                        </div>
                        <!-- end article_text_content -->
                        <div class="article_comment_content">
                            <h4>Commentaires</h4>
                            <?php
                            foreach ($comments as $cmt)
                            {
                                ?>
                                <!-- Zone des commentaires -->
                                <div class="container-fluid">
                                    <!-- Entete commentaire -->
                                    <div class="comment_header">
                                        <?php
                                        echo $cmt->getId_user()->getPseudo();
                                        echo $cmt->getDate();
                                        ?>
                                    </div>
                                    <!-- end comment_header -->
                                    <?php
                                    // Affichage du commenraire
                                    echo $cmt->getText();
                                    if (isset($_SESSION["id"]) && isset($_SESSION["email"]) && isset($_SESSION["pseudo"]))
                                    {
                                        ?>
                                        <!-- Lien de réponse -->
                                        <button class="btn btn-primary" onclick="reply();">Répondre</button>
                                        <?php
                                        if ($cmt->getId_user()->getId() == $_SESSION['id'])
                                        {
                                            ?>	
                                            <div class="editlink_content">
                                                <!-- modification -->
                                                <form action="" method="POST">
                                                    <button type="submit"><i class="fa fa-pencil-square-o" title="modifier"></i></button>
                                                    <!-- Les champs cachés -->
                                                    <input hidden="" name="id_comment" value="<?php echo $cmt->getId(); ?>" >
                                                    <input hidden="" name="text_comment" value="<?php echo $cmt->getText(); ?>"/>
                                                    <input hidden="" name="operation" value="modify"> 
                                                </form>
                                                <!-- suppression -->
                                                <form action="../post/post_comment.php" method="POST">
                                                    <button type="submit"><i class="fa fa-eraser" title="effacer"></i></button>
                                                    <!-- Les champs cachés -->
                                                    <input hidden="" type="text" name="uri" value="<?php echo $_SERVER["REQUEST_URI"]; ?>">
                                                    <input hidden="" name="id_comment" value="<?php echo $cmt->getId(); ?>" >
                                                    <input hidden="" name="operation" value="delete"> 
                                                </form>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <!-- end container-fluid -->
                                <?php
                            }
                            ?>
                        </div>
                        <!-- end article_comment_content -->

                        <?php
                        if (isset($_SESSION['id']))
                        {
                            ?>
                            <div class="article_comment_zone">
                                <!-- Script tinymce pour l'éditeur WYSIWYG -->
                                <?php Page::getTinymce(); ?>
                                <h4>Ecrire un commentaire</h4>
                                <form method="POST" action="../post/post_comment.php">
                                    <textarea name="comment" rows="" cols=""><?php if (isset($_POST['text_comment'])) echo strip_tags($_POST['text_comment']); ?></textarea>
                                    <div class="form_control_content">
                                        <input class="btn btn-primary" type="submit"/>
                                        <input class="btn btn-primary" type="reset"/>
                                    </div>
                                    <!-- end form_control_content -->
                                    <input hidden="" type="number" name="id_article" value="<?php echo $article->getId(); ?>" >
                                    <input hidden="" type="text" name="uri" value="<?php echo $_SERVER["REQUEST_URI"]; ?>">
                                    <input id="operation" hidden="" type="text" name="operation" value="<?php
                                if (isset($_POST["operation"]))
                                {
                                    echo $_POST["operation"];
                                } else
                                    echo 'insert';
                                ?>"/>
                                           <?php
                                           if (isset($_POST['id_comment']))
                                           {
                                               ?>
                                        <input hidden="" type="number" name="id_comment" value="<?php echo strip_tags($_POST['id_comment']); ?>"/>		
                                        <?php
                                    }
                                    ?>
                                </form>
                            </div>
                            <!-- end article__comment_zone -->
                            <?php
                        }
                        ?>
                    </div>
                    <!-- end article_content -->
                </div>
                <!-- end main_content -->
            </div>
        </div>
    </body>
</html>