<?php

require_once 'Comment.php';
require_once 'Article.php';

class ArticleContent
{

    private $t_article;
    private $t_comment;

    public function __construct($article, $comment)
    {
        $this->t_article = $article;
        $this->t_comment = $comment;
    }

    public function toHTML()
    {
        $HTMLView = array(
            'article' => $this->t_article->toHTML(),
            'comment' => $this->t_comment->toHTML()
                );
        return $HTMLView;
    }

    public function getT_article()
    {
        return $this->t_article;
    }

    public function setT_article($t_article)
    {
        $this->t_article = $t_article;
    }

    public function getT_comment()
    {
        return $this->t_comment;
    }

    public function setT_comment($t_comment)
    {
        $this->t_comment = $t_comment;
    }

    public function toHTML()
    {
        
    }

}
