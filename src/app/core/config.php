<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
define("ROOT", filter_input(INPUT_SERVER, $_SERVER["DOCUMENT_ROOT"]).'/Blog/src/app/');
define("HELPER", ROOT.'/helper/') ;
define("ENTITY", ROOT.'/repository/entity/') ;
define("MANAGER", ROOT.'/repository/manager') ;
define("CLASS", ROOT.'/classe/') ;
