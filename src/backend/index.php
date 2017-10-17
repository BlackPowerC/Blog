<?php
session_start() ;

if(isset($_SESSION['id_type']) AND $_SESSION['id_type'] == 2 )
{
    header("Location: backend.php?link=rediger") ;
    exit() ;
}
else
{
    header("Location: ../frontend/index.php") ;
    exit() ;
}
