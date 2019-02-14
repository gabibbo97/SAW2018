<?php
    function drawError($error = NULL) {

        // Includi la pagina di errore
        require('error-template.php');

        // Termina lo script
        die();
    }
?>