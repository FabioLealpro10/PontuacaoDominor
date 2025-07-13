<?php 

function verificação(){
    include 'model/mConsoltador.php';

    if (isset($_POST['confirmar'])) {
        $admin = $_POST['nome-adm'];
        $senhaADM = $_POST['senha-adm'];
        $senhaADM = hash('sha256', $senhaADM);
        if (verificarCredenciais($admin, $senhaADM)) {
            session_start();
            $_SESSION['admin'] = $admin;
            header('Location: cListarUsuario.php');
            exit();
        }
        return 'Credenciais inválidas. Tente novamente.';
    }
    return ''; 
}



$html = file_get_contents('visao/vCredenciais.php');
$msg = verificação();
$html = str_replace('{{msg}}', $msg, $html);
echo $html;

?>