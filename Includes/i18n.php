<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
if (isset($_GET['lang'])){
    if ($_GET['lang'] == 'en-us'){
        $_SESSION['idioma']= 'en-us';
    } elseif ($_GET['lang'] == 'hi-in') {
        $_SESSION['idioma']= 'hi-in';
    } elseif ($_GET['lang'] == 'pt-br') {
        $_SESSION['idioma']= 'pt-br';
    } elseif ($_GET['lang'] == 'zh-cn') {
        $_SESSION['idioma'] = 'zh-cn';
    } elseif($_GET['lang'] == 'es-es'){
        $_SESSION['idioma'] = 'es-es';
    } elseif($_GET['lang'] == 'ja-jp'){
        $_SESSION['idioma'] ='ja-jp';
    } elseif($_GET['lang'] == 'it-it'){
        $_SESSION['idioma'] = 'it-it';
    }
    else{
        $_SESSION ['idioma'] = 'pt-br'; 
    }
} 

if   (!isset($_SESSION['idioma'])){
        $_SESSION['idioma'] = 'pt-br';
}

$lang = require_once(__DIR__ . '/../Languages/' . $_SESSION['idioma'] . '.php');

?>