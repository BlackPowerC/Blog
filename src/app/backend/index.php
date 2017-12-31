<?php
session_start() ;

if(isset($_SESSION['id']) AND $_SESSION['id'] == 1 )
{
    header("Location: backend.php?link=rediger") ;
    exit() ;
}
else
{
    header("Location: ../frontend/index.php") ;
    exit() ;
}
