<?php 

function VerificarSecaoAtiva() {
    session_start();
    if (!isset($_SESSION['admin']) or ($_SESSION['admin'] != 'admin12345')) {
        header('Location: cCredenciais.php');
        exit();
    }
}














?>