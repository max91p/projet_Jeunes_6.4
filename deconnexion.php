<?php
    session_start();
    session_unset();
    session_destroy();
    header('Location: page_accueil2.html');
    exit();
?>