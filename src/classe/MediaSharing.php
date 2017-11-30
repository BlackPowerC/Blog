<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MediaSharing
 *
 * @author jordy
 */
class MediaSharing
{

    protected $url_to_share;

    public function __construct(string $url_to_share)
    {
        $this->url_to_share = $url_to_share;
    }

    public function getSharedButton()
    {
        return array('facebook'=>$this->facebook(), 'twitter'=> $this->twitter()) ;
    }

    private function facebook()
    {
        $html_code = '<a target="_blank" alt="Facebook" title="Partager sur Facebook" class="btn btn-primary"
                        href="https://www.facebook.com/sharer/sharer.php?u=' . $this->url_to_share . '"
                        data-size="large"><i class="fa fa-facebook fa-lg">Facebook</i>
                        </a>' ;
        return $html_code ;
    }

    private function twitter()
    {
        $html_code = '<a target="_blank" alt="Twitter" title="Partager sur Twitter" class="btn btn-primary"
                        href="https://twitter.com/intent/tweet?text=' . $this->url_to_share . '"
                        data-size="large"><i class="fa fa-twitter fa-lg">Twitter</i>
                        </a>';
        return $html_code;
    }

}
