<?php 
    require_once '../../service/connect.php' ; 
    if( !isset($_SESSION['AD_ROLE'] ) ){
        header('Location: ../../login.php');  
    }
?>