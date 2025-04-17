<?php
    // prendo la sessione
    session_start();
    
    // distruggo la sessione
    unset($_SESSION);
    session_destroy();
    session_write_close();

    // reindirizzamento
    header('Location: mappa.php');
    die;
?>