<?php
    //Destruction de la session et des variables de session pour permettre au jeune de se déconnecter
    session_start();
    session_unset();
    session_destroy();
    header('Location: page_accueil2.html');
    exit();
?>