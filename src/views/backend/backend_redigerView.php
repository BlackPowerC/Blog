<!DOCTYPE HTML>
<html>
    <!-- Balise Head -->
    <?php
    include_once 'backend_part_head.php';

    $pdo = Database::getInstance()->getPDO();
    $tags = "";
    if (strcmp($_SERVER["REQUEST_METHOD"], "POST") == 0)
    {
        if (isset($_POST['id']))
        {
            $sql_query_tags = "SELECT t.tag FROM tag t 
                                    LEFT JOIN article a ON a.id = t.id_article
                                    WHERE t.id_article=:id";
            $request_tags = $pdo->prepare($sql_query_tags);
            $request_tags->execute(array("id" => strip_tags($_POST["id"])));
            $array_tags = $request_tags->fetchAll(PDO::FETCH_ASSOC);
            if ($array_tags)
            {
                foreach ($array_tags as $tag)
                {
                    $tags .= ($tag['tag'] . ',');
                }
                $tags[strlen($tags) - 1] = ' ';
            }
            $request_tags->closeCursor();
        }
    }
    ?>

    <body>
        <!-- Barre de navigation -->
        <?php include_once 'backend_part_nav.php'; ?>
        <header>
            <h1 class="text-center">Page de rédaction</h1>
        </header>

        <div class="main_content container container-fluid">
            <?php
            if (isset($_GET['msg']))
            {
                $msg = (int) strip_tags($_GET['msg']);
                switch ($msg)
                {
                    case 1:
                        ?>
                        <div class="alert alert-danger" >
                            Une erreur est survenue lors de l'action ! 
                        </div>
                        <?php
                        break;
                    case 0:
                        ?>
                        <div class="alert alert-success" >
                            Action bien exécutée ! 
                        </div>
                    <?php
                }
            }
            ?>
            <div class="col-sm-6 col-lg-6 col-md-6 col-xs-6">
                <form action="../post/post_rediger.php" method="POST">
                    <div class="form-group input_content">
                        <!-- Zone de titre -->
                        <label for="titre">Titre</label><br/>
                        <input class="form-control" name="titre" type="text" required="required" value="<?php
                        if (isset($_POST['titre']))
                        {
                            echo strip_tags($_POST['titre']);
                        }
                        ?>"/>
                    </div>
                    <div class="form-group input_content">
                        <!-- Zone de Rédaction -->
                        <label for="content">Rédiger</label><br/>
                        <script src="http://localhost/js_text_editor/ckeditor/ckeditor.js"></script>
                        <textarea id="text" name="text" rows="" cols="" required="required">
                            <?php
                            if (isset($_POST['text']))
                            {
                                echo html_entity_decode($_POST['text']);
                            }
                            ?>
                        </textarea>
                        <input type="number" hidden="" name="id" value="<?php
                        if (isset($_POST['id']))
                        {
                            echo (integer) strip_tags($_POST['id']);
                        } else
                        {
                            echo (int) $articles[count($articles) - 1]['id'];
                        }
                        ?>">
                        <script type="text/javascript">CKEDITOR.replace('text');</script>
                        <input hidden="" name="operation" value="<?php
                        if (isset($_POST['operation']))
                        {
                            echo strip_tags($_POST['operation']);
                        } else
                            echo 'insert';
                        ?>"/>
                        <a target="blank" href="http://localhost/js_text_editor/ckeditor/samples/toolbarconfigurator/index.html#basic">Configurer</a>
                    </div>

                    <div class="form-group input_content">
                        <!-- Zone de tags -->
                        <label for="tags">Etiquettes </label>
                        <input class="form-control" type="text" name="tags" value="<?php echo $tags; ?>"/>
                    </div>
                    <div class="form_control_content">
                        <input class="btn btn-primary" type="submit" name="Enregistrer" value="Enregistrer"/>
                        <input class="btn btn-primary" type="reset" name="Effacer" value="Effacer"/>
                    </div>
                </form>
            </div>

            <!-- Zone d'historique -->
            <div class="history_content col-sm-4 col-lg-4 col-md-4 col-xs-4">
                <table class="table table-striped">
                    <thead>
                    <td>Titre</td>
                    <td>Auteur</td>
                    <td>Date d'édition</td>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($articles as $a)
                        {
                            $t_article = new Article($a);
                            ?>
                            <tr>
                                <td><div style="width: 150px"><?php echo $t_article->getTitre(); ?></div></td>
                                <td><div style="width: 50px"><?php echo $_SESSION['pseudo'] ?></div></td>
                                <td><div style="width: 150px"><?php echo $t_article->getDate(); ?></div></td>
                                <td>
                                    <!-- Formulaire d'édition -->
                                    <div class="editlink_content border-0">
                                        <!-- Suppression -->
                                        <form action="../post/post_rediger.php" method="POST">
                                            <input class="btn btn-danger" type="submit" value="Supprimer"/>
                                            <input type="number" hidden="" name="id" value="<?php echo $t_article->getId(); ?>"/>
                                            <input type="text" hidden="" name="operation" value="delete"/>
                                        </form>
                                        <!-- Modification -->
                                        <form action="" method="POST">
                                            <input class="btn btn-primary" type="submit" value="Modifier"/>
                                            <input type="number" hidden="" name="id" value="<?php echo $t_article->getId(); ?>"/>
                                            <input type="text" hidden="" name="text" value="<?php echo $t_article->getText(); ?>"/>
                                            <input type="text" hidden="" name="titre" value="<?php echo $t_article->getTitre() ?>"/>
                                            <input type="text" hidden="" name="operation" value="modify"/>
                                        </form>
                                        <a class="btn btn-info" target="_blank" href="../frontend/read_more.php?id_article=<?php echo $t_article->getId(); ?>" >Voir <i class="glyphicon glyphicon-eye-open"></i></a>
                                    </div>
                                </td>
                            </tr>

                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
